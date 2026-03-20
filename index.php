<?php
/**
 * Home Page
 * NAUB Orientation Portal
 */

// Include required files
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/includes/functions.php';

// Set page title
$page_title = 'Home';

// Fetch latest 3 announcements
$announcements = get_announcements(3);
?>
<?php include __DIR__ . '/includes/header.php'; ?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-overlay"></div>
    <div class="container position-relative">
        <div class="row min-vh-60 align-items-center">
            <div class="col-lg-8">
                <div class="hero-content">
                    <span class="hero-badge mb-3 d-inline-block">
                        <i class="fas fa-graduation-cap me-2"></i>Welcome to NAUB
                    </span>
                    <h1 class="hero-title display-3 fw-bold mb-4">
                        Start Your Journey at<br>
                        <span class="text-accent">Nigerian Army University, Biu</span>
                    </h1>
                    <p class="hero-subtitle lead mb-4">
                        Welcome, Fresh Student! We're excited to have you join the NAUB community. 
                        This orientation portal will guide you through everything you need to know 
                        to get started on your academic journey.
                    </p>
                    <div class="hero-actions d-flex flex-wrap gap-3">
                        <a href="checklist.php" class="btn btn-primary btn-lg px-4">
                            <i class="fas fa-play me-2"></i>Start Orientation
                        </a>
                        <a href="checklist.php" class="btn btn-outline-light btn-lg px-4">
                            <i class="fas fa-clipboard-check me-2"></i>View Checklist
                        </a>
                        <a href="faqs.php" class="btn btn-outline-light btn-lg px-4">
                            <i class="fas fa-question-circle me-2"></i>FAQs
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="hero-wave">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" preserveAspectRatio="none">
            <path fill="#ffffff" fill-opacity="1" d="M0,96L48,112C96,128,192,160,288,165.3C384,171,480,149,576,128C672,107,768,85,864,90.7C960,96,1056,128,1152,138.7C1248,149,1344,139,1392,133.3L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
    </div>
</section>

