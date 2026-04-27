<?php
require_once 'auth.php';
require_once '../db.php';
require_once 'layout.php';

$success = '';
$error   = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title     = trim($_POST['title'] ?? '');
    $excerpt   = trim($_POST['excerpt'] ?? '');
    $content   = trim($_POST['content'] ?? '');
    $tag       = trim($_POST['tag'] ?? 'General');
    $read_time = trim($_POST['read_time'] ?? '3 min read');

    // IMAGE UPLOAD
    $image = '';
    if (isset($_FILES['image']) && $_FILES['image']['name'] != '') {
        $imageName = $_FILES['image']['name'];
        $tmp       = $_FILES['image']['tmp_name'];

        // Optional: rename image to avoid duplicates
        $image = time() . '_' . $imageName;

        move_uploaded_file($tmp, "../uploads/" . $image);
    }

    if ($title === '' || $content === '') {
        $error = 'Title and content are required.';
    } else {
        // Generate slug
        $slug = strtolower(preg_replace('/[^a-z0-9]+/i', '-', $title));
        $slug = trim($slug, '-');

        $stmt = $conn->prepare(
            "INSERT INTO blogs (title, slug, excerpt, content, image, tag, read_time) VALUES (?, ?, ?, ?, ?, ?, ?)"
        );

        $stmt->bind_param('sssssss', $title, $slug, $excerpt, $content, $image, $tag, $read_time);

        if ($stmt->execute()) {
            $new_id  = $stmt->insert_id;
            $success = "Blog post published successfully! <a href='../blog-details.php?id={$new_id}' target='_blank' style='color:#2e7d32;font-weight:600;'>View Post →</a>";
            $_POST = [];
        } else {
            $error = 'Database error: ' . $stmt->error;
        }
        $stmt->close();
    }
}

admin_header('Add Blog Post');
?>

<?php if ($success): ?>
  <div class="alert alert-success"><i class="fas fa-check-circle"></i> <?php echo $success; ?></div>
<?php endif; ?>

<?php if ($error): ?>
  <div class="alert alert-error"><i class="fas fa-exclamation-circle"></i> <?php echo htmlspecialchars($error); ?></div>
<?php endif; ?>

<div class="card">
  <div class="card-title"><i class="fas fa-plus-circle" style="color:#c0392b;"></i> Add New Blog Post</div>

  <form method="POST" action="" enctype="multipart/form-data">

    <div class="form-group">
      <label>Blog Title *</label>
      <input type="text" name="title" required value="<?php echo htmlspecialchars($_POST['title'] ?? ''); ?>">
    </div>

    <div class="form-row">
      <div class="form-group">
        <label>Tag</label>
        <select name="tag">
          <?php
          $tags = ['Guide','Tips','Maintenance','Design','Comparison','Commercial','General'];
          $sel  = $_POST['tag'] ?? 'General';
          foreach ($tags as $t) {
            $checked = ($sel === $t) ? 'selected' : '';
            echo "<option value='{$t}' {$checked}>{$t}</option>";
          }
          ?>
        </select>
      </div>

      <div class="form-group">
        <label>Read Time</label>
        <input type="text" name="read_time" value="<?php echo htmlspecialchars($_POST['read_time'] ?? '3 min read'); ?>">
      </div>
    </div>

    <div class="form-group">
      <label>Excerpt</label>
      <input type="text" name="excerpt" maxlength="200" value="<?php echo htmlspecialchars($_POST['excerpt'] ?? ''); ?>">
    </div>

    <div class="form-group">
      <label>Upload Image</label>
      <input type="file" name="image">
    </div>

    <div class="form-group">
      <label>Content *</label>
      <textarea name="content" rows="10" required><?php echo htmlspecialchars($_POST['content'] ?? ''); ?></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Publish</button>
    <a href="manage_blog.php" class="btn btn-secondary">Cancel</a>

  </form>
</div>

<?php admin_footer(); ?>