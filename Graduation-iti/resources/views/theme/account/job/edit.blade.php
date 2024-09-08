@extends('theme.master')

@section('content')
<style>
    body {
        font-family: 'Montserrat', sans-serif !important;
        background-color: #f8f9fa !important;
        color: #333 !important;
        line-height: 1.6 !important;
    }
    textarea.form-control {
        border-radius: 0.5rem !important;
        border: 1px solid #ced4da !important;
        padding: 0.75rem 1.25rem !important;
        font-size: 1rem !important;
        min-height: 150px !important;
        width: 100% !important;
        resize: vertical !important;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.1) !important;
        transition: border-color 0.3s ease, box-shadow 0.3s ease !important;
    }
    textarea.form-control:focus {
        border-color: #007bff !important;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25) !important;
    }
    textarea.form-control::placeholder {
        color: #6c757d !important;
        opacity: 1 !important;
    }
    .breadcrumb {
        background: #f8f9fa;
        border-radius: 0.5rem;
        padding: 0.75rem 1.25rem;
        box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.1);
        margin-bottom: 1.5rem;
    }
    .breadcrumb-item + .breadcrumb-item::before {
        content: '>';
        color: #6c757d;
        padding: 0 0.5rem;
    }
    .breadcrumb-item a {
        color: #007bff;
        text-decoration: none;
    }
    .breadcrumb-item.active {
        color: #6c757d;
    }
    .section-5 {
        padding: 4rem 0 !important;
    }
    .bg-2 {
        background-color: #ffffff !important;
    }
    .card {
        border: none !important;
        border-radius: 0.75rem !important;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1) !important;
        background-color: #ffffff !important;
    }
    .card-body {
        padding: 2rem !important;
    }
    .card h3 {
        font-size: 1.75rem !important;
        font-weight: 700 !important;
        color: #007bff !important;
    }
    .form-control {
        border-radius: 0.5rem !important;
        border: 1px solid #ced4da !important;
        padding: 0.75rem 1.25rem !important;
    }
    .form-select {
        border-radius: 0.5rem !important;
        border: 1px solid #ced4da !important;
        padding: 0.75rem 1.25rem !important;
    }
    .btn-primary {
        border-radius: 0.5rem !important;
        padding: 0.75rem 1.5rem !important;
        font-size: 1rem !important;
        background-color: #007bff !important;
        color: #ffffff !important;
        border: 1px solid #007bff !important;
        transition: background-color 0.3s ease, border-color 0.3s ease !important;
    }
    .alert {
        border-radius: 0.5rem !important;
        padding: 1rem !important;
        font-size: 1rem !important;
    }
    .alert-success {
        background-color: #d4edda !important;
        border-color: #c3e6cb !important;
        color: #155724 !important;
    }
    .sidebar {
        border-right: 1px solid #e9ecef !important;
        padding: 2rem !important;
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
                        <li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Account Settings</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                @include('theme.layout.sidebar')
            </div>
            <div class="col-lg-9">
                <form action="{{ route('employee_posts.update', $employeePost->id) }}" method="POST" id="createJobForm" name="createJobForm">
                    @csrf
                    @method('PUT')
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="card border-0 shadow mb-4">
                        <div class="card-body p-4">
                            <h3 class="fs-4 mb-4">Job Details</h3>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="title" class="mb-2">Title <span class="text-danger">*</span></label>
                                    <input value="{{ old('title', $employeePost->title) }}" type="text" placeholder="Job Title" id="title" name="title" class="form-control">
                                    @error('title')
                                        <div class="text-danger">
                                           {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="employee_class_id" class="mb-2">Category <span class="text-danger">*</span></label>
                                    <select name="employee_class_id" id="employee_class_id" class="form-select">
                                        <option value="">Select a Category</option>
                                        @foreach($employee_classes as $class)
                                            <option value="{{ $class->id }}" {{ old('employee_class_id', $employeePost->employee_class_id) == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('employee_class_id')
                                        <div class="text-danger">
                                           {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="employment_type_id" class="mb-2">Job Nature <span class="text-danger">*</span></label>
                                    <select class="form-select" name="employment_type_id" id="employment_type_id">
                                        <option value="">Select Job Nature</option>
                                        @foreach($employ_types as $type)
                                            <option value="{{ $type->id }}" {{ old('employment_type_id', $employeePost->employment_type_id) == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('employment_type_id')
                                        <div class="text-danger">
                                           {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="vacancy" class="mb-2">Vacancy <span class="text-danger">*</span></label>
                                    <input type="number" min="1" placeholder="Vacancy" id="vacancy" name="vacancy" class="form-control" value="{{ old('vacancy', $employeePost->vacancy) }}">
                                    @error('vacancy')
                                        <div class="text-danger">
                                           {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="salary" class="mb-2">Salary</label>
                                    <input type="text" placeholder="Salary" id="salary" name="salary" class="form-control" value="{{ old('salary', $employeePost->salary) }}">
                                    @error('salary')
                                        <div class="text-danger">
                                           {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="location" class="mb-2">Location <span class="text-danger">*</span></label>
                                    <input type="text" placeholder="Location" id="location" name="location" class="form-control" value="{{ old('location', $employeePost->location) }}">
                                    @error('location')
                                        <div class="text-danger">
                                           {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="description" class="mb-2">Description <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="description" id="description" cols="5" rows="5" placeholder="Job Description">{{ old('description', $employeePost->description) }}</textarea>
                                @error('description')
                                    <div class="text-danger">
                                       {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="benefits" class="mb-2">Benefits</label>
                                <textarea class="form-control" name="benefits" id="benefits" cols="5" rows="5" placeholder="Job Benefits">{{ old('benefits', $employeePost->benefits) }}</textarea>
                                @error('benefits')
                                    <div class="text-danger">
                                       {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="responsibility" class="mb-2">Responsibilities</label>
                                <textarea class="form-control" name="responsibility" id="responsibility" cols="5" rows="5" placeholder="Job Responsibilities">{{ old('responsibility', $employeePost->responsibility) }}</textarea>
                                @error('responsibility')
                                    <div class="text-danger">
                                       {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="qualifications" class="mb-2">Qualifications</label>
                                <textarea class="form-control" name="qualifications" id="qualifications" cols="5" rows="5" placeholder="Qualifications">{{ old('qualifications', $employeePost->qualifications) }}</textarea>
                                @error('qualifications')
                                    <div class="text-danger">
                                       {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="experience" class="mb-2">Experience</label>
                                <select class="form-select" name="experience" id="experience">
                                    @for ($i = 0; $i <= 10; $i++)
                                        <option value="{{ $i }}" {{ old('experience', $employeePost->experience) == $i ? 'selected' : '' }}>{{ $i }} years</option>
                                    @endfor
                                </select>
                                @error('experience')
                                    <div class="text-danger">
                                       {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="keywords" class="mb-2">Keywords</label>
                                <textarea class="form-control" name="keywords" id="keywords" cols="5" rows="5" placeholder="Enter relevant keywords">{{ old('keywords', $employeePost->keywords) }}</textarea>
                                @error('keywords')
                                    <div class="text-danger">
                                       {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="company_name" class="mb-2">Company Name <span class="text-danger">*</span></label>
                                <input type="text" name="company_name" id="company_name" class="form-control" placeholder="Company Name" value="{{ old('company_name', $employeePost->company_name) }}">
                                @error('company_name')
                                    <div class="text-danger">
                                       {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="company_location" class="mb-2">Company Location <span class="text-danger">*</span></label>
                                <input type="text" name="company_location" id="company_location" class="form-control" placeholder="Company Location" value="{{ old('company_location', $employeePost->company_location) }}">
                                @error('company_location')
                                    <div class="text-danger">
                                       {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="company_website" class="mb-2">Company Website</label>
                                <input type="text" name="company_website" id="company_website" class="form-control" placeholder="Company Website" value="{{ old('company_website', $employeePost->company_website) }}">
                                @error('company_website')
                                    <div class="text-danger">
                                       {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="card-footer bg-white border-top-0 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Update Job</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
