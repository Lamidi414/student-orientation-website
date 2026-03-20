<?php
/**
 * Fresh Student Guide Page
 * Nigerian Army University, Biu - Orientation Portal
 */

// Page configuration
$page_title = 'Fresh Student Guide';
$page_description = 'Your complete guide to starting at NAUB - from admission to academic success';

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
        .guide-hero {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 50%, #1e3c72 100%);
            color: white;
            padding: 100px 0;
            position: relative;
            overflow: hidden;
        }
        
        .guide-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="30" fill="none" stroke="rgba(255,255,255,0.08)" stroke-width="0.5"/></svg>');
            background-size: 150px 150px;
        }
        
        .guide-hero .display-4 {
            font-weight: 700;
            margin-bottom: 1rem;
        }
        
        .guide-hero .lead {
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
        
        /* Timeline Styles */
        .timeline {
            position: relative;
            padding: 20px 0;
        }
        
        .timeline::before {
            content: '';
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            width: 3px;
            height: 100%;
            background: linear-gradient(to bottom, #1e3c72, #2a5298);
            top: 0;
        }
        
        @media (max-width: 768px) {
            .timeline::before {
                left: 20px;
            }
        }
        
        .timeline-item {
            position: relative;
            margin-bottom: 40px;
            width: 50%;
        }
        
        .timeline-item:nth-child(odd) {
            padding-right: 50px;
            text-align: right;
        }
        
        .timeline-item:nth-child(even) {
            padding-left: 50px;
            margin-left: 50%;
        }
        
        @media (max-width: 768px) {
            .timeline-item {
                width: 100%;
                padding-left: 50px !important;
                padding-right: 0 !important;
                text-align: left !important;
                margin-left: 0 !important;
            }
        }
        
        .timeline-dot {
            position: absolute;
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 16px;
            top: 0;
            box-shadow: 0 4px 10px rgba(30, 60, 114, 0.3);
        }
        
        .timeline-item:nth-child(odd) .timeline-dot {
            right: -20px;
        }
        
        .timeline-item:nth-child(even) .timeline-dot {
            left: -20px;
        }
        
        @media (max-width: 768px) {
            .timeline-dot {
                left: 0 !important;
                right: auto !important;
            }
        }
        
        .timeline-content {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .timeline-content:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.12);
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
        
        /* Info Cards */
        .info-card {
            background: white;
            border: none;
            border-radius: 12px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
        }
        
        .info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.12);
        }
        
        .info-card-icon {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 28px;
        }
        
        .info-card-icon.blue { background: #e8f4f8; color: #1e3c72; }
        .info-card-icon.green { background: #e8f6f3; color: #27ae60; }
        .info-card-icon.orange { background: #fef5e7; color: #e67e22; }
        .info-card-icon.purple { background: #f5eef8; color: #8e44ad; }
        .info-card-icon.red { background: #fdedec; color: #e74c3c; }
        .info-card-icon.teal { background: #e8f4f4; color: #1abc9c; }
        
        .info-card h5 {
            color: #333;
            margin-bottom: 10px;
            font-weight: 600;
        }
        
        .info-card p {
            color: #666;
            margin-bottom: 0;
            font-size: 0.9rem;
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
        
        /* Tips Section */
        .tip-card {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 12px;
            padding: 25px;
            height: 100%;
            border-left: 4px solid #1e3c72;
        }
        
        .tip-card h5 {
            color: #1e3c72;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
        }
        
        .tip-card h5 i {
            margin-right: 10px;
        }
        
        .tip-card p {
            color: #666;
            margin-bottom: 0;
            font-size: 0.95rem;
            line-height: 1.6;
        }
        
        /* Contact Cards */
        .contact-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            display: flex;
            align-items: flex-start;
            transition: transform 0.3s ease;
        }
        
        .contact-card:hover {
            transform: translateY(-3px);
        }
        
        .contact-icon {
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
        
        .contact-details h6 {
            color: #333;
            margin-bottom: 5px;
            font-weight: 600;
        }
        
        .contact-details p {
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
        }
        
        .btn-outline-custom:hover {
            background: white;
            color: #1e3c72;
        }
        
        /* Steps List */
        .steps-list {
            list-style: none;
            padding: 0;
            margin: 0;
            counter-reset: step;
        }
        
        .steps-list li {
            position: relative;
            padding: 15px 20px;
            padding-left: 50px;
            background: #f8f9fa;
            border-radius: 8px;
            margin-bottom: 12px;
            counter-increment: step;
        }
        
        .steps-list li::before {
            content: counter(step);
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
        
        /* Checklist items */
        .checklist-item {
            display: flex;
            align-items: flex-start;
            padding: 15px;
            background: white;
            border-radius: 8px;
            margin-bottom: 15px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            transition: transform 0.2s ease;
        }
        
        .checklist-item:hover {
            transform: translateX(5px);
        }
        
        .checklist-icon {
            width: 35px;
            height: 35px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            flex-shrink: 0;
            font-size: 16px;
        }
        
        .checklist-content h6 {
            color: #333;
            margin-bottom: 4px;
            font-weight: 600;
        }
        
        .checklist-content p {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 0;
        }
        
        @media (max-width: 768px) {
            .guide-hero {
                padding: 60px 0;
            }
            
            .section-padding {
                padding: 50px 0;
            }
            
            .timeline {
                padding-left: 40px;
            }
            
            .timeline::before {
                left: 20px;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <?php include __DIR__ . '/includes/header.php'; ?>

    <!-- Hero Section -->
    <section class="guide-hero">
        <div class="container position-relative">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <div class="mb-4">
                        <i class="fas fa-graduation-cap fa-4x"></i>
                    </div>
                    <h1 class="display-4 fw-bold mb-3">Fresh Student Guide</h1>
                    <p class="lead mb-4">Your Journey Starts Here - Everything you need to know about starting at NAUB</p>
                    <p class="opacity-75 mb-0">Welcome to Nigerian Army University, Biu - We're here to help you succeed!</p>
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
                        <a class="nav-link" href="#pre-resumption">Pre-Resumption</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#first-week">First Week</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contacts">Contacts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tips">Tips</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        <!-- Pre-Resumption Checklist Section -->
        <section id="pre-resumption" class="section-padding bg-light">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <h2 class="section-title text-center">Pre-Resumption Checklist</h2>
                        <p class="text-center text-muted mb-5">Complete these steps before resuming at NAUB</p>
                        
                        <!-- Admission Status Check -->
                        <div class="row mb-5">
                            <div class="col-lg-12">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body p-4">
                                        <h4 class="text-primary mb-4">
                                            <i class="fas fa-check-circle me-2"></i>Admission Status Check
                                        </h4>
                                        <div class="steps-list">
                                            <li>Visit the official NAUB admission portal at <strong>my.naub.edu.ng</strong></li>
                                            <li>Log in with your application number and password</li>
                                            <li>Navigate to the "Admission Status" or "Check Admission" section</li>
                                            <li>Verify that your admission status shows "Admitted" or "Pending"</li>
                                            <li>Print or save your admission letter for reference</li>
                                        </div>
                                        <div class="alert alert-info border-0 mt-3" style="background: #e8f4f8;">
                                            <i class="fas fa-info-circle me-2"></i>
                                            <strong>Important:</strong> If your admission status shows issues, contact the Admissions Office immediately.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Document Preparation -->
                        <div class="row mb-5">
                            <div class="col-lg-12">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body p-4">
                                        <h4 class="text-primary mb-4">
                                            <i class="fas fa-folder-open me-2"></i>Document Preparation
                                        </h4>
                                        <p class="text-muted mb-4">Ensure you have the following original documents and photocopies:</p>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <ul class="document-list">
                                                    <li><i class="fas fa-check-circle"></i>O-Level Results (WAEC/NECO)</li>
                                                    <li><i class="fas fa-check-circle"></i>Birth Certificate</li>
                                                    <li><i class="fas fa-check-circle"></i>Medical Certificate</li>
                                                </ul>
                                            </div>
                                            <div class="col-md-6">
                                                <ul class="document-list">
                                                    <li><i class="fas fa-check-circle"></i>Passport Photographs (6 copies)</li>
                                                    <li><i class="fas fa-check-circle"></i>Admission Letter</li>
                                                    <li><i class="fas fa-check-circle"></i>National ID Card</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="alert alert-warning border-0 mt-3" style="background: #fff3cd;">
                                            <i class="fas fa-exclamation-triangle me-2"></i>
                                            <strong>Note:</strong> All documents must be authentic. Any falsified documents will lead to immediate expulsion.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Fee Understanding -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body p-4">
                                        <h4 class="text-primary mb-4">
                                            <i class="fas fa-naira-sign me-2"></i>Understanding Your Fees
                                        </h4>
                                        <div class="row g-4">
                                            <div class="col-md-4">
                                                <div class="info-card">
                                                    <div class="info-card-icon blue">
                                                        <i class="fas fa-book"></i>
                                                    </div>
                                                    <h5>Tuition Fees</h5>
                                                    <p>Academic fees vary by program. Check the student portal for your specific amount.</p>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="info-card">
                                                    <div class="info-card-icon green">
                                                        <i class="fas fa-bed"></i>
                                                    </div>
                                                    <h5>Accommodation</h5>
                                                    <p>Hostel fees are separate. On-campus accommodation is optional but recommended.</p>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="info-card">
                                                    <div class="info-card-icon orange">
                                                        <i class="fas fa-file-invoice-dollar"></i>
                                                    </div>
                                                    <h5>Other Charges</h5>
                                                    <p>Includes registration, medical, sports, and facility fees.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="alert alert-success border-0 mt-4" style="background: #d4edda;">
                                            <h5 class="alert-heading"><i class="fas fa-clock me-2"></i>Payment Deadlines</h5>
                                            <p class="mb-0">All fees must be paid before the resumption date. Late payment may attract penalties or loss of admission. Check the academic calendar for specific deadlines.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- First Week Essentials Section -->
        <section id="first-week" class="section-padding">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <h2 class="section-title text-center">First Week Essentials</h2>
                        <p class="text-center text-muted mb-5">Navigate your first week at NAUB with confidence</p>
                        
                        <!-- Timeline -->
                        <div class="timeline">
                            <!-- Step 1 -->
                            <div class="timeline-item">
                                <div class="timeline-dot">
                                    <i class="fas fa-user-check"></i>
                                </div>
                                <div class="timeline-content">
                                    <h5>Day 1: Clearance Process</h5>
                                    <p>Visit the Student Affairs Office for verification of your documents and completion of clearance procedures. Bring all original documents and photocopies.</p>
                                </div>
                            </div>
                            
                            <!-- Step 2 -->
                            <div class="timeline-item">
                                <div class="timeline-dot">
                                    <i class="fas fa-building"></i>
                                </div>
                                <div class="timeline-content">
                                    <h5>Day 1-2: Student Affairs Visit</h5>
                                    <p>Complete registration at Student Affairs. Location: Main Administrative Block. Hours: 8:00 AM - 4:00 PM weekdays. Bring your admission letter and ID.</p>
                                </div>
                            </div>
                            
                            <!-- Step 3 -->
                            <div class="timeline-item">
                                <div class="timeline-dot">
                                    <i class="fas fa-home"></i>
                                </div>
                                <div class="timeline-content">
                                    <h5>Day 2: Accommodation Confirmation</h5>
                                    <p>Check your hostel assignment through the student portal or visit the Housing Office. Collect your room keys and inventory list from the hostel warden.</p>
                                </div>
                            </div>
                            
                            <!-- Step 4 -->
                            <div class="timeline-item">
                                <div class="timeline-dot">
                                    <i class="fas fa-door-open"></i>
                                </div>
                                <div class="timeline-content">
                                    <h5>Day 3: Faculty/Department Location</h5>
                                    <p>Locate your faculty and department offices. Meet your Faculty Advisor and collect your department orientation schedule.</p>
                                </div>
                            </div>
                            
                            <!-- Step 5 -->
                            <div class="timeline-item">
                                <div class="timeline-dot">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                                <div class="timeline-content">
                                    <h5>Day 3-4: Lecture Venue Identification</h5>
                                    <p>Obtain your class timetable from the department. Locate all your lecture rooms using the campus map. Familiarize yourself with the building locations.</p>
                                </div>
                            </div>
                            
                            <!-- Step 6 -->
                            <div class="timeline-item">
                                <div class="timeline-dot">
                                    <i class="fas fa-book-reader"></i>
                                </div>
                                <div class="timeline-content">
                                    <h5>Day 5: Attend Orientation</h5>
                                    <p>Attend the official fresh student orientation. Collect your student ID card, library card, and learn about university resources and support services.</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Essential Items Checklist -->
                        <div class="row mt-5">
                            <div class="col-lg-12">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body p-4">
                                        <h4 class="text-primary mb-4">
                                            <i class="fas fa-clipboard-list me-2"></i>First Week Must-Do List
                                        </h4>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="checklist-item">
                                                    <div class="checklist-icon" style="background: #d4edda; color: #28a745;">
                                                        <i class="fas fa-check"></i>
                                                    </div>
                                                    <div class="checklist-content">
                                                        <h6>Activate Student Email</h6>
                                                        <p>Set up your official NAUB email for communications</p>
                                                    </div>
                                                </div>
                                                <div class="checklist-item">
                                                    <div class="checklist-icon" style="background: #d4edda; color: #28a745;">
                                                        <i class="fas fa-check"></i>
                                                    </div>
                                                    <div class="checklist-content">
                                                        <h6>Register for Courses</h6>
                                                        <p>Complete course registration on the student portal</p>
                                                    </div>
                                                </div>
                                                <div class="checklist-item">
                                                    <div class="checklist-icon" style="background: #d4edda; color: #28a745;">
                                                        <i class="fas fa-check"></i>
                                                    </div>
                                                    <div class="checklist-content">
                                                        <h6>Get Student ID Card</h6>
                                                        <p>Visit the ID Card Office for your photo ID</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="checklist-item">
                                                    <div class="checklist-icon" style="background: #d4edda; color: #28a745;">
                                                        <i class="fas fa-check"></i>
                                                    </div>
                                                    <div class="checklist-content">
                                                        <h6>Visit Library</h6>
                                                        <p>Get your library card and learn about resources</p>
                                                    </div>
                                                </div>
                                                <div class="checklist-item">
                                                    <div class="checklist-icon" style="background: #d4edda; color: #28a745;">
                                                        <i class="fas fa-check"></i>
                                                    </div>
                                                    <div class="checklist-content">
                                                        <h6>Meet Your Advisor</h6>
                                                        <p>Schedule meeting with faculty advisor</p>
                                                    </div>
                                                </div>
                                                <div class="checklist-item">
                                                    <div class="checklist-icon" style="background: #d4edda; color: #28a745;">
                                                        <i class="fas fa-check"></i>
                                                    </div>
                                                    <div class="checklist-content">
                                                        <h6>Join Student Groups</h6>
                                                        <p>Explore clubs and organizations</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Important Contacts Section -->
        <section id="contacts" class="section-padding bg-light">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <h2 class="section-title text-center">Important Contacts Quick Reference</h2>
                        <p class="text-center text-muted mb-5">Save these contacts for quick access during your time at NAUB</p>
                        
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="contact-card">
                                    <div class="contact-icon" style="background: #e8f4f8; color: #1e3c72;">
                                        <i class="fas fa-user-tie"></i>
                                    </div>
                                    <div class="contact-details">
                                        <h6>Student Affairs Office</h6>
                                        <p><i class="fas fa-phone me-2"></i>+234 XXX XXXX</p>
                                        <p><i class="fas fa-envelope me-2"></i>student.affairs@naub.edu.ng</p>
                                        <p><i class="fas fa-map-marker-alt me-2"></i>Main Admin Block, Room 101</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="contact-card">
                                    <div class="contact-icon" style="background: #e8f6f3; color: #27ae60;">
                                        <i class="fas fa-school"></i>
                                    </div>
                                    <div class="contact-details">
                                        <h6>Faculty Offices</h6>
                                        <p>Visit your respective faculty building</p>
                                        <p><i class="fas fa-clock me-2"></i>8:00 AM - 4:00 PM</p>
                                        <p><i class="fas fa-info-circle me-2"></i>Check portal for specific contacts</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="contact-card">
                                    <div class="contact-icon" style="background: #fdedec; color: #e74c3c;">
                                        <i class="fas fa-shield-alt"></i>
                                    </div>
                                    <div class="contact-details">
                                        <h6>Security Office</h6>
                                        <p><i class="fas fa-phone me-2"></i>+234 XXX XXXX (24/7)</p>
                                        <p><i class="fas fa-map-marker-alt me-2"></i>Main Gate Complex</p>
                                        <p><i class="fas fa-exclamation-triangle me-2"></i>Emergency: Dial 112</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="contact-card">
                                    <div class="contact-icon" style="background: #fef5e7; color: #e67e22;">
                                        <i class="fas fa-hospital"></i>
                                    </div>
                                    <div class="contact-details">
                                        <h6>Medical Center</h6>
                                        <p><i class="fas fa-phone me-2"></i>+234 XXX XXXX</p>
                                        <p><i class="fas fa-map-marker-alt me-2"></i>Near Hostel Area</p>
                                        <p><i class="fas fa-clock me-2"></i>24/7 Emergency Services</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Additional Contacts -->
                        <div class="row mt-4">
                            <div class="col-lg-12">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body p-4">
                                        <h5 class="text-primary mb-3">
                                            <i class="fas fa-plus-circle me-2"></i>Additional Important Contacts
                                        </h5>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <p class="mb-2"><strong>Registrar's Office:</strong> +234 XXX XXXX</p>
                                                <p class="mb-2"><strong>Bursary:</strong> +234 XXX XXXX</p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-2"><strong>Library:</strong> +234 XXX XXXX</p>
                                                <p class="mb-2"><strong>ICT Support:</strong> +234 XXX XXXX</p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-2"><strong>Sports Center:</strong> +234 XXX XXXX</p>
                                                <p class="mb-2"><strong>Chaplaincy:</strong> +234 XXX XXXX</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Tips for Success Section -->
        <section id="tips" class="section-padding">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <h2 class="section-title text-center">Tips for Success</h2>
                        <p class="text-center text-muted mb-5">Make the most of your NAUB experience</p>
                        
                        <div class="row g-4">
                            <!-- Time Management -->
                            <div class="col-md-6 col-lg-3">
                                <div class="tip-card">
                                    <h5><i class="fas fa-clock"></i>Time Management</h5>
                                    <p>Create a weekly schedule balancing classes, study time, and activities. Use a planner or digital calendar. Prioritize tasks and avoid procrastination.</p>
                                </div>
                            </div>
                            
                            <!-- University Resources -->
                            <div class="col-md-6 col-lg-3">
                                <div class="tip-card">
                                    <h5><i class="fas fa-book-open"></i>Resource Utilization</h5>
                                    <p>Make use of the library, online databases, tutoring centers, and academic advisors. Attend workshops and seminars. Explore all available support services.</p>
                                </div>
                            </div>
                            
                            <!-- Social Integration -->
                            <div class="col-md-6 col-lg-3">
                                <div class="tip-card">
                                    <h5><i class="fas fa-users"></i>Social Integration</h5>
                                    <p>Join student organizations and clubs. Attend campus events and activities. Build relationships with classmates and seniors. Find your community on campus.</p>
                                </div>
                            </div>
                            
                            <!-- Academic Support -->
                            <div class="col-md-6 col-lg-3">
                                <div class="tip-card">
                                    <h5><i class="fas fa-hands-helping"></i>Academic Support</h5>
                                    <p>Don't hesitate to ask questions in class. Form study groups with peers. Visit lecturers during office hours. Seek help early when struggling.</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Additional Tips -->
                        <div class="row mt-5">
                            <div class="col-lg-12">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body p-4">
                                        <h4 class="text-primary mb-4">
                                            <i class="fas fa-lightbulb me-2"></i>Pro Tips for Fresh Students
                                        </h4>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <ul class="document-list">
                                                    <li><i class="fas fa-star" style="color: #f39c12;"></i>Attend all orientation sessions - they're packed with essential info</li>
                                                    <li><i class="fas fa-star" style="color: #f39c12;"></i>Get your student ID card immediately - you'll need it everywhere</li>
                                                    <li><i class="fas fa-star" style="color: #f39c12;"></i>Learn the campus layout during your first few days</li>
                                                    <li><i class="fas fa-star" style="color: #f39c12;"></i>Save all important dates from the academic calendar</li>
                                                </ul>
                                            </div>
                                            <div class="col-md-6">
                                                <ul class="document-list">
                                                    <li><i class="fas fa-star" style="color: #f39c12;"></i>Build a good relationship with your roommates</li>
                                                    <li><i class="fas fa-star" style="color: #f39c12;"></i>Take care of your health - eat well and sleep enough</li>
                                                    <li><i class="fas fa-star" style="color: #f39c12;"></i>Stay connected with family but focus on your studies</li>
                                                    <li><i class="fas fa-star" style="color: #f39c12;"></i>Explore and enjoy your new environment!</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                        <h2 class="mb-3">Ready to Begin Your NAUB Journey?</h2>
                        <p class="mb-4 opacity-75">Explore more resources to help you succeed</p>
                        <div class="d-flex gap-3 justify-content-center flex-wrap">
                            <a href="<?php echo BASE_URL; ?>/checklist.php" class="btn btn-light-custom">
                                <i class="fas fa-check-square me-2"></i>Complete Checklist
                            </a>
                            <a href="<?php echo BASE_URL; ?>/page.php?slug=registration" class="btn btn-outline-custom">
                                <i class="fas fa-clipboard-list me-2"></i>Registration Guide
                            </a>
                            <a href="<?php echo BASE_URL; ?>/page.php?slug=student-support" class="btn btn-outline-custom">
                                <i class="fas fa-hands-helping me-2"></i>Support Services
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
