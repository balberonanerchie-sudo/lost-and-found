@extends('layout.guest')
@section('styles')
<link rel="stylesheet" href="{{ asset('css/landing.css') }}">
@endsection

@section('content')
@include('layout.student')

<div class="container-lg py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Report a Lost or Found Item</h2>
                
            </div>

            <div class="custom-card p-4 p-md-5 bg-white">
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <h5 class="fw-bold mb-4 text-success border-bottom pb-2 d-flex align-items-center gap-2">
                        <i data-lucide="box" size="20"></i> Item Details
                    </h5>
                    
                    <div class="row g-4 mb-4">
                        <div class="col-12">
                            <label class="form-label fw-medium small text-muted">Are you reporting a:</label>
                            <div class="d-flex gap-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="type" id="typeLost" value="lost" checked>
                                    <label class="form-check-label fw-medium" for="typeLost">Lost Item</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="type" id="typeFound" value="found">
                                    <label class="form-check-label fw-medium" for="typeFound">Found Item</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-medium small text-muted">Item Name</label>
                            <input type="text" class="form-control form-control-lg" placeholder="e.g. Blue Umbrella">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-medium small text-muted">Category</label>
                            <select class="form-select form-select-lg">
                                <option value="electronics">Electronics</option>
                                <option value="wallet">Wallet/ID</option>
                                <option value="keys">Keys</option>
                                <option value="clothing">Clothing</option>
                                <option value="accessories">Accessories</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-medium small text-muted">Description</label>
                            <textarea class="form-control form-control-lg" rows="4" placeholder="Describe the item (color, brand, distinguishing marks)..."></textarea>
                        </div>
                    </div>

                    <h5 class="fw-bold mb-4 text-success border-bottom pb-2 mt-5 d-flex align-items-center gap-2">
                        <i data-lucide="map-pin" size="20"></i> Location & Time
                    </h5>

                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-medium small text-muted">Location</label>
                            <input type="text" class="form-control form-control-lg" placeholder="e.g. Main Library, Room 304">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-medium small text-muted">Date</label>
                            <input type="date" class="form-control form-control-lg">
                        </div>
                    </div>

                    <h5 class="fw-bold mb-4 text-success border-bottom pb-2 mt-5 d-flex align-items-center gap-2">
                        <i data-lucide="image" size="20"></i> Media & Contact
                    </h5>

                    <div class="row g-4 mb-4">
                        <div class="col-12">
                            <label class="form-label fw-medium small text-muted">Upload Photo (Optional)</label>
                            <input type="file" class="form-control form-control-lg">
                            <div class="form-text">Accepted formats: jpg, png. Max size: 5MB.</div>
                        </div>
                        
                        <div class="col-12">
                            <label class="form-label fw-medium small text-muted">Your Email Address</label>
                            <input type="email" class="form-control form-control-lg" placeholder="you@example.com">
                        </div>
                    </div>

                    <div class="d-grid mt-5">
                        <button type="submit" class="btn btn-primary-custom btn-lg shadow-sm d-flex align-items-center justify-content-center gap-2">
                            <i data-lucide="upload-cloud" size="20"></i> Submit Report
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<footer class="bg-dark text-white py-5 mt-auto">
        <div class="container text-center">
            <div class="d-flex justify-content-center align-items-center gap-2 mb-4">
                <i data-lucide="compass" class="text-success"></i>
                <span class="fw-bold fs-5">weFind</span>
            </div>
            <p class="text-white-50 small mb-0">
                &copy; {{ date('Y') }} Lost and Found Management System. All Rights Reserved.
            </p>
        </div>
    </footer>
@endsection