<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PropertyStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            ['name' => 'Available', 'color_code' => '#3cb57c'], // Primary green
            ['name' => 'Sold', 'color_code' => '#e74c3c'],      // Red
            ['name' => 'Rented', 'color_code' => '#3498db'],    // Blue
            ['name' => 'Pending', 'color_code' => '#f39c12'],   // Orange
            ['name' => 'Inactive', 'color_code' => '#95a5a6']   // Gray
        ];

        DB::table('property_statuses')->insert($statuses);
    }
}
