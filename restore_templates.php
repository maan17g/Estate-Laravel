<?php

echo "========== RESTORING ORIGINAL CUSTOMER HTML TO BLADE VIEWS ==========\n";

$baseDir = __DIR__;

function restoreToBlade($sourceHtmlFile, $targetBladeFile, $isDashboard = false) {
    global $baseDir;
    $sourcePath = $baseDir . '/' . $sourceHtmlFile;
    $targetPath = $baseDir . '/resources/views/' . $targetBladeFile;

    if (!file_exists($sourcePath)) {
        echo "Missing source file: {$sourceHtmlFile}\n";
        return;
    }

    $html = file_get_contents($sourcePath);

    // Extract the <style> block
    preg_match('/<style>(.*?)<\/style>/s', $html, $styleMatch);
    $customStyles = $styleMatch ? $styleMatch[1] : '';

    // Extract everything inside <body> except Navbar and Footer
    // (We will use layouts.app but inject the main content)
    // For dashboard, the <body> has Navbar, then <div class="dashboard-wrapper">
    if ($isDashboard) {
        preg_match('/<div class="dashboard-wrapper">(.*?)<\/script>/s', $html, $bodyMatch);
        $bodyContent = $bodyMatch ? '<div class="dashboard-wrapper">' . dirname($bodyMatch[1]) . '</div>' : '';
        // Because of the script tag, let's just do a smarter extraction
        preg_match('/<div class="dashboard-wrapper">(.*?)<script src=/s', $html, $bodyMatch);
        $mainContent = $bodyMatch ? '<div class="dashboard-wrapper">' . $bodyMatch[1] : '';
        
        // Extract inner script logic
        preg_match('/<script>(.*?)<\/script>/s', $html, $scriptMatch);
        $customScripts = $scriptMatch ? $scriptMatch[1] : '';
    } else {
        // Property Detail etc. <main> tag
        preg_match('/<main>(.*?)<\/main>/s', $html, $bodyMatch);
        $mainContent = $bodyMatch ? '<main>' . $bodyMatch[1] . '</main>' : '';
        
        // Extract inner script logic
        preg_match('/<script>(.*?)<\/script>/s', $html, $scriptMatch);
        $customScripts = $scriptMatch ? $scriptMatch[1] : '';
        
        // Extract modals
        preg_match('/<!-- BOOKING MODAL -->(.*?)<!-- LIGHTBOX -->/s', $html, $modalMatch);
        $modals = $modalMatch ? $modalMatch[1] : '';
        
        preg_match('/<!-- LIGHTBOX -->(.*?)<!-- SUCCESS TOAST -->/s', $html, $lightboxMatch);
        $lightbox = $lightboxMatch ? $lightboxMatch[1] : '';
        
        $mainContent .= "\n" . $modals . "\n" . $lightbox;
        
        // Extract Breadcrumb
        preg_match('/<!-- BREADCRUMB -->(.*?)<main>/s', $html, $breadMatch);
        if ($breadMatch) {
            $mainContent = $breadMatch[1] . "\n" . $mainContent;
        }
    }

    // Convert static links to route logic safely mapping standard hrefs
    $mainContent = str_replace('href="index.html"', 'href="{{ route(\'home\') }}"', $mainContent);
    $mainContent = str_replace('href="property.html"', 'href="{{ route(\'properties.index\') }}"', $mainContent);
    $mainContent = str_replace('href="contact-us.html"', 'href="{{ route(\'contact.index\') }}"', $mainContent);
    $mainContent = str_replace('href="dashboard.html"', 'href="{{ route(\'customer.dashboard\') }}"', $mainContent);

    // Build the Blade Wrapper
    $bladeContent = <<<BLADE
@extends('layouts.app')

@section('content')
<style>
{$customStyles}
</style>

{$mainContent}

<script>
{$customScripts}
</script>
@endsection
BLADE;

    file_put_contents($targetPath, $bladeContent);
    echo "Restored {$sourceHtmlFile} -> {$targetBladeFile}\n";
}

// 1. Dashboard
restoreToBlade('dashboard.html', 'dashboards/customer/index.blade.php', true);

// 2. Favorites
restoreToBlade('favorites.html', 'dashboards/customer/favorites/index.blade.php', true);

// 3. Property Detail
restoreToBlade('property-detail.html', 'properties/show.blade.php', false);

// 4. Contact Us
restoreToBlade('contact-us.html', 'pages/contact.blade.php', false);

echo "========== RESTORATION COMPLETE ==========\n";
