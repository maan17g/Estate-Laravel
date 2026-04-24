@extends('layouts.dashboard')
@section('page-title', 'My Viewings')
@section('dash-content')

<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h4 class="fw-bold mb-1" style="color:var(--text-main)">My Viewings</h4>
    <p class="mb-0" style="color:var(--text-muted); font-size:.875rem">Track your scheduled property viewings</p>
  </div>
  <button class="btn btn-primary rounded-pill px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#bookModal">
    <i class="bi bi-calendar-plus me-2"></i> Book Viewing
  </button>
</div>

<div class="card bg-card border-color shadow-sm" style="border-radius:14px">
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table dash-table mb-0">
        <thead>
          <tr><th class="ps-4">#</th><th>Property</th><th>Agent</th><th>Date</th><th>Time</th><th>Status</th></tr>
        </thead>
        <tbody>
          @forelse($data ?? [] as $appt)
          <tr>
            <td class="ps-4 text-muted" style="font-size:.8rem">#{{ $appt->id }}</td>
            <td>
              <div style="color:var(--text-main);font-weight:500">{{ $appt->property->title ?? '—' }}</div>
              <div style="color:var(--text-muted);font-size:.78rem"><i class="bi bi-geo-alt"></i> {{ $appt->property->location ?? '' }}</div>
            </td>
            <td style="color:var(--text-muted);font-size:.85rem">{{ $appt->agent->user->name ?? '—' }}</td>
            <td style="color:var(--text-main);font-size:.85rem">{{ $appt->appointment_date ? \Carbon\Carbon::parse($appt->appointment_date)->format('M d, Y') : '—' }}</td>
            <td style="color:var(--text-muted);font-size:.85rem">{{ $appt->appointment_time ?? '—' }}</td>
            <td>
              @php $st = $appt->status ?? 'pending'; @endphp
              <span class="badge rounded-pill px-3 py-2 @if($st==='confirmed') badge-status-active @elseif($st==='pending') badge-status-pending @else badge-status-rejected @endif" style="font-size:.72rem">{{ ucfirst($st) }}</span>
            </td>
          </tr>
          @empty
          <tr><td colspan="6" class="text-center py-5" style="color:var(--text-muted)"><i class="bi bi-calendar-x display-5 d-block mb-2" style="opacity:.3"></i>No viewings booked yet.<br><a href="{{ route('properties.index') }}" class="btn btn-primary rounded-pill mt-3 px-4">Browse Properties</a></td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>

<div class="modal fade" id="bookModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bg-card border-color">
      <div class="modal-header border-0"><h5 class="modal-title fw-bold" style="color:var(--text-main)"><i class="bi bi-calendar-plus me-2" style="color:var(--primary)"></i>Book a Viewing</h5><button type="button" class="btn-close" data-bs-dismiss="modal" style="filter:invert(1) opacity(.5)"></button></div>
      <div class="modal-body">
        <form action="{{ route('customer.appointments.store') }}" method="POST">
          @csrf
          <div class="mb-3"><label class="form-label">Property ID</label><input type="number" name="property_id" class="form-control" placeholder="Enter property ID" required></div>
          <div class="mb-3"><label class="form-label">Preferred Date</label><input type="date" name="appointment_date" class="form-control" required min="{{ date('Y-m-d') }}"></div>
          <div class="mb-3"><label class="form-label">Preferred Time</label><select name="appointment_time" class="form-select">
            <option>09:00 AM</option><option>10:00 AM</option><option>11:00 AM</option><option>12:00 PM</option><option>02:00 PM</option><option>03:00 PM</option><option>04:00 PM</option>
          </select></div>
          <div class="mb-3"><label class="form-label">Note (optional)</label><textarea name="note" class="form-control" rows="2" placeholder="Any specific requests…"></textarea></div>
          <div class="d-flex gap-2 mt-3"><button type="submit" class="btn btn-primary rounded-pill flex-fill px-4">Request Viewing</button><button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Cancel</button></div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
