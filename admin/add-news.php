<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require '../config/db.php'; // Database connection

if (!isset($_SESSION['admin_id'])) {
    $_SESSION['error'] = "You must log in first.";
    header("Location: index.php");
    exit;
}

$categories = R::findAll('categories', 'ORDER BY id ASC');


?>

<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">

<head>

    <meta charset="utf-8" />
    <title>Add News and Events | HGBSS</title>
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
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">


</head>

<body>
    <div id="layout-wrapper">

        <?php include 'includes/header.php' ?>

        <!-- quill css -->
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
                                <h4 class="mb-sm-0">Create News and Events</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">News And Events</a></li>
                                        <li class="breadcrumb-item active">Create</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

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

                    <form method="post" action="handlers/news_add.php" enctype="multipart/form-data" id="NewsForm">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label" for="news-title-input">News Title</label>
                                            <input type="text" name="title" class="form-control"
                                                id="news-title-input" placeholder="Enter news title" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="news-thumbnail-img">Featured Image</label>
                                            <input class="form-control" name="image" id="news-thumbnail-img"
                                                type="file" accept="image/png, image/gif, image/jpeg" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Summary</label>
                                            <input type="text" name="summary" class="form-control"
                                                placeholder="Enter a brief summary" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Content</label>
                                            <div id="editor">
                                            </div>
                                        </div>
                                        <input type="hidden" name="content" id="content">


                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3 mb-lg-0">
                                                    <label for="author-input" class="form-label">Author</label>
                                                    <input type="text" name="author" class="form-control"
                                                        id="author-input" placeholder="Enter author name" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3 mb-lg-0">
                                                    <label for="category-input" class="form-label">Category</label>
                                                    <select class="form-select" name="category" data-choices
                                                        data-choices-search-false id="category-input" required>
                                                        <?php foreach ($categories as $category): ?>
                                                            <option value="<?= htmlspecialchars($category->id); ?>">
                                                                <?= htmlspecialchars($category->name); ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                            <div class="col-lg-4">

                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Publishing Options</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="link" class="form-label">Unique URL Slug</label>
                                            <input type="text" name="link" class="form-control" id="link"
                                                placeholder="e.g., my-news-title" required>
                                            <small class="text-muted">This will be used in the URL. Use only letters, numbers, and hyphens.</small>
                                        </div>
                                        <div class="mb-3">
                                            <label for="tags" class="form-label">Tags</label>
                                            <input type="text" name="tags" class="form-control" id="tags"
                                                placeholder="Enter tags separated by commas">
                                            <small class="text-muted">Optional: Add tags separated by commas</small>
                                        </div>
                                        <div class="mb-3">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="status" value="1" id="publishSwitch" checked>
                                                <label class="form-check-label" for="publishSwitch">Publish Immediately</label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                                <div class="text-end mb-4">
                                    <button type="submit" class="btn btn-success w-sm">Save</button>
                                </div>
                            </div>
                            <!-- end col -->
                        </div>
                    </form>
                    <!-- end row -->

                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
        </div>
        <!-- end main content-->
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const options = {
                    debug: 'info',
                    modules: {
                        toolbar: [
                            [{ 'font': [] }],
                            [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                            ['bold', 'italic', 'underline', 'strike'],
                            [{ 'color': [] }, { 'background': [] }],
                            [{ 'script': 'sub' }, { 'script': 'super' }],
                            [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                            [{ 'indent': '-1' }, { 'indent': '+1' }],
                            [{ 'direction': 'rtl' }],
                            [{ 'align': [] }],
                            ['link', 'image', 'video'],
                            ['blockquote', 'code-block'],
                            [{ 'size': ['small', false, 'large', 'huge'] }],
                            [{ 'emoji': true }],
                            ['clean']
                        ]
                    },
                    placeholder: 'Compose an epic...',
                    theme: 'snow',
                    readOnly: false,
                    bounds: document.body,
                    scrollingContainer: null,
                    history: {
                        delay: 1000,
                        maxStack: 100,
                        userOnly: true
                    },
                    syntax: true
                };

                var quill = new Quill('#editor', options);

                // Update form submission
                document.getElementById('NewsForm').onsubmit = function (event) {
                    event.preventDefault();

                    var content = quill.root.innerHTML;
                    document.getElementById('content').value = content;

                    if (content.trim() === "<p><br></p>") {
                        alert("Content cannot be empty.");
                        return;
                    }

                    this.submit();
                };
            });

        </script>


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
        <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>

</body>

</html>