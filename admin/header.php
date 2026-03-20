<?php
/**
 * Admin Header Template
 * NAUB Orientation Portal - Admin Panel
 */

// Check if user is logged in as admin
if (!is_admin()) {
    redirect(BASE_URL . '/admin/login.php');
}

$admin = get_current_admin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="NAUB Orientation Portal - Admin Panel">
    
    <title><?php echo isset($page_title) ? sanitize($page_title) . ' - ' : ''; ?>Admin Panel - <?php echo SITE_NAME; ?></title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom Admin CSS -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/css/admin.css">
    
    <style>
        :root {
            --sidebar-width: 260px;
            --topbar-height: 60px;
            --primary-color: #1a5f7a;
            --secondary-color: #159895;
            --accent-color: #57c5b6;
            --dark-color: #2c3e50;
            --light-bg: #f8f9fa;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
        }
        
        /* Sidebar Styles */
        .admin-sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: linear-gradient(180deg, var(--primary-color) 0%, var(--dark-color) 100%);
            color: white;
            z-index: 1000;
            overflow-y: auto;
            transition: all 0.3s ease;
        }
        
        .sidebar-brand {
            padding: 1.5rem;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        
        .sidebar-brand h4 {
            margin: 0;
            font-size: 1.25rem;
        }
        
        .sidebar-brand small {
            opacity: 0.7;
            font-size: 0.75rem;
        }
        
        .sidebar-menu {
            padding: 1rem 0;
        }
        
        .menu-section {
            padding: 0.5rem 1.5rem;
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: rgba(255,255,255,0.5);
            margin-top: 1rem;
        }
        
        .menu-item {
            display: flex;
            align-items: center;
            padding: 0.75rem 1.5rem;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: all 0.2s ease;
            border-left: 3px solid transparent;
        }
        
        .menu-item:hover {
            background: rgba(255,255,255,0.1);
            color: white;
            text-decoration: none;
        }
        
        .menu-item.active {
            background: rgba(255,255,255,0.15);
            color: white;
            border-left-color: var(--accent-color);
        }
        
        .menu-item i {
            width: 1.5rem;
            margin-right: 0.75rem;
            text-align: center;
        }
        
        /* Main Content Area */
        .admin-main {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
        }
        
        /* Top Navigation */
        .admin-topbar {
            position: sticky;
            top: 0;
            height: var(--topbar-height);
            background: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
            z-index: 100;
        }
        
        .topbar-left {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .menu-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.25rem;
            cursor: pointer;
            color: var(--dark-color);
        }
        
        .topbar-right {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }
        
        .admin-user {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        
        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: var(--secondary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }
        
        .user-info {
            line-height: 1.2;
        }
        
        .user-name {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--dark-color);
        }
        
        .user-role {
            font-size: 0.75rem;
            color: #6c757d;
        }
        
        .logout-btn {
            color: #dc3545;
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            transition: all 0.2s ease;
        }
        
        .logout-btn:hover {
            background: #ffeef0;
        }
        
        /* Content Area */
        .admin-content {
            padding: 2rem;
        }
        
        /* Page Header */
        .page-header {
            margin-bottom: 2rem;
        }
        
        .page-header h1 {
            font-size: 1.75rem;
            font-weight: 600;
            color: var(--dark-color);
            margin: 0;
        }
        
        .page-header .breadcrumb {
            margin-bottom: 0;
            font-size: 0.875rem;
        }
        
        .page-header .breadcrumb-item a {
            color: var(--secondary-color);
            text-decoration: none;
        }
        
        /* Cards */
        .admin-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            border: none;
            margin-bottom: 1.5rem;
        }
        
        .admin-card .card-header {
            background: white;
            border-bottom: 1px solid #eee;
            padding: 1rem 1.5rem;
            font-weight: 600;
            color: var(--dark-color);
        }
        
        .admin-card .card-body {
            padding: 1.5rem;
        }
        
        /* Tables */
        .admin-table {
            width: 100%;
        }
        
        .admin-table th {
            background: #f8f9fa;
            font-weight: 600;
            color: var(--dark-color);
            padding: 0.75rem 1rem;
            border-bottom: 2px solid #dee2e6;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .admin-table td {
            padding: 0.75rem 1rem;
            vertical-align: middle;
            border-bottom: 1px solid #eee;
        }
        
        .admin-table tbody tr:hover {
            background: #f8f9fa;
        }
        
        /* Buttons */
        .btn-admin-primary {
            background: var(--secondary-color);
            border-color: var(--secondary-color);
            color: white;
        }
        
        .btn-admin-primary:hover {
            background: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
        }
        
        /* Status Badges */
        .badge-high {
            background-color: #dc3545;
        }
        
        .badge-medium {
            background-color: #ffc107;
            color: #212529;
        }
        
        .badge-low {
            background-color: #28a745;
        }
        
        /* Alert Messages */
        .alert {
            border-radius: 8px;
            border: none;
        }
        
        /* Responsive */
        @media (max-width: 992px) {
            .admin-sidebar {
                transform: translateX(-100%);
            }
            
            .admin-sidebar.show {
                transform: translateX(0);
            }
            
            .admin-main {
                margin-left: 0;
            }
            
            .menu-toggle {
                display: block;
            }
            
            .sidebar-overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0,0,0,0.5);
                z-index: 999;
            }
            
            .sidebar-overlay.show {
                display: block;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar Overlay (Mobile) -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>
    
    <!-- Sidebar -->
    <aside class="admin-sidebar" id="sidebar">
        <div class="sidebar-brand">
            <h4><i class="fas fa-university me-2"></i><?php echo SITE_NAME; ?></h4>
            <small>Admin Panel</small>
        </div>
        
        <nav class="sidebar-menu">
            <div class="menu-section">Main</div>
            <a href="index.php" class="menu-item <?php echo ($current_page ?? '') === 'dashboard' ? 'active' : ''; ?>">
                <i class="fas fa-tachometer-alt"></i>
                Dashboard
            </a>
            
            <div class="menu-section">Content Management</div>
            <a href="pages.php" class="menu-item <?php echo ($current_page ?? '') === 'pages' ? 'active' : ''; ?>">
                <i class="fas fa-file-alt"></i>
                Pages
            </a>
            <a href="faqs.php" class="menu-item <?php echo ($current_page ?? '') === 'faqs' ? 'active' : ''; ?>">
                <i class="fas fa-question-circle"></i>
                FAQs
            </a>
            <a href="contacts.php" class="menu-item <?php echo ($current_page ?? '') === 'contacts' ? 'active' : ''; ?>">
                <i class="fas fa-address-book"></i>
                Contacts
            </a>
            <a href="checklist.php" class="menu-item <?php echo ($current_page ?? '') === 'checklist' ? 'active' : ''; ?>">
                <i class="fas fa-check-square"></i>
                Checklist
            </a>
            <a href="announcements.php" class="menu-item <?php echo ($current_page ?? '') === 'announcements' ? 'active' : ''; ?>">
                <i class="fas fa-bullhorn"></i>
                Announcements
            </a>
            
            <div class="menu-section">Account</div>
            <a href="logout.php" class="menu-item">
                <i class="fas fa-sign-out-alt"></i>
                Logout
            </a>
        </nav>
    </aside>
    
    <!-- Main Content -->
    <main class="admin-main">
        <!-- Top Navigation -->
        <header class="admin-topbar">
            <div class="topbar-left">
                <button class="menu-toggle" id="menuToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>/">Home</a></li>
                        <li class="breadcrumb-item"><a href="index.php">Admin</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo isset($page_title) ? $page_title : 'Page'; ?></li>
                    </ol>
                </nav>
            </div>
            
            <div class="topbar-right">
                <div class="admin-user">
                    <div class="user-avatar">
                        <?php echo strtoupper(substr($admin['full_name'] ?? 'A', 0, 2)); ?>
                    </div>
                    <div class="user-info">
                        <div class="user-name"><?php echo sanitize($admin['full_name'] ?? 'Admin'); ?></div>
                        <div class="user-role">Administrator</div>
                    </div>
                </div>
                <a href="logout.php" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </div>
        </header>
        
        <!-- Content Area -->
        <div class="admin-content">
            <!-- Flash Messages -->
            <?php
            $flash = get_flash_message();
            if ($flash): 
            ?>
                <div class="alert alert-<?php echo $flash['type']; ?> alert-dismissible fade show" role="alert">
                    <?php echo sanitize($flash['message']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
