<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller {
    public function index(Request $request) {
        if ($request->isMethod('post')) {
            foreach ($request->except('_token') as $key => $val) {
                Setting::updateOrCreate(['key' => $key], ['value' => $val]);
            }
            return back()->with('success', 'Settings saved successfully.');
        }
        return view("dashboards.admin.settings.index");
    }
}
