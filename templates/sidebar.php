<?php
$base_url = '/nabila/ujikom/kasirnabila/';
?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Aplikasi Kasir</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <?php
            $sidebar_active = basename($_SERVER['PHP_SELF']);
            ?>

            <!-- Nav Item - Dashboard -->
            <li class="nav-item <?= ($sidebar_active == 'dashboard.php') ? 'active' : ''; ?>">
                <a class="nav-link" href="dashboard.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Menu
            </div>

            <!-- Nav Item - Kasir -->
            <li class="nav-item <?= (in_array($sidebar_active, ['tampilkasir.php', 'editkasir.php', 'tambahkasir.php'])) ? 'active' : ''; ?>">
                <a class="nav-link" href="<?= $base_url; ?>kasir/tampilkasir.php">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Data Kasir</span></a>
            </li>

            <!-- Nav Item - Barang -->
            <li class="nav-item <?= (in_array($sidebar_active, ['tampilbarang.php', 'editbarang.php', 'tambahbarang.php'])) ? 'active' : ''; ?>">
                <a class="nav-link" href="<?= $base_url; ?>barang/tampilbarang.php">
                    <i class="fas fa-fw fa-box"></i>
                    <span>Data Barang</span></a>
            </li>

            <!-- Nav Item - Shift -->
            <li class="nav-item <?= (in_array($sidebar_active, ['tampilshift.php', 'editshift.php', 'tambahshift.php'])) ? 'active' : ''; ?>">
                <a class="nav-link" href="<?= $base_url; ?>shift/tampilshift.php">
                    <i class="fas fa-fw fa-clock"></i>
                    <span>Data Shift</span></a>
            </li>

            <!-- Nav Item - Penjualan -->
            <li class="nav-item <?= (in_array($sidebar_active, ['tampilpenjualan.php', 'editpenjualan.php', 'tambahpenjualan.php'])) ? 'active' : ''; ?>">
                <a class="nav-link" href="<?= $base_url; ?>penjualan/tampilpenjualan.php">
                    <i class="fas fa-fw fa-shopping-cart"></i>
                    <span>Data Penjualan</span></a>
            </li>

            <!-- Nav Item - Detail Penjualan -->
            <li class="nav-item <?= (in_array($sidebar_active, ['tampildetail_penjualan.php', 'editdetail_penjualan.php', 'tambahdetail_penjualan.php'])) ? 'active' : ''; ?>">
                <a class="nav-link" href="<?= $base_url; ?>detail_penjualan/tampildetail_penjualan.php">
                    <i class="fas fa-fw fa-list"></i>
                    <span>Detail Penjualan</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->