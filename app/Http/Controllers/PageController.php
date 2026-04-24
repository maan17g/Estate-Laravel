<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

class PageController extends Controller {
    public function about() { return view('pages.about'); }
    public function privacy() { return view('pages.legal', ['title'=>'Privacy Policy', 'content'=>'<p>Your privacy is important to us. We collect necessary identifying data securely and exclusively use it to align you with your ultimate property viewing experiences. We never sell data to unauthorized third parties.</p><p>All data is encrypted using standard AES-256 protocols within our cloud-based infrastructure. For data takedown requests, contact compliance@dreamhome.test.</p>']); }
    public function terms() { return view('pages.legal', ['title'=>'Terms & Conditions', 'content'=>'<p>Welcome to our proprietary platform. By using our website, you agree strictly to the bounds of fair-use real estate syndication. Properties listed dynamically may vary by closing availability, and Dream Home reserves the right to accept or deny appointment requests upon preliminary vetting mechanisms.</p><p>Listing representations are strictly artistic and preliminary until standardized physical documentation is provided locally during escrows.</p>']); }
}