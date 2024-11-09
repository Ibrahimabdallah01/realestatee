@extends('admin.admin_dashboard')

@section('admin_content')

<!-- Start::app-content -->
<div class="main-content app-content">
    <div class="container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <h3 class="page-title">Email Composer</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Email Composer</li>
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

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <!-- Sidebar -->
                            <div class="col-lg-3 border-end-lg">
                                <div class="aside-content">
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <div>
                                            <h4 class="mb-0">Mail Service</h4>
                                            <p class="text-muted mb-0">amiahburton@gmail.com</p>
                                        </div>
                                        <button class="navbar-toggle btn btn-icon border d-lg-none" data-bs-target=".email-aside-nav" data-bs-toggle="collapse" type="button">
                                            <i data-feather="chevron-down"></i>
                                        </button>
                                    </div>
                                    <div class="d-grid mb-3">
                                        <a class="btn btn-primary" href="#">Compose Email</a>
                                    </div>
                                    <div class="email-aside-nav collapse d-lg-block">
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <a class="nav-link d-flex align-items-center" href="#">
                                                    <i data-feather="inbox" class="icon-lg me-2"></i>
                                                    Inbox
                                                    <span class="badge bg-danger fw-bolder ms-auto">2</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link d-flex align-items-center active" href="#">
                                                    <i data-feather="mail" class="icon-lg me-2"></i>
                                                    Sent Mail
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link d-flex align-items-center" href="#">
                                                    <i data-feather="star" class="icon-lg me-2"></i>
                                                    Important
                                                    <span class="badge bg-secondary fw-bolder ms-auto">4</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link d-flex align-items-center" href="#">
                                                    <i data-feather="file" class="icon-lg me-2"></i>
                                                    Drafts
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link d-flex align-items-center" href="#">
                                                    <i data-feather="trash" class="icon-lg me-2"></i>
                                                    Trash
                                                </a>
                                            </li>
                                        </ul>
                                        <p class="text-muted small fw-bold text-uppercase mt-4 mb-2">Labels</p>
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <a class="nav-link d-flex align-items-center" href="#">
                                                    <i data-feather="tag" class="text-warning icon-lg me-2"></i>
                                                    Important
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link d-flex align-items-center" href="#">
                                                    <i data-feather="tag" class="text-primary icon-lg me-2"></i>
                                                    Business
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link d-flex align-items-center" href="#">
                                                    <i data-feather="tag" class="text-info icon-lg me-2"></i>
                                                    Inspiration
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- Main Content -->
                            <div class="col-lg-9">
                                <div class="email-content">
                                    <div class="d-flex align-items-center p-3 border-bottom">
                                        <span data-feather="edit" class="icon-md me-2"></span>
                                        <h5 class="mb-0">New Message</h5>
                                    </div>
                                    <form action="{{ route('admin.email.send') }}" method="POST" class="p-3 border rounded shadow-sm">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="to" class="form-label fw-bold">Recipient</label>
                                            <select class="form-select" id="to" name="recipient_id" required>
                                                <option value="">Select recipient [Agent and User]</option>
                                                @foreach($getEmail as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }} => {{ $user->email }} - {{ $user->role }}</option>
                                                @endforeach
                                            </select>
                                            @error('recipient_id')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="cc-email" class="form-label fw-bold">Cc Email</label>
                                            <input type="email" class="form-control" id="cc-email" name="cc_email" placeholder="Cc email (optional)">
                                            @error('cc-email')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="subject" class="form-label fw-bold">Subject</label>
                                            <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" required>
                                            @error('subject')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="message" class="form-label fw-bold">Message</label>
                                            <textarea class="form-control" id="message" name="message" rows="10" placeholder="Write your message here..." required></textarea>
                                            @error('message')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <button type="button" class="btn btn-outline-secondary me-2" title="Attach files to your email">
                                                    <i data-feather="paperclip" class="icon-sm me-1"></i> Attach
                                                </button>
                                                <button type="button" class="btn btn-outline-secondary" title="Insert an image into your message">
                                                    <i data-feather="image" class="icon-sm me-1"></i> Insert Image
                                                </button>
                                            </div>
                                            <div>
                                                <button type="button" class="btn btn-light me-2">Save Draft</button>
                                                <button type="submit" class="btn btn-primary">Send</button>
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
</div>
<!-- End::app-content -->

@endsection
