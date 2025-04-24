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
$posts_per_page = 3;

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

// Fetch blogs for current page with pagination
$blogs = R::findAll('blog', 'ORDER BY id DESC LIMIT ? OFFSET ?', [$posts_per_page, $offset]);
$categories = R::findAll('categories', 'ORDER BY id ASC');

// Handle category form submission
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['name'])) {
    $categoryName = trim($_POST['name']);

    // Validate input
    if (empty($categoryName)) {
        $_SESSION['error'] = "Category name is required.";
        header("Location: news.php");
        exit;
    }

    // Check if category already exists
    $existingCategory = R::findOne('categories', 'name = ?', [$categoryName]);
    if ($existingCategory) {
        $_SESSION['error'] = "Category already exists!";
        header("Location: news.php");
        exit;
    }

    // Create and store the category
    $category = R::dispense('categories');
    $category->name = $categoryName;
    $category->created_at = date('Y-m-d H:i:s');

    R::store($category);

    $_SESSION['success'] = "Category added successfully!";
    header("Location: news.php");
    exit;
}

// Handle publish/unpublish actions
if (isset($_GET['action']) && isset($_GET['id'])) {
    $blog_id = (int)$_GET['id'];
    $blog = R::load('blog', $blog_id);
    
    if ($blog->id) {
        if ($_GET['action'] === 'publish') {
            $blog->status = 1;
            $_SESSION['success'] = "Post published successfully!";
        } elseif ($_GET['action'] === 'unpublish') {
            $blog->status = 0;
            $_SESSION['success'] = "Post unpublished successfully!";
        }
        R::store($blog);
    }
    
    header("Location: news.php");
    exit;
}

?>

<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">

<head>  

    <meta charset="utf-8" />
    <title>News And Events | Adesotu International College</title>
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

</head>

