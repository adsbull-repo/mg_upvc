<?php
require_once 'auth.php';
require_once '../db.php';
require_once 'layout.php';

$success = '';
$error   = '';

// Validate ID
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    header('Location: manage_blog.php');
    exit;
}

// Fetch current data
$stmt = $conn->prepare("SELECT * FROM blogs WHERE id = ?");
$stmt->bind_param('i', $id);
$stmt->execute();
$post = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$post) {
    header('Location: manage_blog.php');
    exit;
}

// Handle update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title     = trim($_POST['title']     ?? '');
    $excerpt   = trim($_POST['excerpt']   ?? '');
    $content   = trim($_POST['content']   ?? '');
    $tag       = trim($_POST['tag']       ?? 'General');
    $read_time = trim($_POST['read_time'] ?? '3 min read');

    // ✅ KEEP OLD IMAGE BY DEFAULT
    $image = $post['image'];

    // 🔥 IMAGE UPLOAD + REPLACE
    if (isset($_FILES['image']) && $_FILES['image']['name'] != '') {

        // Delete old image
        if (!empty($post['image'])) {
            $oldPath = "../uploads/" . $post['image'];
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }
        }

        // Upload new image
        $newName = time() . "_" . $_FILES['image']['name'];
        $tmp     = $_FILES['image']['tmp_name'];

        move_uploaded_file($tmp, "../uploads/" . $newName);

        $image = $newName;
    }

    if ($title === '' || $content === '') {
        $error = 'Title and content are required.';
    } else {
        $slug = strtolower(preg_replace('/[^a-z0-9]+/i', '-', $title));
        $slug = trim($slug, '-');

        $stmt = $conn->prepare(
            "UPDATE blogs SET title=?, slug=?, excerpt=?, content=?, image=?, tag=?, read_time=? WHERE id=?"
        );
        $stmt->bind_param('sssssssi', $title, $slug, $excerpt, $content, $image, $tag, $read_time, $id);

        if ($stmt->execute()) {
            $success = "Blog post updated! <a href='../blog-details.php?id={$id}' target='_blank' style='color:#2e7d32;font-weight:600;'>View Post →</a>";

            // Refresh post data
            $stmt2 = $conn->prepare("SELECT * FROM blogs WHERE id = ?");
            $stmt2->bind_param('i', $id);
            $stmt2->execute();
            $post = $stmt2->get_result()->fetch_assoc();
            $stmt2->close();

        } else {
            $error = 'Database error: ' . $stmt->error;
        }
        $stmt->close();
    }
}

admin_header('Edit Blog Post');
?>

<?php if ($success): ?>
  <div class="alert alert-success"><i class="fas fa-check-circle"></i> <?php echo $success; ?></div>
<?php endif; ?>

<?php if ($error): ?>
  <div class="alert alert-error"><i class="fas fa-exclamation-circle"></i> <?php echo htmlspecialchars($error); ?></div>
<?php endif; ?>

<div class="card">
  <div class="card-title">
    <i class="fas fa-edit" style="color:#c0392b;"></i> Edit Blog Post #<?php echo $id; ?>
  </div>

  <form method="POST" action="" enctype="multipart/form-data">

    <div class="form-group">
      <label>Blog Title *</label>
      <input type="text" name="title" required
             value="<?php echo htmlspecialchars($post['title']); ?>"/>
    </div>

    <div class="form-row">
      <div class="form-group">
        <label>Tag</label>
        <select name="tag">
          <?php
          $tags = ['Guide','Tips','Maintenance','Design','Comparison','Commercial','General'];
          foreach ($tags as $t) {
            $selected = ($post['tag'] === $t) ? 'selected' : '';
            echo "<option value='{$t}' {$selected}>{$t}</option>";
          }
          ?>
        </select>
      </div>

      <div class="form-group">
        <label>Read Time</label>
        <input type="text" name="read_time"
               value="<?php echo htmlspecialchars($post['read_time']); ?>"/>
      </div>
    </div>

    <div class="form-group">
      <label>Excerpt</label>
      <input type="text" name="excerpt" maxlength="200"
             value="<?php echo htmlspecialchars($post['excerpt']); ?>"/>
    </div>

    <div class="form-group">
      <label>Replace Image</label>
      <input type="file" name="image">

      <?php if ($post['image']): ?>
        <div style="margin-top:10px;">
          <img src="../uploads/<?php echo htmlspecialchars($post['image']); ?>" 
               style="max-height:120px;border-radius:8px;border:1px solid #e2e8f0;">
          <div style="font-size:.75rem;color:#888;">Current image</div>
        </div>
      <?php endif; ?>
    </div>

    <div class="form-group">
      <label>Content *</label>
      <textarea name="content"><?php echo htmlspecialchars($post['content']); ?></textarea>
    </div>

    <div style="display:flex;gap:12px;flex-wrap:wrap;">
      <button type="submit" class="btn btn-primary">
        <i class="fas fa-save"></i> Save Changes
      </button>

      <a href="../blog-details.php?id=<?php echo $id; ?>" target="_blank" class="btn btn-secondary">
        <i class="fas fa-eye"></i> Preview
      </a>

      <a href="manage_blog.php" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Back
      </a>
    </div>

  </form>
</div>

<?php admin_footer(); ?>