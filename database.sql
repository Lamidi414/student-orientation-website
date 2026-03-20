-- =====================================================
-- NAUB Orientation Website Database Schema
-- =====================================================
-- Created: 2026-03-20
-- Description: Complete MySQL database schema for NAUB Student Orientation Website
-- =====================================================

-- Set character set and collation
SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- =====================================================
-- TABLE: admins
-- =====================================================
DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `full_name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- TABLE: pages
-- =====================================================
DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `slug` VARCHAR(255) NOT NULL,
  `content` TEXT,
  `category` VARCHAR(100),
  `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- TABLE: faqs
-- =====================================================
DROP TABLE IF EXISTS `faqs`;
CREATE TABLE `faqs` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `question` TEXT NOT NULL,
  `answer` TEXT NOT NULL,
  `category` VARCHAR(100),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- TABLE: contacts
-- =====================================================
DROP TABLE IF EXISTS `contacts`;
CREATE TABLE `contacts` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `office_name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255),
  `phone` VARCHAR(50),
  `location` VARCHAR(255),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- TABLE: checklist_items
-- =====================================================
DROP TABLE IF EXISTS `checklist_items`;
CREATE TABLE `checklist_items` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `description` TEXT,
  `category` VARCHAR(50) DEFAULT 'pre-arrival',
  `priority` ENUM('high', 'medium', 'low') DEFAULT 'medium',
  `sort_order` INT DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- TABLE: announcements
-- =====================================================
DROP TABLE IF EXISTS `announcements`;
CREATE TABLE `announcements` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `body` TEXT NOT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- SAMPLE DATA: admins
-- =====================================================
INSERT INTO `admins` (`full_name`, `email`, `password`, `created_at`) VALUES
('System Administrator', 'admin@naub.edu.ng', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2026-01-15 08:00:00'),
('Dr. Ahmed Musa', 'ahmed.musa@naub.edu.ng', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2026-01-20 10:30:00'),
('Fatima Bello', 'fatima.bello@naub.edu.ng', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2026-02-01 14:15:00');

-- =====================================================
-- SAMPLE DATA: pages
-- =====================================================
INSERT INTO `pages` (`title`, `slug`, `content`, `category`, `updated_at`) VALUES
('Welcome to NAUB', 'welcome', '<h1>Welcome to Nigerian Army University, Biu</h1><p>Welcome to the official student orientation portal of the Nigerian Army University, Biu (NAUB). This platform is designed to help new students transition smoothly into university life.</p><p>NAUB is committed to providing quality education and producing graduates who will contribute meaningfully to national development.</p><p>Use this portal to access important information about your new academic journey, including orientation schedules, campus facilities, and essential contacts.</p>', 'home', '2026-03-15 09:00:00'),

('About NAUB', 'about', '<h1>About Nigerian Army University, Biu</h1><p>The Nigerian Army University, Biu (NAUB) was established to provide higher education opportunities in sciences, technology, humanities, and management sciences.</p><h2>Our Mission</h2><p>To produce well-rounded graduates with the requisite knowledge, skills, and character to serve the Nigerian Army and the nation at large.</p><h2>Our Vision</h2><p>To become a world-class university recognized for academic excellence, research, and service to humanity.</p><h2>Core Values</h2><ul><li>Discipline</li><li>Excellence</li><li>Integrity</li><li>Innovation</li><li>Service</li></ul>', 'about', '2026-03-15 09:30:00'),

('Academic Calendar', 'academic-calendar', '<h1>Academic Calendar 2025/2026</h1><h2>First Semester</h2><ul><li>Registration: September 1 - September 15, 2025</li><li>Orientation Week: September 16 - September 22, 2025</li><li>Lectures Begin: September 23, 2025</li><li>Mid-Semester Exams: November 4 - November 8, 2025</li><li>Lectures End: December 6, 2025</li><li>Examinations: December 9 - January 3, 2026</li><li>Semester Break: January 4 - January 31, 2026</li></ul><h2>Second Semester</h2><ul><li>Lectures Begin: February 1, 2026</li><li>Mid-Semester Exams: March 17 - March 21, 2026</li><li>Lectures End: April 25, 2026</li><li>Examinations: April 28 - May 16, 2026</li><li>End of Session: May 17, 2026</li></ul>', 'academic', '2026-03-15 10:00:00'),

('Campus Life', 'campus-life', '<h1>Life at NAUB</h1><p>Life at NAUB goes beyond the classroom. Our campus offers a vibrant community with numerous opportunities for personal growth and development.</p><h2>Student Activities</h2><p>Join one of our many student organizations, clubs, and societies. From sports to academics, there is something for everyone.</p><h2>Sports Facilities</h2><p>Our campus features modern sports facilities including a football field, basketball court, tennis court, and gymnasium.</p><h2>Hostel Accommodation</h2><p>NAUB provides on-campus accommodation for all students. Our hostels are safe, comfortable, and conducive for academic pursuits.</p><h2>Dining Services</h2><p>The campus has multiple dining options offering a variety of meals to cater to different dietary needs.</p>', 'student-life', '2026-03-15 10:30:00'),

('Library Services', 'library', '<h1>University Library</h1><p>The NAUB Library is a center of excellence for learning and research. Our collection includes books, journals, electronic resources, and multimedia materials.</p><h2>Opening Hours</h2><ul><li>Monday - Friday: 8:00 AM - 10:00 PM</li><li>Saturday: 9:00 AM - 6:00 PM</li><li>Sunday: 2:00 PM - 6:00 PM</li></ul><h2>Services Offered</h2><ul><li>Book borrowing and returning</li><li>Reference services</li><li>Internet access</li><li>Research assistance</li><li>Photocopying and printing</li><li>Digital library access</li></ul>', 'facilities', '2026-03-15 11:00:00'),

('Health Services', 'health-services', '<h1>Health Services</h1><p>The University Health Center provides comprehensive healthcare services to all students and staff.</p><h2>Location</h2><p>The health center is located near the main administrative block, opposite the Students Union Building.</p><h2>Services</h2><ul><li>General medical consultations</li><li>Emergency first aid</li><li>Health education</li><li>Referral services to specialist hospitals</li><li>Pharmacy services</li></ul><h2>Emergency Contact</h2><p>24/7 Emergency: +234 800 NAUB HELP</p>', 'health', '2026-03-15 11:30:00'),

('Student Support Services', 'student-support', '<h1>Student Support Services</h1><p>NAUB is committed to supporting students throughout their academic journey. Our Student Support Services offer guidance and assistance in various areas.</p><h2>Academic Advising</h2><p>Each student is assigned an academic advisor who provides guidance on course selection, study strategies, and career planning.</p><h2>Counseling Services</h2><p>Our professional counselors offer support for personal, emotional, and academic challenges.</p><h2>Career Services</h2><p>Prepare for your future with our career services, including resume writing, interview preparation, and job placement assistance.</p><h2>Disability Services</h2><p>We provide support and accommodations for students with disabilities to ensure equal access to education.</p>', 'support', '2026-03-15 12:00:00'),

('Admission Requirements', 'admission-requirements', '<h1>Admission Requirements</h1><p>Welcome to NAUB! Here are the requirements for admission into our various programs.</p><h2>Undergraduate Programs</h2><ul><li>Five O-Level credits including English Language and Mathematics</li><li>UTME score of 160 and above</li><li>Post-UTME screening pass</li><li>Birth certificate or age declaration</li></ul><h2>Direct Entry</h2><ul><li>Two A-Level passes or equivalent</li><li>O-Level credits as required</li><li>ND/NCE with good grades for relevant courses</li></ul><h2>Required Documents</h2><ul><li>Application form</li><li>O-Level results</li><li>UTME result slip</li><li>Birth certificate</li><li>Passport photographs</li><li>Local government identification</li></ul>', 'admission', '2026-03-15 12:30:00'),

('Department Information', 'departments', '<h1>Faculties and Departments</h1><p>NAUB comprises several faculties offering diverse programs:</p><h2>Faculty of Engineering</h2><ul><li>Civil Engineering</li><li>Electrical/Electronics Engineering</li><li>Mechanical Engineering</li><li>Computer Engineering</li></ul><h2>Faculty of Science</h2><ul><li>Computer Science</li><li>Physics</li><li>Chemistry</li><li>Biology</li><li>Mathematics</li></ul><h2>Faculty of Arts</h2><ul><li>English Language</li><li>History and International Studies</li><li>Philosophy</li><li>Religious Studies</li></ul><h2>Faculty of Management Sciences</h2><ul><li>Accounting</li><li>Business Administration</li><li>Economics</li><li>Public Administration</li></ul>', 'academic', '2026-03-15 13:00:00'),

('Contact Us', 'contact', '<h1>Contact Us</h1><p>We are here to help! Reach out to us through any of the following channels.</p><h2>Main Campus</h2><p>Nigerian Army University, Biu<br>Biu, Borno State, Nigeria</p><h2>General Inquiries</h2><p>Email: info@naub.edu.ng<br>Phone: +234 800 NAUB UNI</p><h2>Admissions Office</h2><p>Email: admissions@naub.edu.ng<br>Phone: +234 800 NAUB ADM</p><h2>Student Affairs</h2><p>Email: studentaffairs@naub.edu.ng</p>', 'contact', '2026-03-15 13:30:00');

-- =====================================================
-- SAMPLE DATA: faqs
-- =====================================================
INSERT INTO `faqs` (`question`, `answer`, `category`) VALUES
('How do I complete my registration?', 'To complete your registration, log in to the student portal using your matric number and password. Navigate to the Registration section, select your courses, and proceed to payment. After payment, generate your registration slip. Make sure to verify all details before submission.', 'registration'),
('What is the deadline for course registration?', 'Course registration typically closes two weeks after the start of lectures. For the 2025/2026 session, the deadline is October 6, 2025. Late registration attracts a penalty fee.', 'registration'),
('How do I reset my student portal password?', 'Visit the IT Help Desk located in the Library building or email support@naub.edu.ng with your matric number and a valid ID. You will receive a temporary password within 24 hours.', 'portal'),
('Where can I get my student ID card?', 'Student ID cards are processed at the Registry Office in the Main Administrative Block. Bring your registration slip and passport photographs. Processing takes 3-5 working days.', 'documents'),
('How do I apply for hostel accommodation?', 'Log in to the student portal, navigate to Hostel Application, fill in the required details, and submit. Accommodation is allocated on a first-come, first-served basis. Priority is given to fresh students and final year students.', 'hostel'),
('What documents do I need for hostel clearance?', 'You need your student ID card, registration slip, hostel application form, and a medical certificate. Report to the Hostel Warden with these documents for room allocation.', 'hostel'),
('Where is the health center located?', 'The University Health Center is located near the Main Administrative Block, opposite the Students Union Building. It is open 24/7 for emergencies.', 'health'),
('How do I report a medical emergency?', 'Call the emergency hotline at +234 800 NAUB HELP or visit the Health Center immediately. For after-hours emergencies, proceed to the nearest hospital and notify the university.', 'health'),
('Where can I find my lecture timetable?', 'Your personalized lecture timetable is available on the student portal under Academic Information. You can also check the notice boards at your faculty building.', 'academic'),
('How do I apply for a leave of absence?', 'Obtain a Leave of Absence form from the Dean of Students Affairs, fill it out with supporting documents, and submit to your Head of Department for approval.', 'academic'),
('What is the grading system at NAUB?', 'NAUB uses a 5-point grading system: A (70-100%) = 5 points, B (60-69%) = 4 points, C (50-59%) = 3 points, D (45-49%) = 2 points, F (0-44%) = 0 points. The Cumulative Grade Point Average (CGPA) determines your academic standing.', 'academic'),
('How do I join a student club or society?', 'Visit the Students Union Office to see the list of registered clubs and societies. Complete the membership form for your chosen organization and pay the prescribed fee.', 'activities'),
('Where can I access the internet on campus?', 'NAUB provides Wi-Fi connectivity in all faculty buildings, the library, and hostel areas. Use your student credentials to log in to the NAUB-WIFI network.', 'facilities'),
('How do I contact my academic advisor?', 'Your academic advisor''s contact details are available on the student portal. You can also find them posted on your faculty notice board. It is recommended to meet with your advisor at least once per semester.', 'academic'),
('What happens if I miss an examination?', 'If you miss an examination due to illness or other valid reasons, you must apply for a Make-up Examination within 48 hours. Submit a medical certificate or supporting documents to the Dean of your Faculty.', 'academic'),
('How do I apply for a scholarship?', 'Information about scholarships is advertised on the university notice boards and website. Check regularly for opportunities. Most scholarships require a minimum CGPA of 3.5.', 'financial');

-- =====================================================
-- SAMPLE DATA: contacts
-- =====================================================
INSERT INTO `contacts` (`office_name`, `email`, `phone`, `location`) VALUES
('Vice Chancellor''s Office', 'vc@naub.edu.ng', '+234 800 NAUB VC', 'Vice Chancellor''s Lodge, Main Campus'),
('Registry', 'registry@naub.edu.ng', '+234 800 NAUB REG', 'Administrative Block, Room 101'),
('Admissions Office', 'admissions@naub.edu.ng', '+234 800 NAUB ADM', 'Administrative Block, Room 205'),
('Student Affairs', 'studentaffairs@naub.edu.ng', '+234 800 NAUB STD', 'Student Union Building'),
('Academic Planning', 'acadplan@naub.edu.ng', '+234 800 NAUB ACP', 'Administrative Block, Room 302'),
('Finance Office', 'finance@naub.edu.ng', '+234 800 NAUB FIN', 'Administrative Block, Ground Floor'),
('IT Services', 'it@naub.edu.ng', '+234 800 NAUB IT', 'Library Building, First Floor'),
('Library', 'library@naub.edu.ng', '+234 800 NAUB LIB', 'Central Library Complex'),
('Health Center', 'health@naub.edu.ng', '+234 800 NAUB HLT', 'Near Administrative Block'),
('Security Office', 'security@naub.edu.ng', '+234 800 NAUB SEC', 'Main Gate'),
('Works and Services', 'works@naub.edu.ng', '+234 800 NAUB WRK', 'Works Department Building'),
('Dean of Engineering', 'eng@naub.edu.ng', '+234 800 NAUB ENG', 'Faculty of Engineering Building'),
('Dean of Science', 'science@naub.edu.ng', '+234 800 NAUB SCI', 'Faculty of Science Building'),
('Dean of Arts', 'arts@naub.edu.ng', '+234 800 NAUB ART', 'Faculty of Arts Building'),
('Dean of Management', 'management@naub.edu.ng', '+234 800 NAUB MGT', 'Faculty of Management Building'),
('Career Services', 'careers@naub.edu.ng', '+234 800 NAUB CAR', 'Student Affairs Office'),
('Sports Unit', 'sports@naub.edu.ng', '+234 800 NAUB SPT', 'Sports Complex'),
('Chaplaincy', 'chaplaincy@naub.edu.ng', '+234 800 NAUB CHP', 'Chapel Ground');

-- =====================================================
-- SAMPLE DATA: checklist_items
-- =====================================================
INSERT INTO `checklist_items` (`title`, `description`, `category`, `priority`, `sort_order`) VALUES
('Complete Online Registration', 'Register for courses on the student portal and generate your registration slip', 'pre-arrival', 'high', 1),
('Pay Tuition Fees', 'Pay your tuition and other fees through the designated bank or online payment portal', 'pre-arrival', 'high', 2),
('Verify Bio-data', 'Check and update your personal information on the student portal', 'pre-arrival', 'medium', 3),
('Apply for Hostel', 'Submit your hostel application through the student portal if you require accommodation', 'pre-arrival', 'medium', 4),
('Set Up Email Account', 'Activate your official NAUB email account for communication', 'pre-arrival', 'medium', 5),
('Obtain Student ID Card', 'Visit the Registry to process your student identification card', 'registration', 'high', 6),
('Submit Medical Certificate', 'Complete your medical screening at the Health Center and obtain a certificate', 'registration', 'high', 7),
('Obtain Departmental Clearance', 'Complete clearance with your department and faculty', 'registration', 'high', 8),
('Collect Course Materials', 'Get your course textbooks and materials from the university bookstore', 'registration', 'medium', 9),
('Register for Library Card', 'Get your library membership to access books and online resources', 'registration', 'low', 10),
('Attend Orientation Program', 'Participate in the mandatory new student orientation program', 'first-week', 'high', 11),
('Attend First Lecture', 'Meet your lecturers and collect course outlines', 'first-week', 'high', 12),
('Join WhatsApp Groups', 'Connect with your classmates through class WhatsApp groups', 'first-week', 'medium', 13),
('Join Student Groups', 'Explore and join clubs, societies, or organizations of interest', 'first-week', 'low', 14),
('Set Up Mobile Banking', 'Activate mobile banking for easy fee payments and transactions', 'academic', 'medium', 15),
('Know Emergency Contacts', 'Save important emergency numbers on your phone', 'academic', 'low', 16);

-- =====================================================
-- SAMPLE DATA: announcements
-- =====================================================
INSERT INTO `announcements` (`title`, `body`, `created_at`) VALUES
('2025/2026 Orientation Programme Commencing', 'Dear New Students,\n\nWe are pleased to announce that the 2025/2026 Orientation Programme will commence on Monday, September 16, 2025. The programme will run for one week and will cover important topics to help you settle in smoothly.\n\nKey highlights include:\n- Welcome address by the Vice Chancellor\n- Faculty orientation sessions\n- Campus tour\n- Health and safety briefing\n- ICT training\n\nAttendance is mandatory for all fresh students.\n\nBest regards,\nStudent Affairs Division', '2026-03-10 08:00:00'),
('Important: Course Registration Deadline', 'This is to notify all students that the deadline for course registration for the First Semester is September 15, 2025.\n\nStudents who fail to register by this date will:\n1. Not be allowed to attend lectures\n2. Be charged a late registration fee of ₦5,000\n3. Risk forfeiture of their admission\n\nPlease ensure you complete your registration early to avoid penalties.\n\nRegistrar', '2026-03-12 10:30:00'),
('Hostel Application Now Open', 'Applications for hostel accommodation for the 2025/2026 academic session are now open.\n\nFresh students are strongly encouraged to apply as on-campus accommodation is guaranteed for first-year students.\n\nTo apply:\n1. Log in to the student portal\n2. Click on Hostel Application\n3. Fill in the required details\n4. Submit and wait for allocation\n\nApplication deadline: September 10, 2025.\n\nWarden of Hostels', '2026-03-14 14:00:00');

-- =====================================================
-- Re-enable foreign key checks
-- =====================================================
SET FOREIGN_KEY_CHECKS = 1;

-- =====================================================
-- END OF DATABASE SCHEMA
-- =====================================================
