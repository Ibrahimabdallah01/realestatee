<!-- app-header -->
<header class="app-header sticky" id="header">

    <!-- Start::main-header-container -->
    <div class="main-header-container container-fluid">

        <!-- Start::header-content-left -->
        <div class="header-content-left">

            <!-- Start::header-element -->
            <div class="header-element">
                <div class="horizontal-logo">
                    <a href="index.html" class="header-logo">
                        <img src="../assets/images/brand-logos/desktop-logo.png" alt="logo" class="desktop-logo">
                        <img src="../assets/images/brand-logos/toggle-logo.png" alt="logo" class="toggle-logo">
                        <img src="../assets/images/brand-logos/desktop-dark.png" alt="logo" class="desktop-dark">
                        <img src="../assets/images/brand-logos/toggle-dark.png" alt="logo" class="toggle-dark">
                    </a>
                </div>
            </div>
            <!-- End::header-element -->

            <!-- Start::header-element -->
            <div class="header-element mx-lg-0 mx-2">
                <a aria-label="Hide Sidebar"
                    class="sidemenu-toggle header-link animated-arrow hor-toggle horizontal-navtoggle"
                    data-bs-toggle="sidebar" href="javascript:void(0);"><span></span></a>
            </div>
            <!-- End::header-element -->
        </div>
        <!-- End::header-content-left -->

        <!-- Start::header-content-right -->
        <ul class="header-content-right">


            <!-- Start::header-element -->
            <li class="header-element dropdown">
                <!-- Start::header-link|dropdown-toggle -->
                <a href="javascript:void(0);" class="header-link dropdown-toggle" id="mainHeaderProfile"
                    data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                    <div class="d-flex align-items-center">
                        <div class="me-xl-2 me-0 lh-1 d-flex align-items-center ">
                            <span class="avatar avatar-xs avatar-rounded bg-primary-transparent">
                                <img src="{{ (!empty(Auth::user()->photo)) ? url('upload/admin_images/'.Auth::user()->photo) : url('upload/no_image.jpg') }}" alt="{{ Auth::user()->name }}">
                            </span>
                        </div>
                        <div class="d-xl-block d-none lh-1">
                            <span class="fw-medium lh-1">{{ Auth::user()->name }}</span>
                        </div>
                    </div>
                </a>
                <!-- End::header-link|dropdown-toggle -->
                <ul class="main-header-dropdown dropdown-menu pt-0 overflow-hidden header-profile-dropdown dropdown-menu-end"
                    aria-labelledby="mainHeaderProfile">
                    <li class="border-bottom"><a class="dropdown-item d-flex flex-column" href="{{ route('admin.profile.edit') }}"><span
                                class="fs-12 text-muted">Wellcome!</span><span class="fs-14">{{ Auth::user()->username }}</span></a>
                    </li>
                    <li><a class="dropdown-item d-flex align-items-center" href="{{ route('admin.profile') }}"><i
                                class="ti ti-user me-2 fs-18 text-primary"></i>Profile</a></li>
                    <li><a class="dropdown-item d-flex align-items-center" href="mail.html"><i
                                class="ti ti-mail me-2 fs-18 text-primary"></i>Inbox</a></li>
                    <li><a class="dropdown-item d-flex align-items-center" href="to-do-list.html"><i
                                class="ti ti-checklist me-2 fs-18 text-primary"></i>Task Manager</a></li>
                    <li><a class="dropdown-item d-flex align-items-center" href="mail-settings.html"><i
                                class="ti ti-settings me-2 fs-18 text-primary"></i>Settings</a></li>
                    <li><a class="dropdown-item d-flex align-items-center" href="chat.html"><i
                                class="ti ti-headset me-2 fs-18 text-primary"></i>Support</a></li>
                    <li>
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.logout') }}"
                               onclick="event.preventDefault(); this.closest('form').submit();">
                                <i class="ti ti-logout me-2 fs-18 text-primary"></i>Log Out
                            </a>
                        </form>
                    </li>
                </ul>
            </li>
            <!-- End::header-element -->

        </ul>
        <!-- End::header-content-right -->

    </div>
    <!-- End::main-header-container -->

</header>
<!-- /app-header -->
