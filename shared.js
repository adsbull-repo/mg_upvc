/* shared.js — MG Windows & Doors */

document.addEventListener('DOMContentLoaded', () => {

  // ── HEADER SCROLL ──
  const hdr = document.getElementById('site-header');
  const btt = document.getElementById('btt');
  window.addEventListener('scroll', () => {
    if (hdr) hdr.classList.toggle('scrolled', window.scrollY > 40);
    if (btt) btt.classList.toggle('visible', window.scrollY > 380);
  });
  if (btt) btt.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));

  // ── MOBILE NAV ──
  const hamburger = document.getElementById('hamburger');
  const mobNav    = document.getElementById('mob-nav');
  const mobOver   = document.getElementById('mob-overlay');
  const mobClose  = document.getElementById('mob-close');

  function openMob()  { mobNav.classList.add('open'); mobOver.classList.add('open'); document.body.style.overflow = 'hidden'; if(hamburger) hamburger.classList.add('active'); }
  function closeMob() { mobNav.classList.remove('open'); mobOver.classList.remove('open'); document.body.style.overflow = ''; if(hamburger) hamburger.classList.remove('active'); }

  if (hamburger) hamburger.addEventListener('click', openMob);
  if (mobClose)  mobClose.addEventListener('click', closeMob);
  if (mobOver)   mobOver.addEventListener('click', closeMob);

  // Mobile sub toggles
  document.querySelectorAll('.mob-toggle').forEach(btn => {
    btn.addEventListener('click', () => {
      const target = document.getElementById(btn.dataset.target);
      if (target) target.classList.toggle('open');
    });
  });

  // Close on nav link click
  document.querySelectorAll('.mob-nav-link').forEach(a => {
    a.addEventListener('click', closeMob);
  });

  // ── FADE-UP SCROLL ANIMATIONS ──
  const faders = document.querySelectorAll('.fade-up');
  if (faders.length) {
    const obs = new IntersectionObserver((entries) => {
      entries.forEach((e, i) => {
        if (e.isIntersecting) {
          e.target.style.transitionDelay = `${(i % 5) * 70}ms`;
          e.target.classList.add('visible');
          obs.unobserve(e.target);
        }
      });
    }, { threshold: 0.1 });
    faders.forEach(el => obs.observe(el));
  }

  // ── QUOTE FORM ──
  const qf = document.getElementById('quote-form');
  if (qf) {
    qf.addEventListener('submit', e => {
      e.preventDefault();
      qf.style.display = 'none';
      const s = document.getElementById('form-success');
      if (s) s.style.display = 'block';
    });
  }

  // ── CONTACT FORM ──
  const cf = document.getElementById('contact-form');
  if (cf) {
    cf.addEventListener('submit', e => {
      e.preventDefault();
      cf.style.display = 'none';
      const s = document.getElementById('contact-success');
      if (s) s.style.display = 'block';
    });
  }

  // ── ACTIVE NAV LINK ──
  const current = window.location.pathname.split('/').pop() || 'index.html';
  document.querySelectorAll('.desk-nav > li').forEach(li => {
    const a = li.querySelector('a');
    if (a && a.getAttribute('href') === current) li.classList.add('active');
  });

});

  // ── COUNTING NUMBER ANIMATION ──
  function animateCount(el, target, duration) {
    const suffix = el.dataset.suffix || '';
    let start = 0;
    const step = target / (duration / 16);
    const timer = setInterval(() => {
      start += step;
      if (start >= target) {
        el.textContent = target.toLocaleString() + suffix;
        clearInterval(timer);
      } else {
        el.textContent = Math.floor(start).toLocaleString() + suffix;
      }
    }, 16);
  }

  const statNums = document.querySelectorAll('.stat-num[data-count]');
  if (statNums.length) {
    const statObs = new IntersectionObserver((entries) => {
      entries.forEach(e => {
        if (e.isIntersecting) {
          const el = e.target;
          animateCount(el, parseInt(el.dataset.count), 1800);
          statObs.unobserve(el);
        }
      });
    }, { threshold: 0.3 });
    statNums.forEach(el => statObs.observe(el));
  }
