<?php
/**
 * FAQ Page
 * Nigerian Army University, Biu - Orientation Portal
 */

// Page configuration
$page_title = 'Frequently Asked Questions';
$page_description = 'Find answers to common questions about NAUB - Registration, Portal, Hostel, Academic Matters, and more';

// Include required files
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/includes/functions.php';

// Get FAQs from database
$faqs = get_all_faqs();
$categories = get_faq_categories();

// Default categories if database doesn't have them
$default_categories = [
    'Registration',
    'Portal & Login',
    'Documents & Clearance',
    'Hostel & Accommodation',
    'Health Services',
    'Academic Matters',
    'Student Activities',
    'Facilities',
    'Financial'
];

// Use database categories or fallback to defaults
$all_categories = !empty($categories) ? $categories : $default_categories;

// Default FAQs if database is empty
$default_faqs = [
    // Registration (3 FAQs)
    [
        'question' => 'How do I complete my registration?',
        'answer' => 'To complete your registration, log in to the student portal using your matric number and password. Navigate to the Registration section, select your courses, and proceed to payment. After payment, generate your registration slip. Make sure to verify all details before submission.',
        'category' => 'Registration'
    ],
    [
        'question' => 'What is the deadline for course registration?',
        'answer' => 'Course registration typically closes two weeks after the start of lectures. For the 2025/2026 session, the deadline is October 6, 2025. Late registration attracts a penalty fee.',
        'category' => 'Registration'
    ],
    [
        'question' => 'Can I change my courses after registration?',
        'answer' => 'Course changes are allowed only during the add/drop period, which is the first two weeks of the semester. Log in to the student portal, navigate to Course Registration, and use the add/drop function. Note that some courses may have prerequisites or capacity limits.',
        'category' => 'Registration'
    ],
    
    // Portal & Login (2 FAQs)
    [
        'question' => 'How do I reset my student portal password?',
        'answer' => 'Visit the IT Help Desk located in the Library building or email support@naub.edu.ng with your matric number and a valid ID. You will receive a temporary password within 24 hours.',
        'category' => 'Portal & Login'
    ],
    [
        'question' => 'What do I do if I cannot access my student portal?',
        'answer' => 'First, ensure you are using the correct URL (portal.naub.edu.ng). Clear your browser cache and cookies. If the problem persists, contact the IT Help Desk at +234 800 NAUB IT or visit the Library Building, First Floor.',
        'category' => 'Portal & Login'
    ],
    
    // Documents & Clearance (3 FAQs)
    [
        'question' => 'Where can I get my student ID card?',
        'answer' => 'Student ID cards are processed at the Registry Office in the Main Administrative Block. Bring your registration slip and passport photographs. Processing takes 3-5 working days.',
        'category' => 'Documents & Clearance'
    ],
    [
        'question' => 'How do I get my transcript?',
        'answer' => 'Submit a transcript request application at the Registry Office. The processing fee is applicable. Transcripts are usually ready within 5-7 working days. You can also request digital transcripts via email to registry@naub.edu.ng.',
        'category' => 'Documents & Clearance'
    ],
    [
        'question' => 'What documents do I need for school clearance?',
        'answer' => 'You will need: (1) Valid student ID card, (2) Registration slip, (3) Payment receipts, (4) Medical certificate, and (5) Completed clearance form from your department. Visit the Registry for final clearance.',
        'category' => 'Documents & Clearance'
    ],
    
    // Hostel & Accommodation (3 FAQs)
    [
        'question' => 'How do I apply for hostel accommodation?',
        'answer' => 'Log in to the student portal, navigate to Hostel Application, fill in the required details, and submit. Accommodation is allocated on a first-come, first-served basis. Priority is given to fresh students and final year students.',
        'category' => 'Hostel & Accommodation'
    ],
    [
        'question' => 'What documents do I need for hostel clearance?',
        'answer' => 'You need your student ID card, registration slip, hostel application form, and a medical certificate. Report to the Hostel Warden with these documents for room allocation.',
        'category' => 'Hostel & Accommodation'
    ],
    [
        'question' => 'What is the hostel allocation process?',
        'answer' => 'Hostel allocation is done electronically based on your application. Fresh students are given priority. Check your portal for allocation status. Once allocated, report to your allocated hostel within 48 hours for room assignment.',
        'category' => 'Hostel & Accommodation'
    ],
    
    // Health Services (2 FAQs)
    [
        'question' => 'Where is the health center located?',
        'answer' => 'The University Health Center is located near the Main Administrative Block, opposite the Students Union Building. It is open 24/7 for emergencies.',
        'category' => 'Health Services'
    ],
    [
        'question' => 'How do I report a medical emergency?',
        'answer' => 'Call the emergency hotline at +234 800 NAUB HELP or visit the Health Center immediately. For after-hours emergencies, proceed to the nearest hospital and notify the university.',
        'category' => 'Health Services'
    ],
    
    // Academic Matters (3 FAQs)
    [
        'question' => 'Where can I find my lecture timetable?',
        'answer' => 'Your personalized lecture timetable is available on the student portal under Academic Information. You can also check the notice boards at your faculty building.',
        'category' => 'Academic Matters'
    ],
    [
        'question' => 'How do I apply for a leave of absence?',
        'answer' => 'Obtain a Leave of Absence form from the Dean of Students Affairs, fill it out with supporting documents, and submit to your Head of Department for approval.',
        'category' => 'Academic Matters'
    ],
    [
        'question' => 'What is the grading system at NAUB?',
        'answer' => 'NAUB uses a 5-point grading system: A (70-100%) = 5 points, B (60-69%) = 4 points, C (50-59%) = 3 points, D (45-49%) = 2 points, F (0-44%) = 0 points. The Cumulative Grade Point Average (CGPA) determines your academic standing.',
        'category' => 'Academic Matters'
    ],
    [
        'question' => 'What happens if I miss an examination?',
        'answer' => 'If you miss an examination due to illness or other valid reasons, you must apply for a Make-up Examination within 48 hours. Submit a medical certificate or supporting documents to the Dean of your Faculty.',
        'category' => 'Academic Matters'
    ],
    
    // Student Activities (2 FAQs)
    [
        'question' => 'How do I join a student club or society?',
        'answer' => 'Visit the Students Union Office to see the list of registered clubs and societies. Complete the membership form for your chosen organization and pay the prescribed fee.',
        'category' => 'Student Activities'
    ],
    [
        'question' => 'Are there sports facilities available for students?',
        'answer' => 'Yes! NAUB has excellent sports facilities including a football field, basketball court, tennis court, volleyball court, and a gymnasium. Visit the Sports Unit in the Sports Complex to register and access these facilities.',
        'category' => 'Student Activities'
    ],
    
    // Facilities (2 FAQs)
    [
        'question' => 'Where can I access the internet on campus?',
        'answer' => 'NAUB provides Wi-Fi connectivity in all faculty buildings, the library, and hostel areas. Use your student credentials to log in to the NAUB-WIFI network.',
        'category' => 'Facilities'
    ],
    [
        'question' => 'What are the library opening hours?',
        'answer' => 'The library is open Monday - Friday from 8:00 AM to 10:00 PM, Saturday from 9:00 AM to 6:00 PM, and Sunday from 2:00 PM to 6:00 PM. Bring your student ID card for access.',
        'category' => 'Facilities'
    ],
    
    // Financial (2 FAQs)
    [
        'question' => 'How do I apply for a scholarship?',
        'answer' => 'Information about scholarships is advertised on the university notice boards and website. Check regularly for opportunities. Most scholarships require a minimum CGPA of 3.5.',
        'category' => 'Financial'
    ],
    [
        'question' => 'What payment methods are available for tuition fees?',
        'answer' => 'Tuition fees can be paid through the university designated bank branches, online payment portal, or mobile banking. Log in to your student portal for payment instructions and generate your payment invoice.',
        'category' => 'Financial'
    ]
];

// Use database FAQs if available, otherwise use defaults
$display_faqs = !empty($faqs) ? $faqs : $default_faqs;

// Group FAQs by category for display
$faqs_by_category = [];
foreach ($display_faqs as $faq) {
    $cat = isset($faq['category']) && !empty($faq['category']) ? $faq['category'] : 'General';
    if (!isset($faqs_by_category[$cat])) {
        $faqs_by_category[$cat] = [];
    }
    $faqs_by_category[$cat][] = $faq;
}
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
        /* FAQ Page Specific Styles */
        .faq-hero {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            padding: 80px 0;
            position: relative;
            overflow: hidden;
        }
        
        .faq-hero::before {
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
        
        .search-container {
            max-width: 600px;
            margin: 0 auto;
            position: relative;
        }
        
        .search-container .form-control {
            padding: 15px 20px 15px 50px;
            border-radius: 50px;
            font-size: 16px;
            border: 2px solid rgba(255,255,255,0.3);
            background: rgba(255,255,255,0.95);
        }
        
        .search-container .form-control:focus {
            background: white;
            border-color: white;
            box-shadow: 0 0 0 4px rgba(255,255,255,0.2);
        }
        
        .search-container .search-icon {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #1e3c72;
            font-size: 18px;
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
        
        /* Category Sidebar */
        .category-sidebar {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            padding: 20px;
            position: sticky;
            top: 100px;
        }
        
        .category-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .category-list li {
            margin-bottom: 5px;
        }
        
        .category-btn {
            display: flex;
            align-items: center;
            width: 100%;
            padding: 12px 15px;
            border: none;
            background: transparent;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: left;
            color: #333;
            font-weight: 500;
        }
        
        .category-btn:hover {
            background: #f8f9fa;
            color: #1e3c72;
        }
        
        .category-btn.active {
            background: #1e3c72;
            color: white;
        }
        
        .category-btn i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }
        
        .category-count {
            margin-left: auto;
            background: #e9ecef;
            padding: 2px 8px;
            border-radius: 10px;
            font-size: 12px;
        }
        
        .category-btn.active .category-count {
            background: rgba(255,255,255,0.2);
            color: white;
        }
        
        /* FAQ Accordion */
        .faq-accordion {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        
        .faq-item {
            border-bottom: 1px solid #eee;
        }
        
        .faq-item:last-child {
            border-bottom: none;
        }
        
        .faq-question {
            display: flex;
            align-items: center;
            width: 100%;
            padding: 20px;
            background: transparent;
            border: none;
            text-align: left;
            cursor: pointer;
            transition: background 0.3s ease;
            font-weight: 600;
            color: #333;
        }
        
        .faq-question:hover {
            background: #f8f9fa;
        }
        
        .faq-question .category-badge {
            font-size: 10px;
            padding: 3px 8px;
            background: #e9ecef;
            color: #666;
            border-radius: 10px;
            margin-right: 10px;
            font-weight: 500;
            white-space: nowrap;
        }
        
        .faq-question .icon {
            margin-left: auto;
            transition: transform 0.3s ease;
            color: #1e3c72;
        }
        
        .faq-question[aria-expanded="true"] .icon {
            transform: rotate(180deg);
        }
        
        .faq-answer {
            padding: 0 20px 20px 20px;
            color: #666;
            line-height: 1.7;
        }
        
        .faq-answer ul {
            margin-bottom: 10px;
            padding-left: 20px;
        }
        
        /* No Results Message */
        .no-results {
            text-align: center;
            padding: 40px;
            color: #666;
        }
        
        .no-results i {
            font-size: 48px;
            color: #dee2e6;
            margin-bottom: 15px;
        }
        
        /* Can't Find Answer Section */
        .cant-find-section {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            border-radius: 12px;
            padding: 40px;
            text-align: center;
        }
        
        .cant-find-section h3 {
            margin-bottom: 15px;
        }
        
        .cant-find-section p {
            opacity: 0.9;
            margin-bottom: 25px;
        }
        
        .cant-find-section .btn {
            padding: 12px 30px;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .faq-hero {
                padding: 50px 0;
            }
            
            .section-padding {
                padding: 40px 0;
            }
            
            .category-sidebar {
                position: static;
                margin-bottom: 30px;
            }
            
            .category-list {
                display: flex;
                flex-wrap: wrap;
                gap: 8px;
            }
            
            .category-btn {
                flex: 1 1 auto;
                min-width: 120px;
                justify-content: center;
                padding: 10px;
                font-size: 14px;
            }
            
            .category-btn .category-count {
                display: none;
            }
            
            .faq-question {
                font-size: 15px;
                padding: 15px;
            }
            
            .faq-answer {
                padding: 0 15px 15px 15px;
                font-size: 14px;
            }
            
            .cant-find-section {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <?php include __DIR__ . '/includes/header.php'; ?>

    <!-- Hero Section -->
    <section class="faq-hero">
        <div class="container position-relative">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h1 class="display-4 fw-bold mb-3">Frequently Asked Questions</h1>
                    <p class="lead mb-4">Find answers to common questions about NAUB</p>
                    
                    <!-- Search Bar -->
                    <div class="search-container">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" id="faqSearch" class="form-control" placeholder="Search for answers...">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <main>
        <section class="section-padding">
            <div class="container">
                <div class="row g-4">
                    <!-- Category Sidebar -->
                    <div class="col-lg-3">
                        <div class="category-sidebar">
                            <h5 class="mb-3">
                                <i class="fas fa-tags me-2"></i>Categories
                            </h5>
                            <ul class="category-list">
                                <li>
                                    <button class="category-btn active" data-category="all">
                                        <i class="fas fa-list"></i>
                                        All Questions
                                        <span class="category-count"><?php echo count($display_faqs); ?></span>
                                    </button>
                                </li>
                                <?php foreach ($all_categories as $category): ?>
                                <li>
                                    <button class="category-btn" data-category="<?php echo sanitize($category); ?>">
                                        <i class="fas fa-folder"></i>
                                        <?php echo sanitize($category); ?>
                                        <span class="category-count"><?php echo isset($faqs_by_category[$category]) ? count($faqs_by_category[$category]) : 0; ?></span>
                                    </button>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                    
                    <!-- FAQ Accordion -->
                    <div class="col-lg-9">
                        <div class="faq-accordion" id="faqAccordion">
                            <?php 
                            $faq_counter = 0;
                            foreach ($faqs_by_category as $category => $category_faqs): 
                                foreach ($category_faqs as $faq): 
                                    $faq_counter++;
                            ?>
                            <div class="faq-item" data-category="<?php echo sanitize($category); ?>">
                                <button class="faq-question" type="button" data-bs-toggle="collapse" data-bs-target="#faq<?php echo $faq_counter; ?>" aria-expanded="false">
                                    <span class="category-badge"><?php echo sanitize($category); ?></span>
                                    <span><?php echo sanitize($faq['question']); ?></span>
                                    <i class="fas fa-chevron-down icon"></i>
                                </button>
                                <div id="faq<?php echo $faq_counter; ?>" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="faq-answer">
                                        <?php echo nl2br(sanitize($faq['answer'])); ?>
                                    </div>
                                </div>
                            </div>
                            <?php 
                                endforeach;
                            endforeach; 
                            ?>
                        </div>
                        
                        <!-- No Results Message -->
                        <div class="no-results" id="noResults" style="display: none;">
                            <i class="fas fa-search"></i>
                            <h4>No FAQs Found</h4>
                            <p>Try adjusting your search terms or browse by category.</p>
                        </div>
                        
                        <p class="faq-count text-muted mt-3" id="faqCount">
                            Showing <?php echo count($display_faqs); ?> of <?php echo count($display_faqs); ?> FAQs
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Can't Find Answer Section -->
        <section class="section-padding bg-light">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="cant-find-section">
                            <h3><i class="fas fa-question-circle me-2"></i>Can't Find Your Answer?</h3>
                            <p>If you couldn't find the answer to your question, please don't hesitate to reach out to our support team. We're here to help!</p>
                            <div class="d-flex gap-3 justify-content-center flex-wrap">
                                <a href="contact.php" class="btn btn-light">
                                    <i class="fas fa-envelope me-2"></i>Contact Us
                                </a>
                                <a href="support.php" class="btn btn-outline-light">
                                    <i class="fas fa-headset me-2"></i>Support Services
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <?php include __DIR__ . '/includes/footer.php'; ?>
    
    <!-- FAQ JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // FAQ Search Functionality
            const searchInput = document.getElementById('faqSearch');
            const faqItems = document.querySelectorAll('.faq-item');
            const noResults = document.getElementById('noResults');
            const faqCount = document.getElementById('faqCount');
            
            // Category Filter
            const categoryBtns = document.querySelectorAll('.category-btn');
            let activeCategory = 'all';
            
            categoryBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    // Update active state
                    categoryBtns.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                    
                    activeCategory = this.dataset.category;
                    filterFAQs();
                });
            });
            
            // Search functionality
            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    filterFAQs();
                });
            }
            
            function filterFAQs() {
                const searchTerm = searchInput.value.toLowerCase().trim();
                let visibleCount = 0;
                
                faqItems.forEach(item => {
                    const category = item.dataset.category;
                    const question = item.querySelector('.faq-question span:last-child').textContent.toLowerCase();
                    const answer = item.querySelector('.faq-answer').textContent.toLowerCase();
                    
                    const matchesSearch = searchTerm === '' || 
                        question.includes(searchTerm) || 
                        answer.includes(searchTerm);
                    
                    const matchesCategory = activeCategory === 'all' || 
                        category === activeCategory;
                    
                    if (matchesSearch && matchesCategory) {
                        item.style.display = '';
                        visibleCount++;
                    } else {
                        item.style.display = 'none';
                    }
                });
                
                // Update count
                if (faqCount) {
                    const totalCount = faqItems.length;
                    faqCount.textContent = `Showing ${visibleCount} of ${totalCount} FAQs`;
                }
                
                // Show/hide no results message
                if (noResults) {
                    noResults.style.display = visibleCount === 0 ? 'block' : 'none';
                }
            }
        });
    </script>
</body>
</html>
