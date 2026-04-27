<?php
session_start();

// Already logged in → go to dashboard
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: dashboard.php');
    exit;
}

require_once '../db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($username === '' || $password === '') {
        $error = 'Please enter both username and password.';
    } else {
        // SHA-256 hash to match what setup.sql inserted
        $hashed = hash('sha256', $password);

        $stmt = $conn->prepare("SELECT id, username FROM admin_users WHERE username = ? AND password = ? LIMIT 1");
        $stmt->bind_param('ss', $username, $hashed);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $admin = $result->fetch_assoc();
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_id']        = $admin['id'];
            $_SESSION['admin_username']  = $admin['username'];
            $stmt->close();
            header('Location: dashboard.php');
            exit;
        } else {
            $error = 'Invalid username or password.';
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
<title>Admin Login – MG Windows &amp; Doors</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
<style>
*{box-sizing:border-box;margin:0;padding:0;}
body{font-family:'Poppins',sans-serif;background:#f0f2f5;display:flex;align-items:center;justify-content:center;min-height:100vh;}
.login-card{background:#fff;border-radius:16px;padding:44px 40px;width:100%;max-width:420px;box-shadow:0 8px 32px rgba(0,0,0,.12);}
.login-logo{text-align:center;margin-bottom:28px;}
.login-logo img{height:52px;object-fit:contain;}
.login-logo h1{font-size:1.3rem;font-weight:700;color:#1a1a2e;margin-top:10px;}
.login-logo p{font-size:.82rem;color:#888;margin-top:4px;}
.form-group{margin-bottom:18px;}
.form-group label{display:block;font-size:.83rem;font-weight:600;color:#444;margin-bottom:6px;}
.form-group input{width:100%;padding:11px 14px;border:1.5px solid #e2e8f0;border-radius:8px;font-family:'Poppins',sans-serif;font-size:.9rem;transition:border-color .2s;}
.form-group input:focus{outline:none;border-color:#c0392b;}
.btn-login{width:100%;padding:13px;background:#c0392b;color:#fff;border:none;border-radius:8px;font-family:'Poppins',sans-serif;font-size:.95rem;font-weight:600;cursor:pointer;transition:background .2s;}
.btn-login:hover{background:#a93226;}
.error-msg{background:#fce4e4;color:#c0392b;border-radius:8px;padding:10px 14px;font-size:.84rem;margin-bottom:18px;display:flex;align-items:center;gap:8px;}
.back-site{text-align:center;margin-top:20px;font-size:.82rem;}
.back-site a{color:#c0392b;font-weight:600;text-decoration:none;}
</style>
</head>
<body>
<div class="login-card">
  <div class="login-logo">
    <img src="../logo1.png" alt="MG Windows & Doors"/>
    <h1>Admin Panel</h1>
    <p>MG Windows &amp; Doors, Coimbatore</p>
  </div>

  <?php if ($error): ?>
  <div class="error-msg"><i class="fas fa-exclamation-circle"></i> <?php echo htmlspecialchars($error); ?></div>
  <?php endif; ?>

  <form method="POST" action="">
    <div class="form-group">
      <label for="username">Username</label>
      <input type="text" id="username" name="username" placeholder="admin" required autocomplete="username"
             value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>"/>
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" id="password" name="password" placeholder="••••••••" required autocomplete="current-password"/>
    </div>
    <button type="submit" class="btn-login"><i class="fas fa-sign-in-alt"></i> Login</button>
  </form>

  <div class="back-site"><a href="../index.php"><i class="fas fa-arrow-left"></i> Back to Website</a></div>
</div>
</body>
</html>
