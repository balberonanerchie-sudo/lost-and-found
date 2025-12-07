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

        {{-- FILTERS FORM (GET) --}}
        <form id="itemFiltersForm" action="{{ route('admin.items') }}" method="GET">
            <div class="filter-section">
                <div class="filter-group">
                    <label>Status</label>
                    <select class="filter-select" name="status">
                        <option value="">All Status</option>
                        <option value="unclaimed" {{ request('status') === 'unclaimed' ? 'selected' : '' }}>Unclaimed</option>
                        <option value="claimed"   {{ request('status') === 'claimed'   ? 'selected' : '' }}>Claimed</option>
                        <option value="pending"   {{ request('status') === 'pending'   ? 'selected' : '' }}>Pending</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label>Category</label>
                    <select class="filter-select" name="category">
                        <option value="">All Categories</option>
                        <option value="electronics" {{ request('category') === 'electronics' ? 'selected' : '' }}>Electronics</option>
                        <option value="accessories" {{ request('category') === 'accessories' ? 'selected' : '' }}>Accessories</option>
                        <option value="documents"   {{ request('category') === 'documents'   ? 'selected' : '' }}>Documents</option>
                        <option value="clothing"    {{ request('category') === 'clothing'    ? 'selected' : '' }}>Clothing</option>
                        <option value="others"      {{ request('category') === 'others'      ? 'selected' : '' }}>Others</option>
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

                <button type="button"
                        class="btn-reset"
                        onclick="window.location='{{ route('admin.items') }}'">
                    <i class="fas fa-redo"></i>
                    Reset Filters
                </button>
            </div>
        </form>

        <div class="table-card">
            <div class="table-header">
                <h5>All Items ({{ $items->total() }})</h5>
                <div class="table-actions">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        {{-- Search is part of the same GET form via form="itemFiltersForm" --}}
                        <input type="text"
                               name="search"
                               form="itemFiltersForm"
                               placeholder="Search items..."
                               value="{{ request('search') }}">
                    </div>
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
                    @foreach ($items as $item)
                        <tr>
                            {{-- IMAGE --}}
                            <td data-label="Item Image">
                                <div class="item-image">
                                    @if ($item->image)
                                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}">
                                    @else
                                        <img src="{{ asset('img/default.png') }}" alt="No Image">
                                    @endif
                                </div>
                            </td>

                            {{-- NAME + DESCRIPTION --}}
                            <td data-label="Item Name">
                                <div class="item-info">
                                    <strong>{{ $item->item_name }}</strong>
                                    <span class="item-desc">{{ $item->description }}</span>
                                </div>
                            </td>

                            {{-- CATEGORY --}}
                            <td data-label="Category">{{ ucfirst($item->category) }}</td>

                            {{-- LOCATION --}}
                            <td data-label="Location">
                                <div class="location-tag">
                                    <i class="fas fa-map-marker-alt"></i> {{ $item->location }}
                                </div>
                            </td>

                            {{-- DATE --}}
                            <td data-label="Date Reported">
                                {{ \Carbon\Carbon::parse($item->date_found)->format('M d, Y') }}
                            </td>

                            {{-- STATUS --}}
                            <td data-label="Status">
                                @php
                                    $badgeClass = match($item->status) {
                                        'unclaimed' => 'danger',
                                        'claimed'   => 'success',
                                        'pending'   => 'warning',
                                        'returned'  => 'info',
                                        default     => 'secondary'
                                    };
                                @endphp

                                <span class="badge {{ $badgeClass }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>

                            {{-- OWNER --}}
                            <td data-label="Owner">
                                {{ $item->owner ? $item->owner->name : '-' }}
                            </td>
                            {{-- ACTIONS --}}
                            <td data-label="Actions">
                                <div class="action-btns d-flex gap-1">

                                    {{-- 1. MARK CLAIMED Button (unchanged) --}}
                                    <form action="{{ route('admin.items.claim', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                                class="btn-sm btn-claim"
                                                title="Mark as Claimed"
                                                {{ $item->status == 'claimed' ? 'disabled' : '' }}>
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>

                                    {{-- 2. EDIT button (no data-bs-toggle / target) --}}
                                    <button type="button"
                                            class="btn-sm btn-success btn-edit-item"
                                            title="Edit"
                                            data-id="{{ $item->id }}">
                                        <i class="fas fa-edit"></i>
                                    </button>

                                    {{-- 3. DELETE button (no data-bs-toggle / target) --}}
                                    <button type="button"
                                            class="btn-sm btn-danger btn-delete-item"
                                            title="Delete"
                                            data-id="{{ $item->id }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    @if ($items->isEmpty())
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">
                                No items found.
                            </td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>

            <div class="table-footer">
                <div class="showing-info">
                    Showing {{ $items->firstItem() }} to {{ $items->lastItem() }} of {{ $items->total() }} items
                </div>
                <div class="d-flex justify-content-end">
                    {{ $items->appends(request()->query())->links() }}
                </div>
            </div>
        </div>

        {{-- ADD ITEM MODAL --}}
        <div class="modal fade" id="addItemModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content border-0 shadow-lg">
                    <div class="modal-header bg-light">
                        <h5 class="modal-title fw-bold">Add New Item</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body p-4">

                            <div class="row g-4 mb-4">
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
                                        <option value="other">Others</option>
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
                                <i data-lucide="image" size="20"></i> Media
                            </h5>

                            <div class="row g-4 mb-4">
                                <div class="col-12">
                                    <label class="form-label fw-medium small text-muted">Upload Photo (Optional)</label>
                                    <input type="file" name="image" class="form-control form-control-lg" accept=".jpg,.png,.jpeg">
                                    <div class="form-text">Accepted formats: jpg, png. Max size: 5MB.</div>
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

        {{-- VIEW MODAL (unchanged) --}}
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

        {{-- EDIT MODAL --}}
        <div class="modal fade" id="editItemModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content border-0 shadow-lg">
                    <div class="modal-header bg-light">
                        <h5 class="modal-title fw-bold">Edit Item Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form action="{{ route('admin.items.update') }}" method="POST" enctype="multipart/form-data">
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
                                        <option value="wallet/ID">Wallet/ID</option>
                                        <option value="keys">Keys</option>
                                        <option value="clothing">Clothing</option>
                                        <option value="accessories">Accessories</option>
                                        <option value="others">Others</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-muted small fw-bold">Location Found</label>
                                    <input type="text" id="edit_location" name="location" class="form-control">
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
                                <div class="col-12">
                                    <label class="form-label text-muted small fw-bold">Replace Photo</label>
                                    <input type="file"
                                        name="image"
                                        class="form-control"
                                        accept=".jpg,.jpeg,.png,.gif">
                                    <div class="form-text">
                                        Leave this empty to keep the current image. Accepted: jpg, jpeg, png, gif. Max 2MB.
                                    </div>
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

        {{-- DELETE MODAL --}}
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
                            <form action="{{ route('admin.items.destroy') }}" method="POST">
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
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('itemFiltersForm');

    // 1) Auto-submit dropdown filters on change
    document.querySelectorAll('#itemFiltersForm .filter-select').forEach(el => {
        el.addEventListener('change', () => {
            form.submit();
        });
    });

    // 2) Search bar: submit only when user presses Enter
    const searchInput = document.querySelector('input[name="search"][form="itemFiltersForm"]');
    if (searchInput) {
        searchInput.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') {
                e.preventDefault();
                form.submit();
            }
        });
    }

    // 3) EDIT modal logic (open via JS only)
    document.querySelectorAll('.btn-edit-item').forEach(btn => {
        btn.addEventListener('click', function () {
            const itemId = this.getAttribute('data-id');
            const row    = this.closest('tr');

            // Set hidden id for update()
            document.getElementById('edit_item_id').value = itemId;

            // Extract row data
            const name     = row.querySelector('.item-info strong').innerText;
            const desc     = row.querySelector('.item-info .item-desc').innerText;
            const category = row.querySelector('td[data-label="Category"]').innerText.toLowerCase();
            const location = row.querySelector('td[data-label="Location"]').innerText.trim();
            const status   = row.querySelector('td[data-label="Status"]').innerText.trim().toLowerCase();

            // Populate form fields
            document.getElementById('edit_name').value     = name;
            document.getElementById('edit_desc').value     = desc;
            document.getElementById('edit_location').value = location;

            const setSelect = (id, val) => {
                const sel = document.getElementById(id);
                for (let i = 0; i < sel.options.length; i++) {
                    if (sel.options[i].value.toLowerCase().includes(val.toLowerCase()) ||
                        sel.options[i].text.toLowerCase().includes(val.toLowerCase())) {
                        sel.selectedIndex = i;
                        return;
                    }
                }
            };

            setSelect('edit_category', category);
            setSelect('edit_status', status);

            // Use a single Bootstrap modal instance
            const editModalEl = document.getElementById('editItemModal');
            const editModal   = bootstrap.Modal.getOrCreateInstance(editModalEl);
            editModal.show();
        });
    });

    // 4) DELETE modal logic (open via JS only)
    document.querySelectorAll('.btn-delete-item').forEach(btn => {
        btn.addEventListener('click', function () {
            const itemId = this.getAttribute('data-id');
            const row    = this.closest('tr');
            const name   = row.querySelector('.item-info strong').innerText;

            // Set hidden id for destroy()
            document.getElementById('delete_item_id_input').value = itemId;
            document.getElementById('delete_item_name').innerText = name;

            const deleteModalEl = document.getElementById('deleteItemModal');
            const deleteModal   = bootstrap.Modal.getOrCreateInstance(deleteModalEl);
            deleteModal.show();
        });
    });
});
</script>
@endsection