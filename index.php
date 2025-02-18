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
    <title>Henson Demonstration Schools | Excellence in Education</title>
    <meta name="description" content="Henson Demonstration Schools is a premier educational institution dedicated to academic excellence, holistic development, and nurturing future leaders. Enroll today for a brighter future.">
    <meta name="keywords" content="Henson Demonstration Schools, best schools, high school education, enroll students, check results, contact Henson Demonstration Schools, academic excellence, holistic education">
    <meta name="author" content="Henson Demonstration Schools">
    <meta name="robots" content="index, follow">
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="Henson Demonstration Schools | Excellence in Education">
    <meta property="og:description" content="Experience world-class education at Henson Demonstration Schools. Join us for academic success and holistic development.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://www.hensonschools.com">
    <meta property="og:image" content="https://www.hensonschools.com/assets/img/snip.jpg">
    <meta property="og:site_name" content="Henson Demonstration Schools">
    <meta property="og:locale" content="en_US">
    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Henson Demonstration Schools | Excellence in Education">
    <meta name="twitter:description" content="Join Henson Demonstration Schools for outstanding education, innovative teaching methods, and student-centered learning.">
    <meta name="twitter:image" content="https://www.hensonschools.com/assets/img/snip.jpg">
    <meta name="twitter:site" content="@BranoHighSchool">
    <meta name="twitter:creator" content="@BranoHighSchool">
    <!-- Canonical URL -->
    <link rel="canonical" href="https://www.hensonschools.com">

    <!-- Favicon -->
    <link rel="icon" href="https://www.hensonschools.com/favicon.ico" type="image/x-icon">
    <!-- Organization Schema Markup -->
    <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "EducationalOrganization",
  "name": "Henson Demonstration Schools",
  "url": "https://www.hensonschools.com",
  "logo": "https://www.hensonschools.com/assets/img/logo/logo.png",
  "contactPoint": {
    "@type": "ContactPoint",
    "telephone": "+2348162118764",
    "contactType": "Customer Service"
  },
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "52, Akhionbare Street, G.R.A. Benin City, Edo State.",
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
      "item": "https://www.hensonschools.com/"
    },
    {
      "@type": "ListItem",
      "position": 2,
      "name": "About School",
      "item": "https://www.hensonschools.com/about.php"
    },
       {
      "@type": "ListItem",
      "position": 3,
      "name": "News & Events",
      "item": "https://www.hensonschools.com/blog.php"
    },
    {
      "@type": "ListItem",
      "position": 4,
      "name": "Check Result",
      "item": "https://app.hensonschools.com/checkresult"
    },
    {
      "@type": "ListItem",
      "position": 5,
      "name": "Gallery",
      "item": "https://www.hensonschools.com/gallery.php"
    },
    {
      "@type": "ListItem",
      "position": 6,
      "name": "Contact Us",
      "item": "https://www.hensonschools.com/contact.php"
    }
  ]
}
    </script>

    <!-- WebSite Schema Markup -->
    <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebSite",
  "name": "Henson Demonstration Schools",
  "url": "https://www.hensonschools.com",
  "potentialAction": {
    "@type": "SearchAction",
    "target": "https://www.hensonschools.com/search?q={search_term_string}",
    "query-input": "required name=search_term_string"
  }
}
</script>


    <!-- Links for Better Navigation -->
    <link rel="alternate" hreflang="en" href="https://www.hensonschools.com">
