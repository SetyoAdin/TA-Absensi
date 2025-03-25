<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title', 'Dashboard') &mdash; Stisla</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('template/node_modules/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/node_modules/@fortawesome/fontawesome-free/css/all.css') }}">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('template/node_modules/bootstrap-social/bootstrap-social.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/css/components.css') }}">

    <!-- Custom CSS for fixed footer -->
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        #app {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .main-wrapper {
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .main-content {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            padding-bottom: 20px;
        }

        .section {
            flex-grow: 1;
        }
    </style>

    @yield('styles')
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            @include('layouts.navbar')

            <div class="main-sidebar">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="index.html">Stisla</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="index.html">St</a>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="menu-header">Dashboard</li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link has-dropdown"><i
                                    class="fas fa-fire"></i><span>Dashboard</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="#">General Dashboard</a></li>
                            </ul>
                        </li>

                        <li class="menu-header">Manajemen</li>
                        <li class="nav-item">
                            <a href="/karyawan" class="nav-link"><i class="fas fa-users"></i><span>Karyawan</span></a>
                        </li>

                        <!-- Add more menu items as needed -->
                    </ul>
                </aside>
            </div>

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1>@yield('title', 'Dashboard')</h1>
                        @yield('section-header')
                    </div>

                    @yield('content')

                    <div class="section-body">
                        @yield('section-body')
                    </div>
                </section>
            </div>

            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; 2025
                </div>
                <div class="footer-right">
                    2.3.0
                </div>
            </footer>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('template/node_modules/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('template/node_modules/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('template/node_modules/jquery.nicescroll/dist/jquery.nicescroll.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="{{ asset('template/assets/js/stisla.js') }}"></script>

    <!-- Template JS File -->
    <script src="{{ asset('template/assets/js/scripts.js') }}"></script>
    <script src="{{ asset('template/assets/js/custom.js') }}"></script>

    <!-- Page Specific JS File -->
    @yield('scripts')
</body>

</html>
