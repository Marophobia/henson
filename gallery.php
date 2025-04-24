<?php
// Include database connection
include 'config/db.php';

// Get current page number from URL, default to 1 if not set
$current_page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$images_per_page = 10;

// Calculate the offset for the SQL query
$offset = ($current_page - 1) * $images_per_page;

// Get total number of gallery images
$total_images = R::count('gallery', 'type = ? AND status = ?', [1, 1]);
$total_pages = ceil($total_images / $images_per_page);

// Ensure current page is within valid range
if ($current_page < 1) {
    $current_page = 1;
} elseif ($current_page > $total_pages && $total_pages > 0) {
    $current_page = $total_pages;
}

// Fetch gallery images for current page
$gallery_images = R::find('gallery', 'type = ? AND status = ? ORDER BY id DESC LIMIT ? OFFSET ?', [1, 1, $images_per_page, $offset]);
?>

<!DOCTYPE html>
<html lang="en">



<head>
    <!-- meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery | Adesotu International College</title>
    <meta name="description" content="Explore the vibrant life of Adesotu International College through our photo gallery. See our events, facilities, and student activities.">
    <meta name="keywords" content="Adesotu International College gallery, photos, events, school facilities, student activities">
    <meta name="author" content="Adesotu International College">
    <meta name="robots" content="index, follow">
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="Gallery | Adesotu International College">
    <meta property="og:description" content="Discover Adesotu International College through our gallery. See images of our facilities, events, and vibrant student life.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://www.adesotucollege.com/gallery.php">
    <meta property="og:image" content="https://www.adesotucollege.com/assets/img/gallery.jpg">
    <meta property="og:site_name" content="Adesotu International College">
    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Gallery | Adesotu International College">
    <meta name="twitter:description" content="View the stunning visuals of Adesotu International College's campus, activities, and events in our gallery.">
    <meta name="twitter:image" content="https://www.adesotucollege.com/assets/img/gallery.jpg">
    <!-- favicon -->
    <link rel="icon" type="image/x-icon" href="assets/img/logo/logo.png">

    <!-- css -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/all-fontawesome.min.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <style>
        /* Style for active pagination */
        .pagination .page-item.active .page-link {
            background-color: green;
            /* Using the theme's primary color */
            border-color: green;
            color: #fff;
        }

        .pagination .page-link {
            color: #333;
            border: 1px solid #ddd;
            margin: 0 3px;
            border-radius: 3px;
            transition: all 0.3s ease;
        }

        .pagination .page-link:hover {
            background-color: green;
            color: #fff;
            border-color: green;
        }
    </style>
</head>



</head>

<body>

    <!-- header area -->
    <?php include 'includes/header.php'; ?>
    <!-- header area end -->


    <main class="main">

        <!-- breadcrumb -->
        <div class="site-breadcrumb" style="background: url(assets/img/slider/slider-1.jpg)">
            <div class="container">
                <h2 class="breadcrumb-title">Gallery</h2>
                <ul class="breadcrumb-menu">
                    <li><a href="index.html">Home</a></li>
                    <li class="active">Gallery</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->


        <!-- gallery-area -->
        <div class="gallery-area py-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mx-auto">
                        <div class="site-heading text-center">
                            <span class="site-title-tagline"> Gallery</span>
                            <h2 class="site-title">Our Photo <span>Gallery</span></h2>
                            <p>Experience Life at Adesotu International Colleges Through Our Lens</p>
                        </div>
                    </div>
                </div>
                <div class="row popup-gallery">
                    <?php if (count($gallery_images) > 0): ?>
                        <?php foreach ($gallery_images as $image): ?>
                            <div class="col-md-4 wow fadeInUp" data-wow-delay=".25s">
                                <div class="gallery-item">
                                    <div class="gallery-img">
                                        <img src="assets/img/gallery/<?= htmlspecialchars($image->name); ?>"
                                            alt="Gallery Image">
                                    </div>
                                    <div class="gallery-content">
                                        <a class="popup-img gallery-link"
                                            href="assets/img/gallery/<?= htmlspecialchars($image->name); ?>">
                                            <i class="fal fa-plus"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="col-12">
                            <h3 class="text-center">No Gallery Photos Available</h3>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Pagination -->
                <?php if ($total_pages > 1): ?>
                    <div class="pagination-area">
                        <div aria-label="Page navigation example">
                            <ul class="pagination">
                                <?php if ($current_page > 1): ?>
                                    <li class="page-item">
                                        <a class="page-link text-white" href="?page=<?= $current_page - 1 ?>"
                                            aria-label="Previous">
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
                                        <a class="page-link text-white" href="?page=<?= $i ?>"><?= $i ?></a>
                                    </li>
                                <?php endfor; ?>

                                <?php if ($current_page < $total_pages): ?>
                                    <li class="page-item">
                                        <a class="page-link text-white" href="?page=<?= $current_page + 1 ?>" aria-label="Next">
                                            <span aria-hidden="true"><i class="far fa-arrow-right"></i></span>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <!-- gallery-area end -->

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