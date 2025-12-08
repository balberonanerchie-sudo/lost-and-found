@extends('layout.student')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
    <style>
        .appointments-wrapper {
            max-width: 960px;
            margin: 0 auto;
        }
        .appointments-card {
            background: #ffffff;
            border-radius: 18px;
            padding: 1.75rem 2rem;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
        }
        .appointments-table thead th {
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            color: #6b7280;
            border-bottom-width: 1px;
        }
        .appointments-table tbody td {
            font-size: 0.92rem;
        }
        .appointments-meta {
            font-size: 0.8rem;
            color: #6b7280;
        }
    </style>
@endsection

@section('content')
<div class="d-flex flex-column min-vh-100">

    <div class="container-lg py-5 flex-grow-1 appointments-wrapper">
        <div class="text-center mb-4">
            <h2 class="fw-bold mb-1">My Appointments</h2>
            <p class="text-muted small mb-0">
                View your scheduled turnovers and claim appointments.
            </p>
        </div>

        <div class="appointments-card bg-white">
            <div class="table-responsive">
                <table class="table align-middle mb-0 appointments-table">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Type</th>
                            <th scope="col">Item</th>
                            <th scope="col">Date</th>
                            <th scope="col">Time</th>
                            <th scope="col" class="text-end">Status</th>
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
                            <td class="fw-medium">{{ $typeLabel }}</td>
                            <td>
                                @if ($appointment->item)
                                    {{ $appointment->item->item_name }}
                                @elseif (!empty($appointment->notes))
                                    {{ $appointment->notes }}
                                @else
                                    <span class="text-muted">Not linked to an item</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <i data-lucide="calendar" size="16" class="text-muted"></i>
                                    <span>{{ \Carbon\Carbon::parse($appointment->date)->format('M d, Y') }}</span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <i data-lucide="clock" size="16" class="text-muted"></i>
                                    <span>{{ $appointment->time }}</span>
                                </div>
                            </td>
                            <td class="text-end">
                                <span class="{{ $statusClass }}">
                                    {{ $statusLabel }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                No appointments found.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            @if($appointments->count())
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mt-3 gap-2">
                    <p class="appointments-meta mb-0">
                        
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
