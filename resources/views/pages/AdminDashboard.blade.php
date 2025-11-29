@extends('layout.default')

@section('styles')

<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endsection



@section('content')

  <header>
    <div class="menu-toggle">
      <label for="sidebar-toggle"><i class="fas fa-bars"></i></label>
    </div>
  
    <div class="top-navbar d-flex align-items-center justify-content-between">
      <div class="d-flex align-items-center">
        <div class="search-bar me-3">
          <input type="text" class="form-control form-control-sm" placeholder="Search...">
  
        </div>
        <i class="fas fa-bell me-3"></i>
        <i class="fas fa-envelope me-3"></i>
        <i class="fas fa-user-circle"></i>
      </div>
    </div>
  </header>

  <div class="container py-3 mx-4">
    <div class="page-header">
      <h3 class=" fw-bold">Dashboard</h3>
    </div>
  </div>

  <div class="main">
    <main class="container-fluid">
      <div class="dashboard-cards row g-4 mb-4">
        <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="card text-center p-3">
            <i class="fas fa-box-open text-success"></i>
            <h5>Total Found Items</h5>
            <h3>120</h3>
          </div>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="card text-center p-3">
            <i class="fas fa-search text-danger"></i>
            <h5>Total Lost Reports</h5>
            <h3>98</h3>
          </div>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="card text-center p-3">
            <i class="fas fa-undo text-primary"></i>
            <h5>Returned Items</h5>
            <h3>75</h3>
          </div>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="card text-center p-3">
            <i class="fas fa-hourglass-half text-warning"></i>
            <h5>Pending Approvals</h5>
            <h3>10</h3>
          </div>
        </div>
      </div>

      <div class="container-fluid mt-4">
        <div class="row">
          <div class="col-lg-6 col-md-12 mb-4">
            <div class="card shadow-sm">
              <div class="card-header bg-success text-white">
                <i class="fas fa-file-alt me-2"></i> Recent Reports
              </div>
              <div class="card-body">
                <table class="table table-hover">
                  <thead class="table-success">
                    <tr>
                      <th>Report ID</th>
                      <th>Item Name</th>
                      <th>Status</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>#001</td>
                      <td>Black Wallet</td>
                      <td>Found</td>
                      <td>Oct 5, 2025</td>
                    </tr>
                    <tr>
                      <td>#002</td>
                      <td>School ID</td>
                      <td>Lost</td>
                      <td>Oct 8, 2025</td>
                    </tr>
                    <tr>
                      <td>#003</td>
                      <td>Umbrella</td>
                      <td>Found</td>
                      <td>Oct 9, 2025</td>
                    </tr>
                    <tr>
                      <td>#004</td>
                      <td>Book</td>
                      <td>Found</td>
                      <td>Oct 9, 2025</td>
                    </tr>
                    <tr>
                      <td>#005</td>
                      <td>Phone</td>
                      <td>Lost</td>
                      <td>Oct 10, 2025</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <div class="col-lg-6 col-md-12 mb-4">
            <div class="card shadow-sm">
              <div class="card-header bg-info text-white">
                <i class="fas fa-calendar-check me-2"></i> Appointment
              </div>
              <div class="card-body">
                <table class="table  table-hover">
                  <thead class="table-info">
                    <tr>
                      <th>Appointment ID</th>
                      <th>Name</th>
                      <th>Purpose</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>#A01</td>
                      <td>John Doe</td>
                      <td>Claim Item</td>
                      <td>Oct 10, 2025</td>
                    </tr>
                    <tr>
                      <td>#A02</td>
                      <td>Maria Cruz</td>
                      <td>Report Lost Item</td>
                      <td>Oct 11, 2025</td>
                    </tr>
                    <tr>
                      <td>#A03</td>
                      <td>Alex Reyes</td>
                      <td>Verification</td>
                      <td>Oct 12, 2025</td>
                    </tr>
                    <tr>
                      <td>#A04</td>
                      <td>Elvie Gequilan</td>
                      <td>Verification</td>
                      <td>Oct 13
                        , 2025</td>
                    </tr>
                    <tr>
                      <td>#A05</td>
                      <td>Hendrey Desierto</td>
                      <td>Verification</td>
                      <td>Oct 15, 2025</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
@endsection