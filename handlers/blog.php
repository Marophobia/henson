<?php
require 'config/db.php';

// Get the course link from the rewritten URL
$link = isset($_GET['link']) ? $_GET['link'] : null;

if ($link) {
    // Fetch the course based on the unique link
    $blogs = R::findOne('blog', 'link = ?', [$link]);

    if ($blogs) {
        // Fetch the associated category for the current course
        $category = R::load('categories', $blogs->category);

        // Fetch the list of all categories (limited to 5)
        $categories = R::findAll('categories', 'ORDER BY name ASC LIMIT 5');
        

        // Fetch other courses where the link is not equal to the current course
        $otherBlogs = R::find('blog', 'link != ? AND status = 1 LIMIT 3', [$link]);

        // Fetch comments for this blog post
        $comments = R::find('comments', 'blog_id = ? ORDER BY date DESC', [$blogs->id]);
    } else {
        echo "Blog not found.";
        exit;
    }
} else {
    echo "Invalid blog link.";
    exit;
}
?>