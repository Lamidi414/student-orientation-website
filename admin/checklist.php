<?php
/**
 * Checklist Management
 * NAUB Orientation Portal - Admin Panel
 */

$page_title = 'Manage Checklist';
$current_page = 'checklist';

require_once 'header.php';
require_once '../includes/functions.php';

// Handle form submissions
$message = '';
$message_type = 'success';

// Add new checklist item
if (isset($_POST['add_item'])) {
    $title = sanitize($_POST['title'] ?? '');
    $description = sanitize($_POST['description'] ?? '');
    $category = sanitize($_POST['category'] ?? 'pre-arrival');
    $priority = sanitize($_POST['priority'] ?? 'medium');
    
    if (empty($title)) {
        $message = 'Please enter the item title.';
        $message_type = 'danger';
    } else {
        $pdo = get_db();
        if ($pdo) {
            try {
                // Get max sort order
                $stmt = $pdo->query("SELECT MAX(sort_order) as max_order FROM checklist_items");
                $max_order = $stmt->fetch()['max_order'] ?? 0;
                
                $stmt = $pdo->prepare("INSERT INTO checklist_items (title, description, category, priority, sort_order) VALUES (:title, :description, :category, :priority, :sort_order)");
                $stmt->execute([
                    'title' => $title,
                    'description' => $description,
                    'category' => $category,
                    'priority' => $priority,
                    'sort_order' => $max_order + 1
                ]);
                $message = 'Checklist item created successfully!';
                $message_type = 'success';
            } catch (PDOException $e) {
                $message = 'Error creating checklist item: ' . $e->getMessage();
                $message_type = 'danger';
            }
        }
    }
}

// Update checklist item
if (isset($_POST['update_item'])) {
    $id = intval($_POST['id'] ?? 0);
    $title = sanitize($_POST['title'] ?? '');
    $description = sanitize($_POST['description'] ?? '');
    $category = sanitize($_POST['category'] ?? 'pre-arrival');
    $priority = sanitize($_POST['priority'] ?? 'medium');
    
    if (empty($title) || $id === 0) {
        $message = 'Please enter the item title.';
        $message_type = 'danger';
    } else {
        $pdo = get_db();
        if ($pdo) {
            try {
                $stmt = $pdo->prepare("UPDATE checklist_items SET title = :title, description = :description, category = :category, priority = :priority WHERE id = :id");
                $stmt->execute([
                    'title' => $title,
                    'description' => $description,
                    'category' => $category,
                    'priority' => $priority,
                    'id' => $id
                ]);
                $message = 'Checklist item updated successfully!';
                $message_type = 'success';
            } catch (PDOException $e) {
                $message = 'Error updating checklist item: ' . $e->getMessage();
                $message_type = 'danger';
            }
        }
    }
}

// Delete checklist item
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    if ($id > 0) {
        $pdo = get_db();
        if ($pdo) {
            try {
                $stmt = $pdo->prepare("DELETE FROM checklist_items WHERE id = :id");
                $stmt->execute(['id' => $id]);
                $message = 'Checklist item deleted successfully!';
                $message_type = 'success';
            } catch (PDOException $e) {
                $message = 'Error deleting checklist item: ' . $e->getMessage();
                $message_type = 'danger';
            }
        }
    }
}

// Reorder items
if (isset($_GET['action']) && $_GET['action'] === 'reorder' && isset($_POST['order'])) {
    $order = $_POST['order'];
    $pdo = get_db();
    if ($pdo && is_array($order)) {
        try {
            foreach ($order as $position => $item_id) {
                $stmt = $pdo->prepare("UPDATE checklist_items SET sort_order = :position WHERE id = :id");
                $stmt->execute(['position' => $position + 1, 'id' => intval($item_id)]);
            }
            $message = 'Checklist items reordered successfully!';
            $message_type = 'success';
        } catch (PDOException $e) {
            $message = 'Error reordering items: ' . $e->getMessage();
            $message_type = 'danger';
        }
    }
}

// Get item for editing
$edit_item = null;
if (isset($_GET['action']) && $_GET['action'] === 'edit' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    if ($id > 0) {
        $pdo = get_db();
        if ($pdo) {
            $stmt = $pdo->prepare("SELECT * FROM checklist_items WHERE id = :id");
            $stmt->execute(['id' => $id]);
            $edit_item = $stmt->fetch();
        }
    }
}

