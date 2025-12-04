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
                <h2 class="fw-bold">Schedule Pickup</h2>
            </div>

            <div class="custom-card p-4 p-md-5 bg-white">
                <form>
                    <h5 class="fw-bold mb-4 text-success border-bottom pb-2">Your Information</h5>
                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-medium small text-muted">Full Name</label>
                            <input type="text" class="form-control form-control-lg" placeholder="John Doe">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-medium small text-muted">Email Address</label>
                            <input type="email" class="form-control form-control-lg" placeholder="john@example.com">
                        </div>
                    </div>

                    <h5 class="fw-bold mb-4 text-success border-bottom pb-2 mt-5">Item Details</h5>
                    <div class="mb-4">
                        <label class="form-label fw-medium small text-muted">Item Name / Reference ID</label>
                        <input type="text" class="form-control form-control-lg" placeholder="e.g. Black Wallet #4421">
                    </div>

                    <h5 class="fw-bold mb-4 text-success border-bottom pb-2 mt-5">Appointment Time</h5>
                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-medium small text-muted">Date</label>
                            <input type="date" class="form-control form-control-lg">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-medium small text-muted">Time Slot</label>
                            <select class="form-select form-select-lg">
                                <option>09:00 AM - 10:00 AM</option>
                                <option>10:00 AM - 11:00 AM</option>
                                <option>01:00 PM - 02:00 PM</option>
                                <option>02:00 PM - 03:00 PM</option>
                            </select>
                        </div>
                    </div>

                    <div class="d-grid mt-5">
                        <button type="submit" class="btn btn-primary-custom btn-lg shadow-sm">
                            Confirm Appointment
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