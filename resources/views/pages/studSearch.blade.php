@extends('layout.student')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
@endsection

@section('content')
    <div class="d-flex flex-column min-vh-100">

        <div class="container-lg py-5 flex-grow-1">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Search Found Items</h2>
            </div>

            <div class="card border-0 shadow-sm p-4 rounded-4 mb-5 bg-white">
                <form action="" method="GET">
                    <div class="row g-3">
                        <div class="col-lg-5">
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i data-lucide="search" size="18"></i>
                                </span>
                                <input type="text" name="query" value="{{ request('query') }}"
                                    class="form-control form-control-lg bg-light border-start-0"
                                    placeholder="What are you looking for? (e.g. Wallet)">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <select name="category" class="form-select form-select-lg bg-light">
                                <option value="">All Categories</option>
                                <option value="electronics">Electronics</option>
                                <option value="clothing">Clothing</option>
                                <option value="accessories">Accessories</option>
                            </select>
                        </div>
                        <div class="col-lg-2">
                            <input type="date" name="date" class="form-control form-control-lg bg-light">
                        </div>
                        <div class="col-lg-2 d-grid">
                            <button type="submit" class="btn btn-primary-custom">Search</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="row g-4">
            @foreach($items as $item)
                <div class="col-md-6 col-lg-4">
                    <div class="custom-card h-100 d-flex flex-column shadow-sm border rounded-3 overflow-hidden">

                        {{-- Image --}}
                        <div class="card-img-placeholder bg-light d-flex align-items-center justify-content-center"
                            style="height: 200px;">
                            @if($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" 
                                    alt="{{ $item->item_name }}" 
                                    class="img-fluid h-100 w-100 object-fit-cover">
                            @else
                                <i data-lucide="image" size="48" class="opacity-50"></i>
                            @endif
                        </div>

                        <div class="p-4 flex-grow-1 d-flex flex-column">

                            {{-- Category + Timestamp --}}
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <span class="badge bg-success bg-opacity-10 text-success">
                                    {{ $item->category }}
                                </span>
                                <small class="text-muted">
                                    {{ $item->created_at->diffForHumans() }}
                                </small>
                            </div>

                            {{-- Title --}}
                            <h5 class="fw-bold text-dark">{{ $item->item_name }}</h5>

                            {{-- Description --}}
                            <p class="text-muted small mb-3">
                                {{ Str::limit($item->description, 100) }}
                            </p>

                            {{-- Location --}}
                            <div class="mt-auto pt-3 border-top d-flex align-items-center gap-2 text-muted small">
                                <i data-lucide="map-pin" size="14"></i>
                                <span>{{ $item->location }}</span>
                            </div>

                            {{-- Claim Button --}}
                            <a href="{{ url('/book-appointment/' . $item->id) }}" 
                            class="btn btn-success w-100 mt-3 btn-sm">
                                Claim
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="d-flex justify-content-center mt-4">
            {{ $items->links() }}
        </div>

        <footer class="bg-dark text-white py-5 mt-auto w-100">
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
    </div>
@endsection
