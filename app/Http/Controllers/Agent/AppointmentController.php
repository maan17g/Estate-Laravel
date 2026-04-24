<?php
namespace App\Http\Controllers\Agent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;

class AppointmentController extends Controller {
    public function index() {
        $agentId = auth()->user()->agent?->id;
        $data = $agentId
            ? Appointment::with(['customer', 'property'])
                ->whereHas('property', fn($q) => $q->where('agent_id', $agentId))
                ->latest()->paginate(15)
            : collect();
        return view("dashboards.agent.appointments.index", compact('data'));
    }
    public function update(Request $request, $id) {
        Appointment::findOrFail($id)->update(['status' => $request->status]);
        return back()->with('success', 'Appointment updated.');
    }
}
