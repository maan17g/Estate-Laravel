<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Dream Home - Find your perfect property with verified listings and expert guidance">
  <title>Dream Home - Find Your Perfect Place</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body data-theme="dark">

  <!-- NAVBAR -->
  <header>
    <nav class="navbar navbar-expand-lg fixed-top" id="navbar">
      <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
          <i class="bi bi-house-door-fill"></i> Real Estate
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navContent">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navContent">
          <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-lg-4">
            <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a></li>
            <li class="nav-item"><a class="nav-link {{ request()->routeIs('properties.*') ? 'active' : '' }}" href="{{ route('properties.index') }}">Properties</a></li>
            <li class="nav-item"><a class="nav-link {{ request()->routeIs('agents.*') ? 'active' : '' }}" href="{{ route('agents.index') }}">Agents</a></li>
            <li class="nav-item"><a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About Us</a></li>
            <li class="nav-item"><a class="nav-link {{ request()->routeIs('contact.index') ? 'active' : '' }}" href="{{ route('contact.index') }}">Contact</a></li>
          </ul>
          <div class="d-flex align-items-center gap-3 flex-column flex-lg-row mt-3 mt-lg-0">
            <button class="theme-toggle-btn" id="themeToggle" title="Toggle Light/Dark Mode">
              <i class="bi bi-sun-fill"></i>
            </button>
            @auth
              <a href="{{ auth()->user()->hasRole('super_admin') ? route('admin.dashboard') : (auth()->user()->hasRole('agent') ? route('agent.dashboard') : route('customer.dashboard')) }}" class="nav-link fw-bold">Dashboard</a>
              <form action="{{ route('logout') }}" method="POST" class="d-inline">
                  @csrf
                  <button type="submit" class="btn btn-sm btn-outline-danger shadow-sm">Logout</button>
              </form>
            @else
              <a href="{{ route('login') }}" class="nav-link fw-bold">Login</a>
              <a href="{{ route('register') }}" class="btn btn-consult shadow-sm">
                <i class="bi bi-person-plus me-2"></i> Register
              </a>
            @endauth
          </div>
        </div>
      </div>
    </nav>
  </header>

  @yield('content')

  <!-- ===================== FOOTER ===================== -->
  <footer class="footer">
    <div class="container">
      <div class="row g-5">

        <!-- Brand Column -->
        <div class="col-lg-4 col-md-6">
          <a href="{{ route('home') }}" class="footer-brand">
            <i class="bi bi-house-door-fill"></i> Real Estate
          </a>
          <p class="footer-tagline">
            Building places you're proud to call home — today, tomorrow, and for every milestone in between.
          </p>
          <!-- Newsletter -->
          <p class="footer-heading mb-2">Stay Updated</p>
          <div class="footer-newsletter">
            <input type="email" class="form-control" placeholder="Your email address">
            <button class="footer-newsletter-btn" type="button">
              <i class="bi bi-send-fill"></i>
            </button>
          </div>
          <!-- Socials -->
          <div class="footer-socials">
            <a href="#" class="footer-social-icon" title="Facebook"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="footer-social-icon" title="Instagram"><i class="fab fa-instagram"></i></a>
            <a href="#" class="footer-social-icon" title="Twitter / X"><i class="fab fa-x-twitter"></i></a>
            <a href="#" class="footer-social-icon" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
            <a href="#" class="footer-social-icon" title="YouTube"><i class="fab fa-youtube"></i></a>
          </div>
        </div>

        <!-- Quick Links -->
        <div class="col-lg-2 col-md-3 col-6">
          <h6 class="footer-heading">Quick Links</h6>
          <ul class="footer-links">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('properties.index') }}">Properties</a></li>
            <li><a href="{{ route('agents.index') }}">Agents</a></li>
            <li><a href="{{ route('about') }}">About Us</a></li>
            <li><a href="{{ route('contact.index') }}">Contact</a></li>
            <li><a href="{{ route('blog.index') }}">Blog</a></li>
          </ul>
        </div>

        <!-- Property Types -->
        <div class="col-lg-2 col-md-3 col-6">
          <h6 class="footer-heading">Property Types</h6>
          <ul class="footer-links">
            <li><a href="{{ route('properties.index', ['type' => 'Apartment']) }}">Apartments</a></li>
            <li><a href="{{ route('properties.index', ['type' => 'Villa']) }}">Villas</a></li>
            <li><a href="{{ route('properties.index', ['type' => 'Townhouse']) }}">Townhouses</a></li>
            <li><a href="{{ route('properties.index', ['type' => 'Penthouse']) }}">Penthouses</a></li>
            <li><a href="{{ route('properties.index', ['type' => 'Office']) }}">Office Spaces</a></li>
          </ul>
        </div>

        <!-- Contact Info -->
        <div class="col-lg-4 col-md-6">
          <h6 class="footer-heading">Contact Us</h6>
          <div class="footer-contact-item">
            <i class="bi bi-geo-alt-fill"></i>
            <div>
              <strong>Our Office</strong>
              9876 Wilshire Blvd, Suite 500<br>Beverly Hills, CA 90210
            </div>
          </div>
          <div class="footer-contact-item">
            <i class="bi bi-telephone-fill"></i>
            <div>
              <strong>Phone</strong>
              (310) 555-0100
            </div>
          </div>
          <div class="footer-contact-item">
            <i class="bi bi-envelope-fill"></i>
            <div>
              <strong>Email</strong>
              info@dreamhome.com
            </div>
          </div>
          <div class="footer-contact-item">
            <i class="bi bi-clock-fill"></i>
            <div>
              <strong>Hours</strong>
              Mon–Fri: 9AM–6PM &nbsp;|&nbsp; Sat: 10AM–4PM
            </div>
          </div>
        </div>

      </div>

      <hr class="footer-divider">

      <div class="footer-bottom">
        <p class="footer-copyright mb-0">
          &copy; 2025 <span>Dream Home</span>. All Rights Reserved. Built with care.
        </p>
        <div class="footer-bottom-links">
          <a href="{{ route('privacy') }}">Privacy Policy</a>
          <a href="{{ route('terms') }}">Terms of Service</a>
          <a href="#">Sitemap</a>
        </div>
      </div>
    </div>
  </footer>
  <!-- ===================== / FOOTER ===================== -->

  <!-- Toast -->
  <div id="successToast">
    <i class="bi bi-check-circle-fill"></i> Message sent successfully!
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
