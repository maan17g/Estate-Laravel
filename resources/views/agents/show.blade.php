@extends('layouts.app')
@section('content')
<main style="padding-top:120px; padding-bottom:80px; background:var(--bg-body);">
  <div class="container">
    @isset($agent)
    <div class="row g-4">
      <div class="col-lg-4">
        <div class="card border-0 text-center" style="background:var(--form-bg);border:1px solid var(--border-color)!important;border-radius:18px">
          <div class="card-body p-4">
            <div style="width:100px;height:100px;border-radius:50%;background:var(--primary);color:#fff;display:flex;align-items:center;justify-content:center;font-size:2.5rem;font-weight:700;margin:0 auto 1.5rem">{{ strtoupper(substr($agent->user->name??'A',0,1)) }}</div>
            <h4 style="color:var(--text-main);font-weight:800">{{ $agent->user->name ?? '—' }}</h4>
            <p style="color:var(--primary);font-weight:600">{{ $agent->specialization ?? 'Real Estate Agent' }}</p>
            @if($agent->is_verified)<span class="badge badge-status-active rounded-pill px-3 mb-3"><i class="bi bi-patch-check-fill me-1"></i>Verified Agent</span>@endif
            <div class="border-top pt-3 mt-2" style="border-color:var(--border-color)!important">
              <div class="row text-center g-0">
                <div class="col-4"><div style="color:var(--primary);font-size:1.3rem;font-weight:800">{{ $agent->properties->count() }}</div><div style="color:var(--text-muted);font-size:.75rem">Listings</div></div>
                <div class="col-4" style="border-left:1px solid var(--border-color)"><div style="color:var(--primary);font-size:1.3rem;font-weight:800">{{ $agent->experience ?? '5+' }}</div><div style="color:var(--text-muted);font-size:.75rem">Yrs Exp</div></div>
                <div class="col-4" style="border-left:1px solid var(--border-color)"><div style="color:var(--primary);font-size:1.3rem;font-weight:800">4.9</div><div style="color:var(--text-muted);font-size:.75rem">Rating</div></div>
              </div>
            </div>
            <div class="mt-4 d-flex flex-column gap-2">
              @if($agent->phone)<a href="tel:{{ $agent->phone }}" class="btn btn-primary rounded-pill w-100"><i class="bi bi-telephone me-2"></i>{{ $agent->phone }}</a>@endif
              @if($agent->user->email)<a href="mailto:{{ $agent->user->email }}" class="btn btn-outline-secondary rounded-pill w-100"><i class="bi bi-envelope me-2"></i>Send Email</a>@endif
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-8">
        @if($agent->bio)
        <div class="card border-0 mb-4" style="background:var(--form-bg);border:1px solid var(--border-color)!important;border-radius:18px">
          <div class="card-body p-4">
            <h5 style="color:var(--text-main);font-weight:700" class="mb-3">About</h5>
            <p style="color:var(--text-muted);line-height:1.8">{{ $agent->bio }}</p>
          </div>
        </div>
        @endif
        <h5 style="color:var(--text-main);font-weight:700" class="mb-3">Active Listings</h5>
        <div class="row g-3">
          @forelse($agent->properties ?? [] as $p)
          <div class="col-md-6">
            <div class="card border-0" style="background:var(--form-bg);border:1px solid var(--border-color)!important;border-radius:14px;overflow:hidden">
              <div style="height:160px;background:var(--lightgreen);display:flex;align-items:center;justify-content:center"><i class="bi bi-house-door" style="font-size:3rem;color:var(--primary);opacity:.5"></i></div>
              <div class="p-3">
                <h6 style="color:var(--text-main);font-weight:600" class="mb-1">{{ $p->title }}</h6>
                <div style="color:var(--primary);font-weight:700">${{ number_format($p->price) }}</div>
                <a href="{{ route('properties.show', $p->slug ?? $p->id) }}" class="btn btn-sm btn-outline-primary rounded-pill mt-2 px-3">View</a>
              </div>
            </div>
          </div>
          @empty
          <div class="col-12 text-center py-4" style="color:var(--text-muted)"><i class="bi bi-house-slash display-5 d-block mb-2" style="opacity:.3"></i>No active listings.</div>
          @endforelse
        </div>
      </div>
    </div>
    @else
    <div class="text-center py-5" style="color:var(--text-muted)">
      <i class="bi bi-person-slash display-4 d-block mb-3" style="opacity:.3"></i>
      <h4 style="color:var(--text-main)">Agent Not Found</h4>
      <a href="{{ route('agents.index') }}" class="btn btn-primary rounded-pill mt-3 px-4">Back to Agents</a>
    </div>
    @endisset
  </div>
</main>
@endsection