<!-- Quick Navigation Cards -->
<section class="py-5">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h2 class="section-title">Quick Navigation</h2>
                <p class="section-subtitle">Find what you need quickly</p>
            </div>
        </div>
        
        <div class="row g-4">
            <!-- About NAUB -->
            <div class="col-md-6 col-lg-4">
                <a href="page.php?slug=about" class="text-decoration-none">
                    <div class="nav-card h-100">
                        <div class="nav-card-icon">
                            <i class="fas fa-university"></i>
                        </div>
                        <h3 class="nav-card-title">About NAUB</h3>
                        <p class="nav-card-text">Learn about our history, mission, vision, and core values</p>
                        <span class="nav-card-link">Explore <i class="fas fa-arrow-right ms-1"></i></span>
                    </div>
                </a>
            </div>
            
            <!-- Fresh Student Guide -->
            <div class="col-md-6 col-lg-4">
                <a href="page.php?slug=admission-requirements" class="text-decoration-none">
                    <div class="nav-card h-100">
                        <div class="nav-card-icon">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <h3 class="nav-card-title">Fresh Student Guide</h3>
                        <p class="nav-card-text">Everything you need to know as a new student</p>
                        <span class="nav-card-link">Explore <i class="fas fa-arrow-right ms-1"></i></span>
                    </div>
                </a>
            </div>
            
            <!-- Registration Process -->
            <div class="col-md-6 col-lg-4">
                <a href="page.php?slug=registration" class="text-decoration-none">
                    <div class="nav-card h-100">
                        <div class="nav-card-icon">
                            <i class="fas fa-clipboard-list"></i>
                        </div>
                        <h3 class="nav-card-title">Registration Process</h3>
                        <p class="nav-card-text">Step-by-step guide to complete your registration</p>
                        <span class="nav-card-link">Explore <i class="fas fa-arrow-right ms-1"></i></span>
                    </div>
                </a>
            </div>
            
            <!-- Academic Guide -->
            <div class="col-md-6 col-lg-4">
                <a href="page.php?slug=academic-calendar" class="text-decoration-none">
                    <div class="nav-card h-100">
                        <div class="nav-card-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <h3 class="nav-card-title">Academic Guide</h3>
                        <p class="nav-card-text">Academic calendar, grading system, and more</p>
                        <span class="nav-card-link">Explore <i class="fas fa-arrow-right ms-1"></i></span>
                    </div>
                </a>
            </div>
            
            <!-- Campus Life -->
            <div class="col-md-6 col-lg-4">
                <a href="page.php?slug=campus-life" class="text-decoration-none">
                    <div class="nav-card h-100">
                        <div class="nav-card-icon">
                            <i class="fas fa-building"></i>
                        </div>
                        <h3 class="nav-card-title">Campus Life</h3>
                        <p class="nav-card-text">Student activities, clubs, sports, and facilities</p>
                        <span class="nav-card-link">Explore <i class="fas fa-arrow-right ms-1"></i></span>
                    </div>
                </a>
            </div>
            
            <!-- Support Services -->
            <div class="col-md-6 col-lg-4">
                <a href="page.php?slug=student-support" class="text-decoration-none">
                    <div class="nav-card h-100">
                        <div class="nav-card-icon">
                            <i class="fas fa-hands-helping"></i>
                        </div>
                        <h3 class="nav-card-title">Support Services</h3>
                        <p class="nav-card-text">Counseling, career services, and academic support</p>
                        <span class="nav-card-link">Explore <i class="fas fa-arrow-right ms-1"></i></span>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Announcements Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12 d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="section-title mb-1">Latest Announcements</h2>
                    <p class="section-subtitle mb-0">Stay updated with important news</p>
                </div>
                <a href="page.php?slug=announcements" class="btn btn-outline-primary">
                    View All <i class="fas fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
        
        <?php if (!empty($announcements)): ?>
            <div class="row g-4">
                <?php foreach ($announcements as $announcement): ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="announcement-card h-100">
                            <div class="announcement-date">
                                <i class="far fa-calendar-alt me-1"></i>
                                <?php echo date('M d, Y', strtotime($announcement['created_at'])); ?>
                            </div>
                            <h3 class="announcement-title"><?php echo sanitize($announcement['title']); ?></h3>
                            <p class="announcement-excerpt">
                                <?php 
                                $body = strip_tags($announcement['body']);
                                echo sanitize(strlen($body) > 150 ? substr($body, 0, 150) . '...' : $body);
                                ?>
                            </p>
                            <a href="#" class="announcement-link" data-bs-toggle="modal" data-bs-target="#announcementModal<?php echo $announcement['id']; ?>">
                                Read More <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Announcement Modal -->
                    <div class="modal fade" id="announcementModal<?php echo $announcement['id']; ?>" tabindex="-1" aria-labelledby="announcementModalLabel<?php echo $announcement['id']; ?>" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="announcementModalLabel<?php echo $announcement['id']; ?>">
                                        <?php echo sanitize($announcement['title']); ?>
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p class="text-muted mb-3">
                                        <i class="far fa-calendar-alt me-1"></i>
                                        Posted: <?php echo date('F d, Y', strtotime($announcement['created_at'])); ?>
                                    </p>
                                    <div class="announcement-content">
                                        <?php echo nl2br(sanitize($announcement['body'])); ?>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i>No announcements at this time. Please check back later.
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- Key Highlights Section -->
<section class="py-5">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h2 class="section-title">Key Highlights</h2>
                <p class="section-subtitle">Important information you should know</p>
            </div>
        </div>
        
        <div class="row g-4">
            <!-- Important Dates -->
            <div class="col-lg-4">
                <div class="highlight-card h-100">
                    <div class="highlight-header">
                        <div class="highlight-icon">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <h3>Important Dates</h3>
                    </div>
                    <ul class="highlight-list">
                        <li>
                            <span class="date-badge">Sep 1-15</span>
                            <span>Course Registration</span>
                        </li>
                        <li>
                            <span class="date-badge">Sep 16</span>
                            <span>Orientation Week Begins</span>
                        </li>
                        <li>
                            <span class="date-badge">Sep 23</span>
                            <span>Lectures Begin</span>
                        </li>
                        <li>
                            <span class="date-badge">Nov 4-8</span>
                            <span>Mid-Semester Exams</span>
                        </li>
                        <li>
                            <span class="date-badge">Dec 9</span>
                            <span>Examinations Begin</span>
                        </li>
                    </ul>
                    <a href="page.php?slug=academic-calendar" class="highlight-link">
                        View Full Calendar <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
            
            <!-- Quick Links -->
            <div class="col-lg-4">
                <div class="highlight-card h-100">
                    <div class="highlight-header">
                        <div class="highlight-icon">
                            <i class="fas fa-link"></i>
                        </div>
                        <h3>Quick Links</h3>
                    </div>
                    <ul class="highlight-list quick-links">
                        <li>
                            <a href="#" target="_blank">
                                <i class="fas fa-external-link-alt me-2"></i>Student Portal
                            </a>
                        </li>
                        <li>
                            <a href="#" target="_blank">
                                <i class="fas fa-external-link-alt me-2"></i>Course Registration
                            </a>
                        </li>
                        <li>
                            <a href="#" target="_blank">
                                <i class="fas fa-external-link-alt me-2"></i>Library Services
                            </a>
                        </li>
                        <li>
                            <a href="#" target="_blank">
                                <i class="fas fa-external-link-alt me-2"></i>Hostel Application
                            </a>
                        </li>
                        <li>
                            <a href="#" target="_blank">
                                <i class="fas fa-external-link-alt me-2"></i>Student Email
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Emergency Contacts -->
            <div class="col-lg-4">
                <div class="highlight-card h-100">
                    <div class="highlight-header">
                        <div class="highlight-icon emergency">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <h3>Emergency Contacts</h3>
                    </div>
                    <ul class="highlight-list emergency-contacts">
                        <li>
                            <div class="contact-info">
                                <strong>Security Office</strong>
                                <span>+234 800 NAUB SEC</span>
                            </div>
                        </li>
                        <li>
                            <div class="contact-info">
                                <strong>Health Center</strong>
                                <span>+234 800 NAUB HLT</span>
                            </div>
                        </li>
                        <li>
                            <div class="contact-info">
                                <strong>Student Affairs</strong>
                                <span>+234 800 NAUB STD</span>
                            </div>
                        </li>
                        <li>
                            <div class="contact-info">
                                <strong>IT Support</strong>
                                <span>+234 800 NAUB IT</span>
                            </div>
                        </li>
                    </ul>
                    <a href="contact.php" class="highlight-link">
                        View All Contacts <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Search Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="search-section text-center">
                    <h2 class="search-title">Need Help?</h2>
                    <p class="search-subtitle">Search our FAQs for answers to common questions</p>
                    
                    <form action="faqs.php" method="GET" class="search-form">
                        <div class="input-group input-group-lg">
                            <span class="input-group-text bg-white border-end-0">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input type="text" 
                                   name="search" 
                                   class="form-control border-start-0" 
                                   placeholder="Search for questions..."
                                   aria-label="Search FAQs">
                            <button type="submit" class="btn btn-primary px-4">
                                Search
                            </button>
                        </div>
                    </form>
                    
                    <div class="search-suggestions mt-3">
                        <span class="text-muted me-2">Popular searches:</span>
                        <a href="faqs.php?search=registration" class="badge bg-light text-dark text-decoration-none me-1">registration</a>
                        <a href="faqs.php?search=hostel" class="badge bg-light text-dark text-decoration-none me-1">hostel</a>
                        <a href="faqs.php?search=fees" class="badge bg-light text-dark text-decoration-none me-1">fees</a>
                        <a href="faqs.php?search=ID card" class="badge bg-light text-dark text-decoration-none me-1">ID card</a>
                        <a href="faqs.php?search=schedule" class="badge bg-light text-dark text-decoration-none">schedule</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-5">
    <div class="container">
        <div class="cta-box text-center">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h2 class="cta-title">Ready to Begin?</h2>
                    <p class="cta-text">Complete your orientation checklist to ensure you're fully prepared for your first day at NAUB</p>
                    <div class="d-flex flex-wrap justify-content-center gap-3">
                        <a href="checklist.php" class="btn btn-primary btn-lg">
                            <i class="fas fa-clipboard-list me-2"></i>Go to Checklist
                        </a>
                        <a href="contact.php" class="btn btn-outline-primary btn-lg">
                            <i class="fas fa-envelope me-2"></i>Contact Us
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Additional CSS for this page -->
<style>
/* Hero Section Styles */
.hero-section {
    background: linear-gradient(135deg, #1a365d 0%, #2c5282 50%, #1a365d 100%);
    background-size: cover;
    background-position: center;
    position: relative;
    min-height: 70vh;
    display: flex;
    align-items: center;
}

.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
}

