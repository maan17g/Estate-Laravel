@extends('layouts.dashboard')
@section('page-title', 'Inquiries')
@section('dash-content')

<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h4 class="fw-bold mb-1" style="color:var(--text-main)">Inquiries</h4>
    <p class="mb-0" style="color:var(--text-muted); font-size:.875rem">All platform inquiries from customers</p>
  </div>
</div>

<div class="card bg-card border-color shadow-sm" style="border-radius:14px">
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table dash-table mb-0">
        <thead>
          <tr><th class="ps-4">#</th><th>From</th><th>Property</th><th>Subject</th><th>Status</th><th>Date</th><th class="text-end pe-4">Actions</th></tr>
        </thead>
        <tbody>
          @forelse($data ?? [] as $inquiry)
          <tr>
            <td class="ps-4 text-muted" style="font-size:.8rem">#{{ $inquiry->id }}</td>
            <td style="color:var(--text-main)">{{ $inquiry->inquirer->name ?? '—' }}</td>
            <td style="color:var(--text-muted);font-size:.85rem;max-width:160px" class="text-truncate">{{ $inquiry->property->title ?? '—' }}</td>
            <td style="color:var(--text-muted);font-size:.85rem;max-width:200px" class="text-truncate">{{ $inquiry->subject ?? $inquiry->message ?? '—' }}</td>
            <td><span class="badge rounded-pill px-3 py-2 {{ ($inquiry->status??'open')==='open' ? 'badge-status-pending' : 'badge-status-active' }}" style="font-size:.72rem">{{ ucfirst($inquiry->status ?? 'open') }}</span></td>
            <td style="color:var(--text-muted);font-size:.82rem">{{ $inquiry->created_at?->format('M d, Y') }}</td>
            <td class="text-end pe-4">
              <button class="btn btn-sm btn-outline-primary rounded-pill px-3"
                data-bs-toggle="modal" data-bs-target="#viewInquiryModal"
                data-from="{{ $inquiry->inquirer->name ?? '—' }}"
                data-property="{{ $inquiry->property->title ?? '—' }}"
                data-msg="{{ $inquiry->message ?? '—' }}">
                <i class="bi bi-eye"></i> View
              </button>
            </td>
          </tr>
          @empty
          <tr><td colspan="7" class="text-center py-5" style="color:var(--text-muted)"><i class="bi bi-chat-left-dots display-5 d-block mb-2" style="opacity:.3"></i>No inquiries yet.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>

<div class="modal fade" id="viewInquiryModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bg-card border-color">
      <div class="modal-header border-0"><h5 class="modal-title fw-bold" style="color:var(--text-main)">Inquiry Detail</h5><button type="button" class="btn-close" data-bs-dismiss="modal" style="filter:invert(1) opacity(.5)"></button></div>
      <div class="modal-body">
        <p style="color:var(--text-muted);font-size:.85rem" class="mb-1"><strong style="color:var(--text-main)">From:</strong> <span id="iFrom"></span></p>
        <p style="color:var(--text-muted);font-size:.85rem" class="mb-1"><strong style="color:var(--text-main)">Property:</strong> <span id="iProperty"></span></p>
        <p style="color:var(--text-muted);font-size:.85rem" class="mb-0"><strong style="color:var(--text-main)">Message:</strong></p>
        <div id="iMsg" style="color:var(--text-main);background:var(--bg-body);border:1px solid var(--border-color);border-radius:10px;padding:12px;margin-top:8px;font-size:.9rem"></div>
      </div>
      <div class="modal-footer border-0"><button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Close</button></div>
    </div>
  </div>
</div>
@push('scripts')
<script>
document.getElementById('viewInquiryModal').addEventListener('show.bs.modal', function(e) {
  const b = e.relatedTarget;
  document.getElementById('iFrom').textContent = b.dataset.from;
  document.getElementById('iProperty').textContent = b.dataset.property;
  document.getElementById('iMsg').textContent = b.dataset.msg;
});
</script>
@endpush
@endsection
