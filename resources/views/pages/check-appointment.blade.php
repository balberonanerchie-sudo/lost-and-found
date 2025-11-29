<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Check Appointments - Lost & Found Portal</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="css/check-appointment.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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
        <li><a class="nav-link" href="check-appointment.html"><i class="far fa-calendar-check"></i>Manage Appointment</a></li>
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

    <div class="container-fluid p-4">
      <div class="page-header">
        <h3>Manage Appointments</h3>
        <div>
          <button class="btn btn-success me-2"><i class="bi bi-download"></i> Export</button>
          <button class="btn btn-primary"><i class="bi bi-plus-circle"></i> New Appointment</button>
        </div>
      </div>

      <div class="card-box">
        <div class="row g-3">
          <div class="col-md-3">
            <label class="form-label">Search Appointment</label>
            <div class="search-box d-flex align-items-center border rounded px-2">
            <i class="fas fa-search text-muted me-2"></i>
            <input type="text" class="form-control border-0" placeholder="Enter name or item...">
          </div>
        </div>
          <div class="col-md-3">
            <label class="form-label">Status</label>
            <select class="form-select">
              <option>All Status</option>
              <option>Pending</option>
              <option>Approved</option>
              <option>Declined</option>
            </select>
          </div>
          <div class="col-md-4">
            <label class="form-label">Date</label>
            <input type="date" class="form-control">
          </div>
          <div class="col-md-2 d-flex align-items-end">
             <button class="btn btn-outline-success"><i class="fas fa-filter me-1"></i> Filter</button>
          </div>
        </div>
      </div>


      <div class="row g-3">
        <div class="col-md-8">
          <div class="card h-100 p-3 shadow-sm">
            <h5 class="mb-3">Appointments</h5>
            <div class="table-responsive">
              <table class="table align-middle ">
                <thead>
                  <tr>
                    <th>User</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Item</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Maria Garcia</td>
                    <td>2025-10-12</td>
                    <td>10:30 AM</td>
                    <td>Wallet</td>
                    <td><span class="badge bg-warning">Pending</span></td>
                    <td>
                      <button class="btn btn-success btn-sm">Approve</button>
                      <button class="btn btn-primary btn-sm">Reschedule</button>
                    </td>
                  </tr>
                  <tr>
                    <td>Robert Johnson</td>
                    <td>2025-10-13</td>
                    <td>2:00 PM</td>
                    <td>Phone</td>
                    <td><span class="badge bg-success">Approved</span></td>
                    <td>
                      <button class="btn btn-success btn-sm">Approve</button>
                      <button class="btn btn-primary btn-sm">Reschedule</button>
                    </td>
                  </tr>
                  <tr>
                    <td>Sarah Williams</td>
                    <td>2025-10-14</td>
                    <td>3:00 PM</td>
                    <td>Umbrella</td>
                    <td><span class="badge bg-danger">Declined</span></td>
                    <td>
                      <button class="btn btn-success btn-sm">Approve</button>
                      <button class="btn btn-primary btn-sm">Reschedule</button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <!-- Right Card -->
        <div class="col-md-4">
          <div class="card h-100 p-3 shadow-sm">
            <h5 class="mb-3">Approved Appointments</h5>
            <div class="table-responsive">
              <table class="table align-middle">
                <thead class="table-success">
                  <tr>
                    <th>User</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Item</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Robert Johnson</td>
                    <td>2025-10-13</td>
                    <td>2:00 PM</td>
                    <td>Phone</td>
                    <td><span class="badge bg-success">Approved</span></td>
                  </tr>
                  <tr>
                    <td>Jennifer Lee</td>
                    <td>2025-10-14</td>
                    <td>10:45 AM</td>
                    <td>Bag</td>
                    <td><span class="badge bg-success">Approved</span></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
