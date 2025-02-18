<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require '../config/db.php';

if (!isset($_SESSION['admin_id'])) {
    $_SESSION['error'] = "You must log in first.";
    header("Location: index.php");
    exit;
}

// Get the blog post ID from URL
$blog_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Fetch the blog post
$blog = R::load('blog', $blog_id);

// If blog post doesn't exist, redirect to news list
if (!$blog->id) {
    $_SESSION['error'] = "News post not found.";
    header("Location: news.php");
    exit;
}

// Fetch all categories
$categories = R::findAll('categories', 'ORDER BY id ASC');
?>

<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">

<head>
    <meta charset="utf-8" />
    <title>Edit News and Events | HGBSS</title>
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

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                                <h4 class="mb-sm-0">Edit News and Events</h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">News And Events</a></li>
                                        <li class="breadcrumb-item active">Edit</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <?php if (isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger"><?= $_SESSION['error'] ?></div>
                        <?php unset($_SESSION['error']); ?>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['success'])): ?>
                        <div class="alert alert-success"><?= $_SESSION['success'] ?></div>
                        <?php unset($_SESSION['success']); ?>
                    <?php endif; ?>

                    <form method="post" action="handlers/news_edit.php" enctype="multipart/form-data" id="NewsForm">
                        <input type="hidden" name="id" value="<?= $blog->id ?>">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label" for="news-title-input">News Title</label>
                                            <input type="text" name="title" class="form-control" id="news-title-input" 
                                                value="<?= htmlspecialchars($blog->title) ?>" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Current Image</label>
                                            <div class="mb-2">
                                                <img src="../assets/img/blog/<?= htmlspecialchars($blog->image) ?>" 
                                                    alt="Current Image" style="max-width: 200px;">
                                            </div>
                                            <label class="form-label" for="news-thumbnail-img">Change Image (optional)</label>
                                            <input class="form-control" name="image" id="news-thumbnail-img" 
                                                type="file" accept="image/png, image/gif, image/jpeg">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Summary</label>
                                            <input type="text" name="summary" class="form-control" 
                                                value="<?= htmlspecialchars($blog->summary) ?>" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Content</label>
                                            <div id="editor">
                                                <?= $blog->content ?>
                                            </div>
                                        </div>
                                        <input type="hidden" name="content" id="content">

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3 mb-lg-0">
                                                    <label for="author-input" class="form-label">Author</label>
                                                    <input type="text" name="author" class="form-control" id="author-input" 
                                                        value="<?= htmlspecialchars($blog->author) ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3 mb-lg-0">
                                                    <label for="category-input" class="form-label">Category</label>
                                                    <select class="form-select" name="category" data-choices 
                                                        data-choices-search-false id="category-input" required>
                                                        <?php foreach ($categories as $category): ?>
                                                            <option value="<?= $category->id ?>" 
                                                                <?= ($category->id == $blog->category) ? 'selected' : '' ?>>
                                                                <?= htmlspecialchars($category->name) ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Publishing Options</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="link" class="form-label">Unique URL Slug</label>
                                            <input type="text" name="link" class="form-control" id="link" 
                                                value="<?= htmlspecialchars($blog->link) ?>" required>
                                            <small class="text-muted">This will be used in the URL. Use only letters, numbers, and hyphens.</small>
                                        </div>
                                        <div class="mb-3">
                                            <label for="tags" class="form-label">Tags</label>
                                            <input type="text" name="tags" class="form-control" id="tags" 
                                                value="<?= htmlspecialchars($blog->tags) ?>" 
                                                placeholder="Enter tags separated by commas">
                                            <small class="text-muted">Optional: Add tags separated by commas</small>
                                        </div>
                                        <div class="mb-3">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="status" value="1" 
                                                    id="publishSwitch" <?= $blog->status ? 'checked' : '' ?>>
                                                <label class="form-check-label" for="publishSwitch">Published</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-end mb-4">
                                    <button type="submit" class="btn btn-success w-sm">Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php include 'includes/footer.php' ?>
    </div>

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
                theme: 'snow',
                readOnly: false,
                bounds: document.body,
                scrollingContainer: null
            };

            var quill = new Quill('#editor', options);

            document.getElementById('NewsForm').onsubmit = function (event) {
                event.preventDefault();
                document.getElementById('content').value = quill.root.innerHTML;
                
                if (quill.root.innerHTML.trim() === "<p><br></p>") {
                    alert("Content cannot be empty.");
                    return;
                }

                this.submit();
            };
        });
    </script>

    <!-- JAVASCRIPT -->
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/libs/apexcharts/apexcharts.min.js"></script>
    <script src="assets/js/pages/dashboard-projects.init.js"></script>
    <script src="assets/js/app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
</body>
</html> 