@extends('layout.default')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/AdminDashboard.css') }}">
@endsection

@section('content')
    @include('partials.navbar')

    <div class="container-fluid py-4">
        <div class="page-header">
            <h3 class="fw-bold">Dashboard</h3>
        </div>

        <div class="row g-4">
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="card text-center p-3 bg-success-subtle">
                    <div class="d-flex align-items-center">
                        <div class="me-4">
                            <i class="fas fa-box-open fa-3x text-success"></i>
                        </div>
                        <div>
                            <h5 class="mt-3">Total Found Items</h5>
                            <h3>120</h3>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="card text-center p-3 bg-danger-subtle">
                    <div class="d-flex align-items-center">
                        <div class="me-4">
                            <i class="fas fa-search fa-3x text-danger"></i>
                        </div>
                        <div>
                            <h5 class="mt-3">Total Lost Reports</h5>
                            <h3>98</h3>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="card text-center p-3 bg-primary-subtle">
                    <div class="d-flex align-items-center">
                        <div class="me-4">
                            <i class="fas fa-undo fa-3x text-primary"></i>
                        </div>
                        <div>
                            <h5 class="mt-3">Returned Items</h5>
                            <h3>75</h3>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="card text-center p-3 bg-warning-subtle">
                    <div class="d-flex align-items-center">
                        <div class="me-4">
                            <i class="fas fa-hourglass-half fa-3x text-warning"></i>
                        </div>
                        <div>
                            <h5 class="mt-3">Pending Approvals</h5>
                            <h3>10</h3>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <i class="fas fa-file-alt me-2"></i> Recent Reports
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Report ID</th>
                                        <th>Item Name</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>#001</td>
                                        <td>Black Wallet</td>
                                        <td><span class="badge bg-success">Found</span></td>
                                        <td>Oct 5, 2025</td>
                                    </tr>
                                    <tr>
                                        <td>#002</td>
                                        <td>School ID</td>
                                        <td><span class="badge bg-danger">Lost</span></td>
                                        <td>Oct 8, 2025</td>
                                    </tr>
                                    <tr>
                                        <td>#003</td>
                                        <td>Umbrella</td>
                                        <td><span class="badge bg-success">Found</span></td>
                                        <td>Oct 9, 2025</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <i class="fas fa-calendar-check me-2"></i> Appointments
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Purpose</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>#A01</td>
                                        <td>John Doe</td>
                                        <td>Claim Item</td>
                                        <td>Oct 10, 2025</td>
                                    </tr>
                                    <tr>
                                        <td>#A02</td>
                                        <td>Maria Cruz</td>
                                        <td>Report Lost Item</td>
                                        <td>Oct 11, 2025</td>
                                    </tr>
                                    <tr>
                                        <td>#A03</td>
                                        <td>Alex Reyes</td>
                                        <td>Verification</td>
                                        <td>Oct 12, 2025</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection