@extends('layout.default')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/check-appointment.css') }}">
@endsection

@section('content')
    @include('partials.navbar')

    <div class="container-fluid py-4">
        <div class="page-header">
            <h3>Appointments</h3>
            <div class="text-end mb-1">
                <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#newAppointmentModal"><i class="bi bi-plus-circle me-2"></i>New Appointment</button>
            </div>
        </div>

        <div class="card p-4 mb-4">
            <div class="row g-3">
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <label class="form-label">Search Appointment</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <input type="text" class="form-control" placeholder="Enter name or item...">
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <label class="form-label">Status</label>
                    <select class="form-select">
                        <option>All Status</option>
                        <option>Pending</option>
                        <option>Approved</option>
                        <option>Declined</option>
                    </select>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <label class="form-label">Date</label>
                    <input type="date" class="form-control">
                </div>
                <div class="col-lg-2 col-md-6 col-sm-12 d-flex align-items-end">
                    <button class="btn btn-outline-success w-100"><i class="fas fa-filter me-1"></i> Filter</button>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-8 col-md-12 col-sm-12">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="mb-3">Appointments</h5>
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Item</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Maria Garcia</td>
                                        <td>2025-10-12</td>
                                        <td>10:30 AM</td>
                                        <td>Wallet</td>
                                        <td><span class="badge bg-warning">Pending</span></td>
                                        <td>
                                            <button class="btn btn-success btn-sm"><i class="fas fa-check me-1"></i>Approve</button>
                                            <button class="btn btn-primary btn-sm"><i class="fas fa-calendar-alt me-1"></i>Reschedule</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Robert Johnson</td>
                                        <td>2025-10-13</td>
                                        <td>2:00 PM</td>
                                        <td>Phone</td>
                                        <td><span class="badge bg-success">Approved</span></td>
                                        <td>
                                            <button class="btn btn-success btn-sm"><i class="fas fa-check me-1"></i>Approve</button>
                                            <button class="btn btn-primary btn-sm"><i class="fas fa-calendar-alt me-1"></i>Reschedule</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-12 col-sm-12">
                <div class="card h-100">
                    <div class="card-header bg-success text-white">
                        <i class="fas fa-calendar-check me-2"></i> Approved Appointments
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Item</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Robert Johnson</td>
                                        <td>2025-10-13</td>
                                        <td>2:00 PM</td>
                                        <td>Phone</td>
                                    </tr>
                                    <tr>
                                        <td>Jennifer Lee</td>
                                        <td>2025-10-14</td>
                                        <td>10:45 AM</td>
                                        <td>Bag</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="newAppointmentModal" tabindex="-1" aria-labelledby="newAppointmentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newAppointmentModalLabel">New Appointment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="userName" class="form-label">User Name</label>
                            <input type="text" class="form-control" id="userName">
                        </div>
                        <div class="mb-3">
                            <label for="appointmentDate" class="form-label">Date</label>
                            <input type="date" class="form-control" id="appointmentDate">
                        </div>
                        <div class="mb-3">
                            <label for="appointmentTime" class="form-label">Time</label>
                            <input type="time" class="form-control" id="appointmentTime">
                        </div>
                        <div class="mb-3">
                            <label for="itemName" class="form-label">Item Name</label>
                            <input type="text" class="form-control" id="itemName">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save Appointment</button>
                </div>
            </div>
        </div>
    </div>
@endsection
