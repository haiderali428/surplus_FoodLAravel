<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Modern, flexible and responsive Bootstrap 5 admin & dashboard template">
    <meta name="author" content="Bootlab">
    <title>FoodTech-Admin Dashboard</title>
    <!-- Styles -->
    <link href="{{ asset('css/modern.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/contactUs.css') }}">
    <link rel="stylesheet" href="{{ asset('css/card.css') }}">
    <link rel="stylesheet" href="{{ asset('css/FSSAILicense.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Reports.css') }}">
    <link rel="stylesheet" href="{{ asset('css/setting.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css" rel="stylesheet" />
    @stack('styles')
</head>
<body>
<div class="wrapper">
   
    <div class="main">
        <nav class="navbar navbar-expand navbar-theme py-3" style="background-color: rgba(245, 245, 245, 1) !important;">
            <a class="sidebar-toggle d-flex d-md-none me-2">
                <i class="hamburger align-self-center"></i>
            </a>
            <form class="d-none d-sm-block navbarsearchmain">
                <input class=" " type="text" placeholder="Search projects...">
                <div class="search-iconss">
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15.4204 13.8296L12.5646 10.9738C13.1546 10.0845 13.5 9.01969 13.5 7.875C13.5 4.77338 10.9766 2.25 7.875 2.25C4.77338 2.25 2.25 4.77338 2.25 7.875C2.25 10.9766 4.77338 13.5 7.875 13.5C9.01969 13.5 10.0845 13.1546 10.9738 12.5646L13.8296 15.4204C14.2684 15.8597 14.9816 15.8597 15.4204 15.4204C15.8597 14.9811 15.8597 14.2689 15.4204 13.8296ZM3.9375 7.875C3.9375 5.70375 5.70375 3.9375 7.875 3.9375C10.0462 3.9375 11.8125 5.70375 11.8125 7.875C11.8125 10.0462 10.0462 11.8125 7.875 11.8125C5.70375 11.8125 3.9375 10.0462 3.9375 7.875Z" fill="#4B4B4B"/>
                    </svg>
                </div>
            </form>
            <div class="navbar-collapse collapse">
                <ul class="navbar-nav ms-auto">
                    <li>
                        <!-- Language dropdown (optional) -->
                    </li>
                    <li class="nav-item dropdown mx-3 notificationicons ">
                        <!-- Notification bell (implement as needed) -->
                    </li>
                    <li class="nav-item dropdown ms-lg-2">
                        <a class="nav-link p-0 dropdown-toggle position-relative" href="#" id="userDropdown" data-bs-toggle="dropdown">
                            <button class="btn btn-lg" type="button">
                                <span><img src="{{ asset('img/dashboard/profile.png') }}" width="20" alt=""></span>
                                <span class="me-3 d-none d-md-inline">{{ Auth::user()->name ?? 'Admin' }}</span>
                            </button>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="#"><i class="align-middle me-1 fas fa-fw fa-user"></i> View Profile</a>
                            <a class="dropdown-item" href="#"><i class="align-middle me-1 fas fa-fw fa-comments"></i> Contacts</a>
                            <a class="dropdown-item" href="#"><i class="align-middle me-1 fas fa-fw fa-chart-pie"></i> Analytics</a>
                            <a class="dropdown-item" href="#"><i class="align-middle me-1 fas fa-fw fa-cogs"></i> Settings</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#"
                               onclick="event.preventDefault(); document.getElementById('admin-logout-form').submit();">
                                <i class="align-middle me-1 fas fa-fw fa-arrow-alt-circle-right"></i> Sign out
                            </a>
                            <form id="admin-logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <main class="content quicksand-font">
            <div class="container-fluid p-sm-2">
                @include('partials.alerts')
                @yield('content')
            </div>
        </main>
    </div>
</div>
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@stack('scripts')
</body>
</html> 