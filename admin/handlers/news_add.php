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
        // Validate and sanitize input
        $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
        $summary = filter_var($_POST['summary'], FILTER_SANITIZE_STRING);
        $content = $_POST['content']; // HTML content from Quill editor
        $author = filter_var($_POST['author'], FILTER_SANITIZE_STRING);
        $category = filter_var($_POST['category'], FILTER_VALIDATE_INT);
        $link = filter_var($_POST['link'], FILTER_SANITIZE_STRING);
        $tags = filter_var($_POST['tags'], FILTER_SANITIZE_STRING);
        $status = isset($_POST['status']) ? 1 : 0;

        // Basic validation
        if (empty($title) || empty($summary) || empty($content) || empty($author) || empty($link)) {
            throw new Exception("All required fields must be filled out.");
        }

        // Validate link format (only letters, numbers, and hyphens)
        if (!preg_match('/^[a-zA-Z0-9-]+$/', $link)) {
            throw new Exception("URL slug can only contain letters, numbers, and hyphens.");
        }

        // Check if link already exists
        $existing = R::findOne('blog', 'link = ?', [$link]);
        if ($existing) {
            throw new Exception("This URL slug is already in use. Please choose another.");
        }

        // Handle image upload
        if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
            throw new Exception("Please upload a valid image.");
        }

        $file = $_FILES['image'];
        $file_size = $file['size'];
        $file_tmp = $file['tmp_name'];
        $file_type = $file['type'];
        
        // Validate file size (2MB = 2 * 1024 * 1024 bytes)
        if ($file_size > 2 * 1024 * 1024) {
            throw new Exception("Image size should not exceed 2MB.");
        }

        // Validate file type
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($file_type, $allowed_types)) {
            throw new Exception("Only JPG, PNG, and GIF images are allowed.");
        }

        // Generate unique filename
        $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = uniqid() . '.' . $file_extension;
        $upload_path = '../../assets/img/blog/' . $filename;

        // Move uploaded file
        if (!move_uploaded_file($file_tmp, $upload_path)) {
            throw new Exception("Failed to upload image.");
        }

        // Create new blog post
        $blog = R::dispense('blog');
        $blog->title = $title;
        $blog->summary = $summary;
        $blog->content = $content;
        $blog->author = $author;
        $blog->category = $category;
        $blog->link = $link;
        $blog->tags = $tags;
        $blog->image = $filename;
        $blog->status = $status;
        $blog->date = date('Y-m-d H:i:s');

        R::store($blog);

        $_SESSION['success'] = "News post created successfully!";
        header("Location: ../news.php");
        exit;

    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
        header("Location: ../add-news.php");
        exit;
    }
} else {
    $_SESSION['error'] = "Invalid request method.";
    header("Location: ../add-news.php");
    exit;
} 