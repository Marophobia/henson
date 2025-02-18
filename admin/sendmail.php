<?php
session_start();
require '../config/db.php';
require '../handlers/mail.php';


if (!isset($_SESSION['admin_id'])) {
    $_SESSION['error'] = "You must log in first.";
    header("Location: index.php");
    exit;
}


?>

<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">

<head>

    <meta charset="utf-8" />    
    <title>Send Mail | Henson Demonstration Schools</title>
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
                            <div
                                class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                                <h4 class="mb-sm-0">Send Mail
                                </h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Mail</a></li>
                                        <li class="breadcrumb-item active">Send Mail</li>
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

                    <form action="handlers/mail_handler.php" method="post" id="MailForm">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="recipient-name">Recipient Name</label>
                                                    <input type="text" class="form-control" id="recipient-name"
                                                        placeholder="Enter recipient's name" name="recipient_name" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="recipient-email">Recipient Email</label>
                                                    <input type="email" class="form-control" id="recipient-email"
                                                        placeholder="Enter recipient's email" name="recipient_email" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <label class="form-label" for="subject">Email Subject</label>
                                                    <input type="text" class="form-control" id="subject"
                                                        placeholder="Enter Mail Subject" name="subject" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Email Content</label>
                                            <div id="editor"></div>
                                        </div>

                                        <input type="hidden" name="content" id="content">

                                        <div class="text-end my-4">
                                            <button type="submit" class="btn btn-success w-sm">Send Mail</button>
                                        </div>
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->
                    </form>

                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
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

                // Ensure form submission captures Quill content
                document.getElementById('MailForm').onsubmit = function (event) {
                    event.preventDefault();

                    // Get form fields
                    var recipientName = document.getElementById('recipient-name').value.trim();
                    var recipientEmail = document.getElementById('recipient-email').value.trim();
                    var subject = document.getElementById('subject').value.trim();
                    var content = quill.root.innerHTML;

                    // Validate fields
                    if (!recipientName || !recipientEmail || !subject) {
                        alert("Please fill in all required fields.");
                        return;
                    }

                    // Validate email format
                    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailRegex.test(recipientEmail)) {
                        alert("Please enter a valid email address.");
                        return;
                    }

                    // Validate content
                    if (content.trim() === "<p><br></p>") {
                        alert("Email content cannot be empty.");
                        return;
                    }

                    // Set the content to hidden input
                    document.getElementById('content').value = content;

                    // Submit the form
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