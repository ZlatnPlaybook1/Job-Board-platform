<header>
    <nav class="navbar navbar-expand-lg navbar-light custom-navbar py-3">
        <div class="container">
            <a class="navbar-brand custom-brand" href="{{ route('home') }}">Human Resources Manager</a>
            <button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('jobs') }}">Find Jobs</a>
                    </li>
                </ul>
                <div class="d-flex">
                    @if(!Auth::check())
                        <a class="btn btn-outline-primary custom-btn" href="{{ route('account.login') }}">Login</a>
                    @else
                        @if (Auth::user()->role == 'admin')
                            <a class="btn btn-outline-primary custom-btn" href="{{ route('admin.index') }}">Admin</a>
                        @endif
                        <a class="btn btn-outline-primary custom-btn" href="{{ route('account.profile') }}">Account</a>
                    @endif
                    <a class="btn btn-primary custom-btn" href="{{ route('employee_posts.create') }}">Post a Job</a>
                </div>
            </div>
        </div>
    </nav>
</header>


<style>
    .custom-navbar {
        background-color: #f8f9fa !important;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1) !important;
    }
    .custom-brand {
        font-weight: 700 !important;
        color: #007bff !important;
        font-size: 1.5rem !important;
        transition: color 0.3s ease, text-decoration 0.3s ease !important;
    }
    .custom-toggler {
        border: none !important;
        background-color: transparent !important;
    }
    .custom-btn {
        border-radius: 50px !important;
        padding: 0.5rem 1.5rem !important;
        font-size: 0.875rem !important;
        transition: background-color 0.3s ease, color 0.3s ease !important;
        border: 2px solid #007bff !important;
        color: #007bff !important;
        background-color: #ffffff !important;
    }
    .nav-link.active {
        font-weight: 600 !important;
        color: #0056b3 !important;
    }
    .navbar-nav .nav-item .nav-link {
        margin-right: 1rem !important;
    }
    .custom-nav-link {
        position: relative !important;
        color: #007bff !important;
        transition: color 0.3s ease, background-color 0.3s ease !important;
        font-weight: 500 !important;
    }
    .custom-nav-link:hover {
        color: #ffffff !important;
        background-color: #0056b3 !important;
        border-radius: 0.25rem !important;
        padding: 0.5rem 1rem !important;
    }
    .custom-btn:hover {
        background-color: #007bff !important;
        color: #ffffff !important;
        border-color: #007bff !important;
    }
    .custom-brand:hover {
        color: #0056b3 !important;
        text-decoration: underline !important;
    }
    .custom-nav-link:hover,
    .custom-btn:hover {
        cursor: pointer !important;
    }

</style>
