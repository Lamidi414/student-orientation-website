// NAUB Orientation Portal - Main JavaScript

document.addEventListener('DOMContentLoaded', function() {
    // Navigation Toggle
    const navToggle = document.getElementById('navToggle');
    const navMenu = document.getElementById('navMenu');
    
    if (navToggle && navMenu) {
        navToggle.addEventListener('click', function() {
            navMenu.classList.toggle('active');
        });
    }

    // FAQ Search Functionality
    const faqSearch = document.getElementById('faqSearch');
    if (faqSearch) {
        const faqItems = document.querySelectorAll('.faq-item');
        
        faqSearch.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase().trim();
            
            faqItems.forEach(item => {
                const question = item.querySelector('.faq-question span:last-child').textContent.toLowerCase();
                const answer = item.querySelector('.faq-answer').textContent.toLowerCase();
                
                if (searchTerm === '' || question.includes(searchTerm) || answer.includes(searchTerm)) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    }

    // FAQ Category Filter
    const categoryBtns = document.querySelectorAll('.category-btn');
    if (categoryBtns.length > 0) {
        categoryBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                categoryBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                
                const category = this.dataset.category;
                const faqItems = document.querySelectorAll('.faq-item');
                
                faqItems.forEach(item => {
                    if (category === 'all' || item.dataset.category === category) {
                        item.style.display = '';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
    }

    // Checklist Functionality
    const checklistContainer = document.getElementById('checklistContainer');
    if (checklistContainer) {
        const STORAGE_KEY = 'naub_checklist_completed';
        const taskItems = document.querySelectorAll('.task-item');
        const totalTasks = taskItems.length;
        
        let completedTasks = JSON.parse(localStorage.getItem(STORAGE_KEY)) || [];
        
        // Initialize progress
        updateProgress();
        
        // Apply saved state
        completedTasks.forEach(taskId => {
            const taskItem = document.querySelector('.task-item[data-id="' + taskId + '"]');
            if (taskItem) {
                taskItem.classList.add('completed');
            }
        });
        
        // Mark All Complete
        const markAllBtn = document.getElementById('markAllComplete');
        if (markAllBtn) {
            markAllBtn.addEventListener('click', function() {
                taskItems.forEach(item => {
                    const taskId = parseInt(item.dataset.id);
                    if (!completedTasks.includes(taskId)) {
                        completedTasks.push(taskId);
                    }
                    item.classList.add('completed');
                });
                localStorage.setItem(STORAGE_KEY, JSON.stringify(completedTasks));
                updateProgress();
                showToast('All tasks marked as complete!', 'success');
            });
        }
        
        // Reset
        const resetBtn = document.getElementById('resetChecklist');
        if (resetBtn) {
            resetBtn.addEventListener('click', function() {
                if (confirm('Are you sure you want to reset the checklist? This will clear all your progress.')) {
                    localStorage.removeItem(STORAGE_KEY);
                    completedTasks = [];
                    taskItems.forEach(item => item.classList.remove('completed'));
                    updateProgress();
                    showToast('Checklist has been reset', 'info');
                }
            });
        }
        
        // Sort Functionality
        const sortSelect = document.getElementById('sortSelect');
        if (sortSelect) {
            sortSelect.addEventListener('change', function() {
                const sortBy = this.value;
                const container = document.getElementById('checklistContainer');
                const wrappers = Array.from(document.querySelectorAll('.category-wrapper'));
                
                wrappers.forEach(wrapper => {
                    const body = wrapper.querySelector('.category-body');
                    const tasks = Array.from(wrapper.querySelectorAll('.task-item'));
                    
                    tasks.sort(function(a, b) {
                        const aId = parseInt(a.dataset.id);
                        const bId = parseInt(b.dataset.id);
                        const aCompleted = completedTasks.includes(aId);
                        const bCompleted = completedTasks.includes(bId);
                        const aPriority = a.dataset.priority;
                        const bPriority = b.dataset.priority;
                        
                        switch(sortBy) {
                            case 'priority':
                                const priorityOrder = { 'high': 1, 'medium': 2, 'low': 3 };
                                return priorityOrder[aPriority] - priorityOrder[bPriority];
                            case 'priority-low':
                                const priorityOrderLow = { 'high': 3, 'medium': 2, 'low': 1 };
                                return priorityOrderLow[aPriority] - priorityOrderLow[bPriority];
                            case 'completed':
                                return aCompleted === bCompleted ? 0 : aCompleted ? -1 : 1;
                            case 'incomplete':
                                return aCompleted === bCompleted ? 0 : aCompleted ? 1 : -1;
                            default:
                                return aId - bId;
                        }
                    });
                    
                    tasks.forEach(task => body.appendChild(task));
                });
            });
        }
        
        // Update progress display
        function updateProgress() {
            const completed = completedTasks.length;
            const percentage = totalTasks > 0 ? Math.round((completed / totalTasks) * 100) : 0;
            
            const progressCircle = document.getElementById('progressCircle');
            const progressPercent = document.getElementById('progressPercent');
            const progressBar = document.getElementById('progressBar');
            const taskCount = document.getElementById('taskCount');
            
            if (progressCircle) progressCircle.style.setProperty('--progress', percentage + '%');
            if (progressPercent) progressPercent.textContent = percentage + '%';
            if (progressBar) progressBar.style.width = percentage + '%';
            if (taskCount) taskCount.textContent = completed + ' / ' + totalTasks;
            
            if (progressCircle) {
                if (percentage === 100) {
                    progressCircle.classList.add('completed');
                } else {
                    progressCircle.classList.remove('completed');
                }
            }
            
            // Update category counts
            const categoryCards = document.querySelectorAll('.category-card');
            categoryCards.forEach(card => {
                const category = card.closest('.category-wrapper').dataset.category;
                const tasks = document.querySelectorAll('.task-item[data-category="' + category + '"]');
                let completed = 0;
                tasks.forEach(t => {
                    if (completedTasks.includes(parseInt(t.dataset.id))) {
                        completed++;
                    }
                });
                const badge = card.querySelector('.cat-completed');
                if (badge) {
                    badge.textContent = completed;
                }
            });
        }
        
        // Toggle task function
        window.toggleTask = function(taskId) {
            const taskItem = document.querySelector('.task-item[data-id="' + taskId + '"]');
            
            if (completedTasks.includes(taskId)) {
                completedTasks = completedTasks.filter(id => id !== taskId);
                taskItem.classList.remove('completed', 'just-completed');
            } else {
                completedTasks.push(taskId);
                taskItem.classList.add('completed', 'just-completed');
                setTimeout(() => {
                    taskItem.classList.remove('just-completed');
                }, 300);
            }
            
            localStorage.setItem(STORAGE_KEY, JSON.stringify(completedTasks));
            updateProgress();
        };
    }
    
    // Toast notification function
    function showToast(message, type) {
        const toast = document.createElement('div');
        toast.className = 'toast-notification toast-' + type;
        toast.innerHTML = message;
        
        toast.style.cssText = 'position: fixed; top: 20px; right: 20px; z-index: 9999; padding: 1rem 1.5rem; border-radius: 8px; color: white; font-weight: 500; animation: slideIn 0.3s ease-out;';
        
        if (type === 'success') {
            toast.style.background = 'linear-gradient(135deg, #28a745 0%, #20c997 100%)';
        } else {
            toast.style.background = 'linear-gradient(135deg, #17a2b8 0%, #138496 100%)';
        }
        
        document.body.appendChild(toast);
        
        setTimeout(() => {
            toast.style.animation = 'slideOut 0.3s ease-in forwards';
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }
    
    // Add animation keyframes
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        @keyframes slideOut {
            from { transform: translateX(0); opacity: 1; }
            to { transform: translateX(100%); opacity: 0; }
        }
    `;
    document.head.appendChild(style);
});

// Check URL params for search
const urlParams = new URLSearchParams(window.location.search);
const searchParam = urlParams.get('search');
if (searchParam) {
    const faqSearch = document.getElementById('faqSearch');
    if (faqSearch) {
        faqSearch.value = searchParam;
        faqSearch.dispatchEvent(new Event('input'));
    }
}