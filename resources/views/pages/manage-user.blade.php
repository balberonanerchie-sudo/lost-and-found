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
        {{-- TOTAL USERS --}}
        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-title">Total Users</span>
                <div class="stat-icon green"><i class="fas fa-users"></i></div>
            </div>
            <div class="stat-value">{{ $totalUsers }}</div>
            @php
                $pct = $totalUsersChangePct;
            @endphp
            @if (!is_null($pct))
                @php $up = $pct >= 0; @endphp
                <div class="stat-change {{ $up ? 'positive' : 'negative' }}">
                    <i class="fas fa-arrow-{{ $up ? 'up' : 'down' }}"></i>
                    <span>{{ abs($pct) }}% vs last month</span>
                </div>
            @else
                <div class="stat-change"><span>No data</span></div>
            @endif
        </div>

        {{-- ACTIVE USERS --}}
        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-title">Active Users</span>
                <div class="stat-icon blue"><i class="fas fa-user-check"></i></div>
            </div>
            <div class="stat-value">{{ $activeUsers }}</div>
            @php
                $pct = $activeUsersChangePct;
            @endphp
            @if (!is_null($pct))
                @php $up = $pct >= 0; @endphp
                <div class="stat-change {{ $up ? 'positive' : 'negative' }}">
                    <i class="fas fa-arrow-{{ $up ? 'up' : 'down' }}"></i>
                    <span>{{ abs($pct) }}% vs last month</span>
                </div>
            @else
                <div class="stat-change"><span>No data</span></div>
            @endif
        </div>

        {{-- ADMINS --}}
        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-title">Admins</span>
                <div class="stat-icon yellow"><i class="fas fa-user-shield"></i></div>
            </div>
            <div class="stat-value">{{ $adminCount }}</div>
            @php
                $pct = $adminChangePct;
            @endphp
            @if (!is_null($pct))
                @php $up = $pct >= 0; @endphp
                <div class="stat-change {{ $up ? 'positive' : 'negative' }}">
                    <i class="fas fa-arrow-{{ $up ? 'up' : 'down' }}"></i>
                    <span>{{ abs($pct) }}% vs last month</span>
                </div>
            @else
                <div class="stat-change"><span>No data</span></div>
            @endif
        </div>

        {{-- INACTIVE USERS --}}
        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-title">Inactive</span>
                <div class="stat-icon red"><i class="fas fa-user-times"></i></div>
            </div>
            <div class="stat-value">{{ $inactiveUsers }}</div>
            @php
                $pct = $inactiveChangePct;
            @endphp
            @if (!is_null($pct))
                @php $up = $pct <= 0; @endphp {{-- fewer inactives is good --}}
                <div class="stat-change {{ $up ? 'positive' : 'negative' }}">
                    <i class="fas fa-arrow-{{ $up ? 'down' : 'up' }}"></i>
                    <span>{{ abs($pct) }}% vs last month</span>
                </div>
            @else
                <div class="stat-change"><span>No data</span></div>
            @endif
        </div>
    </div>

    {{-- FILTERS + SEARCH (GET) --}}
    <form id="userFiltersForm" action="{{ route('admin.users') }}" method="GET">
        <div class="filter-section">
            <div class="filter-group">
                <label>Role</label>
                <select class="filter-select" name="role">
                    <option value="">All Roles</option>
                    <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="user"  {{ request('role') === 'user'  ? 'selected' : '' }}>User</option>
                </select>
            </div>
            <div class="filter-group">
                <label>Status</label>
                <select class="filter-select" name="status">
                    <option value="">All Status</option>
                    <option value="active"   {{ request('status') === 'active'   ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            <button type="button" class="btn-reset"
                    onclick="window.location='{{ route('admin.users') }}'">
                <i class="fas fa-redo"></i> Reset
            </button>
        </div>

        <div class="table-card">
            <div class="table-header">
                <h5>All Users ({{ $users->total() }})</h5>
                <div class="table-actions">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text"
                               name="search"
                               form="userFiltersForm"
                               placeholder="Search users..."
                               value="{{ request('search') }}">
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Email</th>
                            <th>Department</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Joined</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($users as $user)
                        <tr>
                            {{-- ID --}}
                            <td data-label="ID">#U{{ str_pad($user->id, 3, '0', STR_PAD_LEFT) }}</td>

                            {{-- USER + AVATAR --}}
                            <td data-label="User">
                                <div class="user-cell">
                                    @php
                                        $initials = collect(explode(' ', $user->name))
                                            ->filter()
                                            ->take(2)
                                            ->map(fn($p) => strtoupper(mb_substr($p, 0, 1)))
                                            ->implode('');
                                    @endphp
                                    <div class="user-avatar">{{ $initials }}</div>
                                    <div class="user-info"><strong>{{ $user->name }}</strong></div>
                                </div>
                            </td>

                            {{-- EMAIL --}}
                            <td data-label="Email">{{ $user->email }}</td>

                            {{-- DEPARTMENT --}}
                            <td data-label="Department">{{ $user->department ?? '-' }}</td>

                            {{-- ROLE --}}
                            <td data-label="Role">
                                @php
                                    $roleLabel = $user->role === 'admin' ? 'Admin' : 'User';
                                    $roleClass = $user->role === 'admin' ? 'warning' : 'info';
                                @endphp
                                <span class="badge {{ $roleClass }}">{{ $roleLabel }}</span>
                            </td>

                            {{-- STATUS --}}
                            <td data-label="Status">
                                <span class="badge {{ $user->status === 'active' ? 'success' : 'danger' }}">
                                    {{ ucfirst($user->status) }}
                                </span>
                            </td>

                            {{-- JOINED --}}
                            <td data-label="Joined">
                                {{ $user->created_at ? $user->created_at->format('M d, Y') : '-' }}
                            </td>

                            {{-- ACTIONS --}}
                            <td data-label="Actions">
                                <div class="action-btns">
                                    {{-- EDIT --}}
                                    <button type="button"
                                            class="btn-sm btn-success btn-edit-user"
                                            title="Edit"
                                            data-id="{{ $user->id }}"
                                            data-name="{{ $user->name }}"
                                            data-email="{{ $user->email }}"
                                            data-role="{{ $user->role }}"
                                            data-status="{{ $user->status }}"
                                            data-department="{{ $user->department }}">
                                        <i class="fas fa-edit"></i>
                                    </button>

                                    {{-- DELETE --}}
                                    <button type="button"
                                            class="btn-sm btn-danger btn-delete-user"
                                            title="Delete"
                                            data-id="{{ $user->id }}"
                                            data-name="{{ $user->name }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">
                                No users found.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div class="table-footer">
                <div class="showing-info">
                    @if ($users->total())
                        Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} users
                    @else
                        Showing 0 users
                    @endif
                </div>
                <div class="d-flex justify-content-end">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </form>

    {{-- ADD USER MODAL --}}
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-light">
                    <h5 class="modal-title fw-bold">Add New User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.users.store') }}" method="POST">
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
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Department</label>
                            <input type="text" name="department" class="form-control" placeholder="e.g. College of IT">
                        </div>
                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <label class="form-label text-muted small fw-bold">Role</label>
                                <select name="role" class="form-select">
                                    <option value="user">User</option>
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
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm password">
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

    {{-- VIEW USER MODAL --}}
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
                            <div class="col-12 mt-3">
                                <small class="text-muted fw-bold d-block">Department</small>
                                <span id="view_department" class="text-dark">--</span>
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

    {{-- EDIT USER MODAL --}}
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-light">
                    <h5 class="modal-title fw-bold">Edit User Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.users.update') }}" method="POST">
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
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Department</label>
                            <input type="text" id="edit_department" name="department" class="form-control">
                        </div>
                        <div class="row g-2">
                            <div class="col-6">
                                <label class="form-label text-muted small fw-bold">Role</label>
                                <select id="edit_role" name="role" class="form-select">
                                    <option value="user">User</option>
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

    {{-- DELETE USER MODAL --}}
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
                        <form action="{{ route('admin.users.destroy') }}" method="POST">
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
document.addEventListener('DOMContentLoaded', () => {
    const userForm = document.getElementById('userFiltersForm');

    // 1) Auto-submit Role/Status filters on change
    if (userForm) {
        document.querySelectorAll('#userFiltersForm .filter-select').forEach(el => {
            el.addEventListener('change', () => {
                userForm.submit();
            });
        });
    }

    // 2) Search bar: submit only when user presses Enter
    const userSearch = document.querySelector('input[name="search"][form="userFiltersForm"]');
    if (userSearch && userForm) {
        userSearch.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') {
                e.preventDefault();
                userForm.submit();
            }
        });
    }

    // 3) Edit User Modal
    document.querySelectorAll('.btn-edit-user').forEach(btn => {
        btn.addEventListener('click', function () {
            const d = this.dataset;

            document.getElementById('edit_id').value         = d.id;
            document.getElementById('edit_name').value       = d.name;
            document.getElementById('edit_email').value      = d.email;
            document.getElementById('edit_department').value = d.department || '';
            document.getElementById('edit_role').value       = d.role;
            document.getElementById('edit_status').value     = d.status;

            const editModalEl = document.getElementById('editUserModal');
            const editModal   = bootstrap.Modal.getOrCreateInstance(editModalEl);
            editModal.show();
        });
    });

    // 4) Delete User Modal
    document.querySelectorAll('.btn-delete-user').forEach(btn => {
        btn.addEventListener('click', function () {
            document.getElementById('delete_id').value       = this.dataset.id;
            document.getElementById('delete_name').innerText = this.dataset.name;

            const deleteModalEl = document.getElementById('deleteUserModal');
            const deleteModal   = bootstrap.Modal.getOrCreateInstance(deleteModalEl);
            deleteModal.show();
        });
    });
});
</script>
@endsection
