    <div class="main-header">
        <div class="main-header-logo">
            <!-- Logo Header -->
            <div class="logo-header" data-background-color="dark">
                <a href="index.html" class="logo">
                    <img
                        src="<?= BASE_URL ?>/assets/default.jpg"
                        alt="navbar brand"
                        class="navbar-brand"
                        height="20" />
                </a>
                <div class="nav-toggle">
                    <button class="btn btn-toggle toggle-sidebar">
                        <i class="gg-menu-right"></i>
                    </button>
                    <button class="btn btn-toggle sidenav-toggler">
                        <i class="gg-menu-left"></i>
                    </button>
                </div>
                <button class="topbar-toggler more">
                    <i class="gg-more-vertical-alt"></i>
                </button>
            </div>
            <!-- End Logo Header -->
        </div>
        <!-- Navbar Header -->
        <nav
            class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
            <div class="container-fluid">
                <nav
                    class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <button type="button" onclick="onSearch('<?= $search ?? '' ?>')" class="btn btn-search pe-1">
                                <i class="fa fa-search search-icon"></i>
                            </button>
                        </div>
                        <input
                            type="text"
                            placeholder="Cari ..."
                            class="form-control"
                            id="search" 
                            value="<?= $_GET['search'] ?? ''?>"
                            />
                    </div>
                </nav>

                <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                    <li
                        class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none">
                        <a
                            class="nav-link dropdown-toggle"
                            data-bs-toggle="dropdown"
                            href="#"
                            role="button"
                            aria-expanded="false"
                            aria-haspopup="true">
                            <i class="fa fa-search"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-search animated fadeIn">
                            <form class="navbar-left navbar-form nav-search">
                                <div class="input-group">
                                    <input
                                        type="text"
                                        placeholder="Cari ..."
                                        class="form-control" />
                                </div>
                            </form>
                        </ul>
                    </li>


                    <li class="nav-item topbar-user dropdown hidden-caret">
                        <a
                            class="dropdown-toggle profile-pic"
                            data-bs-toggle="dropdown"
                            href="#"
                            aria-expanded="false">
                            <div class="avatar-sm">
                                <img
                                    src="<?= BASE_URL ?>/assets/default.jpg"
                                    alt="..."
                                    class="avatar-img rounded-circle" />
                            </div>
                            <span class="profile-username">
                                <span class="op-7">Hi,</span>
                                <span class="fw-bold"><?= $_SESSION['user']['name'] ?></span>
                            </span>
                        </a>
                        <ul class="dropdown-menu dropdown-user animated fadeIn">
                            <div class="dropdown-user-scroll scrollbar-outer">
                                <li>
                                    <div class="user-box">
                                        <div class="avatar-lg">
                                            <img
                                                src="<?= BASE_URL ?>/assets/default.jpg"
                                                alt="image profile"
                                                class="avatar-img rounded" />
                                        </div>
                                        <div class="u-text">
                                            <h4><?= $_SESSION['user']['name'] ?></h4>
                                            <p class="text-muted"><?= $_SESSION['user']['email'] ?></p>
                                            <!-- <a
                                                href="profile.html"
                                                class="btn btn-xs btn-secondary btn-sm">View Profile</a> -->
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="<?= BASE_URL ?>/">Dashboard</a>
                                    <a class="dropdown-item" href="<?= BASE_URL ?>/dashboard/order/">Order</a>
                                    <!-- <div class="dropdown-divider"></div> -->
                                    <!-- <a class="dropdown-item" href="<?= BASE_URL ?>/dashboard/profile/">Edit Profile</a> -->
                                    <div class="dropdown-divider"></div>
                                    <button type="button" onclick="onLogout()" class="dropdown-item" >Logout</button>
                                </li>
                            </div>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- End Navbar -->
    </div>

    

    <!-- <footer class="footer">
        <div class="container-fluid d-flex justify-content-between">
            <nav class="pull-left">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="http://www.themekita.com">
                            ThemeKita
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"> Help </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"> Licenses </a>
                    </li>
                </ul>
            </nav>
            <div class="copyright">
                2024, made with <i class="fa fa-heart heart text-danger"></i> by
                <a href="http://www.themekita.com">ThemeKita</a>
            </div>
            <div>
                Distributed by
                <a target="_blank" href="https://themewagon.com/">ThemeWagon</a>.
            </div>
        </div>
    </footer> -->
