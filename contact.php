<?php
/**
 * Contact Page
 * NAUB Orientation Portal
 */

$page_title = 'Contact Us';
require_once 'includes/header.php';
require_once 'includes/functions.php';

// Get contacts from database
$contacts = get_all_contacts();

// Handle form submission
$form_submitted = false;
$form_error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = sanitize($_POST['name'] ?? '');
    $email = sanitize($_POST['email'] ?? '');
    $subject = sanitize($_POST['subject'] ?? '');
    $message = sanitize($_POST['message'] ?? '');
    
    // Validate input
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        $form_error = 'All fields are required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $form_error = 'Please enter a valid email address.';
    } else {
        // In a production environment, you would save to database or send email
        // For now, we'll just show success message
        $form_submitted = true;
    }
}

// Define emergency contacts
$emergency_contacts = [
    ['name' => 'Security Office', 'phone' => '+234 800 NAUB SEC', 'type' => 'Security'],
    ['name' => 'Health Center', 'phone' => '+234 800 NAUB HLT', 'type' => 'Medical Emergency'],
    ['name' => 'Vice Chancellor\'s Office', 'phone' => '+234 800 NAUB VC', 'type' => 'Urgent']
];
?>

<!-- Hero Section -->
<section class="page-hero">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="page-title">Contact Us</h1>
                <p class="page-subtitle">Get in touch with NAUB</p>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<section class="contact-section py-5">
    <div class="container">
        <!-- University Contact Information -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="contact-info-card">
                    <h2 class="section-title">University Contact Information</h2>
                    <div class="row mt-4">
                        <div class="col-md-6 mb-4">
                            <div class="contact-detail">
                                <i class="fas fa-map-marker-alt"></i>
                                <div>
                                    <h4>Address</h4>
                                    <p>Nigerian Army University, Biu<br>
                                    Biu, Borno State, Nigeria</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="contact-detail">
                                <i class="fas fa-phone"></i>
                                <div>
                                    <h4>Phone</h4>
                                    <p>+234 800 NAUB UNI</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="contact-detail">
                                <i class="fas fa-envelope"></i>
                                <div>
                                    <h4>Email</h4>
                                    <p>info@naub.edu.ng</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="contact-detail">
                                <i class="fas fa-globe"></i>
                                <div>
                                    <h4>Website</h4>
                                    <p><a href="https://www.naub.edu.ng" target="_blank">www.naub.edu.ng</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Emergency Contacts -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="emergency-card">
                    <h2 class="section-title">
                        <i class="fas fa-exclamation-triangle me-2"></i>Emergency Contacts
                    </h2>
                    <p class="text-muted mb-4">These numbers are available 24/7 for urgent assistance</p>
                    <div class="row">
                        <?php foreach ($emergency_contacts as $emergency): ?>
                        <div class="col-md-4 mb-3">
                            <div class="emergency-item">
                                <span class="badge bg-danger mb-2"><?php echo sanitize($emergency['type']); ?></span>
                                <h5><?php echo sanitize($emergency['name']); ?></h5>
                                <a href="tel:<?php echo sanitize($emergency['phone']); ?>" class="btn btn-outline-danger btn-sm">
                                    <i class="fas fa-phone me-1"></i> <?php echo sanitize($emergency['phone']); ?>
                                </a>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Directory Table -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="contact-directory-card">
                    <h2 class="section-title">Contact Directory</h2>
                    <p class="text-muted mb-4">Find contacts for various university departments and offices</p>
                    
                    <div class="table-responsive">
                        <table class="table table-hover contact-table">
                            <thead>
                                <tr>
                                    <th>Office/Department</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Location</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($contacts)): ?>
                                    <?php foreach ($contacts as $contact): ?>
                                    <tr>
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
                                    </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4" class="text-center py-4">
                                            <p class="text-muted mb-0">No contacts available at the moment.</p>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Map Placeholder -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="map-card">
                    <h2 class="section-title">Campus Location</h2>
                    <div class="map-placeholder">
                        <i class="fas fa-map-marked-alt"></i>
                        <p>NAUB Campus Map</p>
                        <small>Nigerian Army University, Biu, Borno State, Nigeria</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Form -->
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="contact-form-card">
                    <h2 class="section-title">Send us a Message</h2>
                    <p class="text-muted mb-4">Have a question? Fill out the form below and we'll get back to you.</p>
                    
                    <?php if ($form_submitted): ?>
                    <div class="alert alert-success" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        Thank you for your message! We will respond to your inquiry as soon as possible.
                    </div>
                    <?php endif; ?>
                    
                    <?php if (!empty($form_error)): ?>
                    <div class="alert alert-danger" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        <?php echo sanitize($form_error); ?>
                    </div>
                    <?php endif; ?>
                    
                    <form method="POST" action="" class="contact-form">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Full Name *</label>
                                <input type="text" class="form-control" id="name" name="name" 
                                       value="<?php echo sanitize($_POST['name'] ?? ''); ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email Address *</label>
                                <input type="email" class="form-control" id="email" name="email" 
                                       value="<?php echo sanitize($_POST['email'] ?? ''); ?>" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject *</label>
                            <select class="form-select" id="subject" name="subject" required>
                                <option value="">Select a subject</option>
                                <option value="General Inquiry" <?php echo (($_POST['subject'] ?? '') === 'General Inquiry') ? 'selected' : ''; ?>>General Inquiry</option>
                                <option value="Admissions" <?php echo (($_POST['subject'] ?? '') === 'Admissions') ? 'selected' : ''; ?>>Admissions</option>
                                <option value="Academic" <?php echo (($_POST['subject'] ?? '') === 'Academic') ? 'selected' : ''; ?>>Academic Matters</option>
                                <option value="Student Affairs" <?php echo (($_POST['subject'] ?? '') === 'Student Affairs') ? 'selected' : ''; ?>>Student Affairs</option>
                                <option value="Technical Support" <?php echo (($_POST['subject'] ?? '') === 'Technical Support') ? 'selected' : ''; ?>>Technical Support</option>
                                <option value="Complaint" <?php echo (($_POST['subject'] ?? '') === 'Complaint') ? 'selected' : ''; ?>>Complaint</option>
                                <option value="Other" <?php echo (($_POST['subject'] ?? '') === 'Other') ? 'selected' : ''; ?>>Other</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message *</label>
                            <textarea class="form-control" id="message" name="message" rows="6" required><?php echo sanitize($_POST['message'] ?? ''); ?></textarea>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-paper-plane me-2"></i>Send Message
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
/* Contact Page Specific Styles */
.contact-info-card, .contact-directory-card, .map-card, .contact-form-card {
    background: #fff;
    border-radius: 12px;
    padding: 2rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.emergency-card {
    background: #fff5f5;
    border: 2px solid #dc3545;
    border-radius: 12px;
    padding: 2rem;
}

.contact-detail {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
}

.contact-detail i {
    font-size: 1.5rem;
    color: #0d6efd;
    margin-top: 0.25rem;
}

.contact-detail h4 {
    margin-bottom: 0.25rem;
    font-size: 1rem;
}

.contact-detail p {
    margin-bottom: 0;
    color: #6c757d;
}

.emergency-item {
    background: #fff;
    border-radius: 8px;
    padding: 1.5rem;
    text-align: center;
    height: 100%;
}

.contact-table th {
    background-color: #f8f9fa;
    border-top: none;
    font-weight: 600;
}

.contact-table td {
    vertical-align: middle;
}

.map-placeholder {
    background: #f8f9fa;
    border: 2px dashed #dee2e6;
    border-radius: 8px;
    padding: 4rem 2rem;
    text-align: center;
}

.map-placeholder i {
    font-size: 4rem;
    color: #dee2e6;
    margin-bottom: 1rem;
    display: block;
}

.map-placeholder p {
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.map-placeholder small {
    color: #6c757d;
}
</style>

<?php
require_once 'includes/footer.php';
?>
