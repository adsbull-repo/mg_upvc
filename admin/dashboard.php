<?php
require_once 'auth.php';
require_once '../db.php';
require_once 'layout.php';

// Stats
$total_blogs  = $conn->query("SELECT COUNT(*) AS c FROM blogs")->fetch_assoc()['c'];
$latest_blogs = $conn->query("SELECT id, title, tag, created_at FROM blogs ORDER BY created_at DESC LIMIT 5");

admin_header('Dashboard');
?>

<div class="stats-row">
  <div class="stat-card">
    <div class="stat-icon red"><i class="fas fa-newspaper"></i></div>
    <div>
      <div class="stat-label">Total Blog Posts</div>
      <div class="stat-value"><?php echo $total_blogs; ?></div>
    </div>
  </div>
  <div class="stat-card">
    <div class="stat-icon blue"><i class="fas fa-eye"></i></div>
    <div>
      <div class="stat-label">Website</div>
      <div class="stat-value" style="font-size:1rem;margin-top:4px;"><a href="../index.php" target="_blank" style="color:#1565c0;text-decoration:none;">View Live</a></div>
    </div>
  </div>
  <div class="stat-card">
    <div class="stat-icon green"><i class="fas fa-user-shield"></i></div>
    <div>
      <div class="stat-label">Logged in as</div>
      <div class="stat-value" style="font-size:1rem;margin-top:4px;"><?php echo htmlspecialchars($_SESSION['admin_username']); ?></div>
    </div>
  </div>
</div>

<div class="card">
  <div class="card-title">Recent Blog Posts</div>
  <?php if ($latest_blogs && $latest_blogs->num_rows > 0): ?>
  <table class="data-table">
    <thead>
      <tr>
        <th>#</th>
        <th>Title</th>
        <th>Tag</th>
        <th>Date</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $latest_blogs->fetch_assoc()): ?>
      <tr>
        <td><?php echo (int)$row['id']; ?></td>
        <td><?php echo htmlspecialchars(mb_strimwidth($row['title'], 0, 65, '...')); ?></td>
        <td><span style="background:#fce4e4;color:#c0392b;padding:2px 10px;border-radius:100px;font-size:.75rem;font-weight:600;"><?php echo htmlspecialchars($row['tag']); ?></span></td>
        <td><?php echo date('M j, Y', strtotime($row['created_at'])); ?></td>
        <td>
          <div class="actions">
            <a href="edit_blog.php?id=<?php echo (int)$row['id']; ?>" class="btn btn-success btn-sm"><i class="fas fa-edit"></i> Edit</a>
            <a href="../blog-details.php?id=<?php echo (int)$row['id']; ?>" target="_blank" class="btn btn-secondary btn-sm"><i class="fas fa-eye"></i> View</a>
          </div>
        </td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
  <?php else: ?>
    <p style="color:#888;font-size:.9rem;">No blog posts yet. <a href="add_blog.php" style="color:#c0392b;font-weight:600;">Add your first post →</a></p>
  <?php endif; ?>

  <div style="margin-top:18px;">
    <a href="manage_blog.php" class="btn btn-secondary"><i class="fas fa-list"></i> View All Posts</a>
    <a href="add_blog.php" class="btn btn-primary" style="margin-left:10px;"><i class="fas fa-plus"></i> Add New Post</a>
  </div>
</div>

<?php admin_footer(); ?>
