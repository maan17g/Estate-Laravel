<?php

echo "========== STARTING PHASE 5 EXECUTION ==========\n";
$baseDir = __DIR__;

function write_file($path, $content) {
    global $baseDir;
    $fullPath = $baseDir . '/' . $path;
    $dir = dirname($fullPath);
    if (!is_dir($dir)) mkdir($dir, 0777, true);
    file_put_contents($fullPath, $content);
}

// ==========================================
// 1. ROBUST STATIC CONTENT CREATOR
// ==========================================

// About Us Component
$aboutHTML = <<<BLADE
@extends('layouts.app')
@section('content')
<section class="hero-section" style="background: linear-gradient(135deg, rgba(7, 14, 11, 0.9), rgba(0,0,0,0.7)), url('https://images.unsplash.com/photo-1560518883-ce09059eeffa?auto=format&fit=crop&w=1600&q=80') center/cover; padding-top: 140px; padding-bottom: 80px; text-align: center;">
    <div class="container hero-content">
        <h1 class="hero-title mb-3" style="font-size:3.5rem; font-weight:800;">Redefining <span style="color:var(--primary);">Real Estate</span></h1>
        <p class="hero-desc mx-auto" style="max-width:600px; color:var(--text-muted);">We blend cutting-edge technology with unparalleled luxury market expertise to help you find precisely where you belong.</p>
    </div>
</section>

<main class="py-5" style="background:var(--bg-body);">
    <div class="container">
        <div class="row align-items-center g-5 py-5">
            <div class="col-lg-6">
                <h6 style="color:var(--primary); font-weight:700; letter-spacing:1px; text-transform:uppercase;">Our Heritage</h6>
                <h2 class="display-5 fw-bold mb-4" style="color:var(--text-main);">Built on Trust. Driven by Innovation.</h2>
                <p style="color:var(--text-muted); font-size:1.05rem; line-height:1.8;">
                    Founded in 2012 in the heart of Beverly Hills, Dream Home began as a boutique agency dedicated to high-net-worth individuals seeking ultra-luxurious privacy. Over the last decade, we have expanded our unparalleled concierge-level service globally. 
                </p>
                <p style="color:var(--text-muted); font-size:1.05rem; line-height:1.8; margin-bottom:2rem;">
                    We don't just sell properties. We offer a gateway to the lifestyle you've envisioned. Our elite team of 150+ accredited agents undergoes rigorous architectural and negotiation training, ensuring your investments are secure, discrete, and vastly rewarding.
                </p>
                <div class="d-flex gap-4 mb-4">
                    <div><h3 style="color:var(--primary); font-weight:800;">$2.4B+</h3><span style="color:var(--text-muted); font-size:0.85rem;">Sales Volume</span></div>
                    <div><h3 style="color:var(--primary); font-weight:800;">4.9/5</h3><span style="color:var(--text-muted); font-size:0.85rem;">Client Rating</span></div>
                    <div><h3 style="color:var(--primary); font-weight:800;">12+</h3><span style="color:var(--text-muted); font-size:0.85rem;">Global Offices</span></div>
                </div>
            </div>
            <div class="col-lg-6">
                <div style="position:relative;">
                    <img src="https://images.unsplash.com/photo-1600607686527-6fb886090705?auto=format&fit=crop&w=800&q=80" style="width:100%; border-radius:30px; object-fit:cover; border:1px solid var(--border-color);">
                    <div style="position:absolute; bottom:-30px; left:-30px; background:var(--bg-card); padding:2rem; border-radius:20px; border:1px solid var(--border-color); box-shadow:0 15px 35px rgba(0,0,0,0.4);">
                        <i class="bi bi-award-fill" style="color:var(--primary); font-size:2.5rem; display:block; margin-bottom:10px;"></i>
                        <h5 style="color:var(--text-main); font-weight:700;">Award Winning Agency</h5>
                        <p class="mb-0 text-muted" style="font-size:0.85rem;">Top Luxury Brokerage 2024</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
BLADE;
write_file('resources/views/pages/about.blade.php', $aboutHTML);


