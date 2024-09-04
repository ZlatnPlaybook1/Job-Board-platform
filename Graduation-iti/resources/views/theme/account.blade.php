@extends('theme.master')

@section('content')
<style>

   body {
       font-family: 'Montserrat', sans-serif !important;
       color: #333 !important;
   }

   /* Breadcrumb Styles */
   .breadcrumb {
       background: none !important;
   }

   .breadcrumb-item a {
       color: #007bff !important;
   }

   .breadcrumb-item.active {
       color: #6c757d !important;
   }

   /* Card Styles */
   .card {
       border: none !important;
       border-radius: 0.5rem !important;
       box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1) !important;
   }

   .card-body {
       padding: 2rem !important;
   }

   .card-footer {
       padding: 1.5rem !important;
       border-top: 1px solid #e9ecef !important;
   }

   .card h3 {
       font-size: 1.5rem !important;
       font-weight: 600 !important;
   }

   .card p {
       color: #6c757d !important;
       font-size: 0.875rem !important;
   }

   /* Form Input Styles */
   .form-control {
       border-radius: 0.25rem !important;
       border: 1px solid #ced4da !important;
   }

   .form-control:focus {
       border-color: #007bff !important;
       box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25) !important;
   }

   .form-label {
       font-weight: 500 !important;
       margin-bottom: 0.5rem !important;
   }

   /* Button Styles */
   .btn-primary {
       border-radius: 0.25rem !important;
       padding: 0.5rem 1.5rem !important;
       font-size: 0.875rem !important;
       background-color: #007bff !important;
       color: #fff !important;
       border: 1px solid #007bff !important;
       transition: background-color 0.3s ease !important, color 0.3s ease !important;
   }

   .btn-primary:hover {
       background-color: #0056b3 !important;
       border-color: #0056b3 !important;
   }

   .btn-secondary {
       border-radius: 0.25rem !important;
       padding: 0.5rem 1rem !important;
       background-color: #6c757d !important;
       color: #fff !important;
       border: 1px solid #6c757d !important;
       transition: background-color 0.3s ease !important, color 0.3s ease !important;
   }

   .btn-secondary:hover {
       background-color: #5a6268 !important;
       border-color: #5a6268 !important;
   }

   /* Alert Styles */
   .alert {
       border-radius: 0.25rem !important;
       padding: 1rem !important;
       font-size: 0.875rem !important;
   }

   .alert-success {
       background-color: #d4edda !important;
       border-color: #c3e6cb !important;
       color: #155724 !important;
   }

   .alert-danger {
       background-color: #f8d7da !important;
       border-color: #f5c6cb !important;
       color: #721c24 !important;
   }

   /* Sidebar Styles */
   .sidebar {
       border-right: 1px solid #e9ecef !important;
       padding: 1rem !important;
   }

   .sidebar .nav-link {
       color: #007bff !important;
       font-weight: 500 !important;
       text-decoration: none !important;
   }

   .sidebar .nav-link:hover {
       color: #0056b3 !important;
       text-decoration: underline !important;
   }


