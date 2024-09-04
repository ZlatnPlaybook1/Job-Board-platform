<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmplouyeePostRequest;
use App\Models\EmployeePost;
use App\Models\EmployeeClass;
use App\Models\Employeetype;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;

class EmployeePostController extends Controller
{
    public function createEmployment()
    {
        // Fetch employee classes with status 1 and order by name
        $employee_classes = Employeeclass::orderBy('name', 'ASC')->where('status', 1)->get();
        // Fetch employment types with status 1 and order by name
        $employ_types = Employeetype::orderBy('name', 'ASC')->where('status', 1)->get();
        // Fetch all employment positions
        $employment_posts = EmployeePost::all();
        // Return the data to the view
        return view('theme.account.job.create', [
            'employee_classes' => $employee_classes,
            'employ_types' => $employ_types,
            'employment_posts' => $employment_posts
        ]);
    }

    public function store(EmplouyeePostRequest $request)
    {
        // Validate and retrieve the request data
        $validatedData = $request->validated();
        // Assign the authenticated user's ID to the user_id field
        $validatedData['user_id'] = auth()->user()->id;
        // Create the EmployeePost record
        $employeePost = EmployeePost::create($validatedData);
        // Save the data to the database
        $employeePost->save();
        // Redirect or return a response as needed
        return redirect()->route('account.employmentJobs')->with('success', 'Employment post created successfully!');
    }

    public function employmentJobs(){
        $employeePosts = EmployeePost::where('user_id', auth()->user()->id)
            ->with(['employeeType', 'employeeClass'])
            ->orderBy('created_at' , 'DESC')
            ->paginate(10);

        return view('theme.account.job.my-jobs', [
            'employeePosts' => $employeePosts
        ]);
    }

    // Show the edit form for a specific post
    public function edit($id)
    {
        // dd($id) ;
        $employeePost = EmployeePost::findOrFail($id);
        $employee_classes = EmployeeClass::orderBy('name', 'ASC')->where('status', 1)->get();
        $employ_types = Employeetype::orderBy('name', 'ASC')->where('status', 1)->get();

        return view('theme.account.job.edit', [
            'employeePost' => $employeePost,
            'employee_classes' => $employee_classes,
            'employ_types' => $employ_types
        ]);
    }

    // Update the specified post
    public function update(EmplouyeePostRequest $request, $id)
    {
        $validatedData = $request->validated();
        $employeePost = EmployeePost::findOrFail($id);
        $employeePost->update($validatedData);

        return redirect()->route('account.employmentJobs')->with('success', 'Employment post updated successfully!');
    }
    // Show the specific post
    public function show($id)
    {
        $employeePost = EmployeePost::findOrFail($id);
        return view('', ['employeePost' => $employeePost]);
    }

    public function destroy($id)
    {
        // Find the employee post by ID
        $employeePost = EmployeePost::findOrFail($id);

        // Delete the employee post
        $employeePost->delete();

        // Redirect or return a response as needed
        return redirect()->route('account.employmentJobs')->with('success', 'Employment post deleted successfully!');
    }
}