// Get all checklist items
$checklist_items = [];
$pdo = get_db();
if ($pdo) {
    try {
        $stmt = $pdo->query("SELECT * FROM checklist_items ORDER BY sort_order");
        $checklist_items = $stmt->fetchAll();
    } catch (PDOException $e) {
        error_log("Error fetching checklist items: " . $e->getMessage());
    }
}

// Group by category
$grouped_items = [];
$categories = ['pre-arrival', 'registration', 'first-week', 'academic'];
foreach ($categories as $cat) {
    $grouped_items[$cat] = array_filter($checklist_items, function($item) use ($cat) {
        return ($item['category'] ?? 'pre-arrival') === $cat;
    });
}

// Set flash message
if (!empty($message)) {
    set_flash_message($message, $message_type);
}

// Redirect after successful operations
if ($message_type === 'success' && isset($_POST['add_item'])) {
    redirect(BASE_URL . '/admin/checklist.php');
}
?>

<!-- Page Header -->
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1>Manage Checklist</h1>
            <p class="text-muted mb-0">Manage new student checklist items</p>
        </div>
        <div>
            <button class="btn btn-secondary me-2" data-bs-toggle="modal" data-bs-target="#reorderModal">
                <i class="fas fa-sort me-2"></i>Reorder
            </button>
            <button class="btn btn-admin-primary" data-bs-toggle="modal" data-bs-target="#addItemModal">
                <i class="fas fa-plus me-2"></i>Add New Item
            </button>
        </div>
    </div>
</div>

<!-- Alert Message -->
<?php if (!empty($message) && $message_type !== 'success'): ?>
<div class="alert alert-<?php echo $message_type; ?> alert-dismissible fade show" role="alert">
    <?php echo sanitize($message); ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>

<!-- Checklist by Category -->
<?php 
$category_labels = [
    'pre-arrival' => 'Pre-Arrival',
    'registration' => 'Registration',
    'first-week' => 'First Week',
    'academic' => 'Academic'
];

foreach ($categories as $category): 
    $items = $grouped_items[$category] ?? [];
?>
<div class="admin-card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>
            <i class="fas fa-<?php echo $category === 'pre-arrival' ? 'plane' : ($category === 'registration' ? 'clipboard-list' : ($category === 'first-week' ? 'calendar-week' : 'graduation-cap')); ?> me-2"></i>
            <?php echo $category_labels[$category] ?? ucfirst($category); ?>
        </span>
        <span class="badge bg-secondary"><?php echo count($items); ?> items</span>
    </div>
    <div class="card-body p-0">
        <?php if (!empty($items)): ?>
            <div class="table-responsive">
                <table class="admin-table mb-0">
                    <thead>
                        <tr>
                            <th style="width: 50px;">#</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Priority</th>
                            <th style="width: 120px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($items as $item): ?>
                        <tr>
                            <td><?php echo $item['sort_order']; ?></td>
                            <td>
                                <strong><?php echo sanitize($item['title']); ?></strong>
                            </td>
                            <td><?php echo sanitize($item['description'] ?? ''); ?></td>
                            <td>
                                <?php 
                                $priority_class = '';
                                $priority_text = '';
                                switch($item['priority']) {
                                    case 'high':
                                        $priority_class = 'badge-high';
                                        $priority_text = 'High';
                                        break;
                                    case 'medium':
                                        $priority_class = 'badge-medium';
                                        $priority_text = 'Medium';
                                        break;
                                    case 'low':
                                        $priority_class = 'badge-low';
                                        $priority_text = 'Low';
                                        break;
                                }
                                ?>
                                <span class="badge <?php echo $priority_class; ?>"><?php echo $priority_text; ?></span>
                            </td>
                            <td>
                                <a href="?action=edit&id=<?php echo $item['id']; ?>" class="btn btn-sm btn-outline-primary" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="?action=delete&id=<?php echo $item['id']; ?>" class="btn btn-sm btn-outline-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this item?');">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="text-center py-4">
                <p class="text-muted mb-0">No items in this category</p>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php endforeach; ?>

