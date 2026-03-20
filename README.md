# NAUB Orientation Website

A comprehensive student orientation portal for the Nigerian Army University, Biu (NAUB). This web application provides new students with essential information about university life, academic resources, campus facilities, and support services.

## Table of Contents

- [Requirements](#requirements)
- [Installation Steps](#installation-steps)
- [Database Setup](#database-setup)
- [Configuration](#configuration)
- [Running the Application](#running-the-application)
- [Default Credentials](#default-credentials)
- [Project Structure Overview](#project-structure-overview)
- [Troubleshooting](#troubleshooting)

---

## Requirements

Before setting up the NAUB Orientation Website, ensure your development environment meets the following requirements:

### 1. PHP (Required)

- **Minimum Version**: PHP 7.4 or higher
- **Recommended Version**: PHP 8.0 or higher
- **Required Extensions**:
  - `pdo` - PHP Data Objects for database access
  - `pdo_mysql` - MySQL driver for PDO
  - `mbstring` - Multibyte string support
  - `json` - JSON encoding/decoding
  - `session` - Session management

**To check your PHP version**, run:
```bash
php -v
```

### 2. MySQL (Required)

- **Minimum Version**: MySQL 5.7 or higher
- **Recommended Version**: MySQL 8.0

**To check your MySQL version**, run:
```bash
mysql --version
```

### 3. Web Server (Required)

Choose one of the following options:

- **Apache** (Recommended)
  - With `mod_rewrite` module enabled
  - With `.htaccess` support

- **PHP Built-in Server** (For development)
  - Comes bundled with PHP

- **Nginx**
  - With PHP-FPM configured

### 4. Additional Tools (Optional but Recommended)

- **Composer** - For dependency management
- **Git** - For version control
- **phpMyAdmin** - For database management (web-based)

---

## Installation Steps

Follow these step-by-step instructions to set up the NAUB Orientation Website on your local machine.

### Step 1: Extract the Project Files

1. Download the project zip file or clone the repository
2. Extract the files to your web server's document root directory
3. For Apache, this is typically:
   - Windows: `C:\xampp\htdocs\`
   - Linux/macOS: `/var/www/html/`

### Step 2: Install XAMPP (Recommended for Windows)

If you don't have a web server set up, XAMPP is the easiest way to get started:

1. Download XAMPP from [apachefriends.org](https://www.apachefriends.org/)
2. Run the installer and follow the prompts
3. Start Apache and MySQL from the XAMPP Control Panel
4. Place the project files in `C:\xampp\htdocs\naub-orientation\`

### Step 3: Verify PHP Installation

1. Create a test file `phpinfo.php` in your web root:
```php
<?php
phpinfo();
?>
```

2. Open your browser and navigate to `http://localhost/phpinfo.php`
3. You should see a page with PHP configuration details
4. If you see this page, PHP is working correctly

---

## Database Setup

### Option 1: Using phpMyAdmin (Recommended)

1. Open your browser and navigate to `http://localhost/phpmyadmin/`
2. Log in with your MySQL credentials (default: username `root`, no password)
3. Click on **"New"** to create a new database
4. Enter the database name: `naub_orientation`
5. Select **utf8mb4_unicode_ci** as the collation
6. Click **Create**

### Option 2: Using MySQL Command Line

1. Open your terminal/command prompt
2. Log in to MySQL:
```bash
mysql -u root -p
```

3. Create the database:
```sql
CREATE DATABASE naub_orientation CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

4. Exit MySQL:
```sql
EXIT;
```

### Option 3: Import the SQL File

1. Open phpMyAdmin and select the `naub_orientation` database
2. Click on the **"Import"** tab
3. Click **"Choose File"** and select the `database.sql` file from the project root
4. Scroll down and click **"Go"** or **"Import"**

Or using the command line:
```bash
mysql -u root -p naub_orientation < database.sql
```

The database import will create:
- **6 tables**: admins, pages, faqs, contacts, checklist_items, announcements
- **Sample data**: Default admin accounts, pre-populated pages, FAQs, contacts, and announcements

---

## Configuration

### Database Credentials

The database configuration is located in [`config/db.php`](config/db.php:10). The default settings are:

```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'naub_orientation');
define('DB_USER', 'root');
define('DB_PASS', '');
```

### Modifying Database Credentials

If your MySQL credentials are different, edit [`config/db.php`](config/db.php:10):

1. Open `config/db.php` in your code editor
2. Update the following values:

| Constant | Description | Default |
|----------|-------------|---------|
| `DB_HOST` | MySQL server hostname | `localhost` |
| `DB_NAME` | Database name | `naub_orientation` |
| `DB_USER` | MySQL username | `root` |
| `DB_PASS` | MySQL password | `(empty)` |

### Example - Custom Database Credentials

```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'naub_orientation');
define('DB_USER', 'my_username');
define('DB_PASS', 'my_password');
```

### Site Configuration

General site settings are in [`config/config.php`](config/config.php:8):

```php
define('SITE_NAME', 'NAUB Orientation Portal');
date_default_timezone_set('Africa/Lagos');
```

---

## Running the Application

### Option 1: Using XAMPP (Apache)

1. Start Apache and MySQL from the XAMPP Control Panel
2. Open your browser and navigate to:
   ```
   http://localhost/naub-orientation/
   ```
   Or if you placed files directly in htdocs:
   ```
   http://localhost/
   ```

### Option 2: Using PHP Built-in Server

1. Open your terminal/command prompt
2. Navigate to the project directory:
   ```bash
   cd C:\xampp\htdocs\naub-orientation
   ```
   Or on Linux/macOS:
   ```bash
   cd /var/www/html/naub-orientation
   ```

3. Start the PHP development server:
   ```bash
   php -S localhost:8000
   ```

4. Open your browser and navigate to:
   ```
   http://localhost:8000
   ```

### Option 3: Using XAMPP with Custom Port

If you're using a different port (e.g., 8080):

1. Start Apache from XAMPP Control Panel
2. Open your browser and navigate to:
   ```
   http://localhost:8080/naub-orientation/
   ```

---

## Default Credentials

### Admin Login

The system comes with pre-configured admin accounts. Use these credentials to access the admin panel:

| Email | Password |
|-------|----------|
| `admin@naub.edu.ng` | `password` |
| `ahmed.musa@naub.edu.ng` | `password` |
| `fatima.bello@naub.edu.ng` | `password` |

### Accessing the Admin Panel

1. Navigate to the admin login page:
   ```
   http://localhost/admin/login.php
   ```
2. Enter any admin email from the table above
3. Enter the password: `password`
4. Click **Login**

### ⚠️ Security Recommendations

- **Change default passwords immediately** after first login
- Create unique passwords for each admin account
- Regularly update passwords
- Limit admin access to trusted individuals

---

## Project Structure Overview

```
naub-orientation/
├── admin/                    # Admin panel files
│   ├── index.php            # Admin dashboard
│   ├── login.php            # Admin login page
│   ├── logout.php           # Logout handler
│   ├── announcements.php    # Manage announcements
│   ├── checklist.php        # Manage checklist items
│   ├── contacts.php         # Manage contacts
│   ├── faqs.php             # Manage FAQs
│   ├── pages.php            # Manage pages
│   ├── header.php           # Admin header
│   └── footer.php           # Admin footer
│
├── config/                   # Configuration files
│   ├── config.php           # Main site configuration
│   └── db.php               # Database configuration
│
├── css/                      # Stylesheets
│   └── style.css            # Main stylesheet
│
├── includes/                 # Shared PHP files
│   ├── functions.php        # Utility functions
│   ├── header.php           # Site header
│   └── footer.php           # Site footer
│
├── js/                       # JavaScript files
│   └── main.js              # Main JavaScript
│
├── database.sql             # Database schema and seed data
├── index.php                # Homepage
├── about.php                # About page
├── academic-guide.php       # Academic guide
├── campus-life.php          # Campus life information
├── checklist.php            # Student checklist
├── contact.php              # Contact page
├── faq.php                  # FAQ page
├── fresh-student-guide.php  # Fresh student guide
├── registration.php         # Registration guide
├── rules.php                # University rules
└── support.php              # Support services
```

### Key Files Description

| File/Directory | Description |
|----------------|-------------|
| [`config/db.php`](config/db.php) | Database connection settings |
| [`config/config.php`](config/config.php) | Site-wide configuration |
| [`includes/functions.php`](includes/functions.php) | Helper functions (sanitization, redirects, etc.) |
| [`admin/login.php`](admin/login.php) | Admin authentication |
| [`admin/index.php`](admin/index.php) | Admin dashboard |
| [`database.sql`](database.sql) | Complete database schema with sample data |

---

## Troubleshooting

### Common Issues and Solutions

#### 1. "Database Connection Error"

**Problem**: The page shows a database connection error.

**Solution**:
- Verify MySQL is running (check XAMPP Control Panel)
- Confirm database name is `naub_orientation`
- Check username and password in [`config/db.php`](config/db.php)
- Ensure the database has been imported

#### 2. "404 Not Found" Error

**Problem**: Pages return 404 error.

**Solution**:
- If using Apache, ensure `mod_rewrite` is enabled
- Check that `.htaccess` file exists in the project root
- For PHP built-in server, use: `php -S localhost:8000`

#### 3. "Call to undefined function" Error

**Problem**: PHP functions not found.

**Solution**:
- Ensure all required PHP extensions are enabled
- Check PHP version meets requirements (7.4+)

#### 4. Blank White Page

**Solution**:
- Enable error reporting in [`config/config.php`](config/config.php:31):
```php
error_reporting(E_ALL);
ini_set('display_errors', 1);
```
- Check PHP error logs

#### 5. Cannot Log in to Admin

**Problem**: Login fails with correct credentials.

**Solution**:
- Verify the database was imported correctly
- Check that the `admins` table contains records
- Clear browser cookies and try again

### Getting Help

If you encounter issues not listed here:

1. Check the PHP error logs at:
   - XAMPP: `C:\xampp\php\logs\php_error.log`
   - Linux: `/var/log/php_errors.log`

2. Enable debug mode in [`config/config.php`](config/config.php):
```php
error_reporting(E_ALL);
ini_set('display_errors', 1);
```

3. Review the code in [`includes/functions.php`](includes/functions.php) for helper functions

---

## Technology Stack

- **Backend**: PHP 7.4+ (PDO)
- **Database**: MySQL 5.7+
- **Frontend**: HTML5, CSS3, JavaScript
- **Framework**: Bootstrap 5.3
- **Icons**: Font Awesome 6.4

---

## License

This project is for educational purposes. All rights reserved by NAUB.

---

## Author

Nigerian Army University, Biu (NAUB)
