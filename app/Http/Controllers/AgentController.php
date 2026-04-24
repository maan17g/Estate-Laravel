<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Agent;

class AgentController extends Controller {
    public function index() {
        $agents = Agent::with('user', 'agency')->paginate(12);
        return view('agents.index', compact('agents'));
    }
    public function show($id) {
        $agent = Agent::with('user', 'properties', 'reviews.reviewer')->findOrFail($id);
        return view('agents.show', compact('agent'));
    }
}