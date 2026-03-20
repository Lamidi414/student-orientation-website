<?php
/**
 * FAQs Management
 * NAUB Orientation Portal - Admin Panel
 */

$page_title = 'Manage FAQs';
$current_page = 'faqs';

require_once 'header.php';
require_once '../includes/functions.php';

// Handle form submissions
$message = '';
$message_type = 'success';

// Add new FAQ
if (isset($_POST['add_faq'])) {
    $question = sanitize($_POST['question'] ?? '');
    $answer = $_POST['answer'] ?? '';
    $category = sanitize($_POST['category'] ?? '');
    
    if (empty($question) || empty($answer)) {
        $message = 'Please fill in all required fields.';
        $message_type = 'danger';
    } else {
        $pdo = get_db();
        if ($pdo) {
            try {
                $stmt = $pdo->prepare("INSERT INTO faqs (question, answer, category) VALUES (:question, :answer, :category)");
                $stmt->execute([
                    'question' => $question,
                    'answer' => $answer,
                    'category' => $category
                ]);
                $message = 'FAQ created successfully!';
                $message_type = 'success';
            } catch (PDOException $e) {
                $message = 'Error creating FAQ: ' . $e->getMessage();
                $message_type = 'danger';
            }
        }
    }
}

// Update FAQ
if (isset($_POST['update_faq'])) {
    $id = intval($_POST['id'] ?? 0);
    $question = sanitize($_POST['question'] ?? '');
    $answer = $_POST['answer'] ?? '';
    $category = sanitize($_POST['category'] ?? '');
    
    if (empty($question) || empty($answer) || $id === 0) {
        $message = 'Please fill in all required fields.';
        $message_type = 'danger';
    } else {
        $pdo = get_db();
        if ($pdo) {
            try {
                $stmt = $pdo->prepare("UPDATE faqs SET question = :question, answer = :answer, category = :category WHERE id = :id");
                $stmt->execute([
                    'question' => $question,
                    'answer' => $answer,
                    'category' => $category,
                    'id' => $id
                ]);
                $message = 'FAQ updated successfully!';
                $message_type = 'success';
            } catch (PDOException $e) {
                $message = 'Error updating FAQ: ' . $e->getMessage();
                $message_type = 'danger';
            }
        }
    }
}

// Delete FAQ
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    if ($id > 0) {
        $pdo = get_db();
        if ($pdo) {
            try {
                $stmt = $pdo->prepare("DELETE FROM faqs WHERE id = :id");
                $stmt->execute(['id' => $id]);
                $message = 'FAQ deleted successfully!';
                $message_type = 'success';
            } catch (PDOException $e) {
                $message = 'Error deleting FAQ: ' . $e->getMessage();
                $message_type = 'danger';
            }
        }
    }
}

// Get FAQ for editing
$edit_faq = null;
if (isset($_GET['action']) && $_GET['action'] === 'edit' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    if ($id > 0) {
        $pdo = get_db();
        if ($pdo) {
            $stmt = $pdo->prepare("SELECT * FROM faqs WHERE id = :id");
            $stmt->execute(['id' => $id]);
            $edit_faq = $stmt->fetch();
        }
    }
}

// Get all FAQs
$faqs = [];
$categories = [];
$pdo = get_db();
if ($pdo) {
    try {
        $stmt = $pdo->query("SELECT * FROM faqs ORDER BY category, id");
        $faqs = $stmt->fetchAll();
        
        // Get unique categories
        $stmt = $pdo->query("SELECT DISTINCT category FROM faqs WHERE category IS NOT NULL ORDER BY category");
        $categories = $stmt->fetchAll(PDO::FETCH_COLUMN);
    } catch (PDOException $e) {
        error_log("Error fetching FAQs: " . $e->getMessage());
    }
}

// Set flash message
if (!empty($message)) {
    set_flash_message($message, $message_type);
}

// Redirect after successful operations
if ($message_type === 'success' && isset($_POST['add_faq'])) {
    redirect(BASE_URL . '/admin/faqs.php');
}
?>

<!-- Page Header -->
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1>Manage FAQs</h1>
            <p class="text-muted mb-0">Create and manage frequently asked questions</p>
        </div>
        <button class="btn btn-admin-primary" data-bs-toggle="modal" data-bs-target="#addFaqModal">
            <i class="fas fa-plus me-2"></i>Add New FAQ
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

<!-- Category Filter -->
<?php if (!empty($categories)): ?>
<div class="mb-3">
    <div class="btn-group" role="group">
        <a href="faqs.php" class="btn btn-sm btn-outline-secondary <?php echo !isset($_GET['category']) ? 'active' : ''; ?>">
            All
        </a>
        <?php foreach ($categories as $cat): ?>
        <a href="faqs.php?category=<?php echo $cat; ?>" class="btn btn-sm btn-outline-secondary <?php echo ($_GET['category'] ?? '') === $cat ? 'active' : ''; ?>">
            <?php echo ucfirst($cat); ?>
        </a>
        <?php endforeach; ?>
    </div>
</div>
<?php endif; ?>

