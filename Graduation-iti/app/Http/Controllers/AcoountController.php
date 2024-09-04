<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobDetailsRequest;
use App\Models\EmploymentPosition;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateProfile;
use App\Http\Requests\UpdateProfilePic;
use App\Mail\ResetPasswordEmail;
use Illuminate\Support\Facades\Log;
use App\Models\EmployeeClass;
use App\Models\EmploymentType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AcoountController extends Controller
{
    // Show Register Page
    public function registration(){
        return view('theme.account.register');
    }

    // Show Login Page
    public function login(){
        return view('theme.account.login');
    }

    public function store(RegisterRequest $request){
        // Validate the request data
        $validatedData = $request->validated();

        // Hash the password before saving
        $validatedData['password'] = Hash::make($validatedData['password']);

        // Create a new member with validated data
        User::create($validatedData);

        // Redirect to the login page with a success message
        return redirect()->route('account.login')->with('status', 'Registration successful. Please log in.');
    }

    public function authenticate(LoginRequest $request ) {
        // Validate the request data
        $validatedData = $request->validated();

        // Attempt to authenticate the user
        if (Auth::attempt([
            'email' => $validatedData['email'],
            'password' => $validatedData['password']
        ])) {
            // Authentication passed
            return redirect()->route('account.profile')->with('status', 'Login successful');
        } else {
            // Authentication failed
            return redirect()->back()->withErrors(['login' => 'Invalid email or password'])->withInput();
        }
    }

    public function profile(){
        $id = Auth::user()->id;

        $user = User::Where('id' , $id)->first() ;

        return view('theme.account' , [
            'user' => $user ,
        ]);
    }

    public function updateProfile(UpdateProfile $request){
        // Validate the request data
        $validatedData = $request->validated();
        $id = Auth::user()->id;
        // Find the user by their ID
        $user = User::find($id);
        if (!$user) {
            // Handle the case where the user is not found (optional)
            return response()->json(['message' => 'User not found.'], 404);
        }
        // Update the user's profile with the validated data
        $user->update($validatedData);
        // Flash a success message to the session
        session()->flash('status', 'Profile updated successfully.');
        // Optionally, redirect back or return a response
        return redirect()->back(); // Redirects back to the previous page with the flash message
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('account.login');
    }

    // public function updateProfilePic(UpdateProfilePic $request){
    //     // Validate the request data
    //     $validatedData = $request->validated();
    //     // Get the authenticated user's ID
    //     $id = Auth::id();
    //     // Find the user by their ID
    //     $user = User::find($id);
    //     // Handle the image upload if an image is provided
    //     if ($request->hasFile('image')) {
    //         $destination_path = public_path('profilePic');
    //         $image = $request->file('image');
    //         $ext = $image->getClientOriginalExtension();
    //         $imageName = $id . '-' . time() . '.' . $ext;

    //         // Store the image in the 'profile_pic' folder
    //         $image->move($destination_path, $imageName);

    //         // Update the user's image field
    //         $user->update(['image' => $imageName]);
    //     }
    //     if (!$user) {
    //         // Handle the case where the user is not found (optional)
    //         return response()->json(['message' => 'User not found.'], 404);
    //     }
    //     // Update the user's profile with the validated data
    //     $user->update($validatedData);
    //     // Flash a success message to the session
    //     session()->flash('status', 'Profile Picture updated successfully.');
    //     // Redirect back or to a specific route
    //     return redirect()->back();
    // }
    public function updateProfilePic(UpdateProfilePic $request)
    {
        $validatedData = $request->validated();
        $id = Auth::id();
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }
        if ($request->hasFile('image')) {
            $destination_path = public_path('profilePic');
            $image = $request->file('image');
            $imageName = $id . '-' . time() . '.' . $image->getClientOriginalExtension();
            $image->move($destination_path, $imageName);
            $user->update(['image' => $imageName]);
        }
        session()->flash('status', 'Profile Picture updated successfully.');
        return redirect()->back();
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $validatedData = $request->validated();
        // Get the currently authenticated user
        $user = Auth::user();
        // Check if the old password is correct
        if (!Hash::check($request->old_password, $user->password)) {
            return redirect()->back()->with('error', 'The old password is incorrect.');
        }
        // Update the user's password
        $user->password = Hash::make($request->new_password);
        // Log before saving the user to ensure this part is reached
        Log::info('Updating password for user ID: ' . $user->id);
        // Save the updated user
        $user->save();
        // Log after saving to confirm it was successful
        Log::info('Password updated successfully for user ID: ' . $user->id);

        // Return a success message
        return redirect()->back()->with('status-updated', 'Password updated successfully.');
    }



    public function forgotPassword(){
        return view('theme.forgot-password');
    }

    public function proccessForgetPassword(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|email|exists:users,email'
        ]);
        if($validator->fails()){
            return redirect()->route('account.forgotPassword')->withInput()->withErrors($validator);
        }

        $token = Str::random(60);
        \DB::table('password_reset_tokens')->where('email' , $request->email)->delete();
        \DB::table('password_reset_tokens')->insert([
            'email' => $request->email ,
            'token' => $token ,
            'created_at' => now()
        ]);

        // Send Email here
        $user = User::where('email' , $request->email)->first();
        $mailData = [
            'token' => $token ,
            'user' => $user ,
            'subject' => 'You Have Requested to change your password.'
        ];
        Mail::to($request->email)->send(new ResetPasswordEmail($mailData));
        return redirect()->route('account.forgotPassword')->with('success' , 'Reset password email has sent to your inbox.');

    }

    public function resetPassword($tokenString){
        $token = \DB::table('password_reset_tokens')->where('email' , $tokenString)->fisrt();

        if($token == null){
            return redirect()->route('account.forgotPassword')->with('error' , 'Invalid Token');
        }

        return view('theme.reset-password',[
            'tokenString' => $tokenString
        ]);
    }

    public function proccessResetPassword(Request $request){

        $token = \DB::table('password_reset_tokens')->where('email' , $request->token)->fisrt();

        if($token == null){
            return redirect()->route('account.forgotPassword')->with('error' , 'Invalid Token');
        }

        $validator = Validator::make($request->all(),[
            'new_password' => 'required|min|5' ,
            'confirm_password' => 'required|same:new_password' ,
        ]);
        if($validator->fails()){
            return redirect()->route('account.resetPassword' ,$request->token)->withErrors($validator);
        }

        User::where('email' , $token->email)->update([
            'password' => Hash::make($request->new_password)
        ]);
        return redirect()->route('account.login')->with('success' , 'You Have Successfully changed your password');

    }
}