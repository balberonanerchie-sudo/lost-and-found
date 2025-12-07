@extends('layout.default')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/manage-user.css') }}">
@endsection

@section('content')
@include('partials.navbar')

<main class="main-content">
    <div class="page-header">
        <div>
            <h3>Manage Users</h3>
        </div>
        <button class="btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
            <i class="fas fa-plus"></i>
            Add New User
        </button>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-title">Total Users</span>
                <div class="stat-icon green"><i class="fas fa-users"></i></div>
            </div>
            <div class="stat-value">1,234</div>
            <div class="stat-change positive"><i class="fas fa-arrow-up"></i> <span>15% from last month</span></div>
        </div>
        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-title">Active Users</span>
                <div class="stat-icon blue"><i class="fas fa-user-check"></i></div>
            </div>
            <div class="stat-value">1,128</div>
            <div class="stat-change positive"><i class="fas fa-arrow-up"></i> <span>8% from last month</span></div>
        </div>
        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-title">Admins</span>
                <div class="stat-icon yellow"><i class="fas fa-user-shield"></i></div>
            </div>
            <div class="stat-value">12</div>
            <div class="stat-change"><span>No change</span></div>
        </div>
        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-title">Inactive</span>
                <div class="stat-icon red"><i class="fas fa-user-times"></i></div>
            </div>
            <div class="stat-value">106</div>
            <div class="stat-change negative"><i class="fas fa-arrow-down"></i> <span>3% from last month</span></div>
        </div>
    </div>

    <div class="filter-section">
        <div class="filter-group">
            <label>Role</label>
            <select class="filter-select">
                <option value="">All Roles</option>
                <option value="admin">Admin</option>
                <option value="staff">Staff</option>
                <option value="student">Student</option>
            </select>
        </div>
        <div class="filter-group">
            <label>Status</label>
            <select class="filter-select">
                <option value="">All Status</option>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>
        <button class="btn-reset"><i class="fas fa-redo"></i> Reset</button>
    </div>

    <div class="table-card">
        <div class="table-header">
            <h5>All Users (1,234)</h5>
            <div class="table-actions">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search users...">
                </div>
                <button class="btn-export"><i class="fas fa-download"></i> Export</button>
            </div>
        </div>
        <div class="table-responsive">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Joined</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td data-label="ID">#U001</td>
                        <td data-label="User">
                            <div class="user-cell">
                                <div class="user-avatar">JD</div>
                                <div class="user-info"><strong>Juan Dela Cruz</strong></div>
                            </div>
                        </td>
                        <td data-label="Email">juan@email.com</td>
                        <td data-label="Role"><span class="badge info">Student</span></td>
                        <td data-label="Status"><span class="badge success">Active</span></td>
                        <td data-label="Joined">Oct 12, 2024</td>
                        <td data-label="Actions">
                            <div class="action-btns">
                                <button class="btn-sm btn-info" title="View" 
                                    data-id="#U001" 
                                    data-name="Juan Dela Cruz" 
                                    data-email="juan@email.com" 
                                    data-role="Student" 
                                    data-status="Active" 
                                    data-joined="Oct 12, 2024">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn-sm btn-success" title="Edit"
                                    data-id="#U001" 
                                    data-name="Juan Dela Cruz" 
                                    data-email="juan@email.com" 
                                    data-role="student" 
                                    data-status="active">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn-sm btn-danger" title="Delete" data-id="#U001" data-name="Juan Dela Cruz">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td data-label="ID">#U002</td>
                        <td data-label="User">
                            <div class="user-cell">
                                <div class="user-avatar">MS</div>
                                <div class="user-info"><strong>Maria Santos</strong></div>
                            </div>
                        </td>
                        <td data-label="Email">maria@email.com</td>
                        <td data-label="Role"><span class="badge warning">Admin</span></td>
                        <td data-label="Status"><span class="badge danger">Inactive</span></td>
                        <td data-label="Joined">Nov 01, 2024</td>
                        <td data-label="Actions">
                            <div class="action-btns">
                                <button class="btn-sm btn-info" title="View" 
                                    data-id="#U002" 
                                    data-name="Maria Santos" 
                                    data-email="maria@email.com" 
                                    data-role="Admin" 
                                    data-status="Inactive" 
                                    data-joined="Nov 01, 2024">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn-sm btn-success" title="Edit"
                                    data-id="#U002" 
                                    data-name="Maria Santos" 
                                    data-email="maria@email.com" 
                                    data-role="admin" 
                                    data-status="inactive">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn-sm btn-danger" title="Delete" data-id="#U002" data-name="Maria Santos">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="addUserModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-light">
                    <h5 class="modal-title fw-bold">Add New User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST">
                    @csrf
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Full Name</label>
                            <input type="text" name="name" class="form-control" placeholder="e.g. Juan Dela Cruz">
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Email Address</label>
                            <input type="email" name="email" class="form-control" placeholder="name@example.com">
                        </div>
                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <label class="form-label text-muted small fw-bold">Role</label>
                                <select name="role" class="form-select">
                                    <option value="student">Student</option>
                                    <option value="staff">Staff</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label class="form-label text-muted small fw-bold">Status</label>
                                <select name="status" class="form-select">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Create password">
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-link text-muted text-decoration-none" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary px-4">Create User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="viewUserModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title fw-bold">User Profile</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 text-center">
                    <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <span id="view_avatar" class="fs-2 fw-bold text-primary">--</span>
                    </div>
                    <h4 id="view_name" class="fw-bold mb-0">--</h4>
                    <p id="view_email" class="text-muted small">--</p>
                    
                    <div class="d-flex justify-content-center gap-2 mt-3 mb-4">
                        <span id="view_role" class="badge bg-light text-dark border">--</span>
                        <span id="view_status" class="badge bg-secondary">--</span>
                    </div>

                    <div class="card bg-light border-0 p-3 text-start">
                        <div class="row">
                            <div class="col-6">
                                <small class="text-muted fw-bold d-block">User ID</small>
                                <span id="view_id" class="text-dark">--</span>
                            </div>
                            <div class="col-6">
                                <small class="text-muted fw-bold d-block">Joined Date</small>
                                <span id="view_joined" class="text-dark">--</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary w-100" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editUserModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-light">
                    <h5 class="modal-title fw-bold">Edit User Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit_id" name="id">
                    
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Full Name</label>
                            <input type="text" id="edit_name" name="name" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Email Address</label>
                            <input type="email" id="edit_email" name="email" class="form-control">
                        </div>
                        <div class="row g-2">
                            <div class="col-6">
                                <label class="form-label text-muted small fw-bold">Role</label>
                                <select id="edit_role" name="role" class="form-select">
                                    <option value="student">Student</option>
                                    <option value="staff">Staff</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label class="form-label text-muted small fw-bold">Status</label>
                                <select id="edit_status" name="status" class="form-select">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-link text-muted text-decoration-none" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success px-4">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteUserModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-body p-4 text-center">
                    <div class="mb-3 text-danger">
                        <i class="fas fa-trash-alt fa-3x opacity-50"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Delete User?</h5>
                    <p class="text-muted small mb-4">
                        Are you sure you want to delete <strong id="delete_name" class="text-dark">User</strong>? 
                        This action cannot be undone.
                    </p>
                    <div class="d-grid gap-2">
                        <form action="" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" id="delete_id" name="id">
                            <button type="submit" class="btn btn-danger w-100 fw-bold">Yes, Delete User</button>
                        </form>
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>
@endsection

