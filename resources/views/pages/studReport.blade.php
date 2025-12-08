@extends('layout.student')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
@endsection

@section('content')
<div class="container-lg py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Report Item</h2>
            </div>

            <div class="custom-card p-4 p-md-5 bg-white">
                {{-- Flash success --}}
                @if(session('success'))
                    <div class="alert alert-success small mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Global validation errors (optional) --}}
                @if ($errors->any())
                    <div class="alert alert-danger small mb-4">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('report.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- ITEM DETAILS --}}
                    <h5 class="fw-bold mb-4 text-success border-bottom pb-2 d-flex align-items-center gap-2">
                        <i data-lucide="box" size="20"></i> Item Details
                    </h5>

                    <div class="row g-4 mb-4">
                        {{-- Type: lost / found --}}
                        <div class="col-12">
                            <label class="form-label fw-medium small text-muted">Are you reporting a:</label>
                            <div class="d-flex gap-4">
                                <div class="form-check">
                                    <input class="form-check-input"
                                           type="radio"
                                           name="type"
                                           id="typeLost"
                                           value="lost"
                                           @checked(old('type', 'lost') === 'lost')>
                                    <label class="form-check-label fw-medium" for="typeLost">
                                        Lost Item
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input"
                                           type="radio"
                                           name="type"
                                           id="typeFound"
                                           value="found"
                                           @checked(old('type') === 'found')>
                                    <label class="form-check-label fw-medium" for="typeFound">
                                        Found Item
                                    </label>
                                </div>
                            </div>
                            @error('type')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Item Name --}}
                        <div class="col-md-6">
                            <label class="form-label fw-medium small text-muted">Item Name</label>
                            <input type="text"
                                   name="item_name"
                                   class="form-control form-control-lg @error('item_name') is-invalid @enderror"
                                   value="{{ old('item_name') }}"
                                   placeholder="e.g. Blue Umbrella">
                            @error('item_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Category --}}
                        <div class="col-md-6">
                            <label class="form-label fw-medium small text-muted">Category</label>
                            <select name="category"
                                    class="form-select form-select-lg @error('category') is-invalid @enderror">
                                <option value="">Select category</option>
                                <option value="electronics" {{ old('category')=='electronics' ? 'selected' : '' }}>Electronics</option>
                                <option value="wallet"      {{ old('category')=='wallet'      ? 'selected' : '' }}>Wallet/ID</option>
                                <option value="keys"        {{ old('category')=='keys'        ? 'selected' : '' }}>Keys</option>
                                <option value="clothing"    {{ old('category')=='clothing'    ? 'selected' : '' }}>Clothing</option>
                                <option value="accessories" {{ old('category')=='accessories' ? 'selected' : '' }}>Accessories</option>
                                <option value="others"       {{ old('category')=='others'       ? 'selected' : '' }}>Others</option>
                            </select>
                            @error('category')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Description --}}
                        <div class="col-12">
                            <label class="form-label fw-medium small text-muted">Description</label>
                            <textarea name="description"
                                      class="form-control form-control-lg @error('description') is-invalid @enderror"
                                      rows="4"
                                      placeholder="Describe the item (color, brand, distinguishing marks)...">{{ old('description') }}</textarea>
                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- LOCATION & TIME --}}
                    <h5 class="fw-bold mb-4 text-success border-bottom pb-2 mt-5 d-flex align-items-center gap-2">
                        <i data-lucide="map-pin" size="20"></i> Location &amp; Time
                    </h5>

                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-medium small text-muted">Location</label>
                            <input type="text"
                                   name="location"
                                   class="form-control form-control-lg @error('location') is-invalid @enderror"
                                   value="{{ old('location') }}"
                                   placeholder="e.g. Main Library, Room 304">
                            @error('location')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-medium small text-muted">Date</label>
                            <input type="date"
                                   name="incident_date"
                                   class="form-control form-control-lg @error('incident_date') is-invalid @enderror"
                                   value="{{ old('incident_date') }}">
                            @error('incident_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- MEDIA & CONTACT --}}
                    <h5 class="fw-bold mb-4 text-success border-bottom pb-2 mt-5 d-flex align-items-center gap-2">
                        <i data-lucide="image" size="20"></i> Media &amp; Contact
                    </h5>

                    <div class="row g-4 mb-4">
                        {{-- Photo --}}
                        <div class="col-12">
                            <label class="form-label fw-medium small text-muted">Upload Photo (Optional)</label>
                            <input type="file"
                                   name="photo"
                                   class="form-control form-control-lg @error('photo') is-invalid @enderror">
                            <div class="form-text">Accepted formats: jpg, png. Max size: 5MB.</div>
                            @error('photo')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Contact Email --}}
                        <div class="col-12">
                            <label class="form-label fw-medium small text-muted">Your Email Address</label>
                            <input type="email"
                                   name="contact_email"
                                   class="form-control form-control-lg @error('contact_email') is-invalid @enderror"
                                   value="{{ old('contact_email', auth()->user()->email) }}"
                                   placeholder="you@example.com">
                            @error('contact_email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-grid mt-5">
                        <button type="submit"
                                class="btn btn-primary-custom btn-lg shadow-sm d-flex align-items-center justify-content-center gap-2">
                            <i data-lucide="upload-cloud" size="20"></i> Submit Report
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<footer class="bg-dark text-white py-5 mt-auto">
    <div class="container text-center">
        <div class="d-flex justify-content-center align-items-center gap-2 mb-4">
            <i data-lucide="compass" class="text-success"></i>
            <span class="fw-bold fs-5">weFind</span>
        </div>
        <p class="text-white-50 small mb-0">
            &copy; {{ date('Y') }} Lost and Found Management System. All Rights Reserved.
        </p>
    </div>
</footer>
@endsection
