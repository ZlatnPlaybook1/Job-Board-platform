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
                        <li class="breadcrumb-item active">Saved Jobs</li>
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
                                <h3 class="fs-4 mb-1">Saved Jobs</h3>
                            </div>
                        </div>
                        <!-- Flash Messages -->
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @elseif(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <!-- End Flash Messages -->
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="bg-light">
                                    <tr>
                                        <th scope="col">Title</th>
                                        <th scope="col">Applicants</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="border-0">
                                    @if($savedJobs->isNotEmpty())
                                        @foreach ($savedJobs as $savedJob)
                                            <tr>
                                                <td>
                                                    <div class="job-name fw-500">{{ $savedJob->employeePost->title }}</div>
                                                    <div class="info1">{{ $savedJob->employeePost->employeeType->name }} . {{ $savedJob->employeePost->location }}</div>
                                                </td>
                                                <td>{{ $savedJob->employeePost->applications->count() }} Applications</td>
                                                <td>
                                                    @if ($savedJob->employeePost->status == 1)
                                                        <div class="job-status text-capitalize">Active</div>
                                                    @else
                                                        <div class="job-status text-capitalize">Blocked</div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="action-dots">
                                                        <button class="btn" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                            <li><a class="dropdown-item" href="{{ route('jobs.deatail', $savedJob->employeePost->id) }}"><i class="fa fa-eye" aria-hidden="true"></i> View</a></li>
                                                            <li>
                                                                <a class="dropdown-item" href="#" onclick="confirmDelete({{ $savedJob->id }})"><i class="fa fa-trash" aria-hidden="true"></i> Remove</a>
                                                                <form id="delete-form-{{ $savedJob->id }}" action="{{ route('account.deleteSavedJobs', $savedJob->id) }}" method="POST" style="display: none;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                </form>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4" class="text-center">No saved jobs available</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        {{ $savedJobs->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('customJs')
<script>
    function confirmDelete(id) {
        if (confirm('Are you sure you want to delete this saved job?')) {
            document.getElementById('delete-form-' + id).submit();
        }
    }
</script>
@endsection
