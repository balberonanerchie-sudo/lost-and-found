@extends('layout.default')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/manage-item.css') }}">
@endsection

@section('content')
    @include('partials.navbar')

    <div class="container-fluid py-4">
        <div class="page-header">
            <h3 class="fw-bold">Manage Item</h3>
            <div class="text-end mb-1">
                <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#newItemModal"><i class="bi bi-plus-circle me-2"></i>Add Item</button>
            </div>
        </div>

         <div class="card p-4 mb-4">
            <div class="row g-3">
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <label class="form-label">Search Item</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <input type="text" class="form-control" placeholder="Enter name or ID...">
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-12">
                    <label class="form-label">Category</label>
                    <select class="form-select">
                        <option>All</option>
                        <option>Lost</option>
                        <option>Found</option>
                        <option>Returned</option>
                    </select>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-12">
                    <label class="form-label">Status</label>
                    <select class="form-select">
                        <option>All Status</option>
                        <option>Pending</option>
                        <option>Claimed</option>
                        <option>Unclaimed</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <label class="form-label">Date</label>
                    <input type="date" class="form-control">
                </div>
                <div class="col-lg-2 col-md-6 col-sm-12 d-flex align-items-end">
                    <button class="btn btn-outline-success w-100"><i class="fas fa-filter me-1"></i> Filter</button>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
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
                                <td><img src="Image/wallet.jpg" class="rounded" alt="" width="60"></td>
                                <td>Black Wallet</td>
                                <td>Library</td>
                                <td>Oct 10, 2025</td>
                                <td><span class="badge bg-warning text-dark">Unclaimed</span></td>
                                <td></td>
                                <td>
                                    <button class="btn btn-sm btn-primary me-2" data-bs-toggle="modal" data-bs-target="#editItemModal"><i class="fas fa-edit"></i> Edit</button>
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteItemModal"><i class="fas fa-trash"></i> Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td><img src="Image/umbrella.jpg" class="rounded" alt="" width="60"></td>
                                <td>Umbrella</td>
                                <td>Gate 3</td>
                                <td>Oct 12, 2025</td>
                                <td><span class="badge bg-success">Claimed</span></td>
                                <td>John Doe</td>
                                <td>
                                    <button class="btn btn-sm btn-primary me-2" data-bs-toggle="modal" data-bs-target="#editItemModal"><i class="fas fa-edit"></i> Edit</button>
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs
                                    
                                    
                                    -target="#deleteItemModal"><i class="fas fa-trash"></i> Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- New Item Modal -->
    <div class="modal fade" id="newItemModal" tabindex="-1" aria-labelledby="newItemModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newItemModalLabel">New Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="itemName" class="form-label">Item Name</label>
                            <input type="text" class="form-control" id="itemName">
                        </div>
                        <div class="mb-3">
                            <label for="itemLocation" class="form-label">Location Found</label>
                            <input type="text" class="form-control" id="itemLocation">
                        </div>
                        <div class="mb-3">
                            <label for="itemDate" class="form-label">Date Found</label>
                            <input type="date" class="form-control" id="itemDate">
                        </div>
                        <div class="mb-3">
                            <label for="itemImage" class="form-label">Item Image</label>
                            <input type="file" class="form-control" id="itemImage">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save Item</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Item Modal -->
    <div class="modal fade" id="editItemModal" tabindex="-1" aria-labelledby="editItemModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editItemModalLabel">Edit Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="editItemName" class="form-label">Item Name</label>
                            <input type="text" class="form-control" id="editItemName" value="Black Wallet">
                        </div>
                        <div class="mb-3">
                            <label for="editItemLocation" class="form-label">Location Found</label>
                            <input type="text" class="form-control" id="editItemLocation" value="Library">
                        </div>
                        <div class="mb-3">
                            <label for="editItemDate" class="form-label">Date Found</label>
                            <input type="date" class="form-control" id="editItemDate" value="2025-10-10">
                        </div>
                        <div class="mb-3">
                            <label for="editItemImage" class="form-label">Item Image</label>
                            <input type="file" class="form-control" id="editItemImage">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Item Modal -->
    <div class="modal fade" id="deleteItemModal" tabindex="-1" aria-labelledby="deleteItemModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteItemModalLabel">Delete Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this item? This action cannot be undone.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger">Delete Item</button>
                </div>
            </div>
        </div>
    </div>
@endsection
