<?php
namespace App\Http\Controllers\Customer;
use App\Http\Controllers\Controller;
use App\Models\Tenant;

class TenantController extends Controller {
    public function index() {
        $tenant = Tenant::with('property')->where('user_id', auth()->id())->first();
        return view("dashboards.customer.rental.index", compact('tenant'));
    }
}
