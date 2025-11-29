<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Users - Lost & Found System</title>
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <link rel="stylesheet" href="css/manage-user.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body>
   <input type="checkbox" id="sidebar-toggle">

  
  <div class="sidebar">
    <div class="sidebar-brand">
      <div class="brand-flex">
        <i class="bi bi-compass"></i>
    <span>weFind</span>
  </div>
      </div>
    

    <div class="sidebar-user">
      <i class="fas fa-user-circle fa-3x"></i>
      <h3>Nerelie Balberona</h3>
      <span>balberonanere@gmail.com</span>
    </div>

    <div class="sidebar-menu">
      <ul>
        <li><a class="nav-link" href="AdminDashboard.html"><i class="fas fa-tachometer-alt"></i>Dashboard</a></li>
        <li><a class="nav-link" href="manage-item.html"><i class="far fa-folder-open"></i> Manage Item</a></li>
        <li><a class="nav-link" href="manage-user.html"><i class="fas fa-user-alt"></i> Manage User</a></li>
        <li><a class="nav-link" href="check-appointment.html"><i class="far fa-calendar-check"></i> Check Appointment</a></li>
         <li><a class="nav-link" href="#"><i class="fas fa-sign-out-alt"></i>Logout</a></li>
      </ul>

    </div>
  </div>

  
  <div class="main-content">
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
  </div>
</body>
</html>
