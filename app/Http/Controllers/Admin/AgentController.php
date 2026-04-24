<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Agent;

class AgentController extends Controller {
    public function index(Request $request) {
        $query = Agent::with(['user', 'properties']);
        if ($request->search) {
            $query->whereHas('user', fn($q) => $q->where('name', 'like', "%{$request->search}%"));
        }
        if ($request->filled('verified')) {
            $query->where('is_verified', $request->verified);
        }
        $data = $query->latest()->paginate(15)->withQueryString();
        return view("dashboards.admin.agents.index", compact('data'));
    }
    public function create() { return back(); }
    public function store(Request $request) { return back(); }
    public function show($id) { return back(); }
    public function edit($id) { return back(); }
    public function update(Request $request, $id) { return back(); }
    public function destroy($id) { return back()->with('success', 'Removed.'); }
    public function approve($id) { return back()->with('success', 'Approved'); }
    public function verify($id) {
        Agent::findOrFail($id)->update(['is_verified' => true]);
        return back()->with('success', 'Agent verified successfully.');
    }
}
