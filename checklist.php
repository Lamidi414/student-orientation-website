<?php
/**
 * Interactive Orientation Checklist
 * NAUB Orientation Portal
 * Track your progress through orientation tasks
 */

// Page configuration
$page_title = 'Orientation Checklist';

// Include required files
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/includes/functions.php';

// Get checklist items from database
$checklist_items = get_checklist_items();

// Define priority labels and CSS classes
$priorities = [
    'high' => ['label' => 'High', 'class' => 'danger', 'icon' => 'fa-exclamation-circle'],
    'medium' => ['label' => 'Medium', 'class' => 'warning', 'icon' => 'fa-minus-circle'],
    'low' => ['label' => 'Low', 'class' => 'info', 'icon' => 'fa-arrow-circle-down']
];

// Default checklist items with priorities (fallback if database is empty)
$default_items = [
    // Pre-Arrival Tasks
    ['id' => 1, 'title' => 'Complete Online Registration', 'description' => 'Register for courses on the student portal and generate your registration slip', 'category' => 'pre-arrival', 'priority' => 'high', 'sort_order' => 1],
    ['id' => 2, 'title' => 'Pay Tuition Fees', 'description' => 'Pay your tuition and other fees through the designated bank or online payment portal', 'category' => 'pre-arrival', 'priority' => 'high', 'sort_order' => 2],
    ['id' => 3, 'title' => 'Verify Bio-data', 'description' => 'Check and update your personal information on the student portal', 'category' => 'pre-arrival', 'priority' => 'medium', 'sort_order' => 3],
    ['id' => 4, 'title' => 'Apply for Hostel', 'description' => 'Submit your hostel application through the student portal if you require accommodation', 'category' => 'pre-arrival', 'priority' => 'medium', 'sort_order' => 4],
    ['id' => 5, 'title' => 'Set Up Email Account', 'description' => 'Activate your official NAUB email account for communication', 'category' => 'pre-arrival', 'priority' => 'medium', 'sort_order' => 5],
    
    // Registration Tasks
    ['id' => 6, 'title' => 'Obtain Student ID Card', 'description' => 'Visit the Registry to process your student identification card', 'category' => 'registration', 'priority' => 'high', 'sort_order' => 6],
    ['id' => 7, 'title' => 'Submit Medical Certificate', 'description' => 'Complete your medical screening at the Health Center and obtain a certificate', 'category' => 'registration', 'priority' => 'high', 'sort_order' => 7],
    ['id' => 8, 'title' => 'Obtain Departmental Clearance', 'description' => 'Complete clearance with your department and faculty', 'category' => 'registration', 'priority' => 'high', 'sort_order' => 8],
    ['id' => 9, 'title' => 'Collect Course Materials', 'description' => 'Get your course textbooks and materials from the university bookstore', 'category' => 'registration', 'priority' => 'medium', 'sort_order' => 9],
    ['id' => 10, 'title' => 'Register for Library Card', 'description' => 'Get your library membership to access books and online resources', 'category' => 'registration', 'priority' => 'low', 'sort_order' => 10],
    
    // First Week Tasks
    ['id' => 11, 'title' => 'Attend Orientation Program', 'description' => 'Participate in the mandatory new student orientation program', 'category' => 'first-week', 'priority' => 'high', 'sort_order' => 11],
    ['id' => 12, 'title' => 'Attend First Lecture', 'description' => 'Meet your lecturers and collect course outlines', 'category' => 'first-week', 'priority' => 'high', 'sort_order' => 12],
    ['id' => 13, 'title' => 'Join WhatsApp Groups', 'description' => 'Connect with your classmates through class WhatsApp groups', 'category' => 'first-week', 'priority' => 'medium', 'sort_order' => 13],
    ['id' => 14, 'title' => 'Join Student Groups', 'description' => 'Explore and join clubs, societies, or organizations of interest', 'category' => 'first-week', 'priority' => 'low', 'sort_order' => 14],
    
    // Academic Setup
    ['id' => 15, 'title' => 'Set Up Mobile Banking', 'description' => 'Activate mobile banking for easy fee payments and transactions', 'category' => 'academic', 'priority' => 'medium', 'sort_order' => 15],
    ['id' => 16, 'title' => 'Know Emergency Contacts', 'description' => 'Save important emergency numbers on your phone', 'category' => 'academic', 'priority' => 'low', 'sort_order' => 16],
];

