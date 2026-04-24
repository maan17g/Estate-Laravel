@extends('layouts.app')

@section('content')
  <main>
    <!-- HERO -->
    <section class="hero-section">
      <div class="hero-bg"></div>
      <div class="hero-overlay"></div>
      <div class="container hero-content">
        <div class="col-lg-8">
          <div class="trust-badge">
            <span class="trust-dot"></span> Trusted by 5,000+ Happy Homeowners
          </div>
          <h1 class="hero-title mb-3">Find your Perfect <br><span>Dream Home</span></h1>
          <p class="hero-desc">Explore verified listings, get expert guidance, and find the property that fits your lifestyle perfectly.</p>
        </div>
      </div>
    </section>

    <!-- SEARCH FORM -->
    <section class="search-container">
      <div class="container">
        <form class="hero-form" action="#">
          <div class="row g-3 align-items-end">
            <div class="col-12 col-md-3">
              <label class="form-label text-muted-custom small">Type</label>
              <select class="form-select">
                <option selected>Apartment</option>
                <option>Villa</option>
                <option>Office</option>
              </select>
            </div>
            <div class="col-12 col-md-3">
              <label class="form-label text-muted-custom small">Category</label>
              <select class="form-select">
                <option selected>Residential</option>
                <option>Commercial</option>
                <option>Industrial</option>
              </select>
            </div>
            <div class="col-12 col-md-3">
              <label class="form-label text-muted-custom small">Location</label>
              <select class="form-select">
                <option selected>New York, USA</option>
                <option>London, UK</option>
                <option>Berlin, DE</option>
              </select>
            </div>
            <div class="col-12 col-md-3">
              <button type="button" class="btn-search"><i class="bi bi-search"></i> Search Now</button>
            </div>
          </div>
        </form>
      </div>
    </section>

    <!-- FEATURED PROPERTIES -->
    <section class="feature-property">
      <div class="container">
        <div class="text-start mb-3">
          <h6 class="text-primary-custom text-uppercase letter-spacing-2 fw-bold">Featured Listings</h6>
          <h2 class="display-6 fw-bold">Recently Added Luxury Homes</h2>
        </div>
        <div class="row g-4 justify-content-center cont-prop">
          <!-- Loaded by JS -->
        </div>
      </div>
    </section>

    <!-- ABOUT SNIPPET -->
    <section class="about-section">
      <div class="container">
        <div class="row align-items-center gy-5">
          <div class="col-lg-6">
            <h6 class="text-primary-custom text-uppercase letter-spacing-2 fw-bold">Who are we</h6>
            <h2 class="display-6 fw-bold mb-4">Assisting individuals in locating the appropriate Real Estate</h2>
            <p class="text-muted-custom mb-4">
              We guide you through every step of your home-finding journey, offering trusted insights, verified listings, and a smooth decision-making experience.
            </p>
            <div class="row g-3">
              <div class="col-md-6">
                <div class="feature-box">
                  <div class="icon-box"><i class="fas fa-home fa-2x"></i></div>
                  <h5 class="fw-bold mb-2">Smart Matching</h5>
                  <p class="small text-muted-custom mb-0">We analyze your needs and match you with homes that fit your lifestyle.</p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="feature-box">
                  <div class="icon-box"><i class="fas fa-certificate fa-2x"></i></div>
                  <h5 class="fw-bold mb-2">Expert Guidance</h5>
                  <p class="small text-muted-custom mb-0">Clear advice, real-time support, and transparency for every property.</p>
                </div>
              </div>
            </div>
            <div class="container">
              <div class="row gap-0 gap-md-5 justify-content-between px-2 my-5">
                <div class="col-3 count d-flex align-items-center flex-column">
                  <h2 class="m-0 counter" data-bs-start="0" data-bs-end="500" data-bs-sign="+">500+</h2>
                  <span class="text-muted-custom text-center">Properties Listed</span>
                </div>
                <div class="col-3 count p-3 d-flex align-items-center flex-column">
                  <h2 class="counter" data-bs-start="0" data-bs-end="150" data-bs-sign="+">150+</h2>
                  <span class="text-muted-custom text-center">Satisfied Clients</span>
                </div>
                <div class="col-3 count p-3 d-flex align-items-center flex-column">
                  <h2 class="counter" data-bs-start="0" data-bs-end="98" data-bs-sign="%">98%</h2>
                  <span class="text-muted-custom text-center">Client Satisfaction</span>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="image-stack">
              <div class="img-blob-1">
                <img src="{{ asset('images/modern-house.jpg') }}" class="img-cover" alt="Modern House">
              </div>
              <div class="img-blob-2">
                <img src="{{ asset('images/real-estate-agent.jpg') }}" class="img-cover" alt="Real Estate Agent">
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- TESTIMONIALS -->
    <section class="testimonial-section">
      <div class="container">
        <div class="row align-items-end mb-5">
          <div class="col-lg-7">
            <span class="text-uppercase small fw-medium text-primary-custom" style="letter-spacing:3px;"><span class="section-line"></span>Perspectives</span>
            <h2 class="editorial-title">What it feels like to <br><i style="font-weight:normal;opacity:0.8;">finally</i> be home.</h2>
          </div>
          <div class="col-lg-5 text-lg-end">
            <p class="text-muted-custom mb-4" style="max-width:400px;margin-left:auto;">A collection of experiences from homeowners who redefined their lifestyle with Real Estate.</p>
          </div>
        </div>
        <div class="row g-0">
          <div class="col-lg-4">
            <div class="sleek-card">
              <p class="quote-content">"The attention to detail wasn't just in the properties, but in the way they handled our transaction. It felt like a curated introduction to our new life."</p>
              <div class="author-wrap">
                <img src="{{ asset('images/author1.jpg') }}" class="author-img" alt="Marcus">
                <div>
                  <h6 class="author-name">Marcus Alexander</h6>
                  <span class="author-label">Homeowner, Bel Air</span>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="sleek-card">
              <p class="quote-content">"Finding a space that aligns with both your aesthetic and your routine is rare. They didn't stop until every box was checked, including ones we hadn't thought of."</p>
              <div class="author-wrap">
                <img src="{{ asset('images/author2.jpg') }}" class="author-img" alt="Jessica">
                <div>
                  <h6 class="author-name">Jessica Sterling</h6>
                  <span class="author-label">Homeowner, Chelsea</span>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="sleek-card">
              <p class="quote-content">"Transparency in this market is hard to come by. Having a partner who prioritized our long-term equity over a quick sale was the reason we chose this team."</p>
              <div class="author-wrap">
                <img src="{{ asset('images/author3.jpg') }}" class="author-img" alt="Robert">
                <div>
                  <h6 class="author-name">Robert Chen</h6>
                  <span class="author-label">Investor &amp; Resident</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- CONTACT SNIPPET -->
    <section class="contact-section mb-3 p-4">
      <div class="container">
        <h6 class="text-primary-custom text-uppercase letter-spacing-2 fw-bold">Get In Touch</h6>
        <h2 class="display-6 fw-bold mb-4">Have Questions? Reach Out to Us</h2>
        <div class="row g-5">
          <div class="col-lg-5">
            <div class="row g-3">
              <div class="col-md-6">
                <div class="contact-info-card">
                  <i class="bi bi-geo-alt-fill"></i>
                  <h5>Visit Us</h5>
                  <p>9876 Wilshire Blvd, Suite 500<br>Beverly Hills, CA 90210</p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="contact-info-card">
                  <i class="bi bi-telephone-fill"></i>
                  <h5>Call Us</h5>
                  <p>(310) 555-0100<br><span class="text-primary-custom">Mon–Fri 9am–6pm</span></p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="contact-info-card">
                  <i class="bi bi-envelope-fill"></i>
                  <h5>Email Us</h5>
                  <p>info@dreamhome.com<br><span class="small opacity-75">We respond within 24 hours</span></p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="contact-info-card">
                  <i class="bi bi-clock-fill"></i>
                  <h5>Office Hours</h5>
                  <p>Mon–Fri: 9:00 AM – 6:00 PM<br>Sat: 10:00 AM – 4:00 PM</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-7 align-self-center">
            <div class="contact-form-wrapper p-4 p-md-5">
              <h2 class="display-6 fw-bold mb-4">Send Us a Message</h2>
              <form id="contactForm" method="POST" action="{{ route('contact.submit') ?? '#' }}">
                @csrf
                <div class="row g-3">
                  <div class="col-md-6">
                    <label class="form-label small">Full Name *</label>
                    <input type="text" class="form-control" name="name" placeholder="John Smith">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label small">Email Address *</label>
                    <input type="email" class="form-control" name="email" placeholder="john@example.com">
                  </div>
                  <div class="col-12">
                    <label class="form-label small">Phone Number</label>
                    <input type="tel" class="form-control" name="phone" placeholder="(555) 555-5555">
                  </div>
                  <div class="col-12">
                    <label class="form-label small">Message *</label>
                    <textarea class="form-control" name="message" rows="5" placeholder="Tell us about your real estate needs..."></textarea>
                  </div>
                  <div class="col-12 mt-4">
                    <button type="submit" class="btn btn-search w-100 py-3">
                      <i class="bi bi-send me-2"></i> Send Message
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
@endsection
