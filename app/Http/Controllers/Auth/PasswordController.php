<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PasswordController extends Controller {
    public function form() { return view('auth.forgot-password'); }
    public function send(Request $request) { return back()->with('success', 'Reset link sent!'); }
    public function resetForm($token) { return view('auth.reset-password', compact('token')); }
    public function reset(Request $request) { return redirect()->route('login')->with('success', 'Password reset!'); }
}