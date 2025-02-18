<!DOCTYPE html>
<html lang="en">

<head>
    <!-- meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | Henson Demonstration Schools</title>
    <meta name="description" content="Reach out to Henson Demonstration Schools for inquiries, support, or enrollment details. We're here to assist you.">
    <meta name="keywords" content="Contact Henson Demonstration Schools, inquiries, support, enrollment details, school contact information">
    <meta name="author" content="Henson Demonstration Schools">
    <meta name="robots" content="index, follow">
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="Contact Us | Henson Demonstration Schools">
    <meta property="og:description" content="Have questions? Contact Henson Demonstration Schools today. We're here to provide assistance with all your inquiries.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://www.hensonschools.com/contact.php">
    <meta property="og:image" content="https://www.hensonschools.com/assets/img/contact.jpg">
    <meta property="og:site_name" content="Henson Demonstration Schools">
    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Contact Us | Henson Demonstration Schools">
    <meta name="twitter:description" content="Need help or have questions? Contact Henson Demonstration Schools. We're here to assist you.">
    <meta name="twitter:image" content="https://www.hensonschools.com/assets/img/contact.jpg">

    <!-- favicon -->
    <link rel="icon" type="image/x-icon" href="assets/img/smsPics/logo.png">

    <!-- css -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/all-fontawesome.min.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>


    <!-- header area -->
    <?php include 'includes/header.php'; ?>
    <!-- header area end -->

    <main class="main">

        <!-- breadcrumb -->
        <div class="site-breadcrumb" style="background: url(assets/img/slider/slider-1.jpg)">
            <div class="container">
                <h2 class="breadcrumb-title">Contact Us</h2>
                <ul class="breadcrumb-menu">
                    <li><a href="index.html">Home</a></li>
                    <li class="active">Contact Us</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->


        <!-- contact area -->
        <div class="contact-area py-120">
            <div class="container">
                <div class="contact-content">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="contact-info">
                                <div class="contact-info-icon">
                                    <i class="fal fa-map-location-dot"></i>
                                </div>
                                <div class="contact-info-content">
                                    <h5>School Address</h5>
                                    <p>Osasere Osayogie Street, Off km 11 Benin-Lagos Expressway, Idunmwonwina, Benin
                                        City, Edo State.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="contact-info">
                                <div class="contact-info-icon">
                                    <i class="fal fa-phone-volume"></i>
                                </div>
                                <div class="contact-info-content">
                                    <h5>Call Us</h5>
                                    <p>+234 816 211 8764</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="contact-info">
                                <div class="contact-info-icon">
                                    <i class="fal fa-envelopes"></i>
                                </div>
                                <div class="contact-info-content">
                                    <h5>Email Us</h5>
                                    <p><a href="mailto:hello@hensonschools.com">hello@hensonschools.com</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="contact-info">
                                <div class="contact-info-icon">
                                    <i class="fal fa-alarm-clock"></i>
                                </div>
                                <div class="contact-info-content">
                                    <h5>Open Time</h5>
                                    <p>Mon - Fri</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="contact-wrapper">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="contact-img">
                                <img src="assets/img/about/01.jpg" alt="">
                            </div>
                        </div>
                        <div class="col-lg-7 align-self-center">
                            <div class="contact-form">
                                <?php
                                if (isset($_SESSION['success'])) {
                                    echo '<div class="alert alert-success">' . $_SESSION['success'] . '</div>';
                                    unset($_SESSION['success']);
                                }
                                if (isset($_SESSION['error'])) {
                                    echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
                                    unset($_SESSION['error']);
                                }
                                ?>
                                <div class="contact-form-header">
                                    <h2>Get In Touch</h2>
                                    <p>At Henson Demonstration Schools, we believe every child deserves the
                                        best education possible. Discover how we can help your child reach their full
                                        potential. </p>
                                </div>
                                <form method="post" action="handlers/contact_handler.php">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="name"
                                                    placeholder="Your Name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="email" class="form-control" name="email"
                                                    placeholder="Your Email" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="subject"
                                            placeholder="Your Subject" required>
                                    </div>
                                    <div class="form-group">
                                        <textarea name="message" cols="30" rows="5" class="form-control"
                                            placeholder="Write Your Message" required></textarea>
                                    </div>
                                    <button type="submit" name="submit_contact" class="theme-btn">Send
                                        Message <i class="far fa-paper-plane"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end contact area -->

        <!-- map -->
        <div class="contact-map">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3964.738991359703!2d5.601145276510433!3d6.427569493563462!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x10472dac5cf87751%3A0x3eef1bcba8d41e6a!2sOsasere%20Osayogie%20St%2C%20Uselu%2C%20Benin%20City%20302117%2C%20Edo!5e0!3m2!1sen!2sng!4v1739634523367!5m2!1sen!2sng"
                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
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
    <script src="assets/js/contact-form.js"></script>
    <script src="assets/js/main.js"></script>

</body>

</html>