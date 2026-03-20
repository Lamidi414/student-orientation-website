<?php
/**
 * Academic Guide Page
 * Nigerian Army University, Biu - Orientation Portal
 */

// Page configuration
$page_title = 'Academic Guide';
$page_description = 'Your complete academic guide at NAUB - grading system, calendar, registration, and more';

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
        .academic-hero {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 50%, #1e3c72 100%);
            color: white;
            padding: 100px 0;
            position: relative;
            overflow: hidden;
        }
        
        .academic-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="30" fill="none" stroke="rgba(255,255,255,0.08)" stroke-width="0.5"/></svg>');
            background-size: 150px 150px;
        }
        
        .academic-hero .display-4 {
            font-weight: 700;
            margin-bottom: 1rem;
        }
        
        .academic-hero .lead {
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
        
        /* Grade Table Styles */
        .grade-table {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }
        
        .grade-table thead th {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            padding: 15px;
            font-weight: 600;
            border: none;
        }
        
        .grade-table tbody tr {
            transition: background 0.3s ease;
        }
        
        .grade-table tbody tr:hover {
            background: #f8f9fa;
        }
        
        .grade-table td {
            padding: 15px;
            vertical-align: middle;
        }
        
        .grade-badge {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
        }
        
        .grade-a { background: #d4edda; color: #155724; }
        .grade-b { background: #cce5ff; color: #004085; }
        .grade-c { background: #fff3cd; color: #856404; }
        .grade-d { background: #f8d7da; color: #721c24; }
        .grade-e { background: #e2e3e5; color: #383d41; }
        .grade-f { background: #f5c6cb; color: #721c24; }
        
        /* Degree Classification Colors */
        .classification-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
        }
        
        .classification-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.12);
        }
        
        .classification-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            font-size: 24px;
        }
        
        .classification-card h5 {
            color: #1e3c72;
            margin-bottom: 8px;
            font-weight: 600;
        }
        
        .classification-card .cgpa-range {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 5px;
        }
        
        .classification-card .description {
            color: #888;
            font-size: 0.85rem;
        }
        
        /* Timeline Styles */
        .academic-timeline {
            position: relative;
            padding: 20px 0;
        }
        
        .academic-timeline::before {
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
            .academic-timeline::before {
                left: 20px;
            }
        }
        
        .timeline-event {
            position: relative;
            margin-bottom: 30px;
            width: 50%;
        }
        
        .timeline-event:nth-child(odd) {
            padding-right: 40px;
            text-align: right;
        }
        
        .timeline-event:nth-child(even) {
            padding-left: 40px;
            margin-left: 50%;
        }
        
        @media (max-width: 768px) {
            .timeline-event {
                width: 100%;
                padding-left: 50px !important;
                padding-right: 0 !important;
                text-align: left !important;
                margin-left: 0 !important;
            }
        }
        
        .timeline-marker {
            position: absolute;
            width: 40px;
            height: 40px;
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
        
        .timeline-event:nth-child(odd) .timeline-marker {
            right: -20px;
        }
        
        .timeline-event:nth-child(even) .timeline-marker {
            left: -20px;
        }
        
        @media (max-width: 768px) {
            .timeline-marker {
                left: 0 !important;
                right: auto !important;
            }
        }
        
        .timeline-content {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }
        
        .timeline-content h5 {
            color: #1e3c72;
            margin-bottom: 8px;
            font-weight: 600;
            font-size: 1.1rem;
        }
        
        .timeline-content .date {
            color: #e67e22;
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 8px;
        }
        
        .timeline-content p {
            color: #666;
            margin-bottom: 0;
            font-size: 0.9rem;
        }
        
        /* Warning Boxes */
        .warning-box {
            background: #fff3cd;
            border: none;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            border-left: 4px solid #ffc107;
        }
        
        .warning-box.danger {
            background: #f8d7da;
            border-left-color: #dc3545;
        }
        
        .warning-box.info {
            background: #cce5ff;
            border-left-color: #007bff;
        }
        
        .warning-box.success {
            background: #d4edda;
            border-left-color: #28a745;
        }
        
        .warning-box h5 {
            color: #333;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }
        
        .warning-box h5 i {
            margin-right: 10px;
        }
        
        .warning-box p {
            color: #555;
            margin-bottom: 0;
        }
        
        /* Info Cards */
        .info-box {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            height: 100%;
            transition: transform 0.3s ease;
        }
        
        .info-box:hover {
            transform: translateY(-3px);
        }
        
        .info-box-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
            font-size: 20px;
        }
        
        .info-box h5 {
            color: #1e3c72;
            margin-bottom: 10px;
            font-weight: 600;
        }
        
        .info-box p {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 0;
        }
        
        /* Requirements List */
        .requirements-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .requirements-list li {
            padding: 12px 15px;
            background: #f8f9fa;
            border-radius: 8px;
            margin-bottom: 10px;
            display: flex;
            align-items: flex-start;
            transition: background 0.3s ease;
        }
        
        .requirements-list li:hover {
            background: #e8f4f8;
        }
        
        .requirements-list li i {
            color: #27ae60;
            margin-right: 12px;
            margin-top: 3px;
        }
        
        /* Support Cards */
        .support-card {
            background: white;
            border-radius: 12px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
        }
        
        .support-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.12);
        }
        
        .support-icon {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 28px;
        }
        
        .support-card h5 {
            color: #333;
            margin-bottom: 10px;
            font-weight: 600;
        }
        
        .support-card p {
            color: #666;
            margin-bottom: 15px;
            font-size: 0.9rem;
        }
        
        .support-card a {
            color: #1e3c72;
            font-weight: 600;
            text-decoration: none;
        }
        
        .support-card a:hover {
            text-decoration: underline;
        }
        
        /* Quick Nav */
        .quick-nav {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            position: sticky;
            top: 70px;
            z-index: 100;
        }
        
        .quick-nav .nav-pills .nav-link {
            color: #666;
            font-weight: 500;
            padding: 12px 20px;
            border-radius: 0;
        }
        
        .quick-nav .nav-pills .nav-link:hover {
            color: #1e3c72;
            background: #f8f9fa;
        }
        
        .quick-nav .nav-pills .nav-link.active {
            background: #1e3c72;
            color: white;
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
        
        .btn-accent {
            background: white;
            color: #1e3c72;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .btn-accent:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.2);
            color: #1e3c72;
        }
        
        .btn-outline-accent {
            background: transparent;
            color: white;
            border: 2px solid white;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-outline-accent:hover {
            background: white;
            color: #1e3c72;
        }
        
        @media (max-width: 768px) {
            .academic-hero {
                padding: 60px 0;
            }
            
            .section-padding {
                padding: 50px 0;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <?php include __DIR__ . '/includes/header.php'; ?>

    <!-- Hero Section -->
    <section class="academic-hero">
        <div class="container position-relative">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <div class="mb-4">
                        <i class="fas fa-book-open fa-4x"></i>
                    </div>
                    <h1 class="display-4 fw-bold mb-3">Academic Guide</h1>
                    <p class="lead mb-4">Your Path to Success - Everything you need to know about academics at NAUB</p>
                    <p class="opacity-75 mb-0">Nigerian Army University, Biu - Excellence in Academic Pursuit</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Quick Navigation -->
    <nav class="quick-nav py-2">
        <div class="container">
            <div class="collapse navbar-collapse justify-content-center">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link" href="#grading">Grading System</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#calendar">Academic Calendar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#registration">Registration</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#attendance">Attendance</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#examinations">Examinations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#department">Department</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#support">Support</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        <!-- Grading System Section -->
        <section id="grading" class="section-padding bg-light">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <h2 class="section-title text-center">Grading System Overview</h2>
                        <p class="text-center text-muted mb-5">Understanding how your academic performance is measured at NAUB</p>
                        
                        <!-- Grade Point Scale -->
                        <div class="row mb-5">
                            <div class="col-lg-12">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body p-4">
                                        <h4 class="text-primary mb-4">
                                            <i class="fas fa-graduation-cap me-2"></i>Grade Point Scale
                                        </h4>
                                        <div class="table-responsive">
                                            <table class="grade-table table mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>Grade</th>
                                                        <th>Points</th>
                                                        <th>Percentage</th>
                                                        <th>Description</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><span class="grade-badge grade-a">A</span></td>
                                                        <td><strong>5</strong></td>
                                                        <td>70 - 100%</td>
                                                        <td>Excellent - Outstanding performance</td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="grade-badge grade-b">B</span></td>
                                                        <td><strong>4</strong></td>
                                                        <td>60 - 69%</td>
                                                        <td>Very Good - Above average performance</td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="grade-badge grade-c">C</span></td>
                                                        <td><strong>3</strong></td>
                                                        <td>50 - 59%</td>
                                                        <td>Good - Satisfactory performance</td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="grade-badge grade-d">D</span></td>
                                                        <td><strong>2</strong></td>
                                                        <td>45 - 49%</td>
                                                        <td>Pass - Marginal performance</td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="grade-badge grade-e">E</span></td>
                                                        <td><strong>1</strong></td>
                                                        <td>40 - 44%</td>
                                                        <td>Pass - Minimum pass</td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="grade-badge grade-f">F</span></td>
                                                        <td><strong>0</strong></td>
                                                        <td>0 - 39%</td>
                                                        <td>Fail - Unsatisfactory performance</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- CGPA Calculation -->
                        <div class="row mb-5">
                            <div class="col-lg-12">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body p-4">
                                        <h4 class="text-primary mb-4">
                                            <i class="fas fa-calculator me-2"></i>CGPA Calculation
                                        </h4>
                                        <p class="text-muted mb-4">Your Cumulative Grade Point Average (CGPA) is calculated as follows:</p>
                                        
                                        <div class="warning-box info">
                                            <h5><i class="fas fa-lightbulb"></i>CGPA Formula</h5>
                                            <p><strong>CGPA = Total Quality Points ÷ Total Credit Hours</strong></p>
                                            <p class="mb-0 mt-2">Quality Points = Grade Point × Credit Hours for the Course</p>
                                        </div>
                                        
                                        <div class="row mt-4">
                                            <div class="col-md-6">
                                                <h6 class="text-primary mb-3">Example Calculation:</h6>
                                                <table class="table table-sm table-bordered">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th>Course</th>
                                                            <th>Credits</th>
                                                            <th>Grade</th>
                                                            <th>Points</th>
                                                            <th>Quality Pts</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>Course A</td>
                                                            <td>3</td>
                                                            <td>A</td>
                                                            <td>5</td>
                                                            <td>15</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Course B</td>
                                                            <td>4</td>
                                                            <td>B</td>
                                                            <td>4</td>
                                                            <td>16</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Course C</td>
                                                            <td>2</td>
                                                            <td>C</td>
                                                            <td>3</td>
                                                            <td>6</td>
                                                        </tr>
                                                        <tr class="table-primary">
                                                            <td colspan="4"><strong>Total</strong></td>
                                                            <td><strong>37</strong></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="text-primary mb-3">Result:</h6>
                                                <div class="p-3 bg-light rounded">
                                                    <p class="mb-1"><strong>Total Quality Points:</strong> 37</p>
                                                    <p class="mb-1"><strong>Total Credit Hours:</strong> 9</p>
                                                    <p class="mb-0"><strong>CGPA:</strong> 37 ÷ 9 = <strong>4.11</strong></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Degree Classification -->
                        <div class="row mb-5">
                            <div class="col-lg-12">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body p-4">
                                        <h4 class="text-primary mb-4">
                                            <i class="fas fa-award me-2"></i>Classification of Degrees
                                        </h4>
                                        <p class="text-muted mb-4">Your final degree classification is based on your cumulative CGPA:</p>
                                        
                                        <div class="row g-4">
                                            <div class="col-md-4 col-sm-6">
                                                <div class="classification-card">
                                                    <div class="classification-icon" style="background: #d4edda; color: #28a745;">
                                                        <i class="fas fa-trophy"></i>
                                                    </div>
                                                    <h5>First Class</h5>
                                                    <p class="cgpa-range">CGPA: 4.50 - 5.00</p>
                                                    <p class="description">Highest distinction</p>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-6">
                                                <div class="classification-card">
                                                    <div class="classification-icon" style="background: #cce5ff; color: #007bff;">
                                                        <i class="fas fa-medal"></i>
                                                    </div>
                                                    <h5>Second Class Upper</h5>
                                                    <p class="cgpa-range">CGPA: 3.50 - 4.49</p>
                                                    <p class="description">Good distinction</p>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-6">
                                                <div class="classification-card">
                                                    <div class="classification-icon" style="background: #fff3cd; color: #ffc107;">
                                                        <i class="fas fa-certificate"></i>
                                                    </div>
                                                    <h5>Second Class Lower</h5>
                                                    <p class="cgpa-range">CGPA: 2.50 - 3.49</p>
                                                    <p class="description">Lower credit</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <div class="classification-card">
                                                    <div class="classification-icon" style="background: #f8d7da; color: #dc3545;">
                                                        <i class="fas fa-scroll"></i>
                                                    </div>
                                                    <h5>Third Class</h5>
                                                    <p class="cgpa-range">CGPA: 1.50 - 2.49</p>
                                                    <p class="description">Pass with credit</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="classification-card">
                                                    <div class="classification-icon" style="background: #e2e3e5; color: #6c757d;">
                                                        <i class="fas fa-check"></i>
                                                    </div>
                                                    <h5>Pass</h5>
                                                    <p class="cgpa-range">CGPA: 1.00 - 1.49</p>
                                                    <p class="description">Minimum pass</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Credit Hours System -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body p-4">
                                        <h4 class="text-primary mb-4">
                                            <i class="fas fa-clock me-2"></i>Credit Hours System
                                        </h4>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p>Each course has a credit hour value that reflects the workload:</p>
                                                <ul class="requirements-list">
                                                    <li><i class="fas fa-check"></i><strong>1 Credit Hour</strong> = 1 hour of lecture per week</li>
                                                    <li><i class="fas fa-check"></i><strong>1 Credit Hour</strong> = 2-3 hours of laboratory per week</li>
                                                    <li><i class="fas fa-check"></i><strong>Minimum</strong> = 15 credit hours per semester</li>
                                                    <li><i class="fas fa-check"></i><strong>Maximum</strong> = 24 credit hours per semester</li>
                                                </ul>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="warning-box info">
                                                    <h5><i class="fas fa-info-circle"></i>Important</h5>
                                                    <p>First-year students typically take 16-18 credit hours per semester. Credit load may vary based on your program and academic performance.</p>
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

        <!-- Academic Calendar Section -->
        <section id="calendar" class="section-padding">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <h2 class="section-title text-center">Academic Calendar & Semester Dates</h2>
                        <p class="text-center text-muted mb-5">Key dates and deadlines throughout the academic year</p>
                        
                        <!-- Semester Structure -->
                        <div class="row mb-5">
                            <div class="col-lg-12">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body p-4">
                                        <h4 class="text-primary mb-4">
                                            <i class="fas fa-calendar-alt me-2"></i>Semester Structure
                                        </h4>
                                        <div class="row g-4">
                                            <div class="col-md-6">
                                                <div class="info-box">
                                                    <div class="info-box-icon" style="background: #e8f4f8; color: #1e3c72;">
                                                        <i class="fas fa-1"></i>
                                                    </div>
                                                    <h5>First Semester</h5>
                                                    <p>Typically runs from September to January. Includes orientation for new students and mid-term examinations.</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="info-box">
                                                    <div class="info-box-icon" style="background: #e8f6f3; color: #27ae60;">
                                                        <i class="fas fa-2"></i>
                                                    </div>
                                                    <h5>Second Semester</h5>
                                                    <p>Typically runs from February to June. Includes final examinations and convocation preparations.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Timeline -->
                        <div class="row mb-5">
                            <div class="col-lg-12">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body p-4">
                                        <h4 class="text-primary mb-4">
                                            <i class="fas fa-list-ol me-2"></i>Semester Timeline
                                        </h4>
                                        
                                        <div class="academic-timeline">
                                            <div class="timeline-event">
                                                <div class="timeline-marker">
                                                    <i class="fas fa-user-plus"></i>
                                                </div>
                                                <div class="timeline-content">
                                                    <h5>Registration Period</h5>
                                                    <div class="date">Weeks 1-2</div>
                                                    <p>Course registration, payment of fees, and verification of enrollment. Complete all registrations online through the student portal.</p>
                                                </div>
                                            </div>
                                            
                                            <div class="timeline-event">
                                                <div class="timeline-marker">
                                                    <i class="fas fa-chalkboard-teacher"></i>
                                                </div>
                                                <div class="timeline-content">
                                                    <h5>Lectures Begin</h5>
                                                    <div class="date">Week 3</div>
                                                    <p>Regular lectures commence. Attend all your scheduled classes and collect course materials from your lecturers.</p>
                                                </div>
                                            </div>
                                            
                                            <div class="timeline-event">
                                                <div class="timeline-marker">
                                                    <i class="fas fa-plus-circle"></i>
                                                </div>
                                                <div class="timeline-content">
                                                    <h5>Add/Drop Period</h5>
                                                    <div class="date">Weeks 3-4</div>
                                                    <p>Last chance to add or drop courses without academic penalty. Consult your academic advisor before making changes.</p>
                                                </div>
                                            </div>
                                            
                                            <div class="timeline-event">
                                                <div class="timeline-marker">
                                                    <i class="fas fa-file-alt"></i>
                                                </div>
                                                <div class="timeline-content">
                                                    <h5>Mid-Term Examinations</h5>
                                                    <div class="date">Week 8-9</div>
                                                    <p>Mid-semester assessments. Check your portal for the examination timetable and venue details.</p>
                                                </div>
                                            </div>
                                            
                                            <div class="timeline-event">
                                                <div class="timeline-marker">
                                                    <i class="fas fa-minus-circle"></i>
                                                </div>
                                                <div class="timeline-content">
                                                    <h5>Course Withdrawal Deadline</h5>
                                                    <div class="date">Week 10</div>
                                                    <p>Last date to withdraw from a course with a grade of "W". After this date, withdrawal results in an "F" grade.</p>
                                                </div>
                                            </div>
                                            
                                            <div class="timeline-event">
                                                <div class="timeline-marker">
                                                    <i class="fas fa-book"></i>
                                                </div>
                                                <div class="timeline-content">
                                                    <h5>Lecture Revision Week</h5>
                                                    <div class="date">Week 13</div>
                                                    <p>Review week. Attend all revision classes and prepare for final examinations.</p>
                                                </div>
                                            </div>
                                            
                                            <div class="timeline-event">
                                                <div class="timeline-marker">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </div>
                                                <div class="timeline-content">
                                                    <h5>Final Examinations</h5>
                                                    <div class="date">Week 14-15</div>
                                                    <p>End of semester examinations. Check the exam timetable and ensure you know your seating arrangement.</p>
                                                </div>
                                            </div>
                                            
                                            <div class="timeline-event">
                                                <div class="timeline-marker">
                                                    <i class="fas fa-chart-line"></i>
                                                </div>
                                                <div class="timeline-content">
                                                    <h5>Results Release</h5>
                                                    <div class="date">Week 17-18</div>
                                                    <p>Semester results are published on the student portal. Log in to view your grades and CGPA.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Access Calendar -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="warning-box info">
                                    <h5><i class="fas fa-link"></i>How to Access the Academic Calendar</h5>
                                    <p>Visit the student portal at <strong>my.naub.edu.ng</strong> or check the university's official website for the complete academic calendar. You can also download the calendar from theRegistrar's Office section on the portal.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Course Registration Section -->
        <section id="registration" class="section-padding bg-light">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <h2 class="section-title text-center">Course Registration Deadlines</h2>
                        <p class="text-center text-muted mb-5">Important dates and consequences for missing registration deadlines</p>
                        
                        <!-- Registration Deadlines -->
                        <div class="row mb-5">
                            <div class="col-lg-12">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body p-4">
                                        <h4 class="text-primary mb-4">
                                            <i class="fas fa-calendar-check me-2"></i>Key Registration Deadlines
                                        </h4>
                                        
                                        <div class="table-responsive">
                                            <table class="grade-table table mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>Activity</th>
                                                        <th>Deadline</th>
                                                        <th>Consequence of Missing</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><strong>Normal Registration</strong></td>
                                                        <td>First two weeks of semester</td>
                                                        <td>None - regular fees apply</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Late Registration</strong></td>
                                                        <td>Week 3</td>
                                                        <td>Late penalty fee of ₦5,000</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Add/Drop Period</strong></td>
                                                        <td>End of Week 4</td>
                                                        <td>Cannot add/drop after deadline</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Course Withdrawal</strong></td>
                                                        <td>End of Week 10</td>
                                                        <td>Withdrawal results in "F" grade</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Fee Payment</strong></td>
                                                        <td>Before Registration closes</td>
                                                        <td>Registration blocked until paid</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Warning Boxes -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="warning-box danger">
                                    <h5><i class="fas fa-exclamation-triangle"></i>Late Registration Penalties</h5>
                                    <p>Students who register after the normal registration period will be charged a <strong>late penalty fee of ₦5,000</strong>. Registration after the late registration period (Week 3) may not be permitted for the semester.</p>
                                </div>
                                
                                <div class="warning-box warning">
                                    <h5><i class="fas fa-info-circle"></i>Add/Drop Period</h5>
                                    <p>During the first four weeks, you can:</p>
                                    <ul class="mt-2 mb-0">
                                        <li><strong>Add</strong> new courses (if seats are available)</li>
                                        <li><strong>Drop</strong> courses (will not appear on transcript)</li>
                                        <li><strong>Swap</strong> courses (drop one, add another)</li>
                                    </ul>
                                </div>
                                
                                <div class="warning-box danger">
                                    <h5><i class="fas fa-times-circle"></i>Course Withdrawal Deadline</h5>
                                    <p>After Week 10, you <strong>cannot withdraw</strong> from any course. Withdrawal after this deadline will result in an <strong>"F" grade</strong> that affects your CGPA. Plan carefully and consult your academic advisor.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Attendance Section -->
        <section id="attendance" class="section-padding">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <h2 class="section-title text-center">Study Expectations & Lecture Attendance</h2>
                        <p class="text-center text-muted mb-5">Understanding attendance requirements and academic expectations</p>
                        
                        <!-- Attendance Requirements -->
                        <div class="row mb-5">
                            <div class="col-lg-12">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body p-4">
                                        <h4 class="text-primary mb-4">
                                            <i class="fas fa-user-clock me-2"></i>Minimum Attendance Requirement
                                        </h4>
                                        
                                        <div class="warning-box success">
                                            <h5><i class="fas fa-percentage"></i>75% Attendance Requirement</h5>
                                            <p>All students must attend at least <strong>75% of all scheduled lectures, tutorials, and practical sessions</strong> for each course. This is a mandatory requirement to be eligible to sit for examinations.</p>
                                        </div>
                                        
                                        <div class="row mt-4">
                                            <div class="col-md-6">
                                                <h6 class="text-primary mb-3">Consequences of Low Attendance:</h6>
                                                <ul class="requirements-list">
                                                    <li><i class="fas fa-times"></i>Below 75% = Barred from examinations</li>
                                                    <li><i class="fas fa-times"></i>Must repeat the course</li>
                                                    <li><i class="fas fa-times"></i>Affects academic progression</li>
                                                    <li><i class="fas fa-times"></i>May impact scholarship eligibility</li>
                                                </ul>
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="text-primary mb-3">Valid Excuses for Absence:</h6>
                                                <ul class="requirements-list">
                                                    <li><i class="fas fa-check"></i>Medical illness (with medical certificate)</li>
                                                    <li><i class="fas fa-check"></i>Family emergency</li>
                                                    <li><i class="fas fa-check"></i>Official university activities</li>
                                                    <li><i class="fas fa-check"></i>Other emergencies (approved by HOD)</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Class Participation -->
                        <div class="row mb-5">
                            <div class="col-lg-12">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body p-4">
                                        <h4 class="text-primary mb-4">
                                            <i class="fas fa-comments me-2"></i>Class Participation & Study Expectations
                                        </h4>
                                        
                                        <div class="row g-4">
                                            <div class="col-md-6">
                                                <div class="info-box">
                                                    <div class="info-box-icon" style="background: #e8f4f8; color: #1e3c72;">
                                                        <i class="fas fa-hand-paper"></i>
                                                    </div>
                                                    <h5>Class Participation</h5>
                                                    <p>Active participation in class discussions is encouraged. Ask questions, contribute to discussions, and engage with your lecturers and peers.</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="info-box">
                                                    <div class="info-box-icon" style="background: #e8f6f3; color: #27ae60;">
                                                        <i class="fas fa-book"></i>
                                                    </div>
                                                    <h5>Lecture Notes & Materials</h5>
                                                    <p>Take detailed notes during lectures. Course materials, slides, and additional readings are available on the learning management system.</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="info-box">
                                                    <div class="info-box-icon" style="background: #fef5e7; color: #e67e22;">
                                                        <i class="fas fa-door-open"></i>
                                                    </div>
                                                    <h5>Office Hours</h5>
                                                    <p>All lecturers have designated office hours for consultations. Check your course outline or the lecturer's door for availability.</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="info-box">
                                                    <div class="info-box-icon" style="background: #f5eef8; color: #8e44ad;">
                                                        <i class="fas fa-clock"></i>
                                                    </div>
                                                    <h5>Study Time</h5>
                                                    <p>Allocate at least 2-3 hours of self-study for every hour of lecture. Stay on top of coursework to avoid last-minute cramming.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Study Tips -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="warning-box info">
                                    <h5><i class="fas fa-lightbulb"></i>Study Tips for Success</h5>
                                    <div class="row mt-3">
                                        <div class="col-md-6">
                                            <ul class="mb-0">
                                                <li>Review lecture notes within 24 hours</li>
                                                <li>Form study groups with classmates</li>
                                                <li>Use the library regularly</li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6">
                                            <ul class="mb-0">
                                                <li>Attend all lectures and tutorials</li>
                                                <li>Start assignments early</li>
                                                <li>Seek help when needed</li>
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

        <!-- Examinations Section -->
        <section id="examinations" class="section-padding bg-light">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <h2 class="section-title text-center">Submission & Examination Rules</h2>
                        <p class="text-center text-muted mb-5">Guidelines for assignments and examination conduct</p>
                        
                        <!-- Assignment Guidelines -->
                        <div class="row mb-5">
                            <div class="col-lg-12">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body p-4">
                                        <h4 class="text-primary mb-4">
                                            <i class="fas fa-file-upload me-2"></i>Assignment Submission Guidelines
                                        </h4>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6 class="text-primary mb-3">Submission Requirements:</h6>
                                                <ul class="requirements-list">
                                                    <li><i class="fas fa-check"></i>Submit through the designated platform</li>
                                                    <li><i class="fas fa-check"></i>Follow the specified file format</li>
                                                    <li><i class="fas fa-check"></i>Include your name, Matric No., and Course Code</li>
                                                    <li><i class="fas fa-check"></i>Submit before the deadline</li>
                                                </ul>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="warning-box warning">
                                                    <h5><i class="fas fa-clock"></i>Late Submission</h5>
                                                    <p class="mb-0">Late submissions receive <strong>zero marks</strong> unless prior approval is obtained from the lecturer.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Plagiarism Policy -->
                        <div class="row mb-5">
                            <div class="col-lg-12">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body p-4">
                                        <h4 class="text-primary mb-4">
                                            <i class="fas fa-shield-alt me-2"></i>Plagiarism Policy
                                        </h4>
                                        
                                        <div class="warning-box danger">
                                            <h5><i class="fas fa-ban"></i>Zero Tolerance for Plagiarism</h5>
                                            <p>Plagiarism is the use of another person's work without proper attribution. This includes:</p>
                                            <ul class="mt-2 mb-0">
                                                <li>Copying from books, websites, or other students</li>
                                                <li>Submitting work done by someone else</li>
                                                <li>Not citing sources properly</li>
                                                <li>Self-plagiarism (recycling previous work)</li>
                                            </ul>
                                        </div>
                                        
                                        <div class="row mt-4">
                                            <div class="col-md-4">
                                                <div class="text-center p-3">
                                                    <i class="fas fa-exclamation-circle text-danger fa-2x mb-3"></i>
                                                    <h6>First Offense</h6>
                                                    <p class="mb-0 text-muted">Zero mark for the assignment</p>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="text-center p-3">
                                                    <i class="fas fa-exclamation-triangle text-danger fa-2x mb-3"></i>
                                                    <h6>Second Offense</h6>
                                                    <p class="mb-0 text-muted">Zero for the course</p>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="text-center p-3">
                                                    <i class="fas fa-times-circle text-danger fa-2x mb-3"></i>
                                                    <h6>Third Offense</h6>
                                                    <p class="mb-0 text-muted">Expulsion from university</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Examination Conduct -->
                        <div class="row mb-5">
                            <div class="col-lg-12">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body p-4">
                                        <h4 class="text-primary mb-4">
                                            <i class="fas fa-pencil-ruler me-2"></i>Examination Conduct
                                        </h4>
                                        
                                        <div class="row g-4">
                                            <div class="col-md-6">
                                                <h6 class="text-primary mb-3">What You Need:</h6>
                                                <ul class="requirements-list">
                                                    <li><i class="fas fa-check"></i>Valid Student ID Card</li>
                                                    <li><i class="fas fa-check"></i> Examination docket</li>
                                                    <li><i class="fas fa-check"></i> Writing materials (pens, pencils)</li>
                                                    <li><i class="fas fa-check"></i> Calculator (if permitted)</li>
                                                </ul>
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="text-primary mb-3">Prohibited Items:</h6>
                                                <ul class="requirements-list">
                                                    <li><i class="fas fa-times"></i>Mobile phones</li>
                                                    <li><i class="fas fa-times"></i>Smart watches</li>
                                                    <li><i class="fas fa-times"></i>Unauthorized notes</li>
                                                    <li><i class="fas fa-times"></i>Communication devices</li>
                                                </ul>
                                            </div>
                                        </div>
                                        
                                        <div class="warning-box danger mt-4">
                                            <h5><i class="fas fa-exclamation-triangle"></i>Examination Misconduct</h5>
                                            <p class="mb-0">Any form of examination malpractice (cheating, impersonation, bringing prohibited items) will result in <strong>automatic failure</strong> and disciplinary action, which may include expulsion.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Make-up Exams & Results -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body p-4">
                                        <h4 class="text-primary mb-4">
                                            <i class="fas fa-clipboard-check me-2"></i>Make-up Exams & Results
                                        </h4>
                                        
                                        <div class="row g-4">
                                            <div class="col-md-6">
                                                <div class="info-box">
                                                    <div class="info-box-icon" style="background: #fef5e7; color: #e67e22;">
                                                        <i class="fas fa-clock"></i>
                                                    </div>
                                                    <h5>Make-up Exams</h5>
                                                    <p>Students with valid reasons (medical emergency, official university activity) may apply for a make-up exam within 48 hours of the missed exam. Application must be supported by relevant documentation.</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="info-box">
                                                    <div class="info-box-icon" style="background: #e8f6f3; color: #27ae60;">
                                                        <i class="fas fa-chart-bar"></i>
                                                    </div>
                                                    <h5>Result Computation</h5>
                                                    <p>Results are typically released within 2-4 weeks after examinations. The final grade includes: Continuous Assessment (40%) + Final Exam (60%).</p>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="warning-box info mt-4">
                                            <h5><i class="fas fa-info-circle"></i>Result Computation Timeline</h5>
                                            <p><strong>Continuous Assessment:</strong> 40% (includes class tests, assignments, projects)</p>
                                            <p><strong>Final Examination:</strong> 60%</p>
                                            <p class="mb-0">Results are published on the student portal. Hard copies can be obtained from the Registry after official release.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Department Section -->
        <section id="department" class="section-padding">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <h2 class="section-title text-center">Department-Specific Guidance</h2>
                        <p class="text-center text-muted mb-5">Requirements and guidelines by faculty and department</p>
                        
                        <!-- Faculty Requirements -->
                        <div class="row mb-5">
                            <div class="col-lg-12">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body p-4">
                                        <h4 class="text-primary mb-4">
                                            <i class="fas fa-university me-2"></i>Faculty-Specific Requirements
                                        </h4>
                                        
                                        <div class="row g-4">
                                            <div class="col-md-6">
                                                <div class="info-box">
                                                    <div class="info-box-icon" style="background: #e8f4f8; color: #1e3c72;">
                                                        <i class="fas fa-laptop-code"></i>
                                                    </div>
                                                    <h5>Faculty of Computing</h5>
                                                    <p>Programming courses require regular practice. Access to computer labs is essential. Projects must be submitted with working code.</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="info-box">
                                                    <div class="info-box-icon" style="background: #e8f6f3; color: #27ae60;">
                                                        <i class="fas fa-cogs"></i>
                                                    </div>
                                                    <h5>Faculty of Engineering</h5>
                                                    <p>Strong foundation in mathematics is essential. All lab sessions are mandatory. Design projects required in final year.</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="info-box">
                                                    <div class="info-box-icon" style="background: #fef5e7; color: #e67e22;">
                                                        <i class="fas fa-flask"></i>
                                                    </div>
                                                    <h5>Faculty of Sciences</h5>
                                                    <p>Laboratory work is compulsory. Lab reports must be submitted on time. Field trips may be required for some courses.</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="info-box">
                                                    <div class="info-box-icon" style="background: #f5eef8; color: #8e44ad;">
                                                        <i class="fas fa-book"></i>
                                                    </div>
                                                    <h5>Faculty of Arts</h5>
                                                    <p>Research projects and essays are key assessment methods. Extensive reading is required. Seminar presentations are mandatory.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Practical/Lab Requirements -->
                        <div class="row mb-5">
                            <div class="col-lg-12">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body p-4">
                                        <h4 class="text-primary mb-4">
                                            <i class="fas fa-flask me-2"></i>Practical & Lab Requirements
                                        </h4>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <ul class="requirements-list">
                                                    <li><i class="fas fa-check"></i>Attend all scheduled laboratory sessions</li>
                                                    <li><i class="fas fa-check"></i>Complete pre-lab preparations</li>
                                                    <li><i class="fas fa-check"></i>Submit lab reports within one week</li>
                                                    <li><i class="fas fa-check"></i>Follow all safety protocols</li>
                                                </ul>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="warning-box warning">
                                                    <h5><i class="fas fa-exclamation-circle"></i>Important</h5>
                                                    <p class="mb-0">Missing more than <strong>25% of lab sessions</strong> will result in failure of the practical component, affecting your final grade.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Projects & Dissertations -->
                        <div class="row mb-5">
                            <div class="col-lg-12">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body p-4">
                                        <h4 class="text-primary mb-4">
                                            <i class="fas fa-file-alt me-2"></i>Project & Dissertation Guidelines
                                        </h4>
                                        
                                        <div class="row g-4">
                                            <div class="col-md-4">
                                                <div class="text-center">
                                                    <div class="mb-3">
                                                        <i class="fas fa-1 fa-2x text-primary"></i>
                                                    </div>
                                                    <h6>Year 3 / 400 Level</h6>
                                                    <p class="text-muted mb-0">Select topic and supervisor. Submit project proposal.</p>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="text-center">
                                                    <div class="mb-3">
                                                        <i class="fas fa-2 fa-2x text-primary"></i>
                                                    </div>
                                                    <h6>Year 4 / 500 Level</h6>
                                                    <p class="text-muted mb-0">Conduct research. Submit progress reports. Present findings.</p>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="text-center">
                                                    <div class="mb-3">
                                                        <i class="fas fa-3 fa-2x text-primary"></i>
                                                    </div>
                                                    <h6>Final Submission</h6>
                                                    <p class="text-muted mb-0">Submit final thesis. Defend before panel. Submit corrected version.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Industrial Attachment (SIWES) -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body p-4">
                                        <h4 class="text-primary mb-4">
                                            <i class="fas fa-briefcase me-2"></i>Industrial Attachment (SIWES)
                                        </h4>
                                        
                                        <div class="warning-box info">
                                            <h5><i class="fas fa-info-circle"></i>What is SIWES?</h5>
                                            <p>The Students' Industrial Work Experience Scheme (SIWES) is a mandatory program that provides practical work experience. It is usually undertaken during the long vacation after 300/400 level.</p>
                                        </div>
                                        
                                        <div class="row mt-4">
                                            <div class="col-md-6">
                                                <h6 class="text-primary mb-3">Key Requirements:</h6>
                                                <ul class="requirements-list">
                                                    <li><i class="fas fa-check"></i>Complete minimum 24 weeks of attachment</li>
                                                    <li><i class="fas fa-check"></i>Register for SIWES before the vacation</li>
                                                    <li><i class="fas fa-check"></i>Submit logbook weekly</li>
                                                    <li><i class="fas fa-check"></i>Get supervisor's assessment</li>
                                                    <li><i class="fas fa-check"></i>Submit final report</li>
                                                </ul>
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="text-primary mb-3">Assessment:</h6>
                                                <ul class="requirements-list">
                                                    <li><i class="fas fa-star"></i>Industry Supervisor: 30%</li>
                                                    <li><i class="fas fa-star"></i>University Supervisor: 30%</li>
                                                    <li><i class="fas fa-star"></i>Logbook: 20%</li>
                                                    <li><i class="fas fa-star"></i>Final Report: 20%</li>
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

        <!-- Support Section -->
        <section id="support" class="section-padding bg-light">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <h2 class="section-title text-center">Academic Support Services</h2>
                        <p class="text-center text-muted mb-5">Resources and services to help you succeed academically</p>
                        
                        <!-- Support Services Grid -->
                        <div class="row g-4 mb-5">
                            <div class="col-md-6 col-lg-3">
                                <div class="support-card">
                                    <div class="support-icon" style="background: #e8f4f8; color: #1e3c72;">
                                        <i class="fas fa-user-tie"></i>
                                    </div>
                                    <h5>Academic Advisors</h5>
                                    <p>Each student is assigned a faculty advisor for academic guidance and course selection.</p>
                                    <a href="#">Find Your Advisor <i class="fas fa-arrow-right ms-1"></i></a>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-lg-3">
                                <div class="support-card">
                                    <div class="support-icon" style="background: #e8f6f3; color: #27ae60;">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <h5>Study Groups</h5>
                                    <p>Join or form study groups with peers. The university facilitates group formations each semester.</p>
                                    <a href="#">Learn More <i class="fas fa-arrow-right ms-1"></i></a>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-lg-3">
                                <div class="support-card">
                                    <div class="support-icon" style="background: #fef5e7; color: #e67e22;">
                                        <i class="fas fa-book-reader"></i>
                                    </div>
                                    <h5>Library Resources</h5>
                                    <p>Access extensive physical and digital collections. Library orientation available for new students.</p>
                                    <a href="#">Visit Library <i class="fas fa-arrow-right ms-1"></i></a>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-lg-3">
                                <div class="support-card">
                                    <div class="support-icon" style="background: #f5eef8; color: #8e44ad;">
                                        <i class="fas fa-chalkboard-teacher"></i>
                                    </div>
                                    <h5>Tutoring Services</h5>
                                    <p>Free peer tutoring available for challenging courses. Subject-specific tutors are available.</p>
                                    <a href="#">Request Tutor <i class="fas fa-arrow-right ms-1"></i></a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Additional Support -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body p-4">
                                        <h4 class="text-primary mb-4">
                                            <i class="fas fa-hands-helping me-2"></i>Additional Academic Support
                                        </h4>
                                        
                                        <div class="row g-4">
                                            <div class="col-md-6">
                                                <ul class="requirements-list">
                                                    <li><i class="fas fa-check"></i><strong>Writing Center:</strong> Help with academic writing, essays, and reports</li>
                                                    <li><i class="fas fa-check"></i><strong>Math Clinic:</strong> Support for mathematics and statistics courses</li>
                                                    <li><i class="fas fa-check"></i><strong>IT Support:</strong> Technical assistance with LMS and software</li>
                                                </ul>
                                            </div>
                                            <div class="col-md-6">
                                                <ul class="requirements-list">
                                                    <li><i class="fas fa-check"></i><strong>Career Services:</strong> Career counseling and job placement assistance</li>
                                                    <li><i class="fas fa-check"></i><strong>Counseling Unit:</strong> Personal and academic counseling services</li>
                                                    <li><i class="fas fa-check"></i><strong>Online Resources:</strong> E-books, journals, and learning materials</li>
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
                        <h2 class="mb-3">Need More Academic Assistance?</h2>
                        <p class="mb-4 opacity-75">Explore additional resources or contact the relevant offices for support</p>
                        <div class="d-flex gap-3 justify-content-center flex-wrap">
                            <a href="<?php echo BASE_URL; ?>/contact.php" class="btn btn-accent">
                                <i class="fas fa-envelope me-2"></i>Contact Us
                            </a>
                            <a href="<?php echo BASE_URL; ?>/page.php?slug=student-support" class="btn btn-outline-accent">
                                <i class="fas fa-hands-helping me-2"></i>Support Services
                            </a>
                            <a href="<?php echo BASE_URL; ?>/faqs.php" class="btn btn-outline-accent">
                                <i class="fas fa-question-circle me-2"></i>FAQs
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
        const navLinks = document.querySelectorAll('.quick-nav .nav-link');
        
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
