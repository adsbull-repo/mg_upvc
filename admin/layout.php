<?php
// layout.php — Shared admin HTML shell
// Usage:
//   admin_header($page_title)  → opens <html>…<main>
//   admin_footer()             → closes <main>…</html>

function admin_header(string $page_title): void {
    $username = htmlspecialchars($_SESSION['admin_username'] ?? 'Admin');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
<title><?php echo htmlspecialchars($page_title); ?> – MG Admin</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
<style>
*{box-sizing:border-box;margin:0;padding:0;}
body{font-family:'Poppins',sans-serif;background:#f0f2f5;color:#1a1a2e;}

/* ── Sidebar ── */
.sidebar{position:fixed;top:0;left:0;width:240px;height:100vh;background:#1a1a2e;display:flex;flex-direction:column;z-index:100;overflow-y:auto;}
.sidebar-brand{padding:24px 20px 16px;border-bottom:1px solid rgba(255,255,255,.08);}
.sidebar-brand img{height:38px;object-fit:contain;display:block;}
.sidebar-brand span{display:block;font-size:.72rem;color:rgba(255,255,255,.45);margin-top:6px;letter-spacing:1px;text-transform:uppercase;}
.sidebar nav{flex:1;padding:16px 0;}
.sidebar nav a{display:flex;align-items:center;gap:12px;padding:11px 20px;color:rgba(255,255,255,.72);font-size:.87rem;font-weight:500;text-decoration:none;transition:all .2s;border-left:3px solid transparent;}
.sidebar nav a:hover,.sidebar nav a.active{color:#fff;background:rgba(255,255,255,.07);border-left-color:#c0392b;}
.sidebar nav a i{width:18px;text-align:center;font-size:.95rem;}
.sidebar-footer{padding:16px 20px;border-top:1px solid rgba(255,255,255,.08);font-size:.8rem;color:rgba(255,255,255,.45);}

/* ── Main ── */
.main-wrap{margin-left:240px;min-height:100vh;display:flex;flex-direction:column;}
.topbar{background:#fff;padding:14px 28px;display:flex;align-items:center;justify-content:space-between;box-shadow:0 1px 4px rgba(0,0,0,.08);position:sticky;top:0;z-index:50;}
.topbar h1{font-size:1.05rem;font-weight:700;color:#1a1a2e;}
.topbar-right{display:flex;align-items:center;gap:16px;}
.topbar-user{font-size:.83rem;color:#555;display:flex;align-items:center;gap:7px;}
.topbar-user i{color:#c0392b;}
.btn-logout{background:#fce4e4;color:#c0392b;border:none;padding:7px 14px;border-radius:6px;font-family:'Poppins',sans-serif;font-size:.82rem;font-weight:600;cursor:pointer;text-decoration:none;transition:background .2s;}
.btn-logout:hover{background:#c0392b;color:#fff;}
.main-content{flex:1;padding:28px;}

/* ── Cards ── */
.card{background:#fff;border-radius:12px;padding:24px;box-shadow:0 2px 8px rgba(0,0,0,.06);margin-bottom:24px;}
.card-title{font-size:1rem;font-weight:700;margin-bottom:20px;color:#1a1a2e;padding-bottom:12px;border-bottom:1px solid #f0f0f0;}

/* ── Forms ── */
.form-group{margin-bottom:18px;}
.form-group label{display:block;font-size:.83rem;font-weight:600;color:#444;margin-bottom:6px;}
.form-group input[type=text],
.form-group input[type=url],
.form-group select,
.form-group textarea{width:100%;padding:10px 14px;border:1.5px solid #e2e8f0;border-radius:8px;font-family:'Poppins',sans-serif;font-size:.9rem;transition:border-color .2s;background:#fff;}
.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus{outline:none;border-color:#c0392b;}
.form-group textarea{min-height:240px;resize:vertical;}
.form-group small{display:block;font-size:.75rem;color:#888;margin-top:5px;}
.form-row{display:grid;grid-template-columns:1fr 1fr;gap:18px;}

/* ── Buttons ── */
.btn{display:inline-flex;align-items:center;gap:7px;padding:9px 18px;border-radius:8px;font-family:'Poppins',sans-serif;font-size:.85rem;font-weight:600;cursor:pointer;text-decoration:none;border:none;transition:all .2s;}
.btn-primary{background:#c0392b;color:#fff;}
.btn-primary:hover{background:#a93226;}
.btn-secondary{background:#f0f2f5;color:#444;}
.btn-secondary:hover{background:#e2e8f0;}
.btn-danger{background:#fce4e4;color:#c0392b;}
.btn-danger:hover{background:#c0392b;color:#fff;}
.btn-success{background:#e8f5e9;color:#2e7d32;}
.btn-success:hover{background:#2e7d32;color:#fff;}
.btn-sm{padding:6px 12px;font-size:.78rem;}

/* ── Table ── */
.data-table{width:100%;border-collapse:collapse;font-size:.87rem;}
.data-table th{text-align:left;padding:11px 14px;background:#f7f7f7;font-weight:600;color:#555;border-bottom:2px solid #e2e8f0;}
.data-table td{padding:12px 14px;border-bottom:1px solid #f0f0f0;vertical-align:middle;}
.data-table tr:hover td{background:#fafafa;}
.data-table .thumb{width:60px;height:44px;object-fit:cover;border-radius:6px;}
.data-table .actions{display:flex;gap:8px;}

/* ── Alerts ── */
.alert{padding:12px 16px;border-radius:8px;font-size:.85rem;margin-bottom:20px;display:flex;align-items:center;gap:10px;}
.alert-success{background:#e8f5e9;color:#2e7d32;}
.alert-error{background:#fce4e4;color:#c0392b;}

/* ── Stats ── */
.stats-row{display:grid;grid-template-columns:repeat(3,1fr);gap:18px;margin-bottom:24px;}
.stat-card{background:#fff;border-radius:12px;padding:20px 22px;box-shadow:0 2px 8px rgba(0,0,0,.06);display:flex;align-items:center;gap:16px;}
.stat-icon{width:50px;height:50px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.3rem;flex-shrink:0;}
.stat-icon.red{background:#fce4e4;color:#c0392b;}
.stat-icon.blue{background:#e3f2fd;color:#1565c0;}
.stat-icon.green{background:#e8f5e9;color:#2e7d32;}
.stat-label{font-size:.78rem;color:#888;}
.stat-value{font-size:1.6rem;font-weight:700;color:#1a1a2e;line-height:1.1;}

/* ── Responsive ── */
@media(max-width:900px){
  .sidebar{width:100%;height:auto;position:relative;}
  .main-wrap{margin-left:0;}
  .form-row{grid-template-columns:1fr;}
  .stats-row{grid-template-columns:1fr;}
}
</style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
  <div class="sidebar-brand">
    <img src="../logo1.png" alt="MG Windows & Doors"/>
    <span>Admin Panel</span>
  </div>
  <nav>
    <a href="dashboard.php"<?php if(basename($_SERVER['PHP_SELF'])==='dashboard.php') echo ' class="active"'; ?>><i class="fas fa-tachometer-alt"></i> Dashboard</a>
    <a href="add_blog.php"<?php if(basename($_SERVER['PHP_SELF'])==='add_blog.php') echo ' class="active"'; ?>><i class="fas fa-plus-circle"></i> Add Blog</a>
    <a href="manage_blog.php"<?php if(basename($_SERVER['PHP_SELF'])==='manage_blog.php') echo ' class="active"'; ?>><i class="fas fa-list"></i> Manage Blogs</a>
    <a href="../index.php" target="_blank"><i class="fas fa-external-link-alt"></i> View Website</a>
  </nav>
  <div class="sidebar-footer">MG Windows &amp; Doors © <?php echo date('Y'); ?></div>
</div>

<!-- Main -->
<div class="main-wrap">
  <div class="topbar">
    <h1><?php echo htmlspecialchars($page_title); ?></h1>
    <div class="topbar-right">
      <div class="topbar-user"><i class="fas fa-user-circle"></i> <?php echo $username; ?></div>
      <a href="logout.php" class="btn-logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
  </div>
  <div class="main-content">
<?php
}

function admin_footer(): void {
?>
  </div><!-- /main-content -->
</div><!-- /main-wrap -->
</body>
</html>
<?php
}
?>
