@extends('layouts.app')
@section('content')
<main style="padding-top:120px; padding-bottom:80px; background:var(--bg-body);">
  <div class="container">
    <div class="text-center mb-5">
      <span class="badge rounded-pill px-3 py-2 mb-3" style="background:rgba(60,181,124,.15);color:var(--primary);font-size:.8rem;letter-spacing:2px;text-transform:uppercase">Our Team</span>
      <h2 style="color:var(--text-main);font-weight:800;font-size:2.2rem">Meet Our Agents</h2>
      <p style="color:var(--text-muted);max-width:560px;margin:0 auto">Experienced professionals ready to help you find your dream property or sell at the best price.</p>
    </div>

    <div class="row g-4">
      @forelse($agents ?? [] as $agent)
      <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="card border-0 text-center h-100" style="background:var(--form-bg);border:1px solid var(--border-color)!important;border-radius:18px;overflow:hidden;transition:transform .2s" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
          <div class="p-4">
            <div style="width:80px;height:80px;border-radius:50%;background:var(--primary);color:#fff;display:flex;align-items:center;justify-content:center;font-size:1.8rem;font-weight:700;margin:0 auto 1rem">{{ strtoupper(substr($agent->user->name??'A',0,1)) }}</div>
            <h5 style="color:var(--text-main);font-weight:700;margin-bottom:4px">{{ $agent->user->name ?? '—' }}</h5>
            <p style="color:var(--primary);font-size:.82rem;font-weight:600;margin-bottom:.5rem">{{ $agent->specialization ?? 'Real Estate Agent' }}</p>
            <p style="color:var(--text-muted);font-size:.82rem">{{ $agent->properties->count() ?? 0 }} Active Listings</p>
            <div class="d-flex justify-content-center gap-2 mt-3">
              @if($agent->is_verified)<span class="badge badge-status-active rounded-pill px-3" style="font-size:.72rem"><i class="bi bi-patch-check-fill me-1"></i>Verified</span>@endif
            </div>
          </div>
          <div class="card-footer border-0 p-3" style="background:rgba(60,181,124,.05)">
            <a href="{{ route('agents.show', $agent->id) }}" class="btn btn-outline-success btn-sm rounded-pill px-3 w-100">View Profile</a>
          </div>
        </div>
      </div>
      @empty
      @foreach([
        ['Sarah Johnson','Luxury Residential',24,'F'],
        ['Michael Chen','Commercial & Office',19,'M'],
        ['Emma Wilson','Townhouse Specialist',17,'F'],
        ['David Park','Investment Properties',21,'M'],
        ['Lisa Torres','Rental Management',15,'F'],
        ['James Wright','First-Time Buyers',13,'M'],
        ['Priya Sharma','Condo & Apartments',18,'F'],
        ['Carlos Ruiz','New Developments',22,'M'],
      ] as $a)
      <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="card border-0 text-center h-100" style="background:var(--form-bg);border:1px solid var(--border-color)!important;border-radius:18px;overflow:hidden;transition:transform .2s" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
          <div class="p-4">
            <div style="width:80px;height:80px;border-radius:50%;background:var(--primary);color:#fff;display:flex;align-items:center;justify-content:center;font-size:1.8rem;font-weight:700;margin:0 auto 1rem">{{ $a[3] }}</div>
            <h5 style="color:var(--text-main);font-weight:700;margin-bottom:4px">{{ $a[0] }}</h5>
            <p style="color:var(--primary);font-size:.82rem;font-weight:600;margin-bottom:.5rem">{{ $a[1] }}</p>
            <p style="color:var(--text-muted);font-size:.82rem">{{ $a[2] }} Active Listings</p>
            <span class="badge badge-status-active rounded-pill px-3 mt-2" style="font-size:.72rem"><i class="bi bi-patch-check-fill me-1"></i>Verified</span>
          </div>
          <div class="card-footer border-0 p-3" style="background:rgba(60,181,124,.05)">
            <a href="#" class="btn btn-outline-success btn-sm rounded-pill px-3 w-100">View Profile</a>
          </div>
        </div>
      </div>
      @endforeach
      @endforelse
    </div>
  </div>
</main>
@endsection
