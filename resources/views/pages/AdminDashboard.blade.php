@extends('layout.default')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/AdminDashboard.css') }}">
    
@endsection

@section('content')
    @include('partials.navbar')

    <main class="main-content">
        <div class="page-header">
            <h3>Dashboard Overview</h3>
        </div>

        <div class="stats-grid">
            {{-- Total Items --}}
            <div class="stat-card">
                <div class="stat-header">
                    <span class="stat-title">Total Items</span>
                    <div class="stat-icon green">
                        <i class="fas fa-box"></i>
                    </div>
                </div>
                <div class="stat-value">{{ $totalItems }}</div>
                @php $pct = $totalItemsChangePct; @endphp
                @if (!is_null($pct))
                    @php $up = $pct >= 0; @endphp
                    <div class="stat-change {{ $up ? 'positive' : 'negative' }}">
                        <i class="fas fa-arrow-{{ $up ? 'up' : 'down' }}"></i>
                        <span>{{ abs($pct) }}% vs last month</span>
                    </div>
                @else
                    <div class="stat-change">
                        <span>No data</span>
                    </div>
                @endif
            </div>

            {{-- Claimed Items --}}
            <div class="stat-card">
                <div class="stat-header">
                    <span class="stat-title">Claimed Items</span>
                    <div class="stat-icon blue">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>
                <div class="stat-value">{{ $claimedItems }}</div>
                @php $pct = $claimedItemsChangePct; @endphp
                @if (!is_null($pct))
                    @php $up = $pct >= 0; @endphp
                    <div class="stat-change {{ $up ? 'positive' : 'negative' }}">
                        <i class="fas fa-arrow-{{ $up ? 'up' : 'down' }}"></i>
                        <span>{{ abs($pct) }}% vs last month</span>
                    </div>
                @else
                    <div class="stat-change">
                        <span>No data</span>
                    </div>
                @endif
            </div>

            {{-- Pending Claims (appointments) --}}
            <div class="stat-card">
                <div class="stat-header">
                    <span class="stat-title">Pending Claims</span>
                    <div class="stat-icon yellow">
                        <i class="fas fa-clock"></i>
                    </div>
                </div>
                <div class="stat-value">{{ $pendingClaims }}</div>
                @php $pct = $pendingClaimsChangePct; @endphp
                @if (!is_null($pct))
                    @php $up = $pct >= 0; @endphp
                    <div class="stat-change {{ $up ? 'positive' : 'negative' }}">
                        <i class="fas fa-arrow-{{ $up ? 'up' : 'down' }}"></i>
                        <span>{{ abs($pct) }}% vs last month</span>
                    </div>
                @else
                    <div class="stat-change">
                        <span>No data</span>
                    </div>
                @endif
            </div>

            {{-- Active Users --}}
            <div class="stat-card">
                <div class="stat-header">
                    <span class="stat-title">Active Users</span>
                    <div class="stat-icon red">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
                <div class="stat-value">{{ $activeUsers }}</div>
                @php $pct = $activeUsersChangePct; @endphp
                @if (!is_null($pct))
                    @php $up = $pct >= 0; @endphp
                    <div class="stat-change {{ $up ? 'positive' : 'negative' }}">
                        <i class="fas fa-arrow-{{ $up ? 'up' : 'down' }}"></i>
                        <span>{{ abs($pct) }}% vs last month</span>
                    </div>
                @else
                    <div class="stat-change">
                        <span>No data</span>
                    </div>
                @endif
            </div>
        </div>

        <div class="graph-section" style="margin-top: 2rem; margin-bottom: 2rem;">
            <div class="chart-card">
                <div class="chart-card-header">
                    <div>
                        <div class="chart-main-value">{{ $totalReports }}</div>
                        <div class="chart-subtitle">Weekly Reports</div>
                    </div>

                    <div class="chart-change">
                        @php $pct = $reportsChangePct; @endphp
                        @if (!is_null($pct))
                            @php $up = $pct >= 0; @endphp
                            <span class="chart-change-value {{ $up ? 'positive' : 'negative' }}">
                                <i class="fas fa-arrow-{{ $up ? 'up' : 'down' }}"></i>
                                {{ abs($pct) }}%
                            </span>
                        @else
                            <span class="chart-change-value">No data</span>
                        @endif
                    </div>
                </div>

                <div class="chart-meta">
                    <span>Lost Items: {{ $lostReportsCount }}</span>
                    <span>Found Items: {{ $foundReportsCount }}</span>
                </div>

                {{-- Placeholder for actual bars; you can draw them later with Chart.js --}}
                <div class="chart-placeholder">
                    <canvas id="reportsChart"></canvas>
                </div>

                <div class="chart-footer">
                    <span>Last 7 days</span>
                    <a href="{{ route('admin.reports') }}" class="chart-footer-link">Full report →</a>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('scripts')
    {{-- Chart.js CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

    <script>
        const chartLabels     = @json($labels);
        const chartLostData   = @json($lostPerDay);
        const chartFoundData  = @json($foundPerDay);

        const ctx = document.getElementById('reportsChart');

        if (ctx) {
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: chartLabels,
                    datasets: [
                        {
                            label: 'Lost Items',
                            data: chartLostData,
                            backgroundColor: '#1f9d55', // darker green
                            borderRadius: 6,
                            barThickness: 18,
                        },
                        {
                            label: 'Found Items',
                            data: chartFoundData,
                            backgroundColor: '#34d399', // lighter green
                            borderRadius: 6,
                            barThickness: 18,
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                            labels: {
                                usePointStyle: true,
                            }
                        },
                        tooltip: {
                            enabled: true,
                        }
                    },
                    scales: {
                        x: {
                            grid: { display: false },
                        },
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0,
                                stepSize: 1,
                            }
                        }
                    }
                }
            });
        }
    </script>
@endsection
