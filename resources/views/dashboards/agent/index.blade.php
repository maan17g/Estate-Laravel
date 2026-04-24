@extends('layouts.dashboard')
@section('page-title', 'Agent Dashboard')
@section('dash-content')

<div class="row align-items-center mb-5">
    <div class="col-md-8">
        <h3 style="color:var(--text-main); font-weight:800; margin-bottom:5px;">Agent Command Center</h3>
        <p style="color:var(--text-muted);">Manage your active portfolio, connect with clients, and schedule viewings.</p>
    </div>
    <div class="col-md-4 text-md-end mt-3 mt-md-0">
        <a href="{{ route('agent.properties.create') }}" class="btn btn-primary rounded-pill px-4 py-2 shadow"><i class="bi bi-plus-lg me-2"></i> List New Property</a>
    </div>
</div>

<div class="dash-stat-grid mb-5">
    <div class="dash-stat-card shadow-sm border-0" style="background: linear-gradient(135deg,rgba(60,181,124,0.1), transparent);">
        <div class="dash-stat-icon green"><i class="bi bi-house-check"></i></div>
        <div>
            <div class="dash-stat-num">24</div>
            <div class="dash-stat-label">Active Listings</div>
        </div>
    </div>
    <div class="dash-stat-card shadow-sm border-0">
        <div class="dash-stat-icon blue"><i class="bi bi-chat-dots"></i></div>
        <div>
            <div class="dash-stat-num">8</div>
            <div class="dash-stat-label">New Inquiries</div>
        </div>
    </div>
    <div class="dash-stat-card shadow-sm border-0">
        <div class="dash-stat-icon gold"><i class="bi bi-calendar-event"></i></div>
        <div>
            <div class="dash-stat-num">12</div>
            <div class="dash-stat-label">Upcoming Viewings</div>
        </div>
    </div>
    <div class="dash-stat-card shadow-sm border-0">
        <div class="dash-stat-icon" style="background:rgba(13,138,188,0.1); color:#0D8ABC;"><i class="bi bi-graph-up"></i></div>
        <div>
            <div class="dash-stat-num">14.2K</div>
            <div class="dash-stat-label">Impressions</div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-7">
        <div class="card bg-card border-color shadow-sm h-100" style="border-radius:18px;">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 style="color:var(--text-main); font-weight:700;">Top Performing Listings</h5>
                    <button class="btn btn-sm btn-outline-secondary">View All</button>
                </div>
                
                @foreach(range(1,4) as $idx)
                <div class="d-flex align-items-center gap-3 mb-4 p-3 rounded-4" style="background:var(--form-bg); border:1px solid var(--border-color); transition:transform 0.2s;">
                    <img src="https://images.unsplash.com/photo-1600{{ rand(10000,60000) }}-{{ rand(1000,9999) }}?auto=format&fit=crop&w=150&q=80" style="width:70px; height:70px; border-radius:12px; object-fit:cover;">
                    <div style="flex-grow:1;">
                        <h6 style="color:var(--text-main); font-weight:600; margin-bottom:4px;">Luxury Villa #{{ rand(100,500) }}</h6>
                        <div style="font-size:0.8rem; color:var(--text-muted);"><i class="bi bi-eye"></i> {{ rand(1000, 5000) }} Views &nbsp;&middot;&nbsp; <i class="bi bi-heart"></i> {{ rand(10, 50) }} Saves</div>
                    </div>
                    <div class="text-end">
                        <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">Active</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="card bg-card border-color shadow-sm h-100" style="border-radius:18px;">
            <div class="card-body p-4">
                <h5 style="color:var(--text-main); font-weight:700; mb-4">Client Messages</h5>
                <div class="text-center py-5 text-muted">
                    <i class="bi bi-envelope-paper display-4 mb-3" style="opacity:0.3"></i>
                    <h6>All Caught Up!</h6>
                    <p class="small">You have responded to all pending client inquiries.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection