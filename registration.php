<?php
/**
 * Registration Guide Page
 * Nigerian Army University, Biu - Orientation Portal
 */

// Page configuration
$page_title = 'Registration Guide';
$page_description = 'Complete your NAUB enrollment - Step-by-step registration process guide';

// Include required files
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/includes/functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo sanitize($page_description); ?>">
    <meta name="author" content="NAUB">
    
    <title><?php echo sanitize($page_title); ?> - <?php echo SITE_NAME; ?></title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo BASE_URL; ?>/favicon.ico">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/css/style.css">
    
    <style>
        .registration-hero {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 50%, #1e3c72 100%);
            color: white;
            padding: 100px 0;
            position: relative;
            overflow: hidden;
        }
        
        .registration-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="30" fill="none" stroke="rgba(255,255,255,0.08)" stroke-width="0.5"/></svg>');
            background-size: 150px 150px;
        }
        
        .registration-hero .display-4 {
            font-weight: 700;
            margin-bottom: 1rem;
        }
        
        .registration-hero .lead {
            font-size: 1.25rem;
            opacity: 0.9;
        }
        
        .section-padding {
            padding: 70px 0;
        }
        
        .section-title {
            position: relative;
            margin-bottom: 50px;
            padding-bottom: 15px;
            font-weight: 600;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 70px;
            height: 3px;
            background: linear-gradient(90deg, #1e3c72, #2a5298);
        }
        
        .section-title.text-start::after {
            left: 0;
            transform: none;
        }
        
        /* Step Cards */
        .step-card {
            background: white;
            border: none;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
            position: relative;
            overflow: hidden;
        }
        
        .step-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.12);
        }
        
        .step-number {
            position: absolute;
            top: 15px;
            right: 15px;
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 18px;
        }
        
        .step-icon {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            font-size: 28px;
        }
        
        .step-icon.blue { background: #e8f4f8; color: #1e3c72; }
        .step-icon.green { background: #e8f6f3; color: #27ae60; }
        .step-icon.orange { background: #fef5e7; color: #e67e22; }
        .step-icon.purple { background: #f5eef8; color: #8e44ad; }
        .step-icon.red { background: #fdedec; color: #e74c3c; }
        .step-icon.teal { background: #e8f4f4; color: #1abc9c; }
        .step-icon.yellow { background: #fef9e7; color: #f1c40f; }
        
        .step-card h5 {
            color: #333;
            margin-bottom: 12px;
            font-weight: 600;
        }
        
        .step-card p {
            color: #666;
            margin-bottom: 0;
            font-size: 0.95rem;
            line-height: 1.6;
        }
        
        /* Process List */
        .process-list {
            list-style: none;
            padding: 0;
            margin: 0;
            counter-reset: process;
        }
        
        .process-list li {
            position: relative;
            padding: 15px 20px;
            padding-left: 50px;
            background: #f8f9fa;
            border-radius: 8px;
            margin-bottom: 12px;
            counter-increment: process;
            transition: background 0.3s ease;
        }
        
        .process-list li:hover {
            background: #e8f4f8;
        }
        
        .process-list li::before {
            content: counter(process);
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            width: 25px;
            height: 25px;
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 600;
        }
        
        /* Warning/Tip Boxes */
        .callout-box {
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 20px;
            border-left: 4px solid;
        }
        
        .callout-box.info {
            background: #e8f4f8;
            border-color: #1e3c72;
        }
        
        .callout-box.warning {
            background: #fff3cd;
            border-color: #ffc107;
        }
        
        .callout-box.success {
            background: #d4edda;
            border-color: #28a745;
        }
        
        .callout-box.danger {
            background: #fdedec;
            border-color: #e74c3c;
        }
        
        .callout-box.tip {
            background: #fef9e7;
            border-color: #f1c40f;
        }
        
        .callout-box h5 {
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }
        
        .callout-box h5 i {
            margin-right: 10px;
        }
        
        .callout-box p {
            margin-bottom: 0;
            line-height: 1.6;
        }
        
        /* Document List */
        .document-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .document-list li {
            padding: 12px 15px;
            background: #f8f9fa;
            border-radius: 8px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            transition: background 0.3s ease;
        }
        
        .document-list li:hover {
            background: #e8f4f8;
        }
        
        .document-list li i {
            color: #27ae60;
            margin-right: 12px;
            font-size: 16px;
        }
        
        .document-list li i.text-danger {
            color: #e74c3c;
        }
        
        /* Table Styles */
        .fee-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        
        .fee-table th {
            background: #1e3c72;
            color: white;
            padding: 15px;
            text-align: left;
            font-weight: 600;
        }
        
        .fee-table td {
            padding: 15px;
            border-bottom: 1px solid #e9ecef;
        }
        
        .fee-table tr:hover {
            background: #f8f9fa;
        }
        
        .fee-table .total-row {
            background: #e8f4f8;
            font-weight: 600;
        }
        
        /* Support Cards */
        .support-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            display: flex;
            align-items: flex-start;
            transition: transform 0.3s ease;
            text-decoration: none;
        }
        
        .support-card:hover {
            transform: translateY(-3px);
            text-decoration: none;
        }
        
        .support-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            margin-right: 15px;
            flex-shrink: 0;
        }
        
        .support-details h6 {
            color: #333;
            margin-bottom: 5px;
            font-weight: 600;
        }
        
        .support-details p {
            color: #666;
            margin-bottom: 0;
            font-size: 0.9rem;
        }
        
        /* CTA Section */
        .cta-section {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            padding: 60px 0;
        }
        
        .cta-section h2 {
            font-weight: 700;
        }
        
        .btn-light-custom {
            background: white;
            color: #1e3c72;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }
        
        .btn-light-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.2);
            color: #1e3c72;
        }
        
        .btn-outline-custom {
            background: transparent;
            color: white;
            border: 2px solid white;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }
        
        .btn-outline-custom:hover {
            background: white;
            color: #1e3c72;
        }
        
        /* Timeline */
        .registration-timeline {
            position: relative;
            padding: 20px 0;
        }
        
        .registration-timeline::before {
            content: '';
            position: absolute;
            left: 20px;
            width: 3px;
            height: 100%;
            background: linear-gradient(to bottom, #1e3c72, #2a5298);
            top: 0;
        }
        
        .timeline-item {
            position: relative;
            padding-left: 60px;
            margin-bottom: 30px;
        }
        
        .timeline-dot {
            position: absolute;
            left: 5px;
            width: 35px;
            height: 35px;
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 14px;
            top: 0;
            box-shadow: 0 4px 10px rgba(30, 60, 114, 0.3);
        }
        
        .timeline-content {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }
        
        .timeline-content h5 {
            color: #1e3c72;
            margin-bottom: 10px;
            font-weight: 600;
        }
        
        .timeline-content p {
            color: #666;
            margin-bottom: 0;
            font-size: 0.95rem;
        }
        
        @media (max-width: 768px) {
            .registration-hero {
                padding: 60px 0;
            }
            
            .section-padding {
                padding: 50px 0;
            }
            
            .registration-timeline {
                padding-left: 30px;
            }
            
            .registration-timeline::before {
                left: 10px;
            }
            
            .timeline-dot {
                left: -5px;
            }
            
            .timeline-item {
                padding-left: 40px;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <?php include __DIR__ . '/includes/header.php'; ?>

    <!-- Hero Section -->
    <section class="registration-hero">
        <div class="container position-relative">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <div class="mb-4">
                        <i class="fas fa-clipboard-check fa-4x"></i>
                    </div>
                    <h1 class="display-4 fw-bold mb-3">Registration Process</h1>
                    <p class="lead mb-4">Complete Your Enrollment - Step-by-Step Guide</p>
                    <p class="opacity-75 mb-0">Follow this comprehensive guide to complete your registration at NAUB</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Quick Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-2 sticky-top">
        <div class="container">
            <div class="collapse navbar-collapse justify-content-center">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link" href="#portal-login">Portal Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#biodata">Biodata</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#documents">Documents</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#fees">Fees</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#matric">Matric Number</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#courses">Courses</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#accommodation">Accommodation</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        <!-- Portal Login Section -->
        <section id="portal-login" class="section-padding bg-light">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <h2 class="section-title text-center">Portal Login & First-Time Access</h2>
                        <p class="text-center text-muted mb-5">How to access and set up your student portal account</p>
                        
                        <div class="row g-4 mb-5">
                            <div class="col-md-6">
                                <div class="step-card">
                                    <span class="step-number">1</span>
                                    <div class="step-icon blue">
                                        <i class="fas fa-globe"></i>
                                    </div>
                                    <h5>Access the Portal</h5>
                                    <p>Visit <strong>my.naub.edu.ng</strong> using any modern web browser. The portal is accessible on desktop computers, tablets, and mobile phones.</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="step-card">
                                    <span class="step-number">2</span>
                                    <div class="step-icon green">
                                        <i class="fas fa-key"></i>
                                    </div>
                                    <h5>Default Credentials</h5>
                                    <p>Use your <strong>application number</strong> as username and <strong>your date of birth (DDMMYYYY)</strong> as the default password.</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card border-0 shadow-sm">
                            <div class="card-body p-4">
                                <h4 class="text-primary mb-4">
                                    <i class="fas fa-exchange-alt me-2"></i>Password Change Requirements
                                </h4>
                                <ul class="process-list">
                                    <li>Upon first login, you will be prompted to change your password</li>
                                    <li>New password must be at least 8 characters long</li>
                                    <li>Password must include uppercase and lowercase letters</li>
                                    <li>Password must include at least one number (0-9)</li>
                                    <li>Password must include at least one special character (!@#$%^&*)</li>
                                    <li>Remember to save your new password securely</li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="row mt-4">
                            <div class="col-lg-12">
                                <div class="callout-box warning">
                                    <h5><i class="fas fa-exclamation-triangle text-warning"></i>Troubleshooting Login Issues</h5>
                                    <div class="row mt-3">
                                        <div class="col-md-6">
                                            <p><strong>Wrong Password:</strong> Use the "Forgot Password" link to reset. You'll receive a reset link via your registered email.</p>
                                            <p><strong>Account Locked:</strong> After 5 failed attempts, wait 30 minutes or contact IT support.</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><strong>Browser Issues:</strong> Clear cache or try a different browser (Chrome recommended).</p>
                                            <p><strong>Still Can't Login:</strong> Visit the ICT Center in person or call +234 XXX XXXX for assistance.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Biodata Update Section -->
        <section id="biodata" class="section-padding">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <h2 class="section-title text-center">Biodata Update Procedure</h2>
                        <p class="text-center text-muted mb-5">Complete your personal information on the student portal</p>
                        
                        <div class="row g-4 mb-5">
                            <div class="col-md-6">
                                <div class="step-card">
                                    <span class="step-number">1</span>
                                    <div class="step-icon teal">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <h5>Personal Information</h5>
                                    <p>Update your full name, gender, date of birth, place of birth, nationality, and state of origin. Ensure all details match your official documents.</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="step-card">
                                    <span class="step-number">2</span>
                                    <div class="step-icon purple">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <h5>Contact Details</h5>
                                    <p>Provide your current phone number, permanent home address, and temporary address (if applicable). Add a valid email address for communications.</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="step-card">
                                    <span class="step-number">3</span>
                                    <div class="step-icon orange">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <h5>Next of Kin</h5>
                                    <p>Enter your next of kin's full name, relationship, phone number, and address. This is crucial for emergency contact purposes.</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="step-card">
                                    <span class="step-number">4</span>
                                    <div class="step-icon green">
                                        <i class="fas fa-save"></i>
                                    </div>
                                    <h5>Save & Submit</h5>
                                    <p>Review all information carefully before submitting. Once submitted, you may need to contact Student Affairs for corrections.</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="callout-box info">
                            <h5><i class="fas fa-info-circle text-primary"></i>Important Notes</h5>
                            <p>All biodata information must match your admission documents exactly. Any discrepancies may delay your registration or result in cancellation of admission. Contact the Admissions Office if you notice any errors in your JAMB/Admission records.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Document Upload Section -->
        <section id="documents" class="section-padding bg-light">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <h2 class="section-title text-center">Document Upload for Clearance</h2>
                        <p class="text-center text-muted mb-5">Upload required documents for verification and clearance</p>
                        
                        <div class="row g-4 mb-5">
                            <div class="col-lg-6">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-body p-4">
                                        <h4 class="text-primary mb-4">
                                            <i class="fas fa-list-check me-2"></i>Required Documents
                                        </h4>
                                        <ul class="document-list">
                                            <li><i class="fas fa-check-circle"></i>Passport Photograph (white background)</li>
                                            <li><i class="fas fa-check-circle"></i>O-Level Results (WAEC/NECO)</li>
                                            <li><i class="fas fa-check-circle"></i>Birth Certificate</li>
                                            <li><i class="fas fa-check-circle"></i>Admission Letter</li>
                                            <li><i class="fas fa-check-circle"></i>JAMB Result Slip</li>
                                            <li><i class="fas fa-check-circle"></i>Local Government ID</li>
                                            <li><i class="fas fa-check-circle"></i>Medical Certificate</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-body p-4">
                                        <h4 class="text-primary mb-4">
                                            <i class="fas fa-file-csv me-2"></i>File Requirements
                                        </h4>
                                        <div class="mb-3">
                                            <h6><i class="fas fa-file-image me-2 text-primary"></i>Accepted Formats</h6>
                                            <p class="text-muted mb-0">JPEG, PNG, or PDF files only</p>
                                        </div>
                                        <div class="mb-3">
                                            <h6><i class="fas fa-weight-hanging me-2 text-primary"></i>File Size Limits</h6>
                                            <p class="text-muted mb-0">Maximum 2MB per file (photos: 500KB recommended)</p>
                                        </div>
                                        <div>
                                            <h6><i class="fas fa-camera me-2 text-primary"></i>Photo Specifications</h6>
                                            <p class="text-muted mb-0">Recent passport photograph with white background, clear face, no glasses</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card border-0 shadow-sm">
                            <div class="card-body p-4">
                                <h4 class="text-primary mb-4">
                                    <i class="fas fa-upload me-2"></i>Upload Procedure
                                </h4>
                                <ul class="process-list">
                                    <li>Log into the student portal at <strong>my.naub.edu.ng</strong></li>
                                    <li>Navigate to "Document Upload" or "Clearance" section</li>
                                    <li>Select the document type from the dropdown menu</li>
                                    <li>Click "Choose File" and select the appropriate file from your device</li>
                                    <li>Preview the uploaded document to ensure clarity</li>
                                    <li>Click "Upload" to submit each document</li>
                                    <li>Repeat for all required documents</li>
                                    <li>After uploading all documents, click "Submit for Clearance"</li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="callout-box danger mt-4">
                            <h5><i class="fas fa-exclamation-circle text-danger"></i>Important Warnings</h5>
                            <p>All documents must be authentic and clearly readable. Uploaded documents will be verified by the Student Affairs Office. Any falsified or unclear documents may result in immediate expulsion. Ensure your passport photograph meets the specifications - blurry or inappropriate photos will be rejected.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Fee Payment Section -->
        <section id="fees" class="section-padding">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <h2 class="section-title text-center">Fee Payment Process</h2>
                        <p class="text-center text-muted mb-5">Understand and complete your fee payments</p>
                        
                        <div class="row g-4 mb-5">
                            <div class="col-md-6">
                                <div class="step-card">
                                    <div class="step-icon green">
                                        <i class="fas fa-university"></i>
                                    </div>
                                    <h5>Bank Draft</h5>
                                    <p>Obtain a bank draft from any commercial bank in Nigeria. The draft should be made payable to "Nigerian Army University, Biu". Visit the bank with your application number.</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="step-card">
                                    <div class="step-icon blue">
                                        <i class="fas fa-credit-card"></i>
                                    </div>
                                    <h5>Online Payment</h5>
                                    <p>Pay directly through the student portal using your debit card. The portal supports Visa, MasterCard, and Verve cards. This is the fastest and recommended method.</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card border-0 shadow-sm mb-5">
                            <div class="card-body p-4">
                                <h4 class="text-primary mb-4">
                                    <i class="fas fa-list-dollar me-2"></i>Fee Breakdown
                                </h4>
                                <div class="table-responsive">
                                    <table class="fee-table">
                                        <thead>
                                            <tr>
                                                <th>Fee Component</th>
                                                <th>Description</th>
                                                <th>Amount (₦)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Tuition Fee</td>
                                                <td>Academic charges per session</td>
                                                <td>Check Portal</td>
                                            </tr>
                                            <tr>
                                                <td>Registration Fee</td>
                                                <td>One-time registration charge</td>
                                                <td>Check Portal</td>
                                            </tr>
                                            <tr>
                                                <td>Accommodation</td>
                                                <td>Hostel fees (if applicable)</td>
                                                <td>Check Portal</td>
                                            </tr>
                                            <tr>
                                                <td>Medical Fee</td>
                                                <td>Health services levy</td>
                                                <td>Check Portal</td>
                                            </tr>
                                            <tr>
                                                <td>Sports Fee</td>
                                                <td>Sports and recreational facilities</td>
                                                <td>Check Portal</td>
                                            </tr>
                                            <tr>
                                                <td>Library Fee</td>
                                                <td>Library services and resources</td>
                                                <td>Check Portal</td>
                                            </tr>
                                            <tr>
                                                <td>ICT Fee</td>
                                                <td>Internet and computer services</td>
                                                <td>Check Portal</td>
                                            </tr>
                                            <tr class="total-row">
                                                <td colspan="2"><strong>Total</strong></td>
                                                <td><strong>Check Portal</strong></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <p class="text-muted small mb-0"><em>* Exact fees vary by program. Check your student portal for the specific amount.</em></p>
                            </div>
                        </div>
                        
                        <div class="callout-box warning">
                            <h5><i class="fas fa-clock text-warning"></i>Payment Deadline Reminder</h5>
                            <p>All fees must be paid before the resumption date. Late payments may attract additional penalties. Check the academic calendar on the portal for specific deadlines. Failure to pay fees on time may result in loss of admission or inability to register for courses.</p>
                        </div>
                        
                        <div class="callout-box success mt-4">
                            <h5><i class="fas fa-receipt text-success"></i>Getting Your Payment Receipt</h5>
                            <p>After successful payment, a receipt will be automatically generated and sent to your registered email. You can also download a copy from the "Payment History" section on the student portal. Keep this receipt safe as you will need it for clearance and course registration.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Matric Number Section -->
        <section id="matric" class="section-padding bg-light">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <h2 class="section-title text-center">Matric Number Generation</h2>
                        <p class="text-center text-muted mb-5">Understanding and obtaining your matriculation number</p>
                        
                        <div class="registration-timeline mb-5">
                            <div class="timeline-item">
                                <div class="timeline-dot">
                                    <i class="fas fa-check"></i>
                                </div>
                                <div class="timeline-content">
                                    <h5>When Matric Number is Generated</h5>
                                    <p>Your matriculation number will be generated automatically after you have: completed biodata update, uploaded all required documents, paid all fees, and completed course registration. This usually happens within 2-3 weeks after completing all registration steps.</p>
                                </div>
                            </div>
                            
                            <div class="timeline-item">
                                <div class="timeline-dot">
                                    <i class="fas fa-eye"></i>
                                </div>
                                <div class="timeline-content">
                                    <h5>How to View/Print Matric Number</h5>
                                    <p>Log into the student portal → Go to "Profile" or "Student Information" → Click on "View Matric Number" → You can print or save as PDF. The matric number is also displayed on your student ID card.</p>
                                </div>
                            </div>
                            
                            <div class="timeline-item">
                                <div class="timeline-dot">
                                    <i class="fas fa-hashtag"></i>
                                </div>
                                <div class="timeline-content">
                                    <h5>Matric Number Format</h5>
                                    <p>The NAUB matriculation number follows this format: <strong>NAUB/20XX/XXXXX</strong> where XX is the year of admission and XXXXX is a unique serial number. This number is permanent and will be used throughout your academic career at NAUB.</p>
                                </div>
                            </div>
                            
                            <div class="timeline-item">
                                <div class="timeline-dot">
                                    <i class="fas fa-id-card"></i>
                                </div>
                                <div class="timeline-content">
                                    <h5>Student ID Card Issuance</h5>
                                    <p>After matric number generation, visit the ID Card Office to have your photo taken for the student ID card. The ID card is usually ready within 3-5 business days. You'll receive an email notification when it's ready for pickup.</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="callout-box info">
                            <h5><i class="fas fa-info-circle text-primary"></i>Using Your Matric Number</h5>
                            <p>Your matriculation number is your primary identification at NAUB. Use it for: course registration, exam registration, library access, accessing the student portal, hostel allocation, and all official university communications. Memorize it or keep it safely recorded.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Course Registration Section -->
        <section id="courses" class="section-padding">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <h2 class="section-title text-center">Course Registration Steps</h2>
                        <p class="text-center text-muted mb-5">Register for your courses each semester</p>
                        
                        <div class="row g-4 mb-5">
                            <div class="col-md-6 col-lg-4">
                                <div class="step-card">
                                    <span class="step-number">1</span>
                                    <div class="step-icon blue">
                                        <i class="fas fa-sign-in-alt"></i>
                                    </div>
                                    <h5>Log Into Portal</h5>
                                    <p>Access <strong>my.naub.edu.ng</strong> using your matric number and password.</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="step-card">
                                    <span class="step-number">2</span>
                                    <div class="step-icon green">
                                        <i class="fas fa-calendar"></i>
                                    </div>
                                    <h5>Select Semester</h5>
                                    <p>Choose the current semester (First or Second) from the dropdown menu.</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="step-card">
                                    <span class="step-number">3</span>
                                    <div class="step-icon purple">
                                        <i class="fas fa-book-open"></i>
                                    </div>
                                    <h5>Choose Courses</h5>
                                    <p>Select your core courses and any approved elective courses for your program.</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="step-card">
                                    <span class="step-number">4</span>
                                    <div class="step-icon orange">
                                        <i class="fas fa-check-double"></i>
                                    </div>
                                    <h5>Verify Course Load</h5>
                                    <p>Review your selected courses and ensure they meet the minimum/maximum credit load.</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="step-card">
                                    <span class="step-number">5</span>
                                    <div class="step-icon teal">
                                        <i class="fas fa-paper-plane"></i>
                                    </div>
                                    <h5>Submit Registration</h5>
                                    <p>Click "Submit Registration" to finalize your course selection.</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="step-card">
                                    <span class="step-number">6</span>
                                    <div class="step-icon yellow">
                                        <i class="fas fa-print"></i>
                                    </div>
                                    <h5>Print Course Form</h5>
                                    <p>Download and print your course registration form for your records.</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card border-0 shadow-sm">
                            <div class="card-body p-4">
                                <h4 class="text-primary mb-4">
                                    <i class="fas fa-exclamation-circle me-2"></i>Important Course Registration Notes
                                </h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <ul class="document-list">
                                            <li><i class="fas fa-check-circle"></i>Register for courses within the stipulated registration period</li>
                                            <li><i class="fas fa-check-circle"></i>Consult your academic advisor before finalizing course selection</li>
                                            <li><i class="fas fa-check-circle"></i>Ensure all core courses for your level are selected</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <ul class="document-list">
                                            <li><i class="fas fa-check-circle"></i>Check for timetable conflicts before submitting</li>
                                            <li><i class="fas fa-check-circle"></i>Minimum credit load: 15 credits per semester</li>
                                            <li><i class="fas fa-check-circle"></i>Maximum credit load: 24 credits per semester</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="callout-box danger mt-4">
                            <h5><i class="fas fa-times-circle text-danger"></i>What Happens If You Don't Register</h5>
                            <p>Course registration is mandatory for all students. Failure to register for courses means you will not be recognized as a student for that semester. You will not be allowed to write exams, access library services, or receive hostel accommodation. Unregistered students may be forced to withdraw from the university.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Accommodation Section -->
        <section id="accommodation" class="section-padding bg-light">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <h2 class="section-title text-center">Accommodation Booking Process</h2>
                        <p class="text-center text-muted mb-5">Secure your on-campus housing</p>
                        
                        <div class="row g-4 mb-5">
                            <div class="col-md-6">
                                <div class="step-card">
                                    <span class="step-number">1</span>
                                    <div class="step-icon blue">
                                        <i class="fas fa-home"></i>
                                    </div>
                                    <h5>Hostel Application</h5>
                                    <p>Log into the student portal and navigate to "Hostel Application" or "Accommodation" section. Fill out the application form with your preferences.</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="step-card">
                                    <span class="step-number">2</span>
                                    <div class="step-icon green">
                                        <i class="fas fa-bed"></i>
                                    </div>
                                    <h5>Room Selection</h5>
                                    <p>Choose from available hostels and room types. Options typically include single, double, or triple occupancy rooms. Select your preferred building and floor.</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="step-card">
                                    <span class="step-number">3</span>
                                    <div class="step-icon purple">
                                        <i class="fas fa-user-friends"></i>
                                    </div>
                                    <h5>Bed Allocation</h5>
                                    <p>The system will allocate a bed space based on availability. You can view your room and bed assignment on the portal after successful allocation.</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="step-card">
                                    <span class="step-number">4</span>
                                    <div class="step-icon orange">
                                        <i class="fas fa-credit-card"></i>
                                    </div>
                                    <h5>Payment</h5>
                                    <p>Pay accommodation fees through the portal. Payment can be made via bank draft or online payment. Your room is not confirmed until payment is received.</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card border-0 shadow-sm mb-5">
                            <div class="card-body p-4">
                                <h4 class="text-primary mb-4">
                                    <i class="fas fa-door-open me-2"></i>Check-In Procedure
                                </h4>
                                <ul class="process-list">
                                    <li>Receive hostel allocation confirmation via email/portal</li>
                                    <li>Proceed to the allocated hostel with your student ID and payment receipt</li>
                                    <li>Report to the Hostel Warden/Manager</li>
                                    <li>Complete the check-in form and sign the room inventory</li>
                                    <li>Receive your room keys and understand hostel rules</li>
                                    <li>Inspect the room and report any damages immediately</li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="callout-box tip">
                            <h5><i class="fas fa-lightbulb text-warning"></i>Tips for Better Accommodation</h5>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <p>Apply for accommodation early as spaces are limited. First-come, first-served basis applies. Consider applying with friends if you prefer specific roommates.</p>
                                </div>
                                <div class="col-md-6">
                                    <p>Off-campus accommodation is available for those who prefer it. Research nearby areas and ensure you have reliable transportation to campus.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Support Services Section -->
        <section class="section-padding">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <h2 class="section-title text-center">Need Help?</h2>
                        <p class="text-center text-muted mb-5">Contact our support services for registration assistance</p>
                        
                        <div class="row g-4">
                            <div class="col-md-6 col-lg-3">
                                <a href="mailto:student.affairs@naub.edu.ng" class="support-card">
                                    <div class="support-icon" style="background: #e8f4f8; color: #1e3c72;">
                                        <i class="fas fa-user-tie"></i>
                                    </div>
                                    <div class="support-details">
                                        <h6>Student Affairs</h6>
                                        <p>student.affairs@naub.edu.ng</p>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <a href="mailto:ictsupport@naub.edu.ng" class="support-card">
                                    <div class="support-icon" style="background: #e8f6f3; color: #27ae60;">
                                        <i class="fas fa-laptop-code"></i>
                                    </div>
                                    <div class="support-details">
                                        <h6>ICT Support</h6>
                                        <p>ictsupport@naub.edu.ng</p>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <a href="mailto:bursary@naub.edu.ng" class="support-card">
                                    <div class="support-icon" style="background: #fef5e7; color: #e67e22;">
                                        <i class="fas fa-money-bill-wave"></i>
                                    </div>
                                    <div class="support-details">
                                        <h6>Bursary</h6>
                                        <p>bursary@naub.edu.ng</p>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <a href="<?php echo BASE_URL; ?>/contact.php" class="support-card">
                                    <div class="support-icon" style="background: #f5eef8; color: #8e44ad;">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div class="support-details">
                                        <h6>General Inquiry</h6>
                                        <p>Contact Page</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                        
                        <div class="text-center mt-5">
                            <p class="text-muted mb-3">Visit the student portal for more information</p>
                            <a href="https://my.naub.edu.ng" target="_blank" class="btn btn-primary btn-lg">
                                <i class="fas fa-external-link-alt me-2"></i>Go to Student Portal
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="cta-section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h2 class="mb-3">Complete Your Registration Today!</h2>
                        <p class="mb-4 opacity-75">Follow this guide to ensure a smooth enrollment process at NAUB</p>
                        <div class="d-flex gap-3 justify-content-center flex-wrap">
                            <a href="<?php echo BASE_URL; ?>/checklist.php" class="btn btn-light-custom">
                                <i class="fas fa-check-square me-2"></i>Student Checklist
                            </a>
                            <a href="<?php echo BASE_URL; ?>/faqs.php" class="btn btn-outline-custom">
                                <i class="fas fa-question-circle me-2"></i>FAQs
                            </a>
                            <a href="<?php echo BASE_URL; ?>/fresh-student-guide.php" class="btn btn-outline-custom">
                                <i class="fas fa-graduation-cap me-2"></i>Fresh Student Guide
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <?php include __DIR__ . '/includes/footer.php'; ?>
    
    <!-- Smooth Scroll Script -->
    <script>
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
        
        // Add active class to nav links on scroll
        const sections = document.querySelectorAll('section[id]');
        const navLinks = document.querySelectorAll('.navbar-nav .nav-link');
        
        window.addEventListener('scroll', () => {
            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;
                if (scrollY >= sectionTop - 200) {
                    current = section.getAttribute('id');
                }
            });
            
            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === '#' + current) {
                    link.classList.add('active');
                }
            });
        });
    </script>
</body>
</html>
