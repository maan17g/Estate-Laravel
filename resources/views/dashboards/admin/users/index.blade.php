@extends('layouts.dashboard')
@section('page-title', 'Manage Users')
@section('dash-content')

<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h4 class="fw-bold mb-1" style="color:var(--text-main)">Users</h4>
    <p class="mb-0" style="color:var(--text-muted); font-size:.875rem">Manage all registered platform users</p>
  </div>
  <button class="btn btn-primary rounded-pill px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#addUserModal">
    <i class="bi bi-person-plus me-2"></i> Add User
  </button>
</div>

<div class="card bg-card border-color shadow-sm mb-4" style="border-radius:14px">
  <div class="card-body p-3">
    <form method="GET" class="row g-2 align-items-center">
      <div class="col-md-4"><input type="text" name="search" class="form-control form-control-sm" placeholder="Search by name or email…" value="{{ request('search') }}"></div>
      <div class="col-md-3">
        <select name="role" class="form-select form-select-sm">
          <option value="">All Roles</option>
          <option value="super_admin" {{ request('role')=='super_admin'?'selected':'' }}>Super Admin</option>
          <option value="agent" {{ request('role')=='agent'?'selected':'' }}>Agent</option>
          <option value="customer" {{ request('role')=='customer'?'selected':'' }}>Customer</option>
        </select>
      </div>
      <div class="col-md-2">
        <select name="status" class="form-select form-select-sm">
          <option value="">All Status</option>
          <option value="active" {{ request('status')=='active'?'selected':'' }}>Active</option>
          <option value="inactive" {{ request('status')=='inactive'?'selected':'' }}>Inactive</option>
        </select>
      </div>
      <div class="col-md-3 d-flex gap-2">
        <button type="submit" class="btn btn-primary btn-sm flex-fill rounded-pill">Filter</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill">Reset</a>
      </div>
    </form>
  </div>
</div>

