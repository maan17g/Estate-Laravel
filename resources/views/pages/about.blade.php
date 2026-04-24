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