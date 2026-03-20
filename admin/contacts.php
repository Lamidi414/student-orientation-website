<?php
/**
 * Contacts Management
 * NAUB Orientation Portal - Admin Panel
 */

$page_title = 'Manage Contacts';
$current_page = 'contacts';

require_once 'header.php';
require_once '../includes/functions.php';

// Handle form submissions
$message = '';
$message_type = 'success';

// Add new contact
if (isset($_POST['add_contact'])) {
    $office_name = sanitize($_POST['office_name'] ?? '');
    $email = sanitize($_POST['email'] ?? '');
    $phone = sanitize($_POST['phone'] ?? '');
    $location = sanitize($_POST['location'] ?? '');
    
    if (empty($office_name)) {
        $message = 'Please enter the office name.';
        $message_type = 'danger';
    } else {
        $pdo = get_db();
        if ($pdo) {
            try {
                $stmt = $pdo->prepare("INSERT INTO contacts (office_name, email, phone, location) VALUES (:office_name, :email, :phone, :location)");
                $stmt->execute([
                    'office_name' => $office_name,
                    'email' => $email,
                    'phone' => $phone,
                    'location' => $location
                ]);
                $message = 'Contact created successfully!';
                $message_type = 'success';
            } catch (PDOException $e) {
                $message = 'Error creating contact: ' . $e->getMessage();
                $message_type = 'danger';
            }
        }
    }
}

// Update contact
if (isset($_POST['update_contact'])) {
    $id = intval($_POST['id'] ?? 0);
    $office_name = sanitize($_POST['office_name'] ?? '');
    $email = sanitize($_POST['email'] ?? '');
    $phone = sanitize($_POST['phone'] ?? '');
    $location = sanitize($_POST['location'] ?? '');
    
    if (empty($office_name) || $id === 0) {
        $message = 'Please enter the office name.';
        $message_type = 'danger';
    } else {
        $pdo = get_db();
        if ($pdo) {
            try {
                $stmt = $pdo->prepare("UPDATE contacts SET office_name = :office_name, email = :email, phone = :phone, location = :location WHERE id = :id");
                $stmt->execute([
                    'office_name' => $office_name,
                    'email' => $email,
                    'phone' => $phone,
                    'location' => $location,
                    'id' => $id
                ]);
                $message = 'Contact updated successfully!';
                $message_type = 'success';
            } catch (PDOException $e) {
                $message = 'Error updating contact: ' . $e->getMessage();
                $message_type = 'danger';
            }
        }
    }
}

// Delete contact
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    if ($id > 0) {
        $pdo = get_db();
        if ($pdo) {
            try {
                $stmt = $pdo->prepare("DELETE FROM contacts WHERE id = :id");
                $stmt->execute(['id' => $id]);
                $message = 'Contact deleted successfully!';
                $message_type = 'success';
            } catch (PDOException $e) {
                $message = 'Error deleting contact: ' . $e->getMessage();
                $message_type = 'danger';
            }
        }
    }
}

// Get contact for editing
$edit_contact = null;
if (isset($_GET['action']) && $_GET['action'] === 'edit' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    if ($id > 0) {
        $pdo = get_db();
        if ($pdo) {
            $stmt = $pdo->prepare("SELECT * FROM contacts WHERE id = :id");
            $stmt->execute(['id' => $id]);
            $edit_contact = $stmt->fetch();
        }
    }
}

// Get all contacts
$contacts = [];
$pdo = get_db();
if ($pdo) {
    try {
        $stmt = $pdo->query("SELECT * FROM contacts ORDER BY office_name");
        $contacts = $stmt->fetchAll();
    } catch (PDOException $e) {
        error_log("Error fetching contacts: " . $e->getMessage());
    }
}

// Set flash message
if (!empty($message)) {
    set_flash_message($message, $message_type);
}

// Redirect after successful operations
if ($message_type === 'success' && isset($_POST['add_contact'])) {
    redirect(BASE_URL . '/admin/contacts.php');
}
?>

<!-- Page Header -->
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1>Manage Contacts</h1>
            <p class="text-muted mb-0">Manage university department contacts</p>
        </div>
        <button class="btn btn-admin-primary" data-bs-toggle="modal" data-bs-target="#addContactModal">
            <i class="fas fa-plus me-2"></i>Add New Contact
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

