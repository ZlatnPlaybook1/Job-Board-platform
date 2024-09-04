<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompleteEmployeeRequest;
use App\Http\Requests\EmplouyeePostRequest;
use App\Models\Employeeclass;
use App\Models\EmployeePost;
use App\Models\Employeetype;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index(){
        $employeeposts = EmployeePost::orderBy('created_at' , 'DESC')
                        ->with('user' ,'applications')
                        ->paginate(5);
        // dd($employeeposts);
        return view('theme.admin.jobs.list',[
            'employeeposts' => $employeeposts
        ]);
    }

    public function edit($id){
        $employeePost = EmployeePost::findOrfail($id);
        $employee_classes = Employeeclass::where('status', 1)->orderBy('name')->get()->all();
        $employ_types = Employeetype::where('status', 1)->orderBy('name')->get();
        return view('theme.admin.jobs.edit',[
            'employeePost' => $employeePost,
            'employee_classes' => $employee_classes,
            'employ_types' => $employ_types
        ]);
    }
    // Update the specified post
    public function update(CompleteEmployeeRequest $request, $id)
    {
        $validatedData = $request->validated();
        // Set default values if the inputs are not present
        $validatedData['isFeatured'] = $request->has('isFeatured') ? 1 : 0;
        $validatedData['status'] = $request->input('status', 0);

        $employeePost = EmployeePost::findOrFail($id);
        $employeePost->update($validatedData);

        return redirect()->route('admin.jobs.edit' , $id)->with('successdata', 'Post updated successfully!');
    }

    public function destroy($id)
    {
        $employeepost = EmployeePost::findOrFail($id);
        $employeepost->delete();
        return redirect()->route('admin.jobs')->with('successremove', 'Post deleted successfully!');
    }

}