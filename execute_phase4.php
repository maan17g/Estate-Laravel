<?php

echo "========== STARTING PHASE 4 EXECUTION ==========\n";
$baseDir = __DIR__;

function write_file($path, $content) {
    global $baseDir;
    $fullPath = $baseDir . '/' . $path;
    $dir = dirname($fullPath);
    if (!is_dir($dir)) mkdir($dir, 0777, true);
    file_put_contents($fullPath, $content);
}

// ==========================================
// 1. MASTER DASHBOARD LAYOUT
// ==========================================
$dashboardLayout = <<<BLADE
@extends('layouts.app')
@section('content')
<style>
    body { overflow-x: hidden; }
    .dashboard-wrapper { display: flex; min-height: 100vh; padding-top: 70px; }
    .dash-sidebar { width: 260px; flex-shrink: 0; background: var(--form-bg); border-right: 1px solid var(--border-color); display: flex; flex-direction: column; position: fixed; top: 70px; left: 0; bottom: 0; z-index: 100; transition: transform 0.3s ease; overflow-y: auto; }
    .dash-sidebar.collapsed { transform: translateX(-260px); }
    .sidebar-user { padding: 1.5rem 1.25rem; border-bottom: 1px solid var(--border-color); display: flex; align-items: center; gap: 12px; }
    .sidebar-avatar { width: 48px; height: 48px; border-radius: 50%; object-fit: cover; border: 2px solid var(--primary); flex-shrink: 0; }
    .sidebar-user-name { font-weight: 700; font-size: 0.95rem; color: var(--text-main); margin: 0; }
    .sidebar-user-role { font-size: 0.75rem; color: var(--primary); text-transform: capitalize; }
    .sidebar-nav { padding: 1rem 0; flex: 1; }
    .sidebar-section-label { font-size: 0.68rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; color: var(--text-muted); padding: 0.5rem 1.25rem 0.3rem; }
    .sidebar-link { display: flex; align-items: center; gap: 12px; padding: 0.7rem 1.25rem; color: var(--text-muted); text-decoration: none; font-size: 0.88rem; font-weight: 500; transition: all 0.2s; border-left: 3px solid transparent; position: relative; }
    .sidebar-link i { font-size: 1rem; width: 20px; text-align: center; }
    .sidebar-link:hover { color: var(--text-main); background: rgba(60,181,124,0.05); }
    .sidebar-link.active { color: var(--primary); background: rgba(60,181,124,0.1); border-left-color: var(--primary); }
    .sidebar-logout { padding: 1rem 1.25rem; border-top: 1px solid var(--border-color); }
    .btn-logout { display: flex; align-items: center; gap: 10px; color: var(--text-muted); font-size: 0.85rem; background: none; border: none; cursor: pointer; padding: 0; transition: color 0.2s; }
    .btn-logout:hover { color: #e74c3c; }
    .dash-main { flex: 1; margin-left: 260px; padding: 2rem; background: var(--bg-body); min-height: calc(100vh - 70px); transition: margin-left 0.3s ease; }
    .dash-main.expanded { margin-left: 0; }
    .dash-topbar { display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem; margin-bottom: 2rem; }
    .dash-greeting { font-size: 1.5rem; font-weight: 700; }
    .dash-greeting span { color: var(--primary); }
    .dash-greeting-sub { color: var(--text-muted); font-size: 0.88rem; margin-top: 2px; }
    .sidebar-toggle-btn { background: var(--bg-card); border: 1px solid var(--border-color); color: var(--text-main); width: 38px; height: 38px; border-radius: 8px; cursor: pointer; display: flex; align-items: center; justify-content: center; font-size: 1rem; transition: all 0.2s; }
    .sidebar-toggle-btn:hover { border-color: var(--primary); color: var(--primary); }
    
    /* Stats & Generic Reusables */
    .dash-stat-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; margin-bottom: 2rem; }
    .dash-stat-card { background: var(--bg-card); border: 1px solid var(--border-color); border-radius: 16px; padding: 1.25rem 1.5rem; display: flex; align-items: center; gap: 1rem; transition: all 0.3s; }
    .dash-stat-card:hover { transform: translateY(-4px); border-color: var(--primary); box-shadow: 0 8px 24px var(--shadow); }
    .dash-stat-icon { width: 52px; height: 52px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; flex-shrink: 0; }
    .dash-stat-icon.green { background: rgba(60,181,124,0.15); color: var(--primary); }
    .dash-stat-icon.blue  { background: rgba(13,202,240,0.12); color: #0dcaf0; }
    .dash-stat-icon.gold  { background: rgba(255,193,7,0.12); color: #ffc107; }
    .dash-stat-icon.red   { background: rgba(231,76,60,0.12); color: #e74c3c; }
    .dash-stat-num { font-size: 1.6rem; font-weight: 700; color: var(--text-main); line-height: 1; }
    .dash-stat-label { font-size: 0.78rem; color: var(--text-muted); margin-top: 3px; }
    
    @media (max-width: 1200px) { .dash-stat-grid { grid-template-columns: repeat(2,1fr); } }
    @media (max-width: 991px) {
      .dash-sidebar { transform: translateX(-260px); }
      .dash-sidebar.open { transform: translateX(0); }
      .dash-main { margin-left: 0; }
    }
</style>

<div class="dashboard-wrapper">
    <!-- SIDEBAR -->
    <aside class="dash-sidebar" id="dashSidebar">
      <div class="sidebar-user">
        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=0D8ABC&color=fff" class="sidebar-avatar" alt="User">
        <div>
          <p class="sidebar-user-name">{{ auth()->user()->name }}</p>
          <span class="sidebar-user-role">{{ str_replace('_', ' ', auth()->user()->roles->first()->name ?? 'Customer') }}</span>
        </div>
      </div>

      <nav class="sidebar-nav">
        @role('super_admin')
            <div class="sidebar-section-label">Administration</div>
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link"><i class="bi bi-speedometer2"></i> Portal Overview</a>
            <a href="{{ route('admin.properties.index') }}" class="sidebar-link"><i class="bi bi-houses"></i> Manage Properties</a>
            <a href="{{ route('admin.users.index') }}" class="sidebar-link"><i class="bi bi-people"></i> Manage Users</a>
            <a href="{{ route('admin.agents.index') }}" class="sidebar-link"><i class="bi bi-person-badge"></i> Agents & Approvals</a>
            <a href="{{ route('admin.transactions.index') }}" class="sidebar-link"><i class="bi bi-currency-dollar"></i> Transactions</a>
            <div class="sidebar-section-label mt-2">Content</div>
            <a href="{{ route('admin.blog.index') }}" class="sidebar-link"><i class="bi bi-journal-text"></i> Blog Posts</a>
            <a href="{{ route('admin.settings.index') }}" class="sidebar-link"><i class="bi bi-gear"></i> Platform Settings</a>
        @elserole('agent')
            <div class="sidebar-section-label">Agent Portal</div>
            <a href="{{ route('agent.dashboard') }}" class="sidebar-link"><i class="bi bi-speedometer2"></i> Dashboard</a>
            <a href="{{ route('agent.properties.index') }}" class="sidebar-link"><i class="bi bi-house-door"></i> My Listings</a>
            <a href="{{ route('agent.inquiries.index') }}" class="sidebar-link"><i class="bi bi-envelope"></i> Inquiries</a>
            <a href="{{ route('agent.appointments.index') }}" class="sidebar-link"><i class="bi bi-calendar-check"></i> Viewings</a>
            <a href="{{ route('agent.profile.edit') }}" class="sidebar-link"><i class="bi bi-person"></i> Agency Profile</a>
        @else
            <div class="sidebar-section-label">Main</div>
            <a href="{{ route('customer.dashboard') }}" class="sidebar-link"><i class="bi bi-speedometer2"></i> My Dashboard</a>
            <a href="{{ route('customer.favorites.index') }}" class="sidebar-link"><i class="bi bi-heart"></i> Saved Properties</a>
            <a href="{{ route('properties.index') }}" class="sidebar-link"><i class="bi bi-search"></i> Browse Listings</a>
            <a href="{{ route('customer.appointments.index') }}" class="sidebar-link"><i class="bi bi-calendar-check"></i> My Viewings</a>
        @endrole
      </nav>

      <div class="sidebar-logout">
        <form method="POST" action="{{ route('logout') }}" class="d-inline w-100">
            @csrf
            <button type="submit" class="btn-logout w-100">
                <i class="bi bi-box-arrow-left"></i> Sign Out
            </button>
        </form>
      </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="dash-main" id="dashMain">
      <div class="dash-topbar">
        <div class="d-flex align-items-center gap-3">
          <button class="sidebar-toggle-btn" onclick="toggleSidebar()" title="Toggle Sidebar">
            <i class="bi bi-layout-sidebar"></i>
          </button>
          <div>
            <div class="dash-greeting">Welcome, <span>{{ explode(' ', auth()->user()->name)[0] }}</span> 👋</div>
            <div class="dash-greeting-sub">{{ date('l, d F Y') }}</div>
          </div>
        </div>
        <a href="{{ route('properties.index') }}" class="btn btn-consult shadow-sm">
          <i class="bi bi-plus-lg me-2"></i> Browse Properties
        </a>
      </div>
      
      @if(session('success'))
          <div class="alert alert-success"><i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}</div>
      @endif

      @yield('dash-content')

    </main>
</div>

<script>
    let sidebarOpen = true;
    function toggleSidebar() {
      const sidebar = document.getElementById('dashSidebar');
      const main = document.getElementById('dashMain');
      if (window.innerWidth > 991) {
        sidebarOpen = !sidebarOpen;
        sidebar.classList.toggle('collapsed', !sidebarOpen);
        main.classList.toggle('expanded', !sidebarOpen);
      } else {
        sidebar.classList.toggle('open');
      }
    }
</script>
@endsection
BLADE;
write_file('resources/views/layouts/dashboard.blade.php', $dashboardLayout);


// ==========================================
// 2. UNIFY ALL ADMIN / AGENT DASHBOARDS
// ==========================================
$unifiedPanelScript = <<<BLADE
@extends('layouts.dashboard')
@section('dash-content')
<div class="card bg-card border-color shadow-sm rounded-4 p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 style="color:var(--text-main);">{{ \$title ?? 'Panel Management' }}</h4>
        <button class="btn btn-primary btn-sm"><i class="bi bi-plus-lg me-1"></i> Add New</button>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle" style="color:var(--text-main);">
            <thead style="background:var(--form-bg); color:var(--text-muted);">
                <tr><th>ID</th><th>Details</th><th>Status</th><th>Date</th><th>Actions</th></tr>
            </thead>
            <tbody>
                @foreach(range(1,5) as \$i)
                <tr style="border-bottom: 1px solid var(--border-color);">
                    <td>#{{\$i}}</td>
                    <td>Management Record #{{ \$i }}</td>
                    <td><span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2">Active</span></td>
                    <td>{{ date('M d, Y') }}</td>
                    <td>
                        <button class="btn border-color text-muted btn-sm me-1 rounded-3"><i class="bi bi-pencil"></i></button>
                        <button class="btn border-color text-danger btn-sm rounded-3"><i class="bi bi-trash"></i></button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
BLADE;

$adminDirs = ['agents', 'blog', 'inquiries', 'logs', 'properties', 'reports', 'settings', 'transactions', 'users'];
foreach ($adminDirs as $dir) {
    write_file("resources/views/dashboards/admin/{$dir}/index.blade.php", str_replace('{{ $title ?? \'Panel Management\' }}', ucfirst($dir), $unifiedPanelScript));
}

$agentDirs = ['appointments', 'inquiries', 'offers', 'profile', 'properties', 'tenants'];
foreach ($agentDirs as $dir) {
    write_file("resources/views/dashboards/agent/{$dir}/index.blade.php", str_replace('{{ $title ?? \'Panel Management\' }}', ucfirst($dir), $unifiedPanelScript));
}


// ==========================================
// 3. EDIT PROPERTIES/INDEX.BLADE.PHP FOR FILTERS AND LOOP
// ==========================================
$propertiesIndex = file_get_contents($baseDir . '/resources/views/properties/index.blade.php');
// Wrap filters in a form
$propertiesIndex = str_replace('<section class="filter-top-wrap mb-4">', '<form action="{{ route(\'properties.index\') }}" method="GET"><section class="filter-top-wrap mb-4">', $propertiesIndex);
$propertiesIndex = str_replace('</section>', '</section></form>', $propertiesIndex);
// Replace Grid
$gridReplacement = <<<HTML
        <div class="row g-4" id="propertiesGrid">
            @forelse(\$properties as \$prop)
            <div class="col-md-6 col-lg-4">
                <div class="dash-prop-card" style="display:flex; flex-direction:column; border-radius:20px; border:1px solid var(--border-color); background:var(--bg-card); overflow:hidden; transition:transform 0.3s; height:100%;">
                    <div style="position:relative;">
                        <img src="{{ \$prop->images->count() ? asset('storage/'.\$prop->images->first()->image_path) : 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?auto=format&fit=crop&w=600&q=80' }}" style="width:100%; height:220px; object-fit:cover;">
                        <span class="badge bg-primary position-absolute top-0 end-0 m-3 px-3 py-2 rounded-pill">{{ \$prop->type->name ?? 'Property' }}</span>
                    </div>
                    <div class="p-4" style="flex-grow:1; display:flex; flex-direction:column;">
                        <h5 style="color:var(--text-main); font-weight:700;" class="text-truncate">{{ \$prop->title }}</h5>
                        <p style="color:var(--text-muted); font-size:0.85rem;" class="mb-3 text-truncate"><i class="bi bi-geo-alt-fill text-primary"></i> {{ \$prop->location->city ?? 'Location TBA' }}</p>
                        
                        <div class="d-flex justify-content-between mb-3" style="font-size:0.85rem; color:var(--text-muted);">
                            <span><i class="bi bi-key mt-1"></i> {{ \$prop->bedrooms }} Beds</span>
                            <span><i class="bi bi-droplet mt-1"></i> {{ \$prop->bathrooms }} Baths</span>
                            <span><i class="bi bi-arrows-fullscreen mt-1"></i> {{ \$prop->area }} sqft</span>
                        </div>
                        
                        <div class="mt-auto d-flex justify-content-between align-items-center border-top pt-3" style="border-color:var(--border-color) !important;">
                            <span style="font-size:1.25rem; font-weight:700; color:var(--primary);">\${{ number_format(\$prop->price) }}</span>
                            <a href="{{ route('properties.show', \$prop->slug) }}" class="btn btn-outline-primary btn-sm rounded-pill px-3">View Details</a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <i class="bi bi-house-x display-1 text-muted mb-3" style="opacity:0.3"></i>
                <h4 style="color:var(--text-main);">No properties found</h4>
                <p style="color:var(--text-muted);">Try adjusting your filters.</p>
                <a href="{{ route('properties.index') }}" class="btn btn-primary mt-2 rounded-pill px-4">Clear All Filters</a>
            </div>
            @endforelse
        </div>
        
        <div class="mt-5 d-flex justify-content-center">
            {{ \$properties->links('pagination::bootstrap-5') }}
        </div>
HTML;
$propertiesIndex = preg_replace('/<div class="row g-4" id="propertiesGrid">.*?<\/nav>/s', $gridReplacement, $propertiesIndex);
// Fix empty variable call in PropertyController
$propControllerCode = file_get_contents($baseDir . '/app/Http/Controllers/PropertyController.php');
$propControllerCode = str_replace('\$properties = \$query->latest()->paginate(12);', '$properties = $query->latest()->paginate(12);', $propControllerCode);
file_put_contents($baseDir . '/app/Http/Controllers/PropertyController.php', $propControllerCode);

write_file('resources/views/properties/index.blade.php', $propertiesIndex);

echo "========== PHASE 4 EXECUTION COMPLETE ==========\n";
