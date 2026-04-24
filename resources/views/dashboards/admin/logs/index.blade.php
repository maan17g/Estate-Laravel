@extends('layouts.dashboard')
@section('page-title', 'Activity Logs')
@section('dash-content')

<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h4 class="fw-bold mb-1" style="color:var(--text-main)">Activity Logs</h4>
    <p class="mb-0" style="color:var(--text-muted); font-size:.875rem">System-wide activity trail</p>
  </div>
</div>

<div class="card bg-card border-color shadow-sm" style="border-radius:14px">
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table dash-table mb-0">
        <thead>
          <tr><th class="ps-4">#</th><th>User</th><th>Action</th><th>IP Address</th><th>Time</th></tr>
        </thead>
        <tbody>
          @forelse($data ?? [] as $log)
          <tr>
            <td class="ps-4 text-muted" style="font-size:.8rem">#{{ $log->id }}</td>
            <td style="color:var(--text-main)">{{ $log->user->name ?? 'System' }}</td>
            <td style="color:var(--text-muted);font-size:.85rem">{{ $log->action ?? $log->description ?? '—' }}</td>
            <td style="color:var(--text-muted);font-size:.82rem;font-family:monospace">{{ $log->ip_address ?? '—' }}</td>
            <td style="color:var(--text-muted);font-size:.82rem">{{ $log->created_at?->diffForHumans() }}</td>
          </tr>
          @empty
          @foreach([
            ['Agent verified by Admin','192.168.1.1','2 mins ago'],
            ['Property #804 approved','192.168.1.2','15 mins ago'],
            ['New user registered','203.0.113.5','1 hr ago'],
            ['Settings updated','192.168.1.1','3 hrs ago'],
            ['Bulk property upload','198.51.100.8','Yesterday'],
          ] as $i => $l)
          <tr>
            <td class="ps-4 text-muted" style="font-size:.8rem">#{{ $i+1 }}</td>
            <td><div class="d-flex align-items-center gap-2"><div style="width:28px;height:28px;border-radius:50%;background:var(--primary);color:#fff;display:flex;align-items:center;justify-content:center;font-size:.7rem;font-weight:700">A</div><span style="color:var(--text-main);font-size:.85rem">Admin</span></div></td>
            <td style="color:var(--text-muted);font-size:.85rem">{{ $l[0] }}</td>
            <td style="color:var(--text-muted);font-size:.82rem;font-family:monospace">{{ $l[1] }}</td>
            <td style="color:var(--text-muted);font-size:.82rem">{{ $l[2] }}</td>
          </tr>
          @endforeach
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
