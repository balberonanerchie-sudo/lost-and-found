@extends('layout.nav-student')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endsection

<!-- 10. Report Item Modal -->
    <div class="modal fade" id="reportItemModal" tabindex="-1" aria-labelledby="reportItemModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fs-5 fw-bold text-dark" id="reportItemModalLabel">Report a Lost or Found Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
<div class="modal-body">
    <form>
        <div class="row g-4">
            <div class="col-lg-6">
                <h6 class="fw-bold mb-3 d-flex align-items-center text-logo-green">
                    <i data-lucide="box" class="me-2"></i> Item Details
                </h6>
                
                <div class="mb-3">
                    <label for="itemType" class="form-label fw-medium text-muted">Are you reporting a:</label>
                    <select class="form-select form-select-lg rounded-xl border" id="itemType">
                        <option selected>Lost Item</option>
                        <option>Found Item</option>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label for="itemName" class="form-label fw-medium text-muted">Item Name (e.g., Brown Leather Wallet)</label>
                    <input type="text" class="form-control form-control-lg rounded-xl border" id="itemName" placeholder="e.g., iPhone 15 Pro, Black Umbrella">
                </div>
                
                <div class="mb-3">
                    <label for="itemCategory" class="form-label fw-medium text-muted">Category</label>
                    <select class="form-select form-select-lg rounded-xl border" id="itemCategory">
                        <option selected>Electronics</option>
                        <option>Wallet/ID</option>
                        <option>Keys</option>
                        <option>Bags/Luggage</option>
                        <option>Clothing</option>
                        <option>Other</option>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label for="itemDescription" class="form-label fw-medium text-muted">Detailed Description (Color, distinguishing marks, etc.)</label>
                    <textarea class="form-control rounded-xl border" id="itemDescription" rows="3" placeholder="Describe the item, including any unique features or contents."></textarea>
                </div>
            </div>

            <div class="col-lg-6">
                <h6 class="fw-bold mb-3 d-flex align-items-center text-logo-green">
                    <i data-lucide="map-pin" class="me-2"></i> Location & Time
                </h6>

                <div class="mb-3">
                    <label for="itemLocation" class="form-label fw-medium text-muted">Location Lost or Found</label>
                    <input type="text" class="form-control form-control-lg rounded-xl border" id="itemLocation" placeholder="e.g., Near City Park fountain, Bus #42 stop">
                </div>
                
                <div class="mb-4">
                    <label for="itemDate" class="form-label fw-medium text-muted">Date Lost or Found</label>
                    <input type="date" class="form-control form-control-lg rounded-xl border" id="itemDate">
                </div>

                <h6 class="fw-bold mb-3 d-flex align-items-center text-logo-green">
                    <i data-lucide="image" class="me-2"></i> Add Photo
                </h6>
                <div class="mb-4">
                    <label for="itemImage" class="form-label fw-medium text-muted">Upload Photo (Optional but highly recommended)</label>
                    <input class="form-control rounded-xl border" type="file" id="itemImage" accept="image/*">
                </div>
                
                <h6 class="fw-bold mb-3 d-flex align-items-center text-logo-green">

                    <i data-lucide="user" class="me-2"></i> Your Contact Info
                </h6>
                <div class="mb-3">
                    <label for="reporterEmail" class="form-label fw-medium text-muted">Email for Contact</label>
                    <input type="email" class="form-control form-control-lg rounded-xl border" id="reporterEmail" placeholder="Your contact email">
                </div>
            </div>
        </div>
    </form>
</div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-dark-text rounded-xl py-2 px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary-dark-green rounded-xl text-uppercase py-2 px-4 d-flex align-items-center">
                         <i data-lucide="upload-cloud" class="me-2" style="width: 20px; height: 20px;"></i> 
                        Submit Report
                    </button>
                </div>
            </div>
        </div>
    </div>

     <!-- Footer -->
    <footer class="bg-footer py-4">
        <div class="container-lg px-4 text-white text-center footer">
            
            <a href="#home" class="fs-5 fw-bold mb-3 d-inline-flex align-items-center text-white text-opacity-75 text-decoration-none transition">
                <i data-lucide="compass" class="me-2 text-logo-green" style="width: 20px; height: 20px;"></i>
                weFind
            </a>
            
            <div class="d-flex flex-wrap justify-content-center gap-3 small mb-3">
                <a href="#about" class="fw-medium text-opacity-75 text-decoration-none transition">About</a>
                <a href="#search" class="fw-medium text-opacity-75 text-decoration-none transition">Search</a>
                <a href="#" class="fw-medium text-opacity-75 text-decoration-none transition">Privacy Policy</a>
                <a href="#" class="fw-medium text-opacity-75 text-decoration-none transition">Terms of Service</a>
            </div>

            <p class="small text-white text-opacity-50 mb-0">
                &copy; 2025 Lost and Found Management System | All Rights Reserved
            </p>
        </div>
    </footer>