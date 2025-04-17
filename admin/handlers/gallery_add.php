<?php
session_start();
require '../../config/db.php';

if (!isset($_SESSION['admin_id'])) {
    $_SESSION['error'] = "You must log in first.";
    header("Location: ../index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Handle image upload
        if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
            throw new Exception("Please upload a valid image.");
        }

        $file = $_FILES['image'];
        $file_size = $file['size'];
        $file_tmp = $file['tmp_name'];
        $file_type = $file['type'];
        
        // Validate file size (5MB = 5 * 1024 * 1024 bytes)
        if ($file_size > 5 * 1024 * 1024) {
            throw new Exception("Image size should not exceed 5MB.");
        }

        // Validate file type
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($file_type, $allowed_types)) {
            throw new Exception("Only JPG, PNG, and GIF images are allowed.");
        }

        // Generate unique filename
        $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = uniqid() . '.' . $file_extension;
        $upload_path = '../../assets/img/gallery/' . $filename;

        // Move uploaded file
        if (!move_uploaded_file($file_tmp, $upload_path)) {
            throw new Exception("Failed to upload image.");
        }

        // Create new gallery entry
        $gallery = R::dispense('gallery');
        $gallery->name = $filename;
        $gallery->type = 1; // Assuming 1 is for gallery images
        $gallery->status = isset($_POST['status']) ? 1 : 0;
        $gallery->created_at = date('Y-m-d H:i:s');

        R::store($gallery);

        $_SESSION['success'] = "Image uploaded successfully!";
        header("Location: ../gallery.php");
        exit;

    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
        header("Location: ../addimage.php");
        exit;
    }
} else {
    $_SESSION['error'] = "Invalid request method.";
    header("Location: ../addimage.php");
    exit;
} 