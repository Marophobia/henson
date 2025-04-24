<?php include 'config.php'; ?>
<header class="header">
    <div class="main-navigation">
        <nav class="navbar navbar-expand-lg">
            <div class="container position-relative">
                <a class="navbar-brand" href="<?php echo $base_url; ?>/index.php">
                    <img src="<?php echo $base_url; ?>/assets/img/logo/logo.png" width="100" alt="logo">
                </a>
                <div class="mobile-menu-right">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-mobile-icon"><i class="far fa-bars"></i></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="main_nav">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="<?php echo $base_url; ?>/index.php" id="home-link">Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-item" href="<?php echo $base_url; ?>/about.php">About</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link " href="<?php echo $base_url; ?>/gallery.php">Gallery</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link " href="<?php echo $base_url; ?>/blog.php">News & Events</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Admissions</a>
                            <ul class="dropdown-menu fade-down">
                                <li><a class="dropdown-item" href="<?php echo $base_url; ?>/how-to-apply.php">How To
                                        Apply</a></li>
                                <li><a class="dropdown-item" href="<?php echo $base_url; ?>/enroll.php">Application
                                        Form</a></li>
                                <!-- <li><a class="dropdown-item" href="<?php echo $base_url; ?>/campuses.php">Our Campuses</a>
                                </li> -->
                                <!-- 
                                <li class="dropdown-submenu">
                                    <a class="dropdown-item dropdown-toggle" href="#">Our Campus</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="<?php echo $base_url; ?>/ikpoha-hill-campus.php">Ikpoha Hill Campus</a></li>
                                        <li><a class="dropdown-item" href="<?php echo $base_url; ?>/gra-campus.php">GRA Campus</a></li>
                                    </ul>
                                </li> -->
                                <!-- <li><a class="dropdown-item" href="<?php echo $base_url; ?>/facilities.php">Our
                                        Facilities</a></li> -->
                                <li><a class="dropdown-item" href="<?php echo $base_url; ?>/faq.php">FAQs</a></li>

                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="https://app.adesotucollege.com/checkresult">Check Result</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link " href="https://app.adesotucollege.com">Login</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo $base_url; ?>/contact.php">Contact</a></li>
                    </ul>
                    <div class="nav-right">

                        <div class="nav-right-btn mt-2">
                            <a href="<?php echo $base_url; ?>/enroll.php" class="theme-btn"><span
                                    class="fal fa-pencil"></span>Enroll Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>