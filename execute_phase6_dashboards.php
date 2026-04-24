<?php

echo "========== STARTING PHASE 6 EXECUTION ==========\n";
$baseDir = __DIR__;

function write_file($path, $content) {
    global $baseDir;
    $fullPath = $baseDir . '/' . $path;
    $dir = dirname($fullPath);
    if (!is_dir($dir)) mkdir($dir, 0777, true);
    file_put_contents($fullPath, $content);
}

// ==========================================
// 1. SUPER ADMIN DASHBOARD
// ==========================================
$adminDashboard = <<<BLADE
@extends('layouts.dashboard')
@section('dash-content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="dash-stat-grid mb-5">
    <div class="dash-stat-card shadow-sm border-0">
        <div class="dash-stat-icon green"><i class="bi bi-wallet2"></i></div>
        <div>
            <div class="dash-stat-num">\$2.4M</div>
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
                    ] as \$log)
                        <div class="d-flex align-items-center gap-3 mb-4 pb-3 border-bottom" style="border-color:var(--border-color) !important;">
                            <div style="width:40px; height:40px; border-radius:10px; background:{{\$log['bg']}}; color:{{\$log['color']}}; display:flex; align-items:center; justify-content:center; font-size:1.1rem; flex-shrink:0;">
                                <i class="bi {{\xA\$log['icon']}}"></i>
                            </div>
                            <div style="flex-grow:1;">
                                <h6 style="color:var(--text-main); font-size:0.9rem; margin-bottom:2px; font-weight:600;">{{\xA\$log['text']}}</h6>
                                <span style="color:var(--text-muted); font-size:0.75rem;">{{\xA\$log['time']}}</span>
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
BLADE;
// Remove any bad string interpolation escapes
$adminDashboard = str_replace('\xA$', '$', $adminDashboard);
write_file('resources/views/dashboards/admin/index.blade.php', $adminDashboard);


// ==========================================
// 2. AGENT DASHBOARD
// ==========================================
$agentDashboard = <<<BLADE
@extends('layouts.dashboard')
@section('dash-content')

<div class="row align-items-center mb-5">
    <div class="col-md-8">
        <h3 style="color:var(--text-main); font-weight:800; margin-bottom:5px;">Agent Command Center</h3>
        <p style="color:var(--text-muted);">Manage your active portfolio, connect with clients, and schedule viewings.</p>
    </div>
    <div class="col-md-4 text-md-end mt-3 mt-md-0">
        <a href="#" class="btn btn-primary rounded-pill px-4 py-2 shadow"><i class="bi bi-plus-lg me-2"></i> List New Property</a>
    </div>
</div>

<div class="dash-stat-grid mb-5">
    <div class="dash-stat-card shadow-sm border-0" style="background: linear-gradient(135deg,rgba(60,181,124,0.1), transparent);">
        <div class="dash-stat-icon green"><i class="bi bi-house-check"></i></div>
        <div>
            <div class="dash-stat-num">24</div>
            <div class="dash-stat-label">Active Listings</div>
        </div>
    </div>
    <div class="dash-stat-card shadow-sm border-0">
        <div class="dash-stat-icon blue"><i class="bi bi-chat-dots"></i></div>
        <div>
            <div class="dash-stat-num">8</div>
            <div class="dash-stat-label">New Inquiries</div>
        </div>
    </div>
    <div class="dash-stat-card shadow-sm border-0">
        <div class="dash-stat-icon gold"><i class="bi bi-calendar-event"></i></div>
        <div>
            <div class="dash-stat-num">12</div>
            <div class="dash-stat-label">Upcoming Viewings</div>
        </div>
    </div>
    <div class="dash-stat-card shadow-sm border-0">
        <div class="dash-stat-icon" style="background:rgba(13,138,188,0.1); color:#0D8ABC;"><i class="bi bi-graph-up"></i></div>
        <div>
            <div class="dash-stat-num">14.2K</div>
            <div class="dash-stat-label">Impressions</div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-7">
        <div class="card bg-card border-color shadow-sm h-100" style="border-radius:18px;">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 style="color:var(--text-main); font-weight:700;">Top Performing Listings</h5>
                    <button class="btn btn-sm btn-outline-secondary">View All</button>
                </div>
                
                @foreach(range(1,4) as \$idx)
                <div class="d-flex align-items-center gap-3 mb-4 p-3 rounded-4" style="background:var(--form-bg); border:1px solid var(--border-color); transition:transform 0.2s;">
                    <img src="https://images.unsplash.com/photo-1600{{ rand(10000,60000) }}-{{ rand(1000,9999) }}?auto=format&fit=crop&w=150&q=80" style="width:70px; height:70px; border-radius:12px; object-fit:cover;">
                    <div style="flex-grow:1;">
                        <h6 style="color:var(--text-main); font-weight:600; margin-bottom:4px;">Luxury Villa #{{ rand(100,500) }}</h6>
                        <div style="font-size:0.8rem; color:var(--text-muted);"><i class="bi bi-eye"></i> {{ rand(1000, 5000) }} Views &nbsp;&middot;&nbsp; <i class="bi bi-heart"></i> {{ rand(10, 50) }} Saves</div>
                    </div>
                    <div class="text-end">
                        <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">Active</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="card bg-card border-color shadow-sm h-100" style="border-radius:18px;">
            <div class="card-body p-4">
                <h5 style="color:var(--text-main); font-weight:700; mb-4">Client Messages</h5>
                <div class="text-center py-5 text-muted">
                    <i class="bi bi-envelope-paper display-4 mb-3" style="opacity:0.3"></i>
                    <h6>All Caught Up!</h6>
                    <p class="small">You have responded to all pending client inquiries.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
