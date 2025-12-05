@extends('layout.default')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/check-appointment.css') }}">
@endsection

@section('content')
@include('partials.navbar')

<main class="main-content">
    <div class="page-header">
        <div>
            <h3>Appointments</h3>
            <p>Manage and review all appointment requests</p>
        </div>
        <button class="btn-primary" data-bs-toggle="modal" data-bs-target="#addAppointmentModal">
            <i class="fas fa-plus"></i>
            New Appointment
        </button>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-title">Total Appointments</span>
                <div class="stat-icon green">
                    <i class="fas fa-calendar-alt"></i>
                </div>
            </div>
            <div class="stat-value">156</div>
            <div class="stat-change positive">
                <i class="fas fa-arrow-up"></i>
                <span>12% from last month</span>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-title">Pending</span>
                <div class="stat-icon yellow">
                    <i class="fas fa-clock"></i>
                </div>
            </div>
            <div class="stat-value">24</div>
            <div class="stat-change">
                <span>Awaiting approval</span>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-title">Approved</span>
                <div class="stat-icon blue">
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>
            <div class="stat-value">98</div>
            <div class="stat-change positive">
                <i class="fas fa-arrow-up"></i>
                <span>8% from last month</span>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-title">Completed</span>
                <div class="stat-icon red">
                    <i class="fas fa-calendar-check"></i>
                </div>
            </div>
            <div class="stat-value">34</div>
            <div class="stat-change positive">
                <i class="fas fa-arrow-up"></i>
                <span>15% from last month</span>
            </div>
        </div>
    </div>

    <div class="tabs-container">
        <div class="tabs">
            <button class="tab-btn active" data-tab="pending">
                <i class="fas fa-clock"></i>
                Pending
                <span class="badge bg-warning text-dark ms-2 rounded-pill">24</span>
            </button>
            <button class="tab-btn" data-tab="approved">
                <i class="fas fa-check-circle"></i>
                Approved
                <span class="badge bg-success text-white ms-2 rounded-pill">98</span>
            </button>
            <button class="tab-btn" data-tab="calendar">
                <i class="fas fa-calendar-alt"></i>
                Calendar
            </button>
        </div>
    </div>

    <div class="table-card tab-content active" id="pending">
        <div class="table-header">
            <h5>Pending Appointments</h5>
            <div class="table-actions">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search appointments...">
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Contact</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Item</th>
                        <th>Purpose</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td data-label="User">
                            <div class="user-cell">
                                <div class="user-avatar">MG</div>
                                <div class="user-info">
                                    <strong>Maria Garcia</strong>
                                </div>
                            </div>
                        </td>
                        <td data-label="Contact">maria.garcia@email.com</td>
                        <td data-label="Date">
                            <div class="date-tag">
                                <i class="fas fa-calendar"></i>
                                Oct 12, 2025
                            </div>
                        </td>
                        <td data-label="Time">
                            <div class="time-tag">
                                <i class="fas fa-clock"></i>
                                10:30 AM
                            </div>
                        </td>
                        <td data-label="Item">
                            <strong>Black Wallet</strong>
                        </td>
                        <td data-label="Purpose">Claim Item</td>
                        <td data-label="Status"><span class="badge warning">Pending</span></td>
                        <td data-label="Actions">
                            <div class="action-btns">
                                <button class="btn-sm btn-approve" title="Approve"><i class="fas fa-check"></i></button>
                                <button class="btn-sm btn-reject" title="Reject"><i class="fas fa-times"></i></button>
                                <button class="btn-sm btn-info" title="View Details"><i class="fas fa-eye"></i></button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td data-label="User">
                            <div class="user-cell">
                                <div class="user-avatar">JD</div>
                                <div class="user-info">
                                    <strong>John Doe</strong>
                                </div>
                            </div>
                        </td>
                        <td data-label="Contact">john.doe@email.com</td>
                        <td data-label="Date">
                            <div class="date-tag">
                                <i class="fas fa-calendar"></i>
                                Oct 13, 2025
                            </div>
                        </td>
                        <td data-label="Time">
                            <div class="time-tag">
                                <i class="fas fa-clock"></i>
                                2:00 PM
                            </div>
                        </td>
                        <td data-label="Item">
                            <strong>Blue Umbrella</strong>
                        </td>
                        <td data-label="Purpose">Claim Item</td>
                        <td data-label="Status"><span class="badge warning">Pending</span></td>
                        <td data-label="Actions">
                            <div class="action-btns">
                                <button class="btn-sm btn-approve" title="Approve"><i class="fas fa-check"></i></button>
                                <button class="btn-sm btn-reject" title="Reject"><i class="fas fa-times"></i></button>
                                <button class="btn-sm btn-info" title="View Details"><i class="fas fa-eye"></i></button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        </div>

    <div class="table-card tab-content" id="approved">
        <div class="table-header">
            <h5>Approved Appointments</h5>
            <div class="table-actions">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search appointments...">
                </div>
                <button class="btn-export">
                    <i class="fas fa-download"></i> Export
                </button>
            </div>
        </div>
        <div class="table-responsive">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Contact</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Item</th>
                        <th>Purpose</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td data-label="User">
                            <div class="user-cell">
                                <div class="user-avatar">RJ</div>
                                <div class="user-info">
                                    <strong>Robert Johnson</strong>
                                </div>
                            </div>
                        </td>
                        <td data-label="Contact">robert.j@email.com</td>
                        <td data-label="Date">
                            <div class="date-tag">
                                <i class="fas fa-calendar"></i>
                                Oct 13, 2025
                            </div>
                        </td>
                        <td data-label="Time">
                            <div class="time-tag">
                                <i class="fas fa-clock"></i>
                                2:00 PM
                            </div>
                        </td>
                        <td data-label="Item">
                            <strong>iPhone 13</strong>
                        </td>
                        <td data-label="Purpose">Claim Item</td>
                        <td data-label="Status"><span class="badge success">Approved</span></td>
                        <td data-label="Actions">
                            <div class="action-btns">
                                <button class="btn-sm btn-complete" title="Complete"><i class="fas fa-check-double"></i></button>
                                <button class="btn-sm btn-info" title="View Details"><i class="fas fa-eye"></i></button>
                                <button class="btn-sm btn-danger" title="Cancel"><i class="fas fa-times"></i></button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        </div>

    <div class="table-card tab-content" id="calendar">
        <div class="table-header">
            <h5>Appointment Calendar</h5>
        </div>
        <div class="card-body p-0"> 
            <div style="padding: 1rem; min-height: 85vh;">
                <calendar-widget></calendar-widget>
            </div>
        </div>
    </div>