// Use database items if available, otherwise use defaults
$items = !empty($checklist_items) ? $checklist_items : $default_items;

// If database items don't have priority, merge with defaults
if (empty($items[0]['priority'] ?? null)) {
    foreach ($items as &$item) {
        foreach ($default_items as $default) {
            if ($item['title'] === $default['title']) {
                $item['priority'] = $default['priority'];
                $item['category'] = $default['category'];
                break;
            }
        }
        if (!isset($item['priority'])) {
            $item['priority'] = 'medium';
            $item['category'] = 'pre-arrival';
        }
    }
}

// Group items by category
$categories = [
    'pre-arrival' => ['title' => 'Pre-Arrival Tasks', 'icon' => 'fa-plane-arrival', 'description' => 'Complete before arriving on campus'],
    'registration' => ['title' => 'Registration Tasks', 'icon' => 'fa-clipboard-check', 'description' => 'Complete during registration'],
    'first-week' => ['title' => 'First Week Tasks', 'icon' => 'fa-calendar-week', 'description' => 'Complete during your first week'],
    'academic' => ['title' => 'Academic Setup', 'icon' => 'fa-book-open', 'description' => 'Set up for academic success']
];

// Convert items array to include priority info
foreach ($items as &$item) {
    if (!isset($item['category']) || !isset($categories[$item['category']])) {
        $item['category'] = 'pre-arrival';
    }
    if (!isset($item['priority'])) {
        $item['priority'] = 'medium';
    }
}
?>

<?php include __DIR__ . '/includes/header.php'; ?>

<!-- Extra CSS for this page -->
<?php ob_start(); ?>
<style>
/* Checklist Page Specific Styles */
.checklist-hero {
    background: linear-gradient(135deg, var(--naub-primary) 0%, var(--naub-primary-dark) 100%);
    padding: 3rem 0;
    position: relative;
    overflow: hidden;
}

.checklist-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        radial-gradient(circle at 20% 80%, rgba(212, 175, 55, 0.15) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(212, 175, 55, 0.1) 0%, transparent 50%);
}

.checklist-hero .container {
    position: relative;
    z-index: 2;
}

/* Progress Section */
.progress-section {
    background: var(--naub-white);
    border-radius: var(--radius-lg);
    padding: 1.5rem;
    margin-top: -2rem;
    position: relative;
    z-index: 10;
    box-shadow: var(--shadow-lg);
}

.progress-circle {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    font-weight: 700;
    color: var(--naub-white);
    background: linear-gradient(135deg, var(--naub-primary) 0%, var(--naub-primary-light) 100%);
    position: relative;
}

.progress-circle::before {
    content: '';
    position: absolute;
    inset: -5px;
    border-radius: 50%;
    background: conic-gradient(var(--naub-gold) var(--progress, 0%), var(--naub-gray-light) 0%);
    z-index: -1;
}