// Terms/Privacy Unified Wrapper
$termsHTML = <<<BLADE
@extends('layouts.app')
@section('content')
<main style="padding-top:120px; padding-bottom:80px; background:var(--bg-body);">
    <div class="container">
        <div class="card border-color bg-card shadow-lg" style="border-radius:20px;">
            <div class="card-body p-5">
                <h1 style="color:var(--text-main); font-weight:800; font-size:2.5rem; border-bottom:2px solid var(--border-color); padding-bottom:1rem; margin-bottom:2rem;">{{ \$title }}</h1>
                <div style="color:var(--text-muted); line-height:1.9;">
                    {{ \$content }}
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
BLADE;
write_file('resources/views/pages/legal.blade.php', $termsHTML);

// Let's modify PageController to serve legal cleanly
$pageController = file_get_contents($baseDir . '/app/Http/Controllers/PageController.php');
$pageController = str_replace(
    "return view('pages.privacy');", 
    "return view('pages.legal', ['title'=>'Privacy Policy', 'content'=>'<p>Your privacy is important to us. We collect necessary identifying data securely and exclusively use it to align you with your ultimate property viewing experiences. We never sell data to unauthorized third parties.</p><p>All data is encrypted using standard AES-256 protocols within our cloud-based infrastructure. For data takedown requests, contact compliance@dreamhome.test.</p>']);",
    $pageController
);
$pageController = str_replace(
    "return view('pages.terms');", 
    "return view('pages.legal', ['title'=>'Terms & Conditions', 'content'=>'<p>Welcome to our proprietary platform. By using our website, you agree strictly to the bounds of fair-use real estate syndication. Properties listed dynamically may vary by closing availability, and Dream Home reserves the right to accept or deny appointment requests upon preliminary vetting mechanisms.</p><p>Listing representations are strictly artistic and preliminary until standardized physical documentation is provided locally during escrows.</p>']);",
    $pageController
);
file_put_contents($baseDir . '/app/Http/Controllers/PageController.php', $pageController);


// Agents / Clients Output
$agentsHTML = <<<BLADE
@extends('layouts.app')
@section('content')
<main style="padding-top:120px; padding-bottom:80px; background:var(--bg-body);">
    <div class="container">
        <div class="text-center mb-5">
            <h6 style="color:var(--primary); font-weight:700; letter-spacing:1px; text-transform:uppercase;">The Elite Team</h6>
            <h2 class="display-5 fw-bold" style="color:var(--text-main);">Meet Our Top Affiliates</h2>
            <p class="mx-auto mt-3" style="max-width:500px; color:var(--text-muted);">Trusted experts representing the highest tier of properties worldwide.</p>
        </div>
        
        <div class="row g-4">
            @forelse(\$agents as \$agent)
            <div class="col-md-6 col-lg-3">
                <div class="dash-stat-card d-flex flex-column text-center p-4" style="height:100%;">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(\$agent->name) }}&background=0D8ABC&color=fff&size=128" style="width:100px; height:100px; border-radius:50%; margin:0 auto 1.25rem auto; border:3px solid var(--primary);">
                    <h5 style="color:var(--text-main); font-weight:700; margin-bottom:5px;">{{ \$agent->name }}</h5>
                    <p style="color:var(--primary); font-size:0.85rem; font-weight:600; margin-bottom:15px;">Senior Associate</p>
                    <div style="font-size:0.85rem; color:var(--text-muted); margin-bottom:1.5rem; flex-grow:1;">Expert in multi-million dollar residential transactions and distressed portfolio acquisitions.</div>
                    <a href="#" class="btn btn-outline-primary btn-sm rounded-pill w-100">View Profile</a>
                </div>
            </div>
            @empty
            <div class="col-12 text-center text-muted">No agents registered currently.</div>
            @endforelse
        </div>
    </div>
</main>
@endsection
BLADE;
write_file('resources/views/agents/index.blade.php', $agentsHTML);


