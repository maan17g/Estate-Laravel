<?php
namespace App\Http\Controllers\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;

class AppointmentController extends Controller {
    public function index() {
        $data = Appointment::with(['property', 'property.agent'])
            ->where('customer_id', auth()->id())
            ->latest()->paginate(15);
        return view("dashboards.customer.appointments.index", compact('data'));
    }
    public function store(Request $request) {
        $request->validate(['property_id' => 'required', 'appointment_date' => 'required|date|after:today']);
        Appointment::create([
            'customer_id' => auth()->id(),
            'property_id' => $request->property_id,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'note' => $request->note,
            'status' => 'pending',
        ]);
        return back()->with('success', 'Viewing request submitted. The agent will confirm shortly.');
    }
}