BLADE;
$agentDashboard = str_replace('\xA$', '$', $agentDashboard);
write_file('resources/views/dashboards/agent/index.blade.php', $agentDashboard);


// ==========================================
// 3. CUSTOMER DASHBOARD
// ==========================================
$customerDashboard = <<<BLADE
@extends('layouts.dashboard')
@section('dash-content')

<div class="card bg-card border-color shadow-sm mb-5" style="border-radius:24px; background: linear-gradient(45deg, rgba(7, 14, 11, 0.9), transparent), url('https://images.unsplash.com/photo-1449844908441-8829872d2607?auto=format&fit=crop&w=1600&q=80') center/cover;">
    <div class="card-body p-5">
        <h2 style="color:#fff; font-weight:800; font-size:2.5rem; text-shadow:0 2px 10px rgba(0,0,0,0.5);">Ready to find your dream home?</h2>
        <p style="color:rgba(255,255,255,0.8); font-size:1.1rem; max-width:600px; text-shadow:0 2px 10px rgba(0,0,0,0.5);" class="mb-4">From modern luxury apartments to sprawling grand estates, effortlessly browse dynamically matched properties.</p>
        <a href="{{ route('properties.index') }}" class="btn btn-primary rounded-pill px-4 py-2" style="font-weight:600; font-size:1.1rem; box-shadow:0 5px 20px rgba(60,181,124,0.4);">Explore Gallery <i class="bi bi-arrow-right ms-2"></i></a>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-6">
        <div class="card bg-card border-color shadow-sm h-100" style="border-radius:18px;">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 style="color:var(--text-main); font-weight:700; margin:0;"><i class="bi bi-heart-fill text-danger me-2"></i> My Saved Properties</h5>
                    <a href="{{ route('customer.favorites.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill">View All</a>
                </div>
                
                <div class="text-center py-5">
                    <div style="width:80px; height:80px; border-radius:50%; background:rgba(231,76,60,0.1); color:#e74c3c; display:flex; align-items:center; justify-content:center; font-size:2.5rem; margin:0 auto 1.5rem auto;">
                        <i class="bi bi-heart"></i>
                    </div>
                    <h6 style="color:var(--text-main);">No favorites yet</h6>
                    <p style="color:var(--text-muted); font-size:0.9rem;">Start exploring the platform and save your dream properties here!</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card bg-card border-color shadow-sm h-100" style="border-radius:18px;">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 style="color:var(--text-main); font-weight:700; margin:0;"><i class="bi bi-calendar-event-fill text-primary me-2"></i> Upcoming Viewings</h5>
                    <a href="#" class="btn btn-sm btn-outline-secondary rounded-pill">Schedule</a>
                </div>
                
                <div class="text-center py-5">
                    <div style="width:80px; height:80px; border-radius:50%; background:rgba(60,181,124,0.1); color:var(--primary); display:flex; align-items:center; justify-content:center; font-size:2.5rem; margin:0 auto 1.5rem auto;">
                        <i class="bi bi-calendar-x"></i>
                    </div>
                    <h6 style="color:var(--text-main);">No appointments booked</h6>
                    <p style="color:var(--text-muted); font-size:0.9rem;">You currently don't have any viewings scheduled with our agents.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
BLADE;
$customerDashboard = str_replace('\xA$', '$', $customerDashboard);
write_file('resources/views/dashboards/customer/index.blade.php', $customerDashboard);

echo "========== PHASE 6 EXECUTION COMPLETE ==========\n";
