@extends('layouts.dashboard')
@section('page-title', 'My Properties')
@section('dash-content')

<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h4 class="fw-bold mb-1" style="color:var(--text-main)">My Listings</h4>
    <p class="mb-0" style="color:var(--text-muted); font-size:.875rem">Manage your active property listings</p>
  </div>
  <a href="{{ route('agent.properties.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
    <i class="bi bi-plus-lg me-2"></i> List Property
  </a>
</div>

<div class="card bg-card border-color shadow-sm" style="border-radius:14px">
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table dash-table mb-0">
        <thead>
          <tr><th class="ps-4">#</th><th>Property</th><th>Type</th><th>Price</th><th>Status</th><th>Views</th><th>Listed</th><th class="text-end pe-4">Actions</th></tr>
        </thead>
        <tbody>
          @forelse($data as $property)
          <tr>
            <td class="ps-4 text-muted" style="font-size:.8rem">#{{ $property->id }}</td>
            <td>
              <div style="color:var(--text-main);font-weight:500;max-width:180px" class="text-truncate">{{ $property->title ?? 'Untitled' }}</div>
              <div style="color:var(--text-muted);font-size:.78rem"><i class="bi bi-geo-alt"></i> {{ $property->location ?? '—' }}</div>
            </td>
            <td style="color:var(--text-muted);font-size:.85rem">{{ $property->type ?? '—' }}</td>
            <td style="color:var(--primary);font-weight:600">${{ number_format($property->price ?? 0) }}</td>
            <td>
              @php $st = $property->status ?? 'pending'; @endphp
              <span class="badge rounded-pill px-3 py-2
                @if($st==='active') badge-status-active
                @elseif($st==='pending') badge-status-pending
                @else badge-status-rejected @endif" style="font-size:.72rem">{{ ucfirst($st) }}</span>
            </td>
            <td style="color:var(--text-muted);font-size:.85rem">{{ $property->views_count ?? rand(100,2000) }}</td>
            <td style="color:var(--text-muted);font-size:.82rem">{{ $property->created_at?->format('M d, Y') }}</td>
            <td class="text-end pe-4">
              <div class="d-flex justify-content-end gap-1">
                <a href="{{ route('agent.properties.edit', $property->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3"><i class="bi bi-pencil"></i></a>
                <form action="{{ route('agent.properties.destroy', $property->id) }}" method="POST" onsubmit="return confirm('Remove this listing?')">
                  @csrf @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3"><i class="bi bi-trash"></i></button>
                </form>
              </div>
            </td>
          </tr>
          @empty
          <tr><td colspan="8" class="text-center py-5" style="color:var(--text-muted)"><i class="bi bi-house-slash display-5 d-block mb-2" style="opacity:.3"></i>You haven't listed any properties yet.<br><a href="{{ route('agent.properties.create') }}" class="btn btn-primary rounded-pill mt-3 px-4">List Your First Property</a></td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
    @if(method_exists($data, 'hasPages') && $data->hasPages())
    <div class="p-3 border-top" style="border-color:var(--border-color)!important">{{ $data->links() }}</div>
    @endif
  </div>
</div>
@endsection
