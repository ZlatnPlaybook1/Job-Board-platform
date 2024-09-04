@extends('theme.master')

@section('content')
<style>
    body {
        font-family: 'Montserrat', sans-serif !important;
        background-color: #f8f9fa !important;
        color: #333 !important;
        line-height: 1.6 !important;
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
    .breadcrumb-item a:hover {
        text-decoration: underline;
    }
    .breadcrumb-item.active {
        color: #6c757d;
    }
</style>
<section class="section-5 bg-2">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">My Jobs</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                @include('theme.layout.sidebar')
            </div>
            <div class="col-lg-9">
                <div class="card border-0 shadow mb-4 p-3">
                    <div class="card-body card-form">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h3 class="fs-4 mb-1">My Jobs</h3>
                            </div>
                            <div style="margin-top: -10px;">
                                <a href="{{ route('employee_posts.create') }}" class="btn btn-primary">Post a Job</a>
                            </div>
                        </div>
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

                        <div class="table-responsive">
                            <table class="table">
                                <thead class="bg-light">
                                    <tr>
                                        <th scope="col">Title</th>
                                        <th scope="col">Job Created</th>
                                        <th scope="col">Applicants</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="border-0">
                                    @if($employeePosts->isNotEmpty())
                                        @foreach ($employeePosts as $employeePost)
                                            <tr class="active">
                                                <td>
                                                    <div class="job-name fw-500">{{ $employeePost->title }}</div>
                                                    <div class="info1">{{ $employeePost->employeeType->name }} . {{ $employeePost->location }}</div>
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($employeePost->created_at)->format('d M, Y') }}</td>
                                                <td>0 Applications</td>
                                                <td>
                                                    @if ($employeePost->status == 1)
                                                        <div class="job-status text-capitalize">Active</div>
                                                    @else
                                                        <div class="job-status text-capitalize">Blocked</div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="action-dots float-end">
                                                        <button href="#" class="btn" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                            <li><a class="dropdown-item" href="{{ route('jobs.deatail', $employeePost->id) }}"><i class="fa fa-eye" aria-hidden="true"></i> View</a></li>
                                                            <li><a class="dropdown-item" href="{{ route('employee_posts.edit', $employeePost->id) }}"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a></li>
                                                            <li>
                                                                <a class="dropdown-item" href="#" onclick="confirmDelete({{ $employeePost->id }})"><i class="fa fa-trash" aria-hidden="true"></i> Remove</a>
                                                                <form id="delete-form-{{ $employeePost->id }}" action="{{ route('employee_posts.destroy', $employeePost->id) }}" method="POST" style="display: none;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    @if(session('success'))
                                                                       <div class="alert alert-success">
                                                                           {{ session('success') }}
                                                                       </div>
                                                                    @endif
                                                                </form>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5" class="text-center">No job posts available</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        {{ $employeePosts->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title pb-0" id="exampleModalLabel">Change Profile Picture</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="image" class="form-label">Profile Image</label>
                        <input type="file" class="form-control" id="image" name="image">
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

@endsection
@section('customJs')
<script>
    function confirmDelete(id) {
        // Confirm with the user
        if (confirm('Are you sure you want to delete this job post?')) {
            // If confirmed, submit the delete form
            document.getElementById('delete-form-' + id).submit();
        }
    }
</script>
@endsection