.hero-content {
    position: relative;
    z-index: 1;
    color: white;
}

.hero-badge {
    background: rgba(255, 255, 255, 0.2);
    padding: 8px 16px;
    border-radius: 50px;
    font-size: 0.9rem;
    font-weight: 500;
    backdrop-filter: blur(5px);
}

.hero-title {
    line-height: 1.2;
}

.text-accent {
    color: #63b3ed;
}

.hero-actions .btn {
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.hero-actions .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
}

.hero-wave {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    overflow: hidden;
    line-height: 0;
    transform: rotate(180deg);
}

.hero-wave svg {
    position: relative;
    display: block;
    width: calc(100% + 1.3px);
    height: 60px;
}

.min-vh-60 {
    min-height: 60vh;
}

/* Section Titles */
.section-title {
    font-size: 2rem;
    font-weight: 700;
    color: #1a365d;
    margin-bottom: 0.5rem;
}

.section-subtitle {
    color: #718096;
    font-size: 1.1rem;
}

/* Navigation Cards */
.nav-card {
    background: white;
    border-radius: 12px;
    padding: 2rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
    border: 1px solid #e2e8f0;
    text-decoration: none;
}

.nav-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    border-color: #3182ce;
}

.nav-card-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #3182ce 0%, #2c5282 100%);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1.25rem;
}

