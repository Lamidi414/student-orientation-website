<?php
/**
 * Admin Login Page
 * NAUB Orientation Portal - Admin Panel
 */

// If already logged in, redirect to dashboard
if (is_admin()) {
    redirect(BASE_URL . '/admin/index.php');
}

$page_title = 'Admin Login';
$login_error = '';

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = sanitize($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    
    // Validate input
    if (empty($email) || empty($password)) {
        $login_error = 'Please enter both email and password.';
    } else {
        // Check credentials
        $pdo = get_db();
        if ($pdo) {
            try {
                $stmt = $pdo->prepare("SELECT * FROM admins WHERE email = :email LIMIT 1");
                $stmt->execute(['email' => $email]);
                $admin = $stmt->fetch();
                
                if ($admin && password_verify($password, $admin['password'])) {
                    // Login successful - set session
                    $_SESSION['admin_id'] = $admin['id'];
                    $_SESSION['admin_email'] = $admin['email'];
                    $_SESSION['admin_name'] = $admin['full_name'];
                    $_SESSION['admin_logged_in'] = true;
                    $_SESSION['login_time'] = time();
                    
                    // Redirect to dashboard
                    redirect(BASE_URL . '/admin/index.php');
                } else {
                    $login_error = 'Invalid email or password.';
                }
            } catch (PDOException $e) {
                error_log("Login error: " . $e->getMessage());
                $login_error = 'An error occurred. Please try again.';
            }
        } else {
            $login_error = 'Database connection error. Please try again later.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="NAUB Orientation Portal - Admin Login">
    
    <title><?php echo $page_title; ?> - <?php echo SITE_NAME; ?></title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary-color: #1a5f7a;
            --secondary-color: #159895;
            --accent-color: #57c5b6;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, var(--primary-color) 0%, #2c3e50 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .login-container {
            width: 100%;
            max-width: 420px;
            padding: 1rem;
        }
        
        .login-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            overflow: hidden;
        }
        
        .login-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            padding: 2rem;
            text-align: center;
            color: white;
        }
        
        .login-header .logo {
            font-size: 3rem;
            margin-bottom: 1rem;
        }
        
        .login-header h2 {
            margin: 0;
            font-size: 1.5rem;
            font-weight: 600;
        }
        
        .login-header p {
            margin: 0.5rem 0 0;
            opacity: 0.9;
            font-size: 0.9rem;
        }
        
        .login-body {
            padding: 2rem;
        }
        
        .form-label {
            font-weight: 500;
            color: #2c3e50;
            margin-bottom: 0.5rem;
        }
        
        .form-control {
            border-radius: 8px;
            padding: 0.75rem 1rem;
            border: 1px solid #ddd;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 3px rgba(21, 152, 149, 0.15);
        }
        
        .input-group-text {
            background: #f8f9fa;
            border-radius: 8px 0 0 8px;
            border: 1px solid #ddd;
            border-right: none;
        }
        
        .btn-login {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            border: none;
            border-radius: 8px;
            padding: 0.875rem;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(21, 152, 149, 0.4);
        }
        
        .login-footer {
            text-align: center;
            padding: 1rem 2rem 2rem;
        }
        
        .login-footer a {
            color: var(--secondary-color);
            text-decoration: none;
        }
        
        .login-footer a:hover {
            text-decoration: underline;
        }
        
        .alert {
            border-radius: 8px;
        }
        
        .password-toggle {
            cursor: pointer;
        }
        
        .back-link {
            text-align: center;
            margin-top: 1.5rem;
        }
        
        .back-link a {
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            font-size: 0.9rem;
        }
        
        .back-link a:hover {
            color: white;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <div class="logo">
                    <i class="fas fa-university"></i>
                </div>
                <h2>Admin Login</h2>
                <p><?php echo SITE_NAME; ?></p>
            </div>
            
            <div class="login-body">
                <?php if (!empty($login_error)): ?>
                    <div class="alert alert-danger" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        <?php echo sanitize($login_error); ?>
                    </div>
                <?php endif; ?>
                
                <form method="POST" action="" id="loginForm">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <input type="email" class="form-control" id="email" name="email" 
                                   placeholder="Enter your email" required autocomplete="email"
                                   value="<?php echo sanitize($_POST['email'] ?? ''); ?>">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </span>
                            <input type="password" class="form-control" id="password" name="password" 
                                   placeholder="Enter your password" required autocomplete="current-password">
                            <span class="input-group-text password-toggle" id="togglePassword">
                                <i class="fas fa-eye" id="toggleIcon"></i>
                            </span>
                        </div>
                    </div>
                    
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-login">
                            <i class="fas fa-sign-in-alt me-2"></i>Login
                        </button>
                    </div>
                </form>
            </div>
            
            <div class="login-footer">
                <p class="text-muted mb-0">
                    <small>Default credentials: admin@naub.edu.ng / password</small>
                </p>
            </div>
        </div>
        
        <div class="back-link">
            <a href="<?php echo BASE_URL; ?>/">
                <i class="fas fa-arrow-left me-1"></i>Back to Website
            </a>
        </div>
    </div>
    
    <script>
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        });
        
        // Form validation
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value;
            
            if (!email || !password) {
                e.preventDefault();
                alert('Please fill in all fields.');
            }
        });
    </script>
</body>
</html>
