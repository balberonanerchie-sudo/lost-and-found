@extends('layout.default')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/manage-report.css') }}">
    
@endsection

@section('content')
    @include('partials.navbar')

    <main class="main-content">
        <div class="page-header mb-4">
            <div>
                <h3>Manage Reports</h3>
            </div>
        </div>

        <div class="row g-4">
            
            <div class="col-12 col-xl-6">
                <div class="table-card h-100">
                    <div class="table-header border-bottom">
                        <div class="d-flex align-items-center gap-2">
                            <h5 class="text-danger mb-0">Lost Reports</h5>
                            <span class="badge bg-danger bg-opacity-10 text-danger ms-2">{{ $lostReports->count() ?? 0 }}</span>
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
                                    <th>Date</th>
                                    <th>Reporter Email</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($lostReports as $item)
                                <tr>
                                    <td>
                                        <div class="item-image" style="width: 40px; height: 40px;">
                                            <img src="{{ asset($item->image ?? 'img/placeholder.png') }}" alt="Item" class="rounded">
                                        </div>
                                    </td>
                                    <td><strong>{{ $item->name }}</strong></td>
                                    <td>{{ ucfirst($item->category) }}</td>
                                    <td class="desc-cell" title="{{ $item->description }}">{{ $item->description }}</td>
                                    <td>{{ $item->location }}</td>
                                    <td style="white-space: nowrap;">{{ $item->date_found }}</td>
                                    <td>{{ $item->reporter_email ?? 'N/A' }}</td>
                                    <td><span class="badge warning">{{ ucfirst($item->status) }}</span></td>
                                    <td>
                                        <div class="action-btns">
                                            <button class="btn-sm btn-info view-btn" data-data="{{ json_encode($item) }}"><i class="fas fa-eye"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="text-center py-5 text-muted">
                                        <p class="mb-0">No lost reports.</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-12 col-xl-6">
                <div class="table-card h-100">
                    <div class="table-header border-bottom">
                        <div class="d-flex align-items-center gap-2">
                            <h5 class="text-success mb-0">Found Reports</h5>
                            <span class="badge bg-success bg-opacity-10 text-success ms-2">{{ $foundReports->count() ?? 0 }}</span>
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
                                    <th>Date</th>
                                    <th>Reporter Email</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($foundReports as $item)
                                <tr>
                                    <td>
                                        <div class="item-image" style="width: 40px; height: 40px;">
                                            <img src="{{ asset($item->image ?? 'img/placeholder.png') }}" alt="Item" class="rounded">
                                        </div>
                                    </td>
                                    <td><strong>{{ $item->name }}</strong></td>
                                    <td>{{ ucfirst($item->category) }}</td>
                                    <td class="desc-cell" title="{{ $item->description }}">{{ $item->description }}</td>
                                    <td>{{ $item->location }}</td>
                                    <td style="white-space: nowrap;">{{ $item->date_found }}</td>
                                    <td>{{ $item->reporter_email ?? 'N/A' }}</td>
                                    <td><span class="badge success">{{ ucfirst($item->status) }}</span></td>
                                    <td>
                                        <div class="action-btns">
                                            <button class="btn-sm btn-info view-btn" data-data="{{ json_encode($item) }}"><i class="fas fa-eye"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="text-center py-5 text-muted">
                                        <p class="mb-0">No found reports.</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

        <div class="modal fade" id="viewReportModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title fw-bold">Report Details</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="text-center bg-light p-3">
                            <img id="modal_image" src="" alt="Item" style="max-height: 200px; max-width: 100%; border-radius: 8px;">
                        </div>
                        <div class="p-4">
                            <h4 id="modal_name" class="fw-bold"></h4>
                            <span id="modal_type" class="badge mb-3"></span>
                            
                            <div class="row g-3">
                                <div class="col-6">
                                    <small class="text-muted d-block fw-bold">Category</small>
                                    <span id="modal_category"></span>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted d-block fw-bold">Date</small>
                                    <span id="modal_date"></span>
                                </div>
                                <div class="col-12">
                                    <small class="text-muted d-block fw-bold">Location</small>
                                    <span id="modal_location"></span>
                                </div>
                                <div class="col-12">
                                    <small class="text-muted d-block fw-bold">Description</small>
                                    <p id="modal_desc" class="text-muted small mb-0"></p>
                                </div>
                                <div class="col-12 border-top pt-2">
                                    <small class="text-muted d-block fw-bold">Reporter Contact</small>
                                    <span id="modal_email" class="text-primary"></span>
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
            
            const typeBadge = document.getElementById('modal_type');
            typeBadge.innerText = (data.type || 'Report').toUpperCase();
            typeBadge.className = 'badge mb-3 ' + (data.type === 'found' ? 'bg-success' : 'bg-danger');

            new bootstrap.Modal(document.getElementById('viewReportModal')).show();
        });
    });
</script>
@endsection