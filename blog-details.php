<?php
require_once 'db.php';

// Validate and fetch the blog post
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {
    header('Location: blog.php');
    exit;
}

$stmt = $conn->prepare("SELECT * FROM blogs WHERE id = ?");
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();
$post   = $result->fetch_assoc();
$stmt->close();

if (!$post) {
    header('Location: blog.php');
    exit;
}

// Fetch 3 related posts (excluding current)
$rel_stmt = $conn->prepare("SELECT id, title, excerpt, image, tag FROM blogs WHERE id != ? ORDER BY created_at DESC LIMIT 3");
$rel_stmt->bind_param('i', $id);
$rel_stmt->execute();
$related = $rel_stmt->get_result();
$rel_stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
<title><?php echo htmlspecialchars($post['title']); ?> | MG Windows &amp; Doors</title>
<meta name="description" content="<?php echo htmlspecialchars(mb_strimwidth($post['excerpt'], 0, 160, '...')); ?>"/>
<meta name="author" content="MG Windows &amp; Doors"/>
<!-- Open Graph -->
<meta property="og:type" content="article"/>
<meta property="og:title" content="<?php echo htmlspecialchars($post['title']); ?>"/>
<meta property="og:description" content="<?php echo htmlspecialchars($post['excerpt']); ?>"/>
<meta property="og:image" content="<?php echo htmlspecialchars($post['image']); ?>"/>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
<link rel="stylesheet" href="shared.css"/>
<style>
/* ── Blog Post Layout ── */
.blog-post-hero{position:relative;height:420px;display:flex;align-items:flex-end;overflow:hidden;}
.blog-post-hero-bg{position:absolute;inset:0;background-size:cover;background-position:center;}
.blog-post-hero-overlay{position:absolute;inset:0;background:linear-gradient(to top,rgba(10,0,0,.85) 0%,rgba(0,0,0,.35) 60%,transparent 100%);}
.blog-post-hero-content{position:relative;z-index:2;color:#fff;padding:40px 24px;width:100%;max-width:860px;margin:0 auto;}
.blog-post-hero-content .b-tag{display:inline-block;background:var(--primary);color:#fff;font-size:.72rem;font-weight:700;padding:5px 14px;border-radius:100px;text-transform:uppercase;letter-spacing:1px;margin-bottom:16px;}
.blog-post-hero-content h1{font-family:var(--font-display);font-size:clamp(1.6rem,4vw,2.8rem);font-weight:800;line-height:1.2;margin-bottom:16px;}
.post-meta{display:flex;flex-wrap:wrap;gap:16px;font-size:.82rem;opacity:.85;}
.post-meta span{display:flex;align-items:center;gap:6px;}

/* ── Article Body ── */
.blog-article{padding:64px 0 80px;}
.article-wrap{max-width:820px;margin:0 auto;padding:0 20px;}
.article-wrap h2{font-family:var(--font-display);font-size:clamp(1.3rem,3vw,1.9rem);color:var(--dark);margin:44px 0 14px;line-height:1.3;}
.article-wrap h3{font-size:1.08rem;font-weight:700;color:var(--dark);margin:28px 0 10px;}
.article-wrap p{font-size:.97rem;color:#444;line-height:1.85;margin-bottom:18px;}
.article-wrap ul,.article-wrap ol{margin:0 0 18px 0;padding-left:0;list-style:none;}
.article-wrap ul li,.article-wrap ol li{font-size:.96rem;color:#444;line-height:1.75;padding:6px 0 6px 28px;position:relative;border-bottom:1px solid #f5f5f5;}
.article-wrap ul li::before{content:"✔";position:absolute;left:0;color:var(--primary);font-weight:700;font-size:.85rem;}
.article-wrap ol{counter-reset:ol-cnt;}
.article-wrap ol li{counter-increment:ol-cnt;}
.article-wrap ol li::before{content:counter(ol-cnt)".";position:absolute;left:0;color:var(--primary);font-weight:700;}
.article-wrap table{width:100%;border-collapse:collapse;margin:24px 0 32px;font-size:.9rem;overflow:hidden;border-radius:10px;box-shadow:var(--shadow-sm);}
.article-wrap table th{background:var(--primary);color:#fff;padding:13px 16px;text-align:left;font-weight:600;font-size:.85rem;}
.article-wrap table td{padding:12px 16px;border-bottom:1px solid #f0f0f0;vertical-align:top;line-height:1.55;}
.article-wrap table tr:nth-child(even) td{background:#fafafa;}
.highlight-box{background:linear-gradient(135deg,#fce4e4 0%,#fff5f5 100%);border-left:4px solid var(--primary);border-radius:0 10px 10px 0;padding:20px 24px;margin:28px 0;font-size:.95rem;color:var(--dark-mid);line-height:1.75;}
.highlight-box strong{color:var(--primary);}

/* Author Card */
.author-card{display:flex;align-items:center;gap:18px;background:#f7f7f7;border-radius:12px;padding:22px 26px;margin:44px 0 0;}
.author-avatar{width:58px;height:58px;background:var(--primary);border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;font-size:1.4rem;font-weight:800;font-family:var(--font-display);flex-shrink:0;}
.author-info strong{display:block;font-size:.95rem;font-weight:700;color:var(--dark);margin-bottom:3px;}
.author-info span{font-size:.82rem;color:var(--grey-text);line-height:1.6;}

/* Back link */
.back-link{display:inline-flex;align-items:center;gap:8px;color:var(--primary);font-size:.88rem;font-weight:600;margin-bottom:36px;transition:gap .3s;}
.back-link:hover{gap:12px;}

/* Featured image in article */
.article-featured-img{width:100%;max-height:420px;object-fit:cover;border-radius:12px;margin-bottom:36px;}

/* Related posts */
.related-posts{background:#f7f7f7;padding:64px 0;}
.related-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:24px;margin-top:36px;}
.related-card{background:#fff;border-radius:12px;overflow:hidden;box-shadow:var(--shadow-sm);border:1px solid var(--grey-mid);transition:all .3s;}
.related-card:hover{transform:translateY(-5px);box-shadow:var(--shadow-md);}
.related-card img{width:100%;height:170px;object-fit:cover;}
.related-body{padding:18px;}
.related-body .b-tag{display:inline-block;background:#fce4e4;color:var(--primary);font-size:.68rem;font-weight:700;padding:3px 10px;border-radius:100px;text-transform:uppercase;letter-spacing:1px;margin-bottom:8px;}
.related-body h4{font-size:.92rem;font-weight:700;color:var(--dark);line-height:1.4;margin-bottom:10px;}
.related-body a{font-size:.82rem;font-weight:600;color:var(--primary);display:inline-flex;align-items:center;gap:5px;}
.related-body a:hover{gap:9px;}

@media(max-width:900px){.related-grid{grid-template-columns:1fr 1fr;}}
@media(max-width:640px){
  .blog-post-hero{height:320px;}
  .blog-post-hero-content{padding:28px 16px;}
  .article-wrap{padding:0 16px;}
  .author-card{flex-direction:column;text-align:center;}
  .related-grid{grid-template-columns:1fr;}
}
</style>
</head>
<body>
<div id="nav-placeholder"></div>

<!-- Hero -->
<div class="blog-post-hero">
  <div class="blog-post-hero-bg" style="background-image:url('<?php echo htmlspecialchars($post['image']); ?>')"></div>
  <div class="blog-post-hero-overlay"></div>
  <div class="blog-post-hero-content">
    <span class="b-tag"><?php echo htmlspecialchars($post['tag']); ?></span>
    <h1><?php echo htmlspecialchars($post['title']); ?></h1>
    <div class="post-meta">
      <span><i class="fas fa-calendar-alt"></i> <?php echo date('F j, Y', strtotime($post['created_at'])); ?></span>
      <span><i class="fas fa-clock"></i> <?php echo htmlspecialchars($post['read_time']); ?></span>
      <span><i class="fas fa-user"></i> MG Windows &amp; Doors</span>
    </div>
  </div>
</div>

<!-- Article -->
<section class="blog-article">
  <div class="article-wrap">

    <a href="blog.php" class="back-link"><i class="fas fa-arrow-left"></i> Back to Blog</a>

    <!-- Blog Content (stored as HTML in DB) -->
    <div class="blog-content">
      <?php echo $post['content']; // Content stored as HTML — admin is trusted ?>
    </div>

    <div class="author-card">
      <div class="author-avatar">MG</div>
      <div class="author-info">
        <strong>MG Windows &amp; Doors</strong>
        <span>Coimbatore's trusted manufacturer &amp; installer of uPVC and aluminium windows since 2014. We have completed 500+ residential and commercial projects across Tamil Nadu.</span>
      </div>
    </div>

  </div>
</section>

<!-- Related Posts -->
<?php if ($related && $related->num_rows > 0): ?>
<section class="related-posts">
  <div class="container">
    <div style="text-align:center">
      <span class="section-label">Keep Reading</span>
      <h2 class="section-title">Related Articles</h2>
    </div>
    <div class="related-grid">
      <?php while ($rel = $related->fetch_assoc()): ?>
      <div class="related-card">
        <img src="<?php echo htmlspecialchars($rel['image']); ?>" alt="<?php echo htmlspecialchars($rel['title']); ?>"/>
        <div class="related-body">
          <span class="b-tag"><?php echo htmlspecialchars($rel['tag']); ?></span>
          <h4><?php echo htmlspecialchars($rel['title']); ?></h4>
          <a href="blog-details.php?id=<?php echo (int)$rel['id']; ?>">Read More <i class="fas fa-arrow-right"></i></a>
        </div>
      </div>
      <?php endwhile; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<div class="cta-banner">
  <div class="container">
    <h2>Ready to Upgrade Your Windows?</h2>
    <p>Get a free site visit and personalised quote from our experts in Coimbatore.</p>
    <div class="cta-btns">
      <a href="contact.html#quote" class="btn-primary" style="background:#fff;color:var(--primary);border-color:#fff">Get Free Quote <i class="fas fa-arrow-right"></i></a>
      <a href="tel:+919789585081" class="btn-outline-white"><i class="fas fa-phone-alt" style="transform:scaleX(-1);display:inline-block;"></i> Call Now</a>
    </div>
  </div>
</div>

<div id="footer-placeholder"></div>
<script src="nav.js"></script><script src="shared.js"></script>
</body>
</html>
