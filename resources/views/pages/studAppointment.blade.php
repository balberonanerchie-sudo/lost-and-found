@extends('layout.nav-student')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endsection
<section id="appointment" class="bg-pure-white py-5 py-lg-7">
            <div class="container-lg px-4" style="max-width: 800px;">
                <h2 class="h2-custom text-center mb-5 fw-bold text-dark">
                    Schedule Your Item Pickup
                </h2>
                <p class="text-center fs-5 text-muted mb-5">
                    Use the form below to book an appointment to verify and claim an item you have found in the system.
                </p>
                
    <div class="card p-4 p-md-5 rounded-xl shadow-lg border-0 bg-section-light">
        <form class="needs-validation" novalidate>
            <div class="row g-4">
                <div class="col-md-6">
                    <label for="appointmentName" class="form-label fw-medium text-muted">Your Full Name</label>
                    <input type="text" id="appointmentName" name="appointmentName" placeholder="John Doe" class="form-control form-control-lg rounded-xl border" required>
                </div>
                <div class="col-md-6">
                    <label for="appointmentEmail" class="form-label fw-medium text-muted">Contact Email</label>
                    <input type="email" id="appointmentEmail" name="appointmentEmail" placeholder="email@example.com" class="form-control form-control-lg rounded-xl border" required>
                </div>
                <div class="col-12">
                    <label for="itemReference" class="form-label fw-medium text-muted">Item Reference / Name of Item to Claim</label>
                    <input type="text" id="itemReference" name="itemReference" placeholder="e.g., Brown Leather Wallet (ID: #12345)" class="form-control form-control-lg rounded-xl border" required>
                </div>
                <div class="col-md-6">
                    <label for="appointmentDate" class="form-label fw-medium text-muted">Preferred Date</label>
                    <input type="date" id="appointmentDate" name="appointmentDate" class="form-control form-control-lg rounded-xl border" required>
                </div>
                <div class="col-md-6">
                    <label for="appointmentTime" class="form-label fw-medium text-muted">Preferred Time Slot</label>
                    <select id="appointmentTime" name="appointmentTime" class="form-select form-select-lg rounded-xl border" required>
                        <option selected disabled value="">Choose...</option>
                        <option>9:00 AM - 10:00 AM</option>
                        <option>10:00 AM - 11:00 AM</option>
                        <option>2:00 PM - 3:00 PM</option>
                        <option>3:00 PM - 4:00 PM</option>
                    </select>
                </div>
            </div>
            
            <!-- Schedule Button -->
            <button type="submit" class="btn btn-primary-dark-green w-100 rounded-xl text-uppercase shadow-soft py-3 mt-5 d-flex align-items-center justify-content-center">
                <!-- Icon calendar-check -->
                <i data-lucide="calendar-check" class="me-2" style="width: 20px; height: 20px;"></i>
                Confirm Appointment
            </button>
        </form>
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