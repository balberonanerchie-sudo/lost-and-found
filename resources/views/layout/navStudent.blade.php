<nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-pure-white shadow-soft fixed-top">
    <div class="container-fluid container-lg px-4 px-lg-0">
        <!-- LogoName -->
        <a class="navbar-brand fs-4 fw-bold text-dark d-flex align-items-center" href="{{ route('studHomepage') }}">
            <!-- Icon logo-->
            <i class="bi bi-compass me-2 text-logo-green" style="width: 28px; height: 28px;"></i>
            <span class="logo-text">weFind</span>
        </a>
        
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="bi bi-list text-dark" style="width: 24px; height: 24px;"></i>
        </button>
        
        <!-- Menu Items -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav gap-3">
                <li class="nav-item">
                    <a class="nav-link nav-link-custom {{ request()->is('/') ? 'active' : '' }}" href="{{ route('studHomepage') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-custom {{ request()->is('report-item') ? 'active' : '' }}" href="{{ route('studReportItem') }}">Report Item</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-custom {{ request()->is('search-item') ? 'active' : '' }}" href="{{ route('studSearchItem') }}">Search</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-custom {{ request()->is('appointment') ? 'active' : '' }}" href="{{ route('studAppointment') }}">Appointment</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-custom" href="#about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-custom" href="#contact">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>