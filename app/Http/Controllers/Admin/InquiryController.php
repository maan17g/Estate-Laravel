<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Inquiry;

class InquiryController extends Controller {
    public function index() {
        $data = Inquiry::with(['inquirer', 'property'])->latest()->paginate(15);
        return view("dashboards.admin.inquiries.index", compact('data'));
    }
}
