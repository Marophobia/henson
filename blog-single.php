<?php
include 'handlers/blog.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>News & Events | Adesotu International College</title>
    <meta name="description"
        content="Learn about Adesotu International College, our mission, vision, and dedication to academic excellence and holistic student development. Discover what sets us apart.">
    <meta name="keywords"
        content="About Adesotu International College, school mission, vision, educational excellence, student development">
    <meta name="author" content="Adesotu International College">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="News & Events | Adesotu International College">
    <meta property="og:description"
        content="Discover the mission and values of Adesotu International College. Learn why we're a top choice for holistic education.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://www.adesotucollege.com/blog.php">
    <meta property="og:image" content="https://www.adesotucollege.com/assets/img/about.jpg">
    <meta property="og:site_name" content="Adesotu International College">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="News & Events | Adesotu International College">
    <meta name="twitter:description"
        content="Learn about Adesotu International College's commitment to excellence and how we nurture future leaders.">
    <meta name="twitter:image" content="https://www.adesotucollege.com/assets/img/about.jpg">

    <!-- favicon -->
    <link rel="icon" type="image/x-icon" href="assets/img/logo/logo.png">

    <!-- css -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/all-fontawesome.min.css">
    <link rel="stylesheet" href="../assets/css/animate.min.css">
    <link rel="stylesheet" href="../assets/css/magnific-popup.min.css">
    <link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>


    <!-- header area -->
    <?php include 'includes/header.php'; ?>
    <!-- header area end -->


    <main class="main">

        <!-- breadcrumb -->
        <div class="site-breadcrumb" style="background: url(../assets/img/slider/slider-1.jpg)">
            <div class="container">
                <h2 class="breadcrumb-title"><?= htmlspecialchars($blogs->title); ?></h2>
                <ul class="breadcrumb-menu">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="blog.php">News & Events</a></li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->


        <!-- blog single area -->
        <div class="blog-single-area pt-120 pb-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="blog-single-wrapper">
                            <div class="blog-single-content">
                                <div class="blog-thumb-img">
                                    <img src="../assets/img/blog/<?= htmlspecialchars($blogs->image); ?>" alt="thumb">
                                </div>

                                <div class="blog-info">
                                    <div class="blog-meta">
                                        <div class="blog-meta-left">
                                            <ul>
                                                <li><i class="far fa-user"></i><a href="#"><?= htmlspecialchars($blogs->author); ?></a></li>
                                                <li><i class="far fa-thumbs-up"></i><?= htmlspecialchars($category->name); ?></li>
                                            </ul>
                                        </div>
                                        <div class="blog-meta-right">
                                            <a href="#" class="share-link"><i class="far fa-share-alt"></i>Share</a>
                                        </div>
                                    </div>
                                    <div class="blog-details">
                                        <h3 class="blog-details-title mb-20"><?= htmlspecialchars($blogs->title); ?>
                                        </h3>
                                        <p class="mb-10">
                                            <?= $blogs->content; ?>
                                        </p>
                                        <hr>
                                        <div class="blog-details-tags pb-20">
                                            <h5>Tags : </h5>
                                            <ul>
                                                <?php
                                                if (!empty($blogs->tags)) {
                                                    $tags = explode(',', $blogs->tags);
                                                    foreach ($tags as $tag) {
                                                        $tag = trim($tag); // Remove any extra whitespace
                                                        if (!empty($tag)) {
                                                            echo "<li><a href='#'>" . htmlspecialchars($tag) . "</a></li>";
                                                        }
                                                    }
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="blog-comments">
                                    <h3>Comments (<?= count($comments); ?>)</h3>
                                    
                                    <?php if (isset($_SESSION['success'])): ?>
                                        <div class="alert alert-success">
                                            <?= $_SESSION['success']; ?>
                                            <?php unset($_SESSION['success']); ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (isset($_SESSION['error'])): ?>
                                        <div class="alert alert-danger">
                                            <?= $_SESSION['error']; ?>
                                            <?php unset($_SESSION['error']); ?>
                                        </div>
                                    <?php endif; ?>

                                    <div class="blog-comments-wrapper">
                                        <?php foreach ($comments as $comment): ?>
                                            <div class="blog-comments-single">
                                                <div class="blog-comments-content">
                                                    <h5><?= htmlspecialchars($comment->name); ?></h5>
                                                    <span><i class="far fa-clock"></i>
                                                        <?= htmlspecialchars($comment->date); ?></span>
                                                    <p><?= htmlspecialchars($comment->comment); ?></p>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <div class="blog-comments-form">
                                        <h3>Leave A Comment</h3>
                                        <form action="../handlers/comment.php" method="POST">
                                            <input type="hidden" name="blog_id" value="<?= htmlspecialchars($blogs->id); ?>">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="name" placeholder="Your Name*" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <textarea class="form-control" name="comment" rows="5" placeholder="Your Comment*" required></textarea>
                                                    </div>
                                                    <button type="submit" name="submit_comment" class="theme-btn">Post Comment <i class="far fa-paper-plane"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <aside class="sidebar">
                            <div class="widget category">
                                <h5 class="widget-title">Category</h5>
                                <div class="category-list">
                                    <?php foreach ($categories as $category): ?>
                                        <a href="#"><i class="far fa-arrow-right">
                                            </i><?= htmlspecialchars($category->name); ?></a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <!-- recent post -->
                            <div class="widget recent-post">
                                <h5 class="widget-title">Recent Post</h5>
                                <?php foreach ($otherBlogs as $blog): ?>
                                    <div class="recent-post-single">
                                        <div class="recent-post-img">
                                            <img src="../assets/img/blog/<?= htmlspecialchars($blog->image); ?>"
                                                alt="thumb">
                                        </div>
                                        <div class="recent-post-bio">
                                            <h6><a
                                                    href="../blog/<?= urlencode($blog->link); ?>"><?= htmlspecialchars($blog->title); ?></a>
                                            </h6>
                                            <span><i class="far fa-clock"></i><?= htmlspecialchars($blog->date); ?></span>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <!-- social share -->
                            <div class="widget social-share">
                                <h5 class="widget-title">Follow Us</h5>
                                <div class="social-share-link">
                                    <a href="https://web.facebook.com/profile.php?id=100067517527058"><i
                                            class="fab fa-facebook-f"></i></a>
                                    <a href="https://wa.me/2348162118764"><i class="fab fa-whatsapp"></i></a>
                                </div>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
        <!-- blog single area end -->
    </main>

    <!-- footer area -->
    <?php include 'includes/footer.php'; ?>
    <!-- footer area end -->

    <!-- scroll-top -->
    <a href="#" id="scroll-top"><i class="far fa-arrow-up-from-arc"></i></a>
    <!-- scroll-top end -->


    <!-- js -->
    <script data-cfasync="false" src="../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="../assets/js/jquery-3.7.1.min.js"></script>
    <script src="../assets/js/modernizr.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/imagesloaded.pkgd.min.js"></script>
    <script src="../assets/js/jquery.magnific-popup.min.js"></script>
    <script src="../assets/js/isotope.pkgd.min.js"></script>
    <script src="../assets/js/jquery.appear.min.js"></script>
    <script src="../assets/js/jquery.easing.min.js"></script>
    <script src="../assets/js/owl.carousel.min.js"></script>
    <script src="../assets/js/counter-up.js"></script>
    <script src="../assets/js/wow.min.js"></script>
    <script src="../assets/js/main.js"></script>

</body>

</html>