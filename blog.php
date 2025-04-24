<?php
// Include database connection
include 'config/db.php';

// Get current page number from URL, default to 1 if not set
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$posts_per_page = 10;

// Calculate the offset for the SQL query
$offset = ($current_page - 1) * $posts_per_page;

// Get total number of blog posts
$total_posts = R::count('blog');
$total_pages = ceil($total_posts / $posts_per_page);

// Ensure current page is within valid range
if ($current_page < 1) {
    $current_page = 1;
} elseif ($current_page > $total_pages && $total_pages > 0) {
    $current_page = $total_pages;
}

// Fetch blogs for current page
$blogs = R::findAll('blog', 'WHERE status = 1 ORDER BY id DESC LIMIT ? OFFSET ?', [$posts_per_page, $offset]);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News & Events | Adesotu International College</title>
    <meta name="description" content="Stay updated with the latest news, events, and educational insights from Adesotu International College.">
    <meta name="keywords" content="Adesotu International College blog, news, events, educational insights, school updates">
    <meta name="author" content="Adesotu International College">
    <meta name="robots" content="index, follow">
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="News & Events | Adesotu International College">
    <meta property="og:description" content="Discover the mission and values of Adesotu International College. Learn why we're a top choice for holistic education.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://www.adesotucollege.com/blog.php">
    <meta property="og:image" content="https://www.adesotucollege.com/assets/img/about.jpg">
    <meta property="og:site_name" content="Adesotu International College">
    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="News & Events | Adesotu International College">
    <meta name="twitter:description" content="Learn about Adesotu International College's commitment to excellence and how we nurture future leaders.">
    <meta name="twitter:image" content="https://www.adesotucollege.com/assets/img/about.jpg">

    <!-- favicon -->
    <link rel="icon" type="image/x-icon" href="assets/img/logo/logo.png">

    <!-- css -->    
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/all-fontawesome.min.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <!-- header area -->
    <?php include 'includes/header.php'; ?>
    <!-- header area end -->

    <main class="main">

        <!-- breadcrumb -->
        <div class="site-breadcrumb" style="background: url(assets/img/slider/slider-1.jpg)">
            <div class="container">
                <h2 class="breadcrumb-title">News & Events</h2>
                <ul class="breadcrumb-menu">
                    <li><a href="index.php">Home</a></li>
                    <li class="active">News & Events</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->

        <!-- blog area -->
        <div class="blog-area py-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mx-auto">
                        <div class="site-heading text-center">
                            <span class="site-title-tagline"> News & Events</span>
                            <h2 class="site-title">Latest News & <span>Events</span></h2>
                            <p>Stay updated with the latest news and happenings from Adesotu International College.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php foreach ($blogs as $blog): 
                        // Get comment count for this blog
                        $commentCount = R::count('comments', 'blog_id = ?', [$blog->id]);
                    ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="blog-item wow fadeInUp" data-wow-delay=".25s">
                                <div class="blog-date"><i class="fal fa-calendar-alt"></i> <?= htmlspecialchars($blog->date); ?></div>
                                <div class="blog-item-img">
                                    <img src="assets/img/blog/<?= htmlspecialchars($blog->image); ?>" alt="Thumb">
                                </div>
                                <div class="blog-item-info">
                                    <div class="blog-item-meta">
                                        <ul>
                                            <li><a href="#"><i class="far fa-user-circle"></i> By <?= htmlspecialchars($blog->author); ?></a></li>
                                            <li><a href="#"><i class="far fa-comments"></i> <?= $commentCount ?> Comments</a></li>
                                        </ul>
                                    </div>
                                    <h4 class="blog-title">
                                        <a href="blog/<?= urlencode($blog->link); ?>"><?= htmlspecialchars($blog->title); ?></a>
                                    </h4>
                                    <a class="theme-btn" href="blog/<?= urlencode($blog->link); ?>">Read More<i
                                            class="fas fa-arrow-right-long"></i></a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>
                <!-- pagination -->
                <div class="pagination-area">
                    <div aria-label="Page navigation example">
                        <ul class="pagination">
                            <?php if ($current_page > 1): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?= $current_page - 1 ?>" aria-label="Previous">
                                        <span aria-hidden="true"><i class="far fa-arrow-left"></i></span>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php
                            // Calculate range of pages to show
                            $start_page = max(1, $current_page - 2);
                            $end_page = min($total_pages, $start_page + 4);
                            $start_page = max(1, $end_page - 4);

                            for ($i = $start_page; $i <= $end_page; $i++):
                            ?>
                                <li class="page-item <?= ($i == $current_page) ? 'active' : '' ?>">
                                    <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                                </li>
                            <?php endfor; ?>

                            <?php if ($current_page < $total_pages): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?= $current_page + 1 ?>" aria-label="Next">
                                        <span aria-hidden="true"><i class="far fa-arrow-right"></i></span>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
                <!-- pagination end -->
            </div>
        </div>
        <!-- blog area end -->

    </main>



    <!-- footer area -->
    <?php include 'includes/footer.php'; ?>
    <!-- footer area end -->

    <!-- scroll-top -->
    <a href="#" id="scroll-top"><i class="far fa-arrow-up-from-arc"></i></a>
    <!-- scroll-top end -->

    <!-- js -->
    <script data-cfasync="false" src="../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <script src="assets/js/modernizr.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/imagesloaded.pkgd.min.js"></script>
    <script src="assets/js/jquery.magnific-popup.min.js"></script>
    <script src="assets/js/isotope.pkgd.min.js"></script>
    <script src="assets/js/jquery.appear.min.js"></script>
    <script src="assets/js/jquery.easing.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/counter-up.js"></script>
    <script src="assets/js/wow.min.js"></script>
    <script src="assets/js/main.js"></script>

</body>

</html>