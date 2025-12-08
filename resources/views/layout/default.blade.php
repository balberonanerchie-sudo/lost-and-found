<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'Lost & Found System' }}</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('styles')
</head>

<body>
    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}" class="brand-content">
                <div class="brand-logo">
                    <img src="{{ asset('img/logo1.png') }}" alt="Lost & Found Logo">
                </div>
                <div class="brand-text">
                    <h4>WeFind!</h4>
                    <p>School System</p>
                </div>
            </a>
        </div>

        <nav class="sidebar-menu">
            <ul>
                <li>
                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-th-large"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.items') }}"
                        class="nav-link {{ request()->routeIs('admin.items') ? 'active' : '' }}">
                        <i class="fas fa-box"></i>
                        <span>Items</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.users') }}"
                        class="nav-link {{ request()->routeIs('admin.users') ? 'active' : '' }}">
                        <i class="fas fa-users"></i>
                        <span>Manage Users</span>
                    </a>
                </li>
                <li>

                    <a href="{{ route('admin.reports') }}" 
                        class="nav-link {{ request()->routeIs('admin.lostReports') ? 'active' : '' }}">
                        <i class="fas fa-search-minus"></i>
                        <span>Manage Reports</span>
                    </a>
                </li>
                    <a href="{{ route('admin.appointments') }}"
                        class="nav-link {{ request()->routeIs('admin.appointments') ? 'active' : '' }}">
                        <i class="fas fa-calendar-check"></i>
                        <span>Appointments</span>
                    </a>
                </li>
                
            </ul>
        </nav>
    </aside>
    <!-- Sidebar Overlay (Mobile) -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <div class="main-wrapper" id="mainWrapper">
        <div id="app">
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery (if needed) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Custom JS -->
    <script>
        // Toggle Sidebar
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainWrapper = document.getElementById('mainWrapper');
            const overlay = document.getElementById('sidebarOverlay');

            sidebar.classList.toggle('active');
            sidebar.classList.toggle('collapsed');
            mainWrapper.classList.toggle('expanded');

            // Only toggle overlay on mobile
            if (window.innerWidth <= 992) {
                overlay.classList.toggle('active');
            }
        }

        // Close sidebar when clicking overlay
        document.getElementById('sidebarOverlay').addEventListener('click', function () {
            toggleSidebar();
        });

        // Handle responsive behavior
        function handleResize() {
            const sidebar = document.getElementById('sidebar');
            const mainWrapper = document.getElementById('mainWrapper');
            const overlay = document.getElementById('sidebarOverlay');

            if (window.innerWidth > 992) {
                // Desktop: sidebar visible, no overlay
                sidebar.classList.remove('active', 'collapsed');
                mainWrapper.classList.remove('expanded');
                overlay.classList.remove('active');
            } else {
                // Mobile: sidebar hidden
                sidebar.classList.add('collapsed');
                sidebar.classList.remove('active');
                mainWrapper.classList.add('expanded');
                overlay.classList.remove('active');
            }
        }

        window.addEventListener('resize', handleResize);
        handleResize(); // Initial check
    </script>

    @yield('scripts')
</body>

</html>
