<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\PropertyType;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        $query = Property::with(['images', 'type', 'location', 'agent'])
            ->where('published', true);

        // Apply filters
        if ($request->filled('type')) {
            $query->whereHas('type', function($q) use ($request) {
                $q->where('name', 'LIKE', '%' . $request->type . '%');
            });
        }

        if ($request->filled('search')) {
            $query->where('title', 'LIKE', '%' . $request->search . '%')
                  ->orWhereHas('location', function($q) use ($request) {
                      $q->where('city', 'LIKE', '%' . $request->search . '%');
                  });
        }

        if ($request->filled('bedrooms')) {
            $query->where('bedrooms', '>=', $request->bedrooms);
        }

        if ($request->filled('bathrooms')) {
            $query->where('bathrooms', '>=', $request->bathrooms);
        }

        $properties = $query->latest()->paginate(12);
        
        $types = PropertyType::all();

        return view('properties.index', compact('properties', 'types'));
    }

    public function show($slug)
    {
        $property = Property::with(['images', 'type', 'location', 'agent.user', 'features', 'documents', 'floorPlans'])
            ->where('slug', $slug)
            ->where('published', true)
            ->firstOrFail();

        // Increment view count
        $property->increment('views_count');

        return view('properties.show', compact('property'));
    }

    public function search(Request $request)
    {
        return $this->index($request);
    }
}
