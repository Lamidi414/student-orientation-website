<?php
/**
 * Student Conduct Guide Page
 * Nigerian Army University, Biu - Orientation Portal
 */

// Page configuration
$page_title = 'Student Conduct Guide (Orientation Summary)';
$page_description = 'Important guidelines for new students - Orientation summary of student conduct and rules at NAUB';

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
        .rules-hero {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 50%, #1e3c72 100%);
            color: white;
            padding: 100px 0;
            position: relative;
            overflow: hidden;
        }
        
        .rules-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="30" fill="none" stroke="rgba(255,255,255,0.08)" stroke-width="0.5"/></svg>');
            background-size: 150px 150px;
        }
        
        .rules-hero .display-4 {
            font-weight: 700;
            margin-bottom: 1rem;
        }
        
        .rules-hero .lead {
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
        
        /* Disclaimer Box */
        .disclaimer-box {
            background: linear-gradient(135deg, #fff3cd 0%, #ffe69c 100%);
            border: none;
            border-left: 4px solid #ffc107;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 30px;
        }
        
        .disclaimer-box h5 {
            color: #856404;
            margin-bottom: 10px;
        }
        
        .disclaimer-box p {
            color: #856404;
            margin-bottom: 0;
            font-size: 0.95rem;
        }
        
        /* Warning Boxes */
        .warning-box {
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
            border-left: 4px solid;
        }
        
        .warning-box.danger {
            background: linear-gradient(135deg, #fdedec 0%, #fadbd8 100%);
            border-color: #e74c3c;
        }
        
        .warning-box.warning {
            background: linear-gradient(135deg, #fff3cd 0%, #ffe69c 100%);
            border-color: #f39c12;
        }
        
        .warning-box.info {
            background: linear-gradient(135deg, #e8f4f8 0%, #d6eaf8 100%);
            border-color: #3498db;
        }
        
        .warning-box.success {
            background: linear-gradient(135deg, #e8f6f3 0%, #d5f5e3 100%);
            border-color: #27ae60;
        }
        
        .warning-box.danger h5, .warning-box.danger i {
            color: #c0392b;
        }
        
        .warning-box.warning h5, .warning-box.warning i {
            color: #d68910;
        }
        
        .warning-box.info h5, .warning-box.info i {
            color: #2980b9;
        }
        
        .warning-box.success h5, .warning-box.success i {
            color: #1e8449;
        }
        
        /* Policy Card */
        .policy-card {
            background: white;
            border: none;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            height: 100%;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .policy-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.12);
        }
        
        .policy-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
            font-size: 24px;
        }
        
        .policy-icon.blue { background: #e8f4f8; color: #1e3c72; }
        .policy-icon.green { background: #e8f6f3; color: #27ae60; }
        .policy-icon.orange { background: #fef5e7; color: #e67e22; }
        .policy-icon.red { background: #fdedec; color: #e74c3c; }
        .policy-icon.purple { background: #f5eef8; color: #8e44ad; }
        .policy-icon.teal { background: #e8f4f4; color: #1abc9c; }
        
        .policy-card h5 {
            color: #333;
            margin-bottom: 10px;
            font-weight: 600;
        }
        
        .policy-card p {
            color: #666;
            margin-bottom: 0;
            font-size: 0.9rem;
        }
        
        /* Flowchart Styles */
        .flowchart {
            position: relative;
            padding: 20px 0;
        }
        
        .flow-step {
            background: white;
            border: 2px solid #1e3c72;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            position: relative;
            margin-bottom: 20px;
            box-shadow: 0 4px 10px rgba(30, 60, 114, 0.1);
        }
        
        .flow-step::after {
            content: '';
            position: absolute;
            bottom: -25px;
            left: 50%;
            transform: translateX(-50%);
            width: 2px;
            height: 25px;
            background: #1e3c72;
        }
        
        .flow-step:last-child::after {
            display: none;
        }
        
        .flow-step h6 {
            color: #1e3c72;
            margin-bottom: 5px;
            font-weight: 600;
        }
        
        .flow-step p {
            color: #666;
            font-size: 0.85rem;
            margin-bottom: 0;
        }
        
        .flow-arrow {
            text-align: center;
            color: #1e3c72;
            font-size: 20px;
            margin: 10px 0;
        }
        
        /* Contact Cards */
        .contact-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            display: flex;
            align-items: flex-start;
            transition: transform 0.3s ease;
            height: 100%;
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
        
        /* List Styles */
        .policy-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .policy-list li {
            padding: 12px 15px;
            background: #f8f9fa;
            border-radius: 8px;
            margin-bottom: 10px;
            display: flex;
            align-items: flex-start;
            transition: background 0.3s ease;
        }
        
        .policy-list li:hover {
            background: #e8f4f8;
        }
        
        .policy-list li i {
            color: #27ae60;
            margin-right: 12px;
            font-size: 16px;
            margin-top: 2px;
        }
        
        .policy-list li.danger i {
            color: #e74c3c;
        }
        
        /* Table Styles */
        .policy-table {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }
        
        .policy-table table {
            margin-bottom: 0;
        }
        
        .policy-table th {
            background: #1e3c72;
            color: white;
            font-weight: 600;
            padding: 15px;
            border: none;
        }
        
        .policy-table td {
            padding: 15px;
            border-bottom: 1px solid #eee;
            vertical-align: middle;
        }
        
        .policy-table tr:last-child td {
            border-bottom: none;
        }
        
        .policy-table tr:hover {
            background: #f8f9fa;
        }
        
        /* Quick Nav */
        .quick-nav {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            position: sticky;
            top: 80px;
        }
        
        .quick-nav h6 {
            color: #1e3c72;
            margin-bottom: 15px;
            font-weight: 600;
        }
        
        .quick-nav a {
            display: block;
            padding: 8px 0;
            color: #666;
            text-decoration: none;
            border-bottom: 1px solid #eee;
            transition: color 0.3s ease;
        }
        
        .quick-nav a:last-child {
            border-bottom: none;
        }
        
        .quick-nav a:hover {
            color: #1e3c72;
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
        
        @media (max-width: 768px) {
            .rules-hero {
                padding: 60px 0;
            }
            
            .section-padding {
                padding: 50px 0;
            }
            
            .flow-step::after {
                display: none;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <?php include __DIR__ . '/includes/header.php'; ?>

    <!-- Hero Section -->
    <section class="rules-hero">
        <div class="container position-relative">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <div class="mb-4">
                        <i class="fas fa-gavel fa-4x"></i>
                    </div>
                    <h1 class="display-4 fw-bold mb-3">Student Conduct Guide</h1>
                    <p class="lead mb-4">Important Guidelines for New Students</p>
                    <p class="opacity-75 mb-0">Understanding expectations and regulations for a successful academic journey</p>
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
                        <a class="nav-link" href="#responsibilities">Responsibilities</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#code-of-conduct">Code of Conduct</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#examination">Examination</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#hostel">Hostel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#ict">ICT Policies</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#disciplinary">Disciplinary</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#reporting">Reporting</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        <!-- Important Disclaimer -->
        <section class="section-padding bg-light">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="disclaimer-box">
                            <h5><i class="fas fa-exclamation-triangle me-2"></i>Important Disclaimer</h5>
                            <p><strong>This page is an Orientation Summary for new students.</strong> It provides a simplified overview of student conduct expectations and is NOT the official Student Handbook or legal document. For complete, official policies, please refer to the NAUB Student Handbook available at the Student Affairs Office. In case of any discrepancy between this summary and the official handbook, the official handbook shall prevail.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Student Responsibilities Section -->
        <section id="responsibilities" class="section-padding">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <h2 class="section-title text-center">Student Responsibilities and Expectations</h2>
                        <p class="text-center text-muted mb-5">As a NAUB student, you are expected to uphold certain standards</p>
                        
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="policy-card">
                                    <div class="policy-icon blue">
                                        <i class="fas fa-graduation-cap"></i>
                                    </div>
                                    <h5>Academic Integrity</h5>
                                    <p>Maintain honesty in all academic pursuits. Submit original work, properly cite sources, and never engage in plagiarism or academic dishonesty of any kind.</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="policy-card">
                                    <div class="policy-icon green">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <h5>Respect for Others</h5>
                                    <p>Treat all members of the university community with dignity and respect. Embrace diversity and maintain professional relationships with peers and staff.</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="policy-card">
                                    <div class="policy-icon orange">
                                        <i class="fas fa-broom"></i>
                                    </div>
                                    <h5>Campus Cleanliness</h5>
                                    <p>Keep campus surroundings clean. Use designated waste disposal areas. Take pride in maintaining a hygienic and attractive learning environment.</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="policy-card">
                                    <div class="policy-icon purple">
                                        <i class="fas fa-chalkboard-teacher"></i>
                                    </div>
                                    <h5>Proper Conduct in Classes</h5>
                                    <p>Attend all classes punctually. Maintain proper behavior during lectures. Participate actively and contribute positively to academic discussions.</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mt-4">
                            <div class="col-lg-12">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body p-4">
                                        <h5 class="text-primary mb-3">
                                            <i class="fas fa-envelope me-2"></i>Communication Etiquette
                                        </h5>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <ul class="policy-list">
                                                    <li><i class="fas fa-check"></i>Use your official NAUB email for all formal communications</li>
                                                    <li><i class="fas fa-check"></i>Address staff and faculty with appropriate titles</li>
                                                    <li><i class="fas fa-check"></i>Respond to official communications promptly</li>
                                                </ul>
                                            </div>
                                            <div class="col-md-6">
                                                <ul class="policy-list">
                                                    <li><i class="fas fa-check"></i>Maintain professional tone in all communications</li>
                                                    <li><i class="fas fa-check"></i>Keep contact information updated in the student portal</li>
                                                    <li><i class="fas fa-check"></i>Follow proper channels for grievances</li>
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

        <!-- Code of Conduct Section -->
        <section id="code-of-conduct" class="section-padding bg-light">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <h2 class="section-title text-center">Code of Conduct Summary</h2>
                        <p class="text-center text-muted mb-5">General guidelines for behavior and appearance</p>
                        
                        <div class="row g-4 mb-5">
                            <div class="col-lg-12">
                                <div class="warning-box info">
                                    <h5><i class="fas fa-info-circle me-2"></i>General Behavior Expectations</h5>
                                    <p>All students are expected to conduct themselves in a manner that brings honor to themselves and the university. This includes maintaining high moral standards, exhibiting good character, and representing NAUB positively at all times - both on and off campus.</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="policy-card">
                                    <div class="policy-icon teal">
                                        <i class="fas fa-tshirt"></i>
                                    </div>
                                    <h5>Dress Code Requirements</h5>
                                    <p>NAUB maintains a military-inspired dress code emphasizing neatness and professionalism. Students should dress modestly and appropriately for an academic environment. Specific requirements may vary by faculty.</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="policy-card">
                                    <div class="policy-icon red">
                                        <i class="fas fa-ban"></i>
                                    </div>
                                    <h5>Prohibited Behaviors</h5>
                                    <p>Violence, harassment, bullying, substance abuse, theft, vandalism, and any form of discrimination are strictly prohibited and will result in disciplinary action.</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mt-4">
                            <div class="col-lg-12">
                                <div class="warning-box warning">
                                    <h5><i class="fas fa-camera me-2"></i>Social Media Conduct</h5>
                                    <p>Exercise discretion when using social media. Do not post content that could tarnish your reputation or the university's image. Avoid sharing confidential information or engaging in online behavior that could be considered harassment or defamation.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Examination Misconduct Section -->
        <section id="examination" class="section-padding">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <h2 class="section-title text-center">Anti-Examination Misconduct Policies</h2>
                        <p class="text-center text-muted mb-5">Maintaining academic integrity during examinations</p>
                        
                        <div class="warning-box danger">
                            <h5><i class="fas fa-exclamation-triangle me-2"></i>Zero Tolerance for Exam Cheating</h5>
                            <p>NAUB maintains a strict zero-tolerance policy towards all forms of examination misconduct. Consequences are severe and may result in automatic course failure, suspension, or expulsion.</p>
                        </div>
                        
                        <div class="row g-4 mt-3">
                            <div class="col-lg-12">
                                <div class="policy-table">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th><i class="fas fa-list-ol me-2"></i>Offense Type</th>
                                                <th><i class="fas fa-gavel me-2"></i>Penalties</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><strong>Possession of unauthorized materials</strong><br><small>Notes, phones, electronic devices in exam hall</small></td>
                                                <td><span class="badge bg-danger">Course Failure</span> + <span class="badge bg-warning text-dark">Written Warning</span></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Copying from other students</strong><br><small>Looking at or exchanging answers</small></td>
                                                <td><span class="badge bg-danger">Course Failure</span> + <span class="badge bg-warning text-dark">Written Warning</span></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Impersonation</strong><br><small>Taking exam for another or having someone take exam for you</small></td>
                                                <td><span class="badge bg-dark">Suspension (1 Semester)</span> + <span class="badge bg-danger">Expulsion</span> for impersonator</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Refusal to stop when instructed</strong><br><small>Continuing to write after time is called</small></td>
                                                <td><span class="badge bg-danger">Course Failure</span></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Repeat offense</strong><br><small>Any second examination misconduct</small></td>
                                                <td><span class="badge bg-dark">Suspension (1 Year)</span> or <span class="badge bg-danger">Expulsion</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row g-4 mt-4">
                            <div class="col-md-6">
                                <div class="policy-card">
                                    <div class="policy-icon green">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                    <h5>Items Allowed in Exam Hall</h5>
                                    <ul class="policy-list mt-3">
                                        <li><i class="fas fa-check"></i>Student ID Card (mandatory)</li>
                                        <li><i class="fas fa-check"></i>Writing materials (pens, pencils)</li>
                                        <li><i class="fas fa-check"></i>Calculator (if permitted)</li>
                                        <li><i class="fas fa-check"></i>Clear plastic bag for essentials</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="policy-card">
                                    <div class="policy-icon red">
                                        <i class="fas fa-times-circle"></i>
                                    </div>
                                    <h5>Items NOT Allowed</h5>
                                    <ul class="policy-list mt-3">
                                        <li class="danger"><i class="fas fa-times"></i>Mobile phones</li>
                                        <li class="danger"><i class="fas fa-times"></i>Smart watches</li>
                                        <li class="danger"><i class="fas fa-times"></i>Any electronic devices</li>
                                        <li class="danger"><i class="fas fa-times"></i>Unauthorized notes/books</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <div class="warning-box info mt-4">
                            <h5><i class="fas fa-eye me-2"></i>Report Suspicious Behavior</h5>
                            <p>If you witness examination misconduct, report it immediately to the invigilator or the Student Affairs Office. Your report will be treated with confidentiality. False reports, however, may result in disciplinary action.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Hostel Regulations Section -->
        <section id="hostel" class="section-padding bg-light">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <h2 class="section-title text-center">Hostel Regulations</h2>
                        <p class="text-center text-muted mb-5">Guidelines for on-campus accommodation</p>
                        
                        <div class="row g-4">
                            <div class="col-md-6 col-lg-4">
                                <div class="policy-card">
                                    <div class="policy-icon blue">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                    <h5>Curfew Hours</h5>
                                    <p>All hostel residents must be in their hostels by 10:00 PM on weekdays and 11:00 PM on weekends. Late entry requires special permission from the hostel warden.</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="policy-card">
                                    <div class="policy-icon green">
                                        <i class="fas fa-user-friends"></i>
                                    </div>
                                    <h5>Guest Policies</h5>
                                    <p>Visitors are not allowed in hostels without prior permission. Same-gender visitors may be permitted in designated areas during visiting hours only.</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="policy-card">
                                    <div class="policy-icon orange">
                                        <i class="fas fa-search"></i>
                                    </div>
                                    <h5>Room Inspections</h5>
                                    <p>Hostel management reserves the right to conduct routine inspections for safety and cleanliness. Inspections are announced in advance when possible.</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="policy-card">
                                    <div class="policy-icon purple">
                                        <i class="fas fa-volume-up"></i>
                                    </div>
                                    <h5>Noise Regulations</h5>
                                    <p>Maintain quiet hours from 9:00 PM to 7:00 AM. Excessive noise, loud music, or disturbances that affect other residents are prohibited.</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="policy-card">
                                    <div class="policy-icon red">
                                        <i class="fas fa-shield-alt"></i>
                                    </div>
                                    <h5>Safety Requirements</h5>
                                    <p>No candles, heaters, or cooking appliances in rooms. Report any electrical faults immediately. Keep doors locked when sleeping or leaving.</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="policy-card">
                                    <div class="policy-icon teal">
                                        <i class="fas fa-home"></i>
                                    </div>
                                    <h5>Room Care</h5>
                                    <p>Keep your room clean and well-maintained. You are responsible for any damage to university property beyond normal wear and tear.</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="warning-box danger mt-4">
                            <h5><i class="fas fa-exclamation-circle me-2"></i>Violation Consequences</h5>
                            <p>Hostel rule violations may result in: disciplinary warnings, fines, loss of hostel privileges, suspension from campus, or referral to the disciplinary committee depending on severity.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ICT Usage Policies Section -->
        <section id="ict" class="section-padding">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <h2 class="section-title text-center">ICT Usage Policies</h2>
                        <p class="text-center text-muted mb-5">Guidelines for responsible technology use</p>
                        
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="policy-card">
                                    <div class="policy-icon blue">
                                        <i class="fas fa-laptop-code"></i>
                                    </div>
                                    <h5>Acceptable Use Policy</h5>
                                    <p>University ICT facilities are for educational purposes only. Users must not engage in activities that are illegal, unethical, or that compromise the security of the network.</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="policy-card">
                                    <div class="policy-icon green">
                                        <i class="fas fa-wifi"></i>
                                    </div>
                                    <h5>WiFi Regulations</h5>
                                    <p>Use the campus WiFi responsibly. Do not attempt to bypass security measures, download copyrighted material, or engage in excessive bandwidth usage that affects others.</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="policy-card">
                                    <div class="policy-icon orange">
                                        <i class="fas fa-desktop"></i>
                                    </div>
                                    <h5>Computer Lab Rules</h5>
                                    <p>Follow lab etiquette: log out when finished, do not install software, report equipment faults immediately, and maintain silence in computing areas.</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="policy-card">
                                    <div class="policy-icon purple">
                                        <i class="fas fa-key"></i>
                                    </div>
                                    <h5>Password Security</h5>
                                    <p>Keep your passwords confidential. Change them regularly. Do not share accounts or use another student's credentials. You are responsible for all activities under your account.</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="warning-box danger mt-4">
                            <h5><i class="fas fa-ban me-2"></i>Consequences of Misuse</h5>
                            <p>ICT policy violations may result in: loss of network privileges, disciplinary action, suspension of computer access, referral to disciplinary committee, or legal action for serious offenses (e.g., hacking, cyberbullying, downloading illegal content).</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Disciplinary Procedures Section -->
        <section id="disciplinary" class="section-padding bg-light">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <h2 class="section-title text-center">Disciplinary Procedures</h2>
                        <p class="text-center text-muted mb-5">Understanding the student conduct review process</p>
                        
                        <div class="warning-box warning">
                            <h5><i class="fas fa-balance-scale me-2"></i>Due Process</h5>
                            <p>All students are entitled to fair hearing and due process. No disciplinary action will be taken without proper investigation. Students have the right to present their case and appeal decisions.</p>
                        </div>
                        
                        <!-- Disciplinary Flowchart -->
                        <div class="row mt-5">
                            <div class="col-lg-12">
                                <h4 class="text-center mb-4">Disciplinary Process Flow</h4>
                                <div class="row justify-content-center">
                                    <div class="col-md-4">
                                        <div class="flow-step">
                                            <h6><i class="fas fa-search me-2"></i>1. Investigation</h6>
                                            <p>Incident reported and investigated by Student Affairs</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="flow-step">
                                            <h6><i class="fas fa-comments me-2"></i>2. Hearing</h6>
                                            <p>Student invited to present case to disciplinary committee</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="flow-step">
                                            <h6><i class="fas fa-gavel me-2"></i>3. Decision</h6>
                                            <p>Committee deliberates and issues ruling</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="flow-step">
                                            <h6><i class="fas fa-envelope me-2"></i>4. Notification</h6>
                                            <p>Student informed of decision in writing</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="flow-step">
                                            <h6><i class="fas fa-undo me-2"></i>5. Appeal</h6>
                                            <p>Student may appeal within 14 days</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="flow-step">
                                            <h6><i class="fas fa-check-circle me-2"></i>6. Resolution</h6>
                                            <p>Final decision communicated and implemented</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Possible Sanctions -->
                        <div class="row g-4 mt-4">
                            <div class="col-lg-12">
                                <h4 class="mb-4">Possible Sanctions</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <ul class="policy-list">
                                            <li><i class="fas fa-exclamation"></i><strong>Written Warning</strong> - Formal notice for minor offenses</li>
                                            <li><i class="fas fa-exclamation"></i><strong>Fine</strong> - Monetary penalty for specific violations</li>
                                            <li><i class="fas fa-exclamation"></i><strong>Restitution</strong> - Compensation for damage or loss</li>
                                            <li><i class="fas fa-exclamation"></i><strong>Community Service</strong> - Mandatory service to the university</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <ul class="policy-list">
                                            <li class="danger"><i class="fas fa-times"></i><strong>Suspension</strong> - Temporary removal from the university</li>
                                            <li class="danger"><i class="fas fa-times"></i><strong>Expulsion</strong> - Permanent removal from the university</li>
                                            <li class="danger"><i class="fas fa-times"></i><strong>Degree Revocation</strong> - Withdrawal of previously awarded degree</li>
                                            <li class="danger"><i class="fas fa-times"></i><strong>Referral to Law Enforcement</strong> - For criminal offenses</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Appeal Process -->
                        <div class="warning-box info mt-4">
                            <h5><i class="fas fa-file-appeal me-2"></i>Appeal Process</h5>
                            <p>Students who wish to appeal a disciplinary decision must submit a written appeal to the Vice Chancellor's Office within <strong>14 days</strong> of receiving the decision. The appeal should clearly state the grounds for appeal and include any supporting documents. The decision of the appeal panel is final.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Reporting Channels Section -->
        <section id="reporting" class="section-padding">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <h2 class="section-title text-center">Reporting Channels for Issues</h2>
                        <p class="text-center text-muted mb-5">Know who to contact when you need help</p>
                        
                        <div class="row g-4 mb-5">
                            <div class="col-md-6 col-lg-4">
                                <div class="contact-card">
                                    <div class="contact-icon" style="background: #e8f4f8; color: #1e3c72;">
                                        <i class="fas fa-user-friends"></i>
                                    </div>
                                    <div class="contact-details">
                                        <h6>Course Representative</h6>
                                        <p>First point of contact for class-related issues</p>
                                        <p class="mb-0 text-muted">Contact your elected course rep</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="contact-card">
                                    <div class="contact-icon" style="background: #e8f6f3; color: #27ae60;">
                                        <i class="fas fa-user-tie"></i>
                                    </div>
                                    <div class="contact-details">
                                        <h6>Head of Department</h6>
                                        <p>For academic and departmental concerns</p>
                                        <p class="mb-0 text-muted">Visit your department office</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="contact-card">
                                    <div class="contact-icon" style="background: #fef5e7; color: #e67e22;">
                                        <i class="fas fa-building"></i>
                                    </div>
                                    <div class="contact-details">
                                        <h6>Student Affairs Office</h6>
                                        <p>For all student welfare and conduct matters</p>
                                        <p class="mb-0 text-muted">Main Admin Block, Room 101</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="contact-card">
                                    <div class="contact-icon" style="background: #f5eef8; color: #8e44ad;">
                                        <i class="fas fa-user-secret"></i>
                                    </div>
                                    <div class="contact-details">
                                        <h6>Anonymous Reporting</h6>
                                        <p>Report concerns anonymously through suggestion boxes</p>
                                        <p class="mb-0 text-muted">Located in main buildings</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="contact-card">
                                    <div class="contact-icon" style="background: #fdedec; color: #e74c3c;">
                                        <i class="fas fa-shield-alt"></i>
                                    </div>
                                    <div class="contact-details">
                                        <h6>Security Office</h6>
                                        <p>For safety and security concerns</p>
                                        <p class="mb-0 text-muted">Main Gate, 24/7</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="contact-card">
                                    <div class="contact-icon" style="background: #e8f4f4; color: #1abc9c;">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div class="contact-details">
                                        <h6>Guidance & Counseling</h6>
                                        <p>For personal and emotional concerns</p>
                                        <p class="mb-0 text-muted">Student Affairs Office</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Emergency Contacts -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="warning-box danger">
                                    <h5><i class="fas fa-phone-volume me-2"></i>Emergency Contacts</h5>
                                    <div class="row mt-3">
                                        <div class="col-md-4">
                                            <p class="mb-1"><strong>Security Emergency:</strong></p>
                                            <p class="mb-0">+234 XXX XXXX (24/7)</p>
                                        </div>
                                        <div class="col-md-4">
                                            <p class="mb-1"><strong>Medical Emergency:</strong></p>
                                            <p class="mb-0">+234 XXX XXXX</p>
                                        </div>
                                        <div class="col-md-4">
                                            <p class="mb-1"><strong>Student Affairs:</strong></p>
                                            <p class="mb-0">+234 XXX XXXX</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Reporting Tips -->
                        <div class="warning-box success mt-4">
                            <h5><i class="fas fa-lightbulb me-2"></i>Tips for Effective Reporting</h5>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <ul class="policy-list">
                                        <li><i class="fas fa-check"></i>Be specific about the incident (who, what, when, where)</li>
                                        <li><i class="fas fa-check"></i>Provide accurate contact information for follow-up</li>
                                        <li><i class="fas fa-check"></i>Report as soon as possible after the incident</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="policy-list">
                                        <li><i class="fas fa-check"></i>Preserve any evidence if safe to do so</li>
                                        <li><i class="fas fa-check"></i>Your report will be treated with confidentiality</li>
                                        <li><i class="fas fa-check"></i>False reporting has serious consequences</li>
                                    </ul>
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
                        <h2 class="mb-3">Questions About Conduct Policies?</h2>
                        <p class="mb-4 opacity-75">Contact the Student Affairs Office for clarification</p>
                        <div class="d-flex gap-3 justify-content-center flex-wrap">
                            <a href="<?php echo BASE_URL; ?>/contact.php" class="btn btn-light-custom">
                                <i class="fas fa-envelope me-2"></i>Contact Us
                            </a>
                            <a href="<?php echo BASE_URL; ?>/checklist.php" class="btn btn-outline-custom">
                                <i class="fas fa-check-square me-2"></i>Student Checklist
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
