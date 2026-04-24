@extends('layouts.dashboard')
@section('page-title', 'My Dashboard')
@section('dash-content')

<div class="card bg-card border-color shadow-sm mb-5" style="border-radius:24px; background: linear-gradient(45deg, rgba(7, 14, 11, 0.9), transparent), url('https://images.unsplash.com/photo-1449844908441-8829872d2607?auto=format&fit=crop&w=1600&q=80') center/cover;">
    <div class="card-body p-5">
        <h2 style="color:#fff; font-weight:800; font-size:2.5rem; text-shadow:0 2px 10px rgba(0,0,0,0.5);">Ready to find your dream home?</h2>
        <p style="color:rgba(255,255,255,0.8); font-size:1.1rem; max-width:600px; text-shadow:0 2px 10px rgba(0,0,0,0.5);" class="mb-4">From modern luxury apartments to sprawling grand estates, effortlessly browse dynamically matched properties.</p>
        <a href="{{ route('properties.index') }}" class="btn btn-primary rounded-pill px-4 py-2" style="font-weight:600; font-size:1.1rem; box-shadow:0 5px 20px rgba(60,181,124,0.4);">Explore Gallery <i class="bi bi-arrow-right ms-2"></i></a>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-6">
        <div class="card bg-card border-color shadow-sm h-100" style="border-radius:18px;">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 style="color:var(--text-main); font-weight:700; margin:0;"><i class="bi bi-heart-fill text-danger me-2"></i> My Saved Properties</h5>
                    <a href="{{ route('customer.favorites.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill">View All</a>
                </div>
                
                <div class="text-center py-5">
                    <div style="width:80px; height:80px; border-radius:50%; background:rgba(231,76,60,0.1); color:#e74c3c; display:flex; align-items:center; justify-content:center; font-size:2.5rem; margin:0 auto 1.5rem auto;">
                        <i class="bi bi-heart"></i>
                    </div>
                    <h6 style="color:var(--text-main);">No favorites yet</h6>
                    <p style="color:var(--text-muted); font-size:0.9rem;">Start exploring the platform and save your dream properties here!</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card bg-card border-color shadow-sm h-100" style="border-radius:18px;">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 style="color:var(--text-main); font-weight:700; margin:0;"><i class="bi bi-calendar-event-fill text-primary me-2"></i> Upcoming Viewings</h5>
                    <a href="#" class="btn btn-sm btn-outline-secondary rounded-pill">Schedule</a>
                </div>
                
                <div class="text-center py-5">
                    <div style="width:80px; height:80px; border-radius:50%; background:rgba(60,181,124,0.1); color:var(--primary); display:flex; align-items:center; justify-content:center; font-size:2.5rem; margin:0 auto 1.5rem auto;">
                        <i class="bi bi-calendar-x"></i>
                    </div>
                    <h6 style="color:var(--text-main);">No appointments booked</h6>
                    <p style="color:var(--text-muted); font-size:0.9rem;">You currently don't have any viewings scheduled with our agents.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection