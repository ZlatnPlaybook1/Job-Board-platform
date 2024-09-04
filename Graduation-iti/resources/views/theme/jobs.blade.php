@extends('theme.master')

@section('content')
<style>
    .section-3 {
        background-color: #f7f9fc;
        padding: 50px 0;
    }
    .row h2{
        color: #007bff
    }
    .section-3 .card {
        border-radius: 10px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .section-3 .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .section-3 .card-body {
        padding: 20px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
    }

    .section-3 .card-body h3 {
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 10px;
        color: #333;
    }

    .section-3 .card-body p {
        font-size: 0.9rem;
        color: #555;
        flex-grow: 1;
        margin-bottom: 15px;
    }

    .section-3 .bg-light {
        background-color: #e9ecef !important;
        border-radius: 5px;
        padding: 10px;
        margin-bottom: 15px;
    }

    .section-3 .bg-light p {
        font-size: 0.85rem;
        color: #333;
    }

    .section-3 .btn-primary ,
    .section-3 .change-color{
        background-color: #007bff;
        border-color: #007bff;
        transition: background-color 0.3s ease, border-color 0.3s ease;
        align-self: flex-end;
    }

    .section-3 .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }
    .section-3 .change-color:hover{
        background-color: #0056b3;
        border-color: #004085
    }
    .sidebar .card {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
        padding: 20px;
    }

    .sidebar .card h2 {
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 20px;
        color: #333;
    }

    .sidebar .form-control {
        font-size: 0.9rem;
        border-radius: 5px;
        margin-bottom: 15px;
    }

    .sidebar .form-check-label {
        font-size: 0.9rem;
        color: #333;
    }

    .sidebar .form-check-input {
        margin-right: 10px;
    }

    /* Fixed Card Height and Suitable Size */
    .section-3 .job_lists .card {
        height: 100%; /* Ensure each card fills the column height */
    }

    .section-3 .job_lists .col-md-4 {
        display: flex;
        flex-direction: column;
    }

    .section-3 .job_lists .card-body {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
    }
</style>

<section class="section-3 py-5 bg-2">
    <div class="container">
        <div class="row">
            <div class="col-6 col-md-10">
                <h2>Find Jobs</h2>
            </div>
            <div class="col-6 col-md-2">
                <div class="align-end">
                    <select name="sort" id="sort" class="form-control">
                        <option value="1" {{ (request('sort') == '1') ? 'selected' : '' }}>Latest</option>
                        <option value="0" {{ (request('sort') == '0') ? 'selected' : '' }}>Oldest</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row pt-5">
            <div class="col-md-4 col-lg-3 sidebar mb-4">
                <form action="{{ route('jobs.search') }}" method="GET" name="searchForm" id="searchForm">
                    <div class="card border-0 shadow p-4">
                        <div class="mb-4">
                            <h2>Keywords</h2>
                            <input value="{{ Request::get('keyword') }}" type="text" name="keyword" id="keyword" placeholder="Keywords" class="form-control">
                        </div>

                        <div class="mb-4">
                            <h2>Location</h2>
                            <input value="{{ Request::get('location') }}" type="text" name="location" id="location" placeholder="Location" class="form-control">
                        </div>

                        <div class="mb-4">
                            <h2>Category</h2>
                            <select name="category" id="category" class="form-control">
                                <option value="">Select a Category</option>
                                @foreach($employee_classes as $class)
                                    <option value="{{ $class->id }}" {{ request('category') == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                                    {{-- <option value="{{ $class->id }}">{{ $class->name }}</option> --}}
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <h2>Job Type</h2>
                            @foreach($employ_types as $type)
                                <div class="form-check mb-2">
                                    <input class="form-check-input" name="job_type[]" type="checkbox" value="{{ $type->id }}" id="job_type{{ $type->id }}" {{ in_array($type->id, (array)request('job_type')) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="job_type{{ $type->id }}">{{ $type->name }}</label>
                                </div>
                            @endforeach
                        </div>

                        <div class="mb-4">
                            <h2>Experience</h2>
                            <select name="experience" id="experience" class="form-control">
                                <option value="">Select Experience</option>
                                @for ($i = 1; $i <= 10; $i++)
                                    <option value="{{ $i }}" {{ request('experience') == $i ? 'selected' : '' }}>
                                        {{ $i }} Year{{ $i > 1 ? 's' : '' }}
                                    </option>
                                @endfor
                                <option value="10_plus" {{ request('experience') == '10_plus' ? 'selected' : '' }}>
                                    10+ Years
                                </option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Search</button>
                        <a href="{{ route('jobs') }}" class="change-color w-100 btn btn-secondary mt-3">Reset</a>
                    </div>
                </form>
            </div>
            <div class="col-md-8 col-lg-9">
                <div class="job_listing_area">
                    <div class="job_lists">
                        <div class="row">
                            @if ($employment_posts->isNotEmpty())
                                @foreach ($employment_posts as $post)
                                <div class="col-md-4">
                                    <div class="card border-0 p-3 shadow mb-4">
                                        <div class="card-body">
                                            <h3 class="border-0 fs-5 pb-2 mb-0">{{ $post->title }}</h3>
                                            <p>{{ Str::words(strip_tags($post->description), 10, '...') }}</p>

                                            <div class="bg-light p-3 border">
                                                <p class="mb-0">
                                                    <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                                    <span class="ps-1">{{ $post->location }}</span>
                                                </p>
                                                <p class="mb-0">
                                                    <span class="fw-bolder"><i class="fa fa-clock-o"></i></span>
                                                    <span class="ps-1">{{ $post->employeeType->name }}</span>
                                                </p>
                                                <p>Keywords: {{ $post->keywords }}</p>
                                                <p>Experience: {{ $post->experience }}</p>
                                                @if (!is_null($post->salary))
                                                <p class="mb-0">
                                                    <span class="fw-bolder"><i class="fa fa-usd"></i></span>
                                                    <span class="ps-1">{{ $post->salary }}</span>
                                                </p>
                                                @endif
                                            </div>

                                            <div class="d-grid mt-3">
                                                <a href="{{ route('jobs.deatail' , $post->id )}}" class="btn btn-primary btn-lg">Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <div class="col-md-12">
                                    {{ $employment_posts->withQueryString()->links() }}
                                </div>
                            @else
                            <div class="col-md-12">Jobs not found</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('customJs')
<script>
   document.addEventListener('DOMContentLoaded', () => {
    const sortSelect = document.getElementById('sort');
    const searchForm = document.getElementById('searchForm');

    if (sortSelect) {
        sortSelect.addEventListener('change', () => {
            searchForm.submit();
        });
    }
    searchForm.addEventListener('submit', (event) => {
        event.preventDefault();

        // Check if 'sort' is selected, if not set it to 'Latest' (value '1')
        const formData = new FormData(searchForm);
        if (!formData.has('sort') || formData.get('sort') === '') {
            formData.set('sort', '1'); // '1' is the value for Latest
        }

        const queryString = new URLSearchParams(formData).toString();
        window.location.href = `${window.location.pathname}?${queryString}`;
    });
   });



</script>
@endsection
