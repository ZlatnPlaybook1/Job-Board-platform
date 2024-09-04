<div class="card border-0 shadow mb-4 p-3">
    <div class="s-body text-center mt-3">
        @if (Auth::user()->image != '')
           <img src="{{ asset('profilePic/'.auth()->user()->image) }}" alt="photo"  class="rounded-circle img-fluid" style="width: 150px;">
        @else
           <img src="{{ asset('assets') }}/images/avatar7.png" alt="avatar"  class="rounded-circle img-fluid" style="width: 150px;">
        @endif
        <h5 class="mt-3 pb-0">{{ Auth::user()->name }}</h5>
        <p class="text-muted mb-1 fs-6">{{ Auth::user()->designation }}</p>
        <div class="d-flex justify-content-center mb-2">
            <button data-bs-toggle="modal" data-bs-target="#exampleModal" type="button" class="btn btn-primary">Change Profile Picture</button>
        </div>
    </div>
</div>

<div class="card account-nav border-0 shadow mb-4 mb-lg-0">
    <div class="card-body p-0">
        <ul class="list-group list-group-flush ">
            <li class="list-group-item d-flex justify-content-between p-3">
                <a href="{{ route('account.profile')}}">Account Settings</a>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <a href="{{ route('employee_posts.create')}}">Post a Job</a>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <a href="{{ route('account.employmentJobs')}}">My Jobs</a>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <a href="{{ route('account.myJobsApplication')}}">Jobs Applied</a>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <a href="{{ route('account.savedJobs')}}">Saved Jobs</a>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <a href="{{ route('account.logout')}}">Logout</a>
            </li>
        </ul>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title pb-0" id="exampleModalLabel">Change Profile Picture</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="profilePicForm" name="profilePicForm" action="{{ route('account.updateProfilePic') }}" method="POST" enctype="multipart/form-data">
            @csrf
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

            <div class="mb-3">
              <label for="image" class="form-label">Profile Image</label>
              <input type="file" class="form-control" id="image" name="image">
              @error('image')
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

            <div class="d-flex justify-content-end">
              <button type="submit" class="btn btn-primary mx-3">Update</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>
</div>

<style>
    /* Card Styles */
    .card {
        border: none !important;
        border-radius: 0.5rem !important;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1) !important;
    }

    .card-body {
        padding: 1.5rem !important;
    }

    .s-body img {
        border-radius: 50% !important;
        width: 150px !important;
        height: 150px !important;
        object-fit: cover !important;
    }

    .card h5 {
        font-size: 1.25rem !important;
        font-weight: 600 !important;
    }

    .card p {
        color: #6c757d !important;
        font-size: 0.875rem !important;
    }

    /* Button Styles */
    .btn-primary {
        border-radius: 25px !important;
        padding: 0.5rem 1.5rem !important;
        font-size: 0.875rem !important;
        background-color: #007bff !important;
        color: #ffffff !important;
        border: 2px solid #007bff !important;
        transition: background-color 0.3s ease, color 0.3s ease !important;
    }

    .btn-primary:hover {
        background-color: #0056b3 !important;
        color: #ffffff !important;
        border-color: #0056b3 !important;
    }

    .modal .btn-primary {
        background-color: #28a745 !important; /* Updated color for "Update" button */
        border-color: #28a745 !important;
    }

    .modal .btn-primary:hover {
        background-color: #218838 !important; /* Hover color for "Update" button */
        border-color: #218838 !important;
    }

    .modal .btn-secondary {
        background-color: #6c757d !important; /* Updated color for "Close" button */
        border-color: #6c757d !important;
        color: #ffffff !important;
    }

    .modal .btn-secondary:hover {
        background-color: #5a6268 !important; /* Hover color for "Close" button */
        border-color: #5a6268 !important;
    }

    .btn-secondary {
        border-radius: 25px !important;
        padding: 0.5rem 1rem !important;
    }

    .btn-secondary:hover {
        background-color: #e9ecef !important;
        color: #212529 !important;
    }

    /* Modal Styles */
    .modal-content {
        border-radius: 0.5rem !important;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2) !important;
    }

    .modal-header {
        border-bottom: none !important;
    }

    .modal-title {
        font-size: 1.25rem !important;
        font-weight: 600 !important;
    }

    /* Form Styles */
    .form-control {
        border-radius: 0.25rem !important;
        border: 1px solid #ced4da !important;
    }

    .form-label {
        font-weight: 500 !important;
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

    /* Account Nav Styles */
    .account-nav .list-group-item {
        border: none !important;
        border-bottom: 1px solid #e9ecef !important;
    }

    .account-nav a {
        color: #007bff !important;
        font-weight: 500 !important;
        text-decoration: none !important;
    }

    .account-nav a:hover {
        color: #0056b3 !important;
        text-decoration: underline !important;
    }

</style>