</style>
<section class="section-5 bg-2">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Account Settings</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                @include('theme.layout.sidebar')
            </div>
            <div class="col-lg-9">
                <!-- Profile Update Form -->
                <div class="card border-0 shadow mb-4">
                    <form action="{{ route('account.updateProfile') }}" method="POST" id="userForm" name="userForm">
                        @csrf
                        @method('PUT')
                        @if (session('status'))
                        <div style="
                                padding: 15px;
                                margin-bottom: 20px;
                                border: 1px solid #d1e7dd;
                                background-color: #d1e7dd;
                                color: #0f5132;
                                border-radius: 5px;
                                font-family: 'Montserrat', sans-serif;
                                font-size: 16px;
                                text-align: center;">
                            {{ session('status') }}
                        </div>
                        @endif
                        @if (session('error'))
                        <div style="
                                padding: 15px;
                                margin-bottom: 20px;
                                border: 1px solid #f8d7da;
                                background-color: #f8d7da;
                                color: #721c24;
                                border-radius: 5px;
                                font-family: 'Montserrat', sans-serif;
                                font-size: 16px;
                                text-align: center;">
                            {{ session('error') }}
                        </div>
                        @endif
                        <div class="card-body p-4">
                            <h3 class="fs-4 mb-1">My Profile</h3>
                            <div class="mb-4">
                                <label for="name" class="mb-2">Name*</label>
                                <input type="text" name="name" id="name" placeholder="Enter Name" class="form-control"
                                       value="{{ old('name', $user->name) }}">
                                @error("name")
                                    <span style="
                                        color: #ff4d4d;
                                        font-family: 'Montserrat', sans-serif;
                                        font-size: 14px;
                                        font-weight: bold;
                                        margin-top: 5px;
                                        display: block;">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="email" class="mb-2">Email*</label>
                                <input type="text" name="email" id="email" placeholder="Enter Email" class="form-control"
                                       value="{{ old('email', $user->email) }}">
                                @error("email")
                                    <span style="
                                        color: #ff4d4d;
                                        font-family: 'Montserrat', sans-serif;
                                        font-size: 14px;
                                        font-weight: bold;
                                        margin-top: 5px;
                                        display: block;">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="designation" class="mb-2">Designation*</label>
                                <input type="text" name="designation" id="designation" placeholder="Designation" class="form-control"
                                       value="{{ old('designation', $user->designation) }}">
                                @error("designation")
                                    <span style="
                                        color: #ff4d4d;
                                        font-family: 'Montserrat', sans-serif;
                                        font-size: 14px;
                                        font-weight: bold;
                                        margin-top: 5px;
                                        display: block;">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="mobile" class="mb-2">Mobile*</label>
                                <input type="text" name="mobile" id="mobile" placeholder="Mobile" class="form-control"
                                       value="{{ old('mobile', $user->mobile) }}">
                                @error("mobile")
                                    <span style="
                                        color: #ff4d4d;
                                        font-family: 'Montserrat', sans-serif;
                                        font-size: 14px;
                                        font-weight: bold;
                                        margin-top: 5px;
                                        display: block;">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer p-4">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>

                <!-- Change Password Form -->
            <div class="card border-0 shadow mb-4">
                <form action="{{ route('account.updatePassword')}}" method="POST" name="changePasswordForm" id="changePasswordForm">
                    @csrf
                    @method('PUT')
                    @if (session('status-updated'))
                        <div style="
                                padding: 15px;
                                margin-bottom: 20px;
                                border: 1px solid #d1e7dd;
                                background-color: #d1e7dd;
                                color: #0f5132;
                                border-radius: 5px;
                                font-family: 'Montserrat', sans-serif;
                                font-size: 16px;
                                text-align: center;">
                            {{ session('status-updated') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div style="
                                padding: 15px;
                                margin-bottom: 20px;
                                border: 1px solid #f8d7da;
                                background-color: #f8d7da;
                                color: #721c24;
                                border-radius: 5px;
                                font-family: 'Montserrat', sans-serif;
                                font-size: 16px;
                                text-align: center;">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="card-body p-4">
                        <h3 class="fs-4 mb-1">Change Password</h3>
                        <div class="mb-4">
                            <label for="old_password" class="mb-2">Old Password*</label>
                            <input type="password" name="old_password" id="old_password" placeholder="Old Password" class="form-control">
                            @error("old_password")
                                <span style="
                                    color: #ff4d4d;
                                    font-family: 'Montserrat', sans-serif;
                                    font-size: 14px;
                                    font-weight: bold;
                                    margin-top: 5px;
                                    display: block;">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="new_password" class="mb-2">New Password*</label>
                            <input type="password" name="new_password" id="new_password" placeholder="New Password" class="form-control">
                            @error("new_password")
                                <span style="
                                    color: #ff4d4d;
                                    font-family: 'Montserrat', sans-serif;
                                    font-size: 14px;
                                    font-weight: bold;
                                    margin-top: 5px;
                                    display: block;">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="confirm_password" class="mb-2">Confirm Password*</label>
                            <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" class="form-control">
                            @error("confirm_password")
                                <span style="
                                    color: #ff4d4d;
                                    font-family: 'Montserrat', sans-serif;
                                    font-size: 14px;
                                    font-weight: bold;
                                    margin-top: 5px;
                                    display: block;">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer p-4">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>

            </div>
        </div>
    </div>
</section>

@endsection

