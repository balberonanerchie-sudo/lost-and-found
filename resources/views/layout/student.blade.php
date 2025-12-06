<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Lost & Found Portal' }}</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
        <div class="container-lg">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ url('/') }}">
                <div class="brand-logo">
                    <img src="{{ asset('img/logo1.png') }}" alt="Lost & Found Logo">
                </div>
                <span class="brand-text fs-4">weFind</span>
            </a>
            
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i data-lucide="menu"></i>
            </button>
            
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav gap-3 align-items-center">
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom {{ request()->is('home') ? 'active' : '' }}" href="{{ url('/home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom {{ request()->is('search*') ? 'active' : '' }}" href="{{ url('/search') }}">Search Items</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom {{ request()->is('book-appointment*') ? 'active' : '' }}" href="{{ url('/book-appointment') }}">Appointments</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom {{ request()->is('report-item*') ? 'active' : '' }}" href="{{ url('/report-item') }}">Report Item</a>
                    </li>
                    <li class="nav-item ps-lg-3 border-start-lg">
                        <a class="nav-link nav-link-custom text-danger fw-bold" href="#" data-bs-toggle="modal" data-bs-target="#studentLogoutModal">
                            Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main style="padding-top: 80px;">
        @yield('content')
    </main>

    <div class="modal fade" id="studentLogoutModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content border-0 shadow rounded-4">
                <div class="modal-body text-center p-4">
                    <div class="mb-3 text-success">
                        <i data-lucide ="log-out" class="mx-auto" style="width: 48px; height: 48px;"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Log Out?</h5>
                    <p class="text-muted small mb-4">Are you sure you want to sign out of your account?</p>
                    
                    <div class="d-grid gap-2">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-success w-100 fw-bold">Sign Out</button>
                        </form>
                        <button type="button" class="btn btn-light text-muted" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        lucide.createIcons();
    </script>
    @yield('scripts')
</body>
</html>