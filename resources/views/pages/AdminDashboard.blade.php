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
            <div class="stat-card">
                <div class="stat-header">
                    <span class="stat-title">Total Items</span>
                    <div class="stat-icon green">
                        <i class="fas fa-box"></i>
                    </div>
                </div>
                <div class="stat-value">248</div>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i>
                    <span>12% from last month</span>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-header">
                    <span class="stat-title">Active Users</span>
                    <div class="stat-icon red">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
                <div class="stat-value">1,234</div>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i>
                    <span>15% from last month</span>
                </div>
            </div>
        </div>

        <div class="charts-grid" style="margin-top: 2rem; display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 1.5rem;">
            <leads-chart-card 
                total-leads="248" 
                :percentage-change="12" 
                money-spent="$0" 
                conversion-rate="85%" 
            ></leads-chart-card>
            
            </div>

        <div class="table-card">
            </div>

        <div class="table-card">
            </div>
    </main>
@endsection