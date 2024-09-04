@extends('theme.master')
@section('content')
<style>
       body {
       font-family: 'Montserrat', sans-serif;
       color: #333;
       background-color: #f4f4f4;
       margin: 0;
       padding: 0;
   }

   .container {
       max-width: 1200px;
       margin: 0 auto;
   }

   nav[aria-label="breadcrumb"] {
       background-color: #fff;
       border-radius: 0.5rem;
       box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
       padding: 1rem 1.5rem;
       margin-bottom: 1.5rem;
   }

   .breadcrumb {
       margin-bottom: 0;
   }

   .breadcrumb-item a {
       color: #007bff;
       text-decoration: none;
   }

   .breadcrumb-item a:hover {
       text-decoration: underline;
   }

   .job_details_area {
       background-color: #fff;
       border-radius: 0.5rem;
       box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
       padding: 2rem;
   }

   .card {
       border: none;
       border-radius: 0.5rem;
       box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
   }

   .card .card-body {
       padding: 2rem;
   }

   .job_details_header {
       border-bottom: 1px solid #e9ecef;
       padding-bottom: 1rem;
       margin-bottom: 1rem;
   }

   .job_details_header h4 {
       margin: 0;
       font-size: 1.5rem;
   }

   .single_jobs {
       display: flex;
       justify-content: space-between;
       align-items: center;
   }

   .jobs_left {
       display: flex;
       align-items: center;
   }

   .jobs_content h4 {
       margin: 0;
       font-size: 1.25rem;
       color: #007bff;
   }

   .jobs_content h4:hover {
       color: #0056b3;
   }

   .links_locat {
       display: flex;
       gap: 1rem;
       font-size: 0.875rem;
   }

   .links_locat i {
       margin-right: 0.5rem;
   }

   .apply_now {
       text-align: right;
   }

   .heart_mark i {
       font-size: 1.25rem;
       color: #dc3545;
   }

   .descript_wrap {
       padding: 2rem;
   }

   .single_wrap {
       margin-bottom: 1.5rem;
   }

   .single_wrap h4 {
       font-size: 1.25rem;
       margin-bottom: 0.5rem;
   }

   .border-bottom {
       border-bottom: 1px solid #e9ecef;
       margin: 1.5rem 0;
   }

   .job_sumary {
       padding: 2rem;
   }

   .summery_header h3 {
       margin: 0;
       font-size: 1.5rem;
   }

   .job_content ul {
       list-style: none;
       padding: 0;
       margin: 0;
   }

   .job_content li {
       margin-bottom: 0.5rem;
   }

   .job_content span {
       font-weight: bold;
   }

   .job_content a {
       color: #007bff;
       text-decoration: none;
   }

   .job_content a:hover {
       text-decoration: underline;
   }

   @media (max-width: 768px) {
       .single_jobs {
           flex-direction: column;
           align-items: flex-start;
       }

       .jobs_right {
           margin-top: 1rem;
       }

       .job_details_area {
           padding: 1rem;
       }
   }
   /* Button Styles */
   .button {
       font-family: 'Montserrat', sans-serif !important;
       border-radius: 6px !important;
       padding: 12px 24px !important;
       border: none !important;
       font-size: 14px !important;
       font-weight: 600 !important;
       text-transform: uppercase !important;
       cursor: pointer !important;
       transition: background-color 0.3s ease !important, transform 0.3s ease !important;
       display: inline-flex !important;
       align-items: center !important;
       justify-content: center !important;
       outline: none !important;
   }

   /* Primary Button */
   .button-primary {
       background-color: #007bff !important;
       color: #fff !important;
       border: 1px solid #007bff !important;
   }

   .button-primary:hover {
       background-color: #0056b3 !important;
       transform: scale(1.05) !important;
   }

   /* Secondary Button */
   .button-secondary {
       background-color: #6c757d !important;
       color: #fff !important;
       border: 1px solid #6c757d !important;
   }

   .button-secondary:hover {
       background-color: #5a6268 !important;
       transform: scale(1.05) !important;
   }

   /* Disabled Button */
   .btn.disabled {
       background-color: #e9ecef !important;
       color: #6c757d !important;
       cursor: not-allowed !important;
       pointer-events: none !important;
       border: 1px solid #e9ecef !important;
   }

   /* Login Button Styles */
   .button-login {
       background-color: #dc3545 !important;
       color: #fff !important;
       border: 1px solid #dc3545 !important;
   }

   .button-login:hover {
       background-color: #c82333 !important;
       transform: scale(1.05) !important;
   }

   /* Adjustments for Button Containers */
   .botton-display {
       display: flex !important;
       justify-content: flex-end !important;
       gap: 12px !important;
       padding-top: 20px !important;
   }

   .button-container {
       display: flex !important;
       gap: 10px !important;
       align-items: center !important;
   }

</style>

<section class="section-4 bg-2">
    <div class="container pt-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class="rounded-3 p-3">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('jobs') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> &nbsp;Back to Jobs</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="container job_details_area">
        <div class="row pb-5">
            <div class="col-md-8">
                <!-- Session Messages -->
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                @if (session('info'))
                    <div class="alert alert-info" role="alert">
                        {{ session('info') }}
                    </div>
                @endif

                <!-- Job Details Card -->
                <div class="card shadow border-0">
                    <div class="job_details_header">
                        <div class="single_jobs white-bg d-flex justify-content-between">
                            <div class="jobs_left d-flex align-items-center">
                                <div class="jobs_content">
                                    <h4 class="jobtitle">{{ $employment_posts->title }}</h4>
                                    <div class="links_locat d-flex align-items-center">
                                        <div class="location">
                                            <p><i class="fa fa-map-marker"></i> {{ $employment_posts->location }}</p>
                                        </div>
                                        <div class="location">
                                            <p><i class="fa fa-clock-o"></i> {{ $employment_posts->employeeType->name }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="descript_wrap white-bg">
                        <div class="single_wrap">
                            <h4>Job Description</h4>
                            {!! nl2br(e($employment_posts->description)) !!}
                        </div>
                        @if (!empty($employment_posts->responsibility))
                        <div class="single_wrap">
                            <h4>Responsibility</h4>
                            {!! nl2br(e($employment_posts->responsibility)) !!}
                        </div>
                        @endif
                        @if (!empty($employment_posts->qualifications))
                        <div class="single_wrap">
                            <h4>Qualifications</h4>
                            {!! nl2br(e($employment_posts->qualifications)) !!}
                        </div>
                        @endif
                        @if (!empty($employment_posts->benefits))
                        <div class="single_wrap">
                            <h4>Benefits</h4>
                            {!! nl2br(e($employment_posts->benefits)) !!}
                        </div>
                        @endif

                        <div class="border-bottom"></div>
                        <!-- Buttons for Save and Apply -->
                        <div class="botton-display">
                            <!-- Save Job Form -->
                            <form action="{{ route('jobs.saveJob') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $employment_posts->id }}">
                                <div class="pt-3 text-end">
                                    @if (Auth::check())
                                        <button type="submit" class="btn button-secondary btn-secondary" name="action" value="save">Save</button>
                                    @else
                                        <button type="button" class="btn button-primary btn-primary disabled">Login to Save</button>
                                    @endif
                                </div>
                            </form>
                            <!-- Apply Job Form -->
                            <form action="{{ route('jobs.applyJob') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $employment_posts->id }}">
                                <div class="pt-3 text-end">
                                    @if (Auth::check())
                                        <button type="submit" class="btn button-primary btn-primary" name="action" value="apply">Apply</button>
                                    @else
                                        <button type="button" class="btn button-primary btn-primary disabled">Login to Apply</button>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Applicants Table -->
                @if (auth()->check() && auth()->user()->id == $employment_posts->user_id)
                <div class="card shadow border-0 mt-4">
                    <div class="job_details_header">
                        <h4>Applicants</h4>
                    </div>
                    <div class="descript_wrap white-bg">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Applied Date</th>

                                </tr>
                            </thead>
                            <tbody>
                                @if ($applications->isNotEmpty())
                                    @foreach ($applications as $application)
                                        <tr>
                                            <td>{{ $application->user->name }}</td>
                                            <td>{{ $application->user->email }}</td>
                                            <td>{{ $application->user->mobile }}</td>

                                            <td>{{ \Carbon\Carbon::parse($application->applied_date)->format('d M, Y') }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="3">No applications found.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
            </div>

            <!-- Job Summary and Company Details -->
            <div class="col-md-4">
                <div class="card shadow border-0">
                    <div class="job_sumary">
                        <div class="summery_header pb-1 pt-4">
                            <h3>Job Summary</h3>
                        </div>
                        <div class="job_content pt-3">
                            <ul>
                                <li>Published on: <span>{{ \Carbon\Carbon::parse($employment_posts->created_at)->format('d M, Y') }}</span></li>
                                <li>Vacancy: <span>{{ $employment_posts->vacancy }}</span></li>
                                @if (!empty($employment_posts->salary))
                                <li>Salary: <span>{{ $employment_posts->salary }}</span></li>
                                @endif
                                <li>Location: <span>{{ $employment_posts->location }}</span></li>
                                <li>Job Nature: <span>{{ $employment_posts->employeeType->name }}</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card shadow border-0 my-4">
                    <div class="job_sumary">
                        <div class="summery_header pb-1 pt-4">
                            <h3>Company Details</h3>
                        </div>
                        <div class="job_content pt-3">
                            <ul>
                                <li>Name: <span>{{ $employment_posts->company_name }}</span></li>
                                @if (!empty($employment_posts->company_location))
                                <li>Location: <span>{{ $employment_posts->company_location }}</span></li>
                                @endif
                                @if (!empty($employment_posts->company_website))
                                <li>Website: <span><a href="{{ $employment_posts->company_website }}" target="_blank">{{ $employment_posts->company_website }}</a></span></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection
