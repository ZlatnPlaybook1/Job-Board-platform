@extends('theme.master')

@section('content')

<section class="section-5 bg-2">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
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
                                <textarea class="form-conrtol" name="description" id="description" cols="5" rows="5" placeholder="Description">{{ old('description', $employeePost->description) }}</textarea>
                                @error('description')
                                    <div class="text-danger">
                                       {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="benefits" class="mb-2">Benefits</label>
                                <textarea class="form-conrtol" name="benefits" id="benefits" cols="5" rows="5" placeholder="Benefits">{{ old('benefits', $employeePost->benefits) }}</textarea>
                                @error('benefits')
                                    <div class="text-danger">
                                       {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="responsibility" class="mb-2">Responsibility</label>
                                <textarea class="form-conrtol" name="responsibility" id="responsibility" cols="5" rows="5" placeholder="Responsibility">{{ old('responsibility', $employeePost->responsibility) }}</textarea>
                                @error('responsibility')
                                    <div class="text-danger">
                                       {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="qualifications" class="mb-2">Qualifications</label>
                                <textarea class="form-conrtol" name="qualifications" id="qualifications" cols="5" rows="5" placeholder="Qualifications">{{ old('qualifications', $employeePost->qualifications) }}</textarea>
                                @error('qualifications')
                                    <div class="text-danger">
                                       {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="experience" class="mb-2">Experience <span class="text-danger">*</span></label>
                                <select name="experience" id="experience" class="form-select">
                                    @for ($i = 1; $i <= 10; $i++)
                                        <option value="{{ $i }}" {{ old('experience', $employeePost->experience) == $i ? 'selected' : '' }}>{{ $i }} Year</option>
                                    @endfor
                                    <option value="10_plus" {{ old('experience', $employeePost->experience) == '10_plus' ? 'selected' : '' }}>10+ Years</option>
                                </select>
                                @error('experience')
                                    <div class="text-danger">
                                       {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="keywords" class="mb-2">Keywords</label>
                                <input type="text" placeholder="Keywords" id="keywords" name="keywords" class="form-control" value="{{ old('keywords', $employeePost->keywords) }}">
                                @error('keywords')
                                    <div class="text-danger">
                                       {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <h3 class="fs-4 mb-4 mt-5 border-top pt-5">Company Details</h3>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="company_name" class="mb-2">Name <span class="text-danger">*</span></label>
                                    <input type="text" placeholder="Company Name" id="company_name" name="company_name" class="form-control" value="{{ old('company_name', $employeePost->company_name) }}">
                                    @error('company_name')
                                        <div class="text-danger">
                                           {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label for="company_location" class="mb-2">Location</label>
                                    <input type="text" placeholder="Location" id="company_location" name="company_location" class="form-control" value="{{ old('company_location', $employeePost->company_location) }}">
                                    @error('company_location')
                                        <div class="text-danger">
                                           {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="company_website" class="mb-2">Website</label>
                                <input type="text" placeholder="Website" id="company_website" name="company_website" class="form-control" value="{{ old('company_website', $employeePost->company_website) }}">
                                @error('company_website')
                                    <div class="text-danger">
                                       {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer p-4">
                            <button type="submit" class="btn btn-primary">Update Job</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</section>

@endsection
@section('customJs')
{{-- <script>
    $('.textarea').trumbowyg();
</script> --}}

@endsection