<div class="card bg-card border-color shadow-sm" style="border-radius:14px">
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table dash-table mb-0">
        <thead>
          <tr>
            <th class="ps-4">#</th><th>Name</th><th>Email</th><th>Role</th><th>Status</th><th>Joined</th><th class="text-end pe-4">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($data as $user)
          <tr>
            <td class="ps-4 text-muted" style="font-size:.8rem">#{{ $user->id }}</td>
            <td>
              <div class="d-flex align-items-center gap-2">
                <div style="width:34px;height:34px;border-radius:50%;background:var(--primary);color:#fff;display:flex;align-items:center;justify-content:center;font-size:.8rem;font-weight:700;flex-shrink:0">{{ strtoupper(substr($user->name,0,1)) }}</div>
                <span style="color:var(--text-main)">{{ $user->name }}</span>
              </div>
            </td>
            <td style="color:var(--text-muted);font-size:.85rem">{{ $user->email }}</td>
            <td>
              @php $role = $user->getRoleNames()->first() ?? 'customer'; @endphp
              <span class="badge rounded-pill px-3 py-2 @if($role==='super_admin') badge-status-active @elseif($role==='agent') badge-status-pending @else badge-status-inactive @endif" style="font-size:.72rem">
                @if($role==='super_admin') Super Admin @elseif($role==='agent') Agent @else Customer @endif
              </span>
            </td>
            <td>
              <span class="badge rounded-pill px-3 py-2 {{ ($user->status??'active')==='active' ? 'badge-status-active' : 'badge-status-inactive' }}" style="font-size:.72rem">{{ ucfirst($user->status ?? 'active') }}</span>
            </td>
            <td style="color:var(--text-muted);font-size:.82rem">{{ $user->created_at?->format('M d, Y') }}</td>
            <td class="text-end pe-4">
              <div class="d-flex justify-content-end gap-1">
                <button class="btn btn-sm btn-outline-primary rounded-pill px-3"
                  data-bs-toggle="modal" data-bs-target="#editUserModal"
                  data-id="{{ $user->id }}" data-name="{{ $user->name }}" data-email="{{ $user->email }}" data-role="{{ $role }}" data-status="{{ $user->status ?? 'active' }}">
                  <i class="bi bi-pencil"></i>
                </button>
                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Delete this user?')">
                  @csrf @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3"><i class="bi bi-trash"></i></button>
                </form>
              </div>
            </td>
          </tr>
          @empty
          <tr><td colspan="7" class="text-center py-5" style="color:var(--text-muted)"><i class="bi bi-people display-5 d-block mb-2" style="opacity:.3"></i>No users found.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
    @if($data->hasPages())
    <div class="p-3 border-top" style="border-color:var(--border-color)!important">{{ $data->links() }}</div>
    @endif
  </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bg-card border-color">
      <div class="modal-header border-0"><h5 class="modal-title fw-bold" style="color:var(--text-main)"><i class="bi bi-person-plus me-2" style="color:var(--primary)"></i>Add New User</h5><button type="button" class="btn-close" data-bs-dismiss="modal" style="filter:invert(1) opacity(.5)"></button></div>
      <div class="modal-body">
        <form action="{{ route('admin.users.store') }}" method="POST">
          @csrf
          <div class="mb-3"><label class="form-label">Full Name</label><input type="text" name="name" class="form-control" required></div>
          <div class="mb-3"><label class="form-label">Email</label><input type="email" name="email" class="form-control" required></div>
          <div class="mb-3"><label class="form-label">Role</label><select name="role" class="form-select"><option value="customer">Customer</option><option value="agent">Agent</option><option value="super_admin">Super Admin</option></select></div>
          <div class="mb-3"><label class="form-label">Password</label><input type="password" name="password" class="form-control" required></div>
          <div class="mb-3"><label class="form-label">Confirm Password</label><input type="password" name="password_confirmation" class="form-control" required></div>
          <div class="d-flex gap-2 mt-3"><button type="submit" class="btn btn-primary rounded-pill px-4 flex-fill">Create User</button><button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Cancel</button></div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bg-card border-color">
      <div class="modal-header border-0"><h5 class="modal-title fw-bold" style="color:var(--text-main)"><i class="bi bi-pencil-square me-2 text-warning"></i>Edit User</h5><button type="button" class="btn-close" data-bs-dismiss="modal" style="filter:invert(1) opacity(.5)"></button></div>
      <div class="modal-body">
        <form id="editUserForm" action="" method="POST">
          @csrf @method('PUT')
          <div class="mb-3"><label class="form-label">Full Name</label><input type="text" name="name" id="editName" class="form-control" required></div>
          <div class="mb-3"><label class="form-label">Email</label><input type="email" name="email" id="editEmail" class="form-control" required></div>
          <div class="mb-3"><label class="form-label">Role</label><select name="role" id="editRole" class="form-select"><option value="customer">Customer</option><option value="agent">Agent</option><option value="super_admin">Super Admin</option></select></div>
          <div class="mb-3"><label class="form-label">Status</label><select name="status" id="editStatus" class="form-select"><option value="active">Active</option><option value="inactive">Inactive</option></select></div>
          <div class="mb-3"><label class="form-label">New Password <small class="text-muted">(leave blank to keep)</small></label><input type="password" name="password" class="form-control"></div>
          <div class="d-flex gap-2 mt-3"><button type="submit" class="btn btn-warning rounded-pill px-4 flex-fill text-dark fw-semibold">Update User</button><button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Cancel</button></div>
        </form>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script>
document.getElementById('editUserModal').addEventListener('show.bs.modal', function(e) {
  const btn = e.relatedTarget;
  document.getElementById('editName').value = btn.dataset.name;
  document.getElementById('editEmail').value = btn.dataset.email;
  document.getElementById('editRole').value = btn.dataset.role;
  document.getElementById('editStatus').value = btn.dataset.status;
  document.getElementById('editUserForm').action = '/admin/users/' + btn.dataset.id;
});
</script>
@endpush
@endsection