.nav-card-icon i {
    font-size: 1.5rem;
    color: white;
}

.nav-card-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: #1a365d;
    margin-bottom: 0.75rem;
}

.nav-card-text {
    color: #718096;
    font-size: 0.95rem;
    margin-bottom: 1rem;
}

.nav-card-link {
    color: #3182ce;
    font-weight: 500;
    font-size: 0.9rem;
    display: inline-flex;
    align-items: center;
}

.nav-card:hover .nav-card-link {
    color: #2c5282;
}

/* Announcement Cards */
.announcement-card {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
    border: 1px solid #e2e8f0;
}

.announcement-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
}

.announcement-date {
    color: #718096;
    font-size: 0.85rem;
    margin-bottom: 0.75rem;
}

.announcement-title {
    font-size: 1.15rem;
    font-weight: 600;
    color: #1a365d;
    margin-bottom: 0.75rem;
    line-height: 1.4;
}

.announcement-excerpt {
    color: #4a5568;
    font-size: 0.95rem;
    margin-bottom: 1rem;
    line-height: 1.6;
}

.announcement-link {
    color: #3182ce;
    font-weight: 500;
    font-size: 0.9rem;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    cursor: pointer;
}

.announcement-link:hover {
    color: #2c5282;
}

/* Highlight Cards */
.highlight-card {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    border: 1px solid #e2e8f0;
}

