<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/><meta name="viewport" content="width=device-width,initial-scale=1.0"/>
<title>MG Windows & Doors – Premium uPVC & Aluminium in Coimbatore</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
<link rel="stylesheet" href="shared.css"/>
<style>

/* ══ HERO CAROUSEL ══ */
#hero{position:relative;width:100%;height:91vh;min-height:480px;overflow:hidden;}
.slides{position:relative;width:100%;height:100%;}
.slide{position:absolute;inset:0;opacity:0;transition:opacity .9s ease;display:flex;align-items:center;}
.slide.active{opacity:1;z-index:1;}
.slide-bg{position:absolute;inset:0;background-size:cover;background-position:center;transform:scale(1.05);transition:transform 6s ease;}
.slide.active .slide-bg{transform:scale(1);}
.slide-ov{position:absolute;inset:0;background:linear-gradient(to right,rgba(10,0,0,.82) 0%,rgba(10,0,0,.55) 45%,rgba(0,0,0,.18) 100%);}
.slide-content{position:relative;z-index:2;text-align:left;color:#fff;padding:0 6vw;max-width:580px;box-sizing:border-box;}
.slide-badge{display:inline-block;background:rgba(255,255,255,.13);border:1px solid rgba(255,255,255,.28);backdrop-filter:blur(4px);padding:6px 18px;border-radius:100px;font-size:.76rem;font-weight:600;letter-spacing:2px;text-transform:uppercase;margin-bottom:18px;color:#ffcdd2;}
.slide-content h1{font-family:'Playfair Display',serif;font-size:clamp(1.5rem,3.8vw,3rem);font-weight:800;line-height:1.18;margin-bottom:14px;text-shadow:0 2px 20px rgba(0,0,0,.4);}
.slide-content p{font-size:clamp(.85rem,1.5vw,1rem);line-height:1.7;color:rgba(255,255,255,.87);margin-bottom:28px;max-width:480px;}
.slide-btns{display:flex;gap:12px;flex-wrap:wrap;}
/* Uniform size for all carousel buttons */
.slide-btns .btn-primary,
.slide-btns .btn-outline-white{
  min-width:200px;
  justify-content:center;
  padding:13px 22px !important;
  font-size:.9rem !important;
  min-height:48px !important;
  box-sizing:border-box !important;
}

/* Carousel arrows — hidden on mobile */
.car-prev,.car-next{position:absolute;top:50%;z-index:10;transform:translateY(-50%);background:rgba(255,255,255,.14);border:1px solid rgba(255,255,255,.28);backdrop-filter:blur(6px);color:#fff;width:48px;height:48px;border-radius:50%;display:flex;align-items:center;justify-content:center;cursor:pointer;transition:all .3s ease;font-size:1rem;}
.car-prev{left:22px;}.car-next{right:22px;}
.car-prev:hover,.car-next:hover{background:var(--primary);border-color:var(--primary);transform:translateY(-50%) scale(1.08);}
.car-dots{position:absolute;bottom:26px;left:50%;transform:translateX(-50%);z-index:10;display:flex;gap:9px;}
.dot{width:8px;height:8px;border-radius:100px;background:rgba(255,255,255,.42);cursor:pointer;transition:all .3s ease;}
.dot.active{width:28px;background:#fff;}

/* ══ ABOUT ══ */
#about{padding:92px 0;background:#fff;}
.about-grid{display:grid;grid-template-columns:1fr 1fr;gap:68px;align-items:center;}
.about-img-wrap{position:relative;}
.about-img{width:100%;height:460px;object-fit:cover;border-radius:16px;}
.about-badge{position:absolute;bottom:-22px;right:-22px;background:var(--primary);color:#fff;border-radius:12px;padding:18px 22px;box-shadow:var(--shadow-md);text-align:center;}
.about-badge strong{display:block;font-size:2.2rem;font-weight:800;font-family:'Playfair Display',serif;line-height:1;}
.about-badge span{font-size:.76rem;font-weight:500;opacity:.9;}
.bullets-grid{display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-top:26px;}

/* ══ PRODUCTS — Clean grid, no ghost cells ══ */
#products{padding:92px 0;background:var(--grey-light);}
.cat-header{display:flex;align-items:center;gap:14px;margin:48px 0 18px;}
.cat-header:first-of-type{margin-top:0;}
.cat-bar{width:5px;height:36px;border-radius:3px;flex-shrink:0;}
.cat-bar.upvc{background:var(--primary);}
.cat-bar.alum{background:#185fa5;}
.cat-bar.fiber{background:#3b6d11;}
.cat-label{flex:1;}
.cat-label small{display:block;font-size:.68rem;font-weight:600;letter-spacing:1.8px;text-transform:uppercase;color:var(--grey-text);margin-bottom:2px;}
.cat-label strong{display:block;font-size:1.08rem;font-weight:700;color:var(--dark);}
/* No count badge */

/* Auto-fill grid: fills space perfectly, no orphan whitespace */
.prod-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:22px;}
/* 2-item row (uPVC, Aluminium) — force 2 cols on desktop */
.prod-grid-2{display:grid;grid-template-columns:repeat(2,1fr);gap:22px;}
/* 1-item row (Fiber) */
.prod-grid-1{display:grid;grid-template-columns:repeat(auto-fill,minmax(320px,1fr));gap:22px;}

/* ══ WHY CHOOSE MG — Flip Cards ══ */
#why{padding:92px 0;background:#fff;}
.why-grid{display:grid;grid-template-columns:repeat(5,1fr);gap:18px;}

/* Flip card wrapper */
.why-card{perspective:900px;min-height:220px;cursor:default;}
.why-inner{position:relative;width:100%;height:100%;min-height:220px;transform-style:preserve-3d;transition:transform .55s cubic-bezier(.4,0,.2,1);}
.why-card:hover .why-inner{transform:rotateY(180deg);}

/* Front face */
.why-front,.why-back{
  position:absolute;inset:0;
  backface-visibility:hidden;
  -webkit-backface-visibility:hidden;
  border-radius:14px;
  padding:26px 18px;
  text-align:center;
}
.why-front{
  background:var(--grey-light);
  border-top:4px solid var(--primary);
  display:flex;flex-direction:column;align-items:center;justify-content:center;
}
.why-icon{width:58px;height:58px;background:#fce4e4;border-radius:14px;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;font-size:1.4rem;color:var(--primary);}
.why-front h3{font-size:.92rem;font-weight:700;color:var(--dark);line-height:1.4;}

/* Back face */
.why-back{
  background:var(--primary);
  transform:rotateY(180deg);
  display:flex;flex-direction:column;align-items:center;justify-content:center;
  gap:12px;
}
.why-back .back-icon{font-size:1.8rem;color:rgba(255,255,255,.7);}
.why-back h3{font-size:.92rem;font-weight:700;color:#fff;line-height:1.3;}
.why-back p{font-size:.82rem;color:rgba(255,255,255,.88);line-height:1.6;}

/* ══ QUOTE ══ */
#quote{padding:92px 0;background:var(--grey-light);}
.quote-grid{display:grid;grid-template-columns:1fr 1fr;gap:60px;align-items:start;}
.quote-feats{display:flex;flex-direction:column;gap:13px;margin-top:26px;}
.qf{display:flex;align-items:center;gap:11px;font-size:.88rem;font-weight:500;color:var(--dark-mid);}
.qf-ico{width:36px;height:36px;background:#fce4e4;border-radius:8px;display:flex;align-items:center;justify-content:center;color:var(--primary);font-size:.88rem;flex-shrink:0;}
.form-wrap{background:#fff;border-radius:16px;padding:34px;box-shadow:var(--shadow-sm);}
.form-wrap h3{font-size:1.2rem;font-weight:700;margin-bottom:5px;}
.form-wrap .sub{font-size:.84rem;color:var(--grey-text);margin-bottom:22px;}
#quote-form{display:flex;flex-direction:column;gap:13px;}

/* ══ BLOG ══ */
#blog{padding:92px 0;background:#fff;}
.blog-hdr{display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:44px;}
.view-all{font-size:.86rem;font-weight:600;color:var(--primary);display:inline-flex;align-items:center;gap:6px;transition:gap .3s ease;}
.view-all:hover{gap:11px;}
.blog-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:26px;}
.blog-card{border-radius:14px;overflow:hidden;box-shadow:var(--shadow-sm);background:#fff;transition:all .3s ease;border:1px solid var(--grey-mid);}
.blog-card:hover{transform:translateY(-5px);box-shadow:var(--shadow-md);}
.blog-img{width:100%;height:200px;overflow:hidden;position:relative;}
.blog-img img{width:100%;height:100%;object-fit:cover;transition:transform .45s ease;}
.blog-card:hover .blog-img img{transform:scale(1.06);}
.blog-tag{position:absolute;bottom:12px;left:12px;background:var(--primary);color:#fff;font-size:.7rem;font-weight:700;padding:3px 11px;border-radius:100px;text-transform:uppercase;letter-spacing:.8px;}
.blog-body{padding:22px;}
.blog-meta{display:flex;gap:14px;margin-bottom:10px;}
.bmeta{font-size:.76rem;color:var(--grey-text);display:flex;align-items:center;gap:5px;}
.blog-body h3{font-size:1rem;font-weight:700;margin-bottom:8px;color:var(--dark);line-height:1.4;}
.blog-body p{font-size:.83rem;color:var(--grey-text);line-height:1.6;margin-bottom:14px;}
.blog-link{font-size:.83rem;font-weight:600;color:var(--primary);display:inline-flex;align-items:center;gap:6px;transition:gap .3s ease;}
.blog-card:hover .blog-link{gap:11px;}

/* ══ TESTIMONIALS ══ */
#testi{padding:92px 0;background:var(--grey-light);}
.testi-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:24px;margin-top:44px;}
.testi-card{background:#fff;border-radius:14px;padding:28px;box-shadow:var(--shadow-sm);border-left:4px solid var(--primary);}
.stars{color:#f59e0b;font-size:.9rem;margin-bottom:12px;}
.testi-text{font-size:.88rem;color:var(--dark-mid);line-height:1.7;margin-bottom:18px;font-style:italic;}
.testi-author{display:flex;align-items:center;gap:12px;}
.ta-avatar{width:42px;height:42px;border-radius:50%;background:var(--primary);color:#fff;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:1rem;flex-shrink:0;}
.ta-name{font-size:.88rem;font-weight:700;color:var(--dark);}
.ta-place{font-size:.77rem;color:var(--grey-text);}

/* ══════════════════════════════════════
   RESPONSIVE — Mobile, Tablet, Desktop
   ══════════════════════════════════════ */

/* Tablet: 769–1024px */
@media(min-width:769px) and (max-width:1024px){
  .why-grid{grid-template-columns:repeat(3,1fr);}
  .why-inner{min-height:200px;}
  .why-front,.why-back{min-height:200px;}
  .about-grid{gap:40px;}
  .about-img{height:340px;}
  .prod-grid-2{grid-template-columns:repeat(2,1fr);}
  .blog-grid{grid-template-columns:repeat(2,1fr);}
  .testi-grid{grid-template-columns:repeat(2,1fr);}
  .quote-grid{gap:36px;}
}

/* Mobile large: 481–768px */
@media(max-width:768px){
  /* Hero */
  #hero{height:70vmax;min-height:380px;}
  .slide-content{padding:0 20px;max-width:100%;}
  .slide-content h1{font-size:clamp(1.2rem,5.5vw,1.8rem);}
  .slide-content p{font-size:.82rem;margin-bottom:16px;}
  .slide-badge{font-size:.68rem;padding:5px 14px;}
  /* Hide carousel arrows on small screens */
  .car-prev,.car-next{display:none !important;}

  /* Sections */
  #about,#products,#why,#quote,#blog,#testi{padding:52px 0;}

  /* About */
  .about-grid{grid-template-columns:1fr;gap:32px;}
  .about-img{height:240px;}
  .about-badge{bottom:-14px;right:-6px;padding:12px 16px;}
  .about-badge strong{font-size:1.7rem;}
  .bullets-grid{grid-template-columns:1fr;}

  /* Products */
  .prod-grid,.prod-grid-2,.prod-grid-1{grid-template-columns:1fr;}

  /* Why — 2 columns on tablet-mobile */
  .why-grid{grid-template-columns:repeat(2,1fr);gap:14px;}
  .why-inner,.why-front,.why-back{min-height:200px;}
  .why-front h3{font-size:.86rem;}
  .why-back p{font-size:.78rem;}

  /* Quote */
  .quote-grid{grid-template-columns:1fr;gap:32px;}
  .form-wrap{padding:22px;}

  /* Blog */
  .blog-grid{grid-template-columns:1fr;}
  .blog-hdr{flex-direction:column;align-items:flex-start;gap:10px;}

  /* Testi */
  .testi-grid{grid-template-columns:1fr;}

  /* Buttons in hero */
  .slide-btns{gap:8px;}
  .slide-btns .btn-primary,.slide-btns .btn-outline-white{
    padding:10px 16px !important;font-size:.82rem !important;min-height:40px !important;min-width:160px !important;
  }
}

/* Mobile small: up to 480px */
@media(max-width:480px){
  #hero{height:80vmax;min-height:340px;}
  .slide-content h1{font-size:clamp(1.1rem,5.8vw,1.5rem);}
  .slide-content p{display:none;}

  /* Why — single column on very small */
  .why-grid{grid-template-columns:1fr;}
  .why-inner,.why-front,.why-back{min-height:160px;}

  /* Products */
  .prod-grid,.prod-grid-2,.prod-grid-1{grid-template-columns:1fr;}

  .testi-grid{grid-template-columns:1fr;}
  .blog-grid{grid-template-columns:1fr;}
  .stats-grid{grid-template-columns:1fr 1fr;}
  .about-img{height:200px;}

  /* CTA banner buttons stack */
  .cta-btns{flex-direction:column;align-items:center;}
  .cta-btns .btn-primary,.cta-btns .btn-outline-white{width:100%;justify-content:center;max-width:320px;}
}

/* Touch device flip cards — tap to flip */
@media(hover:none){
  .why-card.flipped .why-inner{transform:rotateY(180deg);}
  .why-card:hover .why-inner{transform:none;}
}
</style>
</head>
<body>
<div id="nav-placeholder"></div>

<!-- ══════════════ HERO ══════════════ -->
<section id="hero">
  <div class="slides" id="carousel">
    <div class="slide active">
      <div class="slide-bg" style="background-image:url('https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=1600&q=80&fit=crop&auto=format')"></div>
      <div class="slide-ov"></div>
      <div class="slide-content">
        <div class="slide-badge">Coimbatore's #1 Choice</div>
        <h1>Premium uPVC & Aluminium Windows and Doors in Coimbatore</h1>
        <p>End-to-End Window & Door Solutions for Homes, Villas & Commercial Spaces</p>
        <div class="slide-btns">
          <a href="contact.html#quote" class="btn-primary">Get Free Consultation <i class="fas fa-arrow-right"></i></a>
          <a href="upvc.html" class="btn-outline-white">View Products</a>
        </div>
      </div>
    </div>
    <div class="slide">
      <div class="slide-bg" style="background-image:url('https://images.unsplash.com/photo-1580587771525-78b9dba3b914?w=1600&q=80&fit=crop&auto=format')"></div>
      <div class="slide-ov"></div>
      <div class="slide-content">
        <div class="slide-badge">Built for South India</div>
        <h1>Custom-built. Weather-resistant. Designed for South Indian Climate.</h1>
        <p>Engineered to withstand extreme heat, humidity, and monsoon rains — delivering lasting performance year after year.</p>
        <div class="slide-btns">
          <a href="contact.html#quote" class="btn-primary">Get Expert Advice <i class="fas fa-arrow-right"></i></a>
          <a href="#about" class="btn-outline-white">About Us</a>
        </div>
      </div>
    </div>
    <div class="slide">
      <div class="slide-bg" style="background-image:url('https://images.unsplash.com/photo-1497366216548-37526070297c?w=1600&q=80&fit=crop&auto=format')"></div>
      <div class="slide-ov"></div>
      <div class="slide-content">
        <div class="slide-badge">Residential & Commercial</div>
        <h1>Complete Window & Door Solutions for Residential and Commercial Spaces</h1>
        <p>From individual homes to large commercial complexes — precision-crafted products with seamless installation.</p>
        <div class="slide-btns">
          <a href="contact.html#quote" class="btn-primary">Request a Quote <i class="fas fa-arrow-right"></i></a>
          <a href="aluminium.html" class="btn-outline-white">Aluminium Range</a>
        </div>
      </div>
    </div>
    <div class="slide">
      <div class="slide-bg" style="background-image:url('/home\ hero.jpg')"></div>
      <div class="slide-ov"></div>
      <div class="slide-content">
        <div class="slide-badge">Modern Living</div>
        <h1>Modern Design + Durability + Performance</h1>
        <p>Elevate your space with contemporary aesthetics and uncompromising quality — every product engineered to perfection.</p>
        <div class="slide-btns">
          <a href="contact.html#quote" class="btn-primary">Get Free Consultation <i class="fas fa-arrow-right"></i></a>
          <a href="gallery.html" class="btn-outline-white">View Gallery</a>
        </div>
      </div>
    </div>
  </div>
  <button class="car-prev" id="car-prev"><i class="fas fa-chevron-left"></i></button>
  <button class="car-next" id="car-next"><i class="fas fa-chevron-right"></i></button>
  <div class="car-dots" id="car-dots">
    <div class="dot active" data-dot="0"></div>
    <div class="dot" data-dot="1"></div>
    <div class="dot" data-dot="2"></div>
    <div class="dot" data-dot="3"></div>
  </div>
</section>

<!-- TRUST BAR -->
<div class="trust-bar">
  <div class="container">
    <div class="trust-items">
      <div class="trust-item"><i class="fas fa-shield-alt"></i> 10+ Years of Excellence</div>
      <div class="trust-item"><i class="fas fa-home"></i> 5000+ Projects Delivered</div>
      <div class="trust-item"><i class="fas fa-star"></i> ISO Certified Products</div>
      <div class="trust-item"><i class="fas fa-tools"></i> Expert Installation</div>
      <div class="trust-item"><i class="fas fa-headset"></i> After-Sales Support</div>
    </div>
  </div>
</div>

<!-- ══════════════ PRODUCTS ══════════════ -->
<section id="products">
  <div class="container">
    <div class="fade-up" style="text-align:center">
      <span class="section-label">Our Products</span>
      <h2 class="section-title">Premium Quality Windows & Doors</h2>
      <p class="section-sub" style="margin:0 auto 44px">Explore our complete range of high-performance uPVC, aluminium, and fiber products — custom-designed for Indian homes and commercial spaces.</p>
    </div>

    <!-- uPVC Category -->
    <div class="cat-header fade-up">
      <div class="cat-bar upvc"></div>
      <div class="cat-label">
        <small>Category 01</small>
        <strong>uPVC Products</strong>
      </div>
    </div>
    <div class="prod-grid-2 fade-up">
      <div class="product-card" onclick="location.href='upvc.html#upvc-windows'">
        <div class="pc-img">
          <img src="images index/upvc window product home.png" alt="uPVC Windows"/>
          <div class="pc-overlay"></div>
        </div>
        <div class="pc-body">
          <span class="pc-tag">uPVC</span>
          <h3>uPVC Windows</h3>
          <p>Energy-efficient, termite-proof, and soundproof windows with multi-chambered profiles for superior insulation. 8 types available.</p>
          <span class="pc-link">View All Types <i class="fas fa-arrow-right"></i></span>
        </div>
      </div>
      <div class="product-card" onclick="location.href='upvc.html#upvc-doors'">
        <div class="pc-img">
          <img src="images index/upvc door product home.png" alt="uPVC Doors"/>
          <div class="pc-overlay"></div>
        </div>
        <div class="pc-body">
          <span class="pc-tag">uPVC</span>
          <h3>uPVC Doors</h3>
          <p>Strong, weather-resistant uPVC doors with multi-point locking. Available in sliding, casement, french & bathroom styles.</p>
          <span class="pc-link">View All Types <i class="fas fa-arrow-right"></i></span>
        </div>
      </div>
    </div>

    <!-- Aluminium Category -->
    <div class="cat-header fade-up">
      <div class="cat-bar alum"></div>
      <div class="cat-label">
        <small>Category 02</small>
        <strong>Aluminium Products</strong>
      </div>
    </div>
    <div class="prod-grid-2 fade-up">
      <div class="product-card" onclick="location.href='aluminium.html#alum-windows'">
        <div class="pc-img">
          <img src="images index/aluminium window.png" alt="Aluminium Windows"/>
          <div class="pc-overlay"></div>
        </div>
        <div class="pc-body">
          <span class="pc-tag">Aluminium</span>
          <h3>Aluminium Windows</h3>
          <p>Slim-profile aluminium windows offering large glass areas, maximum natural light and sleek modern aesthetics.</p>
          <span class="pc-link">View All Types <i class="fas fa-arrow-right"></i></span>
        </div>
      </div>
      <div class="product-card" onclick="location.href='aluminium.html#alum-doors'">
        <div class="pc-img">
          <img src="images index/aluminium door.png" alt="Aluminium Doors"/>
          <div class="pc-overlay"></div>
        </div>
        <div class="pc-body">
          <span class="pc-tag">Aluminium</span>
          <h3>Aluminium Doors</h3>
          <p>Robust aluminium doors for entrances, balconies, offices and partitions — combining strength with elegant design.</p>
          <span class="pc-link">View All Types <i class="fas fa-arrow-right"></i></span>
        </div>
      </div>
    </div>

    <!-- Fiber Category -->
    <div class="cat-header fade-up">
      <div class="cat-bar fiber"></div>
      <div class="cat-label">
        <small>Category 03</small>
        <strong>Fiber Products</strong>
      </div>
    </div>
    <div class="prod-grid-1 fade-up">
      <div class="product-card" onclick="location.href='fiber.html'">
        <div class="pc-img">
          <img src="images index/fiber door.png" alt="Fiber Doors"/>
          <div class="pc-overlay"></div>
        </div>
        <div class="pc-body">
          <span class="pc-tag">Fiber</span>
          <h3>Fiber Doors</h3>
          <p>100% waterproof, termite-proof fiber doors with a premium wood-like finish — the smart modern alternative to wooden doors.</p>
          <span class="pc-link">Explore Details <i class="fas fa-arrow-right"></i></span>
        </div>
      </div>
    </div>

  </div>
</section>

<!-- STATS -->
<div class="stats-strip" id="stats-strip">
  <div class="container">
    <div class="stats-grid">
      <div class="stat-item"><div class="stat-num" data-count="5000" data-suffix="+">5000+</div><div class="stat-lbl">Projects Completed</div></div>
      <div class="stat-item"><div class="stat-num" data-count="10" data-suffix="+">10+</div><div class="stat-lbl">Years Experience</div></div>
      <div class="stat-item"><div class="stat-num" data-count="4800" data-suffix="+">4800+</div><div class="stat-lbl">Happy Customers</div></div>
      <div class="stat-item"><div class="stat-num" data-count="15" data-suffix="+">15+</div><div class="stat-lbl">Cities Served</div></div>
    </div>
  </div>
</div>

<!-- ══════════════ ABOUT ══════════════ -->
<section id="about">
  <div class="container">
    <div class="about-grid">
      <div class="about-img-wrap fade-up">
        <img class="about-img" src="/images index/tshirt.png" alt="MG Windows & Doors team" />
        <div class="about-badge"><strong>10+</strong><span>Years of Trust</span></div>
      </div>
      <div class="fade-up">
        <span class="section-label">About MG Windows & Doors</span>
        <h2 class="section-title">Your Trusted Window & Door Experts</h2>
        <p class="section-sub" style="margin-bottom:16px">We are a Coimbatore-based company specializing in uPVC windows & doors, aluminium windows & doors, and fiber doors, offering complete end-to-end solutions for residential and commercial spaces.</p>
        <p style="color:var(--grey-text);font-size:.9rem;line-height:1.78;margin-bottom:6px">With years of industry expertise, we focus on delivering products that combine durability, design, and performance. Whether you're building a new home or upgrading your existing space, we provide customized solutions that enhance both aesthetics and functionality.</p>
        <div class="bullets-grid" id="about-services">
          <div class="benefit-pill"><i class="fas fa-drafting-compass"></i> Custom Design</div>
          <div class="benefit-pill"><i class="fas fa-industry"></i> Manufacturing</div>
          <div class="benefit-pill"><i class="fas fa-hard-hat"></i> Installation</div>
          <div class="benefit-pill"><i class="fas fa-sync-alt"></i> Replacement</div>
          <div class="benefit-pill"><i class="fas fa-wrench"></i> Maintenance</div>
          <div class="benefit-pill"><i class="fas fa-headset"></i> Post-Sale Support</div>
        </div>
        <div style="margin-top:30px;display:flex;gap:12px;flex-wrap:wrap">
          <a href="contact.html#quote" class="btn-primary">Get Free Quote <i class="fas fa-arrow-right"></i></a>
          <a href="upvc.html" class="btn-outline-red">Our Products <i class="fas fa-arrow-right"></i></a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ══════════════ WHY CHOOSE US — Flip Cards ══════════════ -->
<section id="why">
  <div class="container">
    <div class="fade-up" style="text-align:center">
      <span class="section-label">Why Choose MG</span>
      <h2 class="section-title">What Sets Us Apart</h2>
      <p class="section-sub" style="margin:0 auto 44px">We deliver more than just windows and doors — a complete experience built on quality, trust, and lasting relationships.</p>
    </div>
    <div class="why-grid" id="why-grid">

      <div class="why-card fade-up">
        <div class="why-inner">
          <div class="why-front">
            <div class="why-icon"><i class="fas fa-gem"></i></div>
            <h3>High-Quality uPVC & Aluminium Materials</h3>
          </div>
          <div class="why-back">
            <i class="fas fa-gem back-icon"></i>
            <h3>Premium Materials</h3>
            <p>Premium-grade materials sourced from certified manufacturers for superior performance and lasting durability.</p>
          </div>
        </div>
      </div>

      <div class="why-card fade-up">
        <div class="why-inner">
          <div class="why-front">
            <div class="why-icon"><i class="fas fa-palette"></i></div>
            <h3>Customized Design Solutions</h3>
          </div>
          <div class="why-back">
            <i class="fas fa-palette back-icon"></i>
            <h3>Tailored For You</h3>
            <p>Every product tailored to your exact specifications — dimensions, colors, finishes & glass types to match your vision.</p>
          </div>
        </div>
      </div>

      <div class="why-card fade-up">
        <div class="why-inner">
          <div class="why-front">
            <div class="why-icon"><i class="fas fa-hard-hat"></i></div>
            <h3>Expert Installation Team</h3>
          </div>
          <div class="why-back">
            <i class="fas fa-hard-hat back-icon"></i>
            <h3>Flawless Installation</h3>
            <p>Trained installation professionals ensuring a perfect fit, seamless sealing, and smooth operation every time.</p>
          </div>
        </div>
      </div>

      <div class="why-card fade-up">
        <div class="why-inner">
          <div class="why-front">
            <div class="why-icon"><i class="fas fa-tags"></i></div>
            <h3>Affordable Pricing with Best Value</h3>
          </div>
          <div class="why-back">
            <i class="fas fa-tags back-icon"></i>
            <h3>Factory-Direct Pricing</h3>
            <p>Transparent, factory-direct pricing with no hidden costs. Premium quality delivered well within your budget.</p>
          </div>
        </div>
      </div>

      <div class="why-card fade-up">
        <div class="why-inner">
          <div class="why-front">
            <div class="why-icon"><i class="fas fa-handshake"></i></div>
            <h3>Trusted by Customers Across Coimbatore</h3>
          </div>
          <div class="why-back">
            <i class="fas fa-handshake back-icon"></i>
            <h3>5000+ Happy Clients</h3>
            <p>Over 5,000 satisfied customers and growing — a reputation built on reliability, quality, and real results.</p>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ══════════════ QUOTE FORM ══════════════ -->
<section id="quote">
  <div class="container">
    <div class="quote-grid">
      <div class="fade-up">
        <span class="section-label">Free Consultation</span>
        <h2 class="section-title">Looking for the Best uPVC or Aluminium Windows & Doors in Coimbatore?</h2>
        <p style="color:var(--grey-text);line-height:1.75;margin-bottom:6px">Share your requirements and our expert team will get in touch for a free site visit, measurement, and customized quotation.</p>
        <div class="quote-feats" id="quote-features">
          <div class="qf"><div class="qf-ico"><i class="fas fa-clock"></i></div>Quick response within 24 hours</div>
          <div class="qf"><div class="qf-ico"><i class="fas fa-map-marker-alt"></i></div>Free site visit & measurement</div>
          <div class="qf"><div class="qf-ico"><i class="fas fa-file-invoice"></i></div>Detailed, transparent quotation</div>
          <div class="qf"><div class="qf-ico"><i class="fas fa-shield-alt"></i></div>No commitment required</div>
        </div>
      </div>
      <div class="form-wrap fade-up" id="quote-form-section">
        <h3>Get Your Free Quote</h3>
        <div class="sub">Fill in the details and we'll reach out shortly.</div>
        <form id="quote-form">
          <div class="form-row">
            <div class="form-group"><label>Full Name *</label><input type="text" placeholder="Your full name" required/></div>
            <div class="form-group"><label>Phone *</label><input type="tel" placeholder="+91 XXXXX XXXXX" required/></div>
          </div>
          <div class="form-group"><label>Email Address</label><input type="email" placeholder="your@email.com"/></div>
          <div class="form-group"><label>Product Interest</label>
            <select>
              <option value="">Select a product</option>
              <option>uPVC Windows</option><option>uPVC Doors</option>
              <option>Aluminium Windows</option><option>Aluminium Doors</option>
              <option>Fiber Doors</option><option>Multiple Products</option>
            </select>
          </div>
          <div class="form-group"><label>Message</label><textarea placeholder="Tell us about your project — size, quantity, location…"></textarea></div>
          <button type="submit" class="btn-primary" style="width:100%;justify-content:center;margin-top:6px">Get Expert Solution <i class="fas fa-arrow-right"></i></button>
        </form>
        <div id="form-success" class="form-success">✅ Thank you! Our team will contact you within 24 hours.</div>
      </div>
    </div>
  </div>
</section>

<!-- ══════════════ TESTIMONIALS ══════════════ -->
<section id="testi">
  <div class="container">
    <div class="fade-up" style="text-align:center">
      <span class="section-label">Client Testimonials</span>
      <h2 class="section-title">What Our Clients Say</h2>
    </div>
    <div class="testi-grid" id="testimonials">
      <div class="testi-card fade-up"><div class="stars">★★★★★</div><p class="testi-text">"MG Windows delivered exceptional quality uPVC windows for our new villa. The installation was clean and professional. Highly recommend for anyone in Coimbatore!"</p><div class="testi-author"><div class="ta-avatar">RK</div><div><div class="ta-name">Rajesh Kumar</div><div class="ta-place">Saravanampatti, Coimbatore</div></div></div></div>
      <div class="testi-card fade-up"><div class="stars">★★★★★</div><p class="testi-text">"We used MG for our office renovation — aluminium partitions and sliding doors. Fantastic finish, great pricing, and the team was very responsive throughout."</p><div class="testi-author"><div class="ta-avatar">SP</div><div><div class="ta-name">Sudha Priya</div><div class="ta-place">RS Puram, Coimbatore</div></div></div></div>
      <div class="testi-card fade-up"><div class="stars">★★★★★</div><p class="testi-text">"The fiber doors they installed are absolutely stunning — looks exactly like wood but much better durability. Very happy with the post-sale support too."</p><div class="testi-author"><div class="ta-avatar">MA</div><div><div class="ta-name">Murugan A.</div><div class="ta-place">Ganapathy, Coimbatore</div></div></div></div>
    </div>
  </div>
</section>

<!-- ══════════════ BLOG ══════════════ -->
<?php
// ── Dynamic Blog Section (latest 3 posts) ──
require_once 'db.php';
$blog_result = $conn->query("SELECT id, title, excerpt, image, tag, read_time, created_at FROM blogs ORDER BY created_at DESC LIMIT 3");
?>
<section id="blog">
  <div class="container">
    <div class="blog-hdr fade-up">
      <div><span class="section-label">Latest Insights</span><h2 class="section-title">Latest Insights &amp; Updates</h2></div>
      <a href="blog.php" class="view-all">View All <i class="fas fa-arrow-right"></i></a>
    </div>
    <div class="blog-grid" id="blog-grid">
      <?php if ($blog_result && $blog_result->num_rows > 0): ?>
        <?php while ($post = $blog_result->fetch_assoc()): ?>
        <div class="blog-card fade-up">
          <div class="blog-img">
           <img src="uploads/<?php echo htmlspecialchars($post['image']); ?>" alt="<?php echo htmlspecialchars($post['title']); ?>"/>
            <span class="blog-tag"><?php echo htmlspecialchars($post['tag']); ?></span>
          </div>
          <div class="blog-body">
            <div class="blog-meta">
              <span class="bmeta"><i class="fas fa-calendar-alt"></i> <?php echo date('M j, Y', strtotime($post['created_at'])); ?></span>
              <span class="bmeta"><i class="fas fa-clock"></i> <?php echo htmlspecialchars($post['read_time']); ?></span>
            </div>
            <h3><?php echo htmlspecialchars($post['title']); ?></h3>
            <p><?php echo htmlspecialchars(mb_strimwidth($post['excerpt'], 0, 120, '...')); ?></p>
            <a href="blog-details.php?id=<?php echo $post['id']; ?>" class="blog-link">Read More <i class="fas fa-arrow-right"></i></a>
          </div>
        </div>
        <?php endwhile; ?>
      <?php else: ?>
        <p style="color:var(--grey-text);text-align:center;grid-column:1/-1;">No blog posts yet. Check back soon!</p>
      <?php endif; ?>
    </div>
  </div>
</section>

<!-- CTA BANNER -->
<div class="cta-banner">
  <div class="container">
    <h2>Ready to Transform Your Home or Office?</h2>
    <p>Contact us today for a free site visit, expert consultation, and the best pricing on premium windows and doors in Coimbatore.</p>
    <div class="cta-btns">
      <a href="contact.html#quote" class="btn-primary" style="background:#fff;color:var(--primary);border-color:#fff">Get Free Quote <i class="fas fa-arrow-right"></i></a>
      <a href="tel:+919789585081" class="btn-outline-white"><i class="fas fa-phone-alt" style="display:inline-block;transform:scaleX(-1);"></i> Call: +91 97895 85081</a>
    </div>
  </div>
</div>

<div id="footer-placeholder"></div>
<script src="nav.js"></script>
<script src="shared.js"></script>
<script>
// ── CAROUSEL ──
const slides=document.querySelectorAll('.slide'),dots=document.querySelectorAll('.dot');
let cur=0,timer;
function goTo(n){slides[cur].classList.remove('active');dots[cur].classList.remove('active');cur=(n+slides.length)%slides.length;slides[cur].classList.add('active');dots[cur].classList.add('active');}
function next(){goTo(cur+1);}
function reset(){clearInterval(timer);timer=setInterval(next,4500);}
document.getElementById('car-next').addEventListener('click',()=>{next();reset();});
document.getElementById('car-prev').addEventListener('click',()=>{goTo(cur-1);reset();});
dots.forEach(d=>d.addEventListener('click',()=>{goTo(+d.dataset.dot);reset();}));
reset();

// ── TOUCH SWIPE for carousel ──
(function(){
  const hero=document.getElementById('hero');
  let sx=0;
  hero.addEventListener('touchstart',e=>{ sx=e.touches[0].clientX; },{passive:true});
  hero.addEventListener('touchend',e=>{
    const dx=e.changedTouches[0].clientX-sx;
    if(Math.abs(dx)>50){ dx<0?next():goTo(cur-1); reset(); }
  },{passive:true});
})();

// ── FLIP CARDS: tap to flip on touch devices ──
document.querySelectorAll('.why-card').forEach(card=>{
  card.addEventListener('click',()=>{
    if(window.matchMedia('(hover:none)').matches){
      card.classList.toggle('flipped');
    }
  });
});
</script>
</body>
</html>
