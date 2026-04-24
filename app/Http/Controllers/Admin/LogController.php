<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\EmailLog;

class LogController extends Controller {
    public function index() {
        $data = collect(); // swap for real log model if available
        return view("dashboards.admin.logs.index", compact('data'));
    }
}
