<?php
namespace App\Http\Controllers\Agent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Offer;

class OfferController extends Controller {
    public function index() {
        $agentId = auth()->user()->agent?->id;
        $data = $agentId
            ? Offer::with(['buyer', 'property'])
                ->whereHas('property', fn($q) => $q->where('agent_id', $agentId))
                ->latest()->paginate(15)
            : collect();
        return view("dashboards.agent.offers.index", compact('data'));
    }
    public function accept($id) {
        Offer::findOrFail($id)->update(['status' => 'accepted']);
        return back()->with('success', 'Offer accepted successfully.');
    }
}
