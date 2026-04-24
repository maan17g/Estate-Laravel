@extends('layouts.dashboard')
@section('page-title', 'List New Property')
@section('dash-content')

<div class="d-flex align-items-center gap-3 mb-4">
  <a href="{{ route('agent.properties.index') }}" class="btn btn-outline-secondary rounded-pill px-3"><i class="bi bi-arrow-left"></i></a>
  <div>
    <h4 class="fw-bold mb-0" style="color:var(--text-main)">List New Property</h4>
    <p class="mb-0" style="color:var(--text-muted); font-size:.875rem">Submit your property for admin review</p>
  </div>
</div>

<div class="alert border-0 mb-4 d-flex align-items-center gap-3" style="background:rgba(255,193,7,.1);border-radius:12px;border-left:4px solid #ffc107!important">
  <i class="bi bi-info-circle-fill text-warning fs-5"></i>
  <span style="color:var(--text-main);font-size:.9rem">Your listing will be reviewed by an admin before going live. This usually takes 24–48 hours.</span>
</div>

<form action="{{ route('agent.properties.store') }}" method="POST" enctype="multipart/form-data">
  @csrf
  <div class="row g-4">
    <div class="col-lg-8">
      <div class="card bg-card border-color shadow-sm mb-4" style="border-radius:14px">
        <div class="card-body p-4">
          <h6 class="fw-bold mb-4" style="color:var(--text-main);border-bottom:1px solid var(--border-color);padding-bottom:12px">Property Details</h6>
          <div class="mb-3"><label class="form-label">Title *</label><input type="text" name="title" class="form-control" placeholder="e.g. Spacious 3BR Apartment in Downtown" required value="{{ old('title') }}"></div>
          <div class="mb-3"><label class="form-label">Description</label><textarea name="description" class="form-control" rows="4" placeholder="Describe key features, highlights, and surroundings…">{{ old('description') }}</textarea></div>
          <div class="row g-3">
            <div class="col-md-6"><label class="form-label">Type</label><select name="type" class="form-select"><option>Apartment</option><option>Villa</option><option>Townhouse</option><option>Penthouse</option><option>Office</option><option>Land</option></select></div>
            <div class="col-md-6"><label class="form-label">For Sale / Rent</label><select name="listing_type" class="form-select"><option value="sale">For Sale</option><option value="rent">For Rent</option></select></div>
            <div class="col-md-6"><label class="form-label">Price ($) *</label><input type="number" name="price" class="form-control" required value="{{ old('price') }}"></div>
            <div class="col-md-6"><label class="form-label">Area (sq ft)</label><input type="number" name="area" class="form-control" value="{{ old('area') }}"></div>
            <div class="col-md-4"><label class="form-label">Bedrooms</label><input type="number" name="bedrooms" class="form-control" min="0" value="{{ old('bedrooms',0) }}"></div>
            <div class="col-md-4"><label class="form-label">Bathrooms</label><input type="number" name="bathrooms" class="form-control" min="0" value="{{ old('bathrooms',0) }}"></div>
            <div class="col-md-4"><label class="form-label">Garages</label><input type="number" name="garages" class="form-control" min="0" value="{{ old('garages',0) }}"></div>
          </div>
        </div>
      </div>

      <div class="card bg-card border-color shadow-sm mb-4" style="border-radius:14px">
        <div class="card-body p-4">
          <h6 class="fw-bold mb-4" style="color:var(--text-main);border-bottom:1px solid var(--border-color);padding-bottom:12px"><i class="bi bi-geo-alt me-2" style="color:var(--primary)"></i>Location</h6>
          <div class="row g-3">
            <div class="col-12"><label class="form-label">Address</label><input type="text" name="address" class="form-control" value="{{ old('address') }}"></div>
            <div class="col-md-4"><label class="form-label">City</label><input type="text" name="city" class="form-control" value="{{ old('city') }}"></div>
            <div class="col-md-4"><label class="form-label">State</label><input type="text" name="state" class="form-control" value="{{ old('state') }}"></div>
            <div class="col-md-4"><label class="form-label">ZIP</label><input type="text" name="zip" class="form-control" value="{{ old('zip') }}"></div>
          </div>
        </div>
      </div>

      <div class="card bg-card border-color shadow-sm" style="border-radius:14px">
        <div class="card-body p-4">
          <h6 class="fw-bold mb-3" style="color:var(--text-main);border-bottom:1px solid var(--border-color);padding-bottom:12px"><i class="bi bi-images me-2" style="color:var(--primary)"></i>Upload Images</h6>
          <div style="border:2px dashed var(--border-color);border-radius:12px;padding:2rem;text-align:center;cursor:pointer" onclick="document.getElementById('imgInput').click()">
            <i class="bi bi-cloud-upload display-4" style="color:var(--text-muted);opacity:.5"></i>
            <p style="color:var(--text-muted);margin-top:.75rem;font-size:.9rem">Click to upload images<br><small>JPG, PNG — Max 5MB each</small></p>
          </div>
          <input type="file" id="imgInput" name="images[]" multiple accept="image/*" class="d-none">
        </div>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="card bg-card border-color shadow-sm" style="border-radius:14px">
        <div class="card-body p-4">
          <h6 class="fw-bold mb-4" style="color:var(--text-main);border-bottom:1px solid var(--border-color);padding-bottom:12px">Amenities</h6>
          @foreach(['Swimming Pool','Gym / Fitness','Parking','Air Conditioning','Balcony','Garden','Security','Elevator','Pet Friendly','Furnished'] as $a)
          <div class="form-check mb-2">
            <input class="form-check-input" type="checkbox" name="amenities[]" value="{{ $a }}" id="ag{{ Str::slug($a) }}">
            <label class="form-check-label" for="ag{{ Str::slug($a) }}" style="color:var(--text-main);font-size:.875rem">{{ $a }}</label>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>

  <div class="mt-4 d-flex gap-3">
    <button type="submit" class="btn btn-primary rounded-pill px-5 py-2 shadow-sm"><i class="bi bi-send me-2"></i>Submit for Review</button>
    <a href="{{ route('agent.properties.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Cancel</a>
  </div>
</form>
@endsection