@section('scripts')
<script>
    // 1. View User Logic
    document.querySelectorAll('.btn-info').forEach(btn => {
        btn.addEventListener('click', function() {
            // Get data from attributes
            const d = this.dataset;
            
            // Populate Modal
            document.getElementById('view_avatar').innerText = d.name.substring(0, 2).toUpperCase();
            document.getElementById('view_name').innerText = d.name;
            document.getElementById('view_email').innerText = d.email;
            document.getElementById('view_role').innerText = d.role;
            document.getElementById('view_id').innerText = d.id;
            document.getElementById('view_joined').innerText = d.joined;
            
            // Status Badge
            const statusBadge = document.getElementById('view_status');
            statusBadge.innerText = d.status;
            statusBadge.className = 'badge ' + (d.status === 'Active' ? 'success' : 'danger');

            // Show Modal
            new bootstrap.Modal(document.getElementById('viewUserModal')).show();
        });
    });

    // 2. Edit User Logic
    document.querySelectorAll('.btn-success').forEach(btn => {
        btn.addEventListener('click', function() {
            const d = this.dataset;

            document.getElementById('edit_id').value = d.id;
            document.getElementById('edit_name').value = d.name;
            document.getElementById('edit_email').value = d.email;
            document.getElementById('edit_role').value = d.role; // Ensure value matches option value
            document.getElementById('edit_status').value = d.status;

            new bootstrap.Modal(document.getElementById('editUserModal')).show();
        });
    });

    // 3. Delete User Logic
    document.querySelectorAll('.btn-danger').forEach(btn => {
        btn.addEventListener('click', function() {
            document.getElementById('delete_id').value = this.dataset.id;
            document.getElementById('delete_name').innerText = this.dataset.name;
            
            new bootstrap.Modal(document.getElementById('deleteUserModal')).show();
        });
    });
</script>
@endsection