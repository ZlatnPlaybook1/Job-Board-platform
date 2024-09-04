@extends('theme.master')

@section('content')

<section class="section-5 bg-2">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.users.list')}}">Users</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                @include('theme.admin.sidebar')
            </div>
            <div class="col-lg-9">
                <!-- Profile Update Form -->
                <div class="card border-0 shadow mb-4">
                    <div class="card-body card-form">
                        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" id="userForm" name="userForm">
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
                                <h3 class="fs-4 mb-1">User / Edit</h3>
                                <div class="mb-4">
                                    <label for="name" class="mb-2">Name*</label>
                                    <input type="text" name="name" id="name" placeholder="Enter Name" class="form-control"
                                           value="{{ $user->name }}">
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
                                           value="{{  $user->email }}">
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
                                    <input type="text" name="designation" id="designation" placeholder="Enter Designation" class="form-control"
                                           value="{{  $user->designation }}">
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
                                    <input type="text" name="mobile" id="mobile" placeholder="Enter Mobile" class="form-control"
                                           value="{{ $user->mobile }}">
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
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
