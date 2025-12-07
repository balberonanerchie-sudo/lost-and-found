@extends('layout.student')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
@endsection

@section('content')
<div class="d-flex flex-column min-vh-100">

    <div class="container-lg py-5 flex-grow-1">
        <div class="text-center mb-4">
            <h2 class="fw-bold">My Appointments</h2>
            <p class="text-muted small mb-0">
                View your scheduled turnovers and claim appointments.
            </p>
        </div>

        <div class="custom-card p-3 p-md-4 bg-white shadow-sm rounded-4">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Type</th>
                            <th scope="col">Item</th>
                            <th scope="col">Date</th>
                            <th scope="col">Time</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($appointments as $appointment)
                        @php
                            $typeLabel = $appointment->type === 'claim'
                                ? 'Claim Item'
                                : 'Turnover Item';

                            $status = $appointment->status ?? 'pending';

                            $statusClass = match ($status) {
                                'approved', 'confirmed' => 'badge bg-success-subtle text-success',
                                'completed'             => 'badge bg-primary-subtle text-primary',
                                'cancelled'             => 'badge bg-danger-subtle text-danger',
                                default                 => 'badge bg-warning-subtle text-warning',
                            };

                            $statusLabel = ucfirst($status);
                        @endphp
                        <tr>
                            <td>
                                <span class="fw-medium">{{ $typeLabel }}</span>
                            </td>
                            <td>
                                @if($appointment->item)
                                    <span class="fw-medium">
                                        {{ $appointment->item->name ?? $appointment->item->item_name }}
                                    </span>
                                @else
                                    <span class="text-muted small">Not linked to an item</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <i data-lucide="calendar" size="16" class="text-muted"></i>
                                    <span>
                                        {{ \Carbon\Carbon::parse($appointment->date)->format('M d, Y') }}
                                    </span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <i data-lucide="clock" size="16" class="text-muted"></i>
                                    <span>{{ $appointment->time }}</span>
                                </div>
                            </td>
                            <td>
                                <span class="{{ $statusClass }}">
                                    {{ $statusLabel }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        {{-- Static sample rows for now --}}
                        <tr>
                            <td><span class="fw-medium">Claim Item</span></td>
                            <td><span class="fw-medium">Black Wallet</span></td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <i data-lucide="calendar" size="16" class="text-muted"></i>
                                    <span>Oct 12, 2025</span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <i data-lucide="clock" size="16" class="text-muted"></i>
                                    <span>10:30 AM</span>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-warning-subtle text-warning">Pending</span>
                            </td>
                        </tr>
                        <tr>
                            <td><span class="fw-medium">Claim Item</span></td>
                            <td><span class="fw-medium">Blue Umbrella</span></td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <i data-lucide="calendar" size="16" class="text-muted"></i>
                                    <span>Oct 13, 2025</span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <i data-lucide="clock" size="16" class="text-muted"></i>
                                    <span>2:00 PM</span>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-warning-subtle text-warning">Pending</span>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination (only if there are real records) --}}
            @if($appointments->count())
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <p class="small text-muted mb-0">
                        Showing {{ $appointments->firstItem() }} to {{ $appointments->lastItem() }}
                        of {{ $appointments->total() }} appointments
                    </p>
                    <div>
                        {{ $appointments->links() }}
                    </div>
                </div>
            @endif
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
</div>
@endsection
