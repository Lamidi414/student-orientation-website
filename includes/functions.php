<?php
/**
 * Core Functions
 * NAUB Orientation Portal
 * 
 * Contains all database and utility functions
 */

// Include database configuration
require_once __DIR__ . '/../config/db.php';



/**
 * Get page by slug
 * @param string $slug
 * @return array|null
 */
function get_page_by_slug($slug) {
    $pdo = get_db();
    if (!$pdo) return null;
    
    try {
        $stmt = $pdo->prepare("SELECT * FROM pages WHERE slug = :slug LIMIT 1");
        $stmt->execute(['slug' => $slug]);
        return $stmt->fetch();
    } catch (PDOException $e) {
        error_log("Error fetching page: " . $e->getMessage());
        return null;
    }
}

/**
 * Get all FAQs
 * @return array
 */
function get_all_faqs() {
    $pdo = get_db();
    if (!$pdo) return [];
    
    try {
        $stmt = $pdo->query("SELECT * FROM faqs ORDER BY category, id");
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        error_log("Error fetching FAQs: " . $e->getMessage());
        return [];
    }
}

/**
 * Get FAQs by category
 * @param string $category
 * @return array
 */
function get_faqs_by_category($category) {
    $pdo = get_db();
    if (!$pdo) return [];
    
    try {
        $stmt = $pdo->prepare("SELECT * FROM faqs WHERE category = :category ORDER BY id");
        $stmt->execute(['category' => $category]);
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        error_log("Error fetching FAQs by category: " . $e->getMessage());
        return [];
    }
}

/**
 * Get all contacts
 * @return array
 */
function get_all_contacts() {
    $pdo = get_db();
    if (!$pdo) return [];
    
    try {
        $stmt = $pdo->query("SELECT * FROM contacts ORDER BY office_name");
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        error_log("Error fetching contacts: " . $e->getMessage());
        return [];
    }
}

/**
 * Get checklist items
 * @return array
 */
function get_checklist_items() {
    $pdo = get_db();
    if (!$pdo) return [];
    
    try {
        $stmt = $pdo->query("SELECT * FROM checklist_items ORDER BY sort_order");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error fetching checklist items: " . $e->getMessage());
        return [];
    }
}

/**
 * Get announcements
 * @param int $limit
 * @return array
 */
function get_announcements($limit = 10) {
    $pdo = get_db();
    if (!$pdo) return [];
    
    try {
        $stmt = $pdo->prepare("SELECT * FROM announcements ORDER BY created_at DESC LIMIT :limit");
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        error_log("Error fetching announcements: " . $e->getMessage());
        return [];
    }
}

/**
 * Sanitize input to prevent XSS attacks
 * @param mixed $input
 * @return string
 */
function sanitize($input) {
    if (is_array($input)) {
        return array_map('sanitize', $input);
    }
    
    // Convert special characters to HTML entities
    $output = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    
    // Trim whitespace
    $output = trim($output);
    
    return $output;
}

/**
 * Check if user is logged in as admin
 * @return bool
 */
function is_admin() {
    // Check if admin session is set
    if (!isset($_SESSION['admin_id']) || !isset($_SESSION['admin_logged_in'])) {
        return false;
    }
    
    // Verify session values
    if ($_SESSION['admin_logged_in'] !== true || !is_numeric($_SESSION['admin_id'])) {
        return false;
    }
    
    return true;
}

/**
 * Get current admin user info
 * @return array|null
 */
function get_current_admin() {
    if (!is_admin()) {
        return null;
    }
    
    $pdo = get_db();
    if (!$pdo) return null;
    
    try {
        $stmt = $pdo->prepare("SELECT id, full_name, email FROM admins WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $_SESSION['admin_id']]);
        return $stmt->fetch();
    } catch (PDOException $e) {
        error_log("Error fetching admin: " . $e->getMessage());
        return null;
    }
}

/**
 * Redirect to a URL
 * @param string $url
 */
function redirect($url) {
    header("Location: " . $url);
    exit;
}

/**
 * Display flash message
 * @param string $message
 * @param string $type (success, error, warning, info)
 */
function set_flash_message($message, $type = 'info') {
    $_SESSION['flash_message'] = $message;
    $_SESSION['flash_type'] = $type;
}

/**
 * Get and clear flash message
 * @return array|null
 */
function get_flash_message() {
    if (isset($_SESSION['flash_message'])) {
        $message = [
            'message' => $_SESSION['flash_message'],
            'type' => $_SESSION['flash_type'] ?? 'info'
        ];
        
        unset($_SESSION['flash_message']);
        unset($_SESSION['flash_type']);
        
        return $message;
    }
    return null;
}

/**
 * Get all FAQ categories
 * @return array
 */
function get_faq_categories() {
    $pdo = get_db();
    if (!$pdo) return [];
    
    try {
        $stmt = $pdo->query("SELECT DISTINCT category FROM faqs WHERE category IS NOT NULL ORDER BY category");
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    } catch (PDOException $e) {
        error_log("Error fetching FAQ categories: " . $e->getMessage());
        return [];
    }
}