.highlight-header {
    display: flex;
    align-items: center;
    margin-bottom: 1.25rem;
}

.highlight-icon {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #3182ce 0%, #2c5282 100%);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1rem;
    flex-shrink: 0;
}

.highlight-icon i {
    font-size: 1.25rem;
    color: white;
}

.highlight-icon.emergency {
    background: linear-gradient(135deg, #e53e3e 0%, #c53030 100%);
}

.highlight-header h3 {
    font-size: 1.1rem;
    font-weight: 600;
    color: #1a365d;
    margin-bottom: 0;
}

.highlight-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.highlight-list li {
    padding: 0.75rem 0;
    border-bottom: 1px solid #e2e8f0;
    display: flex;
    align-items: center;
}

.highlight-list li:last-child {
    border-bottom: none;
}

.date-badge {
    background: #ebf8ff;
    color: #3182ce;
    padding: 4px 10px;
    border-radius: 6px;
    font-size: 0.8rem;
    font-weight: 600;
    margin-right: 0.75rem;
    min-width: 70px;
    text-align: center;
}

.highlight-list.quick-links li a {
    color: #4a5568;
    text-decoration: none;
    display: flex;
    align-items: center;
    width: 100%;
    transition: color 0.2s;
}

.highlight-list.quick-links li a:hover {
    color: #3182ce;
}

.emergency-contacts .contact-info {
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;
}

.emergency-contacts .contact-info strong {
    color: #1a365d;
    font-size: 0.95rem;
}

.emergency-contacts .contact-info span {
    color: #e53e3e;
    font-weight: 600;
    font-size: 0.9rem;
}

.highlight-link {
    display: inline-flex;
    align-items: center;
    color: #3182ce;
    font-weight: 500;
    font-size: 0.9rem;
    margin-top: 1rem;
    text-decoration: none;
}

.highlight-link:hover {
    color: #2c5282;
}

/* Search Section */
.search-section {
    background: white;
    padding: 2.5rem;
    border-radius: 16px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
}

.search-title {
    font-size: 1.75rem;
    font-weight: 700;
    color: #1a365d;
    margin-bottom: 0.5rem;
}

.search-subtitle {
    color: #718096;
    margin-bottom: 1.5rem;
}

.search-form .input-group {
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
}

.search-form .form-control:focus {
    border-color: #3182ce;
    box-shadow: 0 0 0 3px rgba(49, 130, 206, 0.1);
}

.search-suggestions .badge {
    transition: all 0.2s;
}

.search-suggestions .badge:hover {
    background: #3182ce !important;
    color: white !important;
}

/* CTA Section */
.cta-box {
    background: linear-gradient(135deg, #1a365d 0%, #2c5282 100%);
    padding: 3rem 2rem;
    border-radius: 16px;
    color: white;
}

.cta-title {
    font-size: 1.75rem;
    font-weight: 700;
    margin-bottom: 0.75rem;
}

.cta-text {
    opacity: 0.9;
    margin-bottom: 1.5rem;
    font-size: 1.1rem;
}

.cta-box .btn-primary {
    background: white;
    color: #1a365d;
    border: none;
    font-weight: 600;
}

.cta-box .btn-primary:hover {
    background: #e2e8f0;
    color: #1a365d;
}

.cta-box .btn-outline-primary {
    border-color: white;
    color: white;
}

.cta-box .btn-outline-primary:hover {
    background: white;
    color: #1a365d;
}

/* Responsive */
@media (max-width: 768px) {
    .hero-title {
        font-size: 2rem;
    }
    
    .hero-actions {
        flex-direction: column;
    }
    
    .hero-actions .btn {
        width: 100%;
    }
    
    .section-title {
        font-size: 1.5rem;
    }
    
    .search-section {
        padding: 1.5rem;
    }
}
</style>

<?php include __DIR__ . '/includes/footer.php'; ?>
