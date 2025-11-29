@extends('layout.default')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/manage-user.css') }}">
@endsection

@section('content')
    <header>
        <div class="menu-toggle">
        <label for="sidebar-toggle"><i class="fas fa-bars"></i></label>
      </div>
      <div class="header-icons d-flex align-items-center">
        <i class="fas fa-bell me-3"></i>
        <i class="fas fa-envelope me-3"></i>
        <i class="fas fa-user-circle"></i>
      </div>
    </header>

    <div class="container py-3 mx-4">
    <div class="page-header">
    <h3 class=" fw-bold">Manage Users</h3>
    </div>
    </div>

    <div class="filter-card mb-4 mx-4">
      <div class="row g-3 align-items-end">
        <div class="col-md-4">
          <label class="form-label fw-semibold">Search User</label>
          <div class="d-flex align-items-center border rounded px-2">
            <i class="fas fa-search text-muted me-2"></i>
            <input type="text" class="form-control border-0 shadow-none" placeholder="Enter name or ID...">
          </div>
        </div>
        <div class="col-md-3">
          <label class="form-label fw-semibold">Role</label>
          <select class="form-select">
            <option>All Roles</option>
            <option>Admin</option>
            <option>Student</option>
            <option>Staff</option>
          </select>
        </div>
        <div class="col-md-3">
          <label class="form-label fw-semibold">Status</label>
          <select class="form-select">
            <option>All Status</option>
            <option>Active</option>
            <option>Inactive</option>
          </select>
        </div>
        <div class="col-md-2 d-flex align-items-end">
            <button class="btn btn-outline-success"><i class="fas fa-filter me-1"></i> Filter</button>
          </div>
      </div>
    </div>

    <div class="table-container mx-4">
      <table class="table align-middle">
        <thead>
          <tr>
            <th>User ID</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th>Date Joined</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>#U001</td>
            <td>Juan Dela Cruz</td>
            <td>juancruz@email.com</td>
            <td>Admin</td>
            <td><span class="badge badge-success">Active</span></td>
            <td>March 12, 2024</td>
            <td>
              <button class="btn btn-sm btn-green me-2"><i class="fas fa-edit"></i></button>
              <button class="btn btn-sm btn-red"><i class="fas fa-trash"></i></button>
            </td>
          </tr>
          <tr>
            <td>#U002</td>
            <td>Maria Santos</td>
            <td>mariasantos@email.com</td>
            <td>Student</td>
            <td><span class="badge badge-secondary">Inactive</span></td>
            <td>June 5, 2024</td>
            <td>
              <button class="btn btn-sm btn-green me-2"><i class="fas fa-edit"></i></button>
              <button class="btn btn-sm btn-red"><i class="fas fa-trash"></i></button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
@endsection
