<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['admin_id'])) {
    $_SESSION['error'] = "You must log in first.";
    header("Location: index.php");
    exit;
}

// Fetch total counts
$total_news = R::count('blog');
$total_applications = R::count('application');
$total_pending_applications = R::count('application', 'status = ?', [0]); // Assuming 0 is pending status
$total_paid_applications = R::count('application', 'status = ?', [1]); // Assuming 1 is paid status
$total_gallery = R::count('gallery', 'type = ? AND status = ?', [1, 1]);

// Calculate total revenue
$total_revenue = R::getCell('SELECT SUM(amount) FROM application WHERE status = ?', [1]);
$total_revenue = $total_revenue ? $total_revenue : 0;

// Fetch latest applications (limit to 5)
$latest_applications = R::findAll('application', 'ORDER BY date DESC LIMIT 5');

// Fetch latest news/events (limit to 5)
$latest_news = R::findAll('blog', 'ORDER BY date DESC LIMIT 5');

// Get monthly revenue data for the chart (last 12 months)
$monthly_revenue = [];
for ($i = 11; $i >= 0; $i--) {
    $start_date = date('Y-m-01', strtotime("-$i months"));
    $end_date = date('Y-m-t', strtotime("-$i months"));
    
    $revenue = R::getCell('SELECT COALESCE(SUM(amount), 0) 
                          FROM application 
                          WHERE status = ? 
                          AND date BETWEEN ? AND ?', 
                          [1, $start_date, $end_date]);
    
    $monthly_revenue[] = floatval($revenue);
}

?>

<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">

