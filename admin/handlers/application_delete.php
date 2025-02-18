<?php
session_start();
require '../../config/db.php';

if (!isset($_SESSION['admin_id'])) {
    $_SESSION['error'] = "You must log in first.";
    header("Location: ../index.php");
    exit;
}

if (isset($_GET['id'])) {
    try {
        $id = (int)$_GET['id'];
        $application = R::load('application', $id);
        
        if ($application->id) {
            // Delete the application's image if it exists
            if ($application->image) {
                $image_path = '../../assets/img/applications/' . $application->image;
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
            }
            
            R::trash($application);
            $_SESSION['success'] = "Application deleted successfully!";
        } else {
            $_SESSION['error'] = "Application not found.";
        }
    } catch (Exception $e) {
        $_SESSION['error'] = "Error deleting application: " . $e->getMessage();
    }
} else {
    $_SESSION['error'] = "Invalid request.";
}

header("Location: ../applications.php");
exit; 