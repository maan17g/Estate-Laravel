@extends('layouts.dashboard')
@section('page-title', 'Manage Properties')
@section('dash-content')

<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h4 class="fw-bold mb-1" style="color:var(--text-main)">Properties</h4>
    <p class="mb-0" style="color:var(--text-muted); font-size:.875rem">Review, approve or reject property listings</p>
  </div>
  <a href="{{ route('admin.properties.index', ['status'=>'pending']) }}" class="btn btn-warning rounded-pill px-4 shadow-sm text-dark fw-semibold">
    <i class="bi bi-hourglass-split me-2"></i> Pending Approvals
  </a>
</div>

<!-- Filters -->
<div class="card bg-card border-color shadow-sm mb-4" style="border-radius:14px">
  <div class="card-body p-3">
    <form method="GET" class="row g-2 align-items-center">
      <div class="col-md-4"><input type="text" name="search" class="form-control form-control-sm" placeholder="Search by title or location…" value="{{ request('search') }}"></div>
      <div class="col-md-3">
        <select name="status" class="form-select form-select-sm">
          <option value="">All Status</option>
          <option value="active"   {{ request('status')=='active'  ?'selected':'' }}>Active</option>
          <option value="pending"  {{ request('status')=='pending' ?'selected':'' }}>Pending</option>
          <option value="rejected" {{ request('status')=='rejected'?'selected':'' }}>Rejected</option>
        </select>
      </div>
      <div class="col-md-2 d-flex gap-2">
        <button type="submit" class="btn btn-primary btn-sm flex-fill rounded-pill">Filter</button>
        <a href="{{ route('admin.properties.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill">Reset</a>
      </div>
    </form>
  </div>
</div>

<div class="card bg-card border-color shadow-sm" style="border-radius:14px">
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table dash-table mb-0">
        <thead>
          <tr>
            <th class="ps-4">#</th><th>Property</th><th>Agent</th><th>Price</th><th>Type</th><th>Status</th><th>Submitted</th><th class="text-end pe-4">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($data as $property)
          <tr>
            <td class="ps-4 text-muted" style="font-size:.8rem">#{{ $property->id }}</td>
            <td>
              <div style="color:var(--text-main); font-weight:500; max-width:200px" class="text-truncate">{{ $property->title ?? 'Untitled' }}</div>
              <div style="color:var(--text-muted); font-size:.78rem"><i class="bi bi-geo-alt"></i> {{ $property->location ?? '—' }}</div>
            </td>
            <td style="color:var(--text-muted); font-size:.85rem">{{ $property->agent->user->name ?? '—' }}</td>
            <td style="color:var(--primary); font-weight:600">${{ number_format($property->price ?? 0) }}</td>
            <td><span class="badge rounded-pill badge-status-inactive px-3 py-2" style="font-size:.72rem">{{ $property->type ?? '—' }}</span></td>
            <td>
              @php $st = $property->status ?? 'pending'; @endphp
              <span class="badge rounded-pill px-3 py-2
                @if($st==='active') badge-status-active
                @elseif($st==='pending') badge-status-pending
                @else badge-status-rejected @endif" style="font-size:.72rem">{{ ucfirst($st) }}</span>
            </td>
            <td style="color:var(--text-muted);font-size:.82rem">{{ $property->created_at?->format('M d, Y') }}</td>
            <td class="text-end pe-4">
              <div class="d-flex justify-content-end gap-1 flex-wrap">
                @if($st === 'pending')
                <form action="{{ route('admin.properties.approve', $property->id) }}" method="POST">
                  @csrf
                  <button type="submit" class="btn btn-sm btn-success rounded-pill px-3" title="Approve"><i class="bi bi-check-lg"></i> Approve</button>
                </form>
                @endif
                <button class="btn btn-sm btn-outline-primary rounded-pill px-3"
                  data-bs-toggle="modal" data-bs-target="#viewPropertyModal"
                  data-title="{{ $property->title }}" data-agent="{{ $property->agent->user->name ?? '—' }}"
                  data-price="{{ $property->price }}" data-status="{{ $st }}" data-desc="{{ $property->description ?? '—' }}">
                  <i class="bi bi-eye"></i>
                </button>
                <form action="{{ route('admin.properties.index') }}" method="POST" onsubmit="return confirm('Delete this property?')">
                  @csrf @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3"><i class="bi bi-trash"></i></button>
                </form>
              </div>
            </td>
          </tr>
          @empty
          <tr><td colspan="8" class="text-center py-5" style="color:var(--text-muted)"><i class="bi bi-houses display-5 d-block mb-2" style="opacity:.3"></i>No properties found.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
    @if($data->hasPages())
    <div class="p-3 border-top" style="border-color:var(--border-color)!important">{{ $data->links() }}</div>
    @endif
  </div>
</div>

<!-- View Property Modal -->
<div class="modal fade" id="viewPropertyModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bg-card border-color">
      <div class="modal-header border-0"><h5 class="modal-title fw-bold" style="color:var(--text-main)"><i class="bi bi-house me-2" style="color:var(--primary)"></i>Property Details</h5><button type="button" class="btn-close" data-bs-dismiss="modal" style="filter:invert(1) opacity(.5)"></button></div>
      <div class="modal-body">
        <table class="table table-sm" style="color:var(--text-main)">
          <tr><td class="fw-semibold" style="color:var(--text-muted);width:35%">Title</td><td id="vTitle">—</td></tr>
          <tr><td class="fw-semibold" style="color:var(--text-muted)">Agent</td><td id="vAgent">—</td></tr>
          <tr><td class="fw-semibold" style="color:var(--text-muted)">Price</td><td id="vPrice" style="color:var(--primary);font-weight:600">—</td></tr>
          <tr><td class="fw-semibold" style="color:var(--text-muted)">Status</td><td id="vStatus">—</td></tr>
          <tr><td class="fw-semibold" style="color:var(--text-muted)">Description</td><td id="vDesc" style="font-size:.85rem">—</td></tr>
        </table>
      </div>
      <div class="modal-footer border-0"><button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Close</button></div>
    </div>
  </div>
</div>

@push('scripts')
<script>
document.getElementById('viewPropertyModal').addEventListener('show.bs.modal', function(e) {
  const b = e.relatedTarget;
  document.getElementById('vTitle').textContent = b.dataset.title;
  document.getElementById('vAgent').textContent = b.dataset.agent;
  document.getElementById('vPrice').textContent = '$' + Number(b.dataset.price).toLocaleString();
  document.getElementById('vStatus').textContent = b.dataset.status;
  document.getElementById('vDesc').textContent = b.dataset.desc;
});
</script>
@endpush
@endsection
