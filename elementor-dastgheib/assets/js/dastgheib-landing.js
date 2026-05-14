/* Dastgheib Landing — Elementor Widget JS
   Initializes carousel and QR per widget instance */

(function () {
  'use strict';

  const CHECK_SVG = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg>';

  function toFa(n) {
    return String(n).replace(/\d/g, d => '۰۱۲۳۴۵۶۷۸۹'[d]);
  }

  // ── QR Generator ────────────────────────────────────────────
  function buildQR(container) {
    const grid = container.querySelector('.dgl-qr-grid');
    if (!grid || grid.dataset.built) return;
    grid.dataset.built = '1';

    const seed = grid.dataset.seed || 'DastgheibQoba.info-app';
    const N = 21;

    function rng(i) {
      let h = 2166136261;
      for (let c = 0; c < seed.length; c++) {
        h = Math.imul(h ^ seed.charCodeAt(c), 16777619);
      }
      return ((h ^ Math.imul(i, 2654435761)) >>> 0) / 0xffffffff;
    }

    for (let y = 0; y < N; y++) {
      for (let x = 0; x < N; x++) {
        const sp = document.createElement('span');
        const inTL = x < 7 && y < 7;
        const inTR = x >= N - 7 && y < 7;
        const inBL = x < 7 && y >= N - 7;
        const isInner =
          (inTL && (x === 0 || x === 6 || y === 0 || y === 6 || (x >= 2 && x <= 4 && y >= 2 && y <= 4))) ||
          (inTR && (x === N-7 || x === N-1 || y === 0 || y === 6 || (x >= N-5 && x <= N-3 && y >= 2 && y <= 4))) ||
          (inBL && (x === 0 || x === 6 || y === N-7 || y === N-1 || (x >= 2 && x <= 4 && y >= N-5 && y <= N-3)));

        if (inTL || inTR || inBL) {
          sp.className = isInner ? '' : 'off';
        } else {
          sp.className = rng(y * N + x) > 0.5 ? '' : 'off';
        }
        grid.appendChild(sp);
      }
    }
  }

  // ── Carousel ─────────────────────────────────────────────────
  function initCarousel(section) {
    if (section.dataset.dglInit) return;
    section.dataset.dglInit = '1';

    let screens;
    try {
      screens = JSON.parse(section.dataset.shots || '[]');
    } catch (e) {
      return;
    }
    if (!screens.length) return;

    const autoplayMs = parseInt(section.dataset.autoplay, 10) || 5500;
    const tabsEl   = section.querySelector('.dgl-shot-tabs');
    const dotsEl   = section.querySelector('.dgl-shot-dots');
    const framesEl = section.querySelector('.dgl-shot-frames');
    const infoEl   = section.querySelector('.dgl-shot-info');
    const prevBtn  = section.querySelector('.dgl-prev-btn');
    const nextBtn  = section.querySelector('.dgl-next-btn');
    if (!tabsEl || !framesEl || !infoEl) return;

    // Build tabs, dots, phones
    screens.forEach((s, i) => {
      const btn = document.createElement('button');
      btn.className = 'dgl-shot-tab' + (i === 0 ? ' active' : '');
      btn.textContent = s.tab;
      btn.addEventListener('click', () => setShot(i));
      tabsEl.appendChild(btn);

      const dot = document.createElement('span');
      dot.className = i === 0 ? 'active' : '';
      dot.addEventListener('click', () => setShot(i));
      dotsEl.appendChild(dot);

      const ph = document.createElement('div');
      ph.className = 'dgl-phone';
      if (s.src) {
        ph.innerHTML = '<div class="dgl-screen"><img src="' + s.src + '" alt="' + s.title + '" loading="lazy"/></div>';
      } else {
        ph.innerHTML = '<div class="dgl-screen" style="background:#eee;display:grid;place-items:center;color:#aaa;font-size:13px">' + s.title + '</div>';
      }
      framesEl.appendChild(ph);
    });

    let current = 0;

    function setShot(i) {
      current = ((i % screens.length) + screens.length) % screens.length;

      [...tabsEl.children].forEach((b, idx) => b.classList.toggle('active', idx === current));
      [...dotsEl.children].forEach((b, idx) => b.classList.toggle('active', idx === current));

      [...framesEl.children].forEach((p, idx) => {
        let diff = idx - current;
        if (diff > screens.length / 2) diff -= screens.length;
        if (diff < -screens.length / 2) diff += screens.length;
        p.dataset.pos = Math.abs(diff) > 2 ? 'hidden' : String(diff);
      });

      const s = screens[current];
      const pad = n => toFa(String(n).padStart(2, '0'));
      const listHTML = s.list.map(l =>
        '<li>' + CHECK_SVG + ' ' + l + '</li>'
      ).join('');

      infoEl.innerHTML =
        '<span class="dgl-num">' + pad(current + 1) + ' / ' + pad(screens.length) + '</span>' +
        '<h4>' + s.title + '</h4>' +
        (s.desc ? '<p>' + s.desc + '</p>' : '') +
        (listHTML ? '<ul class="dgl-info-list">' + listHTML + '</ul>' : '');
    }

    if (prevBtn) prevBtn.addEventListener('click', () => { setShot(current - 1); resetTimer(); });
    if (nextBtn) nextBtn.addEventListener('click', () => { setShot(current + 1); resetTimer(); });

    setShot(0);

    // Auto-rotate
    let timer = setInterval(() => setShot(current + 1), autoplayMs);
    function resetTimer() { clearInterval(timer); timer = setInterval(() => setShot(current + 1), autoplayMs); }
    section.addEventListener('mouseenter', () => clearInterval(timer));
    section.addEventListener('mouseleave', () => { clearInterval(timer); timer = setInterval(() => setShot(current + 1), autoplayMs); });
  }

  // ── Smooth scroll scoped to widget ───────────────────────────
  function initScroll(container) {
    container.querySelectorAll('a[href^="#"]').forEach(a => {
      a.addEventListener('click', e => {
        const target = document.querySelector(a.getAttribute('href'));
        if (target) {
          e.preventDefault();
          window.scrollTo({ top: target.getBoundingClientRect().top + window.pageYOffset - 70, behavior: 'smooth' });
        }
      });
    });
  }

  // ── Init one widget instance ──────────────────────────────────
  function initWidget(container) {
    container.querySelectorAll('.dgl-shots').forEach(initCarousel);
    container.querySelectorAll('.dgl-qr-grid').forEach(grid => buildQR(grid.closest('.dastgheib-landing')));
    initScroll(container);
  }

  // ── Page load ────────────────────────────────────────────────
  function initAll() {
    document.querySelectorAll('.dastgheib-landing').forEach(initWidget);
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initAll);
  } else {
    initAll();
  }

  // ── Elementor editor preview only ────────────────────────────
  // On live site, initAll() handles everything.
  // This hook only re-runs after panel changes inside the editor.
  window.addEventListener('elementor/frontend/init', function () {
    if (typeof elementorFrontend === 'undefined') return;
    elementorFrontend.hooks.addAction(
      'frontend/element_ready/dastgheib_landing.default',
      function ($scope) {
        if (!(elementorFrontend.isEditMode && elementorFrontend.isEditMode())) return;
        const container = $scope[0];
        if (container) {
          container.querySelectorAll('.dgl-shots').forEach(s => delete s.dataset.dglInit);
          container.querySelectorAll('.dgl-qr-grid').forEach(g => delete g.dataset.built);
          initWidget(container);
        }
      }
    );
  });

})();
