@extends('layout.student')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
@endsection

@section('content')
    <div class="container-lg py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-5">
                    <h2 class="fw-bold">Schedule Pickup</h2>
                    <p class="text-muted mb-0">
                        Arrange a time to bring in or claim your item at the Lost &amp; Found office.
                    </p>
                </div>

                <div class="custom-card p-4 p-md-5 bg-white">
                    <form action="{{ route('appointments.store') }}" method="POST">
                        @csrf

                        {{-- Validation errors --}}
                        @if ($errors->any())
                            <div class="alert alert-danger small mb-4">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- Mode: "turnover" (from Found report) or "claim" (from Search Items) --}}
                        @php
                            $mode = $mode ?? 'turnover';
                        @endphp

                        @if ($mode === 'claim')
                            {{-- Claim appointment: needs item_id --}}
                            <input type="hidden" name="type" value="claim">
                            <input type="hidden" name="item_id" value="{{ $item->id }}">
                        @else
                            {{-- Turnover appointment: found report, no item yet --}}
                            <input type="hidden" name="type" value="turnover">
                            {{-- Store report item name as notes so it shows in My Appointments --}}
                            <input type="hidden" name="notes" value="{{ $report->item_name }}">
                        @endif

                        <h5 class="fw-bold mb-4 text-success border-bottom pb-2">Your Information</h5>
                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-medium small text-muted">Full Name</label>
                                <input type="text"
                                       class="form-control form-control-lg"
                                       value="{{ $user->name }}"
                                       disabled>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-medium small text-muted">Email Address</label>
                                <input type="email"
                                       class="form-control form-control-lg"
                                       value="{{ $user->email }}"
                                       disabled>
                            </div>
                        </div>

                        <h5 class="fw-bold mb-4 text-success border-bottom pb-2 mt-5">Item Details</h5>
                        <div class="mb-4">
                            <label class="form-label fw-medium small text-muted">Item Name / Reference ID</label>
                            <input type="text"
                                   class="form-control form-control-lg"
                                   value="{{ $mode === 'claim' ? $item->item_name : $report->item_name }}"
                                   disabled>
                        </div>

                        <h5 class="fw-bold mb-4 text-success border-bottom pb-2 mt-5">Appointment Time</h5>
                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-medium small text-muted">Date</label>
                                <input type="date"
                                       name="date"
                                       class="form-control form-control-lg"
                                       value="{{ old('date') }}"
                                       required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-medium small text-muted">Time Slot</label>
                                <select name="time" class="form-select form-select-lg" required>
                                    <option value="">Select a time</option>
                                    <option value="09:00 AM" {{ old('time') === '09:00 AM' ? 'selected' : '' }}>09:00 AM - 10:00 AM</option>
                                    <option value="10:00 AM" {{ old('time') === '10:00 AM' ? 'selected' : '' }}>10:00 AM - 11:00 AM</option>
                                    <option value="01:00 PM" {{ old('time') === '01:00 PM' ? 'selected' : '' }}>01:00 PM - 02:00 PM</option>
                                    <option value="02:00 PM" {{ old('time') === '02:00 PM' ? 'selected' : '' }}>02:00 PM - 03:00 PM</option>
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
