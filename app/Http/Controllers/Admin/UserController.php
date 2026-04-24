<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller {
    public function index(Request $request) {
        $query = User::query();
        if ($request->search) {
            $query->where('name', 'like', "%{$request->search}%")
                  ->orWhere('email', 'like', "%{$request->search}%");
        }
        if ($request->status) {
            $query->where('status', $request->status);
        }
        if ($request->role) {
            $query->role($request->role);
        }
        $data = $query->latest()->paginate(15)->withQueryString();
        return view("dashboards.admin.users.index", compact('data'));
    }
    public function create() { return view("dashboards.admin.users.index"); }
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
            'role' => 'required|in:customer,agent,super_admin',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => 'active',
        ]);
        $user->assignRole($request->role);
        return back()->with('success', 'User created successfully.');
    }
    public function show($id) { return back(); }
    public function edit($id) { return back(); }
    public function update(Request $request, $id) {
        $user = User::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);
        $data = ['name' => $request->name, 'email' => $request->email, 'status' => $request->status ?? 'active'];
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }
        $user->update($data);
        if ($request->role) {
            $user->syncRoles([$request->role]);
        }
        return back()->with('success', 'User updated successfully.');
    }
    public function destroy($id) {
        User::findOrFail($id)->delete();
        return back()->with('success', 'User deleted.');
    }
    public function approve($id) { return back()->with('success', 'Approved'); }
    public function verify($id) { return back()->with('success', 'Verified'); }
}
