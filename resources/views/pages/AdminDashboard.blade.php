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
                    <span class="stat-title">Claimed Items</span>
                    <div class="stat-icon blue">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>
                <div class="stat-value">182</div>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i>
                    <span>8% from last month</span>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <span class="stat-title">Pending Claims</span>
                    <div class="stat-icon yellow">
                        <i class="fas fa-clock"></i>
                    </div>
                </div>
                <div class="stat-value">66</div>
                <div class="stat-change negative">
                    <i class="fas fa-arrow-down"></i>
                    <span>3% from last month</span>
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

        <div class="graph-section" style="margin-top: 2rem; margin-bottom: 2rem;">
            <leads-chart-card 
                total-reports="248" 
                :percentage-change="12" 
                lost-count="150" 
                found-count="98">
            </leads-chart-card>
        </div>

       
        </div>
    </main>
@endsection