@extends('layout.default')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/AdminDashboard.css') }}">
@endsection

@section('content')
    @include('partials.navbar')

    <main class="main-content">
        <div class="page-header">
            <h3>Dashboard Overview</h3>
        </div>

        <!-- Stats Grid -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-header">
                    <span class="stat-title">Total Items</span>
                    <div class="stat-icon green">
                        <i class="fas fa-box"></i>
                    </div>
                </div>
                <div class="stat-value">248</div>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i>
                    <span>12% from last month</span>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <span class="stat-title">Claimed Items</span>
                    <div class="stat-icon blue">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>
                <div class="stat-value">182</div>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i>
                    <span>8% from last month</span>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <span class="stat-title">Pending Claims</span>
                    <div class="stat-icon yellow">
                        <i class="fas fa-clock"></i>
                    </div>
                </div>
                <div class="stat-value">66</div>
                <div class="stat-change negative">
                    <i class="fas fa-arrow-down"></i>
                    <span>3% from last month</span>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <span class="stat-title">Active Users</span>
                    <div class="stat-icon red">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
                <div class="stat-value">1,234</div>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i>
                    <span>15% from last month</span>
                </div>
            </div>
        </div>

        <!-- Recent Reports -->
        <div class="table-card">
            <div class="table-header">
                <h5>Recent Item Reports</h5>
                <div class="table-actions">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Search reports...">
                    </div>
                    <button class="btn-primary">
                        <i class="fas fa-filter"></i>
                        Filter
                    </button>
                </div>
            </div>
            <div class="table-responsive">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>Report ID</th>
                            <th>Item Name</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#001</td>
                            <td>Black Wallet</td>
                            <td><span class="badge success">Found</span></td>
                            <td>Oct 5, 2025</td>
                            <td>
                                <div class="action-btns">
                                    <button class="btn-sm btn-info"><i class="fas fa-eye"></i></button>
                                    <button class="btn-sm btn-success"><i class="fas fa-edit"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>#002</td>
                            <td>School ID</td>
                            <td><span class="badge warning">Lost</span></td>
                            <td>Oct 8, 2025</td>
                            <td>
                                <div class="action-btns">
                                    <button class="btn-sm btn-info"><i class="fas fa-eye"></i></button>
                                    <button class="btn-sm btn-success"><i class="fas fa-edit"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>#003</td>
                            <td>Umbrella</td>
                            <td><span class="badge success">Found</span></td>
                            <td>Oct 9, 2025</td>
                            <td>
                                <div class="action-btns">
                                    <button class="btn-sm btn-info"><i class="fas fa-eye"></i></button>
                                    <button class="btn-sm btn-success"><i class="fas fa-edit"></i></button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Upcoming Appointments -->
        <div class="table-card">
            <div class="table-header">
                <h5>Upcoming Appointments</h5>
                <button class="btn-primary">
                    <i class="fas fa-plus"></i>
                    New Appointment
                </button>
            </div>
            <div class="table-responsive">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Purpose</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#A01</td>
                            <td>John Doe</td>
                            <td>Claim Item</td>
                            <td>Oct 10, 2025</td>
                            <td>
                                <div class="action-btns">
                                    <button class="btn-sm btn-success"><i class="fas fa-check"></i></button>
                                    <button class="btn-sm btn-danger"><i class="fas fa-times"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>#A02</td>
                            <td>Maria Cruz</td>
                            <td>Report Lost Item</td>
                            <td>Oct 11, 2025</td>
                            <td>
                                <div class="action-btns">
                                    <button class="btn-sm btn-success"><i class="fas fa-check"></i></button>
                                    <button class="btn-sm btn-danger"><i class="fas fa-times"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>#A03</td>
                            <td>Alex Reyes</td>
                            <td>Verification</td>
                            <td>Oct 12, 2025</td>
                            <td>
                                <div class="action-btns">
                                    <button class="btn-sm btn-success"><i class="fas fa-check"></i></button>
                                    <button class="btn-sm btn-danger"><i class="fas fa-times"></i></button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection
