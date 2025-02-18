<?php
require '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_comment'])) {
    // Get and sanitize the input data
    $blog_id = isset($_POST['blog_id']) ? (int)$_POST['blog_id'] : 0;
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $comment = isset($_POST['comment']) ? trim($_POST['comment']) : '';
    $date = date('Y-m-d H:i:s');

    // Validate the input
    if (empty($blog_id) || empty($name) || empty($comment)) {
        $_SESSION['error'] = "All fields are required.";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }

    // Verify that the blog post exists
    $blog = R::load('blog', $blog_id);
    if (!$blog->id) {
        $_SESSION['error'] = "Invalid blog post.";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }

    try {
        // Create new comment
        $newComment = R::dispense('comments');
        $newComment->blog_id = $blog_id;
        $newComment->name = $name;
        $newComment->comment = $comment;
        $newComment->date = $date;
        
        // Store the comment
        R::store($newComment);

        $_SESSION['success'] = "Your comment has been posted successfully!";
    } catch (Exception $e) {
        $_SESSION['error'] = "An error occurred while posting your comment. Please try again.";
    }

    // Redirect back to the blog post
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
} else {
    // If someone tries to access this file directly
    header("Location: ../blog.php");
    exit;
} 