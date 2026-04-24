<?php

echo "========== RUNNING CLEANUP ==========\n\n";

// 1. Delete duplicate migrations that are conflicting with Laravel 11's default user table
$migrations = [
    '2026_04_21_055348_create_users_table.php',
    '2026_04_21_055353_create_password_reset_tokens_table.php',
    '2026_04_21_055354_create_sessions_table.php'
];

foreach ($migrations as $file) {
    $path = __DIR__ . '/database/migrations/' . $file;
    if (file_exists($path)) {
        unlink($path);
        echo " -> Deleted duplicate migration: $file\n";
    }
}

// 2. Delete the original HTML, CSS, JS files and folders that were moved
$filesToDelete = [
    'index.html',
    'login.html',
    'register.html',
    'contact.html',
    'about.html',
    'privacy.html',
    'property.html', // from looking at the earlier listing page
    'style.css',
    'script.js',
];

foreach ($filesToDelete as $file) {
    // Check in root directory
    $path = dirname(__DIR__) . '/' . $file;
    if (file_exists($path)) {
        unlink($path);
        echo " -> Deleted original file: $file\n";
    }
}

echo "\n========== CLEANUP COMPLETE! ==========\n";
echo "Now you can run: php artisan migrate:fresh --seed\n";
