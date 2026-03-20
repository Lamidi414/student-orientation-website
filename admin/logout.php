<?php
/**
 * Logout Script
 * NAUB Orientation Portal - Admin Panel
 */

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include configuration
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/functions.php';

// Clear all session variables
$_SESSION = [];

// Destroy the session
session_destroy();

// Redirect to login page with message
set_flash_message('You have been logged out successfully.', 'success');
redirect(BASE_URL . '/admin/login.php');
?>
