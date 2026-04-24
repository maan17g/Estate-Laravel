@extends('layouts.dashboard')
@section('page-title', 'Tenants')
@section('dash-content')

<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h4 class="fw-bold mb-1" style="color:var(--text-main)">Tenants</h4>
    <p class="mb-0" style="color:var(--text-muted); font-size:.875rem">Manage active rental tenants</p>
  </div>
</div>

<div class="card bg-card border-color shadow-sm" style="border-radius:14px">
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table dash-table mb-0">
        <thead>
          <tr><th class="ps-4">#</th><th>Tenant</th><th>Property</th><th>Lease Start</th><th>Lease End</th><th>Monthly Rent</th><th>Payment Status</th><th class="text-end pe-4">Actions</th></tr>
        </thead>
        <tbody>
          @forelse($data ?? [] as $tenant)
          <tr>
            <td class="ps-4 text-muted" style="font-size:.8rem">#{{ $tenant->id }}</td>
            <td>
              <div style="color:var(--text-main);font-weight:500">{{ $tenant->user->name ?? '—' }}</div>
              <div style="color:var(--text-muted);font-size:.78rem">{{ $tenant->user->email ?? '' }}</div>
            </td>
            <td style="color:var(--text-muted);font-size:.85rem">{{ $tenant->property->title ?? '—' }}</td>
            <td style="color:var(--text-muted);font-size:.85rem">{{ $tenant->lease_start ? \Carbon\Carbon::parse($tenant->lease_start)->format('M d, Y') : '—' }}</td>
            <td style="color:var(--text-muted);font-size:.85rem">{{ $tenant->lease_end ? \Carbon\Carbon::parse($tenant->lease_end)->format('M d, Y') : '—' }}</td>
            <td style="color:var(--primary);font-weight:600">${{ number_format($tenant->monthly_rent ?? 0) }}</td>
            <td><span class="badge rounded-pill px-3 py-2 {{ ($tenant->payment_status??'due')==='paid' ? 'badge-status-active' : 'badge-status-pending' }}" style="font-size:.72rem">{{ ucfirst($tenant->payment_status ?? 'Due') }}</span></td>
            <td class="text-end pe-4">
              <button class="btn btn-sm btn-outline-primary rounded-pill px-3"><i class="bi bi-eye"></i></button>
            </td>
          </tr>
          @empty
          <tr><td colspan="8" class="text-center py-5" style="color:var(--text-muted)"><i class="bi bi-person-lines-fill display-5 d-block mb-2" style="opacity:.3"></i>No active tenants yet.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
