<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Transaction;

class TransactionController extends Controller {
    public function index() {
        $data = Transaction::with(['user', 'property'])->latest()->paginate(15);
        return view("dashboards.admin.transactions.index", compact('data'));
    }
}
