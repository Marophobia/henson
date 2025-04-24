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
$items_per_page = 10;

// Calculate the offset for the SQL query
$offset = ($current_page - 1) * $items_per_page;

// Get total number of applications
$total_items = R::count('application');
$total_pages = ceil($total_items / $items_per_page);

// Ensure current page is within valid range
if ($current_page < 1) {
    $current_page = 1;
} elseif ($current_page > $total_pages && $total_pages > 0) {
    $current_page = $total_pages;
}

// Fetch applications for current page with pagination
$applications = R::findAll('application', 'ORDER BY date DESC LIMIT ? OFFSET ?', [$items_per_page, $offset]);

// Handle status update
if (isset($_GET['action']) && isset($_GET['id'])) {
    $application_id = (int)$_GET['id'];
    $application = R::load('application', $application_id);
    
    if ($application->id) {
        if ($_GET['action'] === 'confirm') {
            $application->status = 1;
            $_SESSION['success'] = "Application confirmed successfully!";
        } elseif ($_GET['action'] === 'pending') {
            $application->status = 0;
            $_SESSION['success'] = "Application marked as pending!";
        }
        R::store($application);
    }
    
    header("Location: applications.php");
    exit;
}

?>

<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">

<head>

    <meta charset="utf-8" />
    <title>Applications | Adesotu International College</title>
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
                                <h4 class="mb-sm-0">Applications</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a>
                                        </li>
                                        <li class="breadcrumb-item active">Applications</li>
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

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="mb-3 d-flex justify-content-between">
                                        <button id="exportCSV" class="btn btn-primary">Export to CSV</button>
                                    </div>
                                    
                                    <?php if ($applications): ?>
                                        <div class="table-responsive">
                                            <table class="table table-striped align-middle table-nowrap mb-0">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">S/N</th>
                                                        <th scope="col">Name</th>
                                                        <th scope="col">Email</th>
                                                        <th scope="col">Phone</th>
                                                        <th scope="col">Gender</th>
                                                        <th scope="col">Country</th>
                                                        <th scope="col">State</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Date</th>
                                                        <th scope="col">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                    $sn = $offset + 1;
                                                    foreach ($applications as $application): 
                                                        $fullName = $application->first_name . ' ' . $application->last_name;
                                                        if ($application->other_names) {
                                                            $fullName .= ' ' . $application->other_names;
                                                        }
                                                    ?>
                                                        <tr>
                                                            <td><?= $sn++; ?></td>
                                                            <td><?= htmlspecialchars($fullName) ?></td>
                                                            <td><?= htmlspecialchars($application->email) ?></td>
                                                            <td><?= htmlspecialchars($application->phone) ?></td>
                                                            <td><?= htmlspecialchars($application->gender) ?></td>
                                                            <td><?= htmlspecialchars($application->country) ?></td>
                                                            <td><?= htmlspecialchars($application->state) ?></td>
                                                            <td>
                                                                <?php if ($application->status == 1): ?>
                                                                    <span class="badge bg-success">Confirmed</span>
                                                                <?php else: ?>
                                                                    <span class="badge bg-warning">Pending</span>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td><?= date('M d, Y', strtotime($application->date)) ?></td>
                                                            <td>
                                                                <div class="d-flex gap-2">
                                                                    <?php if ($application->status == 0): ?>
                                                                        <a href="applications.php?action=confirm&id=<?= $application->id ?>"
                                                                           class="btn btn-sm btn-success">Confirm</a>
                                                                    <?php else: ?>
                                                                        <a href="applications.php?action=pending&id=<?= $application->id ?>"
                                                                           class="btn btn-sm btn-warning">Mark Pending</a>
                                                                    <?php endif; ?>
                                                                    <a href="handlers/application_delete.php?id=<?= $application->id ?>"
                                                                       class="btn btn-sm btn-danger"
                                                                       onclick="return confirm('Are you sure you want to delete this application?')">
                                                                        Delete
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>

                                        <!-- Pagination -->
                                        <div class="row mt-4">
                                            <div class="col-lg-12">
                                                <div class="pagination-area">
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
                                    <?php else: ?>
                                        <p>No applications found.</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
        </div>
        <!-- end main content-->


        <script>
            document.getElementById("exportCSV").addEventListener("click", async function () {
                try {
                    const response = await fetch("handlers/export_applications.php");
                    
                    if (!response.ok) {
                        throw new Error("Failed to fetch applications data");
                    }

                    const blob = await response.blob();
                    const url = window.URL.createObjectURL(blob);
                    const a = document.createElement('a');
                    a.href = url;
                    a.download = 'applications.csv';
                    document.body.appendChild(a);
                    a.click();
                    window.URL.revokeObjectURL(url);
                    document.body.removeChild(a);
                } catch (error) {
                    console.error("Error exporting CSV:", error);
                    alert("An error occurred while exporting the CSV file.");
                }
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
</body>

</html>