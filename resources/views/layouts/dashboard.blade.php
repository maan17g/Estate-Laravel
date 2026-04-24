<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('page-title', 'Dashboard') — Real Estate</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <style>
    /* ---- DASHBOARD SHELL ---- */
    body { background-color: var(--bg-body); font-family: var(--font-family); }

    .dash-wrapper { display: flex; min-height: 100vh; padding-top: 0; }

    /* ---- SIDEBAR ---- */
    .dash-sidebar {
      width: 260px; min-height: 100vh; background: var(--form-bg);
      border-right: 1px solid var(--border-color); position: fixed; top: 0; left: 0;
      z-index: 1040; display: flex; flex-direction: column;
      transition: transform .3s ease;
    }
    .dash-sidebar.collapsed { transform: translateX(-260px); }

    .sidebar-brand {
      display: flex; align-items: center; gap: 10px; padding: 1.5rem 1.5rem 1rem;
      color: var(--text-main); font-size: 1.2rem; font-weight: 700;
      text-decoration: none; border-bottom: 1px solid var(--border-color);
    }
    .sidebar-brand i { color: var(--primary); font-size: 1.5rem; }

    .sidebar-role-badge {
      margin: 1rem 1.5rem .5rem; display: inline-flex; align-items: center; gap: 6px;
      background: rgba(60,181,124,.12); color: var(--primary);
      border: 1px solid var(--border-color); border-radius: 50px;
      font-size: .72rem; font-weight: 600; padding: 4px 12px; text-transform: uppercase; letter-spacing: 1px;
    }

    .sidebar-nav { flex: 1; padding: .5rem 0; overflow-y: auto; }
    .sidebar-section-label {
      font-size: .65rem; text-transform: uppercase; letter-spacing: 2px;
      color: var(--text-muted); padding: .8rem 1.5rem .3rem; font-weight: 600;
    }
    .sidebar-link {
      display: flex; align-items: center; gap: 12px; padding: .6rem 1.5rem;
      color: var(--text-muted); text-decoration: none; font-size: .875rem;
      font-weight: 500; border-left: 3px solid transparent; transition: all .2s;
    }
    .sidebar-link:hover, .sidebar-link.active {
      color: var(--primary); background: rgba(60,181,124,.07);
      border-left-color: var(--primary);
    }
    .sidebar-link i { font-size: 1rem; width: 20px; text-align: center; }

    .sidebar-footer {
      padding: 1rem 1.5rem; border-top: 1px solid var(--border-color);
      display: flex; align-items: center; gap: 10px;
    }
    .sidebar-avatar {
      width: 38px; height: 38px; border-radius: 50%;
      background: var(--primary); color: #fff;
      display: flex; align-items: center; justify-content: center; font-weight: 700;
      flex-shrink: 0; font-size: .9rem;
    }
    .sidebar-user-name { font-size: .85rem; font-weight: 600; color: var(--text-main); line-height: 1.2; }
    .sidebar-user-role { font-size: .72rem; color: var(--text-muted); }

    /* ---- TOPBAR ---- */
    .dash-topbar {
      position: fixed; top: 0; left: 260px; right: 0; height: 65px; z-index: 1030;
      background: var(--form-bg); border-bottom: 1px solid var(--border-color);
      display: flex; align-items: center; justify-content: space-between;
      padding: 0 1.5rem; transition: left .3s ease;
    }
    .dash-topbar.full { left: 0; }

    .topbar-toggle {
      background: transparent; border: 1px solid var(--border-color);
      color: var(--text-muted); width: 36px; height: 36px; border-radius: 8px;
      display: flex; align-items: center; justify-content: center; cursor: pointer;
      transition: all .2s;
    }
    .topbar-toggle:hover { background: var(--primary); color: #fff; border-color: var(--primary); }

    .topbar-title { font-size: 1.05rem; font-weight: 700; color: var(--text-main); }
    .topbar-right { display: flex; align-items: center; gap: .75rem; }

    .topbar-btn {
      background: transparent; border: 1px solid var(--border-color);
      color: var(--text-muted); width: 36px; height: 36px; border-radius: 8px;
      display: flex; align-items: center; justify-content: center; cursor: pointer;
      transition: all .2s; text-decoration: none;
    }
    .topbar-btn:hover { background: var(--primary); color: #fff; border-color: var(--primary); }

    /* ---- MAIN CONTENT ---- */
    .dash-main {
      margin-left: 260px; margin-top: 65px; padding: 2rem;
      min-height: calc(100vh - 65px); transition: margin-left .3s ease;
      background: var(--bg-body);
    }
    .dash-main.expanded { margin-left: 0; }

    /* ---- STAT CARDS ---- */
    .dash-stat-grid {
      display: grid; grid-template-columns: repeat(auto-fit, minmax(210px, 1fr)); gap: 1.25rem;
    }
    .dash-stat-card {
      background: var(--form-bg); border: 1px solid var(--border-color);
      border-radius: 16px; padding: 1.25rem 1.5rem;
      display: flex; align-items: center; gap: 1rem; transition: transform .2s;
    }
    .dash-stat-card:hover { transform: translateY(-3px); }
    .dash-stat-icon {
      width: 52px; height: 52px; border-radius: 14px; flex-shrink: 0;
      display: flex; align-items: center; justify-content: center; font-size: 1.4rem;
    }
    .dash-stat-icon.green { background: rgba(60,181,124,.12); color: #3cb57c; }
    .dash-stat-icon.blue  { background: rgba(13,138,188,.12); color: #0D8ABC; }
    .dash-stat-icon.gold  { background: rgba(255,193,7,.12);  color: #ffc107; }
    .dash-stat-icon.red   { background: rgba(231,76,60,.12);  color: #e74c3c; }
    .dash-stat-num  { font-size: 1.6rem; font-weight: 800; color: var(--text-main); line-height: 1; }
    .dash-stat-label{ font-size: .78rem; color: var(--text-muted); margin-top: 3px; }

    /* ---- TABLES ---- */
    .dash-table thead th {
      background: var(--form-bg); color: var(--text-muted); font-size: .78rem;
      text-transform: uppercase; letter-spacing: 1px; padding: .9rem 1rem; border: none;
    }
    .dash-table tbody tr { border-color: var(--border-color); }
    .dash-table tbody td { color: var(--text-main); padding: .85rem 1rem; vertical-align: middle; }
    .dash-table tbody tr:hover { background: rgba(60,181,124,.04); }

    /* ---- CARDS ---- */
    .bg-card { background: var(--form-bg) !important; }
    .border-color { border-color: var(--border-color) !important; }

    /* ---- FORM INPUTS ---- */
    .form-control, .form-select {
      background: var(--form-input-bg); border: 1px solid var(--border-color);
      color: var(--text-main); border-radius: 10px;
    }
    .form-control:focus, .form-select:focus {
      background: var(--form-input-bg); color: var(--text-main);
      border-color: var(--primary); box-shadow: 0 0 0 .2rem rgba(60,181,124,.2);
    }
    .form-label { color: var(--text-muted); font-size: .85rem; font-weight: 500; }

    /* ---- BADGES ---- */
    .badge-status-active   { background: rgba(60,181,124,.15); color: #3cb57c; border: 1px solid rgba(60,181,124,.3); }
    .badge-status-pending  { background: rgba(255,193,7,.15);  color: #ffc107; border: 1px solid rgba(255,193,7,.3); }
    .badge-status-rejected { background: rgba(231,76,60,.15);  color: #e74c3c; border: 1px solid rgba(231,76,60,.3); }
    .badge-status-inactive { background: rgba(120,120,120,.15);color: #888;    border: 1px solid rgba(120,120,120,.3); }

    /* ---- RESPONSIVE ---- */
    @media (max-width: 991px) {
      .dash-sidebar { transform: translateX(-260px); }
      .dash-sidebar.open { transform: translateX(0); }
      .dash-topbar { left: 0; }
      .dash-main { margin-left: 0; }
      .dash-overlay { display: block !important; }
    }
    .dash-overlay {
      display: none; position: fixed; inset: 0; background: rgba(0,0,0,.5);
      z-index: 1035;
    }
    @media (min-width: 992px) {
      .dash-sidebar.collapsed { transform: translateX(-260px); }
      .dash-topbar.collapsed-bar { left: 0; }
      .dash-main.expanded { margin-left: 0; }
    }
  </style>
</head>
<body data-theme="dark">

<div class="dash-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

<!-- ========= SIDEBAR ========= -->
<aside class="dash-sidebar" id="dashSidebar">
  <a href="{{ route('home') }}" class="sidebar-brand">
    <i class="bi bi-house-door-fill"></i> Real Estate
  </a>

  @php $user = auth()->user(); @endphp

  <span class="sidebar-role-badge">
    <i class="bi bi-shield-check"></i>
    @if($user->hasRole('super_admin')) Super Admin
    @elseif($user->hasRole('agent')) Agent
    @else Customer @endif
  </span>

  <nav class="sidebar-nav">

    {{-- SUPER ADMIN NAV --}}
    @if($user->hasRole('super_admin'))
      <div class="sidebar-section-label">Overview</div>
      <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <i class="bi bi-speedometer2"></i> Dashboard
      </a>

      <div class="sidebar-section-label">Management</div>
      <a href="{{ route('admin.users.index') }}" class="sidebar-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
        <i class="bi bi-people"></i> Users
      </a>
      <a href="{{ route('admin.agents.index') }}" class="sidebar-link {{ request()->routeIs('admin.agents*') ? 'active' : '' }}">
        <i class="bi bi-person-badge"></i> Agents
      </a>
      <a href="{{ route('admin.properties.index') }}" class="sidebar-link {{ request()->routeIs('admin.properties*') ? 'active' : '' }}">
        <i class="bi bi-houses"></i> Properties
      </a>
      <a href="{{ route('admin.inquiries.index') }}" class="sidebar-link {{ request()->routeIs('admin.inquiries*') ? 'active' : '' }}">
        <i class="bi bi-chat-left-dots"></i> Inquiries
      </a>
      <a href="{{ route('admin.transactions.index') }}" class="sidebar-link {{ request()->routeIs('admin.transactions*') ? 'active' : '' }}">
        <i class="bi bi-credit-card"></i> Transactions
      </a>
      <a href="{{ route('admin.blog.index') }}" class="sidebar-link {{ request()->routeIs('admin.blog*') ? 'active' : '' }}">
        <i class="bi bi-newspaper"></i> Blog Posts
      </a>

      <div class="sidebar-section-label">Analytics</div>
      <a href="{{ route('admin.reports.index') }}" class="sidebar-link {{ request()->routeIs('admin.reports*') ? 'active' : '' }}">
        <i class="bi bi-bar-chart-line"></i> Reports
      </a>
      <a href="{{ route('admin.logs.index') }}" class="sidebar-link {{ request()->routeIs('admin.logs*') ? 'active' : '' }}">
        <i class="bi bi-journal-text"></i> Activity Logs
      </a>

      <div class="sidebar-section-label">System</div>
      <a href="{{ route('admin.settings.index') }}" class="sidebar-link {{ request()->routeIs('admin.settings*') ? 'active' : '' }}">
        <i class="bi bi-gear"></i> Settings
      </a>
    @endif

    {{-- AGENT NAV --}}
    @if($user->hasRole('agent'))
      <div class="sidebar-section-label">Overview</div>
      <a href="{{ route('agent.dashboard') }}" class="sidebar-link {{ request()->routeIs('agent.dashboard') ? 'active' : '' }}">
        <i class="bi bi-speedometer2"></i> Dashboard
      </a>

      <div class="sidebar-section-label">Listings</div>
      <a href="{{ route('agent.properties.index') }}" class="sidebar-link {{ request()->routeIs('agent.properties*') ? 'active' : '' }}">
        <i class="bi bi-houses"></i> My Properties
      </a>
      <a href="{{ route('agent.properties.create') }}" class="sidebar-link">
        <i class="bi bi-plus-circle"></i> Add Property
      </a>

      <div class="sidebar-section-label">Clients</div>
      <a href="{{ route('agent.inquiries.index') }}" class="sidebar-link {{ request()->routeIs('agent.inquiries*') ? 'active' : '' }}">
        <i class="bi bi-chat-left-dots"></i> Inquiries
      </a>
      <a href="{{ route('agent.appointments.index') }}" class="sidebar-link {{ request()->routeIs('agent.appointments*') ? 'active' : '' }}">
        <i class="bi bi-calendar-event"></i> Appointments
      </a>
      <a href="{{ route('agent.offers.index') }}" class="sidebar-link {{ request()->routeIs('agent.offers*') ? 'active' : '' }}">
        <i class="bi bi-tags"></i> Offers
      </a>
      <a href="{{ route('agent.tenants.index') }}" class="sidebar-link {{ request()->routeIs('agent.tenants*') ? 'active' : '' }}">
        <i class="bi bi-person-lines-fill"></i> Tenants
      </a>

      <div class="sidebar-section-label">Account</div>
      <a href="{{ route('agent.profile.edit') }}" class="sidebar-link {{ request()->routeIs('agent.profile*') ? 'active' : '' }}">
        <i class="bi bi-person-circle"></i> My Profile
      </a>
    @endif

    {{-- CUSTOMER NAV --}}
    @if(!$user->hasRole('super_admin') && !$user->hasRole('agent'))
      <div class="sidebar-section-label">Overview</div>
      <a href="{{ route('customer.dashboard') }}" class="sidebar-link {{ request()->routeIs('customer.dashboard') ? 'active' : '' }}">
        <i class="bi bi-speedometer2"></i> Dashboard
      </a>

      <div class="sidebar-section-label">Browse</div>
      <a href="{{ route('properties.index') }}" class="sidebar-link">
        <i class="bi bi-search"></i> Search Properties
      </a>
      <a href="{{ route('customer.favorites.index') }}" class="sidebar-link {{ request()->routeIs('customer.favorites*') ? 'active' : '' }}">
        <i class="bi bi-heart"></i> Saved Properties
      </a>

      <div class="sidebar-section-label">Activity</div>
      <a href="{{ route('customer.appointments.index') }}" class="sidebar-link {{ request()->routeIs('customer.appointments*') ? 'active' : '' }}">
        <i class="bi bi-calendar-event"></i> My Viewings
      </a>
      <a href="{{ route('customer.inquiries.index') }}" class="sidebar-link {{ request()->routeIs('customer.inquiries*') ? 'active' : '' }}">
        <i class="bi bi-chat-left-dots"></i> My Inquiries
      </a>
      <a href="{{ route('customer.offers.index') }}" class="sidebar-link {{ request()->routeIs('customer.offers*') ? 'active' : '' }}">
        <i class="bi bi-tags"></i> My Offers
      </a>
      <a href="{{ route('customer.rental.index') }}" class="sidebar-link {{ request()->routeIs('customer.rental*') ? 'active' : '' }}">
        <i class="bi bi-house-door"></i> Rental Info
      </a>

      <div class="sidebar-section-label">Account</div>
      <a href="{{ route('customer.profile.edit') }}" class="sidebar-link {{ request()->routeIs('customer.profile*') ? 'active' : '' }}">
        <i class="bi bi-person-circle"></i> My Profile
      </a>
    @endif

    <div class="mt-3 mb-2 px-3">
      <a href="{{ route('home') }}" class="sidebar-link">
        <i class="bi bi-globe"></i> Public Website
      </a>
    </div>
  </nav>

  <!-- Sidebar Footer: User info -->
  <div class="sidebar-footer">
    <div class="sidebar-avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
    <div class="flex-grow-1 overflow-hidden">
      <div class="sidebar-user-name text-truncate">{{ $user->name }}</div>
      <div class="sidebar-user-role">
        @if($user->hasRole('super_admin')) Super Admin
        @elseif($user->hasRole('agent')) Agent
        @else Customer @endif
      </div>
    </div>
    <form action="{{ route('logout') }}" method="POST" class="d-inline">
      @csrf
      <button type="submit" class="topbar-btn" title="Logout"><i class="bi bi-box-arrow-right"></i></button>
    </form>
  </div>
</aside>

<!-- ========= TOPBAR ========= -->
<header class="dash-topbar" id="dashTopbar">
  <div class="d-flex align-items-center gap-3">
    <button class="topbar-toggle" id="sidebarToggle"><i class="bi bi-list"></i></button>
    <span class="topbar-title">@yield('page-title', 'Dashboard')</span>
  </div>
  <div class="topbar-right">
    <button class="topbar-btn" id="themeToggleBtn" title="Toggle theme"><i class="bi bi-sun-fill"></i></button>
    <a href="{{ route('home') }}" class="topbar-btn" title="Go to Website"><i class="bi bi-globe"></i></a>
  </div>
</header>

<!-- ========= MAIN CONTENT ========= -->
<main class="dash-main" id="dashMain">
  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-4 border-0 shadow-sm" role="alert" style="border-radius:12px; background:rgba(60,181,124,.12); color:#3cb57c; border-left:4px solid #3cb57c !important;">
      <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif
  @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show mb-4 border-0 shadow-sm" role="alert" style="border-radius:12px;">
      <i class="bi bi-exclamation-circle-fill me-2"></i> {{ session('error') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  @yield('dash-content')
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
  const sidebar = document.getElementById('dashSidebar');
  const topbar  = document.getElementById('dashTopbar');
  const main    = document.getElementById('dashMain');
  const overlay = document.getElementById('sidebarOverlay');
  const toggle  = document.getElementById('sidebarToggle');
  let isMobile  = window.innerWidth < 992;
  let collapsed = false;

  toggle.addEventListener('click', () => {
    if (isMobile) {
      sidebar.classList.toggle('open');
      overlay.style.display = sidebar.classList.contains('open') ? 'block' : 'none';
    } else {
      collapsed = !collapsed;
      sidebar.classList.toggle('collapsed', collapsed);
      topbar.classList.toggle('collapsed-bar', collapsed);
      main.classList.toggle('expanded', collapsed);
    }
  });

  function closeSidebar() {
    sidebar.classList.remove('open');
    overlay.style.display = 'none';
  }

  window.addEventListener('resize', () => {
    isMobile = window.innerWidth < 992;
    if (!isMobile) { overlay.style.display = 'none'; }
  });

  // Theme toggle
  const themeBtn = document.getElementById('themeToggleBtn');
  const saved = localStorage.getItem('theme') || 'dark';
  document.body.setAttribute('data-theme', saved);
  themeBtn.innerHTML = saved === 'dark' ? '<i class="bi bi-sun-fill"></i>' : '<i class="bi bi-moon-fill"></i>';

  themeBtn.addEventListener('click', () => {
    const cur = document.body.getAttribute('data-theme');
    const next = cur === 'dark' ? 'light' : 'dark';
    document.body.setAttribute('data-theme', next);
    localStorage.setItem('theme', next);
    themeBtn.innerHTML = next === 'dark' ? '<i class="bi bi-sun-fill"></i>' : '<i class="bi bi-moon-fill"></i>';
  });
</script>
@stack('scripts')
</body>
</html>
