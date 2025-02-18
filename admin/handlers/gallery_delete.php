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
        $image_id = (int)$_GET['id'];
        $image = R::load('gallery', $image_id);

        if (!$image->id) {
            throw new Exception("Image not found.");
        }

        // Delete the physical file
        $file_path = '../../assets/img/gallery/' . $image->name;
        if (file_exists($file_path)) {
            unlink($file_path);
        }

        // Delete the database record
        R::trash($image);

        $_SESSION['success'] = "Image deleted successfully!";
        header("Location: ../gallery.php");
        exit;

    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
        header("Location: ../gallery.php");
        exit;
    }
} else {
    $_SESSION['error'] = "Invalid request.";
    header("Location: ../gallery.php");
    exit;
} 