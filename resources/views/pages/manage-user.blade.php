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
            <p>Manage all users, roles, and permissions in the system</p>
        </div>
        <button class="btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
            <i class="fas fa-plus"></i>
            Add New User
        </button>
    </div>

    <!-- Stats Overview -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-title">Total Users</span>
                <div class="stat-icon green">
                    <i class="fas fa-users"></i>
                </div>
            </div>
            <div class="stat-value">1,234</div>
            <div class="stat-change positive">
                <i class="fas fa-arrow-up"></i>
                <span>15% from last month</span>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-title">Active Users</span>
                <div class="stat-icon blue">
                    <i class="fas fa-user-check"></i>
                </div>
            </div>
            <div class="stat-value">1,128</div>
            <div class="stat-change positive">
                <i class="fas fa-arrow-up"></i>
                <span>8% from last month</span>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-title">Admins</span>
                <div class="stat-icon yellow">
                    <i class="fas fa-user-shield"></i>
                </div>
            </div>
            <div class="stat-value">12</div>
            <div class="stat-change">
                <span>No change</span>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-title">Inactive Users</span>
                <div class="stat-icon red">
                    <i class="fas fa-user-times"></i>
                </div>
            </div>
            <div class="stat-value">106</div>
            <div class="stat-change negative">
                <i class="fas fa-arrow-down"></i>
                <span>3% from last month</span>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
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
                <option value="suspended">Suspended</option>
            </select>
        </div>

        <div class="filter-group">
            <label>Date Joined</label>
            <select class="filter-select">
                <option value="">All Time</option>
                <option value="today">Today</option>
                <option value="week">This Week</option>
                <option value="month">This Month</option>
                <option value="year">This Year</option>
            </select>
        </div>

        <button class="btn-reset">
            <i class="fas fa-redo"></i>
            Reset Filters
        </button>
    </div>

    <!-- Users Table -->
    <div class="table-card">
        <div class="table-header">
            <h5>All Users (1,234)</h5>
            <div class="table-actions">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search users...">
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
                        <th>User ID</th>
                        <th>User</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Date Joined</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td data-label="User ID">#U001</td>
                        <td data-label="User">
                            <div class="user-cell">
                                <div class="user-avatar">JD</div>
                                <div class="user-info">
                                    <strong>Juan Dela Cruz</strong>
                                </div>
                            </div>
                        </td>
                        <td data-label="Email">juancruz@email.com</td>
                        <td data-label="Role">
                            <span class="role-badge admin">
                                <i class="fas fa-user-shield"></i>
                                Admin
                            </span>
                        </td>
                        <td data-label="Status"><span class="badge success">Active</span></td>
                        <td data-label="Date Joined">March 12, 2024</td>
                        <td data-label="Actions">
                            <div class="action-btns">
                                <button class="btn-sm btn-info" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn-sm btn-success" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn-sm btn-danger" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td data-label="User ID">#U002</td>
                        <td data-label="User">
                            <div class="user-cell">
                                <div class="user-avatar">MS</div>
                                <div class="user-info">
                                    <strong>Maria Santos</strong>
                                </div>
                            </div>
                        </td>
                        <td data-label="Email">mariasantos@email.com</td>
                        <td data-label="Role">
                            <span class="role-badge student">
                                <i class="fas fa-user-graduate"></i>
                                Student
                            </span>
                        </td>
                        <td data-label="Status"><span class="badge danger">Inactive</span></td>
                        <td data-label="Date Joined">June 5, 2024</td>
                        <td data-label="Actions">
                            <div class="action-btns">
                                <button class="btn-sm btn-activate" title="Activate User">
                                    <i class="fas fa-check-circle"></i>
                                    <span>Activate</span>
                                </button>
                                <button class="btn-sm btn-info" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn-sm btn-success" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn-sm btn-danger" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td data-label="User ID">#U003</td>
                        <td data-label="User">
                            <div class="user-cell">
                                <div class="user-avatar">AR</div>
                                <div class="user-info">
                                    <strong>Alex Reyes</strong>
                                </div>
                            </div>
                        </td>
                        <td data-label="Email">alexreyes@email.com</td>
                        <td data-label="Role">
                            <span class="role-badge staff">
                                <i class="fas fa-user-tie"></i>
                                Staff
                            </span>
                        </td>
                        <td data-label="Status"><span class="badge success">Active</span></td>
                        <td data-label="Date Joined">January 15, 2024</td>
                        <td data-label="Actions">
                            <div class="action-btns">
                                <button class="btn-sm btn-info" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn-sm btn-success" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn-sm btn-danger" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td data-label="User ID">#U004</td>
                        <td data-label="User">
                            <div class="user-cell">
                                <div class="user-avatar">CG</div>
                                <div class="user-info">
                                    <strong>Carlos Garcia</strong>
                                </div>
                            </div>
                        </td>
                        <td data-label="Email">carlosgarcia@email.com</td>
                        <td data-label="Role">
                            <span class="role-badge student">
                                <i class="fas fa-user-graduate"></i>
                                Student
                            </span>
                        </td>
                        <td data-label="Status"><span class="badge success">Active</span></td>
                        <td data-label="Date Joined">September 22, 2024</td>
                        <td data-label="Actions">
                            <div class="action-btns">
                                <button class="btn-sm btn-info" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn-sm btn-success" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn-sm btn-danger" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td data-label="User ID">#U005</td>
                        <td data-label="User">
                            <div class="user-cell">
                                <div class="user-avatar">LT</div>
                                <div class="user-info">
                                    <strong>Lisa Tan</strong>
                                </div>
                            </div>
                        </td>
                        <td data-label="Email">lisatan@email.com</td>
                        <td data-label="Role">
                            <span class="role-badge admin">
                                <i class="fas fa-user-shield"></i>
                                Admin
                            </span>
                        </td>
                        <td data-label="Status"><span class="badge success">Active</span></td>
                        <td data-label="Date Joined">February 8, 2024</td>
                        <td data-label="Actions">
                            <div class="action-btns">
                                <button class="btn-sm btn-info" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn-sm btn-success" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn-sm btn-danger" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="table-footer">
            <div class="showing-info">
                Showing 1 to 5 of 1,234 users
            </div>
            <div class="pagination">
                <button class="page-btn" disabled>
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="page-btn active">1</button>
                <button class="page-btn">2</button>
                <button class="page-btn">3</button>
                <span class="page-dots">...</span>
                <button class="page-btn">247</button>
                <button class="page-btn">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </div>
</main>
@endsection

@section('scripts')
<script>
    // Filter functionality
    document.querySelectorAll('.filter-select').forEach(select => {
        select.addEventListener('change', function() {
            console.log('Filter changed:', this.value);
            // Add your filter logic here
        });
    });

    // Reset filters
    document.querySelector('.btn-reset').addEventListener('click', function() {
        document.querySelectorAll('.filter-select').forEach(select => {
            select.value = '';
        });
    });

    // Activate button functionality
    document.querySelectorAll('.btn-activate').forEach(btn => {
        btn.addEventListener('click', function() {
            if(confirm('Activate this user account?')) {
                console.log('User activated');
                // Add your activation logic here
            }
        });
    });

    // Search functionality
    document.querySelector('.search-box input').addEventListener('input', function() {
        console.log('Searching:', this.value);
        // Add your search logic here
    });

    // Export functionality
    document.querySelector('.btn-export').addEventListener('click', function() {
        console.log('Exporting data...');
        // Add your export logic here
    });
</script>
@endsection
