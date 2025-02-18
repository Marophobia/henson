<?php
session_start();
require '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        $_SESSION['error'] = "Email and password are required.";
        header("Location: index.php");
        exit;
    }

    $admin = R::findOne('admin', 'email = ?', [$email]);

    if ($admin && password_verify($password, $admin->password)) {
        $_SESSION['admin_id'] = $admin->id;
        $_SESSION['email'] = $admin->email;
        header("Location: dashboard.php");
        exit;
    } else {
        $_SESSION['error'] = "Invalid username or password.";
        header("Location: index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- title -->
    <title>Admin Website Login</title>

    <!-- favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/logo/favicon.png">

    <!-- css -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/all-fontawesome.min.css">
    <link rel="stylesheet" href="../assets/css/animate.min.css">
    <link rel="stylesheet" href="../assets/css/magnific-popup.min.css">
    <link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

    <main class="main">

        <!-- login area -->
        <div class="login-area py-120">
            <div class="container">
                <div class="col-md-5 mx-auto">
                    <div class="login-form">
                        <div class="login-header">
                            <img src="../assets/img/logo/logo.png" alt="" width="100">
                            <p>Admin Portal - Website</p>
                        </div>

                        <?php
                        if (isset($_SESSION['error'])) {
                            echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
                            unset($_SESSION['error']);
                        }
                        ?>

                        <form action="index.php" method="post">
                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="email" class="form-control" name="email" placeholder="Your Email">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Your Password">
                            </div>
                            <div class="d-flex align-items-center">
                                <button type="submit" class="theme-btn"><i class="far fa-sign-in"></i> Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- login area end -->

    </main>

    <!-- footer area -->
    <?php include '../includes/footer.php' ?>
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