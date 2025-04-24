<?php
// Include database connection
include 'config/db.php';

// Fetch the first 3 active blogs along with their associated categories
$blogs = R::findAll('blog', 'WHERE status = 1 ORDER BY id DESC LIMIT 3');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adesotu International College | Academic Academic Excellence and Creativity</title>
    <meta name="description"
        content="Adesotu International College is a private co-educational institution established to complement government effort at providing affordable and qualitative education for children in Nigeria and the world at large.">
    <meta name="keywords"
        content="Adesotu International College, best schools, high school education, enroll students, check results, contact Adesotu International College, academic excellence, holistic education">
    <meta name="author" content="Adesotu International College">
    <meta name="robots" content="index, follow">
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="Adesotu International College | Academic Academic Excellence and Creativity">
    <meta property="og:description"
        content="Experience world-class education at Adesotu International College. Join us for academic success and holistic development.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://www.adesotucollege.com">
    <meta property="og:image" content="https://www.adesotucollege.com/assets/img/slider/slider-3.jpg">
    <meta property="og:site_name" content="Adesotu International College">
    <meta property="og:locale" content="en_US">
    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Adesotu International College | Academic Academic Excellence and Creativity">
    <meta name="twitter:description"
        content="Join Adesotu International College for outstanding education, innovative teaching methods, and student-centered learning.">
    <meta name="twitter:image" content="https://www.adesotucollege.com/assets/img/slider/slider-3.jpg">
    <meta name="twitter:site" content="@Adesotu CollegeSchools">
    <meta name="twitter:creator" content="@Adesotu CollegeSchools">
    <!-- Canonical URL -->
    <link rel="canonical" href="https://www.adesotucollege.com">
    <!-- Organization Schema Markup -->
    <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "EducationalOrganization",
  "name": "Adesotu International College",
  "url": "https://www.adesotucollege.com",
  "logo": "https://www.adesotucollege.com/assets/img/logo/logo.png",
  "contactPoint": {
    "@type": "ContactPoint",
    "telephone": "+2347068352732",
    "contactType": "Customer Service"
  },
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "57, Osayogie street, opposite Nitel Junction off Ugbowo-Lagos road, Idumwowina, Benin City, Edo State",
    "addressLocality": "Benin City",
    "addressRegion": "EDO",
    "postalCode": "62704",
    "addressCountry": "NG"
  },
}
</script>

    <!-- Breadcrumb Schema Markup -->
    <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    {
      "@type": "ListItem",
      "position": 1,
      "name": "Home",
      "item": "https://www.adesotucollege.com/"
    },
    {
      "@type": "ListItem",
      "position": 2,
      "name": "About School",
      "item": "https://www.adesotucollege.com/about.php"
    },
       {
      "@type": "ListItem",
      "position": 3,
      "name": "News & Events",
      "item": "https://www.adesotucollege.com/blog.php"
    },
    {
      "@type": "ListItem",
      "position": 4,
      "name": "Check Result",
      "item": "https://app.adesotucollege.com/checkresult"
    },
    {
      "@type": "ListItem",
      "position": 5,
      "name": "Gallery",
      "item": "https://www.adesotucollege.com/gallery.php"
    },
    {
      "@type": "ListItem",
      "position": 6,
      "name": "Contact Us",
      "item": "https://www.adesotucollege.com/contact.php"
    }
  ]
}
    </script>

    <!-- WebSite Schema Markup -->
    <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebSite",
  "name": "Adesotu International College",
  "url": "https://www.adesotucollege.com",
  "potentialAction": {
    "@type": "SearchAction",
    "target": "https://www.adesotucollege.com/search?q={search_term_string}",
    "query-input": "required name=search_term_string"
  }
}
</script>


    <!-- Links for Better Navigation -->
    <link rel="alternate" hreflang="en" href="https://www.adesotucollege.com">
</head>


<!-- favicon -->
<link rel="icon" type="image/x-icon" href="assets/img/logo/logo.png">

