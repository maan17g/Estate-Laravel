<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ==========================================
// 1. PUBLIC ROUTES (No Login Required)
// ==========================================
Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/properties', [\App\Http\Controllers\PropertyController::class, 'index'])->name('properties.index');
Route::get('/properties/search', [\App\Http\Controllers\PropertyController::class, 'search'])->name('properties.search');
Route::get('/properties/{slug}', [\App\Http\Controllers\PropertyController::class, 'show'])->name('properties.show');

Route::get('/agents', [\App\Http\Controllers\AgentController::class, 'index'])->name('agents.index');
Route::get('/agents/{id}', [\App\Http\Controllers\AgentController::class, 'show'])->name('agents.show');

Route::get('/contact', [\App\Http\Controllers\ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [\App\Http\Controllers\ContactController::class, 'submit'])->name('contact.submit');

Route::get('/about', [\App\Http\Controllers\PageController::class, 'about'])->name('about');
Route::get('/privacy', [\App\Http\Controllers\PageController::class, 'privacy'])->name('privacy');
Route::get('/terms', [\App\Http\Controllers\PageController::class, 'terms'])->name('terms');

Route::get('/blog', [\App\Http\Controllers\BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [\App\Http\Controllers\BlogController::class, 'show'])->name('blog.show');


// ==========================================
// 2. AUTH ROUTES (Guest Only)
// ==========================================
Route::middleware('guest')->group(function () {
    Route::get('/login', [\App\Http\Controllers\Auth\AuthController::class, 'loginForm'])->name('login');
    Route::post('/login', [\App\Http\Controllers\Auth\AuthController::class, 'login']);
    
    Route::get('/register', [\App\Http\Controllers\Auth\AuthController::class, 'registerForm'])->name('register');
    Route::post('/register', [\App\Http\Controllers\Auth\AuthController::class, 'register']);
    
    Route::get('/forgot-password', [\App\Http\Controllers\Auth\PasswordController::class, 'form'])->name('password.request');
    Route::post('/forgot-password', [\App\Http\Controllers\Auth\PasswordController::class, 'send'])->name('password.email');
    Route::get('/reset-password/{token}', [\App\Http\Controllers\Auth\PasswordController::class, 'resetForm'])->name('password.reset');
    Route::post('/reset-password', [\App\Http\Controllers\Auth\PasswordController::class, 'reset'])->name('password.update');
});

// Logout is accessible if authenticated
Route::post('/logout', [\App\Http\Controllers\Auth\AuthController::class, 'logout'])->middleware('auth')->name('logout');


// ==========================================
// 3. SECURE ROUTES (Requires Authentication)
// ==========================================
Route::middleware(['auth'])->group(function () {
    
    // ------------------------------------------
    // A. CUSTOMER ROUTES
    // ------------------------------------------
    Route::middleware(['role:customer'])->prefix('customer')->name('customer.')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\Customer\DashboardController::class, 'index'])->name('dashboard');
        
        Route::get('/favorites', [\App\Http\Controllers\Customer\FavoriteController::class, 'index'])->name('favorites.index');
        Route::post('/favorites/{id}', [\App\Http\Controllers\Customer\FavoriteController::class, 'toggle'])->name('favorites.toggle');
        
        Route::get('/inquiries', [\App\Http\Controllers\Customer\InquiryController::class, 'index'])->name('inquiries.index');
        Route::post('/inquiries', [\App\Http\Controllers\Customer\InquiryController::class, 'store'])->name('inquiries.store');
        
        Route::get('/appointments', [\App\Http\Controllers\Customer\AppointmentController::class, 'index'])->name('appointments.index');
        Route::post('/appointments', [\App\Http\Controllers\Customer\AppointmentController::class, 'store'])->name('appointments.store');
        
        Route::get('/offers', [\App\Http\Controllers\Customer\OfferController::class, 'index'])->name('offers.index');
        Route::post('/offers', [\App\Http\Controllers\Customer\OfferController::class, 'store'])->name('offers.store');
        
        Route::get('/rental', [\App\Http\Controllers\Customer\TenantController::class, 'index'])->name('rental.index');
        Route::get('/profile', [\App\Http\Controllers\Customer\ProfileController::class, 'edit'])->name('profile.edit');
    });

    // ------------------------------------------
    // B. AGENT ROUTES
    // ------------------------------------------
    Route::middleware(['role:agent'])->prefix('agent')->name('agent.')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\Agent\DashboardController::class, 'index'])->name('dashboard');
        
        Route::resource('properties', \App\Http\Controllers\Agent\PropertyController::class);
        
        Route::get('/inquiries', [\App\Http\Controllers\Agent\InquiryController::class, 'index'])->name('inquiries.index');
        Route::post('/inquiries/{id}/reply', [\App\Http\Controllers\Agent\InquiryController::class, 'reply'])->name('inquiries.reply');
        
        Route::get('/appointments', [\App\Http\Controllers\Agent\AppointmentController::class, 'index'])->name('appointments.index');
        Route::put('/appointments/{id}', [\App\Http\Controllers\Agent\AppointmentController::class, 'update'])->name('appointments.update');
        
        Route::get('/offers', [\App\Http\Controllers\Agent\OfferController::class, 'index'])->name('offers.index');
        Route::post('/offers/{id}/accept', [\App\Http\Controllers\Agent\OfferController::class, 'accept'])->name('offers.accept');
        
        Route::get('/tenants', [\App\Http\Controllers\Agent\TenantController::class, 'index'])->name('tenants.index');
        Route::get('/profile', [\App\Http\Controllers\Agent\ProfileController::class, 'edit'])->name('profile.edit');
    });

    // ------------------------------------------
    // C. SUPER ADMIN ROUTES
    // ------------------------------------------
    Route::middleware(['role:super_admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
        
        Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
        
        Route::get('/properties', [\App\Http\Controllers\Admin\PropertyController::class, 'index'])->name('properties.index');
        Route::post('/properties/{id}/approve', [\App\Http\Controllers\Admin\PropertyController::class, 'approve'])->name('properties.approve');
        
        Route::get('/agents', [\App\Http\Controllers\Admin\AgentController::class, 'index'])->name('agents.index');
        Route::post('/agents/{id}/verify', [\App\Http\Controllers\Admin\AgentController::class, 'verify'])->name('agents.verify');
        
        Route::get('/transactions', [\App\Http\Controllers\Admin\TransactionController::class, 'index'])->name('transactions.index');
        Route::get('/reports', [\App\Http\Controllers\Admin\ReportController::class, 'index'])->name('reports.index');
        Route::get('/activity-logs', [\App\Http\Controllers\Admin\LogController::class, 'index'])->name('logs.index');
        Route::match(['get', 'post'], '/settings', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
        
        Route::get('/inquiries', [\App\Http\Controllers\Admin\InquiryController::class, 'index'])->name('inquiries.index');
        Route::get('/blog', [\App\Http\Controllers\Admin\BlogController::class, 'index'])->name('blog.index');
    });

});