</main>
@endsection

@section('scripts')
<script>
    document.addEventListener('click', function(e) {
        
        // --- 1. Tab Switching Logic ---
        const tabBtn = e.target.closest('.tab-btn');
        if (tabBtn) {
            // Remove active classes from all tabs and content
            document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));

            // Add active class to the clicked tab
            tabBtn.classList.add('active');

            // Show the corresponding tab content
            const tabId = tabBtn.getAttribute('data-tab');
            const content = document.getElementById(tabId);
            if (content) {
                content.classList.add('active');
                
                // Force Calendar Resize (Fixes visibility issues on mobile)
                if (tabId === 'calendar') {
                    setTimeout(() => {
                        window.dispatchEvent(new Event('resize'));
                    }, 100);
                }
            }
            return; 
        }

        
        const approveBtn = e.target.closest('.btn-approve');
        if (approveBtn) {
            if(confirm('Are you sure you want to Approve this request?')) {
                // Add your backend logic here (e.g., submit a form or AJAX request)
                console.log('Approved');
                alert('Appointment Approved!');
            }
            return;
        }

        // Reject Button
        const rejectBtn = e.target.closest('.btn-reject');
        if (rejectBtn) {
            if(confirm('Are you sure you want to Reject this request?')) {
                console.log('Rejected');
                alert('Appointment Rejected.');
            }
            return;
        }

        // Complete Button
        const completeBtn = e.target.closest('.btn-complete');
        if (completeBtn) {
            if(confirm('Mark this appointment as Completed?')) {
                console.log('Completed');
                alert('Appointment Marked as Complete.');
            }
            return;
        }

        // Cancel Button
        const cancelBtn = e.target.closest('.btn-danger'); // Assuming .btn-danger is for Cancel
        if (cancelBtn) {
            if(confirm('Are you sure you want to Cancel this appointment?')) {
                console.log('Cancelled');
                alert('Appointment Cancelled.');
            }
            return;
        }

        // View Details Button
        const viewBtn = e.target.closest('.btn-info');
        if (viewBtn) {
            console.log('View Details clicked');
            alert('Opening details...');
            // You can open a modal here if you have one
            return;
        }
    });
</script>
@endsection