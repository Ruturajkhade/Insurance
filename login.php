<?php
session_start();
include('includes/config.php'); // Include the database connection

// Check if user is already logged in
if (isset($_SESSION['user_id'])) {
    // User is already logged in, redirect to dashboard
    header('Location: dashboard.php');
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if email exists in the database
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    // Verify the password
    if ($user && password_verify($password, $user['password'])) {
        // Password is correct, start session and redirect to dashboard
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        header('Location: dashboard.php'); // Redirect to the dashboard or homepage
        exit();
    } else {
        // Invalid credentials
        $error = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Your Awesome App</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts - Poppins for a modern look -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
    :root {
        --primary-color: #6f42c1;
        /* A vibrant purple */
        --secondary-color: #e9ecef;
        /* Light grey for background */
        --accent-color: #8a2be2;
        /* A slightly darker purple for hover */
        --text-color: #343a40;
        /* Dark grey for general text */
        --light-text-color: #6c757d;
        /* Lighter grey for secondary text */
    }

    body {
        background: linear-gradient(135deg, #a770ef 0%, #cf8bf3 50%, #fbc2eb 100%);
        /* Softer, more inviting gradient */
        font-family: 'Poppins', sans-serif;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        color: var(--text-color);
    }

    .login-container {
        /* Renamed from registration-container */
        max-width: 1000px;
        width: 100%;
        background: white;
        border-radius: 1rem;
        /* More rounded corners */
        box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.15);
        /* Stronger, more attractive shadow */
        overflow: hidden;
        display: flex;
        /* Use flexbox for layout */
        flex-direction: column;
        /* Stack columns on small screens */
    }

    @media (min-width: 992px) {

        /* For large screens and up */
        .login-container {
            flex-direction: row;
            /* Side-by-side columns */
        }
    }

    .login-header {
        /* Renamed from registration-header */
        background: linear-gradient(45deg, var(--primary-color) 0%, var(--accent-color) 100%);
        color: white;
        padding: 2.5rem;
        text-align: center;
        border-bottom-left-radius: 0;
        /* Remove specific border radius for header */
        border-top-right-radius: 1rem;
        /* Apply to top-right for larger screens */
    }

    @media (min-width: 992px) {
        .login-header {
            border-bottom-left-radius: 1rem;
            /* Apply to bottom-left for larger screens */
            border-top-right-radius: 0;
            /* Remove from top-right for larger screens */
        }
    }

    .login-header h1 {
        font-weight: 700;
        margin-bottom: 0.5rem;
        font-size: 2.5rem;
    }

    .login-header p {
        font-weight: 300;
        opacity: 0.9;
    }

    .login-form {
        /* Renamed from registration-form */
        padding: 3rem;
        flex-grow: 1;
        /* Allow form to take available space */
    }

    .form-control {
        border-radius: 0.5rem;
        /* Slightly more rounded inputs */
        padding: 0.75rem 1.25rem;
        border: 1px solid #ced4da;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.25rem rgba(111, 66, 193, 0.25);
        /* Adjusted shadow for focus */
    }

    .form-label {
        font-weight: 600;
        color: var(--text-color);
        margin-bottom: 0.5rem;
    }

    .btn-primary {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
        border-radius: 0.5rem;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: var(--accent-color);
        border-color: var(--accent-color);
        transform: translateY(-2px);
        /* Slight lift effect on hover */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .register-link {
        /* Renamed from login-link */
        color: var(--primary-color);
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s ease;
    }

    .register-link:hover {
        text-decoration: underline;
        color: var(--accent-color);
    }

    .password-toggle {
        cursor: pointer;
        position: absolute;
        right: 15px;
        /* Adjusted position */
        top: 50%;
        transform: translateY(-50%);
        z-index: 5;
        color: var(--light-text-color);
        transition: color 0.3s ease;
    }

    .password-toggle:hover {
        color: var(--primary-color);
    }

    .welcome-section {
        background-color: var(--secondary-color);
        padding: 3rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        border-top-right-radius: 0;
        /* Remove specific border radius */
        border-bottom-left-radius: 1rem;
        /* Apply to bottom-left for larger screens */
    }

    @media (min-width: 992px) {
        .welcome-section {
            border-top-right-radius: 1rem;
            /* Apply to top-right for larger screens */
            border-bottom-left-radius: 0;
            /* Remove from bottom-left for larger screens */
        }
    }

    .welcome-section img {
        max-width: 250px;
        /* Larger image */
        height: auto;
        margin-bottom: 1.5rem;
        border-radius: 50%;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
        animation: fadeIn 1s ease-out;
    }

    .welcome-section h3 {
        font-weight: 700;
        margin-bottom: 0.75rem;
        color: var(--primary-color);
    }

    .welcome-section p {
        color: var(--light-text-color);
        margin-bottom: 1.5rem;
        line-height: 1.6;
    }

    .btn-outline-primary {
        color: var(--primary-color);
        border-color: var(--primary-color);
        border-radius: 0.5rem;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-outline-primary:hover {
        background-color: var(--primary-color);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Animations */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .login-form,
    .welcome-section {
        animation: fadeIn 0.8s ease-out;
    }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-header col-lg-5">
            <h1><i class="fas fa-sign-in-alt me-2"></i>Welcome Back!</h1>
            <p class="mb-0">Log in to continue your journey with us.</p>
        </div>

        <div class="col-lg-7">
            <div class="login-form">
                <form class="needs-validation" method="POST" novalidate>
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="email" class="form-label">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input type="email" name="email" class="form-control" id="email"
                                    placeholder="you@example.com" required>
                                <div class="invalid-feedback">
                                    Please enter a valid email address.
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="password" class="form-label">Password</label>
                            <div class="position-relative">
                                <input type="password" name="password" class="form-control" id="password" required>
                                <i class="fas fa-eye password-toggle" onclick="togglePassword('password')"></i>
                                <div class="invalid-feedback">
                                    Please enter your password.
                                </div>
                            </div>
                        </div>

                        <div class="col-12 d-flex justify-content-between align-items-center">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="rememberMe">
                                <label class="form-check-label" for="rememberMe">
                                    Remember me
                                </label>
                            </div>
                            <a href="#" class="register-link">Forgot Password?</a>
                        </div>

                        <div class="col-12 mt-4">
                            <button class="btn btn-primary btn-lg w-100" type="submit">Login</button>
                        </div>
                    </div>
                </form>

                <?php if (isset($error)): ?>
                <p class="text-center text-danger"><?php echo $error; ?></p>
                <?php endif; ?>

                <p class="text-center mt-4 mb-0 text-muted">
                    Don't have an account? <a href="register.php" class="register-link">Register here</a>
                </p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    // Form validation
    (function() {
        'use strict'

        var forms = document.querySelectorAll('.needs-validation')

        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }

                    form.classList.add('was-validated');
                }, false);
            });
    })();

    // Toggle password visibility
    function togglePassword(fieldId) {
        const field = document.getElementById(fieldId);
        const icon = field.nextElementSibling;
        if (field.type === 'password') {
            field.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            field.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
    </script>
</body>

</html>