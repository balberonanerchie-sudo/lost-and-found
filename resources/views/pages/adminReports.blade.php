{{-- resources/views/pages/adminReports.blade.php --}}
@extends('layout.default')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/manage-item.css') }}">
@endsection

@section('content')
    @include('partials.navbar')

    <main class="main-content">
        <div class="page-header">
            <div>
                <h3>Reports</h3>
            </div>
            {{-- No "Add New" button for reports for now --}}
        </div>

        {{-- FILTERS FORM (GET) – same structure as Manage Item --}}
        <form id="reportFiltersForm" action="{{ route('admin.reports') }}" method="GET">
            <div class="filter-section">
                <div class="filter-group">
                    <label>Type</label>
                    <select class="filter-select" name="type">
                        <option value="">All Types</option>
                        <option value="lost"  {{ request('type') === 'lost' ? 'selected' : '' }}>Lost</option>
                        <option value="found" {{ request('type') === 'found' ? 'selected' : '' }}>Found</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label>Category</label>
                    <select class="filter-select" name="category">
                        <option value="">All Categories</option>
                        <option value="electronics" {{ request('category') === 'electronics' ? 'selected' : '' }}>Electronics</option>
                        <option value="wallet"      {{ request('category') === 'wallet' ? 'selected' : '' }}>Wallet/ID</option>
                        <option value="keys"        {{ request('category') === 'keys' ? 'selected' : '' }}>Keys</option>
                        <option value="clothing"    {{ request('category') === 'clothing' ? 'selected' : '' }}>Clothing</option>
                        <option value="accessories" {{ request('category') === 'accessories' ? 'selected' : '' }}>Accessories</option>
                        <option value="other"       {{ request('category') === 'other' ? 'selected' : '' }}>Others</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label>Location</label>
                    <input type="text"
                           class="filter-select"
                           name="location"
                           placeholder="Enter Location"
                           value="{{ request('location') }}">
                </div>

                <div class="filter-group">
                    <label>Status</label>
                    <select class="filter-select" name="status">
                        <option value="">All Statuses</option>
                        <option value="new"     {{ request('status') === 'new' ? 'selected' : '' }}>New</option>
                        <option value="linked"  {{ request('status') === 'linked' ? 'selected' : '' }}>Linked</option>
                        <option value="closed"  {{ request('status') === 'closed' ? 'selected' : '' }}>Closed</option>
                    </select>
                </div>


                <button type="button"
                        class="btn-reset"
                        onclick="window.location='{{ route('admin.reports') }}'">
                    <i class="fas fa-redo"></i>
                    Reset Filters
                </button>
            </div>
        </form>

        <div class="table-card">
            <div class="table-header">
                <h5>All Reports ({{ $reports->total() }})</h5>
                <div class="table-actions">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        {{-- Search is part of the same GET form via form="reportFiltersForm" --}}
                        <input type="text"
                               name="search"
                               form="reportFiltersForm"
                               placeholder="Search reports..."
                               value="{{ request('search') }}">
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>Photo</th>
                            <th>Type</th>
                            <th>Item Name</th>
                            <th>Category</th>
                            <th>Location</th>
                            <th>Date</th>
                            <th>Reporter Email</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($reports as $report)
                        <tr>
                            {{-- IMAGE --}}
                            <td data-label="Photo">
                                <div class="item-image">
                                    @if ($report->image_path)
                                        <img src="{{ asset('storage/' . $report->image_path) }}" alt="Report photo">
                                    @else
                                        <img src="{{ asset('img/default.png') }}" alt="No Image">
                                    @endif
                                </div>
                            </td>

                            {{-- TYPE --}}
                            <td data-label="Type">
                                <span class="badge {{ $report->type === 'lost' ? 'danger' : 'success' }}">
                                    {{ ucfirst($report->type) }}
                                </span>
                            </td>

                            {{-- NAME + DESCRIPTION (short) --}}
                            <td data-label="Item Name">
                                <div class="item-info">
                                    <strong>{{ $report->item_name }}</strong>
                                    <span class="item-desc">{{ \Illuminate\Support\Str::limit($report->description, 60) }}</span>
                                </div>
                            </td>

                            {{-- CATEGORY --}}
                            <td data-label="Category">{{ $report->category ?? '—' }}</td>

                            {{-- LOCATION --}}
                            <td data-label="Location">
                                <div class="location-tag">
                                    <i class="fas fa-map-marker-alt"></i> {{ $report->location ?? '—' }}
                                </div>
                            </td>

                            {{-- DATE --}}
                            <td data-label="Date">
                                @if ($report->incident_date)
                                    {{ \Carbon\Carbon::parse($report->incident_date)->format('M d, Y') }}
                                @else
                                    <span class="text-muted small">N/A</span>
                                @endif
                            </td>

                            {{-- EMAIL --}}
                            <td data-label="Reporter Email">
                                {{ $report->contact_email ?? '—' }}
                            </td>

                            {{-- STATUS --}}
                            <td data-label="Status">
                                @php
                                    $status = $report->status ?? 'new';
                                    $badgeClass = match ($status) {
                                        'new'    => 'info',   // blue
                                        'linked' => 'success',        // green
                                        'closed' => 'secondary',     // gray
                                        default  => 'secondary',
                                    };
                                @endphp
                                <span class="badge bg-{{ $badgeClass }}">
                                    {{ ucfirst($status) }}
                                </span>
                            </td>
                            
                            {{-- Actions --}}
                            <td data-label="Actions">
                                <div class="action-btns d-flex gap-1">

                                    {{-- 1. Conditional first button: Add New Item (found) or Match (lost) --}}
                                    @if ($report->type === 'found')
                                        <button type="button"
                                                class="btn-sm btn-success btn-add-from-report"
                                                title="Add New Item from this report"
                                                data-report='@json($report)'>
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    @else
                                        <a href="{{ route('admin.reports.match', $report->id) }}"
                                        class="btn-sm btn-info"
                                        title="Match with existing items">
                                            <i class="fas fa-link"></i>
                                        </a>
                                    @endif


                                    {{-- 2. EDIT button --}}
                                    <button type="button"
                                            class="btn-sm btn-warning btn-edit-report"
                                            title="Edit Report"
                                            data-report='@json($report)'>
                                        <i class="fas fa-edit"></i>
                                    </button>

                                    {{-- 3. DELETE button --}}
                                    <button type="button"
                                            class="btn-sm btn-danger btn-delete-report"
                                            title="Delete"
                                            data-id="{{ $report->id }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">
                                No reports found.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div class="table-footer">
                <div class="showing-info">
                    Showing {{ $reports->firstItem() }} to {{ $reports->lastItem() }} of {{ $reports->total() }} reports
                </div>
                <div class="d-flex justify-content-end">
                    {{ $reports->appends(request()->query())->links() }}
                </div>
            </div>
        </div>

        {{-- ADD ITEM FROM REPORT MODAL --}}
        <div class="modal fade" id="addItemFromReportModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content border-0 shadow-lg">
                    <div class="modal-header bg-light">
                        <h5 class="modal-title fw-bold">Add New Item</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="report_id" id="add_report_id">

                        <div class="modal-body p-4">

                            <div class="row g-4 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-medium small text-muted">Item Name</label>
                                    <input type="text"
                                        name="item_name"
                                        id="add_item_name"
                                        class="form-control form-control-lg"
                                        placeholder="e.g. Blue Umbrella"
                                        required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-medium small text-muted">Category</label>
                                    <select name="category"
                                            id="add_category"
                                            class="form-select form-select-lg"
                                            required>
                                        <option value="" selected disabled>Select Category</option>
                                        <option value="electronics">Electronics</option>
                                        <option value="wallet">Wallet/ID</option>
                                        <option value="keys">Keys</option>
                                        <option value="clothing">Clothing</option>
                                        <option value="accessories">Accessories</option>
                                        <option value="other">Others</option>
                                    </select>
                                </div>

                                <div class="col-12">
                                    <label class="form-label fw-medium small text-muted">Description</label>
                                    <textarea name="description"
                                            id="add_description"
                                            class="form-control form-control-lg"
                                            rows="4"
                                            placeholder="Describe the item (color, brand, distinguishing marks)..."
                                            required></textarea>
                                </div>
                            </div>

                            <h5 class="fw-bold mb-4 text-success border-bottom pb-2 mt-5 d-flex align-items-center gap-2">
                                <i data-lucide="map-pin" size="20"></i> Location &amp; Time
                            </h5>

                            <div class="row g-4 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-medium small text-muted">Location</label>
                                    <input type="text"
                                        name="location"
                                        id="add_location"
                                        class="form-control form-control-lg"
                                        placeholder="e.g. Main Library, Room 304"
                                        required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-medium small text-muted">Date</label>
                                    <input type="date"
                                        name="date_found"
                                        id="add_date_found"
                                        class="form-control form-control-lg"
                                        required>
                                </div>
                            </div>

                            <h5 class="fw-bold mb-4 text-success border-bottom pb-2 mt-5 d-flex align-items-center gap-2">
                                <i data-lucide="image" size="20"></i> Media
                            </h5>

                            <div class="row g-4 mb-4">
                                <div class="col-12">
                                    <label class="form-label fw-medium small text-muted">Upload Photo (Optional)</label>
                                    <input type="file"
                                        name="image"
                                        class="form-control form-control-lg"
                                        accept=".jpg,.png,.jpeg">
                                    <div class="form-text">Accepted formats: jpg, png. Max size: 5MB.</div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer bg-light">
                            <button type="button"
                                    class="btn btn-link text-muted text-decoration-none"
                                    data-bs-dismiss="modal">
                                Cancel
                            </button>
                            <button type="submit" class="btn btn-primary px-4">
                                Add Item
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- EDIT REPORT MODAL --}}
        <div class="modal fade" id="editReportModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content border-0 shadow-lg">
                    <div class="modal-header bg-light">
                        <h5 class="modal-title fw-bold">Edit Report</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form action="{{ route('admin.reports.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="edit_report_id" name="report_id">

                        <div class="modal-body p-4">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label text-muted small fw-bold">Type</label>
                                    <select id="edit_type" name="type" class="form-select">
                                        <option value="lost">Lost</option>
                                        <option value="found">Found</option>
                                    </select>
                                </div>

                                <div class="col-md-8">
                                    <label class="form-label text-muted small fw-bold">Item Name</label>
                                    <input type="text" id="edit_item_name" name="item_name" class="form-control">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label text-muted small fw-bold">Category</label>
                                    <select id="edit_category" name="category" class="form-select">
                                        <option value="">(None)</option>
                                        <option value="electronics">Electronics</option>
                                        <option value="wallet">Wallet/ID</option>
                                        <option value="keys">Keys</option>
                                        <option value="clothing">Clothing</option>
                                        <option value="accessories">Accessories</option>
                                        <option value="other">Others</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label text-muted small fw-bold">Status</label>
                                    <select id="edit_status" name="status" class="form-select">
                                        <option value="">(None)</option>
                                        <option value="new">New</option>
                                        <option value="linked">Linked</option>
                                        <option value="closed">Closed</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label text-muted small fw-bold">Location</label>
                                    <input type="text" id="edit_location" name="location" class="form-control">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label text-muted small fw-bold">Incident Date</label>
                                    <input type="date" id="edit_incident_date" name="incident_date" class="form-control">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label text-muted small fw-bold">Reporter Email</label>
                                    <input type="email" id="edit_contact_email" name="contact_email" class="form-control">
                                </div>

                                <div class="col-12">
                                    <label class="form-label text-muted small fw-bold">Description</label>
                                    <textarea id="edit_description" name="description" class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer bg-light">
                            <button type="button" class="btn btn-link text-muted text-decoration-none" data-bs-dismiss="modal">
                                Cancel
                            </button>
                            <button type="submit" class="btn btn-success px-4">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- DELETE REPORT MODAL --}}
        <div class="modal fade" id="deleteReportModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content border-0 shadow-lg">
                    <div class="modal-body p-4 text-center">
                        <div class="mb-3 text-danger">
                            <i class="fas fa-trash-alt fa-3x opacity-50"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Delete Report?</h5>
                        <p class="text-muted small mb-4">
                            Are you sure you want to delete <strong id="delete_report_name" class="text-dark">this report</strong>?
                            This cannot be undone.
                        </p>
                        <div class="d-grid gap-2">
                            <form action="{{ route('admin.reports.destroy') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" id="delete_report_id_input" name="report_id">
                                <button type="submit" class="btn btn-danger w-100 fw-bold">Yes, Delete Report</button>
                            </form>
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('reportFiltersForm');

    // 1) Auto-submit dropdown/text filters on change (same as Manage Item)
    document.querySelectorAll('#reportFiltersForm .filter-select').forEach(el => {
        el.addEventListener('change', () => {
            form.submit();
        });
    });

    // 2) Search bar: submit only when user presses Enter
    const searchInput = document.querySelector('input[name="search"][form="reportFiltersForm"]');
    if (searchInput) {
        searchInput.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') {
                e.preventDefault();
                form.submit();
            }
        });
    }
    // 3) ADD ITEM FROM REPORT modal logic
    document.querySelectorAll('.btn-add-from-report').forEach(btn => {
        btn.addEventListener('click', function () {
            let report = this.getAttribute('data-report');
            if (!report) return;

            try {
                report = JSON.parse(report);
            } catch (e) {
                return;
            }

            // Hidden link back to report
            const idInput = document.getElementById('add_report_id');
            if (idInput) idInput.value = report.id;

            // Item name
            const nameInput = document.getElementById('add_item_name');
            if (nameInput) nameInput.value = report.item_name ?? '';

            // Description
            const descInput = document.getElementById('add_description');
            if (descInput) descInput.value = report.description ?? '';

            // Location
            const locInput = document.getElementById('add_location');
            if (locInput) locInput.value = report.location ?? '';

            // Date found from incident_date (fallback to today)
            const dateInput = document.getElementById('add_date_found');
            if (dateInput) {
                dateInput.value = report.incident_date ?? new Date().toISOString().slice(0, 10);
            }

            // Category select
            const catSelect = document.getElementById('add_category');
            if (catSelect) {
                const category = report.category ?? '';
                let matched = false;
                for (let i = 0; i < catSelect.options.length; i++) {
                    if (catSelect.options[i].value === category) {
                        catSelect.selectedIndex = i;
                        matched = true;
                        break;
                    }
                }
                if (!matched) {
                    catSelect.selectedIndex = 0; // "Select Category"
                }
            }

            const modalEl = document.getElementById('addItemFromReportModal');
            const modal   = bootstrap.Modal.getOrCreateInstance(modalEl);
            modal.show();
        });
    });

    // 4) EDIT REPORT modal logic (open via JS only)
    document.querySelectorAll('.btn-edit-report').forEach(btn => {
        btn.addEventListener('click', function () {
            let report = this.getAttribute('data-report');
            if (!report) return;

            try {
                report = JSON.parse(report);
            } catch (e) {
                return;
            }

            // Set hidden id for update()
            document.getElementById('edit_report_id').value = report.id;

            // Basic fields
            document.getElementById('edit_item_name').value       = report.item_name ?? '';
            document.getElementById('edit_location').value        = report.location ?? '';
            document.getElementById('edit_incident_date').value   = report.incident_date ?? '';
            document.getElementById('edit_contact_email').value   = report.contact_email ?? '';
            document.getElementById('edit_description').value     = report.description ?? '';

            // Type select
            const typeSelect = document.getElementById('edit_type');
            if (typeSelect && report.type) {
                typeSelect.value = report.type;
            }

            // Category select
            const catSelect = document.getElementById('edit_category');
            if (catSelect) {
                catSelect.value = report.category ?? '';
            }

            // Status select
            const statusSelect = document.getElementById('edit_status');
            if (statusSelect && report.status) {
                statusSelect.value = report.status;
            }

            const editModalEl = document.getElementById('editReportModal');
            const editModal   = bootstrap.Modal.getOrCreateInstance(editModalEl);
            editModal.show();
        });
    });

    // 5) REPORT DETAILS MODAL (wrapped so it doesn't block other logic)
    const detailsModalEl = document.getElementById('reportDetailsModal');
    if (detailsModalEl) {
        detailsModalEl.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            if (!button) return;

            let report = button.getAttribute('data-report');
            if (!report) return;

            try {
                report = JSON.parse(report);
            } catch (e) {
                return;
            }

            document.getElementById('detail-type').textContent =
                report.type ? report.type.charAt(0).toUpperCase() + report.type.slice(1) : '';
            document.getElementById('detail-item-name').textContent   = report.item_name ?? '';
            document.getElementById('detail-category').textContent    = report.category ?? '—';
            document.getElementById('detail-location').textContent    = report.location ?? '—';
            document.getElementById('detail-incident-date').textContent = report.incident_date ?? 'N/A';
            document.getElementById('detail-description').textContent = report.description ?? '—';
            document.getElementById('detail-email').textContent       = report.contact_email ?? '—';
            document.getElementById('detail-status').textContent      =
                report.status ? report.status.charAt(0).toUpperCase() + report.status.slice(1) : '';

            const photoWrapper = document.getElementById('detail-photo-wrapper');
            const photoImg     = document.getElementById('detail-photo');

            if (report.image_path) {
                photoImg.src = '{{ asset('storage') }}/' + report.image_path;
                photoWrapper.style.display = 'block';
            } else {
                photoImg.src = '';
                photoWrapper.style.display = 'none';
            }
        });
    }

    // 6) DELETE REPORT modal logic (mirrors Manage Item delete)
    document.querySelectorAll('.btn-delete-report').forEach(btn => {
        btn.addEventListener('click', function () {
            const reportId = this.getAttribute('data-id');
            const row      = this.closest('tr');
            const nameEl   = row.querySelector('.item-info strong');
            const name     = nameEl ? nameEl.innerText : 'this report';

            // Set hidden id for destroy()
            document.getElementById('delete_report_id_input').value = reportId;
            document.getElementById('delete_report_name').innerText = name;

            const deleteModalEl = document.getElementById('deleteReportModal');
            const deleteModal   = bootstrap.Modal.getOrCreateInstance(deleteModalEl);
            deleteModal.show();
        });
    });
});
</script>
@endsection

