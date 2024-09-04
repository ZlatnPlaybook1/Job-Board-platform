<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AcoountController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\JobController;
use App\Http\Controllers\admin\JopApplicationController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EmployeePostController;
use App\Http\Controllers\OccupationsController;
// Route::get('/', function () {
//     return view('welcome');
// });

Route::get("/", [HomeController::class, 'index'])->name('home');
Route::get('/jobs', [OccupationsController::class, 'index'])->name('jobs');
Route::get('/jobs/search', [OccupationsController::class, 'search'])->name('jobs.search');
Route::get('/jobs/detail/{id}', [OccupationsController::class, 'deatail'])->name('jobs.deatail');
Route::post('/apply-job', [OccupationsController::class, 'applyJob'])->name('jobs.applyJob');
Route::post('/save-job', [OccupationsController::class, 'saveJob'])->name('jobs.saveJob');

Route::get('/forgot-password', [AcoountController::class, 'forgotPassword'])->name('account.forgotPassword');
Route::post('/process-forgot-password', [AcoountController::class, 'proccessForgetPassword'])->name('account.proccessForgetPassword');
Route::get('/reset-password/{token}', [AcoountController::class, 'resetPassword'])->name('account.resetPassword');
Route::post('/process-reset-password', [AcoountController::class, 'proccessResetPassword'])->name('account.proccessResetPassword');


Route::group(['admin' , 'middleware' => 'checkRole'] , function(){
    Route::get("/admin/dashboard", [DashboardController::class, 'index'])->name('admin.index');
    Route::get("/admin/users", [UserController::class, 'index'])->name('admin.users.list');
    Route::get("/admin/users/{id}", [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/user/{id}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    Route::get('/admin/jobs', [JobController::class, 'index'])->name('admin.jobs');
    Route::get('/admin/jobs/edit/{id}', [JobController::class, 'edit'])->name('admin.jobs.edit');
    Route::put('/admin/jobs/update/{id}', [JobController::class, 'update'])->name('admin.jobs.update');
    Route::delete('/admin/jobs/destroy/{id}', [JobController::class, 'destroy'])->name('admin.jobs.destroy');
    Route::get("/admin/job-applications", [JopApplicationController::class, 'index'])->name('admin.jobApplications');
    Route::delete("/admin/job-applications/{id}", [JopApplicationController::class, 'destroy'])->name('admin.jobApplications.destroy');

});

Route::group(['account'] , function(){
    // Geast Route
    Route::group(['middleware' => 'guest'] , function(){
        // Register Access
        Route::get("/account/register", [AcoountController::class, 'registration'])->name('account.registration');
        Route::Post("/account/register/store", [AcoountController::class, 'store'])->name('account.registration.store');
       // Login Acess
        Route::get("/account/login", [AcoountController::class, 'login'])->name('account.login');
        Route::Post("/account/authenticate", [AcoountController::class, 'authenticate'])->name('account.login.authenticate');

    });
    // Authenticated Routes
    Route::group(['middleware' => 'auth'] , function(){
        // Profile
        Route::get('/account/profile' ,[AcoountController::class , 'profile'])->name('account.profile');
        Route::put('/account/update-profile' ,[AcoountController::class , 'updateProfile'])->name('account.updateProfile');
        Route::get('/account/logout' ,[AcoountController::class , 'logout'])->name('account.logout');
        Route::post('/account/update-profile-pic' ,[AcoountController::class , 'updateProfilePic'])->name('account.updateProfilePic');
        // Routes for creating and storing employment posts
        Route::get('/create-employment', [EmployeePostController::class, 'createEmployment'])->name('employee_posts.create');
        Route::post('/store-employment', [EmployeePostController::class, 'store'])->name('employee_posts.store');
        Route::get('/my-jobs', [EmployeePostController::class, 'employmentJobs'])->name('account.employmentJobs');
        // Routes for editing, updating, and showing employment posts
        Route::get('/edit-employment/{id}', [EmployeePostController::class, 'edit'])->name('employee_posts.edit');
        Route::put('/update-employment/{id}', [EmployeePostController::class, 'update'])->name('employee_posts.update');
        // Route::get('/employment/{id}', [EmployeePostController::class, 'show'])->name('employee_posts.show');
        Route::delete('/employee-posts/{id}', [EmployeePostController::class, 'destroy'])->name('employee_posts.destroy');
        Route::get('/my-job-application', [OccupationsController::class, 'myJobsApplication'])->name('account.myJobsApplication');
        Route::delete('/remove-job-application/{id}', [OccupationsController::class, 'deleteJobApplication'])->name('account.deleteJobApplication');
        Route::get('/saved-jobs', [OccupationsController::class, 'savedJobs'])->name('account.savedJobs');
        Route::delete('/remove-saved-jobs/{id}', [OccupationsController::class, 'deleteSavedJobs'])->name('account.deleteSavedJobs');
        Route::put('/update-password' ,[AcoountController::class , 'updatePassword'])->name('account.updatePassword');

    });
});