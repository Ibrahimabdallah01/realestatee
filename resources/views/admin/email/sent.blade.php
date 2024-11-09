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

        <div class="page-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- Email Sidebar -->
                            <div class="row">
                                <div class="col-lg-3 border-end">
                                    <div class="email-sidebar">
                                        <div class="d-flex align-items-center justify-content-between mb-4">
                                            <div>
                                                <h4 class="mb-1">Mail Service</h4>
                                                <p class="text-muted mb-0">{{ Auth::user()->email }}</p>
                                            </div>
                                        </div>

                                        <div class="d-grid mb-4">
                                            <a href="{{ route('admin.email.composer') }}" class="btn btn-primary">
                                                <i data-feather="plus" class="me-2"></i> Compose Email
                                            </a>
                                        </div>

                                        <ul class="nav flex-column nav-pills">
                                            <li class="nav-item">
                                                <a href="#" class="nav-link d-flex align-items-center">
                                                    <i data-feather="inbox" class="me-2"></i>
                                                    <span>Inbox</span>
                                                    <span class="badge bg-primary ms-auto">2</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="{{ route('admin.email.sent') }}" class="nav-link active d-flex align-items-center">
                                                    <i data-feather="send" class="me-2"></i>
                                                    <span>Sent</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link d-flex align-items-center">
                                                    <i data-feather="file" class="me-2"></i>
                                                    <span>Drafts</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link d-flex align-items-center">
                                                    <i data-feather="trash" class="me-2"></i>
                                                    <span>Trash</span>
                                                </a>
                                            </li>
                                        </ul>

                                        <hr>

                                        <h6 class="text-uppercase text-muted mb-3">Labels</h6>
                                        <ul class="nav flex-column nav-pills">
                                            <li class="nav-item">
                                                <a href="#" class="nav-link d-flex align-items-center">
                                                    <span class="bullet bullet-success me-2"></span>
                                                    <span>Important</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link d-flex align-items-center">
                                                    <span class="bullet bullet-primary me-2"></span>
                                                    <span>Business</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link d-flex align-items-center">
                                                    <span class="bullet bullet-warning me-2"></span>
                                                    <span>Personal</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <!-- Email List -->
<div class="col-lg-9">
    <div class="card">
        <div class="card-header border-bottom p-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Sent Mail ({{ $totalEmails }})</h5>
                <a href="{{ route('admin.email.composer') }}" class="btn btn-primary btn-sm">
                    <i data-feather="plus" class="me-1"></i> Compose
                </a>
            </div>
        </div>

        <div class="card-body">
            @if($sentEmails->isEmpty())
                <div class="text-center py-5">
                    <i data-feather="mail" class="text-muted mb-3" style="width: 48px; height: 48px;"></i>
                    <h5>No sent emails</h5>
                    <p class="text-muted">Your sent emails will appear here</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Recipient</th>
                                <th>Subject</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sentEmails as $email)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-sm me-2">
                                                <span class="avatar-text rounded-circle bg-primary">
                                                    {{ substr($email->recipient_name, 0, 1) }}
                                                </span>
                                            </div>
                                            <div>
                                                {{ $email->recipient_name }}
                                                @if($email->cc_email)
                                                    <span class="badge bg-light text-dark ms-1">CC</span>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ Str::limit($email->subject, 50) }}</td>
                                    <td>{{ $email->sent_at->format('M d, h:i A') }}</td>
                                    <td>
                                        <a href="{{ route('admin.email.read', ['id' => $email->id]) }}" class="btn btn-sm btn-primary">
                                            <i data-feather="eye" class="me-1"></i> View
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if($sentEmails->hasPages())
                    <div class="d-flex justify-content-end mt-3">
                        {{ $sentEmails->links() }}
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>

<script>
    feather.replace(<script src="https://unpkg.com/feather-icons"></script>
    );
     // Initialize Feather icons
</script>

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