<!-- Contacts Table -->
<div class="admin-card">
    <div class="card-header">
        <i class="fas fa-address-book me-2"></i>All Contacts
    </div>
    <div class="card-body p-0">
        <?php if (!empty($contacts)): ?>
            <div class="table-responsive">
                <table class="admin-table mb-0">
                    <thead>
                        <tr>
                            <th style="width: 50px;">ID</th>
                            <th>Office/Department</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Location</th>
                            <th style="width: 120px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($contacts as $contact): ?>
                        <tr>
                            <td><?php echo $contact['id']; ?></td>
                            <td>
                                <strong><?php echo sanitize($contact['office_name']); ?></strong>
                            </td>
                            <td>
                                <?php if (!empty($contact['email'])): ?>
                                    <a href="mailto:<?php echo sanitize($contact['email']); ?>">
                                        <?php echo sanitize($contact['email']); ?>
                                    </a>
                                <?php else: ?>
                                    <span class="text-muted">N/A</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if (!empty($contact['phone'])): ?>
                                    <a href="tel:<?php echo sanitize($contact['phone']); ?>">
                                        <?php echo sanitize($contact['phone']); ?>
                                    </a>
                                <?php else: ?>
                                    <span class="text-muted">N/A</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo sanitize($contact['location'] ?? 'N/A'); ?></td>
                            <td>
                                <a href="?action=edit&id=<?php echo $contact['id']; ?>" class="btn btn-sm btn-outline-primary" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="?action=delete&id=<?php echo $contact['id']; ?>" class="btn btn-sm btn-outline-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this contact?');">
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
                <i class="fas fa-address-book text-muted" style="font-size: 3rem;"></i>
                <p class="text-muted mt-3">No contacts found. Add your first contact!</p>
                <button class="btn btn-admin-primary" data-bs-toggle="modal" data-bs-target="#addContactModal">
                    <i class="fas fa-plus me-2"></i>Add New Contact
                </button>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Add Contact Modal -->
<div class="modal fade" id="addContactModal" tabindex="-1" aria-labelledby="addContactModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addContactModalLabel">Add New Contact</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="office_name" class="form-label">Office/Department Name *</label>
                        <input type="text" class="form-control" id="office_name" name="office_name" placeholder="e.g., Admissions Office" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="e.g., admissions@naub.edu.ng">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="e.g., +234 800 NAUB ADM">
                    </div>
                    <div class="mb-3">
                        <label for="location" class="form-label">Location/Office</label>
                        <input type="text" class="form-control" id="location" name="location" placeholder="e.g., Administrative Block, Room 205">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="add_contact" class="btn btn-admin-primary">Create Contact</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Contact Modal -->
<?php if ($edit_contact): ?>
<div class="modal fade show" id="editContactModal" tabindex="-1" aria-labelledby="editContactModalLabel" aria-hidden="true" style="display: block;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editContactModalLabel">Edit Contact</h5>
                <a href="contacts.php" class="btn-close" aria-label="Close"></a>
            </div>
            <form method="POST" action="">
                <div class="modal-body">
                    <input type="hidden" name="id" value="<?php echo $edit_contact['id']; ?>">
                    <div class="mb-3">
                        <label for="edit_office_name" class="form-label">Office/Department Name *</label>
                        <input type="text" class="form-control" id="edit_office_name" name="office_name" value="<?php echo sanitize($edit_contact['office_name']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="edit_email" name="email" value="<?php echo sanitize($edit_contact['email'] ?? ''); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="edit_phone" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="edit_phone" name="phone" value="<?php echo sanitize($edit_contact['phone'] ?? ''); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="edit_location" class="form-label">Location/Office</label>
                        <input type="text" class="form-control" id="edit_location" name="location" value="<?php echo sanitize($edit_contact['location'] ?? ''); ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="contacts.php" class="btn btn-secondary">Cancel</a>
                    <button type="submit" name="update_contact" class="btn btn-admin-primary">Update Contact</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal-backdrop fade show"></div>
<?php endif; ?>

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

#editContactModal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1050;
    overflow-x: hidden;
    overflow-y: auto;
}

#editContactModal .modal-dialog {
    margin: 1.75rem auto;
    max-width: 600px;
}
</style>

<?php
require_once 'footer.php';
?>
