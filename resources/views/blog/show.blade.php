@extends('layouts.app')
@section('content')
<main style="padding-top:120px; padding-bottom:80px; background:var(--bg-body);">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        @isset($post)
        <span class="badge rounded-pill px-3 mb-3" style="background:rgba(60,181,124,.12);color:var(--primary);font-size:.8rem">{{ $post->category->name ?? 'General' }}</span>
        <h1 style="color:var(--text-main);font-weight:800;font-size:2rem;line-height:1.3">{{ $post->title }}</h1>
        <div class="d-flex align-items-center gap-3 my-3">
          <span style="color:var(--text-muted);font-size:.85rem"><i class="bi bi-calendar3 me-1"></i>{{ $post->created_at?->format('M d, Y') }}</span>
          <span style="color:var(--text-muted);font-size:.85rem"><i class="bi bi-person me-1"></i>{{ $post->author->name ?? 'Admin' }}</span>
        </div>
        @if($post->image)
        <img src="{{ $post->image }}" alt="{{ $post->title }}" class="img-fluid rounded-4 mb-4" style="width:100%;height:350px;object-fit:cover">
        @endif
        <div style="color:var(--text-main);line-height:1.9;font-size:1rem">{!! nl2br(e($post->content)) !!}</div>
        @else
        <div class="text-center py-5" style="color:var(--text-muted)">
          <i class="bi bi-newspaper display-4 d-block mb-3" style="opacity:.3"></i>
          <h4 style="color:var(--text-main)">Post Not Found</h4>
          <a href="{{ route('blog.index') }}" class="btn btn-primary rounded-pill mt-3 px-4">Back to Blog</a>
        </div>
        @endisset
        <div class="mt-5 pt-4 border-top" style="border-color:var(--border-color)!important">
          <a href="{{ route('blog.index') }}" style="color:var(--primary);text-decoration:none;font-weight:600"><i class="bi bi-arrow-left me-2"></i>Back to Blog</a>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection
