@extends('layouts.dashboard')
@section('page-title', 'Reports')
@section('dash-content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="mb-4">
  <h4 class="fw-bold mb-1" style="color:var(--text-main)">Reports & Analytics</h4>
  <p class="mb-0" style="color:var(--text-muted); font-size:.875rem">Platform performance overview</p>
</div>

<div class="dash-stat-grid mb-4">
  <div class="dash-stat-card"><div class="dash-stat-icon green"><i class="bi bi-wallet2"></i></div><div><div class="dash-stat-num">$2.4M</div><div class="dash-stat-label">Total Revenue</div></div></div>
  <div class="dash-stat-card"><div class="dash-stat-icon blue"><i class="bi bi-houses"></i></div><div><div class="dash-stat-num">1,248</div><div class="dash-stat-label">Total Properties</div></div></div>
  <div class="dash-stat-card"><div class="dash-stat-icon gold"><i class="bi bi-people"></i></div><div><div class="dash-stat-num">4,872</div><div class="dash-stat-label">Total Users</div></div></div>
  <div class="dash-stat-card"><div class="dash-stat-icon red"><i class="bi bi-graph-up-arrow"></i></div><div><div class="dash-stat-num">+18%</div><div class="dash-stat-label">Growth This Month</div></div></div>
</div>

<div class="row g-4">
  <div class="col-lg-8">
    <div class="card bg-card border-color shadow-sm" style="border-radius:18px">
      <div class="card-body p-4">
        <h5 style="color:var(--text-main);font-weight:700" class="mb-4">Monthly Revenue</h5>
        <canvas id="revenueChart" height="100"></canvas>
      </div>
    </div>
  </div>
  <div class="col-lg-4">
    <div class="card bg-card border-color shadow-sm" style="border-radius:18px">
      <div class="card-body p-4">
        <h5 style="color:var(--text-main);font-weight:700" class="mb-4">Property Types</h5>
        <canvas id="typeChart" height="200"></canvas>
      </div>
    </div>
  </div>
</div>

<div class="row g-4 mt-1">
  <div class="col-lg-6">
    <div class="card bg-card border-color shadow-sm" style="border-radius:18px">
      <div class="card-body p-4">
        <h5 style="color:var(--text-main);font-weight:700" class="mb-4">New Registrations</h5>
        <canvas id="userChart" height="130"></canvas>
      </div>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="card bg-card border-color shadow-sm" style="border-radius:18px">
      <div class="card-body p-4">
        <h5 style="color:var(--text-main);font-weight:700" class="mb-4">Top Performing Agents</h5>
        <table class="table dash-table mb-0">
          <thead><tr><th>Agent</th><th>Listings</th><th>Sales</th></tr></thead>
          <tbody>
            @foreach([['Sarah Johnson',24,18],['Michael Chen',19,15],['Emma Wilson',17,12],['David Park',14,11]] as $a)
            <tr>
              <td><div class="d-flex align-items-center gap-2"><div style="width:30px;height:30px;border-radius:50%;background:var(--primary);color:#fff;display:flex;align-items:center;justify-content:center;font-size:.75rem;font-weight:700">{{ substr($a[0],0,1) }}</div><span style="color:var(--text-main);font-size:.85rem">{{ $a[0] }}</span></div></td>
              <td style="color:var(--text-muted);font-size:.85rem">{{ $a[1] }}</td>
              <td><span class="badge badge-status-active rounded-pill px-3">{{ $a[2] }}</span></td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script>
const chartDefaults = { responsive:true, plugins:{legend:{labels:{color:'#888',font:{family:'Poppins'}}}} };
new Chart(document.getElementById('revenueChart'), {
  type:'line',
  data:{labels:['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
    datasets:[{label:'Revenue ($)',data:[42000,55000,48000,72000,65000,88000,95000,82000,110000,125000,118000,142000],borderColor:'#3cb57c',backgroundColor:'rgba(60,181,124,.1)',borderWidth:3,tension:.4,fill:true,pointBackgroundColor:'#3cb57c'}]},
  options:{...chartDefaults,scales:{y:{grid:{color:'rgba(255,255,255,.05)'},ticks:{color:'#888'}},x:{grid:{display:false},ticks:{color:'#888'}}}}
});
new Chart(document.getElementById('typeChart'), {
  type:'doughnut',
  data:{labels:['Apartment','Villa','Townhouse','Office','Penthouse'],datasets:[{data:[38,27,18,10,7],backgroundColor:['#3cb57c','#0D8ABC','#ffc107','#e74c3c','#6f42c1'],borderWidth:0}]},
  options:{...chartDefaults,cutout:'65%'}
});
new Chart(document.getElementById('userChart'), {
  type:'bar',
  data:{labels:['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
    datasets:[{label:'New Users',data:[120,180,155,240,210,310,280,320,360,420,390,480],backgroundColor:'rgba(13,138,188,.7)',borderRadius:6}]},
  options:{...chartDefaults,scales:{y:{grid:{color:'rgba(255,255,255,.05)'},ticks:{color:'#888'}},x:{grid:{display:false},ticks:{color:'#888'}}}}
});
</script>
@endpush
@endsection
