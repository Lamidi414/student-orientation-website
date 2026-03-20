<?php
/**
 * Pages Management
 * NAUB Orientation Portal - Admin Panel
 */

$page_title = 'Manage Pages';
$current_page = 'pages';

require_once 'header.php';
require_once '../includes/functions.php';

// Handle form submissions
$message = '';
$message_type = 'success';

// Add new page
if (isset($_POST['add_page'])) {
    $title = sanitize($_POST['title'] ?? '');
    $slug = sanitize($_POST['slug'] ?? '');
    $content = $_POST['content'] ?? '';
    $category = sanitize($_POST['category'] ?? '');
    
    if (empty($title) || empty($slug) || empty($content)) {
        $message = 'Please fill in all required fields.';
        $message_type = 'danger';
    } else {
        $pdo = get_db();
        if ($pdo) {
            try {
                // Check if slug already exists
                $stmt = $pdo->prepare("SELECT id FROM pages WHERE slug = :slug");
                $stmt->execute(['slug' => $slug]);
                if ($stmt->fetch()) {
                    $message = 'A page with this slug already exists.';
                    $message_type = 'danger';
                } else {
                    $stmt = $pdo->prepare("INSERT INTO pages (title, slug, content, category) VALUES (:title, :slug, :content, :category)");
                    $stmt->execute([
                        'title' => $title,
                        'slug' => $slug,
                        'content' => $content,
                        'category' => $category
                    ]);
                    $message = 'Page created successfully!';
                    $message_type = 'success';
                }
            } catch (PDOException $e) {
                $message = 'Error creating page: ' . $e->getMessage();
                $message_type = 'danger';
            }
        }
    }
}

// Update page
if (isset($_POST['update_page'])) {
    $id = intval($_POST['id'] ?? 0);
    $title = sanitize($_POST['title'] ?? '');
    $slug = sanitize($_POST['slug'] ?? '');
    $content = $_POST['content'] ?? '';
    $category = sanitize($_POST['category'] ?? '');
    
    if (empty($title) || empty($slug) || empty($content) || $id === 0) {
        $message = 'Please fill in all required fields.';
        $message_type = 'danger';
    } else {
        $pdo = get_db();
        if ($pdo) {
            try {
                // Check if slug exists for other pages
                $stmt = $pdo->prepare("SELECT id FROM pages WHERE slug = :slug AND id != :id");
                $stmt->execute(['slug' => $slug, 'id' => $id]);
                if ($stmt->fetch()) {
                    $message = 'A page with this slug already exists.';
                    $message_type = 'danger';
                } else {
                    $stmt = $pdo->prepare("UPDATE pages SET title = :title, slug = :slug, content = :content, category = :category WHERE id = :id");
                    $stmt->execute([
                        'title' => $title,
                        'slug' => $slug,
                        'content' => $content,
                        'category' => $category,
                        'id' => $id
                    ]);
                    $message = 'Page updated successfully!';
                    $message_type = 'success';
                }
            } catch (PDOException $e) {
                $message = 'Error updating page: ' . $e->getMessage();
                $message_type = 'danger';
            }
        }
    }
}

// Delete page
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    if ($id > 0) {
        $pdo = get_db();
        if ($pdo) {
            try {
                $stmt = $pdo->prepare("DELETE FROM pages WHERE id = :id");
                $stmt->execute(['id' => $id]);
                $message = 'Page deleted successfully!';
                $message_type = 'success';
            } catch (PDOException $e) {
                $message = 'Error deleting page: ' . $e->getMessage();
                $message_type = 'danger';
            }
        }
    }
}

// Get page for editing
$edit_page = null;
if (isset($_GET['action']) && $_GET['action'] === 'edit' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    if ($id > 0) {
        $pdo = get_db();
        if ($pdo) {
            $stmt = $pdo->prepare("SELECT * FROM pages WHERE id = :id");
            $stmt->execute(['id' => $id]);
            $edit_page = $stmt->fetch();
        }
    }
}

// Get all pages
$pages = [];
$pdo = get_db();
if ($pdo) {
    try {
        $stmt = $pdo->query("SELECT * FROM pages ORDER BY category, title");
        $pages = $stmt->fetchAll();
    } catch (PDOException $e) {
        error_log("Error fetching pages: " . $e->getMessage());
    }
}

// Set flash message
if (!empty($message)) {
    set_flash_message($message, $message_type);
}

// Redirect after successful operations
if ($message_type === 'success' && isset($_POST['add_page'])) {
    redirect(BASE_URL . '/admin/pages.php');
}
?>

<!-- Page Header -->
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1>Manage Pages</h1>
            <p class="text-muted mb-0">Create and manage website pages</p>
        </div>
        <button class="btn btn-admin-primary" data-bs-toggle="modal" data-bs-target="#addPageModal">
            <i class="fas fa-plus me-2"></i>Add New Page
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

