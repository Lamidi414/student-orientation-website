<?php
/**
 * Common Header
 * NAUB Orientation Portal
 */

// Include configuration
require_once __DIR__ . '/../config/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="NAUB Orientation Portal - Your guide to Nigerian Army University Biu">
    <meta name="author" content="NAUB">
    
    <title><?php echo isset($page_title) ? sanitize($page_title) . ' - ' : ''; ?><?php echo SITE_NAME; ?></title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo BASE_URL; ?>/favicon.ico">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/css/style.css">
    
    <!-- Additional head content -->
    <?php if (isset($extra_head)): ?>
        <?php echo $extra_head; ?>
    <?php endif; ?>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <!-- Logo and Site Branding -->
            <a class="navbar-brand d-flex align-items-center" href="<?php echo BASE_URL; ?>/">
                <div class="logo-container me-2">
                    <i class="fas fa-university fa-lg"></i>
                </div>
                <div class="brand-text">
                    <span class="d-block site-title"><?php echo SITE_NAME; ?></span>
                    <small class="d-none d-sm-block site-subtitle">Nigerian Army University, Biu</small>
                </div>
            </a>
            
            <!-- Mobile Toggle Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Navigation Menu -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo BASE_URL; ?>/">
                            <i class="fas fa-home d-lg-none me-1"></i> Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo BASE_URL; ?>/page.php?slug=about">
                            <i class="fas fa-info-circle d-lg-none me-1"></i> About NAUB
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo BASE_URL; ?>/page.php?slug=admission-requirements">
                            <i class="fas fa-user-graduate d-lg-none me-1"></i> Fresh Student Guide
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo BASE_URL; ?>/page.php?slug=registration">
                            <i class="fas fa-clipboard-list d-lg-none me-1"></i> Registration
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo BASE_URL; ?>/page.php?slug=academic-calendar">
                            <i class="fas fa-calendar-alt d-lg-none me-1"></i> Academic Guide
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo BASE_URL; ?>/page.php?slug=campus-life">
                            <i class="fas fa-building d-lg-none me-1"></i> Campus Life
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo BASE_URL; ?>/page.php?slug=rules">
                            <i class="fas fa-gavel d-lg-none me-1"></i> Rules & Conduct
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo BASE_URL; ?>/page.php?slug=student-support">
                            <i class="fas fa-hands-helping d-lg-none me-1"></i> Support Services
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo BASE_URL; ?>/faqs.php">
                            <i class="fas fa-question-circle d-lg-none me-1"></i> FAQs
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo BASE_URL; ?>/checklist.php">
                            <i class="fas fa-check-square d-lg-none me-1"></i> Checklist
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo BASE_URL; ?>/contact.php">
                            <i class="fas fa-envelope d-lg-none me-1"></i> Contact
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-light btn-sm ms-lg-2" href="<?php echo BASE_URL; ?>/admin/">
                            <i class="fas fa-user-shield d-lg-none me-1"></i> Admin
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    <?php
    $flash = get_flash_message();
    if ($flash): 
    ?>
        <div class="alert alert-<?php echo $flash['type']; ?> alert-dismissible fade show mb-0" role="alert">
            <?php echo sanitize($flash['message']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <!-- Main Content Start -->
    <main>
