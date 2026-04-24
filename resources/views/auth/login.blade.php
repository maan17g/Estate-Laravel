<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Dream Home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <style>
    body { overflow-x: hidden; }

    /* ── SPLIT LAYOUT ── */
    .auth-page {
      min-height: 100vh;
      display: flex;
    }

    /* LEFT IMAGE PANEL */
    .auth-image-panel {
      flex: 1;
      position: relative;
      display: none;
      background-image: url('{{ asset('images/login-bg.jpg') }}');
      background-size: cover;
      background-position: center;
    }
    @media (min-width: 992px) { .auth-image-panel { display: block; } }

    .auth-image-overlay {
      position: absolute; inset: 0;
      background: linear-gradient(135deg, rgba(10,26,18,0.85), rgba(60,181,124,0.3));
    }
    .auth-image-content {
      position: absolute; bottom: 0; left: 0; right: 0;
      padding: 3rem;
      color: #fff;
    }
    .auth-image-logo {
      position: absolute; top: 2rem; left: 2rem;
      display: flex; align-items: center; gap: 10px;
      font-size: 1.4rem; font-weight: 700; color: #fff;
      text-decoration: none;
    }
    .auth-image-logo i { color: var(--primary); font-size: 1.6rem; }

    .auth-stat-row {
      display: flex; gap: 2rem; margin-bottom: 2rem;
    }
    .auth-stat strong { display: block; font-size: 1.8rem; font-weight: 700; color: #fff; }
    .auth-stat span { font-size: 0.8rem; color: rgba(255,255,255,0.7); }

    .auth-testimonial {
      background: rgba(255,255,255,0.08);
      backdrop-filter: blur(8px);
      border: 1px solid rgba(255,255,255,0.15);
      border-radius: 16px;
      padding: 1.5rem;
    }
    .auth-testimonial p {
      font-size: 0.92rem; color: rgba(255,255,255,0.9);
      line-height: 1.7; margin-bottom: 1rem;
      font-style: italic;
    }
    .auth-testimonial-author {
      display: flex; align-items: center; gap: 12px;
    }
    .auth-testimonial-author img {
      width: 42px; height: 42px; border-radius: 50%;
      object-fit: cover; border: 2px solid var(--primary);
    }
    .auth-testimonial-author strong { display: block; font-size: 0.88rem; color: #fff; }
    .auth-testimonial-author span { font-size: 0.75rem; color: rgba(255,255,255,0.6); }

    /* RIGHT FORM PANEL */
    .auth-form-panel {
      width: 100%;
      max-width: 520px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      padding: 2.5rem 2rem;
      background-color: var(--bg-body);
      overflow-y: auto;
    }
    @media (min-width: 992px) {
      .auth-form-panel { padding: 3rem 3.5rem; }
    }

    .auth-form-header { margin-bottom: 2rem; }
    .auth-form-header .back-link {
      display: inline-flex; align-items: center; gap: 6px;
      color: var(--text-muted); font-size: 0.85rem;
      text-decoration: none; margin-bottom: 1.5rem;
      transition: color 0.2s;
    }
    .auth-form-header .back-link:hover { color: var(--primary); }
    .auth-welcome { font-size: 1.85rem; font-weight: 700; margin-bottom: 0.4rem; }
    .auth-subtitle { color: var(--text-muted); font-size: 0.9rem; }

    /* Social Login Buttons */
    .social-login-btn {
      width: 100%; padding: 11px;
      border-radius: 10px; font-size: 0.9rem; font-weight: 600;
      cursor: pointer; transition: all 0.2s;
      display: flex; align-items: center; justify-content: center; gap: 10px;
      margin-bottom: 0.65rem;
    }
    .btn-google {
      background: transparent;
      border: 1px solid var(--border-color);
      color: var(--text-main);
    }
    .btn-google:hover { border-color: #ea4335; color: #ea4335; background: rgba(234,67,53,0.05); }
    .btn-facebook {
      background: transparent;
      border: 1px solid var(--border-color);
      color: var(--text-main);
    }
    .btn-facebook:hover { border-color: #1877f2; color: #1877f2; background: rgba(24,119,242,0.05); }

    /* Divider */
    .auth-divider {
      display: flex; align-items: center; gap: 1rem;
      margin: 1.25rem 0;
      color: var(--text-muted); font-size: 0.82rem;
    }
    .auth-divider::before, .auth-divider::after {
      content: ''; flex: 1; height: 1px; background: var(--border-color);
    }

    /* Form Fields */
    .form-label { font-size: 0.85rem; font-weight: 500; color: var(--text-main); margin-bottom: 5px; }
    .input-icon-wrap { position: relative; }
    .input-icon-wrap .form-control { padding-left: 2.6rem; }
    .input-icon-wrap .input-icon {
      position: absolute; left: 12px; top: 50%;
      transform: translateY(-50%);
      color: var(--text-muted); font-size: 1rem;
    }
    .input-toggle-pass {
      position: absolute; right: 12px; top: 50%;
      transform: translateY(-50%);
      color: var(--text-muted); cursor: pointer; font-size: 1rem;
      background: none; border: none;
      transition: color 0.2s;
    }
    .input-toggle-pass:hover { color: var(--primary); }

    .form-check-input:checked { background-color: var(--primary); border-color: var(--primary); }
    .form-check-label { font-size: 0.83rem; color: var(--text-muted); }

    .btn-auth-submit {
      background: var(--primary); color: #fff;
      border: none; width: 100%; padding: 13px;
      border-radius: 10px; font-weight: 700;
      font-size: 0.95rem; cursor: pointer;
      transition: background 0.2s; margin-top: 0.5rem;
      display: flex; align-items: center; justify-content: center; gap: 8px;
    }
    .btn-auth-submit:hover { background: var(--primary-hover); }

    .auth-switch {
      text-align: center; margin-top: 1.5rem;
      font-size: 0.88rem; color: var(--text-muted);
    }
    .auth-switch a { color: var(--primary); font-weight: 600; text-decoration: none; }
    .auth-switch a:hover { text-decoration: underline; }

    .forgot-link {
      font-size: 0.82rem; color: var(--primary);
      text-decoration: none; font-weight: 500;
    }
    .forgot-link:hover { text-decoration: underline; }

    /* Password strength */
    .strength-bar { height: 4px; border-radius: 4px; background: var(--border-color); margin-top: 6px; overflow: hidden; }
    .strength-fill { height: 100%; width: 0; border-radius: 4px; transition: all 0.3s; }
    .strength-text { font-size: 0.72rem; color: var(--text-muted); margin-top: 3px; }

    /* Error message */
    .field-error { font-size: 0.75rem; color: #e74c3c; margin-top: 4px; display: none; }

    /* Loading spinner on button */
    .btn-spinner { display: none; width: 18px; height: 18px; border: 2px solid rgba(255,255,255,0.4); border-top-color: #fff; border-radius: 50%; animation: spin 0.7s linear infinite; }
    @keyframes spin { to { transform: rotate(360deg); } }
  </style>
</head>
<body data-theme="dark">

  <div class="auth-page">

    <!-- LEFT: IMAGE PANEL -->
    <div class="auth-image-panel">
      <div class="auth-image-overlay"></div>
      <a href="{{ route('home') }}" class="auth-image-logo">
        <i class="bi bi-house-door-fill"></i> Real Estate
      </a>
      <div class="auth-image-content">
        <div class="auth-stat-row">
          <div class="auth-stat"><strong>500+</strong><span>Active Listings</span></div>
          <div class="auth-stat"><strong>15K+</strong><span>Happy Clients</span></div>
          <div class="auth-stat"><strong>98%</strong><span>Satisfaction</span></div>
        </div>
        <div class="auth-testimonial">
          <p>"Dream Home made finding our perfect villa completely effortless. The platform is beautiful and the team is incredible."</p>
          <div class="auth-testimonial-author">
            <img src="{{ asset('images/jessica.jpg') }}" alt="Jessica">
            <div>
              <strong>Jessica Sterling</strong>
              <span>Homeowner, Beverly Hills</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- RIGHT: FORM PANEL -->
    <div class="auth-form-panel">

      <!-- Mobile Logo -->
      <a href="{{ route('home') }}" class="d-flex d-lg-none align-items-center gap-2 text-decoration-none mb-4" style="font-size:1.2rem;font-weight:700;color:var(--text-main);">
        <i class="bi bi-house-door-fill" style="color:var(--primary);font-size:1.4rem;"></i> Real Estate
      </a>

      <div class="auth-form-header">
        <a href="{{ route('home') }}" class="back-link"><i class="bi bi-arrow-left"></i> Back to Home</a>
        <h2 class="auth-welcome">Welcome Back 👋</h2>
        <p class="auth-subtitle">Sign in to access your saved properties, viewings, and personalized dashboard.</p>
      </div>

      <!-- Social Login -->
      <button class="social-login-btn btn-google">
        <img src="https://www.google.com/favicon.ico" width="18" height="18" alt="Google"> Continue with Google
      </button>
      <button class="social-login-btn btn-facebook">
        <i class="fab fa-facebook-f" style="color:#1877f2;"></i> Continue with Facebook
      </button>

      <div class="auth-divider">or sign in with email</div>

      <!-- Login Form -->
      <form method="POST" action="{{ route('login') }}" novalidate>
        @csrf
        
        <!-- Email -->
        <div class="mb-3">
          <label class="form-label">Email Address</label>
          <div class="input-icon-wrap">
            <i class="bi bi-envelope input-icon"></i>
            <input type="email" name="email" class="form-control" id="loginEmail" placeholder="john@example.com" value="{{ old('email') }}" required>
          </div>
          @error('email')
            <div class="field-error" style="display:block;">{{ $message }}</div>
          @enderror
        </div>

        <!-- Password -->
        <div class="mb-2">
          <label class="form-label">Password</label>
          <div class="input-icon-wrap">
            <i class="bi bi-lock input-icon"></i>
            <input type="password" name="password" class="form-control" id="loginPassword" placeholder="Enter your password" style="padding-right:2.6rem;" required>
            <button type="button" class="input-toggle-pass" onclick="togglePass('loginPassword', this)">
              <i class="bi bi-eye"></i>
            </button>
          </div>
          @error('password')
            <div class="field-error" style="display:block;">{{ $message }}</div>
          @enderror
        </div>

        <!-- Remember + Forgot -->
        <div class="d-flex justify-content-between align-items-center mb-3">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="remember" id="rememberMe">
            <label class="form-check-label" for="rememberMe">Remember me</label>
          </div>
          <a href="{{ route('password.request') ?? '#' }}" class="forgot-link">Forgot password?</a>
        </div>

        <!-- Submit -->
        <button type="submit" class="btn-auth-submit" id="loginBtn">
          <i class="bi bi-box-arrow-in-right" id="loginIcon"></i>
          <span id="loginBtnText">Sign In</span>
        </button>
      </form>

      <div class="auth-switch">
        Don't have an account? <a href="{{ route('register') }}">Create one free →</a>
      </div>

      <!-- Terms note -->
      <p class="text-center mt-3" style="font-size:0.75rem;color:var(--text-muted);">
        By signing in you agree to our
        <a href="#" style="color:var(--primary);text-decoration:none;">Terms of Service</a> and
        <a href="#" style="color:var(--primary);text-decoration:none;">Privacy Policy</a>.
      </p>

    </div><!-- /auth-form-panel -->
  </div><!-- /auth-page -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // ── Toggle Password Visibility ──
    function togglePass(inputId, btn) {
      const input = document.getElementById(inputId);
      const icon = btn.querySelector('i');
      if (input.type === 'password') {
        input.type = 'text';
        icon.className = 'bi bi-eye-slash';
      } else {
        input.type = 'password';
        icon.className = 'bi bi-eye';
      }
    }
  </script>
</body>
</html>
