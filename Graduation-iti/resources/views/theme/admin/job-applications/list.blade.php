@extends('theme.master')

@section('content')
<style>
      .section-5 {
      background: #f9f9f9;
      padding-top: 30px;
  }

  .breadcrumb {
      background: #fff;
      border-radius: 0.5rem;
  }

  .breadcrumb-item a {
      color: #007bff;
      text-decoration: none;
  }

  .breadcrumb-item a:hover {
      text-decoration: underline;
  }

  .card-form {
      background: #ffffff;
      border-radius: 0.5rem;
  }

  .table {
      border-collapse: separate;
      border-spacing: 0;
  }

  .table thead {
      background: #e9ecef;
  }

  .table th, .table td {
      padding: 1rem;
      vertical-align: middle;
  }

  .table td {
      border-top: 1px solid #dee2e6;
  }

  .action-dots .btn {
      background: transparent;
      border: none;
      color: #007bff;
  }

  .action-dots .btn:hover {
      color: #0056b3;
  }

  .dropdown-menu {
      min-width: 150px;
      border-radius: 0.5rem;
  }

  .dropdown-item {
      font-size: 0.875rem;
  }

  .alert {
      margin-bottom: 1rem;
  }
</style>
<section class="section-5 bg-2">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index')}}">Home</a></li>
                        <li class="breadcrumb-item active">Jobs</li>
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
                    <div class="card border-0 shadow mb-4 p-3">
                        <div class="card-body card-form">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3 class="fs-4 mb-1">Job Applications</h3>
                                </div>
                                <div style="margin-top: -10px;">
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="bg-light">
                                        <tr>
                                            <th scope="col">Job Title</th>
                                            <th scope="col">User</th>
                                            <th scope="col">Employer</th>
                                            <th scope="col">Applied Date</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="border-0">
                                        @if ($applications->isNotEmpty())
                                            @foreach ($applications as $application )
                                                <tr>

                                                    <td>
                                                        <p>{{ $application->employeepost->title }}</p>
                                                        {{-- <p>Applicants :{{ $employeepost->applications->count() }}</p> --}}
                                                    </td>

                                                    <td>{{ $application->user->name }}</td>
                                                    <td>
                                                        {{ $application->occupation->name }}
                                                    </td>
                                                    <td>{{ \Carbon\Carbon::parse($application->applied_date)->format('d M ,Y') }}</td>
                                                    <td>
                                                        <div class="action-dots">
                                                            <button class="btn" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                <li>
                                                                    <button class="dropdown-item" onclick="confirmDelete({{ $application->id }})">
                                                                        <i class="fa fa-trash" aria-hidden="true"></i> Remove
                                                                    </button>
                                                                    <form id="delete-form-{{ $application->id }}" action="{{ route('admin.jobApplications.destroy' , $application->id )}}" method="POST" style="display: none;">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        @if(session('success'))
                                                                            <div class="alert alert-success">
                                                                                {{ session('success') }}
                                                                            </div>
                                                                        @endif
                                                                        @if(session('error'))
                                                                            <div class="alert alert-danger">
                                                                                {{ session('error') }}
                                                                            </div>
                                                                        @endif
                                                                    </form>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            {{ $applications->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function confirmDelete(userId) {
        if (confirm('Are you sure you want to delete this user?')) {
            document.getElementById('delete-form-' + userId).submit();
        }
    }
</script>
@endsection
