<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <div class="logo-header" data-background-color="dark">
            <a href="index.html" class="logo text-light">
                SAM JAYA
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
    </div>

    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item active">
                    <a data-bs-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
                        <i class="fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="dashboard">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="">
                                    <span class="sub-item">Dashboard</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Components</h4>
                </li>

                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#item">
                        <i class="fas fa-boxes"></i>
                        <p>Master Barang</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="item">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="<?= BASE_URL ?>/dashboard/jenis/">
                                    <i class="fas fa-tags me-2"></i>
                                    <span class="sub-item">Jenis</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= BASE_URL ?>/dashboard/satuan/">
                                    <i class="fas fa-balance-scale me-2"></i>
                                    <span class="sub-item">Satuan</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= BASE_URL ?>/dashboard/stok/">
                                    <i class="fas fa-warehouse me-2"></i>
                                    <span class="sub-item">Stok Barang</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= BASE_URL ?>/dashboard/barang-masuk/">
                                    <i class="fas fa-arrow-circle-down me-2"></i>
                                    <span class="sub-item">Barang Masuk</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= BASE_URL ?>/dashboard/barang-keluar/">
                                    <i class="fas fa-arrow-circle-up me-2"></i>
                                    <span class="sub-item">Barang Keluar</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a href="<?= BASE_URL ?>/dashboard/supplier/">
                        <i class="fas fa-truck"></i>
                        <p>Supplier</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#pelanggan">
                        <i class="fas fa-user-friends"></i>
                        <p>Pelanggan</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#service">
                        <i class="fas fa-tools"></i>
                        <p>Master Service</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="service">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="<?= BASE_URL ?>/dashboard/jenis/">
                                    <i class="fas fa-info-circle me-2"></i>
                                    <span class="sub-item">Status</span>
                                </a>
                            </li>
                            <li>
                                <a href="components/buttons.html">
                                    <i class="fas fa-receipt me-2"></i>
                                    <span class="sub-item">Order</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= BASE_URL ?>/dashboard/mekanik/">
                                    <i class="fas fa-user-cog me-2"></i>
                                    <span class="sub-item">Daftar Mekanik</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#laporan">
                        <i class="fas fa-file-alt"></i>
                        <p>Laporan</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="laporan">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="<?= BASE_URL ?>/dashboard/laporan/barang-masuk/">
                                    <i class="fas fa-arrow-circle-down me-2"></i>
                                    <span class="sub-item">Barang Masuk</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= BASE_URL ?>/dashboard/laporan/barang-keluar/">
                                    <i class="fas fa-arrow-circle-up me-2"></i>
                                    <span class="sub-item">Barang Keluar</span>
                                </a>
                            </li>
                            <li>
                                <a href="components/gridsystem.html">
                                    <i class="fas fa-tools me-2"></i>
                                    <span class="sub-item">Service</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= BASE_URL ?>/dashboard/laporan/supplier/">
                                    <i class="fas fa-truck-loading me-2"></i>
                                    <span class="sub-item">Suppliar</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