<!-- css -->
<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/all-fontawesome.min.css">
<link rel="stylesheet" href="assets/css/animate.min.css">
<link rel="stylesheet" href="assets/css/magnific-popup.min.css">
<link rel="stylesheet" href="assets/css/owl.carousel.min.css">
<link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

    <!-- preloader -->
    <!-- <div class="preloader">
        <div class="loader-book">
            <div class="loader-book-page"></div>
            <div class="loader-book-page"></div>
            <div class="loader-book-page"></div>
        </div>
    </div> -->
    <!-- preloader end -->


    <!-- header area -->
    <?php include 'includes/header.php'; ?>
    <!-- header area end -->

    <main class="main">

        <!-- hero slider -->
        <div class="hero-section">
            <div class="hero-slider owl-carousel owl-theme">
                <div class="hero-single" style="background: url(assets/img/slider/slider-1.jpg)">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-md-12 col-lg-7">
                                <div class="hero-content-box">
                                    <div class="hero-content">
                                        <h4 class="hero-title" data-animation="fadeInRight" data-delay=".50s">
                                            Adesotu International College
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="hero-single" style="background: url(assets/img/slider/slider-2.jpg)">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-md-12 col-lg-7">
                                <div class="hero-content-box">
                                    <div class="hero-content">
                                        <h4 class="hero-title" data-animation="fadeInRight" data-delay=".50s">
                                            Academic Academic Excellence and Creativity
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="hero-single" style="background: url(assets/img/slider/slider-3.jpg)">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-md-12 col-lg-7">
                                <div class="hero-content-box">
                                    <div class="hero-content">
                                        <h4 class="hero-title" data-animation="fadeInRight" data-delay=".50s">
                                           Conducive Environment
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        </div>
        <!-- hero slider end -->



        <!-- feature area -->
        <div class="feature-area fa-negative mt-5">
            <div class="col-xl-9 ms-auto">
                <div class="feature-wrapper">
                    <div class="row g-4">
                        <div class="col-md-6 col-lg-3">
                            <div class="feature-item">
                                <span class="count">01</span>
                                <div class="feature-icon">
                                    <img src="assets/img/icon/global-education.svg" alt="Supportive Learning Space">
                                </div>
                                <div class="feature-content">
                                    <h4 class="feature-title">Academic Framework</h4>
                                    <p>Our institution aligns with the latest guidelines from Nigeria's educational
                                        authorities while incorporating globally recognized teaching methodologies to
                                        ensure high-quality education.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="feature-item">
                                <span class="count">02</span>
                                <div class="feature-icon">
                                    <img src="assets/img/icon/teacher.svg" alt="Proficient Mentors">
                                </div>
                                <div class="feature-content">
                                    <h4 class="feature-title">Skilled Educators</h4>
                                    <p>At Adesotu International College, every subject is taught by accomplished experts
                                        in their respective fields. Our teaching staff is meticulously selected based on
                                        their exceptional qualifications and proven ethical standards.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="feature-item">
                                <span class="count">03</span>
                                <div class="feature-icon">
                                    <img src="assets/img/icon/library.svg" alt="Advanced Resources">
                                </div>
                                <div class="feature-content">
                                    <h4 class="feature-title">Tech Integration</h4>
                                    <p>Adesotu College is widely regarded as a leader in technological advancement.
                                        Technology is seamlessly integrated into all aspects of our operations, and
                                        students are exposed to cutting-edge tools to prepare them for global
                                        competitiveness.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="feature-item">
                                <span class="count">04</span>
                                <div class="feature-icon">
                                    <img src="assets/img/icon/library.svg" alt="Extensive Library">
                                </div>
                                <div class="feature-content">
                                    <h4 class="feature-title">Tranquil Setting</h4>
                                    <p>Adesotu College is nestled in a secure and peaceful environment, spread across a
                                        vast area where both academic and leisure activities are conducted in an optimal
                                        atmosphere.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- feature area end -->

        <!-- about area -->
        <div class="about-area py-120">
            <div class="container">
                <div class="row g-4 align-items-center">
                    <div class="col-lg-6">
                        <div class="about-left wow fadeInLeft" data-wow-delay=".25s">
                            <div class="about-img">
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <img class="img-1" src="assets/img/about/01.png" alt="">
                                        <div class="about-experience mt-4">
                                            <!-- <div class="about-experience-icon">
                                                <img src="assets/img/icon/exchange-idea.svg" alt="">
                                            </div> -->
                                            <b class="text-start">Over 10 Years Of <br> Quality Education</b>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <img class="img-2" src="assets/img/about/02.jpg" alt="">
                                        <!-- <img class="img-3 mt-4" src="assets/img/smsPics/SP27.jpg " alt=""> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="about-right wow fadeInRight" data-wow-delay=".25s">
                            <div class="site-heading mb-3">
                                <span class="site-title-tagline"> About Us</span>
                                <h2 class="site-title">
                                    A Commitment to <span>Academic Excellence</span> and Creativity.
                                </h2>
                            </div>
                            <p class="about-text">
                                Adesotu International College consists of three levels of education: Nursery, Primary,
                                and Secondary. It is a private co-educational institution established to support the
                                government's efforts in delivering accessible and excellent education for children in
                                Nigeria and beyond.
                            </p>
                            <div class="about-content">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="about-item">
                                            <div class="about-item-icon">
                                                <img src="assets/img/icon/open-book.svg"
                                                    alt="Academic Excellence and Creativity Icon">
                                            </div>
                                            <div class="about-item-content">
                                                <h5>Our Mission</h5>
                                                <p>Adesotu International College is dedicated to fostering the holistic
                                                    growth of every child, focusing on intellectual, physical, social,
                                                    and ethical development.</p>
                                            </div>
                                        </div>
                                        <div class="about-item">
                                            <div class="about-item-icon">
                                                <img src="assets/img/icon/online-course.svg"
                                                    alt="Creative Learning Icon">
                                            </div>
                                            <div class="about-item-content">
                                                <h5>Our Vision</h5>
                                                <p>Empowering and nurturing the leaders of tomorrow.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="about-quote">
                                            <p>"We are committed to unlocking the potential within every student. Our
                                                aspiration is to provide each child with a comprehensive, balanced, and
                                                high-quality education."</p>
                                            <i class="far fa-quote-right"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="about-bottom">
                                <a href="about.php" class="theme-btn">Discover More<i
                                        class="fas fa-arrow-right-long"></i></a>
                                <div class="about-phone">
                                    <div class="icon"><i class="fal fa-headset"></i></div>
                                    <div class="number">
                                        <span>Call Now</span>
                                        <h6><a href="tel:+2347068352732">+234 706 835 2732</a></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- about area end -->

        <!-- counter area -->
        <?php include 'includes/counter.php'; ?>
        <!-- counter area end -->

        <!-- team-area -->
        <!-- <?php include 'includes/team.php'; ?> -->
        <!-- team-area end -->

        <!-- blog area -->
        <div class="blog-area py-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mx-auto">
                        <div class="site-heading text-center">
                            <span class="site-title-tagline"> News & Events</span>
                            <h2 class="site-title">Latest News & <span>Events</span></h2>
                            <p>Be updated on the latest happenings in the school.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php foreach ($blogs as $blog): ?>
                        <?php
                        // Fetch the related category using the foreign key 'category'
                        $category = R::load('categories', $blog->category); // Load category based on foreign key
                        // Get comment count for this specific blog post
                        $commentCount = R::count('comments', 'blog_id = ?', [$blog->id]);
                        ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="blog-item wow fadeInUp" data-wow-delay=".25s">
                                <div class="blog-date"><i class="fal fa-calendar-alt"></i>
                                    <?= htmlspecialchars($blog->date); ?></div>
                                <div class="blog-item-img">
                                    <img src="assets/img/blog/<?= htmlspecialchars($blog->image); ?>" alt="Thumb">
                                </div>
                                <div class="blog-item-info">
                                    <div class="blog-item-meta">
                                        <ul>
                                            <li><a href="#"><i class="far fa-user-circle"></i> By
                                                    <?= htmlspecialchars($blog->author); ?></a></li>
                                            <li><a href="#"><i class="far fa-comments"></i> <?= $commentCount; ?>
                                                    Comments</a></li>
                                        </ul>
                                    </div>
                                    <h4 class="blog-title">
                                        <a
                                            href="blog/<?= urlencode($blog->link); ?>"><?= htmlspecialchars($blog->title); ?></a>
                                    </h4>
                                    <a class="theme-btn" href="blog/<?= urlencode($blog->link); ?>">Read More<i
                                            class="fas fa-arrow-right-long"></i></a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <!-- blog area end -->

        <!-- choose-area -->
        <div class="choose-area pt-80 pb-80">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="choose-content wow fadeInUp" data-wow-delay=".25s">
                            <div class="choose-content-info">
                                <div class="site-heading mb-0">
                                    <span class="site-title-tagline text-white"> Why Choose
                                        Us</span>
                                    <h2 class="site-title text-white mb-10">Adesotu International College:
                                        <span>Knowledge for Creativity</span>
                                    </h2>
                                </div>
                                <div class="choose-content-wrap">
                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <div class="choose-item">
                                                <div class="choose-item-icon">
                                                    <img src="assets/img/icon/award.svg" alt="">
                                                </div>
                                                <div class="choose-item-info">
                                                    <h4>Outstanding Academics</h4>
                                                    <p>Adesotu International College is known for producing
                                                        high-achieving students with exceptional academic outcomes.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="choose-item">
                                                <div class="choose-item-icon">
                                                    <img src="assets/img/icon/teacher.svg" alt="">
                                                </div>
                                                <div class="choose-item-info">
                                                    <h4>Committed Leadership</h4>
                                                    <p>Our leadership team, including the Director, Principal, and Vice
                                                        Principal, ensures every student receives excellent education
                                                        and mentorship.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="choose-item">
                                                <div class="choose-item-icon">
                                                    <img src="assets/img/icon/global-education.svg" alt="">
                                                </div>
                                                <div class="choose-item-info">
                                                    <h4>Advanced Infrastructure</h4>
                                                    <p>We provide cutting-edge classrooms, fully equipped laboratories,
                                                        and an ideal learning environment.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="choose-item">
                                                <div class="choose-item-icon">
                                                    <img src="assets/img/icon/acting.svg" alt="">
                                                </div>
                                                <div class="choose-item-info">
                                                    <h4>Well-Rounded Development</h4>
                                                    <p>We focus on nurturing both academic excellence and
                                                        extracurricular skills, equipping students for success in every
                                                        aspect of life.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="choose-img wow fadeInRight" data-wow-delay=".25s">
                            <img src="assets/img/about/8.jpg" alt="Adesotu International College">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- choose-area end -->

        <!-- gallery-area -->
        <div class="gallery-area py-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mx-auto">
                        <div class="site-heading text-center">
                            <span class="site-title-tagline"> Gallery</span>
                            <h2 class="site-title">Our Photo <span>Gallery</span></h2>
                            <p>Experience Life at Adesotu International College through Our Lens</p>
                        </div>
                    </div>
                </div>
                <div class="row popup-gallery">
                    <?php
                    // Fetch first 5 active gallery images
                    $gallery_images = R::find('gallery', 'type = ? AND status = ? ORDER BY id DESC LIMIT 6', [1, 1]);

                    if (count($gallery_images) > 0):
                        foreach ($gallery_images as $image):
                            ?>
                            <div class="col-md-4 wow fadeInUp" data-wow-delay=".25s">
                                <div class="gallery-item">
                                    <div class="gallery-img">
                                        <img src="assets/img/gallery/<?= htmlspecialchars($image->name); ?>"
                                            alt="Gallery Image">
                                    </div>
                                    <div class="gallery-content">
                                        <a class="popup-img gallery-link"
                                            href="assets/img/gallery/<?= htmlspecialchars($image->name); ?>">
                                            <i class="fal fa-plus"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?php
                        endforeach;
                    else:
                        ?>
                        <div class="col-12">
                            <h3 class="text-center">No Gallery Photos Available</h3>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <!-- gallery-area end -->

        <!-- cta-area -->
        <div class="cta-area pt-50 pb-50">
            <div class="container">
                <div class="cta-wrapper">
                    <div class="row align-items-center">
                        <div class="col-lg-5 ms-lg-auto">
                            <div class="cta-content mt-0">
                                <h1>Build Your Tomorrow at Adesotu International College – Join Us Today!</h1>
                                <p>Discover boundless possibilities with a strong educational base at Adesotu
                                    International
                                    College. Become part of a community focused on academic brilliance, spiritual
                                    development,
                                    and overall success.
                                </p>
                                <div class="cta-btn">
                                    <a href="enroll.php" class="theme-btn">Register Now<i
                                            class="fas fa-arrow-right-long"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- cta-area end -->
        <!-- testimonial area -->
        <div class="testimonial-area bg pt-80 pb-80">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mx-auto">
                        <div class="site-heading text-center">
                            <span class="site-title-tagline"> Testimonials</span>
                            <h2 class="site-title">What Our <span>Community</span> Says</h2>
                            <p>Discover what our students and parents have to say about their journey at Adesotu
                                International College.
                                Their testimonials highlight our dedication to quality education.</p>
                        </div>
                    </div>
                </div>
                <?php include 'includes/testimonial.php'; ?>
            </div>
        </div>
        <!-- testimonial area end -->
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var currentPath = window.location.pathname;
            var navLinks = document.querySelectorAll('.navbar-nav .nav-link');
            navLinks.forEach(function (link) {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('active');
                }
            });
        });
    </script>

</body>

</html>