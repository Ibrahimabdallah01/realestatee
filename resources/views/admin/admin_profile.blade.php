@extends('admin.admin_dashboard')

@section('admin_content')

    <!-- Start::app-content -->
    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <h3 class="page-title">Admin Profile</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Profile</li>
                    </ol>
                </nav>
            </div>
            <!-- Page Header Close -->

            @if(session('notification'))
                <div class="alert alert-{{ session('notification')['alert-type'] }} alert-dismissible fade show bg-white" role="alert">
                    {{ session('notification')['message'] }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row">
                <!-- Left Column -->
                <div class="col-lg-4">
                    <!-- Profile Card -->
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <img src="{{ (!empty(Auth::user()->photo)) ? url('upload/admin_images/'.Auth::user()->photo) : url('upload/no_image.jpg') }}" alt="Profile Picture" class="rounded-circle img-fluid mb-3" style="width: 150px;">
                            <h4 class="mb-1">{{ Auth::user()->name }}</h4>
                            <p class="text-muted mb-2">{{ Auth::user()->role }}</p>
                            <p class="text-muted mb-3">{{ Auth::user()->email }}</p>
                            <a href="{{ route('admin.profile.edit') }}" class="btn btn-primary">Edit Profile</a>
                        </div>
                    </div>

                    <!-- Personal Information Card -->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Personal Information</h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <strong>Name:</strong>
                                    <span>{{ Auth::user()->name }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <strong>Username:</strong>
                                    <span>{{ Auth::user()->username }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <strong>Email:</strong>
                                    <span>{{ Auth::user()->email }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <strong>Phone:</strong>
                                    <span>{{ Auth::user()->phone }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <strong>Address:</strong>
                                    <span>{{ Auth::user()->address }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <strong>Role:</strong>
                                    <span>{{ Auth::user()->role }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="col-lg-8">
                    <!-- About Card -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title mb-3">About</h5>
                            <p class="mb-0">Web Developer with over 3 years of experience. Experienced with all stages of the development cycle for dynamic web projects. Well-versed in numerous programming languages including HTML5, PHP OOP, JavaScript, CSS, MySQL.</p>
                            <div class="card-body">
                                <h5 class="card-title mb-3">Skills</h5>
                                <span class="badge bg-primary me-1 mb-1">HTML5</span>
                                <span class="badge bg-primary me-1 mb-1">CSS3</span>
                                <span class="badge bg-primary me-1 mb-1">JavaScript</span>
                                <span class="badge bg-primary me-1 mb-1">PHP</span>
                                <span class="badge bg-primary me-1 mb-1">MySQL</span>
                                <span class="badge bg-primary me-1 mb-1">Laravel</span>
                                <span class="badge bg-primary me-1 mb-1">Vue.js</span>
                                <span class="badge bg-primary me-1 mb-1">Git</span>
                            </div>
                        </div>
                    </div>

                    <!-- Experience Card -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card custom-card">
                                <div class="card-header">
                                    <h5 class="card-title">Edit Profile Information</h5>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('admin.profile.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row gy-4">
                                            <div class="col-xl-6">
                                                <label for="name" class="form-label">Name</label>
                                                <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}" placeholder="Enter Name">
                                            </div>
                                            <div class="col-xl-6">
                                                <label for="username" class="form-label">Username</label>
                                                <input type="text" class="form-control" id="username" name="username" value="{{ Auth::user()->username }}" placeholder="Enter Username">
                                            </div>
                                            <div class="col-xl-6">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" placeholder="Enter Email">
                                            </div>
                                            <div class="col-xl-6">
                                                <label for="phone" class="form-label">Phone</label>
                                                <input type="text" class="form-control" id="phone" name="phone" value="{{ Auth::user()->phone }}" placeholder="Enter Phone">
                                            </div>
                                            <div class="col-xl-12">
                                                <label for="address" class="form-label">Address</label>
                                                <input type="text" class="form-control" id="address" name="address" value="{{ Auth::user()->address }}" placeholder="Enter Address">
                                            </div>
                                            <div class="col-xl-6">
                                                <label for="profile_image" class="form-label">Profile Image</label>
                                                <input type="file" class="form-control" id="image" name="profile_image">
                                            </div>
                                            <div class="col-xl-6">
                                                <label class="form-label">Current Image</label>
                                                <div>
                                                    <img id="showImage" src="{{ (!empty(Auth::user()->photo)) ? url('upload/admin_images/'.Auth::user()->photo) : url('upload/no_image.jpg') }}" alt="Admin" class="img-thumbnail" style="width:100px; height: 100px;">
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <label for="password" class="form-label">Password</label>
                                                <input type="password" class="form-control" id="password" name="password" placeholder="Leave empty to keep current password">
                                            </div>
                                            <div class="col-xl-6">
                                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm new password">
                                            </div>
                                            <div class="col-xl-12">
                                                <button type="submit" class="btn btn-primary">Update Profile</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
    <!-- End::app-content -->

    <script type="text/javascript">
        $(document).ready(function(){
            $('#image').change(function(e){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#showImage').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>

@endsection
