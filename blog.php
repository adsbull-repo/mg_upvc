<?php require_once 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
<title>Blog – MG Windows &amp; Doors, Coimbatore</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
<link rel="stylesheet" href="shared.css"/>

<style>
.blog-page{padding:72px 0 96px;background:#fff;}
.blog-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:28px;margin-top:52px;}
.blog-card{border-radius:14px;overflow:hidden;box-shadow:var(--shadow-sm);background:#fff;transition:all .3s ease;border:1px solid var(--grey-mid);}
.blog-card:hover{transform:translateY(-6px);box-shadow:var(--shadow-md);}
.bi{width:100%;height:210px;overflow:hidden;position:relative;}
.bi img{width:100%;height:100%;object-fit:cover;transition:transform .45s ease;}
.blog-card:hover .bi img{transform:scale(1.06);}
.b-tag{position:absolute;bottom:14px;left:14px;background:var(--primary);color:#fff;font-size:.7rem;font-weight:700;padding:4px 12px;border-radius:100px;text-transform:uppercase;letter-spacing:.8px;}
.bb{padding:24px;}
.bmeta{display:flex;gap:14px;margin-bottom:10px;}
.bm{font-size:.76rem;color:var(--grey-text);display:flex;align-items:center;gap:5px;}
.bb h3{font-size:1.05rem;font-weight:700;margin-bottom:9px;color:var(--dark);line-height:1.4;}
.bb p{font-size:.84rem;color:var(--grey-text);line-height:1.65;margin-bottom:16px;}
.b-link{font-size:.84rem;font-weight:600;color:var(--primary);display:inline-flex;align-items:center;gap:6px;transition:gap .3s ease;}
.blog-card:hover .b-link{gap:11px;}
.no-posts{text-align:center;padding:60px 20px;color:var(--grey-text);font-size:1rem;}
@media(max-width:900px){.blog-grid{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.blog-grid{grid-template-columns:1fr;}}
</style>
</head>

<body>
<div id="nav-placeholder"></div>

<div class="page-hero">
  <div class="page-hero-bg" style="background-image:url('https://images.unsplash.com/photo-1499750310107-5fef28a66643?w=1600&q=80&fit=crop&auto=format')"></div>
  <div class="page-hero-overlay"></div>
  <div class="page-hero-content">
    <div class="breadcrumb"><a href="index.php">Home</a><span>›</span><span>Blog</span></div>
    <h1>Latest Insights &amp; Updates</h1>
    <p>Tips, guides, and expert advice on windows, doors, and home improvement</p>
  </div>
</div>

<section class="blog-page">
  <div class="container">
    <div class="fade-up" style="text-align:center">
      <span class="section-label">Knowledge Hub</span>
      <h2 class="section-title">Expert Tips &amp; Industry Insights</h2>
      <p style="color:var(--grey-text);max-width:560px;margin:12px auto 0;font-size:.95rem;line-height:1.72">
        Stay informed with our latest articles on window and door technology, maintenance tips, and design ideas for your home.
      </p>
    </div>

    <?php
      $result = $conn->query("SELECT id, title, excerpt, image, tag, read_time, created_at FROM blogs ORDER BY created_at DESC");
    ?>

    <div class="blog-grid" id="blog-list">
      <?php if ($result && $result->num_rows > 0): ?>
        <?php while ($post = $result->fetch_assoc()): ?>
        <div class="blog-card fade-up">
          <div class="bi">
            <img src="uploads/<?php echo htmlspecialchars($post['image']); ?>" 
                 alt="<?php echo htmlspecialchars($post['title']); ?>"/>
            <span class="b-tag"><?php echo htmlspecialchars($post['tag']); ?></span>
          </div>

          <div class="bb">
            <div class="bmeta">
              <span class="bm">
                <i class="fas fa-calendar-alt"></i> 
                <?php echo date('F j, Y', strtotime($post['created_at'])); ?>
              </span>
              <span class="bm">
                <i class="fas fa-clock"></i> 
                <?php echo htmlspecialchars($post['read_time']); ?>
              </span>
            </div>

            <h3><?php echo htmlspecialchars($post['title']); ?></h3>

            <p>
              <?php echo htmlspecialchars(mb_strimwidth($post['excerpt'], 0, 150, '...')); ?>
            </p>

            <a href="blog-details.php?id=<?php echo (int)$post['id']; ?>" class="b-link">
              Read More <i class="fas fa-arrow-right"></i>
            </a>
          </div>
        </div>
        <?php endwhile; ?>
      <?php else: ?>
        <div class="no-posts" style="grid-column:1/-1">
          <i class="fas fa-newspaper" style="font-size:2.5rem;color:var(--grey-mid);display:block;margin-bottom:16px;"></i>
          No blog posts yet. Check back soon!
        </div>
      <?php endif; ?>
    </div>

  </div>
</section>

<div class="cta-banner">
  <div class="container">
    <h2>Have a Question About Windows or Doors?</h2>
    <p>Our experts are ready to help — reach out for a free consultation and personalized advice.</p>
    <div class="cta-btns">
      <a href="contact.html#quote" class="btn-primary" style="background:#fff;color:var(--primary);border-color:#fff">
        Talk to an Expert <i class="fas fa-arrow-right"></i>
      </a>
      <a href="tel:+919789585081" class="btn-outline-white">
        <i class="fas fa-phone-alt" style="transform:scaleX(-1);display:inline-block;"></i> Call Now
      </a>
    </div>
  </div>
</div>

<div id="footer-placeholder"></div>

<script src="nav.js"></script>
<script src="shared.js"></script>
</body>
</html>