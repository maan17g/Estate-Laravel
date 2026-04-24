<?php
namespace App\Http\Controllers\Agent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;

class PropertyController extends Controller {
    public function index() {
        $agentId = auth()->user()->agent?->id;
        $data = $agentId
            ? Property::where('agent_id', $agentId)->latest()->paginate(15)
            : collect();
        return view("dashboards.agent.properties.index", compact('data'));
    }
    public function create() { return view("dashboards.agent.properties.create"); }
    public function store(Request $request) {
        $request->validate(['title' => 'required', 'price' => 'required|numeric', 'type' => 'required']);
        return back()->with('success', 'Property submitted for admin review. It will go live once approved.');
    }
    public function show($id) { return back(); }
    public function edit($id) {
        $property = Property::findOrFail($id);
        return view("dashboards.agent.properties.create", compact('property'));
    }
    public function update(Request $request, $id) { return back()->with('success', 'Listing updated.'); }
    public function destroy($id) {
        Property::findOrFail($id)->delete();
        return back()->with('success', 'Listing removed.');
    }
}
