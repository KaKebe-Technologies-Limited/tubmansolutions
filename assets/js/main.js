/* H.Tubman Solutions — site interactions (no dependencies) */
(function () {
    'use strict';

    var header = document.getElementById('siteHeader');
    var toTop = document.querySelector('.to-top');
    var nav = document.getElementById('mainNav');
    var toggle = document.querySelector('.nav-toggle');
    var overlay = document.querySelector('.nav-overlay');
    var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    /* ---------- sticky header shadow + back-to-top ---------- */
    function onScroll() {
        var y = window.scrollY;
        if (header) header.classList.toggle('scrolled', y > 10);
        if (toTop) toTop.classList.toggle('show', y > 600);
    }
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
    if (toTop) toTop.addEventListener('click', function () { window.scrollTo({ top: 0, behavior: 'smooth' }); });

    /* ---------- mobile navigation ---------- */
    function setNav(open) {
        if (!nav) return;
        nav.classList.toggle('open', open);
        toggle.setAttribute('aria-expanded', String(open));
        overlay.hidden = !open;
        document.body.style.overflow = open ? 'hidden' : '';
    }
    if (toggle) toggle.addEventListener('click', function () { setNav(true); });
    if (overlay) overlay.addEventListener('click', function () { setNav(false); });
    var closeBtn = document.querySelector('.nav-close');
    if (closeBtn) closeBtn.addEventListener('click', function () { setNav(false); });
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape') setNav(false); });
    document.querySelectorAll('.dd-toggle').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var li = btn.closest('.has-dd');
            var open = !li.classList.contains('open');
            li.classList.toggle('open', open);
            btn.setAttribute('aria-expanded', String(open));
        });
    });
    // close the drawer when an in-page anchor is chosen
    if (nav) nav.addEventListener('click', function (e) {
        if (e.target.closest('a') && nav.classList.contains('open')) setNav(false);
    });

    /* ---------- hero slider ---------- */
    var hero = document.querySelector('[data-hero]');
    if (hero) {
        var slides = hero.querySelectorAll('.hero-slide');
        var dotsWrap = hero.querySelector('.hero-dots');
        var current = 0, timer = null, DELAY = 6500;
        slides.forEach(function (_, i) {
            var b = document.createElement('button');
            b.type = 'button';
            b.setAttribute('aria-label', 'Go to slide ' + (i + 1));
            b.addEventListener('click', function () { go(i); restart(); });
            dotsWrap.appendChild(b);
        });
        var dots = dotsWrap.querySelectorAll('button');
        function go(i) {
            slides[current].classList.remove('is-active');
            slides[current].setAttribute('aria-hidden', 'true');
            dots[current].classList.remove('is-active');
            current = (i + slides.length) % slides.length;
            slides[current].classList.add('is-active');
            slides[current].removeAttribute('aria-hidden');
            dots[current].classList.add('is-active');
        }
        function restart() {
            clearInterval(timer);
            if (!reduceMotion) timer = setInterval(function () { go(current + 1); }, DELAY);
        }
        slides.forEach(function (s, i) { if (i) s.setAttribute('aria-hidden', 'true'); });
        dots[0].classList.add('is-active');
        hero.querySelector('.hero-prev').addEventListener('click', function () { go(current - 1); restart(); });
        hero.querySelector('.hero-next').addEventListener('click', function () { go(current + 1); restart(); });
        hero.addEventListener('mouseenter', function () { clearInterval(timer); });
        hero.addEventListener('mouseleave', restart);
        // swipe on touch screens
        var sx = null;
        hero.addEventListener('touchstart', function (e) { sx = e.touches[0].clientX; }, { passive: true });
        hero.addEventListener('touchend', function (e) {
            if (sx === null) return;
            var dx = e.changedTouches[0].clientX - sx;
            if (Math.abs(dx) > 50) { go(current + (dx < 0 ? 1 : -1)); restart(); }
            sx = null;
        });
        restart();
    }

    /* ---------- reveal on scroll + counters ---------- */
    function countUp(el) {
        var target = parseFloat(el.getAttribute('data-count'));
        var suffix = el.getAttribute('data-suffix') || '';
        if (reduceMotion) { el.textContent = target + suffix; return; }
        var start = null, dur = 1600;
        function step(ts) {
            if (!start) start = ts;
            var p = Math.min((ts - start) / dur, 1);
            el.textContent = Math.round(target * (1 - Math.pow(1 - p, 3))) + suffix;
            if (p < 1) requestAnimationFrame(step);
        }
        requestAnimationFrame(step);
    }

    if ('IntersectionObserver' in window) {
        var io = new IntersectionObserver(function (entries) {
            entries.forEach(function (en) {
                if (!en.isIntersecting) return;
                var el = en.target;
                if (el.hasAttribute('data-count')) countUp(el);
                else el.classList.add('revealed');
                io.unobserve(el);
            });
        }, { threshold: 0.15, rootMargin: '0px 0px -40px 0px' });
        document.querySelectorAll('[data-reveal], [data-count]').forEach(function (el, i) {
            if (el.hasAttribute('data-reveal')) {
                // small stagger for siblings in the same grid
                var idx = Array.prototype.indexOf.call(el.parentNode.children, el);
                el.style.transitionDelay = Math.min(idx, 5) * 0.08 + 's';
            }
            io.observe(el);
        });
    } else {
        document.querySelectorAll('[data-reveal]').forEach(function (el) { el.classList.add('revealed'); });
        document.querySelectorAll('[data-count]').forEach(function (el) { el.textContent = el.getAttribute('data-count') + (el.getAttribute('data-suffix') || ''); });
    }

    /* ---------- live CCTV timestamp overlay ---------- */
    var clocks = document.querySelectorAll('[data-cam-clock]');
    if (clocks.length) {
        var pad = function (n) { return String(n).padStart(2, '0'); };
        var tick = function () {
            var d = new Date();
            var s = d.getFullYear() + '-' + pad(d.getMonth() + 1) + '-' + pad(d.getDate()) + '  ' +
                pad(d.getHours()) + ':' + pad(d.getMinutes()) + ':' + pad(d.getSeconds());
            clocks.forEach(function (c) { c.textContent = s; });
        };
        tick();
        setInterval(tick, 1000);
    }

    /* ---------- search overlay with live results ---------- */
    var sOverlay = document.getElementById('searchOverlay');
    var sBtn = document.querySelector('.search-btn');
    if (sOverlay && sBtn) {
        var sInput = document.getElementById('siteSearchInput');
        var sLive = sOverlay.querySelector('.search-live');
        var sTimer = null, lastQ = '', ctrl = null;
        var esc = function (s) {
            return String(s).replace(/[&<>"']/g, function (c) {
                return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c];
            });
        };
        var openSearch = function () {
            sOverlay.hidden = false;
            sBtn.setAttribute('aria-expanded', 'true');
            document.body.style.overflow = 'hidden';
            setTimeout(function () { sInput.focus(); }, 30);
        };
        var closeSearch = function () {
            sOverlay.hidden = true;
            sBtn.setAttribute('aria-expanded', 'false');
            document.body.style.overflow = '';
            sBtn.focus();
        };
        var live = function () {
            var q = sInput.value.trim();
            if (q === lastQ) return;
            lastQ = q;
            if (q.length < 2) { sLive.innerHTML = ''; return; }
            if (ctrl) ctrl.abort();
            ctrl = window.AbortController ? new AbortController() : null;
            var base = window.SITE_SEARCH || 'search';
            fetch(base + '?format=json&q=' + encodeURIComponent(q), ctrl ? { signal: ctrl.signal } : {})
                .then(function (r) { return r.json(); })
                .then(function (d) {
                    var h = '';
                    if (d.did_you_mean) {
                        h += '<p class="sl-dym">Did you mean <a href="' + base + '?q=' + encodeURIComponent(d.did_you_mean) + '">' + esc(d.did_you_mean) + '</a>?</p>';
                    }
                    if (d.answer) {
                        h += '<a class="sl-answer" href="' + esc(d.answer.url) + '"><span><i class="fa-solid fa-bolt"></i> Quick answer</span><strong>' +
                            esc(d.answer.question) + '</strong><em>' + esc(d.answer.text) + '</em></a>';
                    }
                    (d.results || []).forEach(function (r) {
                        // r.snippet is escaped server-side and only contains <mark> highlights
                        h += '<a class="sl-item" href="' + esc(r.url) + '"><span class="r-type r-' + esc(r.type.toLowerCase()) + '">' + esc(r.type) +
                            '</span><strong>' + esc(r.title) + '</strong><em>' + r.snippet + '</em></a>';
                    });
                    if (h) {
                        h += '<a class="sl-all" href="' + base + '?q=' + encodeURIComponent(q) + '">See all results for “' + esc(q) + '” →</a>';
                    } else {
                        h = '<p class="sl-empty">No matches yet. Press Enter for full results, or <a href="https://wa.me/' + (window.SITE_WA || '') +
                            '?text=' + encodeURIComponent('Hello H.Tubman Solutions, I am looking for: ' + q) + '" target="_blank" rel="noopener">ask us on WhatsApp</a>.</p>';
                    }
                    sLive.innerHTML = h;
                })
                .catch(function () {});
        };
        sBtn.addEventListener('click', openSearch);
        sOverlay.querySelector('.search-close').addEventListener('click', closeSearch);
        sOverlay.addEventListener('click', function (e) { if (e.target === sOverlay) closeSearch(); });
        sInput.addEventListener('input', function () { clearTimeout(sTimer); sTimer = setTimeout(live, 180); });
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && !sOverlay.hidden) closeSearch();
            var tag = (document.activeElement && document.activeElement.tagName) || '';
            if (e.key === '/' && sOverlay.hidden && !/INPUT|TEXTAREA|SELECT/.test(tag)) { e.preventDefault(); openSearch(); }
        });
    }

    /* ---------- open the FAQ answer a link points to (e.g. faq#q-how-much-...) ---------- */
    var openHash = function () {
        var id = decodeURIComponent(location.hash.slice(1));
        var el = id && document.getElementById(id);
        if (el && el.tagName === 'DETAILS') el.open = true;
    };
    openHash();
    window.addEventListener('hashchange', openHash);

    /* ---------- enquiry forms: validation + "Send via WhatsApp" ---------- */
    function fieldVal(form, name) {
        var f = form.elements[name];
        return f ? String(f.value || '').trim() : '';
    }
    function validate(form) {
        var ok = true;
        ['name', 'phone'].forEach(function (n) {
            var f = form.elements[n];
            if (!f) return;
            var bad = !f.value.trim();
            var wrap = f.closest('.field');
            if (wrap) wrap.classList.toggle('invalid', bad);
            if (bad && ok) { f.focus(); ok = false; }
        });
        return ok;
    }
    document.querySelectorAll('[data-wa-form]').forEach(function (form) {
        form.addEventListener('submit', function (e) { if (!validate(form)) e.preventDefault(); });
        var waBtn = form.querySelector('[data-wa-send]');
        if (!waBtn) return;
        waBtn.addEventListener('click', function () {
            if (!validate(form)) return;
            var lines = ['Hello H.Tubman Solutions, I would like a quote.', ''];
            [['Name', 'name'], ['Phone', 'phone'], ['Email', 'email'], ['Service', 'service'], ['Location', 'location'], ['Message', 'message']]
                .forEach(function (p) { var v = fieldVal(form, p[1]); if (v) lines.push(p[0] + ': ' + v); });
            window.open('https://wa.me/' + (window.SITE_WA || '') + '?text=' + encodeURIComponent(lines.join('\n')), '_blank', 'noopener');
        });
    });
})();
