@extends('layouts.dashboard')

@section('dash-content')
<style>

    /* ── PAGE HEADER ── */
    .fav-header {
      background: var(--form-bg);
      border-bottom: 1px solid var(--border-color);
      padding: 5rem 0 2rem;
    }
    .fav-header-inner {
      display: flex; align-items: center;
      justify-content: space-between; flex-wrap: wrap; gap: 1rem;
    }
    .fav-title { font-size: 1.8rem; font-weight: 700; margin: 0; }
    .fav-title span { color: var(--primary); }
    .fav-subtitle { color: var(--text-muted); font-size: 0.88rem; margin-top: 4px; }

    .btn-clear-all {
      background: transparent; border: 1px solid #e74c3c;
      color: #e74c3c; padding: 8px 18px; border-radius: 8px;
      font-size: 0.85rem; font-weight: 600; cursor: pointer;
      transition: all 0.2s; display: flex; align-items: center; gap: 6px;
    }
    .btn-clear-all:hover { background: #e74c3c; color: #fff; }

    /* ── FILTER / SORT BAR ── */
    .fav-controls {
      background: var(--bg-body);
      padding: 1.5rem 0;
      border-bottom: 1px solid var(--border-color);
      position: sticky; top: 70px; z-index: 50;
    }
    .fav-controls-inner {
      display: flex; align-items: center;
      justify-content: space-between; flex-wrap: wrap; gap: 1rem;
    }

    /* Filter Tabs */
    .filter-tabs { display: flex; gap: 0.4rem; flex-wrap: wrap; }
    .filter-tab {
      padding: 7px 18px; border-radius: 20px;
      border: 1px solid var(--border-color);
      background: transparent; color: var(--text-muted);
      font-size: 0.83rem; font-weight: 500;
      cursor: pointer; transition: all 0.2s;
    }
    .filter-tab:hover { border-color: var(--primary); color: var(--primary); }
    .filter-tab.active {
      background: var(--primary); border-color: var(--primary);
      color: #fff;
    }

    /* View Toggle */
    .view-toggle { display: flex; gap: 0.4rem; }
    .view-btn {
      width: 36px; height: 36px; border-radius: 8px;
      border: 1px solid var(--border-color); background: transparent;
      color: var(--text-muted); cursor: pointer;
      display: flex; align-items: center; justify-content: center;
      font-size: 0.95rem; transition: all 0.2s;
    }
    .view-btn.active, .view-btn:hover {
      background: var(--primary); border-color: var(--primary); color: #fff;
    }

    /* ── MAIN SECTION ── */
    .fav-main { padding: 2.5rem 0 5rem; }

    /* Results label */
    .fav-results-label {
      font-size: 0.88rem; color: var(--text-muted); margin-bottom: 1.5rem;
    }
    .fav-results-label strong { color: var(--text-main); }

    /* ── FAVORITE CARD (grid view) ── */
    .fav-card {
      background: var(--bg-card); border: 1px solid var(--border-color);
      border-radius: 16px; overflow: hidden;
      transition: all 0.3s; position: relative; height: 100%;
    }
    .fav-card:hover { transform: translateY(-8px); box-shadow: 0 16px 40px var(--shadow); border-color: var(--primary); }

    .fav-card-img {
      position: relative; height: 220px; overflow: hidden;
    }
    .fav-card-img img {
      width: 100%; height: 100%; object-fit: cover;
      transition: transform 0.5s ease;
    }
    .fav-card:hover .fav-card-img img { transform: scale(1.08); }

    .fav-card-badge {
      position: absolute; top: 12px; left: 12px;
      background: var(--primary); color: #fff;
      padding: 4px 12px; border-radius: 6px;
      font-size: 0.75rem; font-weight: 600;
    }
    .fav-card-badge.rent { background: #0dcaf0; color: #000; }
    .fav-card-badge.new  { background: #ffc107; color: #000; }

    .fav-card-price {
      position: absolute; bottom: 12px; right: 12px;
      background: rgba(0,0,0,0.72); color: #fff;
      padding: 5px 12px; border-radius: 6px;
      font-weight: 700; font-size: 0.9rem;
      backdrop-filter: blur(4px);
    }

    /* Heart remove button */
    .fav-remove-btn {
      position: absolute; top: 12px; right: 12px;
      width: 34px; height: 34px; border-radius: 50%;
      background: rgba(255,255,255,0.15); backdrop-filter: blur(4px);
      border: 1px solid rgba(255,255,255,0.3);
      color: #e74c3c; cursor: pointer;
      display: flex; align-items: center; justify-content: center;
      font-size: 0.9rem; transition: all 0.2s;
    }
    .fav-remove-btn:hover { background: #e74c3c; color: #fff; border-color: #e74c3c; }

    .fav-card-body { padding: 1.1rem 1.25rem 1.25rem; }
    .fav-card-title { font-weight: 700; font-size: 1rem; color: var(--text-main); margin-bottom: 4px; }
    .fav-card-loc { font-size: 0.8rem; color: var(--text-muted); margin-bottom: 10px; }
    .fav-card-loc i { color: var(--primary); margin-right: 4px; }
    .fav-card-stats {
      display: flex; justify-content: space-between;
      border-top: 1px solid var(--border-color);
      padding-top: 0.75rem; margin-top: 0.5rem;
      font-size: 0.78rem; color: var(--text-muted);
    }
    .fav-card-stats span { display: flex; align-items: center; gap: 4px; }
    .fav-card-stats i { color: var(--primary); }
    .fav-card-actions { display: flex; gap: 0.5rem; margin-top: 0.9rem; }
    .btn-fav-view {
      flex: 1; background: var(--primary); color: #fff; border: none;
      padding: 9px; border-radius: 8px; font-weight: 600; font-size: 0.82rem;
      cursor: pointer; transition: background 0.2s; text-decoration: none;
      display: flex; align-items: center; justify-content: center; gap: 6px;
    }
    .btn-fav-view:hover { background: var(--primary-hover); color: #fff; }
    .btn-fav-compare {
      padding: 9px 14px; border-radius: 8px;
      border: 1px solid var(--border-color); background: transparent;
      color: var(--text-muted); font-size: 0.82rem; cursor: pointer;
      transition: all 0.2s; display: flex; align-items: center; gap: 5px;
    }
    .btn-fav-compare:hover { border-color: var(--primary); color: var(--primary); }

    /* ── LIST VIEW ── */
    .fav-list-card {
      background: var(--bg-card); border: 1px solid var(--border-color);
      border-radius: 14px; overflow: hidden; display: flex;
      margin-bottom: 1rem; transition: all 0.25s;
    }
    .fav-list-card:hover { border-color: var(--primary); transform: translateX(4px); }
    .fav-list-img { width: 200px; height: 140px; object-fit: cover; flex-shrink: 0; }
    .fav-list-body { flex: 1; padding: 1rem 1.25rem; display: flex; flex-direction: column; justify-content: space-between; }
    .fav-list-title { font-weight: 700; font-size: 1rem; color: var(--text-main); }
    .fav-list-meta { font-size: 0.78rem; color: var(--text-muted); margin: 4px 0; }
    .fav-list-price { font-size: 1.1rem; font-weight: 700; color: var(--primary); }
    .fav-list-actions { display: flex; gap: 0.5rem; flex-wrap: wrap; margin-top: 0.5rem; }

    /* ── EMPTY STATE ── */
    .empty-state {
      text-align: center; padding: 5rem 2rem;
      display: none;
    }
    .empty-state-icon {
      width: 90px; height: 90px; border-radius: 50%;
      background: rgba(60,181,124,0.1); border: 2px solid var(--border-color);
      display: flex; align-items: center; justify-content: center;
      margin: 0 auto 1.5rem; font-size: 2.5rem; color: var(--primary);
    }
    .empty-state h4 { font-weight: 700; margin-bottom: 0.5rem; }
    .empty-state p { color: var(--text-muted); font-size: 0.9rem; max-width: 350px; margin: 0 auto 1.5rem; }

    /* Saved date tag */
    .fav-saved-date {
      font-size: 0.7rem; color: var(--text-muted);
      margin-top: 4px; display: block;
    }

    @media (max-width: 576px) {
      .fav-list-img { width: 110px; height: 110px; }
      .fav-card-img { height: 180px; }
    }
  
</style>



<script>

    // Theme Toggle
    document.getElementById('themeToggle').addEventListener('click', function() {
      const body = document.body;
      const icon = this.querySelector('i');
      if (body.getAttribute('data-theme') === 'dark') {
        body.setAttribute('data-theme', 'light');
        icon.classList.replace('bi-sun-fill', 'bi-moon-fill');
      } else {
        body.setAttribute('data-theme', 'dark');
        icon.classList.replace('bi-moon-fill', 'bi-sun-fill');
      }
    });

    window.addEventListener('scroll', () => {
      document.getElementById('navbar').classList.toggle('nav-scroll', window.scrollY > 50);
    });

    // Toast
    function showToast(msg) {
      const toast = document.getElementById('toast');
      document.getElementById('toastMsg').textContent = msg;
      toast.style.transform = 'translateY(0)'; toast.style.opacity = '1';
      setTimeout(() => { toast.style.transform = 'translateY(100px)'; toast.style.opacity = '0'; }, 3000);
    }

    // Remove favorite card
    function removeFav(btn) {
      const card = btn.closest('.fav-item') || btn.closest('.fav-list-card');
      if (card) {
        card.style.opacity = '0';
        card.style.transform = 'scale(0.9)';
        card.style.transition = 'all 0.3s';
        setTimeout(() => {
          card.remove();
          updateCount();
          checkEmpty();
        }, 300);
        showToast('Removed from saved properties');
      }
    }

    // Update count badge
    function updateCount() {
      const items = document.querySelectorAll('.fav-item:not([style*="display: none"])');
      const total = document.querySelectorAll('.fav-item').length;
      document.getElementById('favCount').textContent = `(${total})`;
      document.getElementById('showCount').textContent = items.length;
    }

    // Check empty state
    function checkEmpty() {
      const items = document.querySelectorAll('.fav-item');
      const empty = document.getElementById('emptyState');
      if (items.length === 0) {
        document.getElementById('gridView').style.display = 'none';
        document.getElementById('listView').style.display = 'none';
        empty.style.display = 'block';
      }
    }

    // Clear All
    function clearAll() {
      if (!confirm('Remove all saved properties?')) return;
      document.querySelectorAll('.fav-item').forEach(c => c.remove());
      checkEmpty();
      showToast('All saved properties cleared');
    }

    // Filter by status
    function filterFavs(status, btn) {
      document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
      btn.classList.add('active');
      const items = document.querySelectorAll('.fav-item');
      let visible = 0;
      items.forEach(item => {
        if (status === 'all' || item.dataset.status === status) {
          item.style.display = '';
          visible++;
        } else {
          item.style.display = 'none';
        }
      });
      document.getElementById('showCount').textContent = visible;
    }

    // Sort
    function sortFavs(by) {
      const grid = document.getElementById('gridView');
      const items = Array.from(document.querySelectorAll('.fav-item'));
      items.sort((a, b) => {
        const ap = parseInt(a.dataset.price);
        const bp = parseInt(b.dataset.price);
        if (by === 'price-low')  return ap - bp;
        if (by === 'price-high') return bp - ap;
        return 0;
      });
      items.forEach(i => grid.appendChild(i));
    }

    // Switch View
    function switchView(view) {
      const gridView = document.getElementById('gridView');
      const listView = document.getElementById('listView');
      const gridBtn = document.getElementById('gridBtn');
      const listBtn = document.getElementById('listBtn');

      if (view === 'grid') {
        gridView.style.display = 'flex'; gridView.className = 'row g-4';
        listView.style.display = 'none';
        gridBtn.classList.add('active'); listBtn.classList.remove('active');
      } else {
        gridView.style.display = 'none';
        listView.style.display = 'block';
        listBtn.classList.add('active'); gridBtn.classList.remove('active');

        // Build list view from grid cards
        listView.innerHTML = '';
        document.querySelectorAll('.fav-item').forEach(item => {
          const title = item.querySelector('.fav-card-title').textContent;
          const loc   = item.querySelector('.fav-card-loc').textContent.trim();
          const price = item.querySelector('.fav-card-price').textContent;
          const img   = item.querySelector('.fav-card-img img').src;
          const stats = item.querySelector('.fav-card-stats').innerHTML;
          const status= item.dataset.status;

          const el = document.createElement('div');
          el.className = 'fav-list-card fav-item';
          el.dataset.status = status;
          el.dataset.price = item.dataset.price;
          el.innerHTML = `
            <img class="fav-list-img" src="${img}" alt="${title}">
            <div class="fav-list-body">
              <div>
                <div class="fav-list-title">${title}</div>
                <div class="fav-list-meta"><i class="bi bi-geo-alt-fill" style="color:var(--primary);"></i> ${loc}</div>
                <div class="fav-list-price">${price}</div>
              </div>
              <div class="fav-list-actions">
                <a href="property-detail.html" class="btn-fav-view"><i class="bi bi-eye"></i> View Details</a>
                <button class="btn-fav-compare"><i class="bi bi-bar-chart-line"></i> Compare</button>
                <button class="btn-clear-all" style="padding:7px 14px;" onclick="removeFav(this)"><i class="bi bi-heart-fill me-1"></i>Remove</button>
              </div>
            </div>`;
          listView.appendChild(el);
        });
      }
    }
  
</script>
@endsection