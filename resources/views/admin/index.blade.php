@extends('admin.admin_dashboard')

@section('admin_content')

<!-- Start::app-content -->
<div class="main-content app-content">
    <div class="container-fluid">

        <!-- Start::page-header -->
        <div
            class="my-4 page-header-breadcrumb d-flex align-items-center justify-content-between flex-wrap gap-2">
            <div>
                <h1 class="page-title fw-medium fs-18 mb-2">Ecommerce</h1>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0);">
                            Dashboards
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Ecommerce</li>
                </ol>
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-white btn-wave border-0 me-0 fw-normal waves-effect waves-light">
                    <i class="ri-filter-3-fill me-2"></i>Filter
                </button>
                <button type="button" class="btn btn-primary btn-wave waves-effect waves-light">
                    <i class="ri-upload-2-line me-2"></i> Export report
                </button>
            </div>
        </div>
        <!-- End::page-header -->

        <!-- Start:: row-1 -->
        <div class="row">
            <div class="col-xxl-9">
                <div class="row">
                    <div class="col-xxl-3 col-xl-3 col-lg-6 col-sm-6">
                        <div class="card custom-card">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-start justify-content-between">
                                    <div class="main-card-icon primary mb-4">
                                        <div class="avatar avatar-lg bg-primary border border-primary border-opacity-10">
                                            <div class="avatar avatar-sm bg-white-transparent svg-white">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                                                    <rect width="256" height="256" fill="none" />
                                                    <circle cx="128" cy="96" r="64" opacity="0.2" />
                                                    <path d="M208,144c0,45.42-35.82,80-80,80s-80-34.58-80-80" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                                                    <circle cx="128" cy="96" r="64" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ms-1">
                                        <span class="d-block mb-2 text-muted">Total Users</span>
                                        <h4 class="fw-semibold mb-0">{{ number_format($totalUsers ?? 0) }}</h4>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mt-3">
                                    <span class="badge bg-success-transparent">
                                        <i class="ti ti-trending-up me-1"></i>2.5%
                                    </span>
                                    <span class="fs-12 text-muted ms-2">Since last month</span>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Canvas for the Chart -->
<div class="col-xxl-12 col-xl-12">
    <div class="card custom-card">
        <div class="card-header">
            <h6 class="card-title mb-0">User Registrations</h6>
        </div>
        <div class="card-body">
            <canvas id="registrationChart" width="400" height="200"></canvas>
        </div>
    </div>
</div>

                </div>
            </div>
            <div class="col-xxl-3">
                <div class="row">
                    <div class="col-xxl-12 col-xl-12">
                        <div class="card custom-card card-bg-primary ecommerce-card">
                            <div class="card-header border-bottom-0">
                                <div class="card-title text-fixed-white">
                                    Sales Overview
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="d-flex align-items-start gap-3 px-3">
                                    <div class="main-card-icon secondary p-0">
                                        <div
                                            class="avatar avatar-lg p-2 bg-white-transparent svg-white shadow-sm">
                                            <div class="avatar avatar-sm svg-white">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                                    fill="#000000" viewBox="0 0 256 256">
                                                    <path d="M96,40l33.52,88H56Zm104,88H129.52L160,208Z"
                                                        opacity="0.2"></path>
                                                    <path
                                                        d="M240,128a8,8,0,0,1-8,8H204.94l-37.78,75.58A8,8,0,0,1,160,216h-.4a8,8,0,0,1-7.08-5.14L95.35,60.76,63.28,131.31A8,8,0,0,1,56,136H24a8,8,0,0,1,0-16H50.85L88.72,36.69a8,8,0,0,1,14.76.46l57.51,151,31.85-63.71A8,8,0,0,1,200,120h32A8,8,0,0,1,240,128Z">
                                                    </path>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-fill">
                                        <div class="mb-2">Total Sales</div>
                                        <div class="text-muted mb-0 fs-12 d-flex align-items-center">
                                            <h5 class="fs-4 mb-0 flex-fill fw-medium text-fixed-white">
                                                12,564
                                            </h5>
                                            <a href="javascript:void(0)" class="text-primary fw-semibold">View
                                                All <i class="fe fe-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div id="audience-report"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-12 col-xl-12">
                        <div class="card custom-card overflow-hidden">
                            <div class="card-header justify-content-between">
                                <div class="card-title">
                                    Recent Orders
                                </div>
                                <div class="dropdown">
                                    <a href="javascript:void(0);" class="p-2 fs-12 text-muted" data-bs-toggle="dropdown"
                                        aria-expanded="true"> Sort By <i
                                            class="ri-arrow-down-s-line align-middle ms-1 d-inline-block"></i> </a>
                                    <ul class="dropdown-menu" role="menu"
                                        style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate(0px, 28px);"
                                        data-popper-placement="bottom-end">
                                        <li><a class="dropdown-item" href="javascript:void(0);">This Week</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);">Last Week</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);">This Month</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="circle-container">
                                    <div id="recent-orders" class="p-3"></div>
                                    <div class="accets-circle-style"></div>
                                </div>
                                <div class="row mt-0">
                                    <div class="col-4 border-end border-inline-end-dashed text-center">
                                        <p class="text-muted mb-1 fs-12">Delivered</p>
                                        <h6 class="fw-semibold">65.7%</h6>
                                    </div>
                                    <div class="col-4 border-end border-inline-end-dashed text-center">
                                        <p class="text-muted mb-1 fs-12">Cancelled</p>
                                        <h6 class="fw-semibold">23.2%</h6>
                                    </div>
                                    <div class="col-4 text-center">
                                        <p class="text-muted mb-1 fs-12">Pending</p>
                                        <h6 class="fw-semibold">10.5%</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End:: row-1 -->



    </div>
</div>
<!-- End::app-content -->




<script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Add this if Chart.js is not included -->

<script>
    document.addEventListener('DOMContentLoaded', function() {
        fetch('{{ route('admin.registration.chart') }}')
            .then(response => response.json())
            .then(data => {
                const ctx = document.getElementById('registrationChart').getContext('2d');
                const registrationChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: data.labels,
                        datasets: [{
                            label: 'User Registrations',
                            data: data.data,
                            backgroundColor: 'rgba(75, 192, 192, 0.6)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 2,
                            borderRadius: 5,
                            hoverBackgroundColor: 'rgba(75, 192, 192, 0.8)'
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: true,
                                position: 'top',
                                labels: {
                                    font: {
                                        size: 14,
                                        weight: 'bold'
                                    }
                                }
                            },
                            title: {
                                display: true,
                                text: 'Monthly User Registrations',
                                font: {
                                    size: 18,
                                    weight: 'bold'
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 1,
                                    font: {
                                        size: 12
                                    }
                                },
                                grid: {
                                    color: 'rgba(0, 0, 0, 0.1)'
                                }
                            },
                            x: {
                                ticks: {
                                    font: {
                                        size: 12
                                    }
                                },
                                grid: {
                                    display: false
                                }
                            }
                        },
                        animation: {
                            duration: 1500,
                            easing: 'easeInOutQuart'
                        },
                        hover: {
                            mode: 'index',
                            intersect: false
                        },
                        tooltips: {
                            mode: 'index',
                            intersect: false
                        }
                    }
                });
            })
            .catch(error => console.error('Error:', error));
    });
</script>



@endsection
