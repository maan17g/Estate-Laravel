@extends('layouts.app')
@section('content')
<main style="padding-top:120px; padding-bottom:80px; background:var(--bg-body);">
  <div class="container">
    <div class="text-center mb-5">
      <span class="badge rounded-pill px-3 py-2 mb-3" style="background:rgba(60,181,124,.15);color:var(--primary);font-size:.8rem;letter-spacing:2px;text-transform:uppercase">Latest News</span>
      <h2 style="color:var(--text-main);font-weight:800;font-size:2.2rem">Real Estate Blog</h2>
      <p style="color:var(--text-muted);max-width:560px;margin:0 auto">Market insights, buying guides, and expert tips to help you make the right move.</p>
    </div>

    <div class="row g-4">
      @forelse($posts ?? [] as $post)
      <div class="col-lg-4 col-md-6">
        <div class="card border-0 h-100 shadow-sm" style="background:var(--form-bg);border:1px solid var(--border-color)!important;border-radius:18px;overflow:hidden;transition:transform .2s" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
          <img src="{{ $post->image ?? 'https://images.unsplash.com/photo-1560518883-ce09059eeffa?auto=format&fit=crop&w=600&q=80' }}" alt="{{ $post->title }}" style="height:200px;object-fit:cover;width:100%">
          <div class="card-body p-4">
            <span class="badge rounded-pill px-3 mb-2" style="background:rgba(60,181,124,.12);color:var(--primary);font-size:.75rem">{{ $post->category->name ?? 'General' }}</span>
            <h5 style="color:var(--text-main);font-weight:700;line-height:1.4">{{ $post->title }}</h5>
            <p style="color:var(--text-muted);font-size:.875rem;line-height:1.6">{{ Str::limit($post->excerpt ?? $post->content, 120) }}</p>
            <div class="d-flex align-items-center justify-content-between mt-3">
              <span style="color:var(--text-muted);font-size:.78rem"><i class="bi bi-calendar3 me-1"></i>{{ $post->created_at?->format('M d, Y') }}</span>
              <a href="{{ route('blog.show', $post->slug ?? $post->id) }}" style="color:var(--primary);font-size:.85rem;font-weight:600;text-decoration:none">Read More <i class="bi bi-arrow-right"></i></a>
            </div>
          </div>
        </div>
      </div>
      @empty
      @foreach([
        ['Top 10 Neighborhoods to Invest in 2025','Market Trends','photo-1560518883-ce09059eeffa'],
        ['How to Get Pre-Approved for a Mortgage','Buying Guide','photo-1560520653-9e0e4c89eb11'],
        ['Renting vs Buying: Which Is Right For You?','Advice','photo-1512917774080-9991f1c4c750'],
        ['5 Home Staging Tips That Actually Work','Selling Tips','photo-1484154218962-a197022b5858'],
        ['Understanding Property Taxes in 2025','Legal','photo-1554995207-c18c203602cb'],
        ['The Rise of Smart Homes in Luxury Real Estate','Trends','photo-1558618666-fcd25c85cd64'],
      ] as $b)
      <div class="col-lg-4 col-md-6">
        <div class="card border-0 h-100 shadow-sm" style="background:var(--form-bg);border:1px solid var(--border-color)!important;border-radius:18px;overflow:hidden;transition:transform .2s" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
          <img src="https://images.unsplash.com/{{ $b[2] }}?auto=format&fit=crop&w=600&q=80" alt="{{ $b[0] }}" style="height:200px;object-fit:cover;width:100%">
          <div class="card-body p-4">
            <span class="badge rounded-pill px-3 mb-2" style="background:rgba(60,181,124,.12);color:var(--primary);font-size:.75rem">{{ $b[1] }}</span>
            <h5 style="color:var(--text-main);font-weight:700;line-height:1.4">{{ $b[0] }}</h5>
            <p style="color:var(--text-muted);font-size:.875rem;line-height:1.6">Discover insights and practical advice to help you navigate the real estate market with confidence.</p>
            <div class="d-flex align-items-center justify-content-between mt-3">
              <span style="color:var(--text-muted);font-size:.78rem"><i class="bi bi-calendar3 me-1"></i>Apr 20, 2025</span>
              <a href="#" style="color:var(--primary);font-size:.85rem;font-weight:600;text-decoration:none">Read More <i class="bi bi-arrow-right"></i></a>
            </div>
          </div>
        </div>
      </div>
      @endforeach
      @endforelse
    </div>
  </div>
</main>
@endsection
