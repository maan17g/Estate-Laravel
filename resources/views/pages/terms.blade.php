@extends('layouts.app')
@section('content')
<main style="padding-top:120px; padding-bottom:80px; background:var(--bg-body);">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <h1 style="color:var(--text-main);font-weight:800;font-size:2.2rem" class="mb-2">Terms of Service</h1>
        <p style="color:var(--text-muted)" class="mb-5">Last updated: April 2025</p>
        @foreach([
          ['Acceptance of Terms','By accessing or using Dream Home Real Estate, you agree to be bound by these Terms of Service. If you do not agree to all the terms, please do not use our platform.'],
          ['Use of Platform','You agree to use our platform only for lawful purposes and in a way that does not infringe the rights of others. You must not misuse or interfere with our services.'],
          ['User Accounts','You are responsible for maintaining the confidentiality of your account credentials. You agree to notify us immediately of any unauthorized access to your account.'],
          ['Property Listings','All property listings are provided in good faith. Dream Home does not guarantee the accuracy of listing information and recommends independent verification before any transaction.'],
          ['Agent Verification','While we verify our agents, Dream Home does not guarantee the performance or conduct of any agent. Users engage with agents at their own discretion.'],
          ['Limitation of Liability','Dream Home Real Estate shall not be liable for any indirect, incidental, or consequential damages arising from your use of the platform.'],
          ['Changes to Terms','We reserve the right to modify these terms at any time. Continued use of the platform after changes constitutes acceptance of the revised terms.'],
        ] as $s)
        <div class="mb-4 p-4 rounded-4" style="background:var(--form-bg);border:1px solid var(--border-color)">
          <h5 style="color:var(--text-main);font-weight:700" class="mb-2">{{ $s[0] }}</h5>
          <p style="color:var(--text-muted);line-height:1.8;margin:0">{{ $s[1] }}</p>
        </div>
        @endforeach
        <div class="mt-4 p-4 rounded-4" style="background:rgba(60,181,124,.08);border:1px solid rgba(60,181,124,.2)">
          <p style="color:var(--text-main);margin:0">For questions about these terms, contact us at <a href="mailto:legal@dreamhome.com" style="color:var(--primary)">legal@dreamhome.com</a></p>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection
