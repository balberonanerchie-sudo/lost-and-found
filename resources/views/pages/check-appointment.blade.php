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
                <span class="badge bg-success text-white ms-2 rounded-pill">24</span>
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
                            <div class="date-tag"><i class="fas fa-calendar"></i> Oct 12, 2025</div>
                        </td>
                        <td data-label="Time">
                            <div class="time-tag"><i class="fas fa-clock"></i> 10:30 AM</div>
                        </td>
                        <td data-label="Item"><strong>Black Wallet</strong></td>
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
                            <div class="date-tag"><i class="fas fa-calendar"></i> Oct 13, 2025</div>
                        </td>
                        <td data-label="Time">
                            <div class="time-tag"><i class="fas fa-clock"></i> 2:00 PM</div>
                        </td>
                        <td data-label="Item"><strong>Blue Umbrella</strong></td>
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
                            <div class="date-tag"><i class="fas fa-calendar"></i> Oct 13, 2025</div>
                        </td>
                        <td data-label="Time">
                            <div class="time-tag"><i class="fas fa-clock"></i> 2:00 PM</div>
                        </td>
                        <td data-label="Item"><strong>iPhone 13</strong></td>
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

    <div class="modal fade" id="addAppointmentModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-light">
                    <h5 class="modal-title fw-bold">Schedule New Appointment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('/appointments/store') }}" method="POST">
                    @csrf
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">User Name</label>
                            <input type="text" name="user_name" class="form-control" placeholder="e.g. Juan Dela Cruz" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Contact Email</label>
                            <input type="email" name="contact" class="form-control" placeholder="name@example.com" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Item to Claim</label>
                            <input type="text" name="item_name" class="form-control" placeholder="e.g. Black Wallet" required>
                        </div>
                        <div class="row g-2">
                            <div class="col-6">
                                <label class="form-label text-muted small fw-bold">Date</label>
                                <input type="date" name="date" class="form-control" required>
                            </div>
                            <div class="col-6">
                                <label class="form-label text-muted small fw-bold">Time</label>
                                <input type="time" name="time" class="form-control" required>
                            </div>
                        </div>
                        <div class="mt-3">
                            <label class="form-label text-muted small fw-bold">Purpose / Notes</label>
                            <textarea name="purpose" class="form-control" rows="2" placeholder="Verification details..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-link text-muted text-decoration-none" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary px-4">Schedule</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="viewAppointmentModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title fw-bold">Appointment Details</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="text-center mb-4">
                        <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                            <span id="view_user_avatar" class="fs-2 fw-bold text-primary">--</span>
                        </div>
                        <h4 id="view_user_name" class="fw-bold mb-0">--</h4>
                        <p id="view_user_contact" class="text-muted small">--</p>
                    </div>

                    <div class="card bg-light border-0 p-3 mb-3">
                        <div class="row g-3">
                            <div class="col-6">
                                <small class="text-muted d-block fw-bold">Date</small>
                                <span id="view_date" class="text-dark">--</span>
                            </div>
                            <div class="col-6">
                                <small class="text-muted d-block fw-bold">Time</small>
                                <span id="view_time" class="text-dark">--</span>
                            </div>
                            <div class="col-12 border-top pt-2 mt-2">
                                <small class="text-muted d-block fw-bold">Item Claiming</small>
                                <span id="view_item" class="text-dark fw-bold">--</span>
                            </div>
                            <div class="col-12 pt-1">
                                <small class="text-muted d-block fw-bold">Purpose</small>
                                <span id="view_purpose" class="text-dark">--</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted">Status:</small>
                        <span id="view_status" class="badge bg-secondary">--</span>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary w-100" data-bs-dismiss="modal">Close</button>
                </div>
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
            document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
            tabBtn.classList.add('active');
            const tabId = tabBtn.getAttribute('data-tab');
            const content = document.getElementById(tabId);
            if (content) {
                content.classList.add('active');
                if (tabId === 'calendar') {
                    setTimeout(() => window.dispatchEvent(new Event('resize')), 100);
                }
            }
            return; 
        }

        // --- 2. Action Buttons Logic ---

        // Approve
        const approveBtn = e.target.closest('.btn-approve');
        if (approveBtn) {
            if(confirm('Are you sure you want to Approve this request?')) {
                console.log('Approved');
                alert('Appointment Approved!');
            }
            return;
        }

        // Reject
        const rejectBtn = e.target.closest('.btn-reject');
        if (rejectBtn) {
            if(confirm('Are you sure you want to Reject this request?')) {
                console.log('Rejected');
                alert('Appointment Rejected.');
            }
            return;
        }

        // Complete
        const completeBtn = e.target.closest('.btn-complete');
        if (completeBtn) {
            if(confirm('Mark this appointment as Completed?')) {
                console.log('Completed');
                alert('Appointment Marked as Complete.');
            }
            return;
        }

        // Cancel
        const cancelBtn = e.target.closest('.btn-danger'); 
        if (cancelBtn) {
            if(confirm('Are you sure you want to Cancel this appointment?')) {
                console.log('Cancelled');
                alert('Appointment Cancelled.');
            }
            return;
        }

        // --- 3. View Details (Populate Modal) ---
        const viewBtn = e.target.closest('.btn-info');
        if (viewBtn) {
            // Find the closest table row to extract data
            const row = viewBtn.closest('tr');

            if(row) {
                const avatar = row.querySelector('.user-avatar').innerText;
                const name = row.querySelector('.user-info strong').innerText;
                const contact = row.querySelector('td[data-label="Contact"]').innerText;
                const date = row.querySelector('td[data-label="Date"]').innerText.trim();
                const time = row.querySelector('td[data-label="Time"]').innerText.trim();
                const item = row.querySelector('td[data-label="Item"] strong').innerText;
                const purpose = row.querySelector('td[data-label="Purpose"]').innerText;
                const statusElement = row.querySelector('td[data-label="Status"] .badge');
                
                // Populate Modal Fields
                document.getElementById('view_user_avatar').innerText = avatar;
                document.getElementById('view_user_name').innerText = name;
                document.getElementById('view_user_contact').innerText = contact;
                document.getElementById('view_date').innerText = date;
                document.getElementById('view_time').innerText = time;
                document.getElementById('view_item').innerText = item;
                document.getElementById('view_purpose').innerText = purpose;

                // Handle Status Badge styling in modal
                const modalStatus = document.getElementById('view_status');
                modalStatus.innerText = statusElement.innerText;
                modalStatus.className = statusElement.className; // Copy the badge class (e.g. badge warning)

                // Show the Modal
                const modal = new bootstrap.Modal(document.getElementById('viewAppointmentModal'));
                modal.show();
            }
            return;
        }
    });
</script>
@endsection