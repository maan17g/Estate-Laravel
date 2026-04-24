@extends('layouts.dashboard')
@section('page-title', 'Appointments')
@section('dash-content')

<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h4 class="fw-bold mb-1" style="color:var(--text-main)">Appointments</h4>
    <p class="mb-0" style="color:var(--text-muted); font-size:.875rem">Manage property viewing appointments</p>
  </div>
</div>

<div class="card bg-card border-color shadow-sm" style="border-radius:14px">
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table dash-table mb-0">
        <thead>
          <tr><th class="ps-4">#</th><th>Client</th><th>Property</th><th>Date & Time</th><th>Status</th><th class="text-end pe-4">Action</th></tr>
        </thead>
        <tbody>
          @forelse($data ?? [] as $appt)
          <tr>
            <td class="ps-4 text-muted" style="font-size:.8rem">#{{ $appt->id }}</td>
            <td>
              <div style="color:var(--text-main);font-weight:500">{{ $appt->customer->name ?? '—' }}</div>
              <div style="color:var(--text-muted);font-size:.78rem">{{ $appt->customer->email ?? '' }}</div>
            </td>
            <td style="color:var(--text-muted);font-size:.85rem;max-width:160px" class="text-truncate">{{ $appt->property->title ?? '—' }}</td>
            <td style="color:var(--text-main);font-size:.85rem">
              {{ $appt->appointment_date ? \Carbon\Carbon::parse($appt->appointment_date)->format('M d, Y') : '—' }}
              <div style="color:var(--text-muted);font-size:.78rem">{{ $appt->appointment_time ?? '' }}</div>
            </td>
            <td>
              @php $st = $appt->status ?? 'pending'; @endphp
              <span class="badge rounded-pill px-3 py-2 @if($st==='confirmed') badge-status-active @elseif($st==='pending') badge-status-pending @else badge-status-rejected @endif" style="font-size:.72rem">{{ ucfirst($st) }}</span>
            </td>
            <td class="text-end pe-4">
              <form action="{{ route('agent.appointments.update', $appt->id) }}" method="POST" class="d-inline">
                @csrf @method('PUT')
                @if($st === 'pending')
                  <input type="hidden" name="status" value="confirmed">
                  <button type="submit" class="btn btn-sm btn-success rounded-pill px-3"><i class="bi bi-check-lg me-1"></i>Confirm</button>
                @elseif($st === 'confirmed')
                  <input type="hidden" name="status" value="completed">
                  <button type="submit" class="btn btn-sm btn-outline-secondary rounded-pill px-3"><i class="bi bi-check-all me-1"></i>Done</button>
                @else
                  <span class="text-muted" style="font-size:.82rem">Completed</span>
                @endif
              </form>
              @if($st === 'pending')
              <form action="{{ route('agent.appointments.update', $appt->id) }}" method="POST" class="d-inline ms-1">
                @csrf @method('PUT')
                <input type="hidden" name="status" value="cancelled">
                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3"><i class="bi bi-x-lg"></i></button>
              </form>
              @endif
            </td>
          </tr>
          @empty
          <tr><td colspan="6" class="text-center py-5" style="color:var(--text-muted)"><i class="bi bi-calendar-x display-5 d-block mb-2" style="opacity:.3"></i>No appointments scheduled yet.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
