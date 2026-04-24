@extends('layouts.dashboard')
@section('page-title', 'Offers')
@section('dash-content')

<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h4 class="fw-bold mb-1" style="color:var(--text-main)">Offers</h4>
    <p class="mb-0" style="color:var(--text-muted); font-size:.875rem">Review and manage buyer offers on your listings</p>
  </div>
</div>

<div class="card bg-card border-color shadow-sm" style="border-radius:14px">
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table dash-table mb-0">
        <thead>
          <tr><th class="ps-4">#</th><th>Buyer</th><th>Property</th><th>Offered Price</th><th>Asking Price</th><th>Status</th><th>Date</th><th class="text-end pe-4">Actions</th></tr>
        </thead>
        <tbody>
          @forelse($data ?? [] as $offer)
          <tr>
            <td class="ps-4 text-muted" style="font-size:.8rem">#{{ $offer->id }}</td>
            <td>
              <div style="color:var(--text-main);font-weight:500">{{ $offer->buyer->name ?? '—' }}</div>
              <div style="color:var(--text-muted);font-size:.78rem">{{ $offer->buyer->email ?? '' }}</div>
            </td>
            <td style="color:var(--text-muted);font-size:.85rem;max-width:150px" class="text-truncate">{{ $offer->property->title ?? '—' }}</td>
            <td style="color:var(--primary);font-weight:700;font-size:1rem">${{ number_format($offer->amount ?? 0) }}</td>
            <td style="color:var(--text-muted);font-size:.85rem">${{ number_format($offer->property->price ?? 0) }}</td>
            <td>
              @php $st = $offer->status ?? 'pending'; @endphp
              <span class="badge rounded-pill px-3 py-2 @if($st==='accepted') badge-status-active @elseif($st==='pending') badge-status-pending @else badge-status-rejected @endif" style="font-size:.72rem">{{ ucfirst($st) }}</span>
            </td>
            <td style="color:var(--text-muted);font-size:.82rem">{{ $offer->created_at?->format('M d, Y') }}</td>
            <td class="text-end pe-4">
              @if($st === 'pending')
              <div class="d-flex justify-content-end gap-1">
                <form action="{{ route('agent.offers.accept', $offer->id) }}" method="POST">
                  @csrf
                  <button type="submit" class="btn btn-sm btn-success rounded-pill px-3"><i class="bi bi-check-lg me-1"></i>Accept</button>
                </form>
                <button class="btn btn-sm btn-outline-danger rounded-pill px-3"><i class="bi bi-x-lg me-1"></i>Decline</button>
                <button class="btn btn-sm btn-outline-secondary rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#counterModal" data-id="{{ $offer->id }}" data-buyer="{{ $offer->buyer->name ?? '' }}" data-property="{{ $offer->property->title ?? '' }}" data-amount="{{ $offer->amount }}"><i class="bi bi-arrow-left-right me-1"></i>Counter</button>
              </div>
              @else
              <span class="text-muted" style="font-size:.82rem">—</span>
              @endif
            </td>
          </tr>
          @empty
          <tr><td colspan="8" class="text-center py-5" style="color:var(--text-muted)"><i class="bi bi-tags display-5 d-block mb-2" style="opacity:.3"></i>No offers received yet.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Counter Offer Modal -->
<div class="modal fade" id="counterModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bg-card border-color">
      <div class="modal-header border-0"><h5 class="modal-title fw-bold" style="color:var(--text-main)"><i class="bi bi-arrow-left-right me-2" style="color:var(--primary)"></i>Counter Offer</h5><button type="button" class="btn-close" data-bs-dismiss="modal" style="filter:invert(1) opacity(.5)"></button></div>
      <div class="modal-body">
        <p style="color:var(--text-muted);font-size:.9rem">Sending counter to <strong id="cBuyer" style="color:var(--text-main)"></strong> for <strong id="cProperty" style="color:var(--text-main)"></strong></p>
        <p style="color:var(--text-muted);font-size:.85rem">Original offer: <strong id="cAmount" style="color:var(--primary)"></strong></p>
        <div class="mb-3"><label class="form-label">Your Counter Offer ($)</label><input type="number" id="counterAmt" class="form-control" placeholder="Enter your counter amount"></div>
        <div class="mb-3"><label class="form-label">Message (optional)</label><textarea class="form-control" rows="3" placeholder="Add a note for the buyer…"></textarea></div>
        <div class="d-flex gap-2 mt-3">
          <button type="button" class="btn btn-warning rounded-pill px-4 flex-fill text-dark fw-semibold">Send Counter Offer</button>
          <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
</div>
@push('scripts')
<script>
document.getElementById('counterModal').addEventListener('show.bs.modal', function(e) {
  const b = e.relatedTarget;
  document.getElementById('cBuyer').textContent = b.dataset.buyer;
  document.getElementById('cProperty').textContent = b.dataset.property;
  document.getElementById('cAmount').textContent = '$' + Number(b.dataset.amount).toLocaleString();
});
</script>
@endpush
@endsection
