<?php
namespace App\Http\Controllers\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inquiry;

class InquiryController extends Controller {
    public function index() {
        $data = Inquiry::with(['property'])->where('inquirer_id', auth()->id())->latest()->paginate(15);
        return view("dashboards.customer.inquiries.index", compact('data'));
    }
    public function store(Request $request) {
        $request->validate(['property_id' => 'required', 'message' => 'required']);
        Inquiry::create([
            'inquirer_id' => auth()->id(),
            'property_id' => $request->property_id,
            'message' => $request->message,
            'status' => 'open',
        ]);
        return back()->with('success', 'Inquiry sent successfully.');
    }
}
