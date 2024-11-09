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
                                        <a class="btn btn-primary" href="{{ route('admin.email.composer') }}">Compose Email</a>
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
                                                <a class="nav-link d-flex align-items-center" href="{{ route('admin.email.sent') }}">
                                                    <i data-feather="send" class="icon-lg me-2"></i>
                                                    Sent
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link d-flex align-items-center" href="{{ route('admin.email.drafts') }}">
                                                    <i data-feather="edit" class="icon-lg me-2"></i>
                                                    Drafts
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- Main Content -->
                            <div class="col-lg-9">
                                <div class="email-content">
                                    <div class="email-header d-flex align-items-center justify-content-between">
                                        <h4 class="mb-0">{{ $email->subject }}</h4>
                                        <div>
                                            <button class="btn btn-primary me-2">Reply</button>
                                            <button class="btn btn-outline-danger">Delete</button>
                                        </div>
                                    </div>
                                    <div class="email-body mt-4">
                                        <div class="sender-info mb-3">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('assets/images/avatar.jpg') }}" class="rounded-circle me-2" width="40" alt="sender">
                                                <div>
                                                    <h6 class="mb-0">{{ $email->from }}</h6>
                                                    <small class="text-muted">{{ $email->created_at->format('M d, Y h:i A') }}</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="email-content-body">
                                            {!! $email->body !!}
                                        </div>
                                        @if($email->attachments)
                                            <div class="email-attachments mt-4">
                                                <h6>Attachments</h6>
                                                <div class="row g-3">
                                                    @foreach($email->attachments as $attachment)
                                                        <div class="col-md-3">
                                                            <div class="attachment-box">
                                                                <i data-feather="file" class="icon-lg mb-2"></i>
                                                                <p class="mb-0">{{ $attachment->name }}</p>
                                                                <small>{{ $attachment->size }}</small>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
