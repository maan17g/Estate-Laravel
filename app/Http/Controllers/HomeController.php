<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;

class HomeController extends Controller
{
    public function index()
    {
        // Load featured properties for the homepage
        $featuredProperties = Property::with(['images', 'type', 'location'])
            ->where('published', true)
            ->where('featured', true)
            ->where('status_id', 1) // Assuming 1 is 'Available'
            ->take(6)
            ->get();
            
        return view('pages.home', compact('featuredProperties'));
    }
}
