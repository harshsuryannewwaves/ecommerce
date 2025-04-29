<?php
session_start();
require_once __DIR__ . '/../config/db.php';

// Register a new user
function register($name, $email, $password, $role = 'customer') {
    global $pdo;

    // Check for existing email
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        return ['success' => false, 'message' => 'Email already registered'];
    }

    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Insert new user
    $stmt = $pdo->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
    $stmt->execute([$name, $email, $hashedPassword, $role]);

    return ['success' => true, 'message' => 'Registration successful'];
}

// Login a user
function login($email, $password) {
    global $pdo;

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = [
            'id'    => $user['id'],
            'name'  => $user['name'],
            'email' => $user['email'],
            'role'  => $user['role']
        ];
        return ['success' => true, 'message' => 'Login successful'];
    }

    return ['success' => false, 'message' => 'Invalid email or password'];
}

// Logout user
if (isset($_GET['logout']) && $_GET['logout'] === 'true') {
    session_start();
    session_destroy();
    header("Location: ../views/auth/login.php");
    exit;
}

// Check if logged in
function isLoggedIn() {
    return isset($_SESSION['user']);
}

// Get current logged-in user
function currentUser() {
    return $_SESSION['user'] ?? null;
}

// Check if user is admin
function isAdmin() {
    return isLoggedIn() && $_SESSION['user']['role'] === 'admin';
}

// Check if user is vendor
function isVendor() {
    return isLoggedIn() && $_SESSION['user']['role'] === 'vendor';
}

// Check if user is customer
function isCustomer() {
    return isLoggedIn() && $_SESSION['user']['role'] === 'customer';
}

// Protect routes
function requireLogin() {
    if (!isLoggedIn()) {
        header("Location: ../views/auth/login.php");
        exit;
    }
}

// Protect admin-only routes
function requireAdmin() {
    if (!isAdmin()) {
        http_response_code(403);
        die('Access denied. Admins only.');
    }
}
?>
