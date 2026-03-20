<?php
/**
 * Campus Life Page
 * Nigerian Army University, Biu - Orientation Portal
 */

// Page configuration
$page_title = 'Campus Life';
$page_description = 'Discover campus life at NAUB - housing, library, sports, facilities, and student activities';

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
        .campus-hero {
            background: linear-gradient(135deg, #2c3e50 0%, #3498db 50%, #2c3e50 100%);
            color: white;
            padding: 100px 0;
            position: relative;
            overflow: hidden;
        }
        
        .campus-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><polygon points="50,10 90,90 10,90" fill="none" stroke="rgba(255,255,255,0.05)" stroke-width="1"/></svg>');
            background-size: 100px 100px;
        }
        
        .campus-hero .display-4 {
            font-weight: 700;
            margin-bottom: 1rem;
        }
        
        .campus-hero .lead {
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
            background: linear-gradient(90deg, #2c3e50, #3498db);
        }
        
        .section-title.text-start::after {
            left: 0;
            transform: none;
        }
        
        /* Service Cards */
        .service-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
        }
        
        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.12);
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
        
        .service-card h5 {
            color: #2c3e50;
            margin-bottom: 10px;
            font-weight: 600;
        }
        
        .service-card p {
            color: #666;
            margin-bottom: 15px;
            font-size: 0.9rem;
        }
        
        .service-card a {
            color: #3498db;
            font-weight: 600;
            text-decoration: none;
        }
        
        .service-card a:hover {
            text-decoration: underline;
        }
        
        /* Info Box */
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
            color: #2c3e50;
            margin-bottom: 10px;
            font-weight: 600;
        }
        
        .info-box p {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 0;
        }
        
        /* Hours Table */
        .hours-table {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }
        
        .hours-table thead th {
            background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
            color: white;
            padding: 15px;
            font-weight: 600;
            border: none;
        }
        
        .hours-table tbody tr {
            transition: background 0.3s ease;
        }
        
        .hours-table tbody tr:hover {
            background: #f8f9fa;
        }
        
        .hours-table td {
            padding: 15px;
            vertical-align: middle;
        }
        
        /* Facility Gallery */
        .facility-card {
            position: relative;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            height: 250px;
        }
        
        .facility-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        
        .facility-card:hover img {
            transform: scale(1.1);
        }
        
        .facility-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(transparent, rgba(0,0,0,0.8));
            padding: 20px;
            color: white;
        }
        
        .facility-overlay h5 {
            margin-bottom: 5px;
            font-weight: 600;
        }
        
        .facility-overlay p {
            margin-bottom: 0;
            font-size: 0.85rem;
            opacity: 0.9;
        }
        
        /* Activity Cards */
        .activity-card {
            background: white;
            border-radius: 12px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
        }
        
        .activity-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.12);
        }
        
        .activity-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 32px;
        }
        
        .activity-card h5 {
            color: #2c3e50;
            margin-bottom: 10px;
            font-weight: 600;
        }
        
        .activity-card p {
            color: #666;
            margin-bottom: 0;
            font-size: 0.9rem;
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
            color: #2c3e50;
            background: #f8f9fa;
        }
        
        .quick-nav .nav-pills .nav-link.active {
            background: #2c3e50;
            color: white;
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
        
        /* Room Type Cards */
        .room-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            transition: transform 0.3s ease;
            height: 100%;
            border: 2px solid transparent;
        }
        
        .room-card:hover {
            transform: translateY(-5px);
            border-color: #3498db;
        }
        
        .room-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            font-size: 24px;
        }
        
        .room-card h5 {
            color: #2c3e50;
            margin-bottom: 10px;
            font-weight: 600;
        }
        
        .room-card .price {
            color: #3498db;
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 10px;
        }
        
        .room-card p {
            color: #666;
            font-size: 0.85rem;
            margin-bottom: 0;
        }
        
        /* CTA Section */
        .cta-section {
            background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
            color: white;
            padding: 60px 0;
        }
        
        .cta-section h2 {
            font-weight: 700;
        }
        
        .btn-accent {
            background: white;
            color: #2c3e50;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .btn-accent:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.2);
            color: #2c3e50;
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
            color: #2c3e50;
        }
        
        @media (max-width: 768px) {
            .campus-hero {
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
    <section class="campus-hero">
        <div class="container position-relative">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <div class="mb-4">
                        <i class="fas fa-building fa-4x"></i>
                    </div>
                    <h1 class="display-4 fw-bold mb-3">Campus Life</h1>
                    <p class="lead mb-4">Thriving at NAUB - Your Home Away From Home</p>
                    <p class="opacity-75 mb-0">Nigerian Army University, Biu - Experience Excellence in Living and Learning</p>
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
                        <a class="nav-link" href="#hostel">Hostel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#library">Library</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#ict">ICT Center</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#medical">Medical</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#labs">Laboratories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#activities">Activities</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#sports">Sports</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        <!-- Hostel Section -->
        <section id="hostel" class="section-padding bg-light">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <h2 class="section-title text-center">Hostel Information & Booking</h2>
                        <p class="text-center text-muted mb-5">Comfortable on-campus accommodation for all students</p>
                        
                        <!-- Hostel Overview -->
                        <div class="row mb-5">
                            <div class="col-lg-12">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body p-4">
                                        <h4 class="text-primary mb-4">
                                            <i class="fas fa-home me-2"></i>On-Campus Hostels
                                        </h4>
                                        <p class="text-muted mb-4">NAUB provides separate hostels for male and female students, ensuring a safe and conducive living environment for all residents.</p>
                                        
                                        <div class="row g-4">
                                            <div class="col-md-6">
                                                <div class="info-box">
                                                    <div class="info-box-icon" style="background: #e8f4f8; color: #2c3e50;">
                                                        <i class="fas fa-male"></i>
                                                    </div>
                                                    <h5>Male Hostels</h5>
                                                    <p>Multiple hostel blocks available with 24-hour security. Common areas, study rooms, and recreational facilities included.</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="info-box">
                                                    <div class="info-box-icon" style="background: #fce4ec; color: #e91e63;">
                                                        <i class="fas fa-female"></i>
                                                    </div>
                                                    <h5>Female Hostels</h5>
                                                    <p>Secure accommodation with female-only floors. Female security personnel on duty. Close to dining facilities and campus amenities.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Room Types -->
                        <div class="row mb-5">
                            <div class="col-lg-12">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body p-4">
                                        <h4 class="text-primary mb-4">
                                            <i class="fas fa-bed me-2"></i>Room Types & Fees
                                        </h4>
                                        
                                        <div class="row g-4">
                                            <div class="col-md-4">
                                                <div class="room-card">
                                                    <div class="room-icon" style="background: #e8f4f8; color: #2c3e50;">
                                                        <i class="fas fa-user"></i>
                                                    </div>
                                                    <h5>Single Room</h5>
                                                    <div class="price">₦150,000/semester</div>
                                                    <p>Private room with study desk, wardrobe, and personal bathroom. Limited availability.</p>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="room-card">
                                                    <div class="room-icon" style="background: #e8f6f3; color: #27ae60;">
                                                        <i class="fas fa-users"></i>
                                                    </div>
                                                    <h5>Double Room</h5>
                                                    <div class="price">₦100,000/semester</div>
                                                    <p>Shared room for two students with separate beds, desks, and wardrobes. Most popular option.</p>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="room-card">
                                                    <div class="room-icon" style="background: #fef5e7; color: #e67e22;">
                                                        <i class="fas fausers"></i>
                                                    </div>
                                                    <h5>Dormitory</h5>
                                                    <div class="price">₦60,000/semester</div>
                                                    <p>Shared space with 4-6 students. Bunk beds, communal storage, and shared bathroom facilities.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Booking Process -->
                        <div class="row mb-5">
                            <div class="col-lg-12">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body p-4">
                                        <h4 class="text-primary mb-4">
                                            <i class="fas fa-calendar-check me-2"></i>Booking Process
                                        </h4>
                                        
                                        <div class="row g-4">
                                            <div class="col-md-6">
                                                <h6 class="text-primary mb-3">How to Book:</h6>
                                                <ul class="requirements-list">
                                                    <li><i class="fas fa-check"></i>Log in to the student portal during hostel booking period</li>
                                                    <li><i class="fas fa-check"></i>Select preferred hostel and room type</li>
                                                    <li><i class="fas fa-check"></i>Pay hostel fees through designated channels</li>
                                                    <li><i class="fas fa-check"></i>Receive allocation confirmation via email/SMS</li>
                                                    <li><i class="fas fa-check"></i>Collect room key from Hostel Administration Office</li>
                                                </ul>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="warning-box info">
                                                    <h5><i class="fas fa-info-circle"></i>Important Dates</h5>
                                                    <p><strong>Booking Period:</strong> Beginning of each semester</p>
                                                    <p><strong>Allocation:</strong> Within 2 weeks of payment</p>
                                                    <p><strong>Check-in:</strong> First weekend of semester</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Rules & Regulations -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="warning-box danger">
                                    <h5><i class="fas fa-exclamation-triangle"></i>Hostel Rules & Regulations</h5>
                                    <div class="row mt-3">
                                        <div class="col-md-6">
                                            <ul class="mb-0">
                                                <li>Quiet hours: 10 PM - 6 AM</li>
                                                <li>No guests allowed after 8 PM</li>
                                                <li>No cooking in rooms</li>
                                                <li>No pets permitted</li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6">
                                            <ul class="mb-0">
                                                <li>Room inspections conducted weekly</li>
                                                <li>No sub-letting or room changes without approval</li>
                                                <li>Security deposit required (refundable)</li>
                                                <li>Respect for roommates and neighbors mandatory</li>
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

        <!-- Library Section -->
        <section id="library" class="section-padding">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <h2 class="section-title text-center">Library Services & Hours</h2>
                        <p class="text-center text-muted mb-5">Your gateway to knowledge and research resources</p>
                        
                        <!-- Library Info -->
                        <div class="row mb-5">
                            <div class="col-lg-12">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body p-4">
                                        <h4 class="text-primary mb-4">
                                            <i class="fas fa-book me-2"></i>Main Library
                                        </h4>
                                        
                                        <div class="row g-4">
                                            <div class="col-md-6">
                                                <div class="info-box">
                                                    <div class="info-box-icon" style="background: #e8f4f8; color: #2c3e50;">
                                                        <i class="fas fa-map-marker-alt"></i>
                                                    </div>
                                                    <h5>Location</h5>
                                                    <p>Central Library Building, opposite the Faculty of Engineering. Ground floor houses the circulation desk and popular reading collection.</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="info-box">
                                                    <div class="info-box-icon" style="background: #e8f6f3; color: #27ae60;">
                                                        <i class="fas fa-clock"></i>
                                                    </div>
                                                    <h5>Opening Hours</h5>
                                                    <p>Monday - Friday: 8:00 AM - 10:00 PM<br>Saturday: 9:00 AM - 6:00 PM<br>Sunday: 12:00 PM - 6:00 PM</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Operating Hours Table -->
                        <div class="row mb-5">
                            <div class="col-lg-12">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body p-4">
                                        <h4 class="text-primary mb-4">
                                            <i class="fas fa-schedule me-2"></i>Detailed Operating Hours
                                        </h4>
                                        
                                        <div class="table-responsive">
                                            <table class="hours-table table mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>Service</th>
                                                        <th>Weekdays</th>
                                                        <th>Saturday</th>
                                                        <th>Sunday</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><strong>Circulation Desk</strong></td>
                                                        <td>8:00 AM - 8:00 PM</td>
                                                        <td>9:00 AM - 5:00 PM</td>
                                                        <td>Closed</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Reference Services</strong></td>
                                                        <td>8:00 AM - 6:00 PM</td>
                                                        <td>9:00 AM - 4:00 PM</td>
                                                        <td>12:00 PM - 4:00 PM</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Reading Rooms</strong></td>
                                                        <td>8:00 AM - 10:00 PM</td>
                                                        <td>9:00 AM - 6:00 PM</td>
                                                        <td>12:00 PM - 6:00 PM</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Computer Lab</strong></td>
                                                        <td>8:00 AM - 8:00 PM</td>
                                                        <td>10:00 AM - 4:00 PM</td>
                                                        <td>Closed</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>E-Library Access</strong></td>
                                                        <td>24 Hours</td>
                                                        <td>24 Hours</td>
                                                        <td>24 Hours</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Borrowing Policies -->
                        <div class="row mb-5">
                            <div class="col-lg-12">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body p-4">
                                        <h4 class="text-primary mb-4">
                                            <i class="fas fa-clipboard-list me-2"></i>Book Borrowing Policies
                                        </h4>
                                        
                                        <div class="row g-4">
                                            <div class="col-md-6">
                                                <h6 class="text-primary mb-3">Borrowing Limits:</h6>
                                                <ul class="requirements-list">
                                                    <li><i class="fas fa-check"></i><strong>Undergraduates:</strong> 5 books for 2 weeks</li>
                                                    <li><i class="fas fa-check"></i><strong>Postgraduates:</strong> 10 books for 4 weeks</li>
                                                    <li><i class="fas fa-check"></i><strong>Staff:</strong> 20 books for semester</li>
                                                    <li><i class="fas fa-check"></i><strong>Reference books:</strong> In-library use only</li>
                                                </ul>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="warning-box">
                                                    <h5><i class="fas fa-exclamation-circle"></i>Late Fees</h5>
                                                    <p class="mb-0">A fine of <strong>₦100 per day</strong> applies for overdue books. Lost books must be replaced or paid for at current market price plus processing fee.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Digital Resources -->
                        <div class="row mb-5">
                            <div class="col-lg-12">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body p-4">
                                        <h4 class="text-primary mb-4">
                                            <i class="fas fa-laptop me-2"></i>Digital Resources & E-Library
                                        </h4>
                                        
                                        <div class="row g-4">
                                            <div class="col-md-4">
                                                <div class="service-card">
                                                    <div class="service-icon" style="background: #e8f4f8; color: #2c3e50;">
                                                        <i class="fas fa-database"></i>
                                                    </div>
                                                    <h5>Online Databases</h5>
                                                    <p>Access JSTOR, IEEE, ACM, Scopus, and more from campus or remotely.</p>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="service-card">
                                                    <div class="service-icon" style="background: #e8f6f3; color: #27ae60;">
                                                        <i class="fas fa-book-open"></i>
                                                    </div>
                                                    <h5>E-Books Collection</h5>
                                                    <p>Over 50,000 e-books available for download and reading online.</p>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="service-card">
                                                    <div class="service-icon" style="background: #fef5e7; color: #e67e22;">
                                                        <i class="fas fa-newspaper"></i>
                                                    </div>
                                                    <h5>E-Journals</h5>
                                                    <p>Access thousands of academic journals and research publications.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Study Spaces -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body p-4">
                                        <h4 class="text-primary mb-4">
                                            <i class="fas fa-chair me-2"></i>Study Spaces & Facilities
                                        </h4>
                                        
                                        <div class="row g-4">
                                            <div class="col-md-6">
                                                <ul class="requirements-list">
                                                    <li><i class="fas fa-check"></i><strong>Individual Study Carrels:</strong> Private study spaces for focused work</li>
                                                    <li><i class="fas fa-check"></i><strong>Group Study Rooms:</strong> Bookable rooms for collaborative study (4-8 people)</li>
                                                    <li><i class="fas fa-check"></i><strong>Quiet Zones:</strong> Silent study areas for intensive reading</li>
                                                    <li><i class="fas fa-check"></i><strong>Multi-media Room:</strong> For presentations and group projects</li>
                                                </ul>
                                            </div>
                                            <div class="col-md-6">
                                                <ul class="requirements-list">
                                                    <li><i class="fas fa-check"></i><strong>Computer Workstations:</strong> 100+ computers with internet access</li>
                                                    <li><i class="fas fa-check"></i><strong>Printing Services:</strong> Affordable printing and photocopying</li>
                                                    <li><i class="fas fa-check"></i><strong>WiFi Access:</strong> Free high-speed internet throughout</li>
                                                    <li><i class="fas fa-check"></i><strong>Café Area:</strong> Light refreshments while studying</li>
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

        <!-- ICT Center Section -->
        <section id="ict" class="section-padding bg-light">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <h2 class="section-title text-center">ICT Center & Computer Labs</h2>
                        <p class="text-center text-muted mb-5">State-of-the-art technology for learning and research</p>
                        
                        <!-- Lab Locations -->
                        <div class="row mb-5">
                            <div class="col-lg-12">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body p-4">
                                        <h4 class="text-primary mb-4">
                                            <i class="fas fa-desktop me-2"></i>Computer Lab Locations
                                        </h4>
                                        
                                        <div class="row g-4">
                                            <div class="col-md-4">
                                                <div class="service-card">
                                                    <div class="service-icon" style="background: #e8f4f8; color: #2c3e50;">
                                                        <i class="fas fa-building"></i>
                                                    </div>
                                                    <h5>Main Computer Lab</h5>
                                                    <p>ICT Center Building<br>150 workstations<br>Full software suite</p>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="service-card">
                                                    <div class="service-icon" style="background: #e8f6f3; color: #27ae60;">
                                                        <i class="fas fa-laptop-code"></i>
                                                    </div>
                                                    <h5>Computing Lab</h5>
                                                    <p>Faculty of Computing<br>100 workstations<br>Programming environment</p>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="service-card">
                                                    <div class="service-icon" style="background: #fef5e7; color: #e67e22;">
                                                        <i class="fas fa-microscope"></i>
                                                    </div>
                                                    <h5>Engineering Lab</h5>
                                                    <p>Faculty of Engineering<br>80 workstations<br>CAD software</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Operating Hours -->
                        <div class="row mb-5">
                            <div class="col-lg-12">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body p-4">
                                        <h4 class="text-primary mb-4">
                                            <i class="fas fa-clock me-2"></i>Operating Hours
                                        </h4>
                                        
                                        <div class="table-responsive">
                                            <table class="hours-table table mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>Facility</th>
                                                        <th>Weekdays</th>
                                                        <th>Weekends</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><strong>Main Computer Lab</strong></td>
                                                        <td>7:00 AM - 9:00 PM</td>
                                                        <td>9:00 AM - 5:00 PM</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Computing Lab</strong></td>
                                                        <td>8:00 AM - 6:00 PM</td>
                                                        <td>Closed</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Engineering Lab</strong></td>
                                                        <td>8:00 AM - 6:00 PM</td>
                                                        <td>Closed</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>ICT Help Desk</strong></td>
                                                        <td>8:00 AM - 5:00 PM</td>
                                                        <td>Closed</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Internet & Services -->
                        <div class="row mb-5">
                            <div class="col-lg-12">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body p-4">
                                        <h4 class="text-primary mb-4">
                                            <i class="fas fa-wifi me-2"></i>Internet & Connectivity
                                        </h4>
                                        
                                        <div class="row g-4">
                                            <div class="col-md-6">
                                                <div class="info-box">
                                                    <div class="info-box-icon" style="background: #e8f4f8; color: #2c3e50;">
                                                        <i class="fas fa-wifi"></i>
                                                    </div>
                                                    <h5>WiFi Access</h5>
                                                    <p>Free campus-wide WiFi (NAUB-Student). Connect with your student credentials. High-speed fiber internet available.</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="info-box">
                                                    <div class="info-box-icon" style="background: #e8f6f3; color: #27ae60;">
                                                        <i class="fas fa-plug"></i>
                                                    </div>
                                                    <h5>Network Points</h5>
                                                    <p>Ethernet ports available in all computer labs and study areas. Bring your laptop for wired connection.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Printing Services -->
                        <div class="row mb-5">
                            <div class="col-lg-12">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body p-4">
                                        <h4 class="text-primary mb-4">
                                            <i class="fas fa-print me-2"></i>Printing & Scanning Services
                                        </h4>
                                        
                                        <div class="row g-4">
                                            <div class="col-md-4">
                                                <div class="text-center p-3">
                                                    <i class="fas fa-print text-primary fa-2x mb-3"></i>
                                                    <h6>Black & White</h6>
                                                    <p class="mb-0 text-muted">₦20 per page</p>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="text-center p-3">
                                                    <i class="fas fa-print text-primary fa-2x mb-3"></i>
                                                    <h6>Color Printing</h6>
                                                    <p class="mb-0 text-muted">₦100 per page</p>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="text-center p-3">
                                                    <i class="fas fa-file-scan text-primary fa-2x mb-3"></i>
                                                    <h6>Scanning</h6>
                                                    <p class="mb-0 text-muted">₦10 per page</p>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="warning-box info mt-3">
                                            <h5><i class="fas fa-info-circle"></i>Printing Quota</h5>
                                            <p class="mb-0">Each student receives <strong>50 free pages</strong> per semester. Additional pages must be prepaid through the student portal.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Software Available -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body p-4">
                                        <h4 class="text-primary mb-4">
                                            <i class="fas fa-cube me-2"></i>Software Available
                                        </h4>
                                        
                                        <div class="row g-4">
                                            <div class="col-md-6">
                                                <ul class="requirements-list">
                                                    <li><i class="fas fa-check"></i><strong>Microsoft Office:</strong> Word, Excel, PowerPoint</li>
                                                    <li><i class="fas fa-check"></i><strong>Programming:</strong> Visual Studio, Code::Blocks, Python</li>
                                                    <li><i class="fas fa-check"></i><strong>Design:</strong> AutoCAD, Adobe Creative Suite</li>
                                                    <li><i class="fas fa-check"></i><strong>Statistical:</strong> SPSS, STATA, R</li>
                                                </ul>
                                            </div>
                                            <div class="col-md-6">
                                                <ul class="requirements-list">
                                                    <li><i class="fas fa-check"></i><strong>Engineering:</strong> MATLAB, SolidWorks</li>
                                                    <li><i class="fas fa-check"></i><strong>Database:</strong> MySQL, SQL Server</li>
                                                    <li><i class="fas fa-check"></i><strong>Anti-virus:</strong> Free licensed antivirus</li>
                                                    <li><i class="fas fa-check"></i><strong>PDF:</strong> Adobe Acrobat Reader</li>
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

        <!-- Medical Center Section -->
        <section id="medical" class="section-padding">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <h2 class="section-title text-center">Medical Center Services</h2>
                        <p class="text-center text-muted mb-5">Quality healthcare for students and staff</p>
                        
                        <!-- Location & Hours -->
                        <div class="row mb-5">
                            <div class="col-lg-12">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body p-4">
                                        <h4 class="text-primary mb-4">
                                            <i class="fas fa-hospital me-2"></i>Medical Center Location & Hours
                                        </h4>
                                        
                                        <div class="row g-4">
                                            <div class="col-md-6">
                                                <div class="info-box">
                                                    <div class="info-box-icon" style="background: #fce4ec; color: #e91e63;">
                                                        <i class="fas fa-map-marker-alt"></i>
                                                    </div>
                                                    <h5>Location</h5>
                                                    <p>Behind the Student Union Building, opposite the Faculty of Arts. Clearly marked with green signage.</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="info-box">
                                                    <div class="info-box-icon" style="background: #e8f6f3; color: #27ae60;">
                                                        <i class="fas fa-clock"></i>
                                                    </div>
                                                    <h5>Operating Hours</h5>
                                                    <p>Outpatient: 24/7<br>Emergency: 24/7<br>Pharmacy: 8 AM - 8 PM</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Services Offered -->
                        <div class="row mb-5">
                            <div class="col-lg-12">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body p-4">
                                        <h4 class="text-primary mb-4">
                                            <i class="fas fa-stethoscope me-2"></i>Services Offered
                                        </h4>
                                        
                                        <div class="row g-4">
                                            <div class="col-md-4">
                                                <div class="service-card">
                                                    <div class="service-icon" style="background: #e8f4f8; color: #2c3e50;">
                                                        <i class="fas fa-user-md"></i>
                                                    </div>
                                                    <h5>Outpatient Services</h5>
                                                    <p>General consultations, treatment of common illnesses, health screenings, and routine check-ups.</p>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="service-card">
                                                    <div class="service-icon" style="background: #f8d7da; color: #dc3545;">
                                                        <i class="fas fa-ambulance"></i>
                                                    </div>
                                                    <h5>Emergency Services</h5>
                                                    <p>24/7 emergency care, first aid, ambulance service for critical cases, and stabilization.</p>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="service-card">
                                                    <div class="service-icon" style="background: #e8f6f3; color: #27ae60;">
                                                        <i class="fas fa-brain"></i>
                                                    </div>
                                                    <h5>Counseling Services</h5>
                                                    <p>Mental health support, stress management, academic counseling, and referral services.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Health Insurance -->
                        <div class="row mb-5">
                            <div class="col-lg-12">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body p-4">
                                        <h4 class="text-primary mb-4">
                                            <i class="fas fa-shield-alt me-2"></i>Health Insurance
                                        </h4>
                                        
                                        <div class="row g-4">
                                            <div class="col-md-6">
                                                <h6 class="text-primary mb-3">Student Health Insurance:</h6>
                                                <ul class="requirements-list">
                                                    <li><i class="fas fa-check"></i>Mandatory for all registered students</li>
                                                    <li><i class="fas fa-check"></i>Covers basic medical treatment on campus</li>
                                                    <li><i class="fas fa-check"></i>Includes consultation and basic medications</li>
                                                    <li><i class="fas fa-check"></i>Annual premium: ₦5,000 (charged with fees)</li>
                                                </ul>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="warning-box success">
                                                    <h5><i class="fas fa-check-circle"></i>What's Covered</h5>
                                                    <ul class="mb-0">
                                                        <li>Consultation fees</li>
                                                        <li>Basic medications</li>
                                                        <li>Laboratory tests (selected)</li>
                                                        <li>Emergency first aid</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Pharmacy & Referrals -->
                        <div class="row mb-5">
                            <div class="col-lg-12">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body p-4">
                                        <h4 class="text-primary mb-4">
                                            <i class="fas fa-pills me-2"></i>Pharmacy & Referrals
                                        </h4>
                                        
                                        <div class="row g-4">
                                            <div class="col-md-6">
                                                <div class="info-box">
                                                    <div class="info-box-icon" style="background: #fef5e7; color: #e67e22;">
                                                        <i class="fas fa-pills"></i>
                                                    </div>
                                                    <h5>In-house Pharmacy</h5>
                                                    <p>Open 8 AM - 8 PM daily. Stocks essential medications prescribed by the medical center. Payment via student account or out-of-pocket.</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="info-box">
                                                    <div class="info-box-icon" style="background: #f3e5f5; color: #9c27b0;">
                                                        <i class="fas fa-hospital-user"></i>
                                                    </div>
                                                    <h5>Hospital Referrals</h5>
                                                    <p>For specialized treatment, patients are referred to partner hospitals in Maiduguri. Ambulance available for transfers.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Emergency Contacts -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="warning-box danger">
                                    <h5><i class="fas fa-phone-alt"></i>Emergency Contacts</h5>
                                    <div class="row mt-3">
                                        <div class="col-md-4">
                                            <p class="mb-0"><strong>Medical Emergency:</strong><br>+234 800 NAUB MED</p>
                                        </div>
                                        <div class="col-md-4">
                                            <p class="mb-0"><strong>Ambulance:</strong><br>+234 800 NAUB AMB</p>
                                        </div>
                                        <div class="col-md-4">
                                            <p class="mb-0"><strong>Counseling:</strong><br>+234 800 NAUB HLP</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Laboratories Section -->
        <section id="labs" class="section-padding bg-light">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <h2 class="section-title text-center">Laboratories & Facilities</h2>
                        <p class="text-center text-muted mb-5">Hands-on learning facilities across all faculties</p>
                        
                        <!-- Lab Types -->
                        <div class="row mb-5">
                            <div class="col-lg-12">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body p-4">
                                        <h4 class="text-primary mb-4">
                                            <i class="fas fa-flask me-2"></i>Science Laboratories
                                        </h4>
                                        
                                        <div class="row g-4">
                                            <div class="col-md-4">
                                                <div class="service-card">
                                                    <div class="service-icon" style="background: #e8f4f8; color: #2c3e50;">
                                                        <i class="fas fa-atom"></i>
                                                    </div>
                                                    <h5>Physics Lab</h5>
                                                    <p>Well-equipped for experiments in mechanics, optics, electronics, and modern physics.</p>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="service-card">
                                                    <div class="service-icon" style="background: #e8f6f3; color: #27ae60;">
                                                        <i class="fas fa-vial"></i>
                                                    </div>
                                                    <h5>Chemistry Lab</h5>
                                                    <p>Organic, inorganic, and analytical chemistry facilities. Fume hoods and safety equipment.</p>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="service-card">
                                                    <div class="service-icon" style="background: #fef5e7; color: #e67e22;">
                                                        <i class="fas fa-dna"></i>
                                                    </div>
                                                    <h5>Biology Lab</h5>
                                                    <p>Microbiology, botany, and zoology labs with microscope facilities and specimen collection.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Engineering Workshops -->
                        <div class="row mb-5">
                            <div class="col-lg-12">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body p-4">
                                        <h4 class="text-primary mb-4">
                                            <i class="fas fa-cogs me-2"></i>Engineering Workshops
                                        </h4>
                                        
                                        <div class="row g-4">
                                            <div class="col-md-6">
                                                <div class="info-box">
                                                    <div class="info-box-icon" style="background: #e8f4f8; color: #2c3e50;">
                                                        <i class="fas fa-cogs"></i>
                                                    </div>
                                                    <h5>Mechanical Workshop</h5>
                                                    <p>Machine shop, welding, fabrication, and machining equipment. Safety gear provided.</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="info-box">
                                                    <div class="info-box-icon" style="background: #e8f6f3; color: #27ae60;">
                                                        <i class="fas fa-bolt"></i>
                                                    </div>
                                                    <h5>Electrical/Electronics Lab</h5>
                                                    <p>Circuit design, electronics, power systems, and instrumentation equipment.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Specialized Facilities -->
                        <div class="row mb-5">
                            <div class="col-lg-12">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body p-4">
                                        <h4 class="text-primary mb-4">
                                            <i class="fas fa-language me-2"></i>Specialized Labs
                                        </h4>
                                        
                                        <div class="row g-4">
                                            <div class="col-md-4">
                                                <div class="service-card">
                                                    <div class="service-icon" style="background: #fce4ec; color: #e91e63;">
                                                        <i class="fas fa-language"></i>
                                                    </div>
                                                    <h5>Language Lab</h5>
                                                    <p>Digital language learning with audio-visual equipment. English, French, and Arabic resources.</p>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="service-card">
                                                    <div class="service-icon" style="background: #f3e5f5; color: #9c27b0;">
                                                        <i class="fas fa-palette"></i>
                                                    </div>
                                                    <h5>Art Studio</h5>
                                                    <p>Painting, drawing, sculpture, and craft facilities. Open studio hours for all students.</p>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="service-card">
                                                    <div class="service-icon" style="background: #fff3e0; color: #ff9800;">
                                                        <i class="fas fa-photo-video"></i>
                                                    </div>
                                                    <h5>Media Studio</h5>
                                                    <p>Photography, video production, and digital media editing equipment.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Safety Guidelines -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="warning-box">
                                    <h5><i class="fas fa-hard-hat"></i>Laboratory Safety Guidelines</h5>
                                    <div class="row mt-3">
                                        <div class="col-md-6">
                                            <ul class="mb-0">
                                                <li>Always wear appropriate PPE (lab coat, goggles, gloves)</li>
                                                <li>No food or drinks in laboratory areas</li>
                                                <li>Read all procedures before starting experiments</li>
                                                <li>Know the location of safety equipment</li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6">
                                            <ul class="mb-0">
                                                <li>Report all accidents immediately</li>
                                                <li>No unauthorized experiments</li>
                                                <li>Keep workspace clean and organized</li>
                                                <li>Proper disposal of chemicals and waste</li>
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

        <!-- Student Activities Section -->
        <section id="activities" class="section-padding">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <h2 class="section-title text-center">Student Activities & Organizations</h2>
                        <p class="text-center text-muted mb-5">Get involved and enrich your university experience</p>
                        
                        <!-- Organizations -->
                        <div class="row mb-5">
                            <div class="col-lg-12">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body p-4">
                                        <h4 class="text-primary mb-4">
                                            <i class="fas fa-users me-2"></i>Student Organizations
                                        </h4>
                                        
                                        <div class="row g-4">
                                            <div class="col-md-4">
                                                <div class="activity-card">
                                                    <div class="activity-icon" style="background: #e8f4f8; color: #2c3e50;">
                                                        <i class="fas fa-user-tie"></i>
                                                    </div>
                                                    <h5>Student Union</h5>
                                                    <p>Your voice in university governance. Elected representatives organize events and advocate for student rights.</p>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="activity-card">
                                                    <div class="activity-icon" style="background: #e8f6f3; color: #27ae60;">
                                                        <i class="fas fa-book"></i>
                                                    </div>
                                                    <h5>Academic Associations</h5>
                                                    <p>Department-specific clubs that organize seminars, workshops, and academic competitions.</p>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="activity-card">
                                                    <div class="activity-icon" style="background: #fef5e7; color: #e67e22;">
                                                        <i class="fas fa-music"></i>
                                                    </div>
                                                    <h5>Cultural Clubs</h5>
                                                    <p>Music, drama, dance, and arts groups. Annual cultural festival showcases diversity.</p>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row g-4 mt-2">
                                            <div class="col-md-6">
                                                <div class="activity-card">
                                                    <div class="activity-icon" style="background: #fce4ec; color: #e91e63;">
                                                        <i class="fas fa-mosque"></i>
                                                    </div>
                                                    <h5>Religious Groups</h5>
                                                    <p>Christian Fellowship, Muslim Students' Society, and other religious organizations for spiritual growth.</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="activity-card">
                                                    <div class="activity-icon" style="background: #f3e5f5; color: #9c27b0;">
                                                        <i class="fas fa-hands-helping"></i>
                                                    </div>
                                                    <h5>Volunteer Opportunities</h5>
                                                    <p>Community service, outreach programs, and charity initiatives. Make a difference in the local community.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- How to Join -->
                        <div class="row mb-5">
                            <div class="col-lg-12">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body p-4">
                                        <h4 class="text-primary mb-4">
                                            <i class="fas fa-user-plus me-2"></i>How to Join
                                        </h4>
                                        
                                        <div class="row g-4">
                                            <div class="col-md-6">
                                                <ul class="requirements-list">
                                                    <li><i class="fas fa-check"></i>Attend club fairs during orientation week</li>
                                                    <li><i class="fas fa-check"></i>Visit the Student Affairs Office for club directory</li>
                                                    <li><i class="fas fa-check"></i>Follow club social media pages</li>
                                                    <li><i class="fas fa-check"></i>Attend introductory meetings</li>
                                                </ul>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="warning-box info">
                                                    <h5><i class="fas fa-info-circle"></i>Benefits of Joining</h5>
                                                    <ul class="mb-0">
                                                        <li>Build leadership skills</li>
                                                        <li>Network with peers</li>
                                                        <li>Enhance your CV</li>
                                                        <li>Make lifelong friends</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Annual Events -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body p-4">
                                        <h4 class="text-primary mb-4">
                                            <i class="fas fa-calendar-star me-2"></i>Annual Events
                                        </h4>
                                        
                                        <div class="row g-4">
                                            <div class="col-md-6">
                                                <ul class="requirements-list">
                                                    <li><i class="fas fa-star"></i><strong>Freshers' Night:</strong> Welcome party for new students</li>
                                                    <li><i class="fas fa-star"></i><strong>Cultural Festival:</strong> Celebration of diversity</li>
                                                    <li><i class="fas fa-star"></i><strong>Sports Week:</strong> Inter-faculty competitions</li>
                                                </ul>
                                            </div>
                                            <div class="col-md-6">
                                                <ul class="requirements-list">
                                                    <li><i class="fas fa-star"></i><strong>Academic Conference:</strong> Student research showcase</li>
                                                    <li><i class="fas fa-star"></i><strong>Convocation:</strong> Graduation ceremony</li>
                                                    <li><i class="fas fa-star"></i><strong>End of Year Party:</strong> Celebration of achievements</li>
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

        <!-- Sports Section -->
        <section id="sports" class="section-padding bg-light">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <h2 class="section-title text-center">Sports & Recreational Facilities</h2>
                        <p class="text-center text-muted mb-5">Stay active and healthy at NAUB</p>
                        
                        <!-- Sports Facilities -->
                        <div class="row mb-5">
                            <div class="col-lg-12">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body p-4">
                                        <h4 class="text-primary mb-4">
                                            <i class="fas fa-football me-2"></i>Sports Facilities
                                        </h4>
                                        
                                        <div class="row g-4">
                                            <div class="col-md-4">
                                                <div class="service-card">
                                                    <div class="service-icon" style="background: #e8f4f8; color: #2c3e50;">
                                                        <i class="fas fa-futbol"></i>
                                                    </div>
                                                    <h5>Football Field</h5>
                                                    <p>Full-size standard pitch with floodlights for night games. Home to the university football team.</p>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="service-card">
                                                    <div class="service-icon" style="background: #e8f6f3; color: #27ae60;">
                                                        <i class="fas fa-basketball-ball"></i>
                                                    </div>
                                                    <h5>Basketball Courts</h5>
                                                    <p>Multiple outdoor courts with professional flooring. Indoor court available in sports complex.</p>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="service-card">
                                                    <div class="service-icon" style="background: #fef5e7; color: #e67e22;">
                                                        <i class="fas fa-volleyball-ball"></i>
                                                    </div>
                                                    <h5>Volleyball Courts</h5>
                                                    <p>Sand and hard courts available. Regular tournaments organized throughout the year.</p>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row g-4 mt-2">
                                            <div class="col-md-6">
                                                <div class="service-card">
                                                    <div class="service-icon" style="background: #fce4ec; color: #e91e63;">
                                                        <i class="fas fa-dumbbell"></i>
                                                    </div>
                                                    <h5>Gymnasium</h5>
                                                    <p>Fully equipped gym with modern fitness equipment. Personal trainers available. Monthly membership: ₦2,000</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="service-card">
                                                    <div class="service-icon" style="background: #f3e5f5; color: #9c27b0;">
                                                        <i class="fas fa-swimming-pool"></i>
                                                    </div>
                                                    <h5>Sports Complex</h5>
                                                    <p>Indoor sports hall for badminton, table tennis, and athletics training. Also houses the gym.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Inter-Faculty Sports -->
                        <div class="row mb-5">
                            <div class="col-lg-12">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body p-4">
                                        <h4 class="text-primary mb-4">
                                            <i class="fas fa-trophy me-2"></i>Inter-Faculty Sports
                                        </h4>
                                        
                                        <p class="text-muted mb-4">The annual Inter-Faculty Games (IFG) is the biggest sporting event, where faculties compete for the championship trophy.</p>
                                        
                                        <div class="row g-4">
                                            <div class="col-md-6">
                                                <div class="info-box">
                                                    <div class="info-box-icon" style="background: #e8f4f8; color: #2c3e50;">
                                                        <i class="fas fa-medal"></i>
                                                    </div>
                                                    <h5>Competition Sports</h5>
                                                    <p>Football, basketball, volleyball, athletics, badminton, table tennis, and more.</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="info-box">
                                                    <div class="info-box-icon" style="background: #e8f6f3; color: #27ae60;">
                                                        <i class="fas fa-calendar"></i>
                                                    </div>
                                                    <h5>When</h5>
                                                    <p>Usually held in the second semester. Registration opens at the beginning of each semester.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Fitness Programs -->
                        <div class="row mb-5">
                            <div class="col-lg-12">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body p-4">
                                        <h4 class="text-primary mb-4">
                                            <i class="fas fa-running me-2"></i>Fitness Programs
                                        </h4>
                                        
                                        <div class="row g-4">
                                            <div class="col-md-4">
                                                <div class="text-center p-3">
                                                    <i class="fas fa-dumbbell text-primary fa-2x mb-3"></i>
                                                    <h6>Weight Training</h6>
                                                    <p class="mb-0 text-muted">Guided sessions available</p>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="text-center p-3">
                                                    <i class="fas fa-walking text-primary fa-2x mb-3"></i>
                                                    <h6>Cardio Classes</h6>
                                                    <p class="mb-0 text-muted">Morning and evening sessions</p>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="text-center p-3">
                                                    <i class="fas fa-running text-primary fa-2x mb-3"></i>
                                                    <h6> Athletics Training</h6>
                                                    <p class="mb-0 text-muted">For all skill levels</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- How to Access -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="warning-box success">
                                    <h5><i class="fas fa-key"></i>How to Access Sports Facilities</h5>
                                    <div class="row mt-3">
                                        <div class="col-md-6">
                                            <ul class="mb-0">
                                                <li>Use your student ID card for entry</li>
                                                <li>Register at the Sports Office for team sports</li>
                                                <li>Join sports clubs through the Student Affairs Office</li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6">
                                            <ul class="mb-0">
                                                <li>Gym membership available at the Sports Complex</li>
                                                <li>Equipment available for loan with ID deposit</li>
                                                <li>Follow schedule for facility availability</li>
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

        <!-- CTA Section -->
        <section class="cta-section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h2 class="mb-3">Experience NAUB Campus Life</h2>
                        <p class="mb-4 opacity-75">Everything you need for a fulfilling university experience is here</p>
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