</head>


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
                                <div class="hero-content">
                                    <h6 class="hero-sub-title" data-animation="fadeInDown" data-delay=".25s">
                                        Henson
                                    </h6>
                                    <h1 class="hero-title" data-animation="fadeInRight" data-delay=".50s">
                                        Welcome to Henson Demonstration Schools
                                    </h1>
                                    <p data-animation="fadeInLeft" data-delay=".75s">
                                        Henson Demonstration Schools comprises of a Montessori, Kindergarten, Primary
                                        and Secondary school;
                                        Established to meet the needs of children in Nigeria in particular and the world
                                        at large.
                                    </p>
                                    <div class="hero-btn" data-animation="fadeInUp" data-delay="1s">
                                        <a href="about.php" class="theme-btn">Learn More<i
                                                class="fas fa-arrow-right-long"></i></a>
                                        <a href="contact.php" class="theme-btn theme-btn2">Get in Touch<i
                                                class="fas fa-arrow-right-long"></i></a>
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
                                <div class="hero-content">
                                    <h6 class="hero-sub-title" data-animation="fadeInDown" data-delay=".25s">
                                        Henson
                                    </h6>
                                    <h1 class="hero-title" data-animation="fadeInRight" data-delay=".50s">
                                        Knowledge and Discipline
                                    </h1>
                                    <p data-animation="fadeInLeft" data-delay=".75s">
                                        Henson Demonstration Schools is located in a secured and serene environment with
                                        a very large expanse of
                                        land where educational and recreational activities are carried out condusively
                                    </p>
                                    <div class="hero-btn" data-animation="fadeInUp" data-delay="1s">
                                        <a href="about.php" class="theme-btn">Discover More<i
                                                class="fas fa-arrow-right-long"></i></a>
                                        <a href="contact.php" class="theme-btn theme-btn2">Contact Us<i
                                                class="fas fa-arrow-right-long"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="hero-single" style="background: url(assets/img/about/7.jpg)">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-md-12 col-lg-7">
                                <div class="hero-content">
                                    <h6 class="hero-sub-title" data-animation="fadeInDown" data-delay=".25s">
                                        Henson Demonstration Schools
                                    </h6>
                                    <h1 class="hero-title" data-animation="fadeInRight" data-delay=".50s">
                                        Experience <span>Excellence</span> in Education
                                    </h1>
                                    <p data-animation="fadeInLeft" data-delay=".75s">
                                        Join a community where "Knowledge is Light," and every student is empowered to
                                        shine.
                                    </p>
                                    <div class="hero-btn" data-animation="fadeInUp" data-delay="1s">
                                        <a href="about.php" class="theme-btn">Our Story<i
                                                class="fas fa-arrow-right-long"></i></a>
                                        <a href="contact.php" class="theme-btn theme-btn2">Visit Us<i
                                                class="fas fa-arrow-right-long"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
        <!-- hero slider end -->



        <!-- feature area -->
        <div class="feature-area fa-negative">
            <div class="col-xl-9 ms-auto">
                <div class="feature-wrapper">
                    <div class="row g-4">
                        <div class="col-md-6 col-lg-3">
                            <div class="feature-item">
                                <span class="count">01</span>
                                <div class="feature-icon">
                                    <img src="assets/img/icon/global-education.svg" alt="Conducive Environment">
                                </div>
                                <div class="feature-content">
                                    <h4 class="feature-title">School Curriculum</h4>
                                    <p>We operate based on updated requirements of educational regulatory board of
                                        Nigeria and also apply best international practices in carrying out Educational
                                        activities.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="feature-item">
                                <span class="count">02</span>
                                <div class="feature-icon">
                                    <img src="assets/img/icon/teacher.svg" alt="Experienced Teachers">
                                </div>
                                <div class="feature-content">
                                    <h4 class="feature-title">Qualified Teachers</h4>
                                    <p>At Henson Demonstration Schools, every subject taught are done by the best brains
                                        in their various fields,
                                        as our teachers are carefully selected with the best QUALIFICATION and proven
                                        IMPECCABLE CHARACTERS
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="feature-item">
                                <span class="count">03</span>
                                <div class="feature-icon">
                                    <img src="assets/img/icon/library.svg" alt="Extensive Library">
                                </div>
                                <div class="feature-content">
                                    <h4 class="feature-title">Technology</h4>
                                    <p>Henson is described by all as an institution that is at the front burner of
                                        technology, as its application has become the order of the day in every sphere
                                        of our
                                        activitiesvfrom start to finish. We also expose our students to technological
                                        activities to
                                        enable them globally competitive.
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
                                    <h4 class="feature-title">Conducive Environment</h4>
                                    <p>Henson is located in a secured and serene environment with a very large expanse of
                                        land where
                                        educational and recreational activities are carried out conducively.
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
                                        <img class="img-1" src="assets/img/about/01.jpg" alt="">
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
                                    A Commitment to <span>Excellence</span> in Education.
                                </h2>
                            </div>
                            <p class="about-text">
                                Henson Demonstration Schools comprises of three tiers of schools, namely Nursery,
                                Primary and Secondary schools, it is a private co-educational institution established to
                                complement government effort at providing affordable and qualitative education for
                                children in Nigeria and the world at large.
                            </p>
                            <div class="about-content">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="about-item">
                                            <div class="about-item-icon">
                                                <img src="assets/img/icon/open-book.svg" alt="Quality Education Icon">
                                            </div>
                                            <div class="about-item-content">
                                                <h5>Mission</h5>
                                                <p>Henson Demonstration School is committed to the total development of
                                                    the child mentally, physically, socially and morally.</p>
                                            </div>
                                        </div>
                                        <div class="about-item">
                                            <div class="about-item-icon">
                                                <img src="assets/img/icon/online-course.svg"
                                                    alt="Innovative Learning Icon">
                                            </div>
                                            <div class="about-item-content">
                                                <h5>Vision</h5>
                                                <p>Raising and educating future leaders.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="about-quote">
                                            <p>"We strive to release the potential in every child.
                                                 Our dream is to provide each and every child with a sound, well rounded quality education."</p>
                                            <i class="far fa-quote-right"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="about-bottom">
                                <a href="about.html" class="theme-btn">Discover More<i
                                        class="fas fa-arrow-right-long"></i></a>
                                <div class="about-phone">
                                    <div class="icon"><i class="fal fa-headset"></i></div>
                                    <div class="number">
                                        <span>Call Now</span>
                                        <h6><a href="tel:+2348037196219">+234 803 719 6219</a></h6>
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
                                    <span class="site-title-tagline"> Why Choose
                                        Us</span>
                                    <h2 class="site-title text-white mb-10">Henson Demonstration Schools:
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
                                                    <h4>Academic Excellence</h4>
                                                    <p>Henson Demonstration Schools consistently produces
                                                        top-performing students
                                                        with
                                                        stellar academic results.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="choose-item">
                                                <div class="choose-item-icon">
                                                    <img src="assets/img/icon/teacher.svg" alt="">
                                                </div>
                                                <div class="choose-item-info">
                                                    <h4>Dedicated Leadership</h4>
                                                    <p>Our Director, Principal, and Vice Principal ensure that every
                                                        student
                                                        receives quality education and guidance.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="choose-item">
                                                <div class="choose-item-icon">
                                                    <img src="assets/img/icon/global-education.svg" alt="">
                                                </div>
                                                <div class="choose-item-info">
                                                    <h4>Modern Facilities</h4>
                                                    <p>We offer state-of-the-art classrooms, well-equipped labs, and a
                                                        conducive
                                                        environment for learning.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="choose-item">
                                                <div class="choose-item-icon">
                                                    <img src="assets/img/icon/acting.svg" alt="">
                                                </div>
                                                <div class="choose-item-info">
                                                    <h4>Holistic Growth</h4>
                                                    <p>We nurture both academic and extracurricular talents, preparing
                                                        students
                                                        for success in all walks of life.</p>
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
                            <img src="assets/img/about/8.jpg" alt="Henson Demonstration Schools">
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
                            <p>Experience Life at Henson Demonstration Schools through Our Lens</p>
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
                                <h1>Shape Your Future at Henson Demonstration Schools – Enroll Today!</h1>
                                <p>Unlock endless opportunities with a solid foundation at Henson Demonstration Schools. Join a
                                    community
                                    dedicated to academic excellence, Spiritual growth, and success in all areas of
                                    life.
                                </p>
                                <div class="cta-btn">
                                    <a href="enroll.php" class="theme-btn">Start Your Journey<i
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
                            <p>Hear from our students and parents about their experiences at Henson Demonstration Schools. Their stories reflect our commitment to excellence.</p>
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