@extends('layouts.dashboard')
@section('page-title', 'Client Inquiries')
@section('dash-content')

<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h4 class="fw-bold mb-1" style="color:var(--text-main)">Client Inquiries</h4>
    <p class="mb-0" style="color:var(--text-muted); font-size:.875rem">Questions from potential buyers and renters</p>
  </div>
</div>

<div class="card bg-card border-color shadow-sm" style="border-radius:14px">
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table dash-table mb-0">
        <thead>
          <tr><th class="ps-4">#</th><th>Client</th><th>Property</th><th>Message</th><th>Status</th><th>Date</th><th class="text-end pe-4">Reply</th></tr>
        </thead>
        <tbody>
          @forelse($data ?? [] as $inq)
          <tr>
            <td class="ps-4 text-muted" style="font-size:.8rem">#{{ $inq->id }}</td>
            <td>
              <div style="color:var(--text-main);font-weight:500">{{ $inq->inquirer->name ?? '—' }}</div>
              <div style="color:var(--text-muted);font-size:.78rem">{{ $inq->inquirer->email ?? '' }}</div>
            </td>
            <td style="color:var(--text-muted);font-size:.85rem;max-width:140px" class="text-truncate">{{ $inq->property->title ?? '—' }}</td>
            <td style="color:var(--text-muted);font-size:.85rem;max-width:200px" class="text-truncate">{{ $inq->message ?? '—' }}</td>
            <td><span class="badge rounded-pill px-3 py-2 {{ ($inq->status??'open')==='replied' ? 'badge-status-active' : 'badge-status-pending' }}" style="font-size:.72rem">{{ ($inq->status??'open')==='replied' ? 'Replied' : 'Open' }}</span></td>
            <td style="color:var(--text-muted);font-size:.82rem">{{ $inq->created_at?->format('M d, Y') }}</td>
            <td class="text-end pe-4">
              <button class="btn btn-sm btn-primary rounded-pill px-3"
                data-bs-toggle="modal" data-bs-target="#replyModal"
                data-id="{{ $inq->id }}" data-client="{{ $inq->inquirer->name ?? '—' }}"
                data-msg="{{ $inq->message ?? '—' }}" data-property="{{ $inq->property->title ?? '—' }}">
                <i class="bi bi-reply me-1"></i>Reply
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

<!-- Reply Modal -->
<div class="modal fade" id="replyModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bg-card border-color">
      <div class="modal-header border-0"><h5 class="modal-title fw-bold" style="color:var(--text-main)"><i class="bi bi-reply me-2" style="color:var(--primary)"></i>Reply to Inquiry</h5><button type="button" class="btn-close" data-bs-dismiss="modal" style="filter:invert(1) opacity(.5)"></button></div>
      <div class="modal-body">
        <div class="mb-3 p-3 rounded-3" style="background:var(--bg-body);border:1px solid var(--border-color)">
          <div style="color:var(--text-muted);font-size:.8rem" class="mb-1">From: <strong id="rClient" style="color:var(--text-main)"></strong> &mdash; Re: <span id="rProperty" style="color:var(--primary)"></span></div>
          <p id="rMsg" style="color:var(--text-main);font-size:.9rem;margin:0"></p>
        </div>
        <form id="replyForm" action="" method="POST">
          @csrf
          <div class="mb-3"><label class="form-label">Your Reply</label><textarea name="reply" class="form-control" rows="4" placeholder="Type your response…" required></textarea></div>
          <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary rounded-pill px-4 flex-fill">Send Reply</button>
            <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@push('scripts')
<script>
document.getElementById('replyModal').addEventListener('show.bs.modal', function(e) {
  const b = e.relatedTarget;
  document.getElementById('rClient').textContent = b.dataset.client;
  document.getElementById('rProperty').textContent = b.dataset.property;
  document.getElementById('rMsg').textContent = b.dataset.msg;
  document.getElementById('replyForm').action = '/agent/inquiries/' + b.dataset.id + '/reply';
});
</script>
@endpush
@endsection