.progress-circle.completed {
    background: linear-gradient(135deg, var(--naub-success) 0%, #20c997 100%);
}

/* Task Item Styles */
.task-item {
    background: var(--naub-white);
    border-radius: var(--radius-md);
    padding: 1rem 1.25rem;
    margin-bottom: 0.75rem;
    box-shadow: var(--shadow-sm);
    transition: all var(--transition-base);
    border-left: 4px solid var(--naub-gray-light);
    cursor: pointer;
}

.task-item:hover {
    box-shadow: var(--shadow-md);
    transform: translateX(5px);
}

.task-item.completed {
    background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
    border-left-color: var(--naub-success);
}

.task-item.completed .task-title {
    text-decoration: line-through;
    color: var(--naub-gray);
}

.task-item.priority-high {
    border-left-color: var(--naub-danger);
}

.task-item.priority-medium {
    border-left-color: var(--naub-warning);
}

.task-item.priority-low {
    border-left-color: var(--naub-info);
}

.task-checkbox {
    width: 24px;
    height: 24px;
    border: 2px solid var(--naub-primary);
    border-radius: var(--radius-sm);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    transition: all var(--transition-fast);
    background: var(--naub-white);
}

.task-item.completed .task-checkbox {
    background: var(--naub-success);
    border-color: var(--naub-success);
    color: var(--naub-white);
}

.task-checkbox i {
    font-size: 0.75rem;
    opacity: 0;
    transition: opacity var(--transition-fast);
}

.task-item.completed .task-checkbox i {
    opacity: 1;
}

.task-title {
    font-weight: 600;
    color: var(--naub-primary);
    margin-bottom: 0.25rem;
    transition: all var(--transition-fast);
}

.task-description {
    font-size: 0.875rem;
    color: var(--naub-gray);
    margin-bottom: 0;
}

/* Priority Badge */
.priority-badge {
    font-size: 0.7rem;
    font-weight: 600;
    padding: 0.25rem 0.5rem;
    border-radius: var(--radius-sm);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.priority-badge.high {
    background: #f8d7da;
    color: #721c24;
}

.priority-badge.medium {
    background: #fff3cd;
    color: #856404;
}

.priority-badge.low {
    background: #d1ecf1;
    color: #0c5460;
}

/* Category Card */
.category-card {
    background: var(--naub-white);
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    margin-bottom: 2rem;
}

.category-header {
    background: linear-gradient(135deg, var(--naub-primary) 0%, var(--naub-primary-light) 100%);
    color: var(--naub-white);
    padding: 1rem 1.5rem;
    display: flex;
    align-items: center;
    gap: 1rem;
}

.category-header i {
    font-size: 1.5rem;
    color: var(--naub-gold);
}

.category-header h3 {
    margin: 0;
    color: var(--naub-white);
    font-size: 1.25rem;
}

.category-header .category-desc {
    font-size: 0.875rem;
    opacity: 0.9;
    margin: 0;
}

.category-body {
    padding: 1rem 1.5rem;
}

/* Action Buttons */
.checklist-actions {
    display: flex;
    gap: 0.75rem;
    flex-wrap: wrap;
}

/* Sort Controls */
.sort-controls {
    display: flex;
    align-items: center;
    gap: 1rem;
    flex-wrap: wrap;
}

.sort-controls label {
    font-weight: 600;
    color: var(--naub-gray-dark);
    margin: 0;
}

.sort-controls select {
    min-width: 180px;
}

/* Animations */
@keyframes taskComplete {
    0% { transform: scale(1); }
    50% { transform: scale(1.02); }
    100% { transform: scale(1); }
}

.task-item.just-completed {
    animation: taskComplete 0.3s ease-out;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 3rem;
    color: var(--naub-gray);
}

.empty-state i {
    font-size: 4rem;
    color: var(--naub-gray-light);
    margin-bottom: 1rem;
}

/* Responsive */
@media (max-width: 767.98px) {
    .progress-section {
        margin-top: 0;
        border-radius: 0;
    }
    
    .checklist-actions {
        flex-direction: column;
    }
    
    .checklist-actions .btn {
        width: 100%;
    }
}
</style>
<?php 
$extra_head = ob_get_clean();
?>

<!-- Hero Section -->
<section class="checklist-hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="display-4 fw-bold mb-3">
                    <i class="fas fa-clipboard-list me-3 text-gold"></i>
                    Orientation Checklist
                </h1>
                <p class="lead mb-0">
                    Track your progress through essential orientation tasks. Complete each item to ensure a smooth start at NAUB.
                </p>
            </div>
            <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                <div class="hero-icons">
                    <i class="fas fa-check-circle fa-3x text-gold opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Progress Summary Section -->
<section class="progress-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-4 text-center mb-3 mb-md-0">
                <div class="progress-circle" id="progressCircle" style="--progress: 0%;">
                    <span id="progressPercent">0%</span>
                </div>
            </div>
            <div class="col-md-4 text-center text-md-start mb-3 mb-md-0">
                <h2 class="h4 mb-1" id="taskCount">0 / <?php echo count($items); ?></h2>
                <p class="text-muted mb-0">Tasks Completed</p>
                <div class="progress mt-3" style="height: 10px;">
                    <div class="progress-bar bg-success" id="progressBar" role="progressbar" style="width: 0%;"></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="checklist-actions justify-content-md-end">
                    <button class="btn btn-success" id="markAllComplete">
                        <i class="fas fa-check-double me-2"></i>Mark All Complete
                    </button>
                    <button class="btn btn-outline-danger" id="resetChecklist">
                        <i class="fas fa-redo me-2"></i>Reset
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<section class="section-padding">
    <div class="container">
        <!-- Sort Controls -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="sort-controls">
                    <label for="sortSelect">
                        <i class="fas fa-sort me-2"></i>Sort by:
                    </label>
                    <select class="form-select" id="sortSelect">
                        <option value="default">Default Order</option>
                        <option value="priority">Priority (High to Low)</option>
                        <option value="priority-low">Priority (Low to High)</option>
                        <option value="completed">Completed First</option>
                        <option value="incomplete">Incomplete First</option>
                    </select>
                    <div class="sort-info text-muted">
                        <i class="fas fa-info-circle me-1"></i>
                        <span id="sortInfo">Showing all <?php echo count($items); ?> tasks</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Checklist Categories -->
        <div class="row" id="checklistContainer">
            <?php foreach ($categories as $cat_key => $cat_info): ?>
                <?php 
                $cat_items = array_filter($items, function($item) use ($cat_key) {
                    return $item['category'] === $cat_key;
                });
                ?>
                <?php if (!empty($cat_items)): ?>
                <div class="col-12 category-wrapper" data-category="<?php echo $cat_key; ?>">
                    <div class="category-card">
                        <div class="category-header">
                            <i class="fas <?php echo $cat_info['icon']; ?>"></i>
                            <div>
                                <h3 class="h5 mb-0"><?php echo $cat_info['title']; ?></h3>
                                <p class="category-desc mb-0"><?php echo $cat_info['description']; ?></p>
                            </div>
                            <span class="badge bg-light text-dark ms-auto">
                                <span class="cat-completed">0</span> / <?php echo count($cat_items); ?>
                            </span>
                        </div>
                        <div class="category-body">
                            <?php foreach ($cat_items as $index => $item): ?>
                            <div class="task-item priority-<?php echo $item['priority']; ?>" 
                                 data-id="<?php echo $item['id']; ?>"
                                 data-priority="<?php echo $item['priority']; ?>"
                                 data-category="<?php echo $item['category']; ?>"
                                 onclick="toggleTask(<?php echo $item['id']; ?>)">
                                <div class="d-flex align-items-start gap-3">
                                    <div class="task-checkbox">
                                        <i class="fas fa-check"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <h4 class="task-title h6 mb-1"><?php echo htmlspecialchars($item['title']); ?></h4>
                                            <span class="priority-badge <?php echo $item['priority']; ?>">
                                                <i class="fas <?php echo $priorities[$item['priority']]['icon']; ?> me-1"></i>
                                                <?php echo $priorities[$item['priority']]['label']; ?>
                                            </span>
                                        </div>
                                        <p class="task-description mb-0"><?php echo htmlspecialchars($item['description'] ?? ''); ?></p>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Extra Scripts -->
<?php ob_start(); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize checklist from localStorage
    const STORAGE_KEY = 'naub_checklist_completed';
    let completedTasks = JSON.parse(localStorage.getItem(STORAGE_KEY)) || [];
    
    // Get total task count
    const totalTasks = <?php echo count($items); ?>;
    
    // Update progress display
    function updateProgress() {
        const completed = completedTasks.length;
        const percentage = totalTasks > 0 ? Math.round((completed / totalTasks) * 100) : 0;
        
        // Update progress circle
        const progressCircle = document.getElementById('progressCircle');
        const progressPercent = document.getElementById('progressPercent');
        progressCircle.style.setProperty('--progress', percentage + '%');
        progressPercent.textContent = percentage + '%';
        
        if (percentage === 100) {
            progressCircle.classList.add('completed');
        } else {
            progressCircle.classList.remove('completed');
        }
        
        // Update progress bar
        const progressBar = document.getElementById('progressBar');
        progressBar.style.width = percentage + '%';
        
        // Update task count
        const taskCount = document.getElementById('taskCount');
        taskCount.textContent = completed + ' / ' + totalTasks;
        
        // Update sort info
        const sortInfo = document.getElementById('sortInfo');
        sortInfo.textContent = 'Showing all ' + totalTasks + ' tasks';
        
        // Update category counts
        updateCategoryCounts();
    }
    
    // Update category completion counts
    function updateCategoryCounts() {
        const categoryCards = document.querySelectorAll('.category-card');
        categoryCards.forEach(card => {
            const category = card.closest('.category-wrapper').dataset.category;
            const tasks = document.querySelectorAll('.task-item[data-category="' + category + '"]');
            const completed = tasks.filter(t => completedTasks.includes(parseInt(t.dataset.id))).length;
            const badge = card.querySelector('.cat-completed');
            if (badge) {
                badge.textContent = completed;
            }
        });
    }
    
    // Toggle task completion
    window.toggleTask = function(taskId) {
        const taskItem = document.querySelector('.task-item[data-id="' + taskId + '"]');
        
        if (completedTasks.includes(taskId)) {
            // Remove from completed
            completedTasks = completedTasks.filter(id => id !== taskId);
            taskItem.classList.remove('completed', 'just-completed');
        } else {
            // Add to completed
            completedTasks.push(taskId);
            taskItem.classList.add('completed', 'just-completed');
            // Remove animation class after animation completes
            setTimeout(() => {
                taskItem.classList.remove('just-completed');
            }, 300);
        }
        
        // Save to localStorage
        localStorage.setItem(STORAGE_KEY, JSON.stringify(completedTasks));
        
        // Update progress
        updateProgress();
    };
    
    // Mark all tasks as complete
    document.getElementById('markAllComplete').addEventListener('click', function() {
        const allTaskIds = <?php echo json_encode(array_column($items, 'id')); ?>;
        
        // Add all tasks to completed
        completedTasks = [...new Set([...completedTasks, ...allTaskIds])];
        
        // Save to localStorage
        localStorage.setItem(STORAGE_KEY, JSON.stringify(completedTasks));
        
        // Update all task items
        document.querySelectorAll('.task-item').forEach(item => {
            item.classList.add('completed');
        });
        
        // Update progress
        updateProgress();
        
        // Show success message
        showToast('All tasks marked as complete!', 'success');
    });
    
    // Reset checklist
    document.getElementById('resetChecklist').addEventListener('click', function() {
        if (confirm('Are you sure you want to reset the checklist? This will clear all your progress.')) {
            // Clear localStorage
            localStorage.removeItem(STORAGE_KEY);
            completedTasks = [];
            
            // Update all task items
            document.querySelectorAll('.task-item').forEach(item => {
                item.classList.remove('completed');
            });
            
            // Update progress
            updateProgress();
            
            // Show info message
            showToast('Checklist has been reset', 'info');
        }
    });
    
    // Sort functionality
    document.getElementById('sortSelect').addEventListener('change', function() {
        const sortBy = this.value;
        const container = document.getElementById('checklistContainer');
        const wrappers = Array.from(document.querySelectorAll('.category-wrapper'));
        
        wrappers.forEach(wrapper => {
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
            
            // Re-append sorted tasks
            const body = wrapper.querySelector('.category-body');
            tasks.forEach(task => body.appendChild(task));
        });
        
        // Update sort info
        const sortInfo = document.getElementById('sortInfo');
        const total = <?php echo count($items); ?>;
        sortInfo.textContent = 'Showing all ' + total + ' tasks';
    });
    
    // Toast notification function
    function showToast(message, type) {
        // Create toast element
        const toast = document.createElement('div');
        toast.className = 'toast-notification toast-' + type;
        toast.innerHTML = '<i class="fas fa-' + (type === 'success' ? 'check-circle' : 'info-circle') + '"></i> ' + message;
        
        // Add styles
        toast.style.cssText = 'position: fixed; top: 100px; right: 20px; z-index: 9999; padding: 1rem 1.5rem; border-radius: 8px; color: white; font-weight: 500; animation: slideIn 0.3s ease-out;';
        
        if (type === 'success') {
            toast.style.background = 'linear-gradient(135deg, #28a745 0%, #20c997 100%)';
        } else {
            toast.style.background = 'linear-gradient(135deg, #17a2b8 0%, #138496 100%)';
        }
        
        document.body.appendChild(toast);
        
        // Remove after 3 seconds
        setTimeout(() => {
            toast.style.animation = 'slideOut 0.3s ease-in forwards';
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }
    
    // Add keyframe animations dynamically
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
    
    // Initial render - apply saved state
    function applySavedState() {
        completedTasks.forEach(taskId => {
            const taskItem = document.querySelector('.task-item[data-id="' + taskId + '"]');
            if (taskItem) {
                taskItem.classList.add('completed');
            }
        });
        updateProgress();
    }
    
    applySavedState();
});
</script>
<?php 
$extra_scripts = ob_get_clean();
?>

<?php include __DIR__ . '/includes/footer.php'; ?>
