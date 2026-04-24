<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register - Dream Home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <style>
    /* Copied auth layout from login */
    .auth-page { min-height: 100vh; display: flex; }
    .auth-image-panel { flex: 1; position: relative; display: none; background-image: url('{{ asset('images/login-bg.jpg') }}'); background-size: cover; background-position: center; }
    @media (min-width: 992px) { .auth-image-panel { display: block; } }
    .auth-image-overlay { position: absolute; inset: 0; background: linear-gradient(135deg, rgba(10,26,18,0.85), rgba(60,181,124,0.3)); }
    .auth-image-content { position: absolute; bottom: 0; left: 0; right: 0; padding: 3rem; color: #fff; }
    .auth-form-panel { width: 100%; max-width: 520px; display: flex; flex-direction: column; justify-content: center; padding: 2.5rem 2rem; background-color: var(--bg-body); overflow-y: auto; }
    @media (min-width: 992px) { .auth-form-panel { padding: 3rem 3.5rem; } }
    .auth-welcome { font-size: 1.85rem; font-weight: 700; margin-bottom: 0.4rem; }
    .input-icon-wrap { position: relative; }
    .input-icon-wrap .form-control { padding-left: 2.6rem; }
    .input-icon-wrap .input-icon { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: var(--text-muted); font-size: 1rem; }
    .btn-auth-submit { background: var(--primary); color: #fff; border: none; width: 100%; padding: 13px; border-radius: 10px; font-weight: 700; font-size: 0.95rem; cursor: pointer; transition: background 0.2s; margin-top: 0.5rem; }
  </style>
</head>
<body data-theme="dark">
  <div class="auth-page">
    <div class="auth-image-panel">
      <div class="auth-image-overlay"></div>
    </div>
    <div class="auth-form-panel">
      <h2 class="auth-welcome">Create an Account ✨</h2>
      <p style="color:var(--text-muted);font-size:0.9rem;">Join thousands finding their dream home.</p>
      
      <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="mb-3">
          <label class="form-label">Full Name</label>
          <div class="input-icon-wrap">
            <i class="bi bi-person input-icon"></i>
            <input type="text" name="name" class="form-control" placeholder="John Doe" value="{{ old('name') }}" required>
          </div>
          @error('name')<div class="text-danger mt-1" style="font-size:0.8rem;">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
          <label class="form-label">Email</label>
          <div class="input-icon-wrap">
            <i class="bi bi-envelope input-icon"></i>
            <input type="email" name="email" class="form-control" placeholder="john@example.com" value="{{ old('email') }}" required>
          </div>
          @error('email')<div class="text-danger mt-1" style="font-size:0.8rem;">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
          <label class="form-label">Password</label>
          <div class="input-icon-wrap">
            <i class="bi bi-lock input-icon"></i>
            <input type="password" name="password" class="form-control" placeholder="Create password" required>
          </div>
          @error('password')<div class="text-danger mt-1" style="font-size:0.8rem;">{{ $message }}</div>@enderror
        </div>

        <div class="mb-4">
          <label class="form-label">Confirm Password</label>
          <div class="input-icon-wrap">
            <i class="bi bi-lock-fill input-icon"></i>
            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm password" required>
          </div>
        </div>

        <button type="submit" class="btn-auth-submit">Create Account</button>
      </form>

      <div class="text-center mt-3" style="font-size:0.88rem; color:var(--text-muted);">
        Already have an account? <a href="{{ route('login') }}" style="color:var(--primary);font-weight:600;">Sign in →</a>
      </div>
    </div>
  </div>
</body>
</html>
