<?php
/**
 * Common Footer
 * NAUB Orientation Portal
 */

// Include configuration if not already included
if (!defined('SITE_NAME')) {
    require_once __DIR__ . '/../config/config.php';
}
?>
    </main>
    <!-- Main Content End -->

    <!-- Footer -->
    <footer class="footer bg-dark text-white pt-5 pb-4">
        <div class="container">
            <div class="row">
                <!-- Quick Links -->
                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                    <h5 class="footer-heading">Quick Links</h5>
                    <ul class="list-unstyled footer-links">
                        <li><a href="<?php echo BASE_URL; ?>/">Home</a></li>
                        <li><a href="<?php echo BASE_URL; ?>/page.php?slug=about">About NAUB</a></li>
                        <li><a href="<?php echo BASE_URL; ?>/page.php?slug=admission-requirements">Admission</a></li>
                        <li><a href="<?php echo BASE_URL; ?>/page.php?slug=academic-calendar">Academic Calendar</a></li>
                        <li><a href="<?php echo BASE_URL; ?>/faqs.php">FAQs</a></li>
                        <li><a href="<?php echo BASE_URL; ?>/contact.php">Contact Us</a></li>
                    </ul>
                </div>
                
                <!-- Important Links -->
                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                    <h5 class="footer-heading">Important</h5>
                    <ul class="list-unstyled footer-links">
                        <li><a href="<?php echo BASE_URL; ?>/page.php?slug=student-support">Student Support</a></li>
                        <li><a href="<?php echo BASE_URL; ?>/page.php?slug=library">Library Services</a></li>
                        <li><a href="<?php echo BASE_URL; ?>/page.php?slug=health-services">Health Services</a></li>
                        <li><a href="<?php echo BASE_URL; ?>/page.php?slug=campus-life">Campus Life</a></li>
                        <li><a href="<?php echo BASE_URL; ?>/checklist.php">New Student Checklist</a></li>
                        <li><a href="<?php echo BASE_URL; ?>/page.php?slug=departments">Departments</a></li>
                    </ul>
                </div>
                
                <!-- Contact Info -->
                <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
                    <h5 class="footer-heading">Contact Information</h5>
                    <ul class="list-unstyled footer-contact">
                        <li>
                            <i class="fas fa-map-marker-alt me-2"></i>
                            <span>Nigerian Army University, Biu<br>Biu, Borno State, Nigeria</span>
                        </li>
                        <li>
                            <i class="fas fa-envelope me-2"></i>
                            <a href="mailto:info@naub.edu.ng">info@naub.edu.ng</a>
                        </li>
                        <li>
                            <i class="fas fa-phone me-2"></i>
                            <span>+234 800 NAUB UNI</span>
                        </li>
                        <li>
                            <i class="fas fa-globe me-2"></i>
                            <a href="https://www.naub.edu.ng" target="_blank">www.naub.edu.ng</a>
                        </li>
                    </ul>
                    
                    <!-- Social Media Links -->
                    <div class="social-links mt-3">
                        <a href="#" class="social-link" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-link" title="Twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-link" title="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-link" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
            
            <!-- Divider -->
            <hr class="footer-divider">
            
            <!-- Bottom Footer -->
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <p class="mb-0">
                        &copy; <?php echo date('Y'); ?> <?php echo SITE_NAME; ?>. All rights reserved.
                    </p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <a href="<?php echo BASE_URL; ?>/admin/" class="admin-link">
                        <i class="fas fa-user-shield me-1"></i> Admin Login
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JS -->
    <script src="<?php echo BASE_URL; ?>/js/main.js"></script>
    
    <!-- Additional scripts -->
    <?php if (isset($extra_scripts)): ?>
        <?php echo $extra_scripts; ?>
    <?php endif; ?>
</body>
</html>
