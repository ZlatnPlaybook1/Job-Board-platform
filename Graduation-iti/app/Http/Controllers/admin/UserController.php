<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfile;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $user = User::orderBy('created_at' , 'DESC')->paginate(2);
        return view('theme.admin.users.list', [
            'users' => $user
        ]);
    }

    public function edit($id){
        $user = User::findOrfail($id) ;
        return view('theme.admin.users.edit',[
            'user' => $user
        ]);
    }

    public function update(UpdateProfile $request){
        // Validate the request data
        $validatedData = $request->validated();
        $id = auth()->user()->id;
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }
        $user->update($validatedData);
        session()->flash('status', 'Profile updated successfully.');
        return redirect()->back();
    }

    public function destroy($id){
        // Find the user by their ID
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('admin.users.list')->with('error', 'User not found.');
        }
        $user->delete();
        session()->flash('success', 'User deleted successfully.');
        return redirect()->route('admin.users.list')->with('success', 'User deleted successfully.');
    }


}
