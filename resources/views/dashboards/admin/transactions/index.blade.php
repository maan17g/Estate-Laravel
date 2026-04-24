@extends('layouts.dashboard')
@section('page-title', 'Transactions')
@section('dash-content')

<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h4 class="fw-bold mb-1" style="color:var(--text-main)">Transactions</h4>
    <p class="mb-0" style="color:var(--text-muted); font-size:.875rem">All platform financial transactions</p>
  </div>
</div>

<div class="dash-stat-grid mb-4">
  <div class="dash-stat-card"><div class="dash-stat-icon green"><i class="bi bi-wallet2"></i></div><div><div class="dash-stat-num">$2.4M</div><div class="dash-stat-label">Total Revenue</div></div></div>
  <div class="dash-stat-card"><div class="dash-stat-icon blue"><i class="bi bi-arrow-down-circle"></i></div><div><div class="dash-stat-num">$87K</div><div class="dash-stat-label">This Month</div></div></div>
  <div class="dash-stat-card"><div class="dash-stat-icon gold"><i class="bi bi-hourglass-split"></i></div><div><div class="dash-stat-num">12</div><div class="dash-stat-label">Pending</div></div></div>
  <div class="dash-stat-card"><div class="dash-stat-icon red"><i class="bi bi-x-circle"></i></div><div><div class="dash-stat-num">3</div><div class="dash-stat-label">Failed</div></div></div>
</div>

<div class="card bg-card border-color shadow-sm" style="border-radius:14px">
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table dash-table mb-0">
        <thead>
          <tr><th class="ps-4">#</th><th>User</th><th>Property</th><th>Amount</th><th>Type</th><th>Status</th><th>Date</th></tr>
        </thead>
        <tbody>
          @forelse($data ?? [] as $tx)
          <tr>
            <td class="ps-4 text-muted" style="font-size:.8rem">#{{ $tx->id }}</td>
            <td style="color:var(--text-main)">{{ $tx->user->name ?? '—' }}</td>
            <td style="color:var(--text-muted);font-size:.85rem">{{ $tx->property->title ?? '—' }}</td>
            <td style="color:var(--primary);font-weight:600">${{ number_format($tx->amount ?? 0) }}</td>
            <td><span class="badge badge-status-inactive rounded-pill px-3" style="font-size:.72rem">{{ ucfirst($tx->type ?? '—') }}</span></td>
            <td><span class="badge rounded-pill px-3 py-2 {{ ($tx->status??'pending')==='completed' ? 'badge-status-active' : 'badge-status-pending' }}" style="font-size:.72rem">{{ ucfirst($tx->status ?? 'pending') }}</span></td>
            <td style="color:var(--text-muted);font-size:.82rem">{{ $tx->created_at?->format('M d, Y') }}</td>
          </tr>
          @empty
          <tr><td colspan="7" class="text-center py-5" style="color:var(--text-muted)"><i class="bi bi-credit-card display-5 d-block mb-2" style="opacity:.3"></i>No transactions yet.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
