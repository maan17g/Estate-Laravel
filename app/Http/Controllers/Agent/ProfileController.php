<?php
namespace App\Http\Controllers\Agent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller {
    public function edit() {
        return view("dashboards.agent.profile.index");
    }
    public function update(Request $request) {
        $user = auth()->user();
        $request->validate(['name' => 'required', 'email' => 'required|email']);
        $user->update(['name' => $request->name, 'email' => $request->email]);
        if ($request->filled('password')) {
            $user->update(['password' => Hash::make($request->password)]);
        }
        if ($user->agent) {
            $user->agent->update($request->only(['phone','specialization','bio','license','experience']));
        }
        return back()->with('success', 'Profile updated successfully.');
    }
}
