@extends('layouts.dashboard')
@section('page-title', 'Blog Posts')
@section('dash-content')

<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h4 class="fw-bold mb-1" style="color:var(--text-main)">Blog Posts</h4>
    <p class="mb-0" style="color:var(--text-muted); font-size:.875rem">Manage all blog content</p>
  </div>
  <button class="btn btn-primary rounded-pill px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#addPostModal">
    <i class="bi bi-pencil-square me-2"></i> New Post
  </button>
</div>

<div class="card bg-card border-color shadow-sm" style="border-radius:14px">
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table dash-table mb-0">
        <thead>
          <tr><th class="ps-4">#</th><th>Title</th><th>Category</th><th>Author</th><th>Status</th><th>Date</th><th class="text-end pe-4">Actions</th></tr>
        </thead>
        <tbody>
          @forelse($data ?? [] as $post)
          <tr>
            <td class="ps-4 text-muted" style="font-size:.8rem">#{{ $post->id }}</td>
            <td style="color:var(--text-main);max-width:220px" class="text-truncate">{{ $post->title ?? '—' }}</td>
            <td style="color:var(--text-muted);font-size:.85rem">{{ $post->category->name ?? '—' }}</td>
            <td style="color:var(--text-muted);font-size:.85rem">{{ $post->author->name ?? 'Admin' }}</td>
            <td><span class="badge rounded-pill px-3 py-2 {{ ($post->status??'draft')==='published' ? 'badge-status-active' : 'badge-status-inactive' }}" style="font-size:.72rem">{{ ucfirst($post->status ?? 'draft') }}</span></td>
            <td style="color:var(--text-muted);font-size:.82rem">{{ $post->created_at?->format('M d, Y') }}</td>
            <td class="text-end pe-4">
              <div class="d-flex justify-content-end gap-1">
                <button class="btn btn-sm btn-outline-primary rounded-pill px-3"><i class="bi bi-pencil"></i></button>
                <button class="btn btn-sm btn-outline-danger rounded-pill px-3"><i class="bi bi-trash"></i></button>
              </div>
            </td>
          </tr>
          @empty
          <tr><td colspan="7" class="text-center py-5" style="color:var(--text-muted)"><i class="bi bi-newspaper display-5 d-block mb-2" style="opacity:.3"></i>No blog posts yet.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>

<div class="modal fade" id="addPostModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content bg-card border-color">
      <div class="modal-header border-0"><h5 class="modal-title fw-bold" style="color:var(--text-main)"><i class="bi bi-pencil-square me-2" style="color:var(--primary)"></i>New Blog Post</h5><button type="button" class="btn-close" data-bs-dismiss="modal" style="filter:invert(1) opacity(.5)"></button></div>
      <div class="modal-body">
        <form method="POST">
          @csrf
          <div class="mb-3"><label class="form-label">Post Title</label><input type="text" name="title" class="form-control" required></div>
          <div class="row g-3 mb-3">
            <div class="col-md-6"><label class="form-label">Category</label><input type="text" name="category" class="form-control" placeholder="e.g. Market Tips"></div>
            <div class="col-md-6"><label class="form-label">Status</label><select name="status" class="form-select"><option value="draft">Draft</option><option value="published">Published</option></select></div>
          </div>
          <div class="mb-3"><label class="form-label">Content</label><textarea name="content" class="form-control" rows="5" placeholder="Write your blog post…"></textarea></div>
          <div class="d-flex gap-2 mt-3"><button type="submit" class="btn btn-primary rounded-pill px-4 flex-fill">Publish Post</button><button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Cancel</button></div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
