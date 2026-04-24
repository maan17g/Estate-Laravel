@extends('layouts.dashboard')
@section('page-title', 'Add Property')
@section('dash-content')

<div class="d-flex align-items-center gap-3 mb-4">
  <a href="{{ route('admin.properties.index') }}" class="btn btn-outline-secondary rounded-pill px-3"><i class="bi bi-arrow-left"></i></a>
  <div>
    <h4 class="fw-bold mb-0" style="color:var(--text-main)">Add New Property</h4>
    <p class="mb-0" style="color:var(--text-muted); font-size:.875rem">Create a new property listing</p>
  </div>
</div>

<form action="{{ route('admin.properties.index') }}" method="POST" enctype="multipart/form-data">
  @csrf
  <div class="row g-4">
    <div class="col-lg-8">
      <div class="card bg-card border-color shadow-sm mb-4" style="border-radius:14px">
        <div class="card-body p-4">
          <h6 class="fw-bold mb-4" style="color:var(--text-main);border-bottom:1px solid var(--border-color);padding-bottom:12px">Basic Information</h6>
          <div class="mb-3"><label class="form-label">Property Title *</label><input type="text" name="title" class="form-control" placeholder="e.g. Luxury 3BR Villa in Beverly Hills" required></div>
          <div class="mb-3"><label class="form-label">Description</label><textarea name="description" class="form-control" rows="4" placeholder="Describe the property…"></textarea></div>
          <div class="row g-3">
            <div class="col-md-6"><label class="form-label">Property Type</label><select name="type" class="form-select"><option>Apartment</option><option>Villa</option><option>Townhouse</option><option>Penthouse</option><option>Office</option><option>Land</option></select></div>
            <div class="col-md-6"><label class="form-label">Listing Type</label><select name="listing_type" class="form-select"><option value="sale">For Sale</option><option value="rent">For Rent</option></select></div>
            <div class="col-md-6"><label class="form-label">Price ($) *</label><input type="number" name="price" class="form-control" required></div>
            <div class="col-md-6"><label class="form-label">Area (sq ft)</label><input type="number" name="area" class="form-control"></div>
            <div class="col-md-4"><label class="form-label">Bedrooms</label><input type="number" name="bedrooms" class="form-control" min="0"></div>
            <div class="col-md-4"><label class="form-label">Bathrooms</label><input type="number" name="bathrooms" class="form-control" min="0"></div>
            <div class="col-md-4"><label class="form-label">Garages</label><input type="number" name="garages" class="form-control" min="0"></div>
          </div>
        </div>
      </div>

      <div class="card bg-card border-color shadow-sm mb-4" style="border-radius:14px">
        <div class="card-body p-4">
          <h6 class="fw-bold mb-4" style="color:var(--text-main);border-bottom:1px solid var(--border-color);padding-bottom:12px"><i class="bi bi-geo-alt me-2" style="color:var(--primary)"></i>Location</h6>
          <div class="row g-3">
            <div class="col-12"><label class="form-label">Address</label><input type="text" name="address" class="form-control"></div>
            <div class="col-md-4"><label class="form-label">City</label><input type="text" name="city" class="form-control"></div>
            <div class="col-md-4"><label class="form-label">State</label><input type="text" name="state" class="form-control"></div>
            <div class="col-md-4"><label class="form-label">ZIP Code</label><input type="text" name="zip" class="form-control"></div>
          </div>
        </div>
      </div>

      <div class="card bg-card border-color shadow-sm" style="border-radius:14px">
        <div class="card-body p-4">
          <h6 class="fw-bold mb-4" style="color:var(--text-main);border-bottom:1px solid var(--border-color);padding-bottom:12px"><i class="bi bi-images me-2" style="color:var(--primary)"></i>Images</h6>
          <div style="border:2px dashed var(--border-color);border-radius:12px;padding:2rem;text-align:center;cursor:pointer" onclick="document.getElementById('imgInput').click()">
            <i class="bi bi-cloud-upload display-4" style="color:var(--text-muted);opacity:.5"></i>
            <p style="color:var(--text-muted);margin-top:.75rem;font-size:.9rem">Click or drag images here<br><small>JPG, PNG — Max 5MB each</small></p>
          </div>
          <input type="file" id="imgInput" name="images[]" multiple accept="image/*" class="d-none">
        </div>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="card bg-card border-color shadow-sm mb-4" style="border-radius:14px">
        <div class="card-body p-4">
          <h6 class="fw-bold mb-4" style="color:var(--text-main);border-bottom:1px solid var(--border-color);padding-bottom:12px">Listing Options</h6>
          <div class="mb-3"><label class="form-label">Status</label><select name="status" class="form-select"><option value="active">Active</option><option value="pending">Pending Review</option></select></div>
          <div class="mb-3"><label class="form-label">Assign to Agent</label><select name="agent_id" class="form-select"><option value="">— Select Agent —</option></select></div>
          <div class="form-check form-switch mb-3">
            <input class="form-check-input" type="checkbox" name="featured" id="featCheck" style="background-color:var(--primary)">
            <label class="form-check-label" for="featCheck" style="color:var(--text-main)">Featured Listing</label>
          </div>
        </div>
      </div>

      <div class="card bg-card border-color shadow-sm" style="border-radius:14px">
        <div class="card-body p-4">
          <h6 class="fw-bold mb-4" style="color:var(--text-main);border-bottom:1px solid var(--border-color);padding-bottom:12px">Amenities</h6>
          @foreach(['Swimming Pool','Gym / Fitness','Parking','Air Conditioning','Balcony','Garden','Security','Elevator'] as $a)
          <div class="form-check mb-2">
            <input class="form-check-input" type="checkbox" name="amenities[]" value="{{ $a }}" id="a{{ Str::slug($a) }}">
            <label class="form-check-label" for="a{{ Str::slug($a) }}" style="color:var(--text-main);font-size:.875rem">{{ $a }}</label>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>

  <div class="mt-4 d-flex gap-3">
    <button type="submit" class="btn btn-primary rounded-pill px-5 py-2 shadow-sm"><i class="bi bi-check-lg me-2"></i>Create Property</button>
    <a href="{{ route('admin.properties.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Cancel</a>
  </div>
</form>
@endsection