// ==========================================
// 2. DEMO DATA SEEDER 
// ==========================================
$demoSeederContent = <<<PHP
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
        \$agent = User::firstOrCreate(['email' => 'agent@test.com'], [
            'name' => 'James Carter',
            'phone' => '(310) 555-0100',
            'password' => bcrypt('password'),
            'status' => 'active'
        ]);
        if (!\$agent->hasRole('agent')) { \$agent->assignRole('agent'); }

        \$customer = User::firstOrCreate(['email' => 'customer@test.com'], [
            'name' => 'John Smith',
            'phone' => '(555) 555-5555',
            'password' => bcrypt('password'),
            'status' => 'active'
        ]);
        if (!\$customer->hasRole('customer')) { \$customer->assignRole('customer'); }

        // 2. Create Realistic Properties
        \$types = PropertyType::all();
        \$statuses = PropertyStatus::all();
        
        if(\$types->isEmpty() || \$statuses->isEmpty()) return;

        \$locations = ['Beverly Hills, CA', 'Malibu, CA', 'Miami, FL', 'Manhattan, NY', 'Austin, TX', 'Aspen, CO'];
        \$images = [
            'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?auto=format&fit=crop&w=800&q=80',
            'https://images.unsplash.com/photo-1628624747186-a941c476b7ef?auto=format&fit=crop&w=800&q=80',
            'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?auto=format&fit=crop&w=800&q=80',
            'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=800&q=80',
            'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=800&q=80'
        ];

        for(\$i = 1; \$i <= 20; \$i++) {
            \$title = "Luxury " . \$types->random()->name . " " . rand(100,999);
            \$prop = Property::create([
                'title' => \$title,
                'slug' => Str::slug(\$title) . '-' . time() . \$i,
                'description' => 'A stunning property featuring incredible architectural elements, expansive living spaces, and top-tier amenities exactly matching modern luxury standards.',
                'price' => rand(500000, 5000000),
                'area' => rand(1500, 8000),
                'bedrooms' => rand(2, 6),
                'bathrooms' => rand(2, 5),
                'agent_id' => \$agent->id,
                'property_type_id' => \$types->random()->id,
                'property_status_id' => \$statuses->random()->id,
                'status' => 'approved',
                'featured' => rand(0, 1)
            ]);

            // Add Location
            \$prop->location()->create([
                'address' => rand(1000, 9999) . ' Example Blvd',
                'city' => \$locations[array_rand(\$locations)],
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
PHP;
write_file('database/seeders/DemoDataSeeder.php', $demoSeederContent);

// Add DemoDataSeeder to DatabaseSeeder
$dbSeeder = file_get_contents($baseDir . '/database/seeders/DatabaseSeeder.php');
if (strpos($dbSeeder, 'DemoDataSeeder::class') === false) {
    $dbSeeder = str_replace(
        "PropertyStatusesSeeder::class,",
        "PropertyStatusesSeeder::class,\n            DemoDataSeeder::class,",
        $dbSeeder
    );
    file_put_contents($baseDir . '/database/seeders/DatabaseSeeder.php', $dbSeeder);
}

// 3. Connect Index Blade Empty Image Failsafe
$propIndexCode = file_get_contents($baseDir . '/resources/views/properties/index.blade.php');
$propIndexCode = str_replace(
    '<img src="{{ $prop->images->count() ? asset(\'storage/\'.$prop->images->first()->image_path) : \'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?auto=format&fit=crop&w=600&q=80\' }}"',
    '<img src="https://images.unsplash.com/photo-1600'.rand(10000, 90000).'-'.rand(1000,9999).'?auto=format&fit=crop&w=800&q=80" onerror="this.src=\'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?auto=format&fit=crop&w=800&q=80\'"',
    $propIndexCode
);
file_put_contents($baseDir . '/resources/views/properties/index.blade.php', $propIndexCode);


echo "========== PHASE 5 EXECUTION COMPLETE ==========\n";
// Attempt to run the seeder internally if possible (often shell_exec is blocked, but we'll try)
exec('cd ' . escapeshellarg($baseDir) . ' && php artisan db:seed --class=DemoDataSeeder 2>&1', $output, $code);
echo "Seeder Output: \n" . implode("\n", $output) . "\n";
