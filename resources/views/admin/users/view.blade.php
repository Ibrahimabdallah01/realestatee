@extends('admin.admin_dashboard')

@section('admin_content')

<div class="main-content app-content">
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <h1 class="page-title fw-semibold fs-18 mb-0">View User</h1>
            <div class="ms-md-1 ms-0">
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.users.list') }}">Users</a></li>
                        <li class="breadcrumb-item active" aria-current="page">View User</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Page Header Close -->

        <!-- Start User Details -->
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">User Details</div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 text-center mb-4">
                        <img src="{{ (!empty($user->photo)) ? url('upload/admin_images/'.$user->photo) : url('upload/no_image.jpg') }}"
                             alt="{{ $user->name }}" class="img-fluid rounded-circle" style="width: 200px; height: 200px;">
                    </div>
                    <div class="col-md-8">
                        <table class="table table-bordered">
                            <tr>
                                <th>Name</th>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <th>Username</th>
                                <td>{{ $user->username }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td>{{ $user->phone }}</td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td>{{ $user->address }}</td>
                            </tr>
                            <tr>
                                <th>Role</th>
                                <td>
                                    @if($user->role == 'admin')
                                        <span class="badge bg-primary">{{ ucfirst($user->role) }}</span>
                                    @elseif($user->role == 'agent')
                                        <span class="badge bg-success">{{ ucfirst($user->role) }}</span>
                                    @else
                                        <span class="badge bg-secondary">{{ ucfirst($user->role) }}</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    @if($user->status)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary">Edit User</a>
                <a href="{{ route('admin.users.list') }}" class="btn btn-secondary">Back to List</a>
            </div>
        </div>
        <!-- End User Details -->
    </div>
</div>
@endsection
