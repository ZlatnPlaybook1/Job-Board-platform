<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\EmployeeApplication;
use Illuminate\Http\Request;

class JopApplicationController extends Controller
{
    public function index(){
        $applications = EmployeeApplication::orderBy('created_at' , 'DESC')
                              ->with('employeepost' , 'user' ,'occupation')
                              ->paginate(6);
        // dd($applications);

        return view('theme.admin.job-applications.list' ,[
            'applications' => $applications
        ]);
    }

    public function destroy(Request $request, $id)
    {
        try {
            // Find the job application by its ID
            $application = EmployeeApplication::findOrFail($id);
            $application->delete();

            // Redirect back with a success message
            return redirect()->back()->with('success', 'Job application removed successfully.');
        } catch (\Exception $e) {
            // Redirect back with an error message if something goes wrong
            return redirect()->back()->with('error', 'Failed to remove job application.');
        }
    }



}
