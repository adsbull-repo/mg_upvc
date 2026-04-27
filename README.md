# MG Windows & Doors — Dynamic PHP + MySQL Website
## GoDaddy Shared Hosting Deployment Guide

---

## 📁 File Structure (What Was Changed / Added)

```
mgwd_website_updated/
│
├── db.php                  ← NEW  — MySQL connection
├── setup.sql               ← NEW  — Run ONCE in phpMyAdmin
├── index.php               ← UPDATED (was index.html) — Dynamic blog section
├── blog.php                ← NEW   (replaces blog.html) — Dynamic blog listing
├── blog-details.php        ← NEW   (replaces blog-details pages) — Single post
│
├── admin/                  ← NEW FOLDER
│   ├── login.php           — Admin login form
│   ├── logout.php          — Session destroy
│   ├── auth.php            — Session guard (included by all admin pages)
│   ├── layout.php          — Shared admin HTML shell (sidebar, topbar)
│   ├── dashboard.php       — Admin home with stats
│   ├── add_blog.php        — Add new blog post
│   ├── manage_blog.php     — List + Delete posts
│   └── edit_blog.php       — Edit existing post
│
├── uploads/                ← NEW FOLDER — for future image uploads
│
└── [all other original files unchanged]
```

---

## 🚀 Step-by-Step Deployment on GoDaddy cPanel

### Step 1 — Create the MySQL Database

1. Login to **GoDaddy cPanel**
2. Go to **MySQL Databases**
3. Create a new database (e.g. `mgwd_blog`)
4. Create a database user with a strong password
5. Add the user to the database with **All Privileges**
6. Note down: hostname, database name, username, password

### Step 2 — Run the SQL Setup

1. In cPanel, open **phpMyAdmin**
2. Select your newly created database
3. Click the **SQL** tab
4. Open `setup.sql` from this package, copy all content, paste & click **Go**
5. This creates the `blogs` and `admin_users` tables and seeds 6 blog posts + admin user

### Step 3 — Edit db.php

Open `db.php` and fill in your credentials:

```php
define('DB_HOST', 'localhost');          // Usually 'localhost' on GoDaddy
define('DB_USER', 'your_db_username');   // From Step 1
define('DB_PASS', 'your_db_password');   // From Step 1
define('DB_NAME', 'your_db_name');       // From Step 1
```

### Step 4 — Upload Files via cPanel File Manager

1. Go to **File Manager** in cPanel → `public_html`
2. Upload the entire project (upload as ZIP and extract, or use FTP)
3. Make sure the folder structure matches what's shown above
4. Set folder permissions: `uploads/` → **755**

### Step 5 — Test

| URL | Expected Result |
|-----|----------------|
| `yourdomain.com/index.php` | Homepage with dynamic blog section |
| `yourdomain.com/blog.php` | All blog posts listed |
| `yourdomain.com/blog-details.php?id=1` | First blog post detail |
| `yourdomain.com/admin/login.php` | Admin login page |

### Step 6 — Login to Admin

- **URL:** `yourdomain.com/admin/login.php`
- **Username:** `admin`
- **Password:** `Admin@123`
- ⚠️ **Change the password immediately after first login!**

---

## 🔑 Changing the Admin Password

In phpMyAdmin, run:
```sql
UPDATE admin_users SET password = SHA2('YourNewPassword', 256) WHERE username = 'admin';
```

---

## ✅ How It All Works

1. **Admin adds a blog post** via `admin/add_blog.php`
2. It's saved to the `blogs` MySQL table
3. **`blog.php`** fetches all posts and shows them as cards
4. **`blog-details.php?id=X`** fetches and displays the full post
5. **`index.php`** shows the latest 3 posts in the homepage blog section

---

## ⚠️ Important Notes

- The 6 existing static blog HTML files (`blog-upvc-vs-aluminium.html`, etc.) are kept as-is — they still work. New posts go through `blog-details.php`.
- `blog.html` is replaced by `blog.php` — delete the old `blog.html` after uploading
- All admin pages are protected by session — unauthenticated visitors are redirected to login
- Blog content is stored as HTML in the database — only trusted admins should have access
- The `uploads/` folder is for future image file uploads (not yet implemented — admin currently uses image URLs)
