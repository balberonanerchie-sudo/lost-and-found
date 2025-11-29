<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Manage Item Listings</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/manage-item.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
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
    <h3 class=" fw-bold">Manage Item</h3>
    </div>
    </div>
    
   
    <div class="filter-card bg-white rounded shadow-sm p-4 mx-4">
      <div class="row align-items-end g-3">
        <div class="col-md-4">
          <label class="form-label">Search Item</label>
          <div class="search-box d-flex align-items-center border rounded px-2">
            <i class="fas fa-search text-muted me-2"></i>
            <input type="text" class="form-control border-0" placeholder="Enter item...">
          </div>
        </div>

        <div class="col-md-2">
          <label class="form-label">Category</label>
          <select class="form-select">
            <option>All</option>
            <option>Lost</option>
            <option>Found</option>
            <option>Returned</option>
          </select>
        </div>

        <div class="col-md-2">
          <label class="form-label">Status</label>
          <select class="form-select">
            <option>All Status</option>
            <option>Pending</option>
            <option>Claimed</option>
            <option>Unclaimed</option>
          </select>
        </div>

        <div class="col-md-2">
          <label class="form-label">Date</label>
          <input type="date" class="form-control">
        </div>

        <div class="col-md-2 text-end">
          <button class="btn btn-outline-success"><i class="fas fa-filter me-1"></i> Filter</button>
          <button class="btn btn-outline-success ms-2"><i class="fas fa-plus me-1"></i> Add Item</button>
        </div>
      </div>
    </div>

    <div class="table-section mt-4 bg-white rounded shadow-sm p-4">
      <table class="table table-hover align-middle">
        <thead class="table-light">
          <tr>
            <th>Item Image</th>
            <th>Item Name</th>
            <th>Location</th>
            <th>Date Reported</th>
            <th>Status</th>
            <th>Owner</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <tr>
            <td><img src="Image/wallet.jpg" class="rounded" alt=""></td>
            <td>Black Wallet</td>
            <td>Library</td>
            <td>Oct 10, 2025</td>
            <td><span class="badge bg-warning text-dark status-badge">Unclaimed</span></td>
            <td></td>
             <td> 
            <button class="btn btn-sm btn-green me-2"><i class="fas fa-edit"></i></button>
              <button class="btn btn-sm btn-red"><i class="fas fa-trash"></i></button>
              </td>
          </tr>
          <tr>
            <td><img src="Image/umbrella.jpg" class="rounded" alt=""></td>
            <td>Umbrella</td>
            <td>Gate 3</td>
            <td>Oct 12, 2025</td>
            <td><span class="badge bg-success status-badge">Claimed</span></td>
            <td>John Doe</td>
             <td> 
            <button class="btn btn-sm btn-green me-2"><i class="fas fa-edit"></i></button>
              <button class="btn btn-sm btn-red"><i class="fas fa-trash"></i></button>
              </td>
          </tr>
          <tr>
            <td><img src="Image/bag.jpg" class="rounded" alt="bag"></td>
            <td>Blue Bag</td>
            <td>AB Building</td>
            <td>Oct 9, 2025</td>
            <td><span class="badge bg-danger status-badge">Lost</span></td>
            <td>Maria Clara</td>
            <td> 
            <button class="btn btn-sm btn-green me-2"><i class="fas fa-edit"></i></button>
              <button class="btn btn-sm btn-red"><i class="fas fa-trash"></i></button>
              </td>
          </tr>
          <tr>
            <td><img src="Image/bag.jpg" class="rounded" alt=""></td>
            <td>Blue Bag</td>
            <td>AB Building</td>
            <td>Oct 9, 2025</td>
            <td><span class="badge bg-danger status-badge">Lost</span></td>
            <td>Maria Clara</td>
            <td> 
            <button class="btn btn-sm btn-green me-2"><i class="fas fa-edit"></i></button>
              <button class="btn btn-sm btn-red"><i class="fas fa-trash"></i></button>
              </td>
          </tr>
          <tr>
            <td><img src="Image/umbrella.jpg" class="rounded" alt=""></td>
            <td>Umbrella</td>
            <td>Gate 3</td>
            <td>Oct 12, 2025</td>
            <td><span class="badge bg-success status-badge">Claimed</span></td>
            <td>John Doe</td>
            <td> 
            <button class="btn btn-sm btn-green me-2"><i class="fas fa-edit"></i></button>
              <button class="btn btn-sm btn-red"><i class="fas fa-trash"></i></button>
              </td>
          </tr>
          <tr>
            <td><img src="Image/wallet.jpg" class="rounded" alt=""></td>
            <td>Black Wallet</td>
            <td>Library</td>
            <td>Oct 10, 2025</td>
            <td><span class="badge bg-warning text-dark status-badge">Unclaimed</span></td>
            <td></td>
           <td> 
            <button class="btn btn-sm btn-green me-2"><i class="fas fa-edit"></i></button>
              <button class="btn btn-sm btn-red"><i class="fas fa-trash"></i></button>
              </td>
          </tr>
          <tr>
            <td><img src="Image/umbrella.jpg" class="rounded" alt=""></td>
            <td>Umbrella</td>
            <td>Gate 3</td>
            <td>Oct 12, 2025</td>
            <td><span class="badge bg-success status-badge">Claimed</span></td>
            <td>John Doe</td>
            <td> 
            <button class="btn btn-sm btn-green me-2"><i class="fas fa-edit"></i></button>
              <button class="btn btn-sm btn-red"><i class="fas fa-trash"></i></button>
              </td>
          </tr>
          <tr>
            <td><img src="Image/umbrella.jpg" class="rounded" alt=""></td>
            <td>Umbrella</td>
            <td>Gate 3</td>
            <td>Oct 12, 2025</td>
            <td><span class="badge bg-success status-badge">Claimed</span></td>
            <td>John Doe</td>
            <td> 
            <button class="btn btn-sm btn-green me-2"><i class="fas fa-edit"></i></button>
              <button class="btn btn-sm btn-red"><i class="fas fa-trash"></i></button>
              </td>
          </tr>
        </tbody>
      </table>
            <nav>
        <ul class="pagination justify-content-end">
          <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
          <li class="page-item active"><a class="page-link" href="#">1</a></li>
          <li class="page-item"><a class="page-link" href="#">2</a></li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item"><a class="page-link" href="#">Next</a></li>
        </ul>
      </nav>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
