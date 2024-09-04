<?php

namespace App\Http\Controllers;

use App\Mail\EmployeeNotificationEmail;
use App\Models\EmployeeApplication;
use App\Models\EmployeeClass;
use App\Models\EmployeePost;
use App\Models\EmployeeSaved;
use App\Models\EmployeeType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class OccupationsController extends Controller
{
    public function index()
    {
        // Fetch employee classes with status 1 and order by name
        $employee_classes = EmployeeClass::where('status', 1)->orderBy('name')->get();
        // Fetch employment types with status 1 and order by name
        $employ_types = EmployeeType::where('status', 1)->orderBy('name')->get();
        // Initialize the query for employment posts
        $employment_posts = EmployeePost::where('status', 1)->with(['employeeType', 'employeeClass']);
        $employment_posts = $employment_posts->paginate(9);
        return view('theme.jobs', [
            'employee_classes' => $employee_classes,
            'employ_types' => $employ_types,
            'employment_posts' => $employment_posts,
        ]);
    }

    public function search(Request $request)
    {
        // Fetch employee classes with status 1 and order by name
        $employee_classes = EmployeeClass::where('status', 1)->orderBy('name')->get()->all();
        // Fetch employment types with status 1 and order by name
        $employ_types = EmployeeType::where('status', 1)->orderBy('name')->get();
        // Initialize the query for employment posts
        $query = EmployeePost::where('status', 1)->with(['employeeType', 'employeeClass']);
        // Apply filters based on request parameters
        if ($request->filled('keyword')) {
            $query->where('title', 'like', '%' . $request->input('keyword') . '%')
                  ->orWhere('description', 'like', '%' . $request->input('keyword') . '%');
        }
        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->input('location') . '%');
        }

        if ($request->filled('category')) {
            $query->where('employee_class_id', $request->input('category'));
        }

        if ($request->filled('job_type')) {
            $query->whereIn('employment_type_id', $request->input('job_type'));
        }

        if ($request->filled('experience')) {
            if ($request->input('experience') == '10_plus') {
                $query->where('experience', '>=', 10);
            } else {
                $query->where('experience', $request->input('experience'));
            }
        }
        // Apply sorting
        if ($request->filled('sort')) {
            $sort = $request->input('sort');
            $query->orderBy('created_at', $sort == '1' ? 'desc' : 'asc');
        }
        // Paginate the results
        $employment_posts = $query->paginate(10);

        return view('theme.jobs', [
            'employee_classes' => $employee_classes,
            'employ_types' => $employ_types,
            'employment_posts' => $employment_posts,
        ]);
    }

    public function deatail($id){
        // Fetch the employment post with associated employee type and class
        $employment_posts = EmployeePost::where([
                                'id' => $id,
                                'status' => 1
                            ])->with(['employeeType', 'employeeClass'])->first();

        // If no employment post is found, abort with a 404 error
        if ($employment_posts == null) {
            abort(404);
        }

        // Fetch applications related to the employment post
        $applications = EmployeeApplication::where('employee_post_id', $id)
                          ->with('user')->get();

        // Return the view with the fetched data
        return view('theme.jobDetails', [
            'employment_posts' => $employment_posts,
            'applications' => $applications
        ]);
    }


    public function applyJob(Request $request){
       $id = $request->input('id');
       $employment_post = EmployeePost::find($id);

       Log::info('Job ID: ' . $id);
       Log::info('Employment Post: ' . $employment_post);

       if (!$employment_post) {
           Log::error('Job does not exist');
           return redirect()->back()->with('error', 'Job does not exist');
       }

       if ($employment_post->user_id == auth()->user()->id) {
           Log::error('Cannot apply to own job');
           return redirect()->back()->with('error', 'You cannot apply to your own job');
       }

       $applicationExists = EmployeeApplication::where([
           'user_id' => auth()->user()->id,
           'employee_post_id' => $id
       ])->exists();

       if ($applicationExists) {
           Log::error('Already applied for this job');
           return redirect()->back()->with('error', 'You already applied for this job');
       }

       $application = new EmployeeApplication();
       $application->employee_post_id = $id;
       $application->occupation_id = $employment_post->user_id;
       $application->user_id = auth()->user()->id;
       $application->applied_date = now();
       $application->save();

       Log::info('Application saved successfully');

       $action = $request->input('action');

       if ($action === 'apply') {
           // // Send Notification Email to Employer
           // $employer = $employment_post->employer;
           // if (!$employer) {
           //     Log::error('Employer not found');
           //     return redirect()->back()->with('error', 'Employer not found');
           // }
           // $mailData = [
           //     'employer' => $employer,
           //     'user' => auth()->user(),
           //     'employment_post' => $employment_post,
           // ];
           // try {
           //     Mail::to($employer->email)->send(new EmployeeNotificationEmail($mailData));
           //     Log::info('Notification email sent successfully');
           // } catch (\Exception $e) {
           //     Log::error('Failed to send email: ' . $e->getMessage());
           //     return redirect()->back()->with('error', 'Failed to send notification email.');
           // }
           return redirect()->back()->with('success', 'You have successfully applied.');

       } elseif ($action === 'save') {
           return redirect()->back()->with('success', 'Job saved successfully.');
       }

       return redirect()->back()->with('error', 'Invalid action.');
    }

    public function myJobsApplication(){
        $jobApplications = EmployeeApplication::where('user_id' , auth()
                                    ->user()->id )
                                    ->with(['employeepost' , 'employeepost.employeeType' ,'employeepost.applications'])
                                    ->orderBy('created_at' , 'DESC')
                                    ->paginate(10);
        // dd($jobs);
        return view('theme.account.job.my-job-application',[
            'jobApplications' => $jobApplications ,
        ]);
    }

    public function deleteJobApplication(Request $request){
       // Find the job application by id and the current user
       $jobApplication = EmployeeApplication::where(['id' => $request->id])
           ->where('user_id', auth()->user()->id)
           ->first();

       // Check if the job application exists and belongs to the authenticated user
       if ($jobApplication) {
           $jobApplication->delete(); // Delete the job application
           return redirect()->back()->with('success', 'Job application removed successfully.');
       }
       return redirect()->back()->with('error', 'Job application not found.');
    }

    public function saveJob(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:employee_posts,id',
            'action' => 'required|in:save',
        ]);

        $id = $request->input('id');
        $action = $request->input('action');

        // Check if the job exists
        $employment_post = EmployeePost::find($id);
        if ($employment_post === null) {
            return redirect()->back()->with('error', 'Job not found.');
        }

        if ($action === 'save') {
            // Check if the user already saved the job
            $existingSave = EmployeeSaved::where([
                'user_id' => auth()->user()->id,
                'employee_post_id' => $id,
            ])->first();

            if ($existingSave) {
                return redirect()->back()->with('info', 'Job already saved.');
            }

            // Save the job
            $savedJob = new EmployeeSaved;
            $savedJob->employee_post_id = $id;
            $savedJob->user_id = auth()->user()->id;
            $savedJob->save();

            return redirect()->back()->with('success', 'Job saved successfully.');
        }

        return redirect()->back()->with('error', 'Invalid action.');
    }

    public function savedJobs(){
        $userId = auth()->user()->id;

        $savedJobs = EmployeeSaved::where('user_id', $userId)
            ->with(['employeePost', 'employeePost.employeeType', 'employeePost.applications'])
            ->orderBy('created_at' , 'DESC')
            ->paginate(10);

        return view('theme.account.job.saved-jobs', [
            'savedJobs' => $savedJobs,
        ]);
    }

    public function deleteSavedJobs(Request $request){
        // Find the savedJobs by id and the current user
        $savedJobs = EmployeeSaved::where(['id' => $request->id])
            ->where('user_id', auth()->user()->id)
            ->first();

        // Check if the savedJobs exists and belongs to the authenticated user
        if ($savedJobs) {
            $savedJobs->delete();
            return redirect()->back()->with('success', 'Job removed successfully.');
        }
        return redirect()->back()->with('error', 'Job not found.');
    }

}