<?php
namespace App\Http\Controllers\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller {
    public function edit() {
        return view("dashboards.customer.profile.index");
    }
    public function update(Request $request) {
        $request->validate(['name' => 'required', 'email' => 'required|email']);
        $user = auth()->user();
        $user->update(['name' => $request->name, 'email' => $request->email]);
        if ($request->filled('password')) {
            $user->update(['password' => Hash::make($request->password)]);
        }
        return back()->with('success', 'Profile updated successfully.');
    }
}
