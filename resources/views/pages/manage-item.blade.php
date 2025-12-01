@extends('layout.default')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/manage-item.css') }}">
@endsection

@section('content')
    @include('partials.navbar')

    <main class="main-content">
        <div class="page-header">
            <div>
                <h3>Manage Items</h3>
                <p>Track and manage all lost and found items in the system</p>
            </div>
            <button class="btn-primary" data-bs-toggle="modal" data-bs-target="#addItemModal">
                <i class="fas fa-plus"></i>
                Add New Item
            </button>
        </div>

        <!-- Filter Section -->
        <div class="filter-section">
            <div class="filter-group">
                <label>Status</label>
                <select class="filter-select">
                    <option value="">All Status</option>
                    <option value="unclaimed">Unclaimed</option>
                    <option value="claimed">Claimed</option>
                    <option value="pending">Pending</option>
                </select>
            </div>

            <div class="filter-group">
                <label>Category</label>
                <select class="filter-select">
                    <option value="">All Categories</option>
                    <option value="electronics">Electronics</option>
                    <option value="accessories">Accessories</option>
                    <option value="documents">Documents</option>
                    <option value="clothing">Clothing</option>
                    <option value="others">Others</option>
                </select>
            </div>

            <div class="filter-group">
                <label>Location</label>
                <select class="filter-select">
                    <option value="">All Locations</option>
                    <option value="library">Library</option>
                    <option value="cafeteria">Cafeteria</option>
                    <option value="gate">Gate Area</option>
                    <option value="classroom">Classroom</option>
                </select>
            </div>

            <button class="btn-reset">
                <i class="fas fa-redo"></i>
                Reset Filters
            </button>
        </div>

        <!-- Items Table -->
        <div class="table-card">
            <div class="table-header">
                <h5>All Items (248)</h5>
                <div class="table-actions">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Search items...">
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
                            <th>Item Image</th>
                            <th>Item Name</th>
                            <th>Category</th>
                            <th>Location</th>
                            <th>Date Reported</th>
                            <th>Status</th>
                            <th>Owner</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td data-label="Item Image">
                                <div class="item-image">
                                    <img src="{{ asset('img/items/wallet.jpg') }}" alt="Wallet">
                                </div>
                            </td>
                            <td data-label="Item Name">
                                <div class="item-info">
                                    <strong>Black Wallet</strong>
                                    <span class="item-desc">Leather wallet with cards</span>
                                </div>
                            </td>
                            <td data-label="Category">Accessories</td>
                            <td data-label="Location">
                                <div class="location-tag">
                                    <i class="fas fa-map-marker-alt"></i>
                                    Library
                                </div>
                            </td>
                            <td data-label="Date Reported">Oct 10, 2025</td>
                            <td data-label="Status"><span class="badge warning">Unclaimed</span></td>
                            <td data-label="Owner">-</td>
                            <td data-label="Actions">
                                <div class="action-btns">
                                    <button class="btn-sm btn-claim" title="Mark as Claimed">
                                        <i class="fas fa-check"></i>
                                        <span>Claimed</span>
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
                            <td data-label="Item Image">
                                <div class="item-image">
                                    <img src="{{ asset('img/items/umbrella.jpg') }}" alt="Umbrella">
                                </div>
                            </td>
                            <td data-label="Item Name">
                                <div class="item-info">
                                    <strong>Blue Umbrella</strong>
                                    <span class="item-desc">Foldable umbrella</span>
                                </div>
                            </td>
                            <td data-label="Category">Others</td>
                            <td data-label="Location">
                                <div class="location-tag">
                                    <i class="fas fa-map-marker-alt"></i>
                                    Gate 3
                                </div>
                            </td>
                            <td data-label="Date Reported">Oct 12, 2025</td>
                            <td data-label="Status"><span class="badge success">Claimed</span></td>
                            <td data-label="Owner">John Doe</td>
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
                            <td data-label="Item Image">
                                <div class="item-image">
                                    <img src="{{ asset('img/items/phone.jpg') }}" alt="Phone">
                                </div>
                            </td>
                            <td data-label="Item Name">
                                <div class="item-info">
                                    <strong>iPhone 13</strong>
                                    <span class="item-desc">Black iPhone with case</span>
                                </div>
                            </td>
                            <td data-label="Category">Electronics</td>
                            <td data-label="Location">
                                <div class="location-tag">
                                    <i class="fas fa-map-marker-alt"></i>
                                    Cafeteria
                                </div>
                            </td>
                            <td data-label="Date Reported">Oct 15, 2025</td>
                            <td data-label="Status"><span class="badge info">Pending Claim</span></td>
                            <td data-label="Owner">Maria Cruz</td>
                            <td data-label="Actions">
                                <div class="action-btns">
                                    <button class="btn-sm btn-claim" title="Mark as Claimed">
                                        <i class="fas fa-check"></i>
                                        <span>Claimed</span>
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
                            <td data-label="Item Image">
                                <div class="item-image">
                                    <img src="{{ asset('img/items/id.jpg') }}" alt="ID">
                                </div>
                            </td>
                            <td data-label="Item Name">
                                <div class="item-info">
                                    <strong>Student ID</strong>
                                    <span class="item-desc">DNSC ID Card - 2023-0123</span>
                                </div>
                            </td>
                            <td data-label="Category">Documents</td>
                            <td data-label="Location">
                                <div class="location-tag">
                                    <i class="fas fa-map-marker-alt"></i>
                                    Room 301
                                </div>
                            </td>
                            <td data-label="Date Reported">Oct 18, 2025</td>
                            <td data-label="Status"><span class="badge warning">Unclaimed</span></td>
                            <td data-label="Owner">-</td>
                            <td data-label="Actions">
                                <div class="action-btns">
                                    <button class="btn-sm btn-claim" title="Mark as Claimed">
                                        <i class="fas fa-check"></i>
                                        <span>Claimed</span>
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
                            <td data-label="Item Image">
                                <div class="item-image">
                                    <img src="{{ asset('img/items/bag.jpg') }}" alt="Bag">
                                </div>
                            </td>
                            <td data-label="Item Name">
                                <div class="item-info">
                                    <strong>Black Backpack</strong>
                                    <span class="item-desc">Nike backpack with laptop</span>
                                </div>
                            </td>
                            <td data-label="Category">Accessories</td>
                            <td data-label="Location">
                                <div class="location-tag">
                                    <i class="fas fa-map-marker-alt"></i>
                                    Gym
                                </div>
                            </td>
                            <td data-label="Date Reported">Oct 20, 2025</td>
                            <td data-label="Status"><span class="badge warning">Unclaimed</span></td>
                            <td data-label="Owner">-</td>
                            <td data-label="Actions">
                                <div class="action-btns">
                                    <button class="btn-sm btn-claim" title="Mark as Claimed">
                                        <i class="fas fa-check"></i>
                                        <span>Claimed</span>
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
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="table-footer">
                <div class="showing-info">
                    Showing 1 to 5 of 248 items
                </div>
                <div class="pagination">
                    <button class="page-btn" disabled>
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="page-btn active">1</button>
                    <button class="page-btn">2</button>
                    <button class="page-btn">3</button>
                    <span class="page-dots">...</span>
                    <button class="page-btn">50</button>
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
            select.addEventListener('change', function () {
                console.log('Filter changed:', this.value);
                // Add your filter logic here
            });
        });

        // Reset filters
        document.querySelector('.btn-reset').addEventListener('click', function () {
            document.querySelectorAll('.filter-select').forEach(select => {
                select.value = '';
            });
        });

        // Claimed button functionality
        document.querySelectorAll('.btn-claim').forEach(btn => {
            btn.addEventListener('click', function () {
                if (confirm('Mark this item as claimed?')) {
                    // Add your claim logic here
                    console.log('Item claimed');
                }
            });
        });

        // Search functionality
        document.querySelector('.search-box input').addEventListener('input', function () {
            console.log('Searching:', this.value);
            // Add your search logic here
        });

        // Export functionality
        document.querySelector('.btn-export').addEventListener('click', function () {
            console.log('Exporting data...');
            // Add your export logic here
        });
    </script>
@endsection
