<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['admin_id'])) {
    $_SESSION['error'] = "You must log in first.";
    header("Location: index.php");
    exit;
}

// Get current page number from URL, default to 1 if not set
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$items_per_page = 12; // Show more items since these are images

// Calculate the offset for the SQL query
$offset = ($current_page - 1) * $items_per_page;

// Get total number of gallery images
$total_items = R::count('gallery', 'type = ?', [1]);
$total_pages = ceil($total_items / $items_per_page);

// Ensure current page is within valid range
if ($current_page < 1) {
    $current_page = 1;
} elseif ($current_page > $total_pages && $total_pages > 0) {
    $current_page = $total_pages;
}

// Fetch gallery images for current page with pagination
$gallery_images = R::findAll('gallery', 'type = ? ORDER BY id DESC LIMIT ? OFFSET ?', [1, $items_per_page, $offset]);

// Handle publish/unpublish actions
if (isset($_GET['action']) && isset($_GET['id'])) {
    $image_id = (int)$_GET['id'];
    $image = R::load('gallery', $image_id);
    
    if ($image->id) {
        if ($_GET['action'] === 'publish') {
            $image->status = 1;
            $_SESSION['success'] = "Image published successfully!";
        } elseif ($_GET['action'] === 'unpublish') {
            $image->status = 0;
            $_SESSION['success'] = "Image unpublished successfully!";
        }
        R::store($image);
    }
    
    header("Location: gallery.php");
    exit;
}
?>

<!doctype html>         
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">

<head>
    <meta charset="utf-8" />
    <title>Gallery | Henson Demonstration Schools</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <!-- Layout config Js -->
    <script src="assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="assets/css/custom.min.css" rel="stylesheet" type="text/css" />
    <style>
        .gallery-image-container {
            aspect-ratio: 4/3;
            overflow: hidden;
            position: relative;
        }
        .gallery-image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }
    </style>
</head>

<body>
    <div id="layout-wrapper">
        <?php include 'includes/header.php' ?>

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                                <h4 class="mb-sm-0">Gallery Images</h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Gallery</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row g-4 mb-3">
                        <div class="col-sm-auto">
                            <div>
                                <a href="addimage.php" class="btn btn-success"><i class="ri-add-line align-bottom me-1"></i> Add New</a>
                            </div>
                        </div>
                    </div>

                    <!-- Display messages -->
                    <?php if (isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger"><?= $_SESSION['error'] ?></div>
                        <?php unset($_SESSION['error']); ?>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['success'])): ?>
                        <div class="alert alert-success"><?= $_SESSION['success'] ?></div>
                        <?php unset($_SESSION['success']); ?>
                    <?php endif; ?>

                    <div class="row">
                        <?php if ($gallery_images): ?>
                            <?php foreach ($gallery_images as $image): ?>
                                <div class="col-xl-3 col-lg-4 col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="flex-grow-1">
                                                    <h5 class="mb-0">Gallery Image</h5>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <div class="dropdown">
                                                        <a class="btn btn-link text-muted p-1 mt-n2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="ri-more-fill"></i>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                            <?php if ($image->status == 0): ?>
                                                                <li><a class="dropdown-item" href="?action=publish&id=<?= $image->id ?>">Publish</a></li>
                                                            <?php else: ?>
                                                                <li><a class="dropdown-item" href="?action=unpublish&id=<?= $image->id ?>">Unpublish</a></li>
                                                            <?php endif; ?>
                                                            <li><a class="dropdown-item" href="handlers/gallery_delete.php?id=<?= $image->id ?>" 
                                                                onclick="return confirm('Are you sure you want to delete this image?')">Delete</a></li>
                                                        </ul>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="gallery-image-container mb-3">
                                                <img src="../assets/img/gallery/<?= htmlspecialchars($image->name) ?>" 
                                                    alt="Gallery Image" class="img-fluid rounded">
                                            </div>
                                            <div class="badge bg-<?= $image->status ? 'success' : 'warning' ?>">
                                                <?= $image->status ? 'Published' : 'Unpublished' ?>
                                            </div>
                                            <div class="text-muted mt-2">
                                                <i class="ri-calendar-event-fill me-1 align-bottom"></i>
                                                <?= date('M d, Y', strtotime($image->created_at)) ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <p class="text-center mb-0">No images found</p>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Pagination -->
                    <?php if ($total_pages > 1): ?>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="pagination-area mt-4">
                                    <nav aria-label="Page navigation">
                                        <ul class="pagination justify-content-center">
                                            <?php if ($current_page > 1): ?>
                                                <li class="page-item">
                                                    <a class="page-link" href="?page=<?= $current_page - 1 ?>" aria-label="Previous">
                                                        <i class="ri-arrow-left-s-line"></i>
                                                    </a>
                                                </li>
                                            <?php endif; ?>

                                            <?php
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
                                                        <i class="ri-arrow-right-s-line"></i>
                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <?php include 'includes/footer.php' ?>
    </div>

    <!-- JAVASCRIPT -->
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/app.js"></script>
</body>
</html> 