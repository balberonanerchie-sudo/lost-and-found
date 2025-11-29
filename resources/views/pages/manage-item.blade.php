@extends('layout.default')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/manage-item.css') }}">
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
@endsection
