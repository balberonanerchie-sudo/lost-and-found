@extends('layout.nav-student')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endsection
<!-- 6. Search Page -->
<section id="search" class="container-lg px-4 py-5 py-lg-7">
<h2 class="h2-custom text-center mb-5 fw-bold">
    Search Found Items
</h2>

<!-- Search Bar -->
<div class="mx-auto mb-5 mb-lg-7" style="max-width: 800px;">
    <div class="input-group shadow-search rounded-xl border border-opacity-50" style="border-color: var(--accent-light) !important;">
        <input 
            type="text" 
            placeholder="Search lost items by name, type, or color..." 
            class="form-control form-control-lg rounded-start-xl border-0"
        >
        <!-- Search Button -->
        <button class="btn btn-primary-dark-green px-4 rounded-end-xl" type="button" id="search-button">
            <i data-lucide="search" class="text-white" style="width: 24px; height: 24px;"></i>
        </button>
    </div>
</div>

<!-- Filter Buttons-->
<div class="d-flex flex-wrap justify-content-center gap-3 mb-5 mb-lg-7">
    <button class="btn btn-accent-filter rounded-pill btn-sm text-uppercase px-4">
        <i data-lucide="tag" class="me-1" style="width: 16px; height: 16px;"></i> Category
    </button>
    <button class="btn btn-outline-dark-text rounded-pill btn-sm text-uppercase px-4">
        <i data-lucide="calendar" class="me-1" style="width: 16px; height: 16px;"></i> Date
    </button>
    <button class="btn btn-outline-dark-text rounded-pill btn-sm text-uppercase px-4">
        <i data-lucide="map-pin" class="me-1" style="width: 16px; height: 16px;"></i> Location
    </button>
    <button class="btn btn-outline-dark-text rounded-pill btn-sm text-uppercase px-4">
        Clear Filters
    </button>
</div>

<div class="row g-4" id="item-results">
    <!-- Card 1 -->
    <div class="col-sm-6 col-lg-4">
        <div class="card rounded-xl shadow-soft border h-100 p-0 d-flex flex-column justify-content-between" style="border-color: var(--border-light) !important;">
            <div class="bg-section-light rounded-top-xl d-flex justify-content-center align-items-center" style="height: 150px; border-bottom: 1px solid var(--border-light);">
                    <i data-lucide="key-round" class="text-muted" style="width: 48px; height: 48px;"></i>
            </div>
            
    <div class="p-4 flex-grow-1 d-flex flex-column">
        <h3 class="fs-5 fw-medium mb-2 text-dark">Blue Car Key</h3>
        <p class="small text-muted mb-3">Description: Single electronic key with a small blue tassel.</p>
        
        <div class="small text-dark mt-auto mb-3">
            <p class="mb-1"><strong class="fw-medium">Date Found:</strong> October 9, 2025</p>
            <p class="mb-0"><strong class="fw-medium">Location:</strong> Main Street Coffee Shop</p>
        </div>
        
        <!-- Claim Button -->
        <button class="btn btn-secondary-claim text-uppercase py-3 rounded-xl w-100">
            Claim Item
        </button>
    </div>
</div>
</div>

        <!-- Card 2 -->
        <div class="col-sm-6 col-lg-4">
            <div class="card rounded-xl shadow-soft border h-100 p-0 d-flex flex-column justify-content-between" style="border-color: var(--border-light) !important;">
                <div class="bg-section-light rounded-top-xl d-flex justify-content-center align-items-center" style="height: 150px; border-bottom: 1px solid var(--border-light);">
                        <i data-lucide="backpack" class="text-muted" style="width: 48px; height: 48px;"></i>
                </div>
                
                <div class="p-4 flex-grow-1 d-flex flex-column">
                    <h3 class="fs-5 fw-medium mb-2 text-dark">Black Backpack</h3>
                    <p class="small text-muted mb-3">Description: Standard black canvas backpack, contents unknown. Found near park entrance.</p>
                    
                    <div class="small text-dark mt-auto mb-3">
                        <p class="mb-1"><strong class="fw-medium">Date Found:</strong> October 8, 2025</p>
                        <p class="mb-0"><strong class="fw-medium">Location:</strong> City Central Park</p>
                    </div>
                    
                    <!-- Claim Button -->
                    <button class="btn btn-secondary-claim text-uppercase py-3 rounded-xl w-100">
                        Claim Item
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Card 3 -->
        <div class="col-sm-6 col-lg-4 mx-auto-sm"> 
            <div class="card rounded-xl shadow-soft border h-100 p-0 d-flex flex-column justify-content-between" style="border-color: var(--border-light) !important;">
                <div class="bg-section-light rounded-top-xl d-flex justify-content-center align-items-center" style="height: 150px; border-bottom: 1px solid var(--border-light);">
                        <i data-lucide="wallet" class="text-muted" style="width: 48px; height: 48px;"></i>
                </div>
                
                <div class="p-4 flex-grow-1 d-flex flex-column">
                    <h3 class="fs-5 fw-medium mb-2 text-dark">Brown Leather Wallet</h3>
                    <p class="small text-muted mb-3">Description: Bi-fold wallet, slightly worn, contains business cards but no ID.</p>
                    
                    <div class="small text-dark mt-auto mb-3">
                        <p class="mb-1"><strong class="fw-medium">Date Found:</strong> October 5, 2025</p>
                        <p class="mb-0"><strong class="fw-medium">Location:</strong> Metro Station Platform B</p>
                    </div>
                    
                    <!-- Claim Button -->
                    <button class="btn btn-secondary-claim text-uppercase py-3 rounded-xl w-100">
                        Claim Item
                    </button>
                </div>
            </div>
        </div>
    </div>

        </section>