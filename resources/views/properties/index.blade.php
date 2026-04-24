@extends('layouts.app')

@section('content')
  <!-- HERO -->
  <section class="hero-section-prop">
    <div class="hero-bg-prop" style="background-image: url('{{ asset('images/property-hero.jpg') }}');"></div>
    <div class="hero-overlay"></div>
    <div class="container hero-content">
      <div class="col-lg-8">
        <h1 class="hero-title mb-3">Find your Perfect <br><span>Dream Home</span></h1>
        <p class="hero-desc">Explore verified listings, get expert guidance, and find the property that fits your lifestyle perfectly.</p>
      </div>
    </div>
  </section>

  <!-- MAIN CONTENT -->
  <main class="py-5">
    <div class="container">

      <!-- SMART FILTERS -->
      <section class="filter-top-wrap mb-4">
        <div class="filter-top-head">
          <h5 class="mb-0"><i class="bi bi-sliders me-2"></i>Smart Filters</h5>
        </div>
        <div class="filter-top-grid">
          <div class="filter-group">
            <label for="searchInput">Search</label>
            <input type="text" class="form-control" name="search" placeholder="Search by title or location..." id="searchInput">
          </div>
          <div class="filter-group">
            <label for="propertyType">Property Type</label>
            <select class="form-select" name="type" id="propertyType">
              <option value="">All Types</option>
              <option value="apartment">Apartment</option>
              <option value="villa">Villa</option>
              <option value="townhouse">Townhouse</option>
              <option value="penthouse">Penthouse</option>
              <option value="office">Office</option>
            </select>
          </div>
          <div class="filter-group">
            <label for="bedrooms">Bedrooms</label>
            <select class="form-select" name="bedrooms" id="bedrooms">
              <option value="">Any</option>
              <option value="1">1+</option>
              <option value="2">2+</option>
              <option value="3">3+</option>
              <option value="4">4+</option>
              <option value="5">5+</option>
            </select>
          </div>
          <div class="filter-group">
            <label for="bathrooms">Bathrooms</label>
            <select class="form-select" name="bathrooms" id="bathrooms">
              <option value="">Any</option>
              <option value="1">1+</option>
              <option value="2">2+</option>
              <option value="3">3+</option>
              <option value="4">4+</option>
            </select>
          </div>
          <div class="filter-group">
            <label for="minArea">Min Area (sqft)</label>
            <input type="number" class="form-control" name="minArea" placeholder="e.g. 1000" id="minArea">
          </div>
          <div class="filter-group filter-status">
            <label>Status</label>
            <div class="status-pills">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="sale" id="statusSale">
                <label class="form-check-label" for="statusSale">For Sale</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="rent" id="statusRent">
                <label class="form-check-label" for="statusRent">For Rent</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="new" id="statusNew">
                <label class="form-check-label" for="statusNew">New Listing</label>
              </div>
            </div>
          </div>
          <div class="filter-group filter-price">
            <label for="priceRange">Price Range</label>
            <div class="d-flex justify-content-between mb-2">
              <span class="range-value">$0</span>
              <span class="range-value" id="priceValue">$5,000,000</span>
            </div>
            <input type="range" class="form-range" min="0" max="5000000" step="100000" value="5000000" id="priceRange">
          </div>
          <div class="filter-actions">
            <button class="btn-filter"><i class="bi bi-search me-2"></i> Apply Filters</button>
            <button class="btn-reset" type="reset"><i class="bi bi-arrow-clockwise me-2"></i> Reset</button>
          </div>
        </div>
      </section>

      <!-- RESULTS + SORT -->
      <section>
        <div class="sort-dropdown d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
          <p class="results-count mb-0">Showing <span id="resultCount">12</span> properties</p>
          <select class="form-select w-auto" name="sort" id="sortBy">
            <option value="featured">Featured</option>
            <option value="price-low">Price: Low to High</option>
            <option value="price-high">Price: High to Low</option>
            <option value="newest">Newest First</option>
            <option value="beds">Most Bedrooms</option>
          </select>
        </div>

        <div class="row g-4" id="propertiesGrid">
            @forelse(\$properties as \$prop)
            <div class="col-md-6 col-lg-4">
                <div class="dash-prop-card" style="display:flex; flex-direction:column; border-radius:20px; border:1px solid var(--border-color); background:var(--bg-card); overflow:hidden; transition:transform 0.3s; height:100%;">
                    <div style="position:relative;">
                        <img src="{{ \$prop->images->count() ? asset('storage/'.\$prop->images->first()->image_path) : 'https://images.unsplash.com/photo-1600'.rand(10000, 90000).'-'.rand(1000,9999).'?auto=format&fit=crop&w=800&q=80' }}" onerror="this.src='https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?auto=format&fit=crop&w=800&q=80'" style="width:100%; height:220px; object-fit:cover;">
                        <span class="badge bg-primary position-absolute top-0 end-0 m-3 px-3 py-2 rounded-pill">{{ \$prop->type->name ?? 'Property' }}</span>
                    </div>
                    <div class="p-4" style="flex-grow:1; display:flex; flex-direction:column;">
                        <h5 style="color:var(--text-main); font-weight:700;" class="text-truncate">{{ \$prop->title }}</h5>
                        <p style="color:var(--text-muted); font-size:0.85rem;" class="mb-3 text-truncate"><i class="bi bi-geo-alt-fill text-primary"></i> {{ \$prop->location->city ?? 'Location TBA' }}</p>
                        
                        <div class="d-flex justify-content-between mb-3" style="font-size:0.85rem; color:var(--text-muted);">
                            <span><i class="bi bi-key mt-1"></i> {{ \$prop->bedrooms }} Beds</span>
                            <span><i class="bi bi-droplet mt-1"></i> {{ \$prop->bathrooms }} Baths</span>
                            <span><i class="bi bi-arrows-fullscreen mt-1"></i> {{ \$prop->area_sqft }} sqft</span>
                        </div>
                        
                        <div class="mt-auto d-flex justify-content-between align-items-center border-top pt-3" style="border-color:var(--border-color) !important;">
                            <span style="font-size:1.25rem; font-weight:700; color:var(--primary);">\${{ number_format(\$prop->sale_price ?? \$prop->rental_price) }}</span>
                            <a href="{{ route('properties.show', \$prop->slug) }}" class="btn btn-outline-primary btn-sm rounded-pill px-3">View Details</a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <i class="bi bi-house-x display-1 text-muted mb-3" style="opacity:0.3"></i>
                <h4 style="color:var(--text-main);">No properties found</h4>
                <p style="color:var(--text-muted);">Try adjusting your filters.</p>
                <a href="{{ route('properties.index') }}" class="btn btn-primary mt-2 rounded-pill px-4">Clear All Filters</a>
            </div>
            @endforelse
        </div>
        
        <div class="mt-5 d-flex justify-content-center">
            {{ \$properties->links('pagination::bootstrap-5') }}
        </div>
      </section>
    </div>
  </main>
@endsection