<body>
    <div id="layout-wrapper">

        <?php include 'includes/header.php' ?>


        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div
                                class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                                <h4 class="mb-sm-0">News and Events List</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                        <li class="breadcrumb-item active">News and Events List</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row g-4 mb-3">
                        <div class="col-12">
                            <div>
                                <a href="add-news.php" class="btn btn-success"><i
                                        class="ri-add-line align-bottom me-1"></i>
                                    Add New</a>
                            </div>
                        </div>
                    </div>

                    <!-- Display success message if available -->
                    <?php

                    if (isset($_SESSION['error'])) {
                        echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
                        unset($_SESSION['error']);
                    }

                    if (isset($_SESSION['success'])) {
                        echo '<div class="alert alert-success">' . $_SESSION['success'] . '</div>';
                        unset($_SESSION['success']);
                    }
                    ?>

                    <div class="row">
                        <div class="col-lg-8">
                            <div class="row">
                                <?php foreach ($blogs as $blog): ?>
                                    <?php
                                    // Fetch the related category
                                    $category = R::load('categories', $blog->category);
                                    ?>
                                    <div class="col-xxl-4 col-sm-6 project-card">
                                        <div class="card card-height-100">
                                            <div class="card-body">
                                                <div class="d-flex flex-column h-100">
                                                    <div class="d-flex">
                                                        <div class="flex-grow-1">
                                                            <p class="text-muted mb-4">
                                                                <?= htmlspecialchars($category ? $category->name : 'Uncategorized'); ?>
                                                            </p>
                                                        </div>
                                                        <div class="flex-shrink-0">
                                                            <div class="d-flex gap-1 align-items-center">
                                                                <div class="dropdown">
                                                                    <button class="btn btn-link text-muted p-1 mt-n2 py-0 text-decoration-none fs-15"
                                                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                                        <i data-feather="more-horizontal" class="icon-sm"></i>
                                                                    </button>

                                                                    <div class="dropdown-menu dropdown-menu-end">
                                                                        <?php if ($blog->status == 1): ?>
                                                                            <a class="dropdown-item" href="news.php?action=unpublish&id=<?= $blog->id ?>">
                                                                                <i class="ri-close-fill align-bottom me-2 text-muted"></i>
                                                                                Unpublish
                                                                            </a>
                                                                        <?php else: ?>
                                                                            <a class="dropdown-item" href="news.php?action=publish&id=<?= $blog->id ?>">
                                                                                <i class="ri-check-fill align-bottom me-2 text-muted"></i>
                                                                                Publish
                                                                            </a>
                                                                        <?php endif; ?>
                                                                        <a class="dropdown-item" href="../blog/<?= urlencode($blog->link); ?>">
                                                                            <i class="ri-eye-fill align-bottom me-2 text-muted"></i>
                                                                            View
                                                                        </a>
                                                                        <a class="dropdown-item" href="edit-news.php?id=<?= $blog->id ?>">
                                                                            <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                                            Edit
                                                                        </a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a class="dropdown-item" href="handlers/news_delete.php?id=<?= $blog->id ?>"
                                                                           onclick="return confirm('Are you sure you want to delete this post?')">
                                                                            <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                                            Delete
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex mb-2">
                                                        <div class="flex-shrink-0 me-3">
                                                            <div class="avatar-sm">
                                                                <span class="avatar-title bg-warning-subtle rounded p-2">
                                                                    <img src="../assets/img/blog/<?= htmlspecialchars($blog->image); ?>"
                                                                        alt="" class="img-fluid p-1">
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <h5 class="mb-1 fs-15">
                                                                <a href="../blog/<?= urlencode($blog->link); ?>" class="text-body">
                                                                    <?= htmlspecialchars($blog->title); ?>
                                                                </a>
                                                            </h5>
                                                            <p class="text-muted text-truncate-two-lines mb-3">
                                                                <?= htmlspecialchars($blog->summary); ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer bg-transparent border-top-dashed py-2">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-grow-1">
                                                        <div class="avatar-group">
                                                            <div class="text-muted">
                                                                <i class="ri-user-settings-line me-1 align-bottom"></i>
                                                                <?= htmlspecialchars($blog->author); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="text-muted">
                                                            <i class="ri-calendar-event-fill me-1 align-bottom"></i>
                                                            <?= date('M d, Y', strtotime($blog->date)); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            
                            <!-- Pagination -->
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
                                                            <i class="ri-arrow-right-s-line"></i>
                                                        </a>
                                                    </li>
                                                <?php endif; ?>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card card-height-100">
                                <div class="card-body">
                                    <div class="d-flex flex-column h-100">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <p class="text-muted mb-4">News and Event Categories</p>
                                            </div>
                                        </div>
                                        <div class="mb-2">
                                            <div>
                                                <form action="news.php" method="post">
                                                    <label for="category" class="form-label w-100">Category Name</label>
                                                    <input type="text" class="form-control" name="name" id="category"
                                                        placeholder="Enter new category name">
                                                    <button class="btn btn-success mt-3">Add Category</button>
                                                </form>
                                            </div>
                                            <div data-simplebar style="height: 242px;" class="mt-4">
                                                <ul class="list mb-0">
                                                    <?php foreach ($categories as $category): ?>
                                                        <li>
                                                            <div class="d-flex gap-5 justify-content-between">
                                                                <p class="name"><?= htmlspecialchars($category->name); ?>
                                                                </p>
                                                                <a href="handlers/category_delete.php?id=<?= urlencode($category->id); ?>"
                                                                    class="text-danger"><i
                                                                        class="ri-delete-bin-fill align-bottom me-1 text-danger"></i>
                                                                    Delete</a>
                                                            </div>
                                                        </li>
                                                    <?php endforeach; ?>


                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->
                        </div>
                    </div>
                    <!-- end row -->

                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

        </div>
        <!-- end main content-->

        <!-- removeNotificationModal -->
        <div id="removeNotificationModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            id="NotificationModalbtn-close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mt-2 text-center">
                            <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                                colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                            <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                <h4>Are you sure ?</h4>
                                <p class="text-muted mx-4 mb-0">Are you sure you want to remove this Notification ?</p>
                            </div>
                        </div>
                        <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                            <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn w-sm btn-danger" id="delete-notification">Yes, Delete
                                It!</button>
                        </div>
                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->



        <!-- end main content-->
        <?php include 'includes/footer.php' ?>
        <!-- JAVASCRIPT -->
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>
        <script src="assets/libs/feather-icons/feather.min.js"></script>
        <script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
        <script src="assets/js/plugins.js"></script>

        <!-- apexcharts -->
        <script src="assets/libs/apexcharts/apexcharts.min.js"></script>

        <!-- projects js -->
        <script src="assets/js/pages/dashboard-projects.init.js"></script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>
</body>

</html>