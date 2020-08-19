<?php 
session_start();
require 'functions.php';

if ( !isset($_SESSION["ulogin"]) ) {
    header("Location: login");
    exit;
}

$id = $_SESSION['id'];

$pemesanan = query("SELECT * FROM pemesanan WHERE id_user = $id ORDER BY id_pemesanan DESC");



?>



<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="">

    <!-- Title Page-->
    <title>Dashboard</title>

    <!-- Fontfaces CSS-->
    <link href="../admin-panel/css/font-face.css" rel="stylesheet" media="all">
    <link href="../admin-panel/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="../admin-panel/vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="../admin-panel/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="../admin-panel/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="../admin-panel/vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="../admin-panel/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="../admin-panel/vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="../admin-panel/vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="../admin-panel/vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="../admin-panel/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="../admin-panel/vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="../admin-panel/css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
<div class="page-wrapper">
<!-- HEADER MOBILE-->
<header class="header-mobile d-block d-lg-none">
    <div class="header-mobile__bar">
        <div class="container-fluid">
            <div class="header-mobile-inner">
                <a class="logo" href="index.html">
                    <h1>Techpedia</h1>
                </a>
                <button class="hamburger hamburger--slider" type="button">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <nav class="navbar-mobile">
        <div class="container-fluid">
            <ul class="navbar-mobile__list list-unstyled">
                <li >
                    <a href="dashboard.php">
                        <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                </li>
            </ul>
        </div>
    </nav>
</header>
<!-- END HEADER MOBILE-->

<!-- MENU SIDEBAR-->
<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        <a href="#">
           <h1>Techpedia</h1>
        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">
                <li class="active">
                    <a href="dashboard.php">
                        <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                </li>
                <li>
                    <a href="../index.php">
                        <i class="fas fa-home"></i>Home</a>
                </li>
                <li>
                    <a href="../shop.php">
                        <i class="fas fa-shopping-basket"></i>Shop</a>
                </li>
                <li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-user"></i>Account</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="ubah-pass.php">Ubah Password</a>
                                </li>
                                <li>
                                    <a href="logout.php">Logout</a>
                                </li>
                            </ul>
                        </li>
                </li>
            </ul>
        </nav>
    </div>
</aside>
<!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <form class="form-header" action="" method="POST">
                                <input class="au-input au-input--xl" type="text" name="search" placeholder="Search for datas &amp; reports..." />
                                <button class="au-btn--submit" type="submit">
                                    <i class="zmdi zmdi-search"></i>
                                </button>
                            </form>
                            <div class="header-button">
                                
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        
                                            <p>Welcome, <?= $_SESSION["fname"]; ?>!</p>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">

                                <?php if(empty($pemesanan)){
                                echo "";}
                                else { ?>
                                <h2 class="title-1 m-b-25">Orders History</h2>
                                <div class="table-responsive table--no-card m-b-40">
                                    <table class="table table-borderless table-data3">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Tanggal</th>
                                                <th class="text-center">order ID</th>
                                                <th class="text-center">Total Pembayaran</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Detail Order</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($pemesanan as $pms) :  ?>
                                            <tr>
                                                <?php $dmy = $pms['tanggal']; ?>
                                                <td class="text-center"><?= date('d-m-Y',strtotime($dmy)); ?></td>
                                                <td class="text-center"><?= $pms['id_pemesanan']; ?></td>
                                                <td class="text-center"><?= $pms['totalh']; ?></td>
                                                <?php if ($pms['status'] == 0 ){ ?>
                                                    <td class="pending text-center">pending</td>
                                                <?php }elseif ($pms['status'] ==1 ) { ?>
                                                    <td class="process text-center">processed</td>
                                                <?php }else { ?>
                                                    <td class="denied text-center">denied</td>
                                                <?php } ?>
                                                <td class="text-center"><a href="detail-pemesanan.php?id=<?= $pms['id_pemesanan']; ?>">detail</a></td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php } ?>
                            </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="copyright">
                                    <p>Copyright © 2018 Techpedia. All rights reserved.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>


    <!-- Jquery JS-->
    <script src="../admin-panel/vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="../admin-panel/vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="../admin-panel/vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="../admin-panel/vendor/slick/slick.min.js">
    </script>
    <script src="../admin-panel/vendor/wow/wow.min.js"></script>
    <script src="../admin-panel/vendor/animsition/animsition.min.js"></script>
    <script src="../admin-panel/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="../admin-panel/vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="../admin-panel/vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="../admin-panel/vendor/circle-progress/circle-progress.min.js"></script>
    <script src="../admin-panel/vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../admin-panel/vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="../admin-panel/vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="../admin-panel/js/main.js"></script>

</body>

</html>
<!-- end document-->
