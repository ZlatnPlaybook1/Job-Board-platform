@extends('theme.master')

@section('content')
<section class="section-5 bg-2">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index')}}">Home</a></li>
                        <li class="breadcrumb-item active">Users</li>
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
                                    <h3 class="fs-4 mb-1">Users</h3>
                                </div>
                                <div style="margin-top: -10px;">
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="bg-light">
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Mobile</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="border-0">
                                        @if($users->isNotEmpty())
                                            @foreach ($users as $user)
                                                <tr class="active">
                                                    <td>{{ $user->id }}</td>
                                                    <td>
                                                        <div class="job-name fw-500">{{ $user->name }}</div>
                                                    </td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->mobile }}</td>
                                                    <td>
                                                        <div class="action-dots">
                                                            <button class="btn" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                <li><a class="dropdown-item" href="{{ route('admin.users.edit', $user->id) }}"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a></li>
                                                                <li>
                                                                    <button class="dropdown-item" onclick="confirmDelete({{ $user->id }})">
                                                                        <i class="fa fa-trash" aria-hidden="true"></i> Remove
                                                                    </button>
                                                                    <form id="delete-form-{{ $user->id }}" action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display: none;">
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
                                        @else
                                            <tr>
                                                <td colspan="5" class="text-center">No users available</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            {{ $users->links('pagination::bootstrap-4') }}
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
