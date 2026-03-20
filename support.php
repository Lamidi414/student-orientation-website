<?php
/**
 * Support Services Page
 * Nigerian Army University, Biu - Orientation Portal
 */

// Page configuration
$page_title = 'Support Services';
$page_description = 'Access comprehensive support services at NAUB - Student Affairs, Registry, ICT, Security, Medical, Library, and more';

// Include required files
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/includes/functions.php';

// Get contacts from database
$contacts = get_all_contacts();
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
        .support-hero {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            padding: 80px 0;
            position: relative;
            overflow: hidden;
        }
        
        .support-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="40" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="0.5"/></svg>');
            background-size: 200px 200px;
            opacity: 0.5;
        }
        
        .section-padding {
            padding: 60px 0;
        }
        
        .section-title {
            position: relative;
            margin-bottom: 40px;
            padding-bottom: 15px;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background: #1e3c72;
        }
        
        .section-title.text-start::after {
            left: 0;
            transform: none;
        }
        
        .service-card {
            background: white;
            border: none;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
        }
        
        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        
        .service-icon {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 28px;
        }
        
        .icon-student-affairs { background: #e8f4f8; color: #1e3c72; }
        .icon-registry { background: #fef9e7; color: #d4ac0d; }
        .icon-ict { background: #e8f6f3; color: #27ae60; }
        .icon-security { background: #fdebd0; color: #e67e22; }
        .icon-medical { background: #f8e8e8; color: #e74c3c; }
        .icon-library { background: #f5eef8; color: #8e44ad; }
        
        .contact-card {
            background: white;
            border: none;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
            height: 100%;
        }
        
        .contact-card:hover {
            transform: translateY(-3px);
        }
        
        .contact-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: #1e3c72;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            margin-bottom: 15px;
        }
        
        .emergency-card {
            background: linear-gradient(135deg, #c0392b 0%, #e74c3c 100%);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 30px;
        }
        
        .emergency-card .emergency-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: rgba(255,255,255,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 36px;
        }
        
        .directory-table {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        
        .directory-table thead {
            background: #1e3c72;
            color: white;
        }
        
        .directory-table th {
            border: none;
            padding: 15px;
            font-weight: 600;
        }
        
        .directory-table td {
            padding: 15px;
            border-bottom: 1px solid #eee;
            vertical-align: middle;
        }
        
        .directory-table tr:last-child td {
            border-bottom: none;
        }
        
        .directory-table tr:hover {
            background: #f8f9fa;
        }
        
        .quick-nav {
            background: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
        }
        
        .quick-nav .nav-pills .nav-link {
            color: #1e3c72;
            font-weight: 500;
            border-radius: 20px;
            padding: 8px 20px;
            margin: 0 5px;
        }
        
        .quick-nav .nav-pills .nav-link:hover {
            background: #1e3c72;
            color: white;
        }
        
        .hours-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .hours-list li {
            padding: 10px 0;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
        }
        
        .hours-list li:last-child {
            border-bottom: none;
        }
        
        .hours-list .day {
            font-weight: 500;
            color: #1e3c72;
        }
        
        .hours-list .time {
            color: #666;
        }
        
        .service-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .service-list li {
            padding: 10px 0;
            display: flex;
            align-items: flex-start;
        }
        
        .service-list li i {
            color: #27ae60;
            margin-right: 12px;
            margin-top: 4px;
        }
        
        @media (max-width: 768px) {
            .support-hero {
                padding: 50px 0;
            }
            
            .section-padding {
                padding: 40px 0;
            }
            
            .quick-nav .nav-pills .nav-link {
                margin: 5px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <?php include __DIR__ . '/includes/header.php'; ?>

    <!-- Hero Section -->
    <section class="support-hero">
        <div class="container position-relative">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h1 class="display-4 fw-bold mb-3">Support Services</h1>
                    <p class="lead mb-0">We're Here to Help</p>
                    <p class="small mt-2 opacity-75">Your success is our priority - Access all the support you need at NAUB</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Quick Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light quick-nav py-2">
        <div class="container">
            <div class="collapse navbar-collapse justify-content-center">
                <ul class="nav nav-pills flex-wrap justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link" href="#student-affairs"><i class="fas fa-user-tie me-1"></i> Student Affairs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#registry"><i class="fas fa-folder-open me-1"></i> Registry</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#ict"><i class="fas fa-laptop me-1"></i> ICT Support</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#security"><i class="fas fa-shield-alt me-1"></i> Security</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#medical"><i class="fas fa-hospital me-1"></i> Medical</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#library"><i class="fas fa-book me-1"></i> Library</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#directory"><i class="fas fa-address-book me-1"></i> Directory</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        <!-- Emergency Contacts Banner -->
        <section class="py-3 bg-danger">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <h5 class="text-white mb-2 mb-lg-0">
                            <i class="fas fa-exclamation-triangle me-2"></i>Emergency? Need immediate assistance?
                        </h5>
                    </div>
                    <div class="col-lg-4 text-lg-end">
                        <a href="tel:+234800NAUBHELP" class="btn btn-light btn-sm me-2">
                            <i class="fas fa-phone me-1"></i> +234 800 NAUB HELP
                        </a>
                        <a href="tel:+234800NAUBSEC" class="btn btn-outline-light btn-sm">
                            <i class="fas fa-shield-alt me-1"></i> +234 800 NAUB SEC
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Student Affairs Office -->
        <section id="student-affairs" class="section-padding">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <h2 class="section-title text-center">Student Affairs Office</h2>
                        
                        <div class="row g-4">
                            <div class="col-lg-6">
                                <div class="service-card">
                                    <div class="service-icon icon-student-affairs">
                                        <i class="fas fa-user-tie"></i>
                                    </div>
                                    <h4 class="text-center mb-3">Student Affairs Office</h4>
                                    <p class="text-muted text-center mb-4">
                                        The Student Affairs Office is dedicated to supporting your holistic development and ensuring a positive university experience.
                                    </p>
                                    
                                    <h6 class="mb-3 text-primary">Services Offered:</h6>
                                    <ul class="service-list">
                                        <li><i class="fas fa-check"></i> Student counseling and guidance</li>
                                        <li><i class="fas fa-check"></i> Hostel accommodation management</li>
                                        <li><i class="fas fa-check"></i> Student clubs and organizations</li>
                                        <li><i class="fas fa-check"></i> Student welfare programs</li>
                                        <li><i class="fas fa-check"></i> Discipline and conduct matters</li>
                                        <li><i class="fas fa-check"></i> Career services and job placement</li>
                                        <li><i class="fas fa-check"></i> International student support</li>
                                        <li><i class="fas fa-check"></i> Student identification cards</li>
                                    </ul>
                                </div>
                            </div>
                            
                            <div class="col-lg-6">
                                <div class="service-card">
                                    <h5 class="mb-4 text-primary">
                                        <i class="fas fa-address-card me-2"></i>Contact Information
                                    </h5>
                                    
                                    <div class="mb-4">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="contact-icon me-3" style="width: 40px; height: 40px; font-size: 16px; margin-bottom: 0;">
                                                <i class="fas fa-envelope"></i>
                                            </div>
                                            <div>
                                                <small class="text-muted d-block">Email</small>
                                                <strong>studentaffairs@naub.edu.ng</strong>
                                            </div>
                                        </div>
                                        
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="contact-icon me-3" style="width: 40px; height: 40px; font-size: 16px; margin-bottom: 0;">
                                                <i class="fas fa-phone"></i>
                                            </div>
                                            <div>
                                                <small class="text-muted d-block">Phone</small>
                                                <strong>+234 800 NAUB STD</strong>
                                            </div>
                                        </div>
                                        
                                        <div class="d-flex align-items-center">
                                            <div class="contact-icon me-3" style="width: 40px; height: 40px; font-size: 16px; margin-bottom: 0;">
                                                <i class="fas fa-map-marker-alt"></i>
                                            </div>
                                            <div>
                                                <small class="text-muted d-block">Location</small>
                                                <strong>Student Union Building</strong>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <h6 class="mb-3 text-primary">
                                        <i class="fas fa-clock me-2"></i>Office Hours
                                    </h6>
                                    <ul class="hours-list">
                                        <li>
                                            <span class="day">Monday - Friday</span>
                                            <span class="time">8:00 AM - 4:00 PM</span>
                                        </li>
                                        <li>
                                            <span class="day">Saturday</span>
                                            <span class="time">9:00 AM - 1:00 PM</span>
                                        </li>
                                        <li>
                                            <span class="day">Sunday</span>
                                            <span class="time">Closed</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Registry and Academic Affairs -->
        <section id="registry" class="section-padding bg-light">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <h2 class="section-title text-center">Registry and Academic Affairs</h2>
                        
                        <div class="row g-4">
                            <div class="col-lg-6">
                                <div class="service-card">
                                    <div class="service-icon icon-registry">
                                        <i class="fas fa-folder-open"></i>
                                    </div>
                                    <h4 class="text-center mb-3">Registry Office</h4>
                                    <p class="text-muted text-center mb-4">
                                        The Registry handles all academic records, administrative documents, and student registration matters.
                                    </p>
                                    
                                    <h6 class="mb-3 text-primary">Services Offered:</h6>
                                    <ul class="service-list">
                                        <li><i class="fas fa-check"></i> Academic records management</li>
                                        <li><i class="fas fa-check"></i> Transcript processing</li>
                                        <li><i class="fas fa-check"></i> Certificate verification</li>
                                        <li><i class="fas fa-check"></i> Student registration</li>
                                        <li><i class="fas fa-check"></i> Course enrollment</li>
                                        <li><i class="fas fa-check"></i> Degree confirmation</li>
                                        <li><i class="fas fa-check"></i> Student data management</li>
                                        <li><i class="fas fa-check"></i> Alumni records</li>
                                    </ul>
                                </div>
                            </div>
                            
                            <div class="col-lg-6">
                                <div class="service-card">
                                    <h5 class="mb-4 text-primary">
                                        <i class="fas fa-address-card me-2"></i>Contact Information
                                    </h5>
                                    
                                    <div class="mb-4">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="contact-icon me-3" style="width: 40px; height: 40px; font-size: 16px; margin-bottom: 0;">
                                                <i class="fas fa-envelope"></i>
                                            </div>
                                            <div>
                                                <small class="text-muted d-block">Email</small>
                                                <strong>registry@naub.edu.ng</strong>
                                            </div>
                                        </div>
                                        
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="contact-icon me-3" style="width: 40px; height: 40px; font-size: 16px; margin-bottom: 0;">
                                                <i class="fas fa-phone"></i>
                                            </div>
                                            <div>
                                                <small class="text-muted d-block">Phone</small>
                                                <strong>+234 800 NAUB REG</strong>
                                            </div>
                                        </div>
                                        
                                        <div class="d-flex align-items-center">
                                            <div class="contact-icon me-3" style="width: 40px; height: 40px; font-size: 16px; margin-bottom: 0;">
                                                <i class="fas fa-map-marker-alt"></i>
                                            </div>
                                            <div>
                                                <small class="text-muted d-block">Location</small>
                                                <strong>Administrative Block, Room 101</strong>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <h6 class="mb-3 text-primary">
                                        <i class="fas fa-clock me-2"></i>Office Hours
                                    </h6>
                                    <ul class="hours-list">
                                        <li>
                                            <span class="day">Monday - Friday</span>
                                            <span class="time">8:00 AM - 4:00 PM</span>
                                        </li>
                                        <li>
                                            <span class="day">Saturday - Sunday</span>
                                            <span class="time">Closed</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ICT Support -->
        <section id="ict" class="section-padding">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <h2 class="section-title text-center">ICT Support Services</h2>
                        
                        <div class="row g-4">
                            <div class="col-lg-6">
                                <div class="service-card">
                                    <div class="service-icon icon-ict">
                                        <i class="fas fa-laptop-code"></i>
                                    </div>
                                    <h4 class="text-center mb-3">IT Services & Help Desk</h4>
                                    <p class="text-muted text-center mb-4">
                                        The ICT Department provides technical support, internet services, and maintains the university's digital infrastructure.
                                    </p>
                                    
                                    <h6 class="mb-3 text-primary">Services Offered:</h6>
                                    <ul class="service-list">
                                        <li><i class="fas fa-check"></i> Student portal support</li>
                                        <li><i class="fas fa-check"></i> Email account management</li>
                                        <li><i class="fas fa-check"></i> Wi-Fi connectivity support</li>
                                        <li><i class="fas fa-check"></i> Password reset services</li>
                                        <li><i class="fas fa-check"></i> Computer lab access</li>
                                        <li><i class="fas fa-check"></i> Software installation</li>
                                        <li><i class="fas fa-check"></i> Network troubleshooting</li>
                                        <li><i class="fas fa-check"></i> Digital learning platform support</li>
                                    </ul>
                                    
                                    <h6 class="mt-4 mb-3 text-primary">Common Issues & Solutions:</h6>
                                    <div class="accordion" id="ictAccordion">
                                        <div class="accordion-item border">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                                                    Cannot access student portal
                                                </button>
                                            </h2>
                                            <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#ictAccordion">
                                                <div class="accordion-body">
                                                    Clear browser cache, ensure correct URL (my.naub.edu.ng), and contact IT Help Desk for account verification.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item border">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                                                    Password reset
                                                </button>
                                            </h2>
                                            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#ictAccordion">
                                                <div class="accordion-body">
                                                    Visit the IT Help Desk in the Library Building with your student ID card. Temporary password will be sent to your registered email.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item border">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
                                                    Wi-Fi connectivity issues
                                                </button>
                                            </h2>
                                            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#ictAccordion">
                                                <div class="accordion-body">
                                                    Ensure you are within campus coverage area, use NAUB-WIFI network, and restart your device. Contact IT if problem persists.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-6">
                                <div class="service-card">
                                    <h5 class="mb-4 text-primary">
                                        <i class="fas fa-address-card me-2"></i>Contact Information
                                    </h5>
                                    
                                    <div class="mb-4">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="contact-icon me-3" style="width: 40px; height: 40px; font-size: 16px; margin-bottom: 0;">
                                                <i class="fas fa-envelope"></i>
                                            </div>
                                            <div>
                                                <small class="text-muted d-block">Email</small>
                                                <strong>it@naub.edu.ng</strong>
                                            </div>
                                        </div>
                                        
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="contact-icon me-3" style="width: 40px; height: 40px; font-size: 16px; margin-bottom: 0;">
                                                <i class="fas fa-phone"></i>
                                            </div>
                                            <div>
                                                <small class="text-muted d-block">Phone</small>
                                                <strong>+234 800 NAUB IT</strong>
                                            </div>
                                        </div>
                                        
                                        <div class="d-flex align-items-center">
                                            <div class="contact-icon me-3" style="width: 40px; height: 40px; font-size: 16px; margin-bottom: 0;">
                                                <i class="fas fa-map-marker-alt"></i>
                                            </div>
                                            <div>
                                                <small class="text-muted d-block">Location</small>
                                                <strong>Library Building, First Floor</strong>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <h6 class="mb-3 text-primary">
                                        <i class="fas fa-clock me-2"></i>Help Desk Hours
                                    </h6>
                                    <ul class="hours-list">
                                        <li>
                                            <span class="day">Monday - Friday</span>
                                            <span class="time">8:00 AM - 6:00 PM</span>
                                        </li>
                                        <li>
                                            <span class="day">Saturday</span>
                                            <span class="time">9:00 AM - 3:00 PM</span>
                                        </li>
                                        <li>
                                            <span class="day">Sunday</span>
                                            <span class="time">Closed</span>
                                        </li>
                                    </ul>
                                    
                                    <div class="alert alert-info mt-4 mb-0">
                                        <i class="fas fa-info-circle me-2"></i>
                                        <strong>Tip:</strong> For urgent IT issues outside office hours, email emergency support at emergency@naub.edu.ng
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Security Services -->
        <section id="security" class="section-padding bg-light">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <h2 class="section-title text-center">Security Services</h2>
                        
                        <div class="row g-4">
                            <div class="col-lg-6">
                                <div class="service-card">
                                    <div class="service-icon icon-security">
                                        <i class="fas fa-shield-alt"></i>
                                    </div>
                                    <h4 class="text-center mb-3">Campus Security</h4>
                                    <p class="text-muted text-center mb-4">
                                        The Security Department ensures the safety and security of all students, staff, and visitors on campus.
                                    </p>
                                    
                                    <h6 class="mb-3 text-primary">Services & Responsibilities:</h6>
                                    <ul class="service-list">
                                        <li><i class="fas fa-check"></i> 24/7 campus security patrol</li>
                                        <li><i class="fas fa-check"></i> Access control at entry points</li>
                                        <li><i class="fas fa-check"></i> Emergency response coordination</li>
                                        <li><i class="fas fa-check"></i> Lost and found services</li>
                                        <li><i class="fas fa-check"></i> Campus surveillance monitoring</li>
                                        <li><i class="fas fa-check"></i> Escort services at night</li>
                                        <li><i class="fas fa-check"></i> Traffic and parking management</li>
                                        <li><i class="fas fa-check"></i> Security awareness programs</li>
                                    </ul>
                                    
                                    <h6 class="mt-4 mb-3 text-primary">Safety Tips:</h6>
                                    <div class="alert alert-warning mb-0">
                                        <ul class="mb-0 ps-3">
                                            <li>Report suspicious activities immediately</li>
                                            <li>Keep your belongings secure</li>
                                            <li>Use well-lit pathways at night</li>
                                            <li>Request security escort when needed</li>
                                            <li>Save emergency numbers on your phone</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-6">
                                <!-- Emergency Contact Card -->
                                <div class="emergency-card mb-4">
                                    <div class="emergency-icon">
                                        <i class="fas fa-phone-volume"></i>
                                    </div>
                                    <h4 class="text-center mb-3">Emergency Hotline</h4>
                                    <p class="text-center mb-4">
                                        Available 24/7 for any security emergencies on campus
                                    </p>
                                    <div class="text-center">
                                        <a href="tel:+234800NAUBSEC" class="btn btn-light btn-lg">
                                            <i class="fas fa-phone me-2"></i>+234 800 NAUB SEC
                                        </a>
                                    </div>
                                </div>
                                
                                <div class="service-card">
                                    <h5 class="mb-4 text-primary">
                                        <i class="fas fa-address-card me-2"></i>Contact Information
                                    </h5>
                                    
                                    <div class="mb-4">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="contact-icon me-3" style="width: 40px; height: 40px; font-size: 16px; margin-bottom: 0;">
                                                <i class="fas fa-envelope"></i>
                                            </div>
                                            <div>
                                                <small class="text-muted d-block">Email</small>
                                                <strong>security@naub.edu.ng</strong>
                                            </div>
                                        </div>
                                        
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="contact-icon me-3" style="width: 40px; height: 40px; font-size: 16px; margin-bottom: 0;">
                                                <i class="fas fa-phone"></i>
                                            </div>
                                            <div>
                                                <small class="text-muted d-block">Phone</small>
                                                <strong>+234 800 NAUB SEC</strong>
                                            </div>
                                        </div>
                                        
                                        <div class="d-flex align-items-center">
                                            <div class="contact-icon me-3" style="width: 40px; height: 40px; font-size: 16px; margin-bottom: 0;">
                                                <i class="fas fa-map-marker-alt"></i>
                                            </div>
                                            <div>
                                                <small class="text-muted d-block">Location</small>
                                                <strong>Main Gate, Campus Entrance</strong>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="alert alert-danger mb-0">
                                        <i class="fas fa-exclamation-triangle me-2"></i>
                                        <strong>For emergencies only!</strong> Use this number for immediate security threats, accidents, or urgent situations.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Medical Services -->
        <section id="medical" class="section-padding">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <h2 class="section-title text-center">Medical Services</h2>
                        
                        <div class="row g-4">
                            <div class="col-lg-6">
                                <div class="service-card">
                                    <div class="service-icon icon-medical">
                                        <i class="fas fa-hospital-user"></i>
                                    </div>
                                    <h4 class="text-center mb-3">University Health Center</h4>
                                    <p class="text-muted text-center mb-4">
                                        The Health Center provides comprehensive healthcare services to ensure the well-being of all students and staff.
                                    </p>
                                    
                                    <h6 class="mb-3 text-primary">Health Services Available:</h6>
                                    <ul class="service-list">
                                        <li><i class="fas fa-check"></i> General medical consultations</li>
                                        <li><i class="fas fa-check"></i> First aid treatment</li>
                                        <li><i class="fas fa-check"></i> Health screening and checkups</li>
                                        <li><i class="fas fa-check"></i> Emergency medical care</li>
                                        <li><i class="fas fa-check"></i> Health education programs</li>
                                        <li><i class="fas fa-check"></i> Referral services to specialist hospitals</li>
                                        <li><i class="fas fa-check"></i> Pharmacy services</li>
                                        <li><i class="fas fa-check"></i> Mental health support</li>
                                    </ul>
                                    
                                    <h6 class="mt-4 mb-3 text-primary">Emergency Procedures:</h6>
                                    <div class="alert alert-danger mb-0">
                                        <i class="fas fa-ambulance me-2"></i>
                                        In case of medical emergency, call <strong>+234 800 NAUB HLT</strong> or proceed to the Health Center immediately.
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-6">
                                <!-- Emergency Medical Card -->
                                <div class="emergency-card mb-4" style="background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);">
                                    <div class="emergency-icon">
                                        <i class="fas fa-ambulance"></i>
                                    </div>
                                    <h4 class="text-center mb-3">Medical Emergency</h4>
                                    <p class="text-center mb-4">
                                        24/7 medical emergency response available
                                    </p>
                                    <div class="text-center">
                                        <a href="tel:+234800NAUBHLT" class="btn btn-light btn-lg">
                                            <i class="fas fa-phone me-2"></i>+234 800 NAUB HLT
                                        </a>
                                    </div>
                                </div>
                                
                                <div class="service-card">
                                    <h5 class="mb-4 text-primary">
                                        <i class="fas fa-address-card me-2"></i>Contact Information
                                    </h5>
                                    
                                    <div class="mb-4">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="contact-icon me-3" style="width: 40px; height: 40px; font-size: 16px; margin-bottom: 0;">
                                                <i class="fas fa-envelope"></i>
                                            </div>
                                            <div>
                                                <small class="text-muted d-block">Email</small>
                                                <strong>health@naub.edu.ng</strong>
                                            </div>
                                        </div>
                                        
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="contact-icon me-3" style="width: 40px; height: 40px; font-size: 16px; margin-bottom: 0;">
                                                <i class="fas fa-phone"></i>
                                            </div>
                                            <div>
                                                <small class="text-muted d-block">Phone</small>
                                                <strong>+234 800 NAUB HLT</strong>
                                            </div>
                                        </div>
                                        
                                        <div class="d-flex align-items-center">
                                            <div class="contact-icon me-3" style="width: 40px; height: 40px; font-size: 16px; margin-bottom: 0;">
                                                <i class="fas fa-map-marker-alt"></i>
                                            </div>
                                            <div>
                                                <small class="text-muted d-block">Location</small>
                                                <strong>Near Administrative Block</strong>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <h6 class="mb-3 text-primary">
                                        <i class="fas fa-clock me-2"></i>Health Center Hours
                                    </h6>
                                    <ul class="hours-list">
                                        <li>
                                            <span class="day">Monday - Friday</span>
                                            <span class="time">24 Hours</span>
                                        </li>
                                        <li>
                                            <span class="day">Saturday - Sunday</span>
                                            <span class="time">24 Hours</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Library Services -->
        <section id="library" class="section-padding bg-light">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <h2 class="section-title text-center">Library Services</h2>
                        
                        <div class="row g-4">
                            <div class="col-lg-6">
                                <div class="service-card">
                                    <div class="service-icon icon-library">
                                        <i class="fas fa-book-reader"></i>
                                    </div>
                                    <h4 class="text-center mb-3">University Library</h4>
                                    <p class="text-muted text-center mb-4">
                                        The NAUB Library is a center of excellence for learning, research, and academic resources.
                                    </p>
                                    
                                    <h6 class="mb-3 text-primary">Library Services:</h6>
                                    <ul class="service-list">
                                        <li><i class="fas fa-check"></i> Book borrowing and returning</li>
                                        <li><i class="fas fa-check"></i> Reference services</li>
                                        <li><i class="fas fa-check"></i> Internet and Wi-Fi access</li>
                                        <li><i class="fas fa-check"></i> Research assistance</li>
                                        <li><i class="fas fa-check"></i> Digital library resources</li>
                                        <li><i class="fas fa-check"></i> Photocopying and printing</li>
                                        <li><i class="fas fa-check"></i> Study rooms reservation</li>
                                        <li><i class="fas fa-check"></i> Database access (JSTOR, etc.)</li>
                                    </ul>
                                </div>
                            </div>
                            
                            <div class="col-lg-6">
                                <div class="service-card">
                                    <h5 class="mb-4 text-primary">
                                        <i class="fas fa-address-card me-2"></i>Contact Information
                                    </h5>
                                    
                                    <div class="mb-4">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="contact-icon me-3" style="width: 40px; height: 40px; font-size: 16px; margin-bottom: 0;">
                                                <i class="fas fa-envelope"></i>
                                            </div>
                                            <div>
                                                <small class="text-muted d-block">Email</small>
                                                <strong>library@naub.edu.ng</strong>
                                            </div>
                                        </div>
                                        
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="contact-icon me-3" style="width: 40px; height: 40px; font-size: 16px; margin-bottom: 0;">
                                                <i class="fas fa-phone"></i>
                                            </div>
                                            <div>
                                                <small class="text-muted d-block">Phone</small>
                                                <strong>+234 800 NAUB LIB</strong>
                                            </div>
                                        </div>
                                        
                                        <div class="d-flex align-items-center">
                                            <div class="contact-icon me-3" style="width: 40px; height: 40px; font-size: 16px; margin-bottom: 0;">
                                                <i class="fas fa-map-marker-alt"></i>
                                            </div>
                                            <div>
                                                <small class="text-muted d-block">Location</small>
                                                <strong>Central Library Complex</strong>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <h6 class="mb-3 text-primary">
                                        <i class="fas fa-clock me-2"></i>Library Hours
                                    </h6>
                                    <ul class="hours-list">
                                        <li>
                                            <span class="day">Monday - Friday</span>
                                            <span class="time">8:00 AM - 10:00 PM</span>
                                        </li>
                                        <li>
                                            <span class="day">Saturday</span>
                                            <span class="time">9:00 AM - 6:00 PM</span>
                                        </li>
                                        <li>
                                            <span class="day">Sunday</span>
                                            <span class="time">2:00 PM - 6:00 PM</span>
                                        </li>
                                    </ul>
                                    
                                    <div class="alert alert-info mt-4 mb-0">
                                        <i class="fas fa-id-card me-2"></i>
                                        <strong>Note:</strong> Bring your student ID card to access library services.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Directory -->
        <section id="directory" class="section-padding">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <h2 class="section-title text-center">Contact Directory</h2>
                        <p class="text-center mb-5">Complete list of important contacts at NAUB</p>
                        
                        <?php if (!empty($contacts)): ?>
                        <div class="directory-table">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th><i class="fas fa-building me-2"></i>Office Name</th>
                                            <th><i class="fas fa-envelope me-2"></i>Email</th>
                                            <th><i class="fas fa-phone me-2"></i>Phone</th>
                                            <th><i class="fas fa-map-marker-alt me-2"></i>Location</th>
                                        </tr>
                                    </thead>
                                    <tbody>
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
                                            <td><?php echo sanitize($contact['location']); ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php else: ?>
                        <!-- Fallback static directory if database is not available -->
                        <div class="directory-table">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th><i class="fas fa-building me-2"></i>Office Name</th>
                                            <th><i class="fas fa-envelope me-2"></i>Email</th>
                                            <th><i class="fas fa-phone me-2"></i>Phone</th>
                                            <th><i class="fas fa-map-marker-alt me-2"></i>Location</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="table-danger">
                                            <td><strong><i class="fas fa-exclamation-triangle text-danger me-2"></i>Security Office (Emergency)</strong></td>
                                            <td><a href="mailto:security@naub.edu.ng">security@naub.edu.ng</a></td>
                                            <td><a href="tel:+234800NAUBSEC">+234 800 NAUB SEC</a></td>
                                            <td>Main Gate</td>
                                        </tr>
                                        <tr class="table-danger">
                                            <td><strong><i class="fas fa-exclamation-triangle text-danger me-2"></i>Health Center (Emergency)</strong></td>
                                            <td><a href="mailto:health@naub.edu.ng">health@naub.edu.ng</a></td>
                                            <td><a href="tel:+234800NAUBHLT">+234 800 NAUB HLT</a></td>
                                            <td>Near Administrative Block</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Student Affairs</strong></td>
                                            <td><a href="mailto:studentaffairs@naub.edu.ng">studentaffairs@naub.edu.ng</a></td>
                                            <td><a href="tel:+234800NAUBSTD">+234 800 NAUB STD</a></td>
                                            <td>Student Union Building</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Registry</strong></td>
                                            <td><a href="mailto:registry@naub.edu.ng">registry@naub.edu.ng</a></td>
                                            <td><a href="tel:+234800NAUBREG">+234 800 NAUB REG</a></td>
                                            <td>Administrative Block, Room 101</td>
                                        </tr>
                                        <tr>
                                            <td><strong>IT Services</strong></td>
                                            <td><a href="mailto:it@naub.edu.ng">it@naub.edu.ng</a></td>
                                            <td><a href="tel:+234800NAUBIT">+234 800 NAUB IT</a></td>
                                            <td>Library Building, First Floor</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Library</strong></td>
                                            <td><a href="mailto:library@naub.edu.ng">library@naub.edu.ng</a></td>
                                            <td><a href="tel:+234800NAUBLIB">+234 800 NAUB LIB</a></td>
                                            <td>Central Library Complex</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Admissions Office</strong></td>
                                            <td><a href="mailto:admissions@naub.edu.ng">admissions@naub.edu.ng</a></td>
                                            <td><a href="tel:+234800NAUBADM">+234 800 NAUB ADM</a></td>
                                            <td>Administrative Block, Room 205</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Finance Office</strong></td>
                                            <td><a href="mailto:finance@naub.edu.ng">finance@naub.edu.ng</a></td>
                                            <td><a href="tel:+234800NAUBFIN">+234 800 NAUB FIN</a></td>
                                            <td>Administrative Block, Ground Floor</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Career Services</strong></td>
                                            <td><a href="mailto:careers@naub.edu.ng">careers@naub.edu.ng</a></td>
                                            <td><a href="tel:+234800NAUBCAR">+234 800 NAUB CAR</a></td>
                                            <td>Student Affairs Office</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Sports Unit</strong></td>
                                            <td><a href="mailto:sports@naub.edu.ng">sports@naub.edu.ng</a></td>
                                            <td><a href="tel:+234800NAUBSPT">+234 800 NAUB SPT</a></td>
                                            <td>Sports Complex</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php endif; ?>
                        
                        <div class="alert alert-warning mt-4">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>Note:</strong> For general inquiries, you can also contact the main university line at <strong>+234 800 NAUB UNI</strong> or email <strong>info@naub.edu.ng</strong>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Need More Help? -->
        <section class="section-padding bg-light">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h2 class="mb-3">Need More Help?</h2>
                        <p class="mb-4">Can't find what you're looking for? Our support team is here to assist you.</p>
                        <div class="d-flex gap-3 justify-content-center flex-wrap">
                            <a href="contact.php" class="btn btn-primary btn-lg">
                                <i class="fas fa-envelope me-2"></i>Contact Us
                            </a>
                            <a href="faqs.php" class="btn btn-outline-primary btn-lg">
                                <i class="fas fa-question-circle me-2"></i>View FAQs
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
