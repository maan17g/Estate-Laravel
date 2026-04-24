@extends('layouts.app')
@section('content')
<main style="min-height:100vh;display:flex;align-items:center;background:var(--bg-body);padding-top:80px">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-5">
        <div class="text-center mb-4">
          <a href="{{ route('home') }}" style="color:var(--text-main);text-decoration:none;font-size:1.4rem;font-weight:800"><i class="bi bi-house-door-fill" style="color:var(--primary)"></i> Real Estate</a>
        </div>
        <div class="card border-0 shadow-lg" style="background:var(--form-bg);border:1px solid var(--border-color)!important;border-radius:20px">
          <div class="card-body p-5">
            <h4 style="color:var(--text-main);font-weight:800" class="mb-1">Forgot Password?</h4>
            <p style="color:var(--text-muted);font-size:.9rem" class="mb-4">Enter your email and we'll send you a reset link.</p>

            @if(session('status'))
            <div class="alert border-0 mb-4" style="background:rgba(60,181,124,.1);color:#3cb57c;border-radius:12px;border-left:4px solid #3cb57c!important">
              <i class="bi bi-check-circle-fill me-2"></i>{{ session('status') }}
            </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
              @csrf
              <div class="mb-4">
                <label class="form-label" style="color:var(--text-muted);font-size:.85rem;font-weight:500">Email Address</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="you@example.com" required style="background:var(--form-input-bg);border:1px solid var(--border-color);color:var(--text-main);border-radius:10px;padding:.75rem 1rem">
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>
              <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 fw-semibold shadow-sm">
                <i class="bi bi-send me-2"></i>Send Reset Link
              </button>
            </form>
            <div class="text-center mt-4">
              <a href="{{ route('login') }}" style="color:var(--primary);text-decoration:none;font-size:.875rem"><i class="bi bi-arrow-left me-1"></i>Back to Login</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection
