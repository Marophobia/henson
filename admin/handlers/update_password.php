<?php
session_start();
require '../../config/db.php'; // Adjust path as needed

// Check if admin is logged in and request is POST
if (!isset($_SESSION['admin_id']) || $_SERVER["REQUEST_METHOD"] != "POST") {
    $_SESSION['error'] = "Unauthorized access or invalid request.";
    header("Location: ../profile.php");
    exit;
}

// Get data from POST request
$admin_id = $_POST['admin_id'];
$old_password = trim($_POST['old_password']);
$new_password = trim($_POST['new_password']);
$confirm_password = trim($_POST['confirm_password']);

// Basic validation
if (empty($old_password) || empty($new_password) || empty($confirm_password)) {
    $_SESSION['error'] = "All password fields are required.";
    header("Location: ../profile.php");
    exit;
}

if ($new_password !== $confirm_password) {
    $_SESSION['error'] = "New passwords do not match.";
    header("Location: ../profile.php");
    exit;
}

// Optional: Add password complexity requirements here (length, characters, etc.)
if (strlen($new_password) < 6) { // Example: Minimum 6 characters
    $_SESSION['error'] = "New password must be at least 6 characters long.";
    header("Location: ../profile.php");
    exit;
}

// --- Database Interaction ---
try {
    // Find the admin user by ID
    $admin = R::load('admin', $admin_id);

    if (!$admin || !$admin->id) {
        $_SESSION['error'] = "Admin user not found.";
        header("Location: ../profile.php");
        exit;
    }

    // Verify the old password
    if (password_verify($old_password, $admin->password)) {
        // Hash the new password
        $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Update the password in the database
        $admin->password = $hashed_new_password;
        R::store($admin);

        $_SESSION['success'] = "Password updated successfully.";
        header("Location: ../profile.php");
        exit;

    } else {
        $_SESSION['error'] = "Incorrect old password.";
        header("Location: ../profile.php");
        exit;
    }

} catch (Exception $e) {
    // Log the error details for debugging (don't show specifics to the user)
    error_log("Password update error for admin ID {$admin_id}: " . $e->getMessage());
    $_SESSION['error'] = "An error occurred while updating the password. Please try again.";
    header("Location: ../profile.php");
    exit;
}

?> 