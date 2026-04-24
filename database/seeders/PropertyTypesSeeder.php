<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PropertyTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            ['name' => 'Apartment', 'icon' => 'fas fa-building', 'description' => 'A residential unit in a multi-unit building.'],
            ['name' => 'Villa', 'icon' => 'fas fa-home', 'description' => 'A luxurious independent house with private grounds.'],
            ['name' => 'Townhouse', 'icon' => 'fas fa-city', 'description' => 'A multi-floor home that shares one to two walls with adjacent properties.'],
            ['name' => 'Penthouse', 'icon' => 'fas fa-star', 'description' => 'A luxury apartment on the highest floor of a building.'],
            ['name' => 'Office', 'icon' => 'fas fa-briefcase', 'description' => 'Commercial space designed for business operations.'],
            ['name' => 'Shop', 'icon' => 'fas fa-store', 'description' => 'Retail space for commercial activities.'],
            ['name' => 'Warehouse', 'icon' => 'fas fa-warehouse', 'description' => 'Large storage facility for commercial use.'],
            ['name' => 'Farm', 'icon' => 'fas fa-tractor', 'description' => 'Agricultural land or rural property.']
        ];

        DB::table('property_types')->insert($types);
    }
}
