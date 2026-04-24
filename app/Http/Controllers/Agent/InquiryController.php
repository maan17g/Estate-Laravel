<?php
namespace App\Http\Controllers\Agent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inquiry;

class InquiryController extends Controller {
    public function index() {
        $agentId = auth()->user()->agent?->id;
        $data = $agentId
            ? Inquiry::with(['inquirer', 'property'])
                ->whereHas('property', fn($q) => $q->where('agent_id', $agentId))
                ->latest()->paginate(15)
            : collect();
        return view("dashboards.agent.inquiries.index", compact('data'));
    }
    public function reply(Request $request, $id) {
        $request->validate(['reply' => 'required|string']);
        Inquiry::findOrFail($id)->update(['reply' => $request->reply, 'status' => 'replied']);
        return back()->with('success', 'Reply sent successfully.');
    }
}