<head>  
    <meta charset="utf-8" />
    <title>Admin Dashboard | Henson Demonstration Schools</title>
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

        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>

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
                                <h4 class="mb-sm-0">Dashboard</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item">
                                            <a href="javascript: void(0);">Henson Demonstration Schools</a>
                                        </li>
                                        <li class="breadcrumb-item active">
                                            Dashboard
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row project-wrapper">
                        <div class="col-xxl-8">
                            <div class="row">
                                <div class="col-xl-4">
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span
                                                        class="avatar-title bg-primary-subtle text-primary rounded-2 fs-2">
                                                        <i data-feather="briefcase" class="text-primary"></i>
                                                    </span>
                                                </div>
                                                <div class="flex-grow-1 overflow-hidden ms-3">
                                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-3">
                                                        News and Events
                                                    </p>
                                                    <div class="d-flex align-items-center mb-3">
                                                        <h4 class="fs-4 flex-grow-1 mb-0">
                                                            <span class="counter-value"
                                                                data-target="<?= $total_news ?>">0</span>
                                                        </h4>
                                                        <!-- <span class="badge bg-danger-subtle text-danger fs-12"><i
                                                        class="ri-arrow-down-s-line fs-13 align-middle me-1"></i>5.02
                                                    %</span> -->
                                                    </div>
                                                    <p class="text-muted text-truncate mb-0">
                                                        Total News and Events
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end card body -->
                                    </div>
                                </div>
                                <!-- end col -->

                                <div class="col-xl-4">
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span
                                                        class="avatar-title bg-warning-subtle text-warning rounded-2 fs-2">
                                                        <i data-feather="award" class="text-warning"></i>
                                                    </span>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <p class="text-uppercase fw-medium text-muted mb-3">
                                                        Applications
                                                    </p>
                                                    <div class="d-flex align-items-center mb-3">
                                                        <h4 class="fs-4 flex-grow-1 mb-0">
                                                            <span class="counter-value"
                                                                data-target="<?= $total_applications ?>">0</span>
                                                        </h4>
                                                    </div>
                                                    <p class="text-muted mb-0">
                                                        Total Applications
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end card body -->
                                    </div>
                                </div>
                                <!-- end col -->

                                <div class="col-xl-4">
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-info-subtle text-info rounded-2 fs-2">
                                                        <i data-feather="image" class="text-info"></i>
                                                    </span>
                                                </div>
                                                <div class="flex-grow-1 overflow-hidden ms-3">
                                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-3">
                                                        Gallery
                                                    </p>
                                                    <div class="d-flex align-items-center mb-3">
                                                        <h4 class="fs-4 flex-grow-1 mb-0">
                                                            <span class="counter-value" data-target="<?= $total_gallery ?>">0</span>
                                                        </h4>
                                                    </div>
                                                    <p class="text-muted text-truncate mb-0">
                                                        Total Gallery Images
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end card body -->
                                    </div>
                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end row -->

                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="card">
                                        <div class="card-header border-0 align-items-center d-flex">
                                            <h4 class="card-title mb-0 flex-grow-1">
                                                Payment Overview
                                            </h4>
                                        </div>
                                        <!-- end card header -->

                                        <div class="card-header p-0 border-0 bg-light-subtle">
                                            <div class="row g-0 text-center">
                                                <div class="col-6 col-sm-3">
                                                    <div class="p-3 border border-dashed border-start-0">
                                                        <h5 class="mb-1">
                                                            <span class="counter-value"
                                                                data-target="<?= $total_applications ?>">0</span>
                                                        </h5>
                                                        <p class="text-muted mb-0">
                                                            Total Applications
                                                        </p>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-6 col-sm-3">
                                                    <div class="p-3 border border-dashed border-start-0">
                                                        <h5 class="mb-1">
                                                            <span class="counter-value"
                                                                data-target="<?= $total_pending_applications ?>">0</span>
                                                        </h5>
                                                        <p class="text-muted mb-0">
                                                            Pending Applications
                                                        </p>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <!--end col-->
                                                <div class="col-6 col-sm-3">
                                                    <div class="p-3 border border-dashed border-start-0">
                                                        <h5 class="mb-1">
                                                            <span class="counter-value"
                                                                data-target="<?= $total_paid_applications ?>">0</span>
                                                        </h5>
                                                        <p class="text-muted mb-0">
                                                            Paid Applications
                                                        </p>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-6 col-sm-3">
                                                    <div class="p-3 border border-dashed border-start-0">
                                                        <h5 class="mb-1">₦
                                                            <span class="counter-value"
                                                                data-target="<?= $total_revenue ?>">0</span>
                                                        </h5>
                                                        <p class="text-muted mb-0">
                                                            Total Revenue
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end card header -->
                                        <div class="card-body p-0 pb-2">
                                            <div>
                                                <div id="projects-overview-chart"
                                                    data-colors='["--vz-primary", "--vz-warning", "--vz-success"]'
                                                    data-revenue='<?= json_encode($monthly_revenue) ?>'
                                                    dir="ltr" class="apex-charts"></div>
                                            </div>
                                        </div>
                                        <!-- end card body -->
                                    </div>
                                    <!-- end card -->
                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end row -->
                        </div>
                        <!-- end col -->

                        <div class="col-xxl-4">
                            <div class="card">
                                <div class="card-header border-0">
                                    <h4 class="card-title mb-0">Latest Applications</h4>
                                </div>
                                <div class="card-body pt-0">
                                    <h6 class="text-uppercase fw-semibold mt-4 mb-3 text-muted">Recent Applications:</h6>
                                    <?php foreach ($latest_applications as $application): ?>
                                        <div class="mini-stats-wid d-flex align-items-center mt-3">
                                            <div class="flex-shrink-0 avatar-sm">
                                                <span
                                                    class="mini-stat-icon avatar-title rounded-circle text-success bg-success-subtle fs-4">
                                                    <i class="ri-file-text-fill"></i>
                                                </span>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-1"><?= htmlspecialchars($application->first_name . ' ' . $application->last_name) ?></h6>
                                                <p class="text-muted mb-0"><?= date('M d, Y', strtotime($application->date)) ?></p>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <p class="text-muted mb-0"><?= $application->status ? 'Paid' : 'Pending' ?></p>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header border-0">
                                    <h4 class="card-title mb-0">Latest News and Events</h4>
                                </div>
                                <div class="card-body pt-0">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">SN</th>
                                                <th scope="col">Title</th>
                                                <th scope="col">Author</th>
                                                <th scope="col">Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $sn = 1; foreach ($latest_news as $news): ?>
                                                <tr>
                                                    <th scope="row"><?= $sn++ ?></th>
                                                    <td><?= htmlspecialchars($news->title) ?></td>
                                                    <td><?= htmlspecialchars($news->author) ?></td>
                                                    <td><?= date('M d, Y', strtotime($news->date)) ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                    <div class="mt-3 text-center">
                                        <a href="blog.php" class="text-muted text-decoration-underline">View More...</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
        </div>
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