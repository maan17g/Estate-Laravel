@extends('layouts.dashboard')
@section('page-title', 'My Rental')
@section('dash-content')

<div class="mb-4">
  <h4 class="fw-bold mb-1" style="color:var(--text-main)">My Rental</h4>
  <p class="mb-0" style="color:var(--text-muted); font-size:.875rem">Your current rental agreement and payment schedule</p>
</div>

@if(isset($tenant) && $tenant)
<div class="row g-4">
  <div class="col-lg-8">
    <div class="card bg-card border-color shadow-sm mb-4" style="border-radius:14px">
      <div class="card-body p-4">
        <h6 class="fw-bold mb-4" style="color:var(--text-main);border-bottom:1px solid var(--border-color);padding-bottom:12px"><i class="bi bi-house-door me-2" style="color:var(--primary)"></i>Active Lease</h6>
        <div class="row g-3">
          <div class="col-md-6"><label class="form-label">Property</label><div class="form-control" style="background:var(--bg-body);pointer-events:none">{{ $tenant->property->title ?? '—' }}</div></div>
          <div class="col-md-6"><label class="form-label">Monthly Rent</label><div class="form-control" style="background:var(--bg-body);pointer-events:none;color:var(--primary);font-weight:700">${{ number_format($tenant->monthly_rent ?? 0) }}</div></div>
          <div class="col-md-6"><label class="form-label">Lease Start</label><div class="form-control" style="background:var(--bg-body);pointer-events:none">{{ $tenant->lease_start ?? '—' }}</div></div>
          <div class="col-md-6"><label class="form-label">Lease End</label><div class="form-control" style="background:var(--bg-body);pointer-events:none">{{ $tenant->lease_end ?? '—' }}</div></div>
        </div>
      </div>
    </div>
  </div>
</div>
@else
<div class="card bg-card border-color shadow-sm" style="border-radius:14px">
  <div class="card-body text-center py-5">
    <i class="bi bi-house-door display-4" style="color:var(--text-muted);opacity:.4"></i>
    <h5 class="mt-3" style="color:var(--text-main)">No Active Rental</h5>
    <p style="color:var(--text-muted)">You don't have an active rental agreement at the moment.</p>
    <a href="{{ route('properties.index', ['type' => 'rent']) }}" class="btn btn-primary rounded-pill px-4 mt-2">Browse Rentals</a>
  </div>
</div>
@endif
@endsection
