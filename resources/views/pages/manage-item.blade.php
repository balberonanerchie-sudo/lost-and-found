@extends('layout.default')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/manage-item.css') }}">
@endsection

@section('content')
    @include('partials.navbar')

    <main class="main-content">
        <div class="page-header">
            <div>
                <h3>Items</h3>
            </div>
            <button class="btn-primary" data-bs-toggle="modal" data-bs-target="#addItemModal">
                <i class="fas fa-plus"></i>
                Add New Item
            </button>
        </div>

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
                                    <i class="fas fa-map-marker-alt"></i> Library
                                </div>
                            </td>
                            <td data-label="Date Reported">Oct 10, 2025</td>
                            <td data-label="Status"><span class="badge warning">Unclaimed</span></td>
                            <td data-label="Owner">-</td>
                            <td data-label="Actions">
                                <div class="action-btns">
                                    <button class="btn-sm btn-claim" title="Mark as Claimed"><i class="fas fa-check"></i></button>
                                    <button class="btn-sm btn-info" title="View Details"><i class="fas fa-eye"></i></button>
                                    <button class="btn-sm btn-success" title="Edit"><i class="fas fa-edit"></i></button>
                                    <button class="btn-sm btn-danger" title="Delete"><i class="fas fa-trash"></i></button>
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
                                    <i class="fas fa-map-marker-alt"></i> Cafeteria
                                </div>
                            </td>
                            <td data-label="Date Reported">Oct 15, 2025</td>
                            <td data-label="Status"><span class="badge info">Pending</span></td>
                            <td data-label="Owner">Maria Cruz</td>
                            <td data-label="Actions">
                                <div class="action-btns">
                                    <button class="btn-sm btn-claim" title="Mark as Claimed"><i class="fas fa-check"></i></button>
                                    <button class="btn-sm btn-info" title="View Details"><i class="fas fa-eye"></i></button>
                                    <button class="btn-sm btn-success" title="Edit"><i class="fas fa-edit"></i></button>
                                    <button class="btn-sm btn-danger" title="Delete"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="table-footer">
                <div class="showing-info">Showing 1 to 5 of 248 items</div>
                <div class="pagination">
                    <button class="page-btn" disabled><i class="fas fa-chevron-left"></i></button>
                    <button class="page-btn active">1</button>
                    <button class="page-btn">2</button>
                    <button class="page-btn">3</button>
                    <span class="page-dots">...</span>
                    <button class="page-btn"><i class="fas fa-chevron-right"></i></button>
                </div>
            </div>
        </div>

       <div class="modal fade" id="addItemModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold">Add New Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form action="{{ url('/items/store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body p-4">
                    
                    <div class="row g-4 mb-4">
                        <div class="col-12">
                            <div class="d-flex gap-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="type" id="typeLost" value="lost" checked>
                                    <label class="form-check-label fw-medium" for="typeLost">Lost Item</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="type" id="typeFound" value="found">
                                    <label class="form-check-label fw-medium" for="typeFound">Found Item</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-medium small text-muted">Item Name</label>
                            <input type="text" name="item_name" class="form-control form-control-lg" placeholder="e.g. Blue Umbrella" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-medium small text-muted">Category</label>
                            <select name="category" class="form-select form-select-lg" required>
                                <option value="" selected disabled>Select Category</option>
                                <option value="electronics">Electronics</option>
                                <option value="wallet">Wallet/ID</option>
                                <option value="keys">Keys</option>
                                <option value="clothing">Clothing</option>
                                <option value="accessories">Accessories</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-medium small text-muted">Description</label>
                            <textarea name="description" class="form-control form-control-lg" rows="4" 
                                placeholder="Describe the item (color, brand, distinguishing marks)..." required></textarea>
                        </div>
                    </div>

                    <h5 class="fw-bold mb-4 text-success border-bottom pb-2 mt-5 d-flex align-items-center gap-2">
                        <i data-lucide="map-pin" size="20"></i> Location & Time
                    </h5>

                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-medium small text-muted">Location</label>
                            <input type="text" name="location" class="form-control form-control-lg" 
                                placeholder="e.g. Main Library, Room 304" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-medium small text-muted">Date</label>
                            <input type="date" name="date_found" class="form-control form-control-lg" required>
                        </div>
                    </div>

                    <h5 class="fw-bold mb-4 text-success border-bottom pb-2 mt-5 d-flex align-items-center gap-2">
                        <i data-lucide="image" size="20"></i> Media & Contact
                    </h5>

                    <div class="row g-4 mb-4">
                        <div class="col-12">
                            <label class="form-label fw-medium small text-muted">Upload Photo (Optional)</label>
                            <input type="file" name="image" class="form-control form-control-lg" accept=".jpg,.png,.jpeg">
                            <div class="form-text">Accepted formats: jpg, png. Max size: 5MB.</div>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-medium small text-muted">Your Email Address</label>
                            <input type="email" name="email" class="form-control form-control-lg" placeholder="you@example.com" required>
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-link text-muted text-decoration-none" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4">Add Item</button>
                </div>
            </form>
        </div>
    </div>
