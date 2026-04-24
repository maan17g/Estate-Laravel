@extends('layouts.dashboard')
@section('page-title', 'My Profile')
@section('dash-content')

<div class="mb-4">
  <h4 class="fw-bold mb-1" style="color:var(--text-main)">My Profile</h4>
  <p class="mb-0" style="color:var(--text-muted); font-size:.875rem">Update your agent profile and credentials</p>
</div>

<div class="row g-4">
  <div class="col-lg-4">
    <div class="card bg-card border-color shadow-sm text-center" style="border-radius:14px">
      <div class="card-body p-4">
        <div style="width:90px;height:90px;border-radius:50%;background:var(--primary);color:#fff;display:flex;align-items:center;justify-content:center;font-size:2rem;font-weight:700;margin:0 auto 1rem">
          {{ strtoupper(substr(auth()->user()->name,0,1)) }}
        </div>
        <h5 style="color:var(--text-main);font-weight:700">{{ auth()->user()->name }}</h5>
        <p style="color:var(--text-muted);font-size:.875rem">{{ auth()->user()->email }}</p>
        <span class="badge badge-status-active rounded-pill px-3 py-2">Licensed Agent</span>
        <div class="mt-4 pt-3 border-top" style="border-color:var(--border-color)!important">
          <div class="row g-0 text-center">
            <div class="col-4"><div style="color:var(--primary);font-size:1.4rem;font-weight:700">24</div><div style="color:var(--text-muted);font-size:.75rem">Listings</div></div>
            <div class="col-4" style="border-left:1px solid var(--border-color)"><div style="color:var(--primary);font-size:1.4rem;font-weight:700">18</div><div style="color:var(--text-muted);font-size:.75rem">Sales</div></div>
            <div class="col-4" style="border-left:1px solid var(--border-color)"><div style="color:var(--primary);font-size:1.4rem;font-weight:700">4.9</div><div style="color:var(--text-muted);font-size:.75rem">Rating</div></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-8">
    <div class="card bg-card border-color shadow-sm mb-4" style="border-radius:14px">
      <div class="card-body p-4">
        <h6 class="fw-bold mb-4" style="color:var(--text-main);border-bottom:1px solid var(--border-color);padding-bottom:12px">Personal Information</h6>
        <form method="POST" action="#">
          @csrf @method('PUT')
          <div class="row g-3">
            <div class="col-md-6"><label class="form-label">Full Name</label><input type="text" name="name" class="form-control" value="{{ auth()->user()->name }}"></div>
            <div class="col-md-6"><label class="form-label">Email</label><input type="email" name="email" class="form-control" value="{{ auth()->user()->email }}"></div>
            <div class="col-md-6"><label class="form-label">Phone</label><input type="text" name="phone" class="form-control" placeholder="+1 (555) 000-0000"></div>
            <div class="col-md-6"><label class="form-label">Specialization</label><input type="text" name="specialization" class="form-control" placeholder="e.g. Luxury Residential"></div>
            <div class="col-12"><label class="form-label">Bio</label><textarea name="bio" class="form-control" rows="3" placeholder="Tell clients about yourself…"></textarea></div>
            <div class="col-md-6"><label class="form-label">License Number</label><input type="text" name="license" class="form-control" placeholder="e.g. RE-12345"></div>
            <div class="col-md-6"><label class="form-label">Years of Experience</label><input type="number" name="experience" class="form-control" min="0"></div>
          </div>
          <div class="mt-4"><button type="submit" class="btn btn-primary rounded-pill px-5 shadow-sm"><i class="bi bi-check-lg me-2"></i>Save Changes</button></div>
        </form>
      </div>
    </div>

    <div class="card bg-card border-color shadow-sm" style="border-radius:14px">
      <div class="card-body p-4">
        <h6 class="fw-bold mb-4" style="color:var(--text-main);border-bottom:1px solid var(--border-color);padding-bottom:12px"><i class="bi bi-shield-lock me-2 text-warning"></i>Change Password</h6>
        <form method="POST" action="#">
          @csrf @method('PUT')
          <div class="row g-3">
            <div class="col-md-12"><label class="form-label">Current Password</label><input type="password" name="current_password" class="form-control"></div>
            <div class="col-md-6"><label class="form-label">New Password</label><input type="password" name="password" class="form-control"></div>
            <div class="col-md-6"><label class="form-label">Confirm New Password</label><input type="password" name="password_confirmation" class="form-control"></div>
          </div>
          <div class="mt-4"><button type="submit" class="btn btn-warning rounded-pill px-5 text-dark fw-semibold"><i class="bi bi-key me-2"></i>Update Password</button></div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
