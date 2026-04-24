@extends('layouts.dashboard')
@section('page-title', 'Admin Dashboard')
@section('dash-content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="dash-stat-grid mb-5">
    <div class="dash-stat-card shadow-sm border-0">
        <div class="dash-stat-icon green"><i class="bi bi-wallet2"></i></div>
        <div>
            <div class="dash-stat-num">$2.4M</div>
            <div class="dash-stat-label">Total Platform Revenue</div>
        </div>
    </div>
    <div class="dash-stat-card shadow-sm border-0">
        <div class="dash-stat-icon blue"><i class="bi bi-houses"></i></div>
        <div>
            <div class="dash-stat-num">1,248</div>
            <div class="dash-stat-label">Active Properties</div>
        </div>
    </div>
    <div class="dash-stat-card shadow-sm border-0">
        <div class="dash-stat-icon gold"><i class="bi bi-people"></i></div>
        <div>
            <div class="dash-stat-num">342</div>
            <div class="dash-stat-label">Registered Agents</div>
        </div>
    </div>
    <div class="dash-stat-card shadow-sm border-0">
        <div class="dash-stat-icon red"><i class="bi bi-exclamation-circle"></i></div>
        <div>
            <div class="dash-stat-num">14</div>
            <div class="dash-stat-label">Pending Approvals</div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-lg-8">
        <div class="card bg-card border-color shadow-sm h-100" style="border-radius:18px;">
            <div class="card-body p-4">
                <h5 style="color:var(--text-main); font-weight:700;" class="mb-4">Revenue Analytics</h5>
                <canvas id="revenueChart" height="100"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card bg-card border-color shadow-sm h-100" style="border-radius:18px;">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 style="color:var(--text-main); font-weight:700; margin:0;">Recent Activity</h5>
                    <a href="#" style="font-size:0.85rem; color:var(--primary);">View All</a>
                </div>
                <div class="activity-feed">
                    @foreach([
                        ['icon'=>'bi-person-check', 'color'=>'#0dcaf0', 'bg'=>'rgba(13,202,240,0.1)', 'text'=>'New Agent Verified', 'time'=>'10 mins ago'],
                        ['icon'=>'bi-house-heart', 'color'=>'#3cb57c', 'bg'=>'rgba(60,181,124,0.1)', 'text'=>'Property #804 Sold', 'time'=>'1 hr ago'],
                        ['icon'=>'bi-exclamation-triangle', 'color'=>'#ffc107', 'bg'=>'rgba(255,193,7,0.1)', 'text'=>'Server Backup Complete', 'time'=>'3 hrs ago'],
                        ['icon'=>'bi-star', 'color'=>'#e74c3c', 'bg'=>'rgba(231,76,60,0.1)', 'text'=>'5-Star Review Received', 'time'=>'Yesterday'],
                        ['icon'=>'bi-upload', 'color'=>'#0D8ABC', 'bg'=>'rgba(13,138,188,0.1)', 'text'=>'Bulk Image Upload', 'time'=>'Yesterday']
                    ] as $log)
                        <div class="d-flex align-items-center gap-3 mb-4 pb-3 border-bottom" style="border-color:var(--border-color) !important;">
                            <div style="width:40px; height:40px; border-radius:10px; background:{{$log['bg']}}; color:{{$log['color']}}; display:flex; align-items:center; justify-content:center; font-size:1.1rem; flex-shrink:0;">
                                <i class="bi {{
$log['icon']}}"></i>
                            </div>
                            <div style="flex-grow:1;">
                                <h6 style="color:var(--text-main); font-size:0.9rem; margin-bottom:2px; font-weight:600;">{{
$log['text']}}</h6>
                                <span style="color:var(--text-muted); font-size:0.75rem;">{{
$log['time']}}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card bg-card border-color shadow-sm mt-4" style="border-radius:18px;">
    <div class="card-body p-4">
        <h5 style="color:var(--text-main); font-weight:700;" class="mb-4">Properties Awaiting Approval</h5>
        <div class="table-responsive">
            <table class="table table-hover align-middle text-nowrap" style="color:var(--text-main);">
                <thead style="background:var(--form-bg); color:var(--text-muted);">
                    <tr>
                        <th class="py-3 px-4 rounded-start">Property Name</th>
                        <th class="py-3 px-4">Agent</th>
                        <th class="py-3 px-4">Price</th>
                        <th class="py-3 px-4">Uploaded</th>
                        <th class="py-3 px-4 text-end rounded-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td colspan="5" class="text-center py-4 text-muted">All properties have been verified.</td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const ctx = document.getElementById('revenueChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
            datasets: [{
                label: 'Revenue ($)',
                data: [12000, 19000, 15000, 25000, 22000, 30000, 35000, 32000, 40000, 45000],
                borderColor: '#3cb57c',
                backgroundColor: 'rgba(60,181,124,0.1)',
                borderWidth: 3,
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                y: { grid: { color: 'rgba(255,255,255,0.05)' }, ticks: { color: '#888' } },
                x: { grid: { display: false }, ticks: { color: '#888' } }
            }
        }
    });
});
</script>
@endsection