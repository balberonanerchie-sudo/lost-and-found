@extends('layout.guest')
@section('styles')
<link rel="stylesheet" href="{{ asset('css/landing.css') }}">
@endsection

@section('content')
@include('layout.student')
<section class="py-5 py-lg-7 m-5 d-flex align-items-center min-vh-75">
    <div class="container-lg">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 order-2 order-lg-1">
                <span class="badge bg-success bg-opacity-10 text-success mb-3 px-3 py-2 rounded-pill">
                    Official School Portal
                </span>
                <h1 class="display-4 fw-bold mb-4 text-dark">
                    Lost something? <br>
                    <span class="text-highlight"> Let's get it</span>
                </h1>
                <p class="lead text-muted mb-5">
                    The simplest, most reliable platform connecting lost items with their rightful owners in your community. 
                </p>
                <div class="d-flex flex-column flex-sm-row gap-3">
                    <button class="btn btn-primary-custom btn-lg me-sm-3 mb-2 mb-sm-0" onclick="window.location.href='{{ url('/search') }}'">
                        <i data-lucide="search" class="me-2 inline-block"></i> Search Found Items
                    </button>
                    <button class="btn btn-outline-custom btn-lg" onclick="window.location.href='{{ url('/report-item') }}'">
                         <i data-lucide="search" class="me-2 inline-block"></i> Report Lost Item          
                    </button>
                </div>
            </div>
            <div class="col-lg-6 order-1 order-lg-2 text-center">
                <img src="{{ asset('img/hero_image.png') }}" alt="Lost and Found" class="img-fluid ">
            </div>
        </div>
    </div>
</section>

    </div>
    
</div>
@endsection