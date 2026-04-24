@extends('layouts.dashboard')
@section('page-title', 'Settings')
@section('dash-content')

<div class="mb-4">
  <h4 class="fw-bold mb-1" style="color:var(--text-main)">Platform Settings</h4>
  <p class="mb-0" style="color:var(--text-muted); font-size:.875rem">Configure general platform options</p>
</div>

<form action="{{ route('admin.settings.index') }}" method="POST">
  @csrf

  <div class="row g-4">
    <div class="col-lg-8">
      <div class="card bg-card border-color shadow-sm mb-4" style="border-radius:14px">
        <div class="card-body p-4">
          <h6 class="fw-bold mb-4" style="color:var(--text-main);border-bottom:1px solid var(--border-color);padding-bottom:12px"><i class="bi bi-globe2 me-2" style="color:var(--primary)"></i>General Settings</h6>
          <div class="row g-3">
            <div class="col-md-6"><label class="form-label">Site Name</label><input type="text" name="site_name" class="form-control" value="{{ old('site_name', 'Dream Home Real Estate') }}"></div>
            <div class="col-md-6"><label class="form-label">Contact Email</label><input type="email" name="contact_email" class="form-control" value="{{ old('contact_email', 'info@dreamhome.com') }}"></div>
            <div class="col-md-6"><label class="form-label">Contact Phone</label><input type="text" name="contact_phone" class="form-control" value="{{ old('contact_phone', '+1 (310) 555-0100') }}"></div>
            <div class="col-md-6"><label class="form-label">Office Address</label><input type="text" name="address" class="form-control" value="{{ old('address', 'Beverly Hills, CA 90210') }}"></div>
            <div class="col-12"><label class="form-label">Site Description</label><textarea name="description" class="form-control" rows="3">{{ old('description', 'Find your perfect property with verified listings and expert guidance.') }}</textarea></div>
          </div>
        </div>
      </div>

      <div class="card bg-card border-color shadow-sm mb-4" style="border-radius:14px">
        <div class="card-body p-4">
          <h6 class="fw-bold mb-4" style="color:var(--text-main);border-bottom:1px solid var(--border-color);padding-bottom:12px"><i class="bi bi-shield-lock me-2 text-warning"></i>Platform Rules</h6>
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Property Approval</label>
              <select name="property_approval" class="form-select">
                <option value="manual">Manual (Admin approves)</option>
                <option value="auto">Automatic</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Agent Verification</label>
              <select name="agent_verification" class="form-select">
                <option value="manual">Manual (Admin verifies)</option>
                <option value="auto">Automatic</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Currency</label>
              <select name="currency" class="form-select">
                <option value="USD">USD ($)</option>
                <option value="EUR">EUR (€)</option>
                <option value="GBP">GBP (£)</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Platform Commission (%)</label>
              <input type="number" name="commission" class="form-control" value="5" min="0" max="100">
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="card bg-card border-color shadow-sm mb-4" style="border-radius:14px">
        <div class="card-body p-4">
          <h6 class="fw-bold mb-4" style="color:var(--text-main);border-bottom:1px solid var(--border-color);padding-bottom:12px"><i class="bi bi-bell me-2" style="color:var(--primary)"></i>Notifications</h6>
          @foreach([['New user registration','notify_new_user'],['New property listing','notify_new_property'],['New inquiry','notify_inquiry'],['Transaction completed','notify_transaction']] as $n)
          <div class="form-check form-switch mb-3">
            <input class="form-check-input" type="checkbox" name="{{ $n[1] }}" id="{{ $n[1] }}" checked style="background-color:var(--primary);border-color:var(--primary)">
            <label class="form-check-label" for="{{ $n[1] }}" style="color:var(--text-main);font-size:.9rem">{{ $n[0] }}</label>
          </div>
          @endforeach
        </div>
      </div>

      <div class="card bg-card border-color shadow-sm" style="border-radius:14px">
        <div class="card-body p-4">
          <h6 class="fw-bold mb-4" style="color:var(--text-main);border-bottom:1px solid var(--border-color);padding-bottom:12px"><i class="bi bi-envelope me-2 text-warning"></i>Email Settings</h6>
          <div class="mb-3"><label class="form-label">Mail Driver</label><select name="mail_driver" class="form-select"><option>SMTP</option><option>Mailgun</option><option>SendGrid</option></select></div>
          <div class="mb-3"><label class="form-label">SMTP Host</label><input type="text" name="smtp_host" class="form-control" placeholder="smtp.example.com"></div>
          <div class="mb-3"><label class="form-label">SMTP Port</label><input type="text" name="smtp_port" class="form-control" value="587"></div>
        </div>
      </div>
    </div>
  </div>

  <div class="mt-2">
    <button type="submit" class="btn btn-primary rounded-pill px-5 py-2 shadow-sm"><i class="bi bi-check-lg me-2"></i>Save Settings</button>
  </div>
</form>
@endsection
