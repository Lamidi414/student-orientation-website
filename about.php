<?php
/**
 * About NAUB Page
 * Nigerian Army University, Biu - Orientation Portal
 */

// Page configuration
$page_title = 'About NAUB';
$page_description = 'Learn about the Nigerian Army University, Biu - history, mission, vision, and academic structure';

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
        .about-hero {
            background: linear-gradient(135deg, #1a5276 0%, #2980b9 100%);
            color: white;
            padding: 80px 0;
            position: relative;
            overflow: hidden;
        }
        
        .about-hero::before {
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
            background: #1a5276;
        }
        
        .section-title.text-start::after {
            left: 0;
            transform: none;
        }
        
        .history-card {
            border-left: 4px solid #1a5276;
            background: #f8f9fa;
            padding: 25px;
            border-radius: 0 8px 8px 0;
        }
        
        .mission-box {
            background: linear-gradient(135deg, #1a5276 0%, #2980b9 100%);
            color: white;
            padding: 40px;
            border-radius: 12px;
            text-align: center;
        }
        
        .vision-box {
            background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);
            color: white;
            padding: 40px;
            border-radius: 12px;
            text-align: center;
        }
        
        .value-card {
            background: white;
            border: none;
            border-radius: 12px;
            padding: 30px 20px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
        }
        
        .value-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        
        .value-icon {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 28px;
        }
        
        .value-discipline { background: #e8f4f8; color: #1a5276; }
        .value-excellence { background: #fef9e7; color: #d4ac0d; }
        .value-integrity { background: #e8f6f3; color: #27ae60; }
        .value-innovation { background: #f5eef8; color: #8e44ad; }
        .value-service { background: #fdebd0; color: #e67e22; }
        
        .faculty-card {
            background: white;
            border: none;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
        }
        
        .faculty-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        
        .faculty-header {
            background: linear-gradient(135deg, #1a5276 0%, #2980b9 100%);
            color: white;
            padding: 20px;
            text-align: center;
        }
        
        .faculty-body {
            padding: 20px;
        }
        
        .dept-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .dept-list li {
            padding: 8px 0;
            border-bottom: 1px solid #eee;
            display: flex;
            align-items: center;
        }
        
        .dept-list li:last-child {
            border-bottom: none;
        }
        
        .dept-list li i {
            color: #1a5276;
            margin-right: 10px;
            font-size: 12px;
        }
        
        .campus-feature {
            text-align: center;
            padding: 30px 20px;
        }
        
        .campus-feature-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: #e8f4f8;
            color: #1a5276;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 32px;
        }
        
        .org-chart {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 12px;
        }
        
        .org-level {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .org-box {
            display: inline-block;
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: 600;
        }
        
        .org-vc {
            background: #1a5276;
            color: white;
        }
        
        .org-dean {
            background: #2980b9;
            color: white;
        }
        
        .org-hod {
            background: #5dade2;
            color: white;
        }
        
        .org-arrow {
            color: #1a5276;
            font-size: 24px;
            margin: 5px 0;
        }
        
        .quick-links-section {
            background: linear-gradient(135deg, #1a5276 0%, #2980b9 100%);
            color: white;
        }
        
        .quick-link-btn {
            display: inline-flex;
            align-items: center;
            padding: 15px 30px;
            background: white;
            color: #1a5276;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .quick-link-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.2);
            color: #1a5276;
        }
        
        .quick-link-btn i {
            margin-right: 10px;
            font-size: 20px;
        }
        
        .stats-section {
            background: #f8f9fa;
        }
        
        .stat-item {
            text-align: center;
            padding: 20px;
        }
        
        .stat-number {
            font-size: 42px;
            font-weight: 700;
            color: #1a5276;
            line-height: 1;
        }
        
        .stat-label {
            color: #666;
            font-size: 14px;
            margin-top: 5px;
        }
        
        @media (max-width: 768px) {
            .about-hero {
                padding: 50px 0;
            }
            
            .section-padding {
                padding: 40px 0;
            }
            
            .mission-box, .vision-box {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <?php include __DIR__ . '/includes/header.php'; ?>

    <!-- Hero Section -->
    <section class="about-hero">
        <div class="container position-relative">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h1 class="display-4 fw-bold mb-3">About NAUB</h1>
                    <p class="lead mb-0">Nigerian Army University, Biu</p>
                    <p class="small mt-2 opacity-75">Excellence in Military and Civilian Education</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Quick Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-2">
        <div class="container">
            <div class="collapse navbar-collapse justify-content-center">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link" href="#history">History</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#mission-vision">Mission & Vision</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#values">Core Values</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#faculties">Faculties</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#campus">Campus</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#quick-links">Quick Links</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        <!-- History Section -->
        <section id="history" class="section-padding">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <h2 class="section-title text-center">University History</h2>
                        
                        <div class="history-card mb-4">
                            <h4 class="text-primary mb-3"><i class="fas fa-university me-2"></i>Establishment & Background</h4>
                            <p class="mb-0">
                                The <strong>Nigerian Army University, Biu (NAUB)</strong> was established by the Federal Government of Nigeria 
                                to provide quality higher education in arts, sciences, management, and technology. The university was formally 
                                established in <strong>2018</strong> and began academic activities in <strong>2020</strong>, making it one of the 
                                newest universities in Nigeria.
                            </p>
                        </div>
                        
                        <div class="row mt-4">
                            <div class="col-md-6 mb-3">
                                <h5><i class="fas fa-shield-alt text-primary me-2"></i>Role in Military Education</h5>
                                <p>
                                    NAUB serves as a center for military academic excellence, providing military personnel with opportunities 
                                    for higher education while also admitting civilian students. The university aims to produce graduates 
                                    who are well-equipped with both theoretical knowledge and practical skills relevant to national development.
                                </p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <h5><i class="fas fa-users text-primary me-2"></i>Commitment to Civilian Education</h5>
                                <p>
                                    Beyond military education, NAUB is committed to providing accessible quality education to Nigerian citizens. 
                                    The university admits students from all backgrounds, fostering an environment of diversity and inclusivity 
                                    while maintaining high academic standards.
                                </p>
                            </div>
                        </div>
                        
                        <div class="alert alert-info border-0 mt-4" style="background: #e8f4f8;">
                            <h5 class="alert-heading"><i class="fas fa-info-circle me-2"></i>Key Milestones</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="mb-0">
                                        <li>2018 - University Established</li>
                                        <li>2020 - First Academic Session Began</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="mb-0">
                                        <li>2021 - First Set of Graduates</li>
                                        <li>Present - Growing Academic Programs</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Mission & Vision Section -->
        <section id="mission-vision" class="section-padding bg-light">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <h2 class="section-title text-center">Mission & Vision</h2>
                        
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="mission-box">
                                    <i class="fas fa-bullseye fa-3x mb-3"></i>
                                    <h3 class="h4 mb-3">Our Mission</h3>
                                    <p class="mb-0">
                                        To provide quality education through innovative teaching, research, and community service, 
                                        producing graduates who are well-equipped with knowledge, skills, and character to contribute 
                                        meaningfully to national development and global challenges.
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="vision-box">
                                    <i class="fas fa-eye fa-3x mb-3"></i>
                                    <h3 class="h4 mb-3">Our Vision</h3>
                                    <p class="mb-0">
                                        To become a world-class university recognized for academic excellence, innovation, 
                                        and producing graduates who are leaders in their respective fields, while maintaining 
                                        the core values of discipline, integrity, and service to humanity.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Core Values Section -->
        <section id="values" class="section-padding">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <h2 class="section-title text-center">Core Values</h2>
                        <p class="text-center mb-5">The principles that guide everything we do at NAUB</p>
                        
                        <div class="row g-4">
                            <div class="col-md-4 col-sm-6">
                                <div class="value-card">
                                    <div class="value-icon value-discipline">
                                        <i class="fas fa-flag"></i>
                                    </div>
                                    <h5>Discipline</h5>
                                    <p class="text-muted mb-0">We uphold the highest standards of conduct and self-control, fostering an environment of order and respect.</p>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="value-card">
                                    <div class="value-icon value-excellence">
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <h5>Excellence</h5>
                                    <p class="text-muted mb-0">We strive for outstanding performance in all academic and operational endeavors, never settling for mediocrity.</p>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="value-card">
                                    <div class="value-icon value-integrity">
                                        <i class="fas fa-handshake"></i>
                                    </div>
                                    <h5>Integrity</h5>
                                    <p class="text-muted mb-0">We maintain honesty, transparency, and ethical conduct in all our interactions and decisions.</p>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="value-card">
                                    <div class="value-icon value-innovation">
                                        <i class="fas fa-lightbulb"></i>
                                    </div>
                                    <h5>Innovation</h5>
                                    <p class="text-muted mb-0">We embrace creativity and forward-thinking to solve challenges and advance knowledge.</p>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="value-card">
                                    <div class="value-icon value-service">
                                        <i class="fas fa-hands-helping"></i>
                                    </div>
                                    <h5>Service</h5>
                                    <p class="text-muted mb-0">We are committed to serving our students, community, and nation with dedication and compassion.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Faculties Section -->
        <section id="faculties" class="section-padding bg-light">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <h2 class="section-title text-center">Our Faculties</h2>
                        <p class="text-center mb-5">NAUB comprises six faculties offering diverse academic programs</p>
                        
                        <div class="row g-4">
                            <!-- Faculty of Arts -->
                            <div class="col-lg-6">
                                <div class="faculty-card">
                                    <div class="faculty-header">
                                        <i class="fas fa-palette fa-2x mb-2"></i>
                                        <h5 class="mb-0">Faculty of Arts</h5>
                                    </div>
                                    <div class="faculty-body">
                                        <p class="text-muted mb-3">Exploring human expression, culture, and communication through diverse disciplines.</p>
                                        <ul class="dept-list">
                                            <li><i class="fas fa-caret-right"></i> English Language</li>
                                            <li><i class="fas fa-caret-right"></i> History & International Studies</li>
                                            <li><i class="fas fa-caret-right"></i> Linguistics</li>
                                            <li><i class="fas fa-caret-right"></i> Philosophy</li>
                                            <li><i class="fas fa-caret-right"></i> Religious Studies</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Faculty of Management and Social Sciences -->
                            <div class="col-lg-6">
                                <div class="faculty-card">
                                    <div class="faculty-header">
                                        <i class="fas fa-briefcase fa-2x mb-2"></i>
                                        <h5 class="mb-0">Faculty of Management & Social Sciences</h5>
                                    </div>
                                    <div class="faculty-body">
                                        <p class="text-muted mb-3">Developing leaders and professionals for business and society.</p>
                                        <ul class="dept-list">
                                            <li><i class="fas fa-caret-right"></i> Accounting</li>
                                            <li><i class="fas fa-caret-right"></i> Business Administration</li>
                                            <li><i class="fas fa-caret-right"></i> Economics</li>
                                            <li><i class="fas fa-caret-right"></i> Political Science</li>
                                            <li><i class="fas fa-caret-right"></i> Sociology</li>
                                            <li><i class="fas fa-caret-right"></i> Psychology</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Faculty of Natural and Applied Sciences -->
                            <div class="col-lg-6">
                                <div class="faculty-card">
                                    <div class="faculty-header">
                                        <i class="fas fa-flask fa-2x mb-2"></i>
                                        <h5 class="mb-0">Faculty of Natural & Applied Sciences</h5>
                                    </div>
                                    <div class="faculty-body">
                                        <p class="text-muted mb-3">Advancing scientific knowledge and technological innovation.</p>
                                        <ul class="dept-list">
                                            <li><i class="fas fa-caret-right"></i> Chemistry</li>
                                            <li><i class="fas fa-caret-right"></i> Physics</li>
                                            <li><i class="fas fa-caret-right"></i> Mathematics</li>
                                            <li><i class="fas fa-caret-right"></i> Statistics</li>
                                            <li><i class="fas fa-caret-right"></i> Biology</li>
                                            <li><i class="fas fa-caret-right"></i> Biochemistry</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Faculty of Computing -->
                            <div class="col-lg-6">
                                <div class="faculty-card">
                                    <div class="faculty-header">
                                        <i class="fas fa-laptop-code fa-2x mb-2"></i>
                                        <h5 class="mb-0">Faculty of Computing</h5>
                                    </div>
                                    <div class="faculty-body">
                                        <p class="text-muted mb-3">Preparing students for the digital age through cutting-edge technology education.</p>
                                        <ul class="dept-list">
                                            <li><i class="fas fa-caret-right"></i> Computer Science</li>
                                            <li><i class="fas fa-caret-right"></i> Information Systems</li>
                                            <li><i class="fas fa-caret-right"></i> Software Engineering</li>
                                            <li><i class="fas fa-caret-right"></i> Cyber Security</li>
                                            <li><i class="fas fa-caret-right"></i> Information Technology</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Faculty of Engineering Technology -->
                            <div class="col-lg-6">
                                <div class="faculty-card">
                                    <div class="faculty-header">
                                        <i class="fas fa-cogs fa-2x mb-2"></i>
                                        <h5 class="mb-0">Faculty of Engineering Technology</h5>
                                    </div>
                                    <div class="faculty-body">
                                        <p class="text-muted mb-3">Building engineers who will shape the future of infrastructure and technology.</p>
                                        <ul class="dept-list">
                                            <li><i class="fas fa-caret-right"></i> Electrical Engineering</li>
                                            <li><i class="fas fa-caret-right"></i> Mechanical Engineering</li>
                                            <li><i class="fas fa-caret-right"></i> Civil Engineering</li>
                                            <li><i class="fas fa-caret-right"></i> Chemical Engineering</li>
                                            <li><i class="fas fa-caret-right"></i> Agricultural Engineering</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Faculty of Environmental Sciences -->
                            <div class="col-lg-6">
                                <div class="faculty-card">
                                    <div class="faculty-header">
                                        <i class="fas fa-tree fa-2x mb-2"></i>
                                        <h5 class="mb-0">Faculty of Environmental Sciences</h5>
                                    </div>
                                    <div class="faculty-body">
                                        <p class="text-muted mb-3">Creating sustainable solutions for our built and natural environments.</p>
                                        <ul class="dept-list">
                                            <li><i class="fas fa-caret-right"></i> Architecture</li>
                                            <li><i class="fas fa-caret-right"></i> Urban & Regional Planning</li>
                                            <li><i class="fas fa-caret-right"></i> Estate Management</li>
                                            <li><i class="fas fa-caret-right"></i> Geography</li>
                                            <li><i class="fas fa-caret-right"></i> Environmental Management</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Campus Structure Section -->
        <section id="campus" class="section-padding">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <h2 class="section-title text-center">Campus Structure</h2>
                        
                        <!-- Location -->
                        <div class="row mb-5">
                            <div class="col-lg-6 mb-4 mb-lg-0">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-body p-4">
                                        <h4 class="text-primary mb-3">
                                            <i class="fas fa-map-marker-alt me-2"></i>Main Campus Location
                                        </h4>
                                        <p class="mb-2"><strong>Nigerian Army University, Biu</strong></p>
                                        <p class="mb-2">Biu, Borno State, Nigeria</p>
                                        <p class="text-muted mb-0">
                                            The university is strategically located in Biu, a town in southern Borno State. 
                                            The campus spans a vast area with modern facilities designed to provide an 
                                            excellent learning environment for students.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row g-3">
                                    <div class="col-6">
                                        <div class="campus-feature">
                                            <div class="campus-feature-icon">
                                                <i class="fas fa-building"></i>
                                            </div>
                                            <h6>Academic Blocks</h6>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="campus-feature">
                                            <div class="campus-feature-icon">
                                                <i class="fas fa-book"></i>
                                            </div>
                                            <h6>Library</h6>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="campus-feature">
                                            <div class="campus-feature-icon">
                                                <i class="fas fa-bed"></i>
                                            </div>
                                            <h6>Hostels</h6>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="campus-feature">
                                            <div class="campus-feature-icon">
                                                <i class="fas fa-futbol"></i>
                                            </div>
                                            <h6>Sports Complex</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Organizational Structure -->
                        <div class="row">
                            <div class="col-12">
                                <h4 class="text-primary mb-4">
                                    <i class="fas fa-sitemap me-2"></i>Organizational Structure
                                </h4>
                                <div class="org-chart">
                                    <div class="org-level">
                                        <div class="org-box org-vc">
                                            <i class="fas fa-user-tie me-2"></i>Vice Chancellor
                                        </div>
                                    </div>
                                    <div class="org-arrow">
                                        <i class="fas fa-chevron-down"></i>
                                    </div>
                                    <div class="org-level">
                                        <div class="org-box org-dean">
                                            <i class="fas fa-users me-2"></i>Deans of Faculties
                                        </div>
                                    </div>
                                    <div class="org-arrow">
                                        <i class="fas fa-chevron-down"></i>
                                    </div>
                                    <div class="org-level">
                                        <div class="org-box org-hod">
                                            <i class="fas fa-user me-2"></i>Heads of Departments
                                        </div>
                                    </div>
                                    <div class="org-arrow">
                                        <i class="fas fa-chevron-down"></i>
                                    </div>
                                    <div class="org-level">
                                        <div class="org-box org-hod">
                                            <i class="fas fa-graduation-cap me-2"></i>Lecturers & Students
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="alert alert-info border-0 mt-4" style="background: #e8f4f8;">
                                    <h5 class="alert-heading"><i class="fas fa-info-circle me-2"></i>Additional Administrative Units</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <ul class="mb-0">
                                                <li>Registrar</li>
                                                <li>Bursar</li>
                                                <li>Librarian</li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6">
                                            <ul class="mb-0">
                                                <li>Dean of Students</li>
                                                <li>Director of Sports</li>
                                                <li>Head of Security</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Quick Links Section -->
        <section id="quick-links" class="section-padding quick-links-section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10 text-center">
                        <h2 class="mb-4">Quick Links</h2>
                        <p class="mb-5 opacity-75">Access important NAUB resources and portals</p>
                        
                        <div class="row g-4 justify-content-center">
                            <div class="col-md-5">
                                <a href="https://www.naub.edu.ng" target="_blank" class="quick-link-btn">
                                    <i class="fas fa-globe"></i>
                                    Official Website
                                    <span class="ms-2">naub.edu.ng</span>
                                </a>
                            </div>
                            <div class="col-md-5">
                                <a href="https://my.naub.edu.ng" target="_blank" class="quick-link-btn">
                                    <i class="fas fa-user-circle"></i>
                                    Student Portal
                                    <span class="ms-2">my.naub.edu.ng</span>
                                </a>
                            </div>
                        </div>
                        
                        <div class="mt-5 pt-3 border-top border-light">
                            <div class="row g-4">
                                <div class="col-md-4">
                                    <div class="text-center">
                                        <i class="fas fa-envelope fa-2x mb-2"></i>
                                        <p class="mb-0">info@naub.edu.ng</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="text-center">
                                        <i class="fas fa-phone fa-2x mb-2"></i>
                                        <p class="mb-0">+234 800 NAUB UNI</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="text-center">
                                        <i class="fas fa-map-marker-alt fa-2x mb-2"></i>
                                        <p class="mb-0">Biu, Borno State</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="section-padding bg-white">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h2 class="mb-3">Ready to Begin Your Journey at NAUB?</h2>
                        <p class="mb-4">Explore our orientation portal to learn everything you need to know as a new student.</p>
                        <div class="d-flex gap-3 justify-content-center flex-wrap">
                            <a href="<?php echo BASE_URL; ?>/checklist.php" class="btn btn-primary btn-lg">
                                <i class="fas fa-check-square me-2"></i>New Student Checklist
                            </a>
                            <a href="<?php echo BASE_URL; ?>/page.php?slug=registration" class="btn btn-outline-primary btn-lg">
                                <i class="fas fa-clipboard-list me-2"></i>Registration Guide
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
