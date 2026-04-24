<?php
namespace App\Http\Controllers\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;

class FavoriteController extends Controller {
    public function index() {
        $data = auth()->user()->favorites()->with(['images'])->paginate(12);
        return view("dashboards.customer.favorites.index", compact('data'));
    }
    public function toggle($id) {
        $user = auth()->user();
        $user->favorites()->toggle($id);
        return back()->with('success', 'Favorites updated.');
    }
}
