        <header id="page-topbar">
            <div class="layout-width">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box horizontal-logo">
                            <a href="dashboard.php" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="../assets/img/logo/logo.png" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="../assets/img/logo/logo.png" alt="" height="17">
                                </span>
                            </a>

                            <a href="dashboard.php" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="../assets/img/logo/logo.png" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="../assets/img/logo/logo.png" alt="" height="17">
                                </span>
                            </a>
                        </div>

                        <button type="button"
                            class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger material-shadow-none"
                            id="topnav-hamburger-icon">
                            <span class="hamburger-icon">
                                <span></span>
                                <span></span>
                                <span></span>
                            </span>
                        </button>

                        <!-- App Search-->
                        <form class="app-search d-none d-md-block">
                            <div class="position-relative">
                                <input type="text" class="form-control" placeholder="Search..." autocomplete="off"
                                    id="search-options" value="">
                                <span class="mdi mdi-magnify search-widget-icon"></span>
                                <span class="mdi mdi-close-circle search-widget-icon search-widget-icon-close d-none"
                                    id="search-close-options"></span>
                            </div>
                           
                        </form>
                    </div>

                    <div class="d-flex align-items-center">

                        <div class="ms-1 header-item d-none d-sm-flex">
                            <button type="button"
                                class="btn btn-icon btn-topbar material-shadow-none btn-ghost-secondary rounded-circle"
                                data-toggle="fullscreen">
                                <i class='bx bx-fullscreen fs-22'></i>
                            </button>
                        </div>

                        <div class="ms-1 header-item d-none d-sm-flex">
                            <button type="button"
                                class="btn btn-icon btn-topbar material-shadow-none btn-ghost-secondary rounded-circle light-dark-mode">
                                <i class='bx bx-moon fs-22'></i>
                            </button>
                        </div>

                        <div class="dropdown ms-sm-3 header-item topbar-user">
                            <button type="button" class="btn material-shadow-none" id="page-header-user-dropdown"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="d-flex align-items-center">
                                    <img class="rounded-circle header-profile-user" src="../assets/img/blog/profile.jpg" alt="Header Avatar">
                                    <span class="text-start ms-xl-2">
                                        <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">Admin</span>
                                        <span class="d-none d-xl-block ms-1 fs-12 user-name-sub-text">Website Administrator</span>
                                    </span>
                                </span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <h6 class="dropdown-header">Welcome Admin!</h6>
                                <a class="dropdown-item" href="profile.php"><i
                                        class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span
                                        class="align-middle">Profile</span></a>

                                <a class="dropdown-item" href="profile.php"><i
                                        class="mdi mdi-cog-outline text-muted fs-16 align-middle me-1"></i> <span
                                        class="align-middle">Settings</span></a>
                                <a class="dropdown-item" href="logout.php"><i
                                        class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span
                                        class="align-middle" data-key="t-logout">Logout</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- ========== App Menu ========== -->
        <div class="app-menu navbar-menu">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <!-- Dark Logo-->
                <a href="dashboard.php" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="../assets/img/logo/logo.png" alt="" width="100">
                    </span>
                    <span class="logo-lg">
                        <img src="../assets/img/logo/logo.png" alt="" width="100">
                    </span>
                </a>
                <!-- Light Logo-->
                <a href="dashboard.php" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="../assets/img/logo/logo.png" alt="" width="100">
                    </span>
                    <span class="logo-lg">
                        <img src="../assets/img/logo/logo.png" alt="" width="100">
                    </span>
                </a>
                <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
                    id="vertical-hover">
                    <i class="ri-record-circle-line"></i>
                </button>
            </div>
            <div id="scrollbar">
                <div class="container-fluid">


                    <div id="two-column-menu">
                    </div>
                    <ul class="navbar-nav" id="navbar-nav">
                        <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="dashboard.php" role="button">
                                <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Dashboard</span>
                            </a>
                        </li> <!-- end Dashboard Menu -->

                        <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pages">Apps</span></li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarApps" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="sidebarApps">
                                <i class="ri-apps-2-line"></i> <span data-key="t-apps">News and Events</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarApps">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="news.php" class="nav-link"> <span data-key="t-to-do">All News</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="add-news.php" class="nav-link" data-key="t-chat"> Add New </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                          <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarApps1" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="sidebarApps">
                                <i class="ri-apps-2-line"></i> <span data-key="t-apps">Gallery</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarApps1">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="gallery.php" class="nav-link"> <span data-key="t-to-do">All Images</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="addimage.php" class="nav-link" data-key="t-chat"> Add New </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarApps4" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="sidebarApps">
                                <i class="ri-apps-2-line"></i> <span data-key="t-apps">Mail</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarApps4">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="sendmail.php" class="nav-link"> <span data-key="t-to-do">Send
                                                Email</span></a>
                                    </li>
                                    <!-- <li class="nav-item">
                                        <a href="lists.php" class="nav-link" data-key="t-chat"> Mail Lists </a>
                                    </li> -->
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="applications.php">
                                <i class="ri-honour-line"></i> <span data-key="t-widgets">Applications</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- Sidebar -->
            </div>

            <div class="sidebar-background"></div>
        </div>
        <!-- Left Sidebar End -->