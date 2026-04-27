<?php
// ─────────────────────────────────────────────
//  db.php  — MySQL connection (mysqli)
//  Edit these four constants before uploading.
// ─────────────────────────────────────────────

define('DB_HOST', 'localhost');
define('DB_USER', 'your_db_username');   // cPanel DB username
define('DB_PASS', 'your_db_password');   // cPanel DB password
define('DB_NAME', 'your_db_name');       // cPanel DB name

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
}

$conn->set_charset('utf8mb4');
?>
