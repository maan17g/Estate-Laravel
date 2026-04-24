@extends('layouts.dashboard')
@section('page-title', 'My Inquiries')
@section('dash-content')

<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h4 class="fw-bold mb-1" style="color:var(--text-main)">My Inquiries</h4>
    <p class="mb-0" style="color:var(--text-muted); font-size:.875rem">Questions you've sent to agents</p>
  </div>
</div>

<div class="card bg-card border-color shadow-sm" style="border-radius:14px">
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table dash-table mb-0">
        <thead>
          <tr><th class="ps-4">#</th><th>Property</th><th>Your Message</th><th>Agent Reply</th><th>Status</th><th>Date</th></tr>
        </thead>
        <tbody>
          @forelse($data ?? [] as $inq)
          <tr>
            <td class="ps-4 text-muted" style="font-size:.8rem">#{{ $inq->id }}</td>
            <td style="color:var(--text-main);font-weight:500;max-width:150px" class="text-truncate">{{ $inq->property->title ?? '—' }}</td>
            <td style="color:var(--text-muted);font-size:.85rem;max-width:200px" class="text-truncate">{{ $inq->message ?? '—' }}</td>
            <td style="color:var(--text-muted);font-size:.85rem;max-width:200px" class="text-truncate">{{ $inq->reply ?? '—' }}</td>
            <td><span class="badge rounded-pill px-3 py-2 {{ ($inq->status??'open')==='replied' ? 'badge-status-active' : 'badge-status-pending' }}" style="font-size:.72rem">{{ ($inq->status??'open')==='replied' ? 'Replied' : 'Pending' }}</span></td>
            <td style="color:var(--text-muted);font-size:.82rem">{{ $inq->created_at?->format('M d, Y') }}</td>
          </tr>
          @empty
          <tr><td colspan="6" class="text-center py-5" style="color:var(--text-muted)"><i class="bi bi-chat-left display-5 d-block mb-2" style="opacity:.3"></i>You haven't sent any inquiries yet.<br><a href="{{ route('properties.index') }}" class="btn btn-primary rounded-pill mt-3 px-4">Browse Properties</a></td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
