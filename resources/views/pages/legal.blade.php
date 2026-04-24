@extends('layouts.app')
@section('content')
<main style="padding-top:120px; padding-bottom:80px; background:var(--bg-body);">
    <div class="container">
        <div class="card border-color bg-card shadow-lg" style="border-radius:20px;">
            <div class="card-body p-5">
                <h1 style="color:var(--text-main); font-weight:800; font-size:2.5rem; border-bottom:2px solid var(--border-color); padding-bottom:1rem; margin-bottom:2rem;">{{ $title }}</h1>
                <div style="color:var(--text-muted); line-height:1.9;">
                    {{ $content }}
                </div>
            </div>
        </div>
    </div>
</main>
@endsection