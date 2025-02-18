<?php
session_start();
require '../../config/db.php';

if (!isset($_SESSION['admin_id'])) {
    $_SESSION['error'] = "You must log in first.";
    header("Location: ../index.php");
    exit;
}

if (isset($_GET['id'])) {
    $blog_id = (int)$_GET['id'];
    $blog = R::load('blog', $blog_id);
    
    if ($blog->id) {
        // Delete associated comments first
        R::exec('DELETE FROM comments WHERE blog_id = ?', [$blog_id]);
        
        // Delete the blog post
        R::trash($blog);
        
        $_SESSION['success'] = "Post deleted successfully!";
    } else {
        $_SESSION['error'] = "Post not found!";
    }
} else {
    $_SESSION['error'] = "Invalid request!";
}

header("Location: ../news.php");
exit; 