<!-- Add Item Modal -->
<div class="modal fade" id="addItemModal" tabindex="-1" aria-labelledby="addItemModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addItemModalLabel">Add Checklist Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title *</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="e.g., Complete Registration" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" placeholder="Brief description of the task"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-select" id="category" name="category">
                            <option value="pre-arrival">Pre-Arrival</option>
                            <option value="registration">Registration</option>
                            <option value="first-week">First Week</option>
                            <option value="academic">Academic</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="priority" class="form-label">Priority</label>
                        <select class="form-select" id="priority" name="priority">
                            <option value="high">High</option>
                            <option value="medium" selected>Medium</option>
                            <option value="low">Low</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="add_item" class="btn btn-admin-primary">Create Item</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Item Modal -->
<?php if ($edit_item): ?>
<div class="modal fade show" id="editItemModal" tabindex="-1" aria-labelledby="editItemModalLabel" aria-hidden="true" style="display: block;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editItemModalLabel">Edit Checklist Item</h5>
                <a href="checklist.php" class="btn-close" aria-label="Close"></a>
            </div>
            <form method="POST" action="">
                <div class="modal-body">
                    <input type="hidden" name="id" value="<?php echo $edit_item['id']; ?>">
                    <div class="mb-3">
                        <label for="edit_title" class="form-label">Title *</label>
                        <input type="text" class="form-control" id="edit_title" name="title" value="<?php echo sanitize($edit_item['title']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_description" class="form-label">Description</label>
                        <textarea class="form-control" id="edit_description" name="description" rows="3"><?php echo sanitize($edit_item['description'] ?? ''); ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="edit_category" class="form-label">Category</label>
                        <select class="form-select" id="edit_category" name="category">
                            <option value="pre-arrival" <?php echo ($edit_item['category'] ?? '') === 'pre-arrival' ? 'selected' : ''; ?>>Pre-Arrival</option>
                            <option value="registration" <?php echo ($edit_item['category'] ?? '') === 'registration' ? 'selected' : ''; ?>>Registration</option>
                            <option value="first-week" <?php echo ($edit_item['category'] ?? '') === 'first-week' ? 'selected' : ''; ?>>First Week</option>
                            <option value="academic" <?php echo ($edit_item['category'] ?? '') === 'academic' ? 'selected' : ''; ?>>Academic</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_priority" class="form-label">Priority</label>
                        <select class="form-select" id="edit_priority" name="priority">
                            <option value="high" <?php echo ($edit_item['priority'] ?? '') === 'high' ? 'selected' : ''; ?>>High</option>
                            <option value="medium" <?php echo ($edit_item['priority'] ?? 'medium') === 'medium' ? 'selected' : ''; ?>>Medium</option>
                            <option value="low" <?php echo ($edit_item['priority'] ?? '') === 'low' ? 'selected' : ''; ?>>Low</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="checklist.php" class="btn btn-secondary">Cancel</a>
                    <button type="submit" name="update_item" class="btn btn-admin-primary">Update Item</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal-backdrop fade show"></div>
<?php endif; ?>

<!-- Reorder Modal -->
<div class="modal fade" id="reorderModal" tabindex="-1" aria-labelledby="reorderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reorderModalLabel">Reorder Checklist Items</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="GET" action="">
                <input type="hidden" name="action" value="reorder">
                <div class="modal-body">
                    <p class="text-muted">Drag and drop items to reorder them. The order will be saved when you click "Save Order".</p>
                    <ul class="list-group" id="sortableList">
                        <?php foreach ($checklist_items as $item): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center" data-id="<?php echo $item['id']; ?>">
                            <span><i class="fas fa-grip-lines me-2 text-muted"></i> <?php echo sanitize($item['title']); ?></span>
                            <input type="hidden" name="order[]" value="<?php echo $item['id']; ?>">
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-admin-primary">Save Order</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.modal-backdrop {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 1040;
}

#editItemModal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1050;
    overflow-x: hidden;
    overflow-y: auto;
}

#editItemModal .modal-dialog {
    margin: 1.75rem auto;
    max-width: 600px;
}

#sortableList .list-group-item {
    cursor: move;
}

#sortableList .list-group-item:active {
    cursor: grabbing;
}

.list-group-item.ui-sortable-helper {
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}
</style>

<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<script>
$(document).ready(function() {
    // Enable sorting
    $("#sortableList").sortable({
        handle: 'span',
        update: function(event, ui) {
            // Update hidden inputs order
            var order = [];
            $('#sortableList li').each(function() {
                order.push($(this).data('id'));
                $(this).find('input[name="order[]"]').val($(this).data('id'));
            });
        }
    });
});
</script>

<?php
require_once 'footer.php';
?>
