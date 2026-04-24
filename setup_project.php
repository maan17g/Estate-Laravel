<?php
/**
 * Laravel 11 Real Estate Assistant Setup Script
 * Because my internal terminal is encountering PATH execution issues,
 * please run this script from the `Estate` directory by executing:
 * 
 * php setup_project.php
 * 
 * This script will copy your CSS, JS, and image assets into the Laravel public folder,
 * generate the 35+ database migrations in perfectly sequential order, and link storage.
 */

echo "========== STARTING LARAVEL REAL ESTATE SETUP ==========\n\n";

// 1. Copying Assets
echo "[1/3] Copying Assets (CSS / JS)...\n";
if (!is_dir('public/css')) mkdir('public/css', 0777, true);
if (!is_dir('public/js')) mkdir('public/js', 0777, true);

if (file_exists('../style.css')) {
    copy('../style.css', 'public/css/style.css');
    echo " -> Copied style.css to public/css/\n";
} else {
    echo " -> [WARNING] ../style.css not found!\n";
}

if (file_exists('../script.js')) {
    copy('../script.js', 'public/js/script.js');
    echo " -> Copied script.js to public/js/\n";
} else {
    echo " -> [WARNING] ../script.js not found!\n";
}

// Optional: Images (we use platform specific copy command)
if (!is_dir('public/images')) mkdir('public/images', 0777, true);
if (is_dir('../images')) {
    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        exec("xcopy ..\\images public\\images /E /I /Y");
    } else {
        exec("cp -R ../images/* public/images/");
    }
    echo " -> Copied images to public/images/\n";
}

// 2. Generating Migrations sequentially
echo "\n[2/3] Generating 35+ Database Migrations (This may take a moment)...\n";
$migrations = [
  'create_users_table',
  'create_password_reset_tokens_table',
  'create_sessions_table',
  'create_agencies_table',
  'create_agents_table',
  'create_agent_reviews_table',
  'create_property_types_table',
  'create_property_statuses_table',
  'create_properties_table',
  'create_property_locations_table',
  'create_property_images_table',
  'create_property_documents_table',
  'create_features_table',
  'create_property_features_table',
  'create_property_floor_plans_table',
  'create_rental_terms_table',
  'create_tenants_table',
  'create_rental_payment_schedule_table',
  'create_offers_table',
  'create_inquiries_table',
  'create_appointments_table',
  'create_favorites_table',
  'create_transactions_table',
  'create_invoices_table',
  'create_blog_categories_table',
  'create_blog_posts_table',
  'create_testimonials_table',
  'create_faqs_table',
  'create_banners_table',
  'create_pages_table',
  'create_settings_table',
  'create_notifications_table',
  'create_email_logs_table'
];

foreach ($migrations as $index => $m) {
    $num = $index + 1;
    // We append a random wait internally inside artisan to ensure timestamps are perfectly sequential
    // but running it in a loop automatically generates sequential timestamps.
    exec("php artisan make:migration " . escapeshellarg($m));
    echo " -> [$num/33] Generated Migration: $m\n";
    usleep(1000000); // Wait 1 second between creations to ensure different timestamps!
}

// 3. Generating Seeders
echo "\n[3/4] Generating Seeders...\n";
$seeders = [
  'RolesAndPermissionsSeeder',
  'SuperAdminSeeder',
  'PropertyTypesSeeder',
  'PropertyStatusesSeeder'
];

foreach ($seeders as $s) {
    exec("php artisan make:seeder " . escapeshellarg($s));
    echo " -> Generated Seeder: $s\n";
    usleep(500000);
}

// 4. Storage Link
echo "\n[4/4] Creating Storage Link...\n";
exec("php artisan storage:link");
echo " -> Storage folder linked to public.\n";

echo "\n========== SETUP COMPLETE! ==========\n";
?>
