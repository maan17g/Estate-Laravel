<?php

echo "========== GENERATING CONTROLLERS ==========\n\n";

$controllers = [
    // Public Controllers
    'HomeController',
    'PropertyController',
    'AgentController',
    'ContactController',
    'PageController',
    'BlogController',
    
    // Auth Controllers
    'Auth\AuthController',
    'Auth\PasswordController',

    // Admin Controllers
    'Admin\DashboardController',
    'Admin\UserController',
    'Admin\PropertyController',
    'Admin\AgentController',
    'Admin\TransactionController',
    'Admin\ReportController',
    'Admin\LogController',
    'Admin\SettingController',
    'Admin\InquiryController',
    'Admin\BlogController',

    // Agent Controllers
    'Agent\DashboardController',
    'Agent\PropertyController',
    'Agent\InquiryController',
    'Agent\AppointmentController',
    'Agent\OfferController',
    'Agent\TenantController',
    'Agent\ProfileController',

    // Customer Controllers
    'Customer\DashboardController',
    'Customer\FavoriteController',
    'Customer\InquiryController',
    'Customer\AppointmentController',
    'Customer\OfferController',
    'Customer\TenantController',
    'Customer\ProfileController',
];

foreach ($controllers as $controller) {
    exec("php artisan make:controller " . escapeshellarg($controller));
    echo " -> Generated Controller: $controller\n";
    usleep(200000); // Wait 0.2s
}

echo "\n========== CONTROLLERS GENERATED! ==========\n";
