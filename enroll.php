<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">



<head>
    <!-- meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enroll | Henson Demonstration Schools</title>
    <meta name="description" content="Enroll at Henson Demonstration Schools to experience top-notch education and holistic development. Join our community today.">
    <meta name="keywords" content="Enroll at Henson Demonstration Schools, student enrollment, academic excellence, holistic development">
    <meta name="author" content="Henson Demonstration Schools">
    <meta name="robots" content="index, follow">
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="Enroll | Henson Demonstration Schools">
    <meta property="og:description" content="Discover the mission and values of Henson Demonstration Schools. Learn why we're a top choice for holistic education.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://www.hensonschools.com/enroll.php">
    <meta property="og:image" content="https://www.hensonschools.com/assets/img/enroll.jpg">
    <meta property="og:site_name" content="Henson Demonstration Schools">
    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Enroll | Henson Demonstration Schools">
    <meta name="twitter:description" content="Join Henson Demonstration Schools for outstanding education, innovative teaching methods, and student-centered learning.">
    <meta name="twitter:image" content="https://www.hensonschools.com/assets/img/enroll.jpg">

    <!-- favicon -->
    <link rel="icon" type="image/x-icon" href="assets/img/logo/favicon.png">

    <!-- css -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/all-fontawesome.min.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <style>
        .image-preview {
            width: 200px;
            height: 200px;
            border: 2px dashed #ccc;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
        }

        .image-preview img {
            max-width: 100%;
            max-height: 100%;
            display: none;
        }
    </style>
</head>

<body>

    <!-- header area -->
    <?php include 'includes/header.php'; ?>
    <!-- header area end -->


    <main class="main">

        <!-- breadcrumb -->
        <div class="site-breadcrumb" style="background: url(assets/img/slider/slider-1.jpg)">
            <div class="container">
                <h2 class="breadcrumb-title">Application Form</h2>
                <ul class="breadcrumb-menu">
                    <li><a href="index.html">Home</a></li>
                    <li class="active">Application Form</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->


        <!-- application -->
        <div class="application py-120">
            <div class="container">
                <div class="application-form">
                    <h3>Application Form</h3>

                    <?php if (isset($_SESSION['success'])): ?>
                        <div class="alert alert-success">
                            <?= $_SESSION['success']; ?>
                            <?php unset($_SESSION['success']); ?>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger">
                            <?= $_SESSION['error']; ?>
                            <?php unset($_SESSION['error']); ?>
                        </div>
                    <?php endif; ?>

                    <form action="handlers/application_handler.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <h5 class="mb-3">Basic Information</h5>

                            <div class="col-lg-12 mb-4">
                                <div class="form-group">
                                    <label>Passport Photograph</label>
                                    <div class="image-preview">
                                        <img id="preview-image" src="#" alt="Preview">
                                    </div>
                                    <input type="file" class="form-control" name="image" id="image-input"
                                        accept=".jpg,.jpeg,.png" required>
                                    <small class="text-muted">Accepted formats: JPG, PNG. Max size: 500KB</small>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" class="form-control" name="first_name" required>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" class="form-control" name="last_name" required>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Other Names</label>
                                    <input type="text" class="form-control" name="other_names">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input type="email" class="form-control" name="email" required>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input type="tel" class="form-control" name="phone" required>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Country</label>
                                    <input type="text" class="form-control" name="country" required>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>State</label>
                                    <input type="text" class="form-control" name="state" required>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Gender</label>
                                    <select class="form-select" name="gender" required>
                                        <option value="">Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Address</label>
                                    <textarea class="form-control" name="address" rows="3" required></textarea>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Date of Birth</label>
                                    <input type="date" class="form-control" name="date_of_birth" required>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <button type="submit" name="submit_application" class="theme-btn">Submit Application<i
                                        class="fas fa-arrow-right-long"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- application end-->
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
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://js.paystack.co/v1/inline.js"></script>
    <script>
        document.getElementById('image-input').onchange = function (evt) {
            const [file] = this.files;
            if (file) {
                // Check file size
                if (file.size > 500000) { // 500KB in bytes
                    alert('File is too large. Maximum size is 500KB');
                    this.value = '';
                    return;
                }

                // Check file type
                if (!file.type.match('image/jpeg') && !file.type.match('image/png')) {
                    alert('Please select a valid image file (JPG or PNG)');
                    this.value = '';
                    return;
                }

                const preview = document.getElementById('preview-image');
                preview.src = URL.createObjectURL(file);
                preview.style.display = 'block';
            }
        };
    </script>

</body>

</html>