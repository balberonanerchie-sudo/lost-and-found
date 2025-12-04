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

    <!-- Stats Overview -->
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

    <!-- Tabs -->
  <div class="tabs-container">
    <div class="tabs">
        <button class="tab-btn active" data-tab="pending">
            <i class="fas fa-clock"></i>
            Pending Appointments (24)
        </button>
        <button class="tab-btn" data-tab="approved">
            <i class="fas fa-check-circle"></i>
            Approved Appointments (98)
        </button>
        <button class="tab-btn" data-tab="calendar">
            <i class="fas fa-calendar-alt"></i>
            Calendar
        </button>
    </div>
</div>

    <!-- Pending Appointments Table -->
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
                                <button class="btn-sm btn-approve" title="Approve">
                                    <i class="fas fa-check"></i>
                                    <span>Approve</span>
                                </button>
                                <button class="btn-sm btn-reject" title="Reject">
                                    <i class="fas fa-times"></i>
                                    <span>Reject</span>
                                </button>
                                <button class="btn-sm btn-info" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </button>
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
                                <button class="btn-sm btn-approve" title="Approve">
                                    <i class="fas fa-check"></i>
                                    <span>Approve</span>
                                </button>
                                <button class="btn-sm btn-reject" title="Reject">
                                    <i class="fas fa-times"></i>
                                    <span>Reject</span>
                                </button>
                                <button class="btn-sm btn-info" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td data-label="User">
                            <div class="user-cell">
                                <div class="user-avatar">JL</div>
                                <div class="user-info">
                                    <strong>Jennifer Lee</strong>
                                </div>
                            </div>
                        </td>
                        <td data-label="Contact">jennifer.lee@email.com</td>
                        <td data-label="Date">
                            <div class="date-tag">
                                <i class="fas fa-calendar"></i>
                                Oct 14, 2025
                            </div>
                        </td>
                        <td data-label="Time">
                            <div class="time-tag">
                                <i class="fas fa-clock"></i>
                                10:45 AM
                            </div>
                        </td>
                        <td data-label="Item">
                            <strong>Student ID</strong>
                        </td>
                        <td data-label="Purpose">Claim Item</td>
                        <td data-label="Status"><span class="badge warning">Pending</span></td>
                        <td data-label="Actions">
                            <div class="action-btns">
                                <button class="btn-sm btn-approve" title="Approve">
                                    <i class="fas fa-check"></i>
                                    <span>Approve</span>
                                </button>
                                <button class="btn-sm btn-reject" title="Reject">
                                    <i class="fas fa-times"></i>
                                    <span>Reject</span>
                                </button>
                                <button class="btn-sm btn-info" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="table-footer">
            <div class="showing-info">
                Showing 1 to 3 of 24 pending appointments
            </div>
            <div class="pagination">
                <button class="page-btn" disabled>
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="page-btn active">1</button>
                <button class="page-btn">2</button>
                <button class="page-btn">3</button>
                <button class="page-btn">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Approved Appointments Table -->
    <div class="table-card tab-content" id="approved">
        <div class="table-header">
            <h5>Approved Appointments</h5>
            <div class="table-actions">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search appointments...">
                </div>
                <button class="btn-export">
                    <i class="fas fa-download"></i>
                    Export
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
                                <button class="btn-sm btn-complete" title="Mark as Complete">
                                    <i class="fas fa-check-double"></i>
                                    <span>Complete</span>
                                </button>
                                <button class="btn-sm btn-info" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn-sm btn-danger" title="Cancel">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td data-label="User">
                            <div class="user-cell">
                                <div class="user-avatar">AS</div>
                                <div class="user-info">
                                    <strong>Anna Smith</strong>
                                </div>
                            </div>
                        </td>
                        <td data-label="Contact">anna.smith@email.com</td>
                        <td data-label="Date">
                            <div class="date-tag">
                                <i class="fas fa-calendar"></i>
                                Oct 14, 2025
                            </div>
                        </td>
                        <td data-label="Time">
                            <div class="time-tag">
                                <i class="fas fa-clock"></i>
                                10:45 AM
                            </div>
                        </td>
                        <td data-label="Item">
                            <strong>Black Bag</strong>
                        </td>
                        <td data-label="Purpose">Claim Item</td>
                        <td data-label="Status"><span class="badge success">Approved</span></td>
                        <td data-label="Actions">
                            <div class="action-btns">
                                <button class="btn-sm btn-complete" title="Mark as Complete">
                                    <i class="fas fa-check-double"></i>
                                    <span>Complete</span>
                                </button>
                                <button class="btn-sm btn-info" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn-sm btn-danger" title="Cancel">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </td>
                   </tr>
                </tbody>
            </table>
        </div>

        <div class="table-footer">
            <div class="showing-info">
                Showing 1 to 2 of 98 approved appointments
            </div>
            <div class="pagination">
                <button class="page-btn" disabled>
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="page-btn active">1</button>
                <button class="page-btn">2</button>
                <button class="page-btn">3</button>
                <span class="page-dots">...</span>
                <button class="page-btn">20</button>
                <button class="page-btn">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </div> <div class="table-card tab-content" id="calendar">
        <div class="table-header">
            <h5>Appointment Calendar</h5>
        </div>
        <div class="card-body p-4">
            <calendar-widget></calendar-widget>
        </div>
    </div>

</div> 
</main>
@endsection

@section('scripts')
<script>
    document.addEventListener('click', function(e) {
        // Tab Switching Logic
        const tabBtn = e.target.closest('.tab-btn');
        if (tabBtn) {
            // 1. Deactivate all tabs and content
            document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));

            // 2. Activate clicked tab
            tabBtn.classList.add('active');

            // 3. Show corresponding content
            const tabId = tabBtn.getAttribute('data-tab');
            const content = document.getElementById(tabId);
            if (content) {
                content.classList.add('active');
                
                // --- FIX: Force Resize for Calendar ---
                if (tabId === 'calendar') {
                    setTimeout(() => {
                        window.dispatchEvent(new Event('resize'));
                    }, 200); // Small delay to ensure the tab is visible first
                }
            }
        }
    });
</script>
@endsection