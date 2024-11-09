@extends('admin.admin_dashboard')

@section('admin_content')


<!-- Start::app-content -->
<div class="main-content app-content">
    <div class="container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <h3 class="page-title">Users List</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Users List</li>
                    <li class="breadcrumb-item ms-auto">
                        <a href="{{ route('admin.users.add') }}" class="btn btn-primary btn-sm">
                            <i class="ri-add-line"></i> Add New User
                        </a>
                    </li>
                </ol>
            </nav>
        </div>
        <!-- Page Header Close -->

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif


        <div class="row">
            <div class="col-lg-12 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Search</h6>
                        <form action="{{ route('admin.users.search') }}" method="GET">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ request()->name }}" placeholder="Enter name" aria-label="Name">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="{{ request()->email }}" placeholder="Enter email" aria-label="Email">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label for="role" class="form-label">Role</label>
                                        <select class="form-select" id="role" name="role" aria-label="Role">
                                            <option value="">Select Role</option>
                                            <option value="admin" {{ request()->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                            <option value="agent" {{ request()->role == 'agent' ? 'selected' : '' }}>Agent</option>
                                            <option value="user" {{ request()->role == 'user' ? 'selected' : '' }}>User</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-12">
                                    <button class="btn btn-primary" type="submit">Search</button>
                                    <a href="{{ url("admin/users") }}" class="btn btn-danger">Reset</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Start User Table -->
        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Image</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>
                                    <img src="{{ !empty($user->photo) ? url('upload/admin_images/'.$user->photo) : url('upload/no_image.jpg') }}" alt="{{ $user->name }}" style="width: 50px; height: 50px;">
                                </td>
                                <td>
                                    @if($user->role == 'admin')
                                        <span class="badge bg-primary">{{ ucfirst($user->role) }}</span>
                                    @elseif($user->role == 'agent')
                                        <span class="badge bg-success">{{ ucfirst($user->role) }}</span>
                                    @else
                                        <span class="badge bg-secondary">{{ ucfirst($user->role) }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if($user->status)
                                        <span class="badge bg-success-gradient">Active</span>
                                    @else
                                        <span class="badge bg-danger-gradient">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.users.view', $user->id) }}"
                                        class="btn btn-icon btn-sm btn-primary-transparent rounded-pill me-1">
                                        <i class="ri-eye-line"></i>
                                    </a>
                                    <!-- Add any actions such as edit, delete, etc. -->
                                    <a href="{{ route('admin.users.edit', $user->id) }}"
                                        class="btn btn-icon btn-sm btn-info-transparent rounded-pill"><i
                                            class="ri-edit-line"></i></a>
                                    <a href="{{ route('admin.users.delete', $user->id) }}"
                                        class="btn btn-icon btn-sm btn-danger-transparent rounded-pill"><i
                                                class="ri-delete-bin-line"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- End User Table -->

        <!-- Pagination Links -->
        <div class="mt-3 d-flex justify-content-center">
            {{ $users->links('pagination::bootstrap-4') }}
        </div>


    </div>
</div>
@endsection
