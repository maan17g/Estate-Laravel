@extends('layouts.dashboard')
@section('page-title', 'Manage Agents')
@section('dash-content')

<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h4 class="fw-bold mb-1" style="color:var(--text-main)">Agents</h4>
    <p class="mb-0" style="color:var(--text-muted); font-size:.875rem">Verify agents and manage their access</p>
  </div>
</div>

<div class="card bg-card border-color shadow-sm mb-4" style="border-radius:14px">
  <div class="card-body p-3">
    <form method="GET" class="row g-2 align-items-center">
      <div class="col-md-5"><input type="text" name="search" class="form-control form-control-sm" placeholder="Search by name…" value="{{ request('search') }}"></div>
      <div class="col-md-3">
        <select name="verified" class="form-select form-select-sm">
          <option value="">All</option>
          <option value="1" {{ request('verified')=='1'?'selected':'' }}>Verified</option>
          <option value="0" {{ request('verified')=='0'?'selected':'' }}>Unverified</option>
        </select>
      </div>
      <div class="col-md-2 d-flex gap-2">
        <button type="submit" class="btn btn-primary btn-sm flex-fill rounded-pill">Filter</button>
        <a href="{{ route('admin.agents.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill">Reset</a>
      </div>
    </form>
  </div>
</div>

<div class="card bg-card border-color shadow-sm" style="border-radius:14px">
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table dash-table mb-0">
        <thead>
          <tr><th class="ps-4">#</th><th>Agent Name</th><th>Email</th><th>Phone</th><th>Properties</th><th>Verified</th><th>Joined</th><th class="text-end pe-4">Actions</th></tr>
        </thead>
        <tbody>
          @forelse($data as $agent)
          <tr>
            <td class="ps-4 text-muted" style="font-size:.8rem">#{{ $agent->id }}</td>
            <td>
              <div class="d-flex align-items-center gap-2">
                <div style="width:34px;height:34px;border-radius:50%;background:var(--primary);color:#fff;display:flex;align-items:center;justify-content:center;font-size:.8rem;font-weight:700;flex-shrink:0">{{ strtoupper(substr($agent->user->name??'A',0,1)) }}</div>
                <div>
                  <div style="color:var(--text-main);font-weight:500">{{ $agent->user->name ?? '—' }}</div>
                  <div style="color:var(--text-muted);font-size:.75rem">{{ $agent->specialization ?? '' }}</div>
                </div>
              </div>
            </td>
            <td style="color:var(--text-muted);font-size:.85rem">{{ $agent->user->email ?? '—' }}</td>
            <td style="color:var(--text-muted);font-size:.85rem">{{ $agent->phone ?? '—' }}</td>
            <td><span class="badge badge-status-inactive rounded-pill px-3">{{ $agent->properties->count() ?? 0 }}</span></td>
            <td>
              <span class="badge rounded-pill px-3 py-2 {{ $agent->is_verified ? 'badge-status-active' : 'badge-status-pending' }}" style="font-size:.72rem">
                {{ $agent->is_verified ? 'Verified' : 'Pending' }}
              </span>
            </td>
            <td style="color:var(--text-muted);font-size:.82rem">{{ $agent->created_at?->format('M d, Y') }}</td>
            <td class="text-end pe-4">
              <div class="d-flex justify-content-end gap-1">
                @if(!$agent->is_verified)
                <form action="{{ route('admin.agents.verify', $agent->id) }}" method="POST">
                  @csrf
                  <button type="submit" class="btn btn-sm btn-success rounded-pill px-3"><i class="bi bi-patch-check"></i> Verify</button>
                </form>
                @else
                <span class="btn btn-sm btn-outline-secondary rounded-pill px-3 disabled"><i class="bi bi-check-all"></i> Verified</span>
                @endif
                <form action="{{ route('admin.users.destroy', $agent->user_id ?? 0) }}" method="POST" onsubmit="return confirm('Remove this agent?')">
                  @csrf @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3"><i class="bi bi-trash"></i></button>
                </form>
              </div>
            </td>
          </tr>
          @empty
          <tr><td colspan="8" class="text-center py-5" style="color:var(--text-muted)"><i class="bi bi-person-badge display-5 d-block mb-2" style="opacity:.3"></i>No agents found.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
    @if($data->hasPages())
    <div class="p-3 border-top" style="border-color:var(--border-color)!important">{{ $data->links() }}</div>
    @endif
  </div>
</div>
@endsection
