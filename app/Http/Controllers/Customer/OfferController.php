<?php
namespace App\Http\Controllers\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Offer;

class OfferController extends Controller {
    public function index() {
        $data = Offer::with(['property'])->where('buyer_id', auth()->id())->latest()->paginate(15);
        return view("dashboards.customer.offers.index", compact('data'));
    }
    public function store(Request $request) {
        $request->validate(['property_id' => 'required', 'amount' => 'required|numeric']);
        Offer::create(['buyer_id' => auth()->id(), 'property_id' => $request->property_id, 'amount' => $request->amount, 'status' => 'pending']);
        return back()->with('success', 'Offer submitted successfully.');
    }
}
