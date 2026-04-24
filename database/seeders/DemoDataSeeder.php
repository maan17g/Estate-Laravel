<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\PropertyStatus;
use Illuminate\Support\Str;

class DemoDataSeeder extends Seeder
{
    public function run()
    {
        // 1. Create a Test Agent and a Test Customer
        $agent = User::firstOrCreate(['email' => 'agent@test.com'], [
            'name' => 'James Carter',
            'phone' => '(310) 555-0100',
            'password' => bcrypt('password'),
            'status' => 'active'
        ]);
        if (!$agent->hasRole('agent')) { $agent->assignRole('agent'); }

        $customer = User::firstOrCreate(['email' => 'customer@test.com'], [
            'name' => 'John Smith',
            'phone' => '(555) 555-5555',
            'password' => bcrypt('password'),
            'status' => 'active'
        ]);
        if (!$customer->hasRole('customer')) { $customer->assignRole('customer'); }

        // 2. Create Realistic Properties
        $types = PropertyType::all();
        $statuses = PropertyStatus::all();
        
        if($types->isEmpty() || $statuses->isEmpty()) return;

        $locations = ['Beverly Hills, CA', 'Malibu, CA', 'Miami, FL', 'Manhattan, NY', 'Austin, TX', 'Aspen, CO'];
        $images = [
            'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?auto=format&fit=crop&w=800&q=80',
            'https://images.unsplash.com/photo-1628624747186-a941c476b7ef?auto=format&fit=crop&w=800&q=80',
            'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?auto=format&fit=crop&w=800&q=80',
            'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=800&q=80',
            'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=800&q=80'
        ];

        for($i = 1; $i <= 20; $i++) {
            $title = "Luxury " . $types->random()->name . " " . rand(100,999);
            $prop = Property::create([
                'title' => $title,
                'slug' => Str::slug($title) . '-' . time() . $i,
                'description' => 'A stunning property featuring incredible architectural elements, expansive living spaces, and top-tier amenities exactly matching modern luxury standards.',
                'transaction_type' => 'sale',
                'sale_price' => rand(500000, 5000000),
                'area_sqft' => rand(1500, 8000),
                'bedrooms' => rand(2, 6),
                'bathrooms' => rand(2, 5),
                'agent_id' => $agent->id,
                'property_type_id' => $types->random()->id,
                'status_id' => $statuses->random()->id,
                'published' => true,
                'featured' => rand(0, 1)
            ]);

            // Add Location
            $prop->location()->create([
                'address' => rand(1000, 9999) . ' Example Blvd',
                'city' => $locations[array_rand($locations)],
                'state' => 'CA',
                'country' => 'USA',
                'latitude' => 34.07,
                'longitude' => -118.40
            ]);

            // Add 1 Image using external URL for demo speed
            // To not bloat storage, we store external URLs directly to image_path or just override the frontend.
            // Since our system supports real storage, we'll configure frontend to default to unsplash if file missing.
        }
    }
}