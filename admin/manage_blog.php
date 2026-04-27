<?php
require_once 'auth.php';
require_once '../db.php';
require_once 'layout.php';

$success = '';
$error   = '';

// Handle delete
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $del_id = (int)$_POST['delete_id'];

    // 🔥 1. GET IMAGE NAME
    $stmt = $conn->prepare("SELECT image FROM blogs WHERE id = ?");
    $stmt->bind_param('i', $del_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();

    // 🔥 2. DELETE IMAGE FILE
    if ($row && !empty($row['image'])) {
        $file = "../uploads/" . $row['image'];
        if (file_exists($file)) {
            unlink($file);
        }
    }

    // 🔥 3. DELETE BLOG
    $stmt = $conn->prepare("DELETE FROM blogs WHERE id = ?");
    $stmt->bind_param('i', $del_id);

    if ($stmt->execute()) {
        $success = 'Blog post deleted successfully.';
    } else {
        $error = 'Error deleting post: ' . $stmt->error;
    }
    $stmt->close();
}

// Fetch all posts
$posts = $conn->query("SELECT id, title, image, tag, read_time, created_at FROM blogs ORDER BY created_at DESC");

admin_header('Manage Blogs');
?>

<?php if ($success): ?>
  <div class="alert alert-success"><i class="fas fa-check-circle"></i> <?php echo htmlspecialchars($success); ?></div>
<?php endif; ?>
<?php if ($error): ?>
  <div class="alert alert-error"><i class="fas fa-exclamation-circle"></i> <?php echo htmlspecialchars($error); ?></div>
<?php endif; ?>

<div class="card">
  <div class="card-title" style="display:flex;align-items:center;justify-content:space-between;">
    <span><i class="fas fa-list" style="color:#c0392b;"></i> All Blog Posts</span>
    <a href="add_blog.php" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add New</a>
  </div>

  <?php if ($posts && $posts->num_rows > 0): ?>
  <table class="data-table">
    <thead>
      <tr>
        <th>#</th>
        <th>Image</th>
        <th>Title</th>
        <th>Tag</th>
        <th>Read Time</th>
        <th>Date</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $posts->fetch_assoc()): ?>
      <tr>
        <td><?php echo (int)$row['id']; ?></td>

        <td>
          <?php if ($row['image']): ?>
            <!-- ✅ FIXED IMAGE PATH -->
            <img src="../uploads/<?php echo htmlspecialchars($row['image']); ?>" alt="" class="thumb"/>
          <?php else: ?>
            <div style="width:60px;height:44px;background:#f0f0f0;border-radius:6px;display:flex;align-items:center;justify-content:center;color:#bbb;font-size:.7rem;">No Img</div>
          <?php endif; ?>
        </td>

        <td><?php echo htmlspecialchars(mb_strimwidth($row['title'], 0, 70, '...')); ?></td>

        <td>
          <span style="background:#fce4e4;color:#c0392b;padding:2px 10px;border-radius:100px;font-size:.75rem;font-weight:600;">
            <?php echo htmlspecialchars($row['tag']); ?>
          </span>
        </td>

        <td><?php echo htmlspecialchars($row['read_time']); ?></td>
        <td><?php echo date('M j, Y', strtotime($row['created_at'])); ?></td>

        <td>
          <div class="actions">
            <a href="edit_blog.php?id=<?php echo (int)$row['id']; ?>" class="btn btn-success btn-sm">
              <i class="fas fa-edit"></i> Edit
            </a>

            <a href="../blog-details.php?id=<?php echo (int)$row['id']; ?>" target="_blank" class="btn btn-secondary btn-sm">
              <i class="fas fa-eye"></i> View
            </a>

            <form method="POST" action="" style="display:inline;"
                  onsubmit="return confirm('Delete this blog post? This cannot be undone.');">
              <input type="hidden" name="delete_id" value="<?php echo (int)$row['id']; ?>"/>
              <button type="submit" class="btn btn-danger btn-sm">
                <i class="fas fa-trash-alt"></i> Delete
              </button>
            </form>
          </div>
        </td>

      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>

  <?php else: ?>
    <p style="color:#888;font-size:.9rem;padding:20px 0;">
      No blog posts yet. 
      <a href="add_blog.php" style="color:#c0392b;font-weight:600;">Add your first post →</a>
    </p>
  <?php endif; ?>
</div>

<?php admin_footer(); ?>