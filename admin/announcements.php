<?php
/**
 * Announcements Management
 * NAUB Orientation Portal - Admin Panel
 */

$page_title = 'Manage Announcements';
$current_page = 'announcements';

require_once 'header.php';
require_once '../includes/functions.php';

// Handle form submissions
$message = '';
$message_type = 'success';

// Add new announcement
if (isset($_POST['add_announcement'])) {
    $title = sanitize($_POST['title'] ?? '');
    $body = $_POST['body'] ?? '';
    
    if (empty($title) || empty($body)) {
        $message = 'Please fill in all required fields.';
        $message_type = 'danger';
    } else {
        $pdo = get_db();
        if ($pdo) {
            try {
                $stmt = $pdo->prepare("INSERT INTO announcements (title, body) VALUES (:title, :body)");
                $stmt->execute([
                    'title' => $title,
                    'body' => $body
                ]);
                $message = 'Announcement created successfully!';
                $message_type = 'success';
            } catch (PDOException $e) {
                $message = 'Error creating announcement: ' . $e->getMessage();
                $message_type = 'danger';
            }
        }
    }
}

// Update announcement
if (isset($_POST['update_announcement'])) {
    $id = intval($_POST['id'] ?? 0);
    $title = sanitize($_POST['title'] ?? '');
    $body = $_POST['body'] ?? '';
    
    if (empty($title) || empty($body) || $id === 0) {
        $message = 'Please fill in all required fields.';
        $message_type = 'danger';
    } else {
        $pdo = get_db();
        if ($pdo) {
            try {
                $stmt = $pdo->prepare("UPDATE announcements SET title = :title, body = :body WHERE id = :id");
                $stmt->execute([
                    'title' => $title,
                    'body' => $body,
                    'id' => $id
                ]);
                $message = 'Announcement updated successfully!';
                $message_type = 'success';
            } catch (PDOException $e) {
                $message = 'Error updating announcement: ' . $e->getMessage();
                $message_type = 'danger';
            }
        }
    }
}

// Delete announcement
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    if ($id > 0) {
        $pdo = get_db();
        if ($pdo) {
            try {
                $stmt = $pdo->prepare("DELETE FROM announcements WHERE id = :id");
                $stmt->execute(['id' => $id]);
                $message = 'Announcement deleted successfully!';
                $message_type = 'success';
            } catch (PDOException $e) {
                $message = 'Error deleting announcement: ' . $e->getMessage();
                $message_type = 'danger';
            }
        }
    }
}

// Get announcement for editing
$edit_announcement = null;
if (isset($_GET['action']) && $_GET['action'] === 'edit' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    if ($id > 0) {
        $pdo = get_db();
        if ($pdo) {
            $stmt = $pdo->prepare("SELECT * FROM announcements WHERE id = :id");
            $stmt->execute(['id' => $id]);
            $edit_announcement = $stmt->fetch();
        }
    }
}

// Get all announcements
$announcements = [];
$pdo = get_db();
if ($pdo) {
    try {
        $stmt = $pdo->query("SELECT * FROM announcements ORDER BY created_at DESC");
        $announcements = $stmt->fetchAll();
    } catch (PDOException $e) {
        error_log("Error fetching announcements: " . $e->getMessage());
    }
}

// Set flash message
if (!empty($message)) {
    set_flash_message($message, $message_type);
}

// Redirect after successful operations
if ($message_type === 'success' && isset($_POST['add_announcement'])) {
    redirect(BASE_URL . '/admin/announcements.php');
}
?>

<!-- Page Header -->
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1>Manage Announcements</h1>
            <p class="text-muted mb-0">Create and manage important announcements</p>
        </div>
        <button class="btn btn-admin-primary" data-bs-toggle="modal" data-bs-target="#addAnnouncementModal">
            <i class="fas fa-plus me-2"></i>New Announcement
        </button>
    </div>
</div>

<!-- Alert Message -->
<?php if (!empty($message) && $message_type !== 'success'): ?>
<div class="alert alert-<?php echo $message_type; ?> alert-dismissible fade show" role="alert">
    <?php echo sanitize($message); ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>