<!-- FAQs Table -->
<div class="admin-card">
    <div class="card-header">
        <i class="fas fa-question-circle me-2"></i>All FAQs
    </div>
    <div class="card-body p-0">
        <?php 
        // Filter by category if set
        $filtered_faqs = $faqs;
        if (isset($_GET['category']) && !empty($_GET['category'])) {
            $filtered_faqs = array_filter($faqs, function($faq) {
                return ($faq['category'] ?? '') === $_GET['category'];
            });
        }
        ?>
        
        <?php if (!empty($filtered_faqs)): ?>
            <div class="accordion" id="faqAccordion">
                <?php foreach ($filtered_faqs as $index => $faq): ?>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button <?php echo $index === 0 ? '' : 'collapsed'; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#faq<?php echo $faq['id']; ?>">
                            <span class="me-auto"><?php echo sanitize($faq['question']); ?></span>
                            <span class="badge bg-secondary me-3"><?php echo sanitize($faq['category'] ?? 'General'); ?></span>
                        </button>
                    </h2>
                    <div id="faq<?php echo $faq['id']; ?>" class="accordion-collapse collapse <?php echo $index === 0 ? 'show' : ''; ?>" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            <p><?php echo $faq['answer']; ?></p>
                            <div class="mt-3">
                                <a href="?action=edit&id=<?php echo $faq['id']; ?>" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-edit me-1"></i> Edit
                                </a>
                                <a href="?action=delete&id=<?php echo $faq['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this FAQ?');">
                                    <i class="fas fa-trash me-1"></i> Delete
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="text-center py-5">
                <i class="fas fa-question-circle text-muted" style="font-size: 3rem;"></i>
                <p class="text-muted mt-3">No FAQs found. Create your first FAQ!</p>
                <button class="btn btn-admin-primary" data-bs-toggle="modal" data-bs-target="#addFaqModal">
                    <i class="fas fa-plus me-2"></i>Add New FAQ
                </button>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Add FAQ Modal -->
<div class="modal fade" id="addFaqModal" tabindex="-1" aria-labelledby="addFaqModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addFaqModalLabel">Add New FAQ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="question" class="form-label">Question *</label>
                        <input type="text" class="form-control" id="question" name="question" placeholder="Enter the question" required>
                    </div>
                    <div class="mb-3">
                        <label for="answer" class="form-label">Answer *</label>
                        <textarea class="form-control" id="answer" name="answer" rows="6" placeholder="Enter the answer" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-select" id="category" name="category">
                            <option value="">Select Category</option>
                            <option value="registration">Registration</option>
                            <option value="academic">Academic</option>
                            <option value="hostel">Hostel</option>
                            <option value="financial">Financial</option>
                            <option value="portal">Student Portal</option>
                            <option value="documents">Documents</option>
                            <option value="health">Health</option>
                            <option value="facilities">Facilities</option>
                            <option value="activities">Activities</option>
                            <option value="general">General</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="add_faq" class="btn btn-admin-primary">Create FAQ</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit FAQ Modal -->
<?php if ($edit_faq): ?>
<div class="modal fade show" id="editFaqModal" tabindex="-1" aria-labelledby="editFaqModalLabel" aria-hidden="true" style="display: block;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editFaqModalLabel">Edit FAQ</h5>
                <a href="faqs.php" class="btn-close" aria-label="Close"></a>
            </div>
            <form method="POST" action="">
                <div class="modal-body">
                    <input type="hidden" name="id" value="<?php echo $edit_faq['id']; ?>">
                    <div class="mb-3">
                        <label for="edit_question" class="form-label">Question *</label>
                        <input type="text" class="form-control" id="edit_question" name="question" value="<?php echo sanitize($edit_faq['question']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_answer" class="form-label">Answer *</label>
                        <textarea class="form-control" id="edit_answer" name="answer" rows="6" required><?php echo $edit_faq['answer']; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="edit_category" class="form-label">Category</label>
                        <select class="form-select" id="edit_category" name="category">
                            <option value="">Select Category</option>
                            <option value="registration" <?php echo ($edit_faq['category'] ?? '') === 'registration' ? 'selected' : ''; ?>>Registration</option>
                            <option value="academic" <?php echo ($edit_faq['category'] ?? '') === 'academic' ? 'selected' : ''; ?>>Academic</option>
                            <option value="hostel" <?php echo ($edit_faq['category'] ?? '') === 'hostel' ? 'selected' : ''; ?>>Hostel</option>
                            <option value="financial" <?php echo ($edit_faq['category'] ?? '') === 'financial' ? 'selected' : ''; ?>>Financial</option>
                            <option value="portal" <?php echo ($edit_faq['category'] ?? '') === 'portal' ? 'selected' : ''; ?>>Student Portal</option>
                            <option value="documents" <?php echo ($edit_faq['category'] ?? '') === 'documents' ? 'selected' : ''; ?>>Documents</option>
                            <option value="health" <?php echo ($edit_faq['category'] ?? '') === 'health' ? 'selected' : ''; ?>>Health</option>
                            <option value="facilities" <?php echo ($edit_faq['category'] ?? '') === 'facilities' ? 'selected' : ''; ?>>Facilities</option>
                            <option value="activities" <?php echo ($edit_faq['category'] ?? '') === 'activities' ? 'selected' : ''; ?>>Activities</option>
                            <option value="general" <?php echo ($edit_faq['category'] ?? '') === 'general' ? 'selected' : ''; ?>>General</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="faqs.php" class="btn btn-secondary">Cancel</a>
                    <button type="submit" name="update_faq" class="btn btn-admin-primary">Update FAQ</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal-backdrop fade show"></div>
<?php endif; ?>

<style>
.accordion-button {
    font-weight: 500;
}

.accordion-button:not(.collapsed) {
    background-color: #f8f9fa;
    color: #1a5f7a;
}

.accordion-button .badge {
    font-size: 0.7rem;
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

#editFaqModal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1050;
    overflow-x: hidden;
    overflow-y: auto;
}

#editFaqModal .modal-dialog {
    margin: 1.75rem auto;
    max-width: 800px;
}
</style>

<?php
require_once 'footer.php';
?>
