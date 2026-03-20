/**
 * NAUB Orientation Website - Main JavaScript
 * Nigerian Army University, Biu
 * 
 * Features:
 * - Mobile menu toggle
 * - Search functionality
 * - Checklist with localStorage persistence
 * - FAQ accordion
 * - Smooth scrolling
 * - Form validation
 * - Loading states
 */

(function() {
    'use strict';

    // ========================================
    // DOM Ready
    // ========================================
    document.addEventListener('DOMContentLoaded', function() {
        initNavbarScroll();
        initSmoothScroll();
        initMobileMenu();
        initChecklist();
        initFAQSearch();
        initFormValidation();
        initLoadingButtons();
        initTooltips();
    });

    // ========================================
    // Navbar Scroll Effect
    // ========================================
    function initNavbarScroll() {
        const navbar = document.querySelector('.navbar');
        if (!navbar) return;

        let lastScroll = 0;
        
        window.addEventListener('scroll', function() {
            const currentScroll = window.pageYOffset;
            
            if (currentScroll > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
            
            lastScroll = currentScroll;
        }, { passive: true });
    }

    // ========================================
    // Smooth Scroll
    // ========================================
    function initSmoothScroll() {
        const links = document.querySelectorAll('a[href^="#"]');
        
        links.forEach(function(link) {
            link.addEventListener('click', function(e) {
                const targetId = this.getAttribute('href');
                
                if (targetId === '#') return;
                
                const target = document.querySelector(targetId);
                
                if (target) {
                    e.preventDefault();
                    
                    const navHeight = document.querySelector('.navbar').offsetHeight;
                    const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - navHeight;
                    
                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                }
            });
        });
    }

    // ========================================
    // Mobile Menu Enhancement
    // ========================================
    function initMobileMenu() {
        const navbarToggler = document.querySelector('.navbar-toggler');
        const navbarCollapse = document.querySelector('.navbar-collapse');
        
        if (!navbarToggler || !navbarCollapse) return;
        
        // Close menu when clicking outside
        document.addEventListener('click', function(e) {
            const isClickInside = navbarToggler.contains(e.target) || navbarCollapse.contains(e.target);
            
            if (!isClickInside && navbarCollapse.classList.contains('show')) {
                navbarToggler.click();
            }
        });
        
        // Close menu when pressing Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && navbarCollapse.classList.contains('show')) {
                navbarToggler.click();
            }
        });
        
        // Close menu when clicking a nav link (mobile)
        const navLinks = navbarCollapse.querySelectorAll('.nav-link');
        navLinks.forEach(function(link) {
            link.addEventListener('click', function() {
                if (window.innerWidth < 992 && navbarCollapse.classList.contains('show')) {
                    navbarToggler.click();
                }
            });
        });
    }

    // ========================================
    // Checklist with LocalStorage
    // ========================================
    function initChecklist() {
        const checklistItems = document.querySelectorAll('.checklist-item');
        
        if (checklistItems.length === 0) return;
        
        // Load saved state from localStorage
        const savedState = JSON.parse(localStorage.getItem('naubChecklist')) || {};
        
        checklistItems.forEach(function(item) {
            const itemId = item.dataset.id || item.querySelector('.checklist-text').textContent.trim();
            
            // Restore saved state
            if (savedState[itemId]) {
                item.classList.add('completed');
                const checkbox = item.querySelector('.checklist-checkbox');
                if (checkbox) {
                    checkbox.innerHTML = '<i class="fas fa-check"></i>';
                }
            }
            
            // Add click handler
            item.addEventListener('click', function(e) {
                // Don't toggle if clicking on action buttons
                if (e.target.closest('.checklist-actions')) return;
                
                toggleChecklistItem(item, itemId);
            });
            
            // Add delete handler if present
            const deleteBtn = item.querySelector('.checklist-delete');
            if (deleteBtn) {
                deleteBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    deleteChecklistItem(item, itemId);
                });
            }
        });
        
        // Initialize progress counter
        updateChecklistProgress();
    }
    
    function toggleChecklistItem(item, itemId) {
        const isCompleted = item.classList.toggle('completed');
        const checkbox = item.querySelector('.checklist-checkbox');
        
        if (checkbox) {
            if (isCompleted) {
                checkbox.innerHTML = '<i class="fas fa-check"></i>';
            } else {
                checkbox.innerHTML = '';
            }
        }
        
        // Save to localStorage
        saveChecklistState(itemId, isCompleted);
        
        // Update progress
        updateChecklistProgress();
        
        // Add animation
        if (isCompleted) {
            playSuccessAnimation(item);
        }
    }
    
    function saveChecklistState(itemId, isCompleted) {
        const savedState = JSON.parse(localStorage.getItem('naubChecklist')) || {};
        
        if (isCompleted) {
            savedState[itemId] = true;
        } else {
            delete savedState[itemId];
        }
        
        localStorage.setItem('naubChecklist', JSON.stringify(savedState));
    }
    
    function deleteChecklistItem(item, itemId) {
        if (confirm('Are you sure you want to remove this item?')) {
            // Remove from localStorage
            const savedState = JSON.parse(localStorage.getItem('naubChecklist')) || {};
            delete savedState[itemId];
            localStorage.setItem('naubChecklist', JSON.stringify(savedState));
            
            // Remove from DOM with animation
            item.style.opacity = '0';
            item.style.transform = 'translateX(100px)';
            
            setTimeout(function() {
                item.remove();
                updateChecklistProgress();
            }, 300);
        }
    }
    
    function updateChecklistProgress() {
        const progressBar = document.querySelector('.checklist-progress');
        const progressText = document.querySelector('.checklist-progress-text');
        
        const totalItems = document.querySelectorAll('.checklist-item').length;
        const completedItems = document.querySelectorAll('.checklist-item.completed').length;
        
        if (progressBar) {
            const percentage = totalItems > 0 ? (completedItems / totalItems) * 100 : 0;
            progressBar.style.width = percentage + '%';
            progressBar.setAttribute('aria-valuenow', percentage);
        }
        
        if (progressText) {
            progressText.textContent = completedItems + ' of ' + totalItems + ' completed';
        }
    }
    
    function playSuccessAnimation(item) {
        item.style.transform = 'scale(1.02)';
        setTimeout(function() {
            item.style.transform = '';
        }, 200);
    }
    
    // Reset checklist (for testing/development)
    window.resetChecklist = function() {
        if (confirm('Are you sure you want to reset all checklist items?')) {
            localStorage.removeItem('naubChecklist');
            location.reload();
        }
    };

    // ========================================
    // FAQ Search
    // ========================================
    function initFAQSearch() {
        const searchInput = document.getElementById('faqSearch');
        const faqItems = document.querySelectorAll('.accordion-item');
        
        if (!searchInput || faqItems.length === 0) return;
        
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase().trim();
            
            faqItems.forEach(function(item) {
                const question = item.querySelector('.accordion-button')?.textContent.toLowerCase() || '';
                const answer = item.querySelector('.accordion-body')?.textContent.toLowerCase() || '';
                
                if (searchTerm === '' || question.includes(searchTerm) || answer.includes(searchTerm)) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
            
            // Update visible count
            const visibleItems = Array.from(faqItems).filter(function(item) {
                return item.style.display !== 'none';
            });
            
            updateFAQCount(visibleItems.length, faqItems.length);
        });
    }
    
    function updateFAQCount(visible, total) {
        let countElement = document.querySelector('.faq-count');
        
        if (!countElement) {
            const searchInput = document.getElementById('faqSearch');
            if (searchInput) {
                countElement = document.createElement('p');
                countElement.className = 'faq-count text-muted mt-2';
                searchInput.parentNode.appendChild(countElement);
            }
        }
        
        if (countElement) {
            countElement.textContent = 'Showing ' + visible + ' of ' + total + ' FAQs';
        }
    }

    // ========================================
    // Form Validation
    // ========================================
    function initFormValidation() {
        const forms = document.querySelectorAll('.needs-validation');
        
        forms.forEach(function(form) {
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                
                form.classList.add('was-validated');
            }, false);
        });
        
        // Real-time validation feedback
        const inputs = document.querySelectorAll('.form-control, .form-select');
        
        inputs.forEach(function(input) {
            input.addEventListener('blur', function() {
                validateInput(this);
            });
            
            input.addEventListener('input', function() {
                if (this.classList.contains('is-invalid') || this.classList.contains('is-valid')) {
                    validateInput(this);
                }
            });
        });
    }
    
    function validateInput(input) {
        const isValid = input.checkValidity();
        
        if (isValid) {
            input.classList.remove('is-invalid');
            input.classList.add('is-valid');
        } else {
            input.classList.remove('is-valid');
            input.classList.add('is-invalid');
        }
        
        // Update feedback message
        const feedback = input.parentNode.querySelector('.invalid-feedback');
        if (feedback && input.validationMessage) {
            feedback.textContent = input.validationMessage;
        }
    }

    // ========================================
    // Loading Buttons
    // ========================================
    function initLoadingButtons() {
        const buttons = document.querySelectorAll('[data-loading]');
        
        buttons.forEach(function(button) {
            button.addEventListener('click', function() {
                const originalText = this.innerHTML;
                const loadingText = this.dataset.loading || 'Loading...';
                
                // Set loading state
                this.classList.add('btn-loading');
                this.dataset.originalText = originalText;
                
                // If form button, prevent double submission
                if (this.tagName === 'BUTTON' && this.type === 'submit') {
                    this.disabled = true;
                    
                    // Re-enable after timeout (fallback)
                    setTimeout(function() {
                        button.classList.remove('btn-loading');
                        button.disabled = false;
                    }, 5000);
                }
            });
        });
        
        // Handle form submission loading states
        const forms = document.querySelectorAll('form');
        
        forms.forEach(function(form) {
            form.addEventListener('submit', function(e) {
                const submitBtn = form.querySelector('button[type="submit"], input[type="submit"]');
                
                if (submitBtn && !form.dataset.submitted) {
                    form.dataset.submitted = 'true';
                    submitBtn.classList.add('btn-loading');
                    submitBtn.disabled = true;
                    
                    // Reset after timeout (fallback for server-side errors)
                    setTimeout(function() {
                        submitBtn.classList.remove('btn-loading');
                        submitBtn.disabled = false;
                        form.dataset.submitted = '';
                    }, 10000);
                }
            });
        });
    }

    // ========================================
    // Tooltips
    // ========================================
    function initTooltips() {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        
        if (typeof bootstrap !== 'undefined' && bootstrap.Tooltip) {
            tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        }
    }

    // ========================================
    // Utility Functions
    // ========================================
    
    // Show toast notification
    window.showToast = function(message, type = 'info') {
        // Remove existing toasts
        const existingToasts = document.querySelectorAll('.toast-container');
        existingToasts.forEach(function(container) {
            container.remove();
        });
        
        const toastContainer = document.createElement('div');
        toastContainer.className = 'toast-container position-fixed bottom-0 end-0 p-3';
        toastContainer.style.zIndex = '9999';
        
        const toast = document.createElement('div');
        toast.className = 'toast show';
        toast.setAttribute('role', 'alert');
        toast.setAttribute('aria-live', 'assertive');
        toast.setAttribute('aria-atomic', 'true');
        
        const bgClass = {
            'success': 'bg-success text-white',
            'error': 'bg-danger text-white',
            'warning': 'bg-warning',
            'info': 'bg-info text-white'
        };
        
        toast.innerHTML = `
            <div class="toast-header ${bgClass[type] || 'bg-info text-white'}">
                <strong class="me-auto">Notification</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
            </div>
            <div class="toast-body">
                ${message}
            </div>
        `;
        
        toastContainer.appendChild(toast);
        document.body.appendChild(toastContainer);
        
        // Auto dismiss
        setTimeout(function() {
            toast.classList.remove('show');
            setTimeout(function() {
                toastContainer.remove();
            }, 300);
        }, 5000);
    };
    
    // Scroll to element
    window.scrollToElement = function(selector, offset = 0) {
        const element = document.querySelector(selector);
        
        if (element) {
            const elementPosition = element.getBoundingClientRect().top + window.pageYOffset;
            window.scrollTo({
                top: elementPosition - offset,
                behavior: 'smooth'
            });
        }
    };
    
    // Format date
    window.formatDate = function(dateString) {
        const date = new Date(dateString);
        const options = { year: 'numeric', month: 'long', day: 'numeric' };
        return date.toLocaleDateString('en-US', options);
    };
    
    // Truncate text
    window.truncateText = function(text, maxLength) {
        if (text.length <= maxLength) return text;
        return text.substring(0, maxLength) + '...';
    };

})();