<!-- Announcements List -->
<div class="row">
    <?php if (!empty($announcements)): ?>
        <?php foreach ($announcements as $announcement): ?>
        <div class="col-lg-6 mb-4">
            <div class="announcement-card">
                <div class="announcement-header">
                    <div class="d-flex justify-content-between align-items-start">
                        <h5><?php echo sanitize($announcement['title']); ?></h5>
                        <div class="announcement-actions">
                            <a href="?action=edit&id=<?php echo $announcement['id']; ?>" class="btn btn-sm btn-outline-primary" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="?action=delete&id=<?php echo $announcement['id']; ?>" class="btn btn-sm btn-outline-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this announcement?');">
                                <i class="fas fa-trash"></i>
                            </a>
                        </div>
                    </div>
                    <small class="text-muted">
                        <i class="fas fa-clock me-1"></i>
                        Posted: <?php echo date('F j, Y \a\t g:i A', strtotime($announcement['created_at'])); ?>
                    </small>
                </div>
                <div class="announcement-body">
                    <?php echo nl2br($announcement['body']); ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="col-12">
            <div class="admin-card">
                <div class="card-body text-center py-5">
                    <i class="fas fa-bullhorn text-muted" style="font-size: 3rem;"></i>
                    <p class="text-muted mt-3">No announcements yet. Create your first announcement!</p>
                    <button class="btn btn-admin-primary" data-bs-toggle="modal" data-bs-target="#addAnnouncementModal">
                        <i class="fas fa-plus me-2"></i>New Announcement
                    </button>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<!-- Add Announcement Modal -->
<div class="modal fade" id="addAnnouncementModal" tabindex="-1" aria-labelledby="addAnnouncementModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addAnnouncementModalLabel">New Announcement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title *</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Announcement title" required>
                    </div>
                    <div class="mb-3">
                        <label for="body" class="form-label">Message *</label>
                        <textarea class="form-control" id="body" name="body" rows="10" placeholder="Write your announcement message here..." required></textarea>
                        <small class="text-muted">You can use basic HTML tags for formatting</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="add_announcement" class="btn btn-admin-primary">Publish Announcement</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Announcement Modal -->
<?php if ($edit_announcement): ?>
<div class="modal fade show" id="editAnnouncementModal" tabindex="-1" aria-labelledby="editAnnouncementModalLabel" aria-hidden="true" style="display: block;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAnnouncementModalLabel">Edit Announcement</h5>
                <a href="announcements.php" class="btn-close" aria-label="Close"></a>
            </div>
            <form method="POST" action="">
                <div class="modal-body">
                    <input type="hidden" name="id" value="<?php echo $edit_announcement['id']; ?>">
                    <div class="mb-3">
                        <label for="edit_title" class="form-label">Title *</label>
                        <input type="text" class="form-control" id="edit_title" name="title" value="<?php echo sanitize($edit_announcement['title']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_body" class="form-label">Message *</label>
                        <textarea class="form-control" id="edit_body" name="body" rows="10" required><?php echo $edit_announcement['body']; ?></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="announcements.php" class="btn btn-secondary">Cancel</a>
                    <button type="submit" name="update_announcement" class="btn btn-admin-primary">Update Announcement</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal-backdrop fade show"></div>
<?php endif; ?>

<style>
.announcement-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    overflow: hidden;
    height: 100%;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.announcement-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 16px rgba(0,0,0,0.1);
}

.announcement-header {
    background: linear-gradient(135deg, #1a5f7a, #159895);
    color: white;
    padding: 1.25rem;
}

.announcement-header h5 {
    margin: 0;
    font-size: 1.1rem;
    font-weight: 600;
}

.announcement-header .text-muted {
    color: rgba(255,255,255,0.8) !important;
}

.announcement-actions {
    display: flex;
    gap: 0.5rem;
}

.announcement-actions .btn {
    padding: 0.25rem 0.5rem;
    background: rgba(255,255,255,0.2);
    border-color: transparent;
    color: white;
}

.announcement-actions .btn:hover {
    background: rgba(255,255,255,0.3);
    border-color: white;
    color: white;
}

.announcement-body {
    padding: 1.25rem;
    color: #2c3e50;
    line-height: 1.6;
    white-space: pre-wrap;
}

.modal-backdrop {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 1040;
}

#editAnnouncementModal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1050;
    overflow-x: hidden;
    overflow-y: auto;
}

#editAnnouncementModal .modal-dialog {
    margin: 1.75rem auto;
    max-width: 800px;
}
</style>

<?php
require_once 'footer.php';
?>