<!-- Pages Table -->
<div class="admin-card">
    <div class="card-header">
        <i class="fas fa-file-alt me-2"></i>All Pages
    </div>
    <div class="card-body p-0">
        <?php if (!empty($pages)): ?>
            <div class="table-responsive">
                <table class="admin-table mb-0">
                    <thead>
                        <tr>
                            <th style="width: 40px;">ID</th>
                            <th>Title</th>
                            <th>Slug</th>
                            <th>Category</th>
                            <th>Last Updated</th>
                            <th style="width: 150px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pages as $page): ?>
                        <tr>
                            <td><?php echo $page['id']; ?></td>
                            <td>
                                <strong><?php echo sanitize($page['title']); ?></strong>
                            </td>
                            <td><code><?php echo sanitize($page['slug']); ?></code></td>
                            <td>
                                <span class="badge bg-secondary"><?php echo sanitize($page['category'] ?? 'General'); ?></span>
                            </td>
                            <td><?php echo date('M j, Y', strtotime($page['updated_at'])); ?></td>
                            <td>
                                <a href="?action=edit&id=<?php echo $page['id']; ?>" class="btn btn-sm btn-outline-primary" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="../page.php?slug=<?php echo $page['slug']; ?>" target="_blank" class="btn btn-sm btn-outline-info" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="?action=delete&id=<?php echo $page['id']; ?>" class="btn btn-sm btn-outline-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this page?');">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="text-center py-5">
                <i class="fas fa-file-alt text-muted" style="font-size: 3rem;"></i>
                <p class="text-muted mt-3">No pages found. Create your first page!</p>
                <button class="btn btn-admin-primary" data-bs-toggle="modal" data-bs-target="#addPageModal">
                    <i class="fas fa-plus me-2"></i>Add New Page
                </button>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Add Page Modal -->
<div class="modal fade" id="addPageModal" tabindex="-1" aria-labelledby="addPageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPageModalLabel">Add New Page</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Page Title *</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="slug" class="form-label">URL Slug *</label>
                        <input type="text" class="form-control" id="slug" name="slug" placeholder="e.g., about-us" required>
                        <small class="text-muted">This will be used in the URL: page.php?slug=your-slug</small>
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-select" id="category" name="category">
                            <option value="">Select Category</option>
                            <option value="home">Home</option>
                            <option value="about">About</option>
                            <option value="academic">Academic</option>
                            <option value="student-life">Student Life</option>
                            <option value="facilities">Facilities</option>
                            <option value="health">Health</option>
                            <option value="support">Support</option>
                            <option value="admission">Admission</option>
                            <option value="contact">Contact</option>
                            <option value="general">General</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Page Content *</label>
                        <textarea class="form-control" id="content" name="content" rows="12" required></textarea>
                        <small class="text-muted">You can use HTML tags for formatting</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="add_page" class="btn btn-admin-primary">Create Page</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Page Modal -->
<?php if ($edit_page): ?>
<div class="modal fade show" id="editPageModal" tabindex="-1" aria-labelledby="editPageModalLabel" aria-hidden="true" style="display: block;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPageModalLabel">Edit Page</h5>
                <a href="pages.php" class="btn-close" aria-label="Close"></a>
            </div>
            <form method="POST" action="">
                <div class="modal-body">
                    <input type="hidden" name="id" value="<?php echo $edit_page['id']; ?>">
                    <div class="mb-3">
                        <label for="edit_title" class="form-label">Page Title *</label>
                        <input type="text" class="form-control" id="edit_title" name="title" value="<?php echo sanitize($edit_page['title']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_slug" class="form-label">URL Slug *</label>
                        <input type="text" class="form-control" id="edit_slug" name="slug" value="<?php echo sanitize($edit_page['slug']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_category" class="form-label">Category</label>
                        <select class="form-select" id="edit_category" name="category">
                            <option value="">Select Category</option>
                            <option value="home" <?php echo ($edit_page['category'] ?? '') === 'home' ? 'selected' : ''; ?>>Home</option>
                            <option value="about" <?php echo ($edit_page['category'] ?? '') === 'about' ? 'selected' : ''; ?>>About</option>
                            <option value="academic" <?php echo ($edit_page['category'] ?? '') === 'academic' ? 'selected' : ''; ?>>Academic</option>
                            <option value="student-life" <?php echo ($edit_page['category'] ?? '') === 'student-life' ? 'selected' : ''; ?>>Student Life</option>
                            <option value="facilities" <?php echo ($edit_page['category'] ?? '') === 'facilities' ? 'selected' : ''; ?>>Facilities</option>
                            <option value="health" <?php echo ($edit_page['category'] ?? '') === 'health' ? 'selected' : ''; ?>>Health</option>
                            <option value="support" <?php echo ($edit_page['category'] ?? '') === 'support' ? 'selected' : ''; ?>>Support</option>
                            <option value="admission" <?php echo ($edit_page['category'] ?? '') === 'admission' ? 'selected' : ''; ?>>Admission</option>
                            <option value="contact" <?php echo ($edit_page['category'] ?? '') === 'contact' ? 'selected' : ''; ?>>Contact</option>
                            <option value="general" <?php echo ($edit_page['category'] ?? '') === 'general' ? 'selected' : ''; ?>>General</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_content" class="form-label">Page Content *</label>
                        <textarea class="form-control" id="edit_content" name="content" rows="12" required><?php echo $edit_page['content']; ?></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="pages.php" class="btn btn-secondary">Cancel</a>
                    <button type="submit" name="update_page" class="btn btn-admin-primary">Update Page</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal-backdrop fade show"></div>
<?php endif; ?>

<style>
/* Pages specific styles */
#addPageModal .modal-body,
#editPageModal .modal-body {
    max-height: 70vh;
    overflow-y: auto;
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

#editPageModal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1050;
    overflow-x: hidden;
    overflow-y: auto;
}

#editPageModal .modal-dialog {
    margin: 1.75rem auto;
    max-width: 800px;
}
</style>

<script>
// Auto-generate slug from title
document.getElementById('title')?.addEventListener('input', function() {
    const slugInput = document.getElementById('slug');
    const slug = this.value.toLowerCase()
        .replace(/[^a-z0-9]+/g, '-')
        .replace(/(^-|-$)/g, '');
    slugInput.value = slug;
});
</script>

<?php
require_once 'footer.php';
?>
