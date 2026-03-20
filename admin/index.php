<?php
/**
 * Admin Dashboard
 * NAUB Orientation Portal - Admin Panel
 */

$page_title = 'Dashboard';
$current_page = 'dashboard';

require_once 'header.php';
require_once '../includes/functions.php';

// Get statistics
$pdo = get_db();
$stats = [
    'pages' => 0,
    'faqs' => 0,
    'contacts' => 0,
    'checklist' => 0,
    'announcements' => 0,
    'admins' => 0
];

if ($pdo) {
    try {
        // Count pages
        $stmt = $pdo->query("SELECT COUNT(*) as count FROM pages");
        $stats['pages'] = $stmt->fetch()['count'];
        
        // Count FAQs
        $stmt = $pdo->query("SELECT COUNT(*) as count FROM faqs");
        $stats['faqs'] = $stmt->fetch()['count'];
        
        // Count contacts
        $stmt = $pdo->query("SELECT COUNT(*) as count FROM contacts");
        $stats['contacts'] = $stmt->fetch()['count'];
        
        // Count checklist items
        $stmt = $pdo->query("SELECT COUNT(*) as count FROM checklist_items");
        $stats['checklist'] = $stmt->fetch()['count'];
        
        // Count announcements
        $stmt = $pdo->query("SELECT COUNT(*) as count FROM announcements");
        $stats['announcements'] = $stmt->fetch()['count'];
        
        // Count admins
        $stmt = $pdo->query("SELECT COUNT(*) as count FROM admins");
        $stats['admins'] = $stmt->fetch()['count'];
    } catch (PDOException $e) {
        error_log("Error fetching stats: " . $e->getMessage());
    }
}

// Get recent announcements
$recent_announcements = get_announcements(5);
?>

<!-- Page Header -->
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1>Dashboard</h1>
            <p class="text-muted mb-0">Welcome back, <?php echo sanitize($admin['full_name'] ?? 'Admin'); ?>!</p>
        </div>
        <div>
            <span class="text-muted">
                <i class="fas fa-calendar-alt me-1"></i>
                <?php echo date('l, F j, Y'); ?>
            </span>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-md-4 col-sm-6 mb-3">
        <div class="stat-card">
            <div class="stat-icon" style="background: linear-gradient(135deg, #1a5f7a, #159895);">
                <i class="fas fa-file-alt"></i>
            </div>
            <div class="stat-info">
                <h3><?php echo number_format($stats['pages']); ?></h3>
                <p>Pages</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-4 col-sm-6 mb-3">
        <div class="stat-card">
            <div class="stat-icon" style="background: linear-gradient(135deg, #e67e22, #f39c12);">
                <i class="fas fa-question-circle"></i>
            </div>
            <div class="stat-info">
                <h3><?php echo number_format($stats['faqs']); ?></h3>
                <p>FAQs</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-4 col-sm-6 mb-3">
        <div class="stat-card">
            <div class="stat-icon" style="background: linear-gradient(135deg, #3498db, #2980b9);">
                <i class="fas fa-address-book"></i>
            </div>
            <div class="stat-info">
                <h3><?php echo number_format($stats['contacts']); ?></h3>
                <p>Contacts</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-4 col-sm-6 mb-3">
        <div class="stat-card">
            <div class="stat-icon" style="background: linear-gradient(135deg, #27ae60, #2ecc71);">
                <i class="fas fa-check-square"></i>
            </div>
            <div class="stat-info">
                <h3><?php echo number_format($stats['checklist']); ?></h3>
                <p>Checklist Items</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-4 col-sm-6 mb-3">
        <div class="stat-card">
            <div class="stat-icon" style="background: linear-gradient(135deg, #e74c3c, #c0392b);">
                <i class="fas fa-bullhorn"></i>
            </div>
            <div class="stat-info">
                <h3><?php echo number_format($stats['announcements']); ?></h3>
                <p>Announcements</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-4 col-sm-6 mb-3">
        <div class="stat-card">
            <div class="stat-icon" style="background: linear-gradient(135deg, #9b59b6, #8e44ad);">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-info">
                <h3><?php echo number_format($stats['admins']); ?></h3>
                <p>Administrators</p>
            </div>
        </div>
    </div>
</div>

<!-- Quick Links and Recent Activity -->
<div class="row">
    <!-- Quick Links -->
    <div class="col-lg-4 mb-4">
        <div class="admin-card">
            <div class="card-header">
                <i class="fas fa-link me-2"></i>Quick Actions
            </div>
            <div class="card-body p-0">
                <div class="quick-actions">
                    <a href="pages.php?action=add" class="quick-action-item">
                        <div class="action-icon" style="background: linear-gradient(135deg, #1a5f7a, #159895);">
                            <i class="fas fa-file-plus"></i>
                        </div>
                        <div class="action-text">
                            <h5>Add New Page</h5>
                            <p>Create a new content page</p>
                        </div>
                    </a>
                    
                    <a href="faqs.php?action=add" class="quick-action-item">
                        <div class="action-icon" style="background: linear-gradient(135deg, #e67e22, #f39c12);">
                            <i class="fas fa-question-circle"></i>
                        </div>
                        <div class="action-text">
                            <h5>Add FAQ</h5>
                            <p>Add frequently asked question</p>
                        </div>
                    </a>
                    
                    <a href="announcements.php?action=add" class="quick-action-item">
                        <div class="action-icon" style="background: linear-gradient(135deg, #e74c3c, #c0392b);">
                            <i class="fas fa-bullhorn"></i>
                        </div>
                        <div class="action-text">
                            <h5>New Announcement</h5>
                            <p>Post a new announcement</p>
                        </div>
                    </a>
                    
                    <a href="contacts.php?action=add" class="quick-action-item">
                        <div class="action-icon" style="background: linear-gradient(135deg, #3498db, #2980b9);">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <div class="action-text">
                            <h5>Add Contact</h5>
                            <p>Add new department contact</p>
                        </div>
                    </a>
                    
                    <a href="checklist.php?action=add" class="quick-action-item">
                        <div class="action-icon" style="background: linear-gradient(135deg, #27ae60, #2ecc71);">
                            <i class="fas fa-plus-square"></i>
                        </div>
                        <div class="action-text">
                            <h5>Add Checklist Item</h5>
                            <p>Add new checklist item</p>
                        </div>
                    </a>
                    
                    <a href="../" target="_blank" class="quick-action-item">
                        <div class="action-icon" style="background: linear-gradient(135deg, #9b59b6, #8e44ad);">
                            <i class="fas fa-external-link-alt"></i>
                        </div>
                        <div class="action-text">
                            <h5>View Website</h5>
                            <p>Open the main website</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Recent Announcements -->
    <div class="col-lg-8 mb-4">
        <div class="admin-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>
                    <i class="fas fa-bullhorn me-2"></i>Recent Announcements
                </span>
                <a href="announcements.php" class="btn btn-sm btn-admin-primary">View All</a>
            </div>
            <div class="card-body p-0">
                <?php if (!empty($recent_announcements)): ?>
                    <div class="table-responsive">
                        <table class="admin-table mb-0">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Date Posted</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($recent_announcements as $announcement): ?>
                                <tr>
                                    <td>
                                        <strong><?php echo sanitize($announcement['title']); ?></strong>
                                        <br>
                                        <small class="text-muted"><?php echo substr(sanitize(strip_tags($announcement['body'])), 0, 60); ?>...</small>
                                    </td>
                                    <td><?php echo date('M j, Y', strtotime($announcement['created_at'])); ?></td>
                                    <td>
                                        <a href="announcements.php?action=edit&id=<?php echo $announcement['id']; ?>" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="text-center py-4">
                        <i class="fas fa-bullhorn text-muted" style="font-size: 3rem;"></i>
                        <p class="text-muted mt-2">No announcements yet</p>
                        <a href="announcements.php?action=add" class="btn btn-admin-primary">Add First Announcement</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- System Info -->
<div class="row">
    <div class="col-12">
        <div class="admin-card">
            <div class="card-header">
                <i class="fas fa-info-circle me-2"></i>System Information
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <p class="mb-1"><strong>PHP Version:</strong> <?php echo phpversion(); ?></p>
                    </div>
                    <div class="col-md-4">
                        <p class="mb-1"><strong>Server Time:</strong> <?php echo date('Y-m-d H:i:s'); ?></p>
                    </div>
                    <div class="col-md-4">
                        <p class="mb-1"><strong>Admin Panel Version:</strong> 1.0.0</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Dashboard Specific Styles */
.stat-card {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    display: flex;
    align-items: center;
    gap: 1rem;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    transition: transform 0.2s ease;
}

.stat-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.stat-icon {
    width: 56px;
    height: 56px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
}

.stat-info h3 {
    margin: 0;
    font-size: 1.75rem;
    font-weight: 700;
    color: #2c3e50;
}

.stat-info p {
    margin: 0;
    color: #6c757d;
    font-size: 0.9rem;
}

.quick-actions {
    display: flex;
    flex-direction: column;
}

.quick-action-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem 1.5rem;
    text-decoration: none;
    color: inherit;
    border-bottom: 1px solid #eee;
    transition: background 0.2s ease;
}

.quick-action-item:last-child {
    border-bottom: none;
}

.quick-action-item:hover {
    background: #f8f9fa;
    text-decoration: none;
}

.action-icon {
    width: 44px;
    height: 44px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.1rem;
    flex-shrink: 0;
}

.action-text h5 {
    margin: 0;
    font-size: 0.95rem;
    font-weight: 600;
    color: #2c3e50;
}

.action-text p {
    margin: 0;
    font-size: 0.8rem;
    color: #6c757d;
}

.admin-footer {
    background: white;
    border-top: 1px solid #eee;
    margin-top: auto;
}
</style>

<?php
require_once 'footer.php';
?>
