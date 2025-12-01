@extends('layout.nav-student')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endsection
<section id="home" class="container-fluid px-4 py-5 py-lg-7 min-vh-100 d-flex align-items-center">
        <div class="container-lg">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <h1 class="h1-custom mb-4">
                    Find What’s <span class="text-highlight">Lost</span>,<br> 
                    Return What’s <span class="text-highlight">Found</span>.
                </h1>
                <!--Description -->
                <p class="fs-5 text-muted mb-5 fw-medium">
                    The simplest, most reliable platform connecting lost items with their rightful owners in your community.
                </p>
            </div>
            
            <!-- Illustration Placeholder -->
            <div class="col-lg-6 d-flex justify-content-center">
                <div class="p-5" style="max-width: 750px;">
                    <img src="Image/hero_image.png" alt="Lost and Found Illustration" class="img-fluid rounded-xl">
                </div>
            </div>
        </div>
    </div>
</section>

 <!-- Footer -->
    <footer class="bg-footer py-4">
        <div class="container-lg px-4 text-white text-center footer">
            
            <a href="#home" class="fs-5 fw-bold mb-3 d-inline-flex align-items-center text-white text-opacity-75 text-decoration-none transition">
                <i data-lucide="compass" class="me-2 text-logo-green" style="width: 20px; height: 20px;"></i>
                weFind
            </a>
            
            <div class="d-flex flex-wrap justify-content-center gap-3 small mb-3">
                <a href="#about" class="fw-medium text-opacity-75 text-decoration-none transition">About</a>
                <a href="#search" class="fw-medium text-opacity-75 text-decoration-none transition">Search</a>
                <a href="#" class="fw-medium text-opacity-75 text-decoration-none transition">Privacy Policy</a>
                <a href="#" class="fw-medium text-opacity-75 text-decoration-none transition">Terms of Service</a>
            </div>

            <p class="small text-white text-opacity-50 mb-0">
                &copy; 2025 Lost and Found Management System | All Rights Reserved
            </p>
        </div>
    </footer>