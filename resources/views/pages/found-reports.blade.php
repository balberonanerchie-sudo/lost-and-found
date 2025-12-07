@extends('layout.default')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/manage-report.css') }}">
@endsection

@section('content')
    @include('partials.navbar')

    <main class="main-content">
        <div class="page-header mb-4">
            <div>
                <h3 class="text">Found Reports</h3>
            </div>
        </div>

        <div class="table-card">
            <div class="table-header">
                <div class="d-flex align-items-center gap-2">
                    <h5 class="mb-0">All Found Items <span class="text-muted ms-1">({{ $foundItems->count() }})</span></h5>
                </div>
                <div class="table-actions">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Search found items...">
                    </div>
                    <button class="btn-export">
                        <i class="fas fa-download"></i> Export
                    </button>
                </div>
            </div>
            
            <div class="table-responsive">
                <table class="custom-table table-hover table-bordered">
                    <thead class="table-light sticky-top" style="z-index: 1;">
                        <tr>
                            <th>Photo</th>
                            <th>Item Name</th>
                            <th>Category</th>
                            <th>Description</th>
                            <th>Location</th>
                            <th>Date Found</th>
                            <th>Reporter Email</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($foundItems as $item)
                        <tr>
                            <td data-label="Photo">
                                <div class="item-image" style="width: 50px; height: 50px;">
                                    <img src="{{ asset($item->image ?? 'img/placeholder.png') }}" alt="Item" class="rounded">
                                </div>
                            </td>
                            
                            <td data-label="Item Name"><strong>{{ $item->name }}</strong></td>
                            
                            <td data-label="Category">{{ ucfirst($item->category) }}</td>
                            
                            <td data-label="Description" class="desc-cell" title="{{ $item->description }}">
                                {{ $item->description }}
                            </td>
                            
                            <td data-label="Location">
                                <i class="fas fa-map-marker-alt text-muted me-1"></i> {{ $item->location }}
                            </td>
                            
                            <td data-label="Date" style="white-space: nowrap;">
                                <i class="fas fa-calendar-check text-muted me-1"></i> {{ $item->date_found }}
                            </td>
                            
                            <td data-label="Email">
                                <span class="text-primary">{{ $item->reporter_email ?? 'N/A' }}</span>
                            </td>
                            
                            <td data-label="Status">
                                <span class="badge success">{{ ucfirst($item->status) }}</span>
                            </td>
                            
                            <td data-label="Actions">
                                <div class="action-btns">
                                    <button class="btn-sm btn-info view-btn" data-data="{{ json_encode($item) }}" title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn-sm btn-danger delete-btn" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center py-5 text-muted">
                                <div class="d-flex flex-column align-items-center">
                                    <i class="fas fa-box-open fa-3x mb-3 opacity-25"></i>
                                    <p class="mb-0">No found item reports.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="modal fade" id="viewReportModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title fw-bold">Found Item Details</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="text-center bg-light p-3">
                            <img id="modal_image" src="" alt="Item" style="max-height: 200px; max-width: 100%; border-radius: 8px;">
                        </div>
                        <div class="p-4">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <h4 id="modal_name" class="fw-bold mb-0"></h4>
                                <span class="badge bg-success">FOUND ITEM</span>
                            </div>
                            
                            <div class="row g-3">
                                <div class="col-6">
                                    <small class="text-muted d-block fw-bold">Category</small>
                                    <span id="modal_category"></span>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted d-block fw-bold">Date Found</small>
                                    <span id="modal_date"></span>
                                </div>
                                <div class="col-12">
                                    <small class="text-muted d-block fw-bold">Location</small>
                                    <span id="modal_location"></span>
                                </div>
                                <div class="col-12">
                                    <small class="text-muted d-block fw-bold">Description</small>
                                    <p id="modal_desc" class="text-muted small mb-0 bg-light p-2 rounded"></p>
                                </div>
                                <div class="col-12 border-top pt-3 mt-2">
                                    <small class="text-muted d-block fw-bold mb-1">Reporter Contact</small>
                                    <div class="d-flex align-items-center gap-2">
                                        <i class="fas fa-envelope text-success"></i>
                                        <span id="modal_email" class="text-dark"></span>
                                    </div>
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

    </main>
@endsection

@section('scripts')
<script>
    // View Modal Logic
    document.querySelectorAll('.view-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const data = JSON.parse(this.dataset.data);
            
            document.getElementById('modal_image').src = data.image || '/img/placeholder.png';
            document.getElementById('modal_name').innerText = data.name;
            document.getElementById('modal_category').innerText = data.category;
            document.getElementById('modal_date').innerText = data.date_found;
            document.getElementById('modal_location').innerText = data.location;
            document.getElementById('modal_desc').innerText = data.description;
            document.getElementById('modal_email').innerText = data.reporter_email || 'N/A';

            new bootstrap.Modal(document.getElementById('viewReportModal')).show();
        });
    });
</script>
@endsection