<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['admin_id'])) {
    $_SESSION['error'] = "You must log in first.";
    header("Location: index.php");
    exit;
}

// Fetch admin details (assuming email is stored in session during login)
$admin_email = isset($_SESSION['email']) ? $_SESSION['email'] : 'N/A';
$admin_id = $_SESSION['admin_id'];


// Handle potential messages from the password update handler
$success_message = isset($_SESSION['success']) ? $_SESSION['success'] : '';
$error_message = isset($_SESSION['error']) ? $_SESSION['error'] : '';
unset($_SESSION['success']); // Clear message after displaying
unset($_SESSION['error']);   // Clear message after displaying

?>

<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">

<head>

    <meta charset="utf-8" />
    <title>Admin Profile | Adesotu International College</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Admin Profile Page" name="description" />
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
    <!-- Sweet Alert -->
    <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />


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
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">Profile Settings</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Profile</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->


                    <div class="row">
                        <div class="col-xxl-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Admin Details & Password Change</h5>
                                </div>
                                <div class="card-body p-4">
                                    <!-- Display Messages -->
                                    <?php if ($success_message): ?>
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <?php echo $success_message; ?>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($error_message): ?>
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <?php echo $error_message; ?>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    <?php endif; ?>

                                    <div class="row">
                                        <!-- Basic Details Column -->
                                        <div class="col-lg-6 border-end">
                                            <h5 class="mb-3">Basic Information</h5>
                                            <div class="mb-3">
                                                <label for="emailInput" class="form-label">Email Address</label>
                                                <input type="email" class="form-control" id="emailInput"
                                                    value="<?php echo htmlspecialchars($admin_email); ?>" readonly>
                                            </div>
                                            <!-- Add other basic details if needed -->
                                        </div>

                                        <!-- Change Password Column -->
                                        <div class="col-lg-6">
                                            <h5 class="mb-3">Change Password</h5>
                                            <form action="handlers/update_password.php" method="POST"
                                                id="changePasswordForm">
                                                <input type="hidden" name="admin_id"
                                                    value="<?php echo htmlspecialchars($admin_id); ?>">
                                                <!-- Include admin_id -->
                                                <div class="mb-3">
                                                    <label for="oldpasswordInput" class="form-label">Old
                                                        Password*</label>
                                                    <input type="password" class="form-control" name="old_password"
                                                        id="oldpasswordInput" placeholder="Enter current password"
                                                        required>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="newpasswordInput" class="form-label">New
                                                        Password*</label>
                                                    <input type="password" class="form-control" name="new_password"
                                                        id="newpasswordInput" placeholder="Enter new password" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="confirmpasswordInput" class="form-label">Confirm
                                                        Password*</label>
                                                    <input type="password" class="form-control" name="confirm_password"
                                                        id="confirmpasswordInput" placeholder="Confirm new password"
                                                        required>
                                                </div>

                                                <div class="text-end">
                                                    <button type="submit" class="btn btn-success">Change
                                                        Password</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->

                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            <?php include 'includes/footer.php'; ?>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- JAVASCRIPT -->
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="assets/js/plugins.js"></script>
    <!-- Sweet Alerts js -->
    <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>
    <!-- Password validation -->
    <script>
        // Simple client-side validation for matching passwords
        const passwordForm = document.getElementById('changePasswordForm');
        const newPassword = document.getElementById('newpasswordInput');
        const confirmPassword = document.getElementById('confirmpasswordInput');
        const successMessage = <?php echo json_encode($success_message); ?>;
        const errorMessage = <?php echo json_encode($error_message); ?>;

        passwordForm.addEventListener('submit', function (event) {
            if (newPassword.value !== confirmPassword.value) {
                event.preventDefault(); // Stop form submission
                Swal.fire({
                    title: 'Error!',
                    text: 'New passwords do not match.',
                    icon: 'error',
                    confirmButtonClass: 'btn btn-primary w-xs mt-2',
                    buttonsStyling: false,
                });
            }
            // Add minimum length check if desired
            else if (newPassword.value.length < 6) { // Example: Minimum 6 characters
                event.preventDefault(); // Stop form submission
                Swal.fire({
                    title: 'Error!',
                    text: 'New password must be at least 6 characters long.',
                    icon: 'error',
                    confirmButtonClass: 'btn btn-primary w-xs mt-2',
                    buttonsStyling: false,
                });
            }
        });

        // Display SweetAlert messages based on session variables passed from PHP
        // Note: These session vars are cleared in PHP after being read once.
        // We check them here in JS *before* they might be cleared by a page reload
        // if the form submission itself caused the reload.
        document.addEventListener('DOMContentLoaded', (event) => {
            if (successMessage) {
                Swal.fire({
                    title: 'Success!',
                    text: successMessage,
                    icon: 'success',
                    confirmButtonClass: 'btn btn-primary w-xs mt-2',
                    buttonsStyling: false,
                });
            } else if (errorMessage) {
                Swal.fire({
                    title: 'Error!',
                    text: errorMessage,
                    icon: 'error',
                    confirmButtonClass: 'btn btn-primary w-xs mt-2',
                    buttonsStyling: false,
                });
            }
        });

    </script>


    <!-- App js -->
    <script src="assets/js/app.js"></script>
</body>

</html>