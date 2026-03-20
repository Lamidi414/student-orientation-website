<?php
/**
 * Main Configuration
 * NAUB Orientation Portal
 */

// Site name constant
define('SITE_NAME', 'NAUB Orientation Portal');

// Get protocol and host for base URL
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
$script_name = $_SERVER['SCRIPT_NAME'] ?? '/';

// Remove script filename from path to get base path
$base_path = dirname($script_name);
if ($base_path === '\\' || $base_path === '/') {
    $base_path = '';
}

// Base URL constant
define('BASE_URL', $protocol . '://' . $host . $base_path);

// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Error reporting settings
// Set to 0 in production
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Timezone setting
date_default_timezone_set('Africa/Lagos');

// Define admin role constant
define('ADMIN_ROLE', 'admin');
