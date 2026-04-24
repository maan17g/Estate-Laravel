@extends('layouts.dashboard')
@section('page-title', 'My Offers')
@section('dash-content')

<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h4 class="fw-bold mb-1" style="color:var(--text-main)">My Offers</h4>
    <p class="mb-0" style="color:var(--text-muted); font-size:.875rem">Offers you've submitted on properties</p>
  </div>
</div>

<div class="card bg-card border-color shadow-sm" style="border-radius:14px">
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table dash-table mb-0">
        <thead>
          <tr><th class="ps-4">#</th><th>Property</th><th>Asking Price</th><th>Your Offer</th><th>Status</th><th>Date</th></tr>
        </thead>
        <tbody>
          @forelse($data ?? [] as $offer)
          <tr>
            <td class="ps-4 text-muted" style="font-size:.8rem">#{{ $offer->id }}</td>
            <td>
              <div style="color:var(--text-main);font-weight:500;max-width:180px" class="text-truncate">{{ $offer->property->title ?? '—' }}</div>
              <div style="color:var(--text-muted);font-size:.78rem"><i class="bi bi-geo-alt"></i> {{ $offer->property->location ?? '' }}</div>
            </td>
            <td style="color:var(--text-muted);font-size:.85rem">${{ number_format($offer->property->price ?? 0) }}</td>
            <td style="color:var(--primary);font-weight:700">${{ number_format($offer->amount ?? 0) }}</td>
            <td>
              @php $st = $offer->status ?? 'pending'; @endphp
              <span class="badge rounded-pill px-3 py-2
                @if($st==='accepted') badge-status-active
                @elseif($st==='pending') badge-status-pending
                @elseif($st==='countered') badge-status-pending
                @else badge-status-rejected @endif" style="font-size:.72rem">{{ ucfirst($st) }}</span>
            </td>
            <td style="color:var(--text-muted);font-size:.82rem">{{ $offer->created_at?->format('M d, Y') }}</td>
          </tr>
          @empty
          <tr><td colspan="6" class="text-center py-5" style="color:var(--text-muted)"><i class="bi bi-tags display-5 d-block mb-2" style="opacity:.3"></i>You haven't made any offers yet.<br><a href="{{ route('properties.index') }}" class="btn btn-primary rounded-pill mt-3 px-4">Browse Properties</a></td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
