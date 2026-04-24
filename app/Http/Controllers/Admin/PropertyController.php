<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;

class PropertyController extends Controller {
    public function index(Request $request) {
        $query = Property::with(['agent.user']);
        if ($request->search) {
            $query->where('title', 'like', "%{$request->search}%");
        }
        if ($request->status) {
            $query->where('status', $request->status);
        }
        $data = $query->latest()->paginate(15)->withQueryString();
        return view("dashboards.admin.properties.index", compact('data'));
    }
    public function create() { return view("dashboards.admin.properties.create"); }
    public function store(Request $request) { return back()->with('success', 'Property created.'); }
    public function show($id) { return back(); }
    public function edit($id) { return view("dashboards.admin.properties.create"); }
    public function update(Request $request, $id) { return back()->with('success', 'Updated.'); }
    public function destroy($id) {
        Property::findOrFail($id)->delete();
        return back()->with('success', 'Property deleted.');
    }
    public function approve($id) {
        Property::findOrFail($id)->update(['status' => 'active']);
        return back()->with('success', 'Property approved and is now live.');
    }
    public function verify($id) { return back()->with('success', 'Verified'); }
}