</div>
        <div class="modal fade" id="viewItemModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title fw-bold">Item Details</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="item-view-image bg-light text-center p-3">
                            <img id="view_image" src="" alt="Item Image" style="max-height: 200px; max-width: 100%; border-radius: 8px;">
                        </div>
                        <div class="p-4">
                            <h4 id="view_name" class="fw-bold mb-1">--</h4>
                            <p id="view_desc" class="text-muted small mb-3">--</p>
                            
                            <div class="row g-3">
                                <div class="col-6">
                                    <small class="text-muted fw-bold d-block">Category</small>
                                    <span id="view_category" class="text-dark">--</span>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted fw-bold d-block">Location</small>
                                    <span id="view_location" class="text-dark">--</span>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted fw-bold d-block">Date Reported</small>
                                    <span id="view_date" class="text-dark">--</span>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted fw-bold d-block">Status</small>
                                    <span id="view_status" class="badge bg-secondary">--</span>
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

        <div class="modal fade" id="editItemModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content border-0 shadow-lg">
                    <div class="modal-header bg-light">
                        <h5 class="modal-title fw-bold">Edit Item Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="edit_item_id" name="item_id">
                        
                        <div class="modal-body p-4">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label text-muted small fw-bold">Item Name</label>
                                    <input type="text" id="edit_name" name="item_name" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-muted small fw-bold">Category</label>
                                    <select id="edit_category" name="category" class="form-select">
                                        <option value="electronics">Electronics</option>
                                        <option value="accessories">Accessories</option>
                                        <option value="documents">Documents</option>
                                        <option value="clothing">Clothing</option>
                                        <option value="others">Others</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-muted small fw-bold">Location Found</label>
                                    <select id="edit_location" name="location" class="form-select">
                                        <option value="library">Library</option>
                                        <option value="cafeteria">Cafeteria</option>
                                        <option value="gate">Gate Area</option>
                                        <option value="classroom">Classroom</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-muted small fw-bold">Status</label>
                                    <select id="edit_status" name="status" class="form-select">
                                        <option value="unclaimed">Unclaimed</option>
                                        <option value="pending">Pending</option>
                                        <option value="claimed">Claimed</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label text-muted small fw-bold">Description</label>
                                    <textarea id="edit_desc" name="description" class="form-control" rows="3"></textarea>
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

        <div class="modal fade" id="deleteItemModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content border-0 shadow-lg">
                    <div class="modal-body p-4 text-center">
                        <div class="mb-3 text-danger">
                            <i class="fas fa-trash-alt fa-3x opacity-50"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Delete Item?</h5>
                        <p class="text-muted small mb-4">
                            Are you sure you want to delete <strong id="delete_item_name" class="text-dark">this item</strong>? 
                            This cannot be undone.
                        </p>
                        <div class="d-grid gap-2">
                            <form action="" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" id="delete_item_id_input" name="item_id">
                                <button type="submit" class="btn btn-danger w-100 fw-bold">Yes, Delete Item</button>
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
        // 1. Claim Item (Quick Action)
        document.querySelectorAll('.btn-claim').forEach(btn => {
            btn.addEventListener('click', function() {
                if(confirm('Mark this item as CLAIMED?')) {
                    // Action logic here
                    alert('Item marked as claimed.');
                }
            });
        });

        // 2. View Item Details (Populate Modal)
        document.querySelectorAll('.btn-info').forEach(btn => {
            btn.addEventListener('click', function() {
                const row = this.closest('tr');
                
                // Extract Data
                const imageSrc = row.querySelector('.item-image img').src;
                const name = row.querySelector('.item-info strong').innerText;
                const desc = row.querySelector('.item-info .item-desc').innerText;
                const category = row.querySelector('td[data-label="Category"]').innerText;
                // Clean extra whitespace/icons from location text
                const location = row.querySelector('td[data-label="Location"]').innerText.trim();
                const date = row.querySelector('td[data-label="Date Reported"]').innerText;
                const statusBadge = row.querySelector('td[data-label="Status"] .badge');

                // Populate Modal
                document.getElementById('view_image').src = imageSrc;
                document.getElementById('view_name').innerText = name;
                document.getElementById('view_desc').innerText = desc;
                document.getElementById('view_category').innerText = category;
                document.getElementById('view_location').innerText = location;
                document.getElementById('view_date').innerText = date;
                
                const modalStatus = document.getElementById('view_status');
                modalStatus.innerText = statusBadge.innerText;
                modalStatus.className = statusBadge.className;

                new bootstrap.Modal(document.getElementById('viewItemModal')).show();
            });
        });

        // 3. Edit Item (Populate Form)
        document.querySelectorAll('.btn-success').forEach(btn => {
            btn.addEventListener('click', function() {
                const row = this.closest('tr');

                // Extract Data
                const name = row.querySelector('.item-info strong').innerText;
                const desc = row.querySelector('.item-info .item-desc').innerText;
                const category = row.querySelector('td[data-label="Category"]').innerText.toLowerCase();
                const location = row.querySelector('td[data-label="Location"]').innerText.trim().toLowerCase();
                const status = row.querySelector('td[data-label="Status"]').innerText.trim().toLowerCase();

                // Populate Form
                document.getElementById('edit_name').value = name;
                document.getElementById('edit_desc').value = desc;
                
                // Helper to match select options
                const setSelect = (id, val) => {
                    const sel = document.getElementById(id);
                    for(let i=0; i<sel.options.length; i++) {
                        if(sel.options[i].text.toLowerCase().includes(val)) {
                            sel.selectedIndex = i;
                            break;
                        }
                    }
                };

                setSelect('edit_category', category);
                setSelect('edit_location', location);
                setSelect('edit_status', status);

                new bootstrap.Modal(document.getElementById('editItemModal')).show();
            });
        });

        // 4. Delete Item (Confirmation)
        document.querySelectorAll('.btn-danger').forEach(btn => {
            btn.addEventListener('click', function() {
                const row = this.closest('tr');
                const name = row.querySelector('.item-info strong').innerText;

                document.getElementById('delete_item_name').innerText = name;
                
                new bootstrap.Modal(document.getElementById('deleteItemModal')).show();
            });
        });

        // Reset Filters Button
        document.querySelector('.btn-reset').addEventListener('click', function () {
            document.querySelectorAll('.filter-select').forEach(select => select.value = '');
        });
    </script>
@endsection