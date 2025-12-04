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
                    <a href="{{ url('/search') }}" class="btn btn-primary-custom btn-lg">
                        <i data-lucide="search" class="me-2 inline-block"></i> Search Found Items
                    </a>
                    <button class="btn btn-outline-custom btn-lg" data-bs-toggle="modal" data-bs-target="#reportItemModal">
                        Report Lost Item
                    </button>
                </div>
            </div>
            <div class="col-lg-6 order-1 order-lg-2 text-center">
                <img src="{{ asset('img/hero_image.png') }}" alt="Lost and Found" class="img-fluid ">
            </div>
        </div>
    </div>
</section>


<div class="modal fade" id="reportItemModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-bottom-0 pb-0">
                <h5 class="modal-title fw-bold">Report an Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 p-lg-5">
                <form>
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-medium">What is it?</label>
                            <input type="text" class="form-control form-control-lg" placeholder="e.g. Blue Umbrella">
                        </div>
                        </div>
                    <div class="mt-4 d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-outline-custom border-0" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary-custom">Submit Report</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection