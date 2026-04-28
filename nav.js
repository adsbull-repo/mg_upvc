/* nav.js — injects header + footer into every page */

const NAV_HTML = `
<style>
/* Logo image rendering */
#site-header .logo img{
  height:68px;
  width:auto;
  display:block;
  object-fit:contain;
  mix-blend-mode:multiply;
  border-radius:6px;
}
.mob-nav .logo img{
  height:56px;
  width:auto;
  display:block;
  object-fit:contain;
  border-radius:6px;
}
#site-footer .logo img{
  height:64px;
  width:auto;
  display:block;
  object-fit:contain;
  border-radius:6px;
}

/* ── HEADER: always sticky/fixed ── */
#site-header {
  position: sticky !important;
  top: 0 !important;
  z-index: 1000;
  width: 100%;
  background: #fff;
  box-shadow: 0 2px 10px rgba(0,0,0,0.07);
}

/* Ensure no gap between ann-bar and header */
.ann-bar {
  display: block;
  width: 100%;
  box-sizing: border-box;
}
#nav-placeholder {
  display: block;
}

/* Sub-drop: position to RIGHT of parent item */
.sub-drop {
  position:absolute;
  top:0;
  left:100%;
  background:#fff;
  border:1px solid var(--grey-mid);
  border-radius:var(--radius);
  box-shadow:var(--shadow-lg);
  min-width:200px;
  opacity:0;
  visibility:hidden;
  transform:translateX(10px);
  transition:all .25s ease;
  z-index:1000;
}
.drop li:hover>.sub-drop{
  opacity:1;
  visibility:visible;
  transform:translateX(0);
}
.sub-drop li>a{
  display:flex;
  align-items:center;
  gap:8px;
  padding:10px 16px;
  font-size:.83rem;
  font-weight:500;
  color:var(--dark-mid);
  transition:all var(--tr);
}
.sub-drop li>a:hover{color:var(--primary);background:#fce4e4;}
.sub-drop li>a i{color:var(--primary);font-size:.7rem;flex-shrink:0;}

/* Phone icon: earpiece faces RIGHT */
.hdr-phone i {
  display:inline-block;
  transform:scaleX(-1);
}

/* ── UNIFORM BUTTON SIZES ── */
.btn-primary,
.btn-outline-red,
.btn-outline-white {
  padding: 13px 26px !important;
  font-size: .9rem !important;
  font-weight: 600 !important;
  border-radius: 6px !important;
  min-height: 48px !important;
  display: inline-flex !important;
  align-items: center !important;
  gap: 8px !important;
  box-sizing: border-box !important;
  white-space: nowrap !important;
  line-height: 1 !important;
}
/* Exception: full-width form submit */
button[type="submit"].btn-primary {
  width: 100%;
  justify-content: center;
}
/* Header quote button — slightly compact */
.header-right .btn-primary {
  padding: 10px 18px !important;
  min-height: 42px !important;
  font-size: .85rem !important;
}

/* ── HAMBURGER BUTTON ── */
.hamburger{
  display:none;
  flex-direction:column;
  justify-content:center;
  align-items:center;
  width:40px;
  height:40px;
  background:none;
  border:none;
  cursor:pointer;
  padding:4px;
  gap:5px;
  flex-shrink:0;
  z-index:1100;
}
.hamburger span{
  display:block;
  width:24px;
  height:2px;
  background:var(--dark);
  border-radius:2px;
  transition:all .3s ease;
  transform-origin:center;
}
/* Animate to X when open */
.hamburger.active span:nth-child(1){ transform:translateY(7px) rotate(45deg); }
.hamburger.active span:nth-child(2){ opacity:0; transform:scaleX(0); }
.hamburger.active span:nth-child(3){ transform:translateY(-7px) rotate(-45deg); }

/* Mobile overlay */
.mob-overlay{
  display:none;
  position:fixed;
  inset:0;
  background:rgba(0,0,0,.5);
  z-index:1050;
  opacity:0;
  transition:opacity .3s ease;
}
.mob-overlay.open{ display:block; opacity:1; }

/* Mobile drawer */
.mob-nav{
  position:fixed;
  top:0; right:0;
  width:min(300px, 85vw);
  height:100vh;
  height:100dvh;
  background:#fff;
  z-index:1100;
  transform:translateX(100%);
  transition:transform .35s cubic-bezier(.4,0,.2,1);
  overflow-y:auto;
  display:flex;
  flex-direction:column;
  box-shadow:-4px 0 24px rgba(0,0,0,.15);
}
.mob-nav.open{ transform:translateX(0); }

.mob-head{
  display:flex;
  align-items:center;
  justify-content:space-between;
  padding:12px 16px;
  border-bottom:1px solid var(--grey-mid);
  flex-shrink:0;
}
.mob-close{
  background:none;
  border:none;
  font-size:1.4rem;
  cursor:pointer;
  color:var(--dark);
  width:36px;
  height:36px;
  display:flex;
  align-items:center;
  justify-content:center;
  border-radius:50%;
  transition:background .2s;
  flex-shrink:0;
}
.mob-close:hover{ background:var(--grey-light); }

.mob-links{
  list-style:none;
  padding:4px 0;
  margin:0;
  flex:1;
  overflow-y:auto;
}
.mob-item{ border-bottom:1px solid var(--grey-light); }
.mob-nav-link{
  display:flex;
  align-items:center;
  gap:10px;
  padding:11px 20px;
  font-size:.9rem;
  font-weight:500;
  color:var(--dark);
  text-decoration:none;
  transition:background .2s,color .2s;
}
.mob-nav-link:hover{ background:var(--grey-light); color:var(--primary); }
.mob-toggle{
  width:100%;
  display:flex;
  align-items:center;
  justify-content:space-between;
  padding:11px 20px;
  background:none;
  border:none;
  font-size:.9rem;
  font-weight:500;
  color:var(--dark);
  cursor:pointer;
  transition:background .2s;
}
.mob-toggle:hover{ background:var(--grey-light); color:var(--primary); }
.mob-toggle i{ transition:transform .3s; font-size:.75rem; }
.mob-sub{ display:none; background:#fafafa; padding:4px 0; }
.mob-sub.open{ display:block; }
.mob-sub.open + .mob-toggle i,
.mob-toggle[aria-expanded="true"] i{ transform:rotate(180deg); }
.mob-sub-head{ font-size:.72rem; font-weight:700; color:var(--grey-text); padding:4px 20px 2px; text-transform:uppercase; letter-spacing:1px; }
.mob-sub .mob-nav-link{ padding:9px 20px 9px 32px; font-size:.85rem; }
.mob-sub .mob-nav-link i{ font-size:.6rem; color:var(--primary); }

.mob-cta{
  padding:12px 16px 16px;
  border-top:1px solid var(--grey-mid);
  flex-shrink:0;
}
.mob-cta .btn-primary{
  width:100%;
  justify-content:center;
  padding:12px 20px !important;
  font-size:.9rem !important;
}

/* ── MOBILE: header sticky override ── */
@media(max-width:768px){
  #site-header{
    position:sticky !important;
    top:0 !important;
    z-index:1000;
    width:100%;
    box-sizing:border-box;
    overflow:visible;
  }
  .header-inner{flex-wrap:nowrap;padding:0 12px;gap:8px;align-items:center;height:60px;}
  .header-inner .logo{flex-shrink:0;}
  .header-inner .logo img{height:44px !important;}
  .header-inner .logo .logo-text strong{font-size:.8rem;white-space:nowrap;}
  .header-inner .logo .logo-text span{display:none;}
  .desk-nav{display:none !important;}
  .hdr-phone{display:none !important;}
  .hamburger{display:flex !important;}
  /* Hide "Get Quote" button on mobile — menu has it inside drawer */
  .header-right .btn-primary{display:none !important;}
}
@media(max-width:480px){
  .header-inner{padding:0 10px;height:56px;}
  .header-inner .logo img{height:40px !important;}
  .header-inner .logo .logo-text strong{font-size:.76rem;}
}
@media(max-width:360px){
  .header-inner .logo img{height:36px !important;}
}
</style>
<div class="ann-bar">📞 Free site visit in Coimbatore &amp; surrounding areas — Call <strong>+91 97895 85081,+91 9865208281</strong></div>
<header id="site-header">
  <div class="container header-inner">
    <a href="index.html" class="logo" style="display:flex;align-items:center;gap:10px;text-decoration:none;">
      <img src="logo1.png" alt="MG Windows & Doors Logo" style="height:68px;width:auto;object-fit:contain;display:block;mix-blend-mode:multiply;" />
      <div class="logo-text">
        <strong>MG Windows &amp; Doors</strong>
        <span>Premium uPVC &amp; Aluminium Solutions</span>
      </div>
    </a>

    <nav>
      <ul class="desk-nav" id="main-nav">
        <li><a href="index.html">Home</a></li>
        <li>
          <a href="#">Products <i class="fas fa-chevron-down chev"></i></a>
          <ul class="drop">
            <li>
              <a href="upvc-doors.html">Doors <i class="fas fa-chevron-right chev-r"></i></a>
              <ul class="sub-drop">
                <li><a href="upvc-doors.html"><i class="fas fa-circle-dot"></i>uPVC Doors</a></li>
                <li><a href="aluminium-doors.html"><i class="fas fa-circle-dot"></i>Aluminium Doors</a></li>
              </ul>
            </li>
            <li>
              <a href="upvc-windows.html">Windows <i class="fas fa-chevron-right chev-r"></i></a>
              <ul class="sub-drop">
                <li><a href="upvc-windows.html"><i class="fas fa-circle-dot"></i>uPVC Windows</a></li>
                <li><a href="aluminium-windows.html"><i class="fas fa-circle-dot"></i>Aluminium Windows</a></li>
              </ul>
            </li>
            <li><a href="fiber.html">Fiber Doors</a></li>
          </ul>
        </li>
        <li><a href="index.html#about" class="about-nav-link">About Us</a></li>
        <li><a href="gallery.html">Gallery</a></li>
        <li><a href="blog.html">Blog</a></li>
        <li><a href="contact.html">Contact</a></li>
      </ul>
    </nav>

    <div class="header-right">
      <a href="tel:+919789585081" class="hdr-phone" style="text-decoration:none;">
        <i class="fas fa-phone-alt"></i> +91 97895 85081
      </a>
      <a href="contact.html#quote" class="btn-primary">Get Quote <i class="fas fa-arrow-right"></i></a>
      <button class="hamburger" id="hamburger" aria-label="Menu">
        <span></span><span></span><span></span>
      </button>
    </div>
  </div>
</header>

<!-- Mobile overlay -->
<div class="mob-overlay" id="mob-overlay"></div>

<!-- Mobile drawer -->
<nav class="mob-nav" id="mob-nav">
  <div class="mob-head">
    <a href="index.html" class="logo" style="display:flex;align-items:center;gap:8px;text-decoration:none;">
      <img src="logo1.png" alt="MG Windows & Doors Logo" style="height:44px;width:auto;object-fit:contain;display:block;border-radius:6px;" />
      <div class="logo-text">
        <strong style="color:#1a1a1a;font-size:.82rem;">MG Windows &amp; Doors</strong>
      </div>
    </a>
    <button class="mob-close" id="mob-close">✕</button>
  </div>
  <ul class="mob-links">
    <li class="mob-item"><a href="index.html" class="mob-nav-link">Home</a></li>
    <li class="mob-item">
      <button class="mob-toggle" data-target="mob-doors">Doors <i class="fas fa-chevron-down"></i></button>
      <div class="mob-sub" id="mob-doors">
        <div class="mob-sub-head">Choose Material</div>
        <a href="upvc-doors.html" class="mob-nav-link"><i class="fas fa-circle-dot"></i> uPVC Doors</a>
        <a href="aluminium-doors.html" class="mob-nav-link"><i class="fas fa-circle-dot"></i> Aluminium Doors</a>
      </div>
    </li>
    <li class="mob-item">
      <button class="mob-toggle" data-target="mob-windows">Windows <i class="fas fa-chevron-down"></i></button>
      <div class="mob-sub" id="mob-windows">
        <div class="mob-sub-head">Choose Material</div>
        <a href="upvc-windows.html" class="mob-nav-link"><i class="fas fa-circle-dot"></i> uPVC Windows</a>
        <a href="aluminium-windows.html" class="mob-nav-link"><i class="fas fa-circle-dot"></i> Aluminium Windows</a>
      </div>
    </li>
    <li class="mob-item"><a href="fiber.html" class="mob-nav-link">Fiber Doors</a></li>
    <li class="mob-item"><a href="index.html#about" class="mob-nav-link about-nav-link">About Us</a></li>
    <li class="mob-item"><a href="gallery.html" class="mob-nav-link">Gallery</a></li>
    <li class="mob-item"><a href="blog.html" class="mob-nav-link">Blog</a></li>
    <li class="mob-item"><a href="contact.html" class="mob-nav-link">Contact</a></li>
  </ul>
  <div class="mob-cta">
    <a href="contact.html#quote" class="btn-primary mob-nav-link">Get Free Quote <i class="fas fa-arrow-right"></i></a>
  </div>
</nav>
`;

const FOOTER_HTML = `
<footer id="site-footer">
  <div class="container">
    <div class="footer-grid">
      <div class="ftr-brand">
        <a href="index.html" class="logo" style="display:flex;align-items:center;gap:10px;text-decoration:none;margin-bottom:12px;">
          <img src="logo1.png" alt="MG Windows & Doors Logo" style="height:64px;width:auto;object-fit:contain;display:block;border-radius:6px;" />
          <div class="logo-text">
            <strong style="color:#fff;">MG Windows &amp; Doors</strong>
            <span style="color:rgba(255,255,255,.45);">Premium uPVC &amp; Aluminium Solutions</span>
          </div>
        </a>
        <p>Coimbatore's trusted manufacturer and installer of uPVC windows, aluminium windows, and fiber doors. Delivering quality since 2014.</p>
        <div class="ftr-socials">
          <a href="https://www.facebook.com/mgupvcwindows" class="soc-link" target="_blank" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
          <a href="https://www.instagram.com/mgupvcwindows/" class="soc-link" target="_blank" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
          <a href="https://wa.me/919789585081" class="soc-link" target="_blank" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
        </div>
      </div>
      <div class="ftr-col">
        <h4>Quick Links</h4>
        <div class="ftr-links">
          <a href="index.html">Home</a>
          <a href="index.html#about">About Us</a>
          <a href="upvc-doors.html">uPVC Doors</a>
          <a href="aluminium-doors.html">Aluminium Doors</a>
          <a href="upvc-windows.html">uPVC Windows</a>
          <a href="aluminium-windows.html">Aluminium Windows</a>
          <a href="fiber.html">Fiber Doors</a>
          <a href="gallery.html">Gallery</a>
          <a href="blog.html">Blog</a>
          <a href="contact.html">Contact</a>
        </div>
      </div>
      <div class="ftr-col">
        <h4>Products</h4>
        <div class="ftr-links">
          <a href="upvc-doors.html">uPVC Doors</a>
          <a href="upvc-windows.html">uPVC Windows</a>
          <a href="aluminium-doors.html">Aluminium Doors</a>
          <a href="aluminium-windows.html">Aluminium Windows</a>
          <a href="fiber.html">Fiber Doors</a>
        </div>
      </div>
      <div class="ftr-col">
        <h4>Contact Us</h4>
        <div class="ftr-contact">
          <div class="ftr-ci"><i class="fas fa-map-marker-alt"></i><span>SF No 27/1, Rathanagiri Road, Near PPG Engg College,<br>Vilankuruchi, Coimbatore – 641035</span></div>
          <div class="ftr-ci"><i class="fas fa-phone-alt" style="transform:scaleX(-1);display:inline-block;"></i><span><a href="tel:+919789585081">+91 97895 85081</a></span></div>
          <div class="ftr-ci"><i class="fas fa-phone-alt" style="transform:scaleX(-1);display:inline-block;"></i><span><a href="tel:+919789585081">+91 9865208281</a></span></div>
          <div class="ftr-ci"><i class="fas fa-envelope"></i><span><a href="mailto:mgwindows11@gmail.com">mgwindows11@gmail.com</a></span></div>
          <div class="ftr-ci"><i class="fas fa-clock"></i><span>Mon – Sat: 9:00 AM – 6:30 PM</span></div>
        </div>
      </div>
    </div>
    <div class="footer-btm">
      <p>© 2026 MG Windows &amp; Doors. All rights reserved.</p>
      <p><a href="#">Privacy Policy</a> · <a href="#">Terms</a> · <a href="#">Sitemap</a></p>
    </div>
  </div>
</footer>
<a href="https://wa.me/919789585081" class="wa-float" target="_blank" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
<div class="btt" id="btt"><i class="fas fa-chevron-up"></i></div>
`;

document.getElementById('nav-placeholder').innerHTML = NAV_HTML;
document.getElementById('footer-placeholder').innerHTML = FOOTER_HTML;

// ── SMOOTH SCROLL for About Us nav link ──
// Works on index.html (same page) AND on other pages (redirects to index.html#about)
document.addEventListener('click', function(e) {
  const link = e.target.closest('.about-nav-link');
  if (!link) return;

  const isHomePage = window.location.pathname.endsWith('index.html') || window.location.pathname.endsWith('/');

  if (isHomePage) {
    e.preventDefault();
    const aboutSection = document.getElementById('about');
    if (aboutSection) {
      aboutSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
      // Close mobile nav if open
      const mobNav = document.getElementById('mob-nav');
      const mobOver = document.getElementById('mob-overlay');
      const hamburger = document.getElementById('hamburger');
      if (mobNav) mobNav.classList.remove('open');
      if (mobOver) mobOver.classList.remove('open');
      if (hamburger) hamburger.classList.remove('active');
      document.body.style.overflow = '';
    }
  }
  // On other pages: let the default href="index.html#about" navigate normally,
  // and shared.css html{scroll-behavior:smooth} handles the scroll on arrival.
});