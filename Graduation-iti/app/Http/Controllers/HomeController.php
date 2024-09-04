<?php

namespace App\Http\Controllers;

use App\Models\Employeeclass;
use App\Models\EmployeePost;
use App\Models\Employeetype;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Show the Home page
    public function index(){
        // Fetch employee classes with status 1 and order by name, limit to 8 records
        $employee_classes = Employeeclass::where('status', 1)
                            ->orderBy('name', 'ASC')
                            ->take(8)
                            ->get();

        // Fetch employment types with status 1 and order by name, limit to 8 records
        $employ_types = Employeetype::where('status', 1)
                        ->orderBy('name', 'ASC')
                        ->take(8)
                        ->get();

        // Fetch featured jobs, limit to 6 records
        $featuredJobs = EmployeePost::where('status', 1)
                        ->where('isFeatured', 1)
                        ->orderBy('created_at', 'DESC')
                        ->with('employeeType')
                        ->take(6)
                        ->get();

        // Fetch latest jobs, limit to 6 records
        $latestJobs = EmployeePost::where('status', 1)
                        ->where('isFeatured', 1) // Use 0 to fetch non-featured jobs
                        ->orderBy('created_at', 'ASC') // Use DESC to get the latest jobs
                        ->with('employeeType')
                        ->take(6)
                        ->get();

        return view('theme.home', [
            'employee_classes' => $employee_classes,
            'employ_types' => $employ_types,
            'featuredJobs' => $featuredJobs,
            'latestJobs' => $latestJobs,
        ]);
    }

}