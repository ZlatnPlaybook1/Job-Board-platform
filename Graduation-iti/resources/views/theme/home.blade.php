@extends('theme.master')

@section('content')

  <section class="section-0 lazy d-flex bg-image-style dark align-items-center "   class="" data-bg="{{ asset('assets') }}/images/banner4.jpg">
    <div class="container">
        <div class="row">
            <div class="col-12 col-xl-8">
                <h1>Find your dream job</h1>
                <p>Thounsands of jobs available.</p>
                <div class="banner-btn mt-5"><a href="#" class="btn botton btn-primary mb-4 mb-sm-0">Explore Now</a></div>
            </div>
        </div>
    </div>
  </section>
  <section class="section-1 py-5 ">
    <div class="container">
        <div class="card border-0 shadow p-5">
            <form action="{{ route('jobs')}}" method="GET">
              <div class="row">
                  <div class="col-md-3 mb-3 mb-sm-3 mb-lg-0">
                      <input type="text" class="form-control" name="keyword" id="keyword" placeholder="Keywords">
                  </div>
                  <div class="col-md-3 mb-3 mb-sm-3 mb-lg-0">
                      <input type="text" class="form-control" name="location" id="location" placeholder="Location">
                  </div>
                  <div class="col-md-3 mb-3 mb-sm-3 mb-lg-0">
                    <select name="category" id="category" class="form-control">
                        <option value="">Select a Category</option>
                        @foreach($employee_classes as $class)
                            <option value="{{ $class->id }}" {{ request('category') == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                            {{-- <option value="{{ $class->id }}">{{ $class->name }}</option> --}}
                        @endforeach
                    </select>
                  </div>
                  <div class=" col-md-3 mb-xs-3 mb-sm-3 mb-lg-0">
                      <div class="d-grid gap-2">
                          {{-- <a href="route()" class="btn btn-primary btn-block">Search</a> --}}
                          <button type="submit" class="btn botton btn-primary btn-block">Search</button>
                      </div>
                  </div>
              </div>
           </form>
        </div>
    </div>
  </section>
   <section class="section-2 bg-2 py-5">
    <div class="container">
        <h2>Popular Categories</h2>
        <div class="row pt-5">
            @foreach($employee_classes as $employee_class)
              <div class="col-lg-4 col-xl-3 col-md-6">
                  <div class="single_catagory">
                      <a href="{{ route('jobs').'?category='.$employee_class->id }}"><h4 class="pb-2">{{ $employee_class->name }}</h4></a>
                      <p class="mb-0"> <span>{{ rand(10, 100) }}</span> Available position</p>
                  </div>
              </div>
            @endforeach
        </div>
    </div>
   </section>

   <section class="section-3 py-5">
    <div class="container">
        <h2>Featured Jobs</h2>
        <div class="row pt-5">
            <div class="job_listing_area">
                <div class="job_lists">
                    <div class="row">
                        @foreach ($featuredJobs as $job)
                            <div class="col-md-4">
                                <div class="card border-0 p-3 shadow mb-4">
                                    <div class="card-body">
                                        <h3 class="border-0 fs-5 pb-2 mb-0">{{ $job->title }}</h3>
                                        <p>{{ Str::words(strip_tags($job->description ), 10 ) }}</p>
                                        <div class="bg-light p-3 border">
                                            <p class="mb-0">
                                                <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                                <span class="ps-1">{{ $job->location }}</span>
                                            </p>
                                            <p class="mb-0">
                                                <span class="fw-bolder"><i class="fa fa-clock-o"></i></span>
                                                <span class="ps-1">{{ $job->employeeType->name }}</span>
                                            </p>
                                            @if(!is_null($job->salary))
                                            <p class="mb-0">
                                                <span class="fw-bolder"><i class="fa fa-usd"></i></span>
                                                <span class="ps-1">{{ $job->salary }}</span>
                                            </p>
                                            @endif
                                        </div>
                                        <div class="d-grid mt-3">
                                            <a href="{{ route('jobs.deatail' , $job->id )}}" class="btn botton btn-primary btn-lg">Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
   </section>

   <section class="section-3 bg-2 py-5">
    <div class="container">
        <h2>Latest Jobs</h2>
        <div class="row pt-5">
            <div class="job_listing_area">
                <div class="job_lists">
                    <div class="row">
                        @foreach ($latestJobs as $job)
                            <div class="col-md-4">
                                <div class="card border-0 p-3 shadow mb-4">
                                    <div class="card-body">
                                        <h3 class="border-0 fs-5 pb-2 mb-0">{{ $job->title }}</h3>
                                        <p>{{ Str::words($job->description, 10) }}</p>
                                        <div class="bg-light p-3 border">
                                            <p class="mb-0">
                                                <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                                <span class="ps-1">{{ $job->location }}</span>
                                            </p>
                                            <p class="mb-0">
                                                <span class="fw-bolder"><i class="fa fa-clock-o"></i></span>
                                                <span class="ps-1">{{ $job->employeeType->name ?? 'N/A' }}</span>
                                            </p>
                                            @if(!is_null($job->salary))
                                            <p class="mb-0">
                                                <span class="fw-bolder"><i class="fa fa-usd"></i></span>
                                                <span class="ps-1">{{ $job->salary }}</span>
                                            </p>
                                            @endif
                                        </div>
                                        <div class="d-grid mt-3">
                                            <a href="{{ route('jobs.deatail' , $job->id )}}" class="btn botton btn-primary btn-lg">Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
   </section>

<style>
  .section-0 {
    background: url('{{ asset('assets') }}/images/banner5.jpg') no-repeat center center;
    background-size: cover;
    color: #fff;
  }
  .section-0 h1 {
    font-size: 3rem !important;
    font-weight: 700 !important;
  }
  .section-0 p {
    font-size: 1.25rem !important;
  }
  .banner-btn .btn-primary,
  .botton {
    background-color: #007bff !important;
    border-color: #007bff !important;
    border-radius: 0.25rem !important;
  }
  .section-1 h2::after,
  .section-2 h2::after,
  .section-3 h2::after {
    content: none;
  }
  .section-1 {
    background-color: #f8f9fa !important;
  }

  .card {
    border-radius: 0.75rem !important;
  }

  .form-control {
    border-radius: 0.25rem !important;
    box-shadow: none !important;
  }

  .section-2 {
    background-color: #f0f4f8 !important;
    padding: 3rem 0 !important;
  }

  .section-2 h2 {
    font-size: 2rem !important;
    font-weight: 700 !important;
    color: #333 !important;
    text-align: center !important;
    margin-bottom: 2rem !important;
  }

  .single_catagory {
    background-color: #ffffff !important;
    border-radius: 0.75rem !important;
    padding: 1.5rem !important;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1) !important;
    transition: transform 0.3s ease, box-shadow 0.3s ease !important;
  }

  .single_catagory:hover {
    transform: translateY(-5px) !important;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15) !important;
  }

  .single_catagory h4 {
    font-size: 1.25rem !important;
    font-weight: 600 !important;
    color: #007bff !important;
    margin-bottom: 0.75rem !important;
  }

  .single_catagory p {
    color: #555 !important;
    font-size: 0.875rem !important;
    margin-bottom: 0 !important;
  }

  .section-3 {
    padding: 3rem 0 !important;
  }

  .section-3 h2 {
    font-size: 2rem !important;
    font-weight: 700 !important;
    color: #333 !important;
    text-align: center !important;
    margin-bottom: 2rem !important;
    border: none !important;
  }

  .job_listing_area {
    margin-top: 2rem !important;
  }

  .job_lists {
    display: flex;
    flex-wrap: wrap !important;
    gap: 1.5rem !important;
  }

  .card {
    border: none !important;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1) !important;
    transition: transform 0.3s ease, box-shadow 0.3s ease !important;
    overflow: hidden !important;
    flex: 1 1 calc(33.333% - 1.5rem) !important;
  }

  .card:hover {
    transform: translateY(-10px) !important;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2) !important;
  }

  .card-body {
    padding: 1.5rem !important;
  }

  .card-body h3 {
    font-size: 1.25rem !important;
    font-weight: 600 !important;
    color: #333 !important;
  }

  .card-body p {
    color: #555 !important;
    line-height: 1.6 !important;
  }

  .card-body .bg-light {
    background-color: #f8f9fa !important;
    padding: 1rem !important;
    border-radius: 0.5rem !important;
  }

  .d-grid .botton,
  .botton {
    border-radius: 0.5rem !important;
    padding: 0.75rem 1.5rem !important;
    font-size: 1rem !important;
    transition: background-color 0.3s ease !important;
  }

  .d-grid .botton:hover,
  .botton:hover {
    background-color: #0056b3 !important;
    border-color: #0056b3 !important;
  }

  .card-body img {
    max-width: 100% !important;
    height: auto !important;
    border-radius: 0.5rem !important;
    margin-bottom: 1rem !important;
  }

  .card-body .card-details {
    margin-top: auto !important;
  }

  .card-body .card-info {
    margin-bottom: 1rem !important;
  }

  .card-body .card-info p {
    margin: 0 !important;
  }

  .card-body .content-wrapper {
    display: flex;
    flex-direction: column;
    flex-grow: 1;
  }
</style>


@endsection
