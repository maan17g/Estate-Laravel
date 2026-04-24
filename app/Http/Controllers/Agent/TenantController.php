<?php
namespace App\Http\Controllers\Agent;
use App\Http\Controllers\Controller;
use App\Models\Tenant;

class TenantController extends Controller {
    public function index() {
        $agentId = auth()->user()->agent?->id;
        $data = $agentId
            ? Tenant::with(['user', 'property'])
                ->whereHas('property', fn($q) => $q->where('agent_id', $agentId))
                ->latest()->paginate(15)
            : collect();
        return view("dashboards.agent.tenants.index", compact('data'));
    }
}
