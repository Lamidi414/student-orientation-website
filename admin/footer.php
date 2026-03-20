<?php
/**
 * Admin Footer Template
 * NAUB Orientation Portal - Admin Panel
 */
?>
        </div>
        <!-- End Content Area -->
        
        <!-- Footer -->
        <footer class="admin-footer py-3 px-4">
            <div class="d-flex justify-content-between align-items-center">
                <p class="mb-0 text-muted">&copy; <?php echo date('Y'); ?> <?php echo SITE_NAME; ?>. All rights reserved.</p>
                <p class="mb-0 text-muted">Admin Panel Version 1.0</p>
            </div>
        </footer>
    </main>
    <!-- End Main Content -->

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- jQuery (required for some features) -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    
    <!-- Custom Admin JS -->
    <script>
        // Toggle sidebar on mobile
        document.getElementById('menuToggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('show');
            document.getElementById('sidebarOverlay').classList.toggle('show');
        });
        
        // Close sidebar when clicking overlay
        document.getElementById('sidebarOverlay').addEventListener('click', function() {
            document.getElementById('sidebar').classList.remove('show');
            this.classList.remove('show');
        });
        
        // Auto-hide alerts after 5 seconds
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert:not(.alert-info)');
            alerts.forEach(function(alert) {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    </script>
    
    <?php if (isset($extra_scripts)): ?>
        <?php echo $extra_scripts; ?>
    <?php endif; ?>
</body>
</html>
