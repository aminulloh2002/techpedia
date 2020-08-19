<?php 
session_start();
require '../user/functions.php';

$barang = query("SELECT * FROM barang WHERE merk = 'asus'");

 ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>shop</title>

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="../css/core-style.css">
    <link rel="stylesheet" href="../style.css">

</head>

<body>
    <!-- ##### Header Area Start ##### -->
    <header class="header_area">
        <div class="classy-nav-container breakpoint-off d-flex align-items-center justify-content-between">
            <!-- Classy Menu -->
            <nav class="classy-navbar" id="essenceNav">
                <!-- Logo -->
                <a href="../index.php"><p class="nav-brand" style="margin-top: 15px;">Techpedia</p></a>
                <!-- Navbar Toggler -->
                <div class="classy-navbar-toggler">
                    <span class="navbarToggler"><span></span><span></span><span></span></span>
                </div>
                <!-- Menu -->
                <div class="classy-menu">
                    <!-- close btn -->
                    <div class="classycloseIcon">
                        <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                    </div>
                    <!-- Nav Start -->
                    <div class="classynav">
                        <ul>
                            <li><a href="../shop.php">Shop</a></li>
                            <li><a href="../blog.html">Blog</a></li>
                            <li><a href="../contact.html">Contact</a></li>
                        </ul>
                    </div>
                    <!-- Nav End -->
                </div>
            </nav>

            <!-- Header Meta Data -->
            <div class="header-meta d-flex clearfix justify-content-end">
                <!-- User Login Info -->
                <div class="user-login-info">
                    <a href="user/dashboard.php">
                    <?php 
                    if (isset($_SESSION["ulogin"])){
                        echo $_SESSION["fname"];
                    }else{
                        echo"login";
                    }
                     ?>                    
                    </a>
                </div>
                <!-- Cart Area -->
                <div class="cart-area">
                    <a href="#" id="essenceCartBtn"><img src="../img/core-img/bag.svg" alt=""> <span><?php
                        if(isset($_SESSION['keranjang'])){ echo count($_SESSION['keranjang']);}
                        else{
                            echo"";
                        } ?></span></a>
                </div>
            </div>

        </div>
    </header>
    <!-- ##### Header Area End ##### -->

    <!-- ##### Right Side Cart Area ##### -->
    <div class="cart-bg-overlay"></div>

    <div class="right-side-cart-area">

        <!-- Cart Button -->
        <div class="cart-button">
            <a href="#" id="rightSideCart"><img src="../img/core-img/bag.svg" alt=""> <span>                        <?php
                        if(isset($_SESSION['keranjang'])){ echo count($_SESSION['keranjang']);}
                        else{
                            echo"";
                        } ?></span></a>
        </div>

        <div class="cart-content d-flex">

            <!-- Cart List Area -->
            <div class="cart-list">
                <!-- Single Cart Item -->
                <?php
                if (empty($_SESSION['keranjang'])){

                echo " <br><p style='text-align:center;'>anda belum memesan barang</p>";
            } else { ?>
                <?php $totalbelanja = 0; ?>
                <?php foreach ($_SESSION["keranjang"] as $kjg => $jumlah) : ?>
                    <?php $ambil = $conn->query("SELECT * FROM barang WHERE id_barang = '$kjg'");
                    $pch = $ambil->fetch_assoc();
                     ?>
                <div class="single-cart-item">
                    <li class="product-image">
                        <img src="../admin-panel/img/<?= $pch['gambar']; ?>" class="cart-thumb" alt="">
                        <!-- Cart Item Desc -->
                        <div class="cart-item-desc">
                          <a href="hapus-keranjang.php?id=<?= $pch['id_barang']; ?>"><span class="product-remove" title="hapus pesanan"><i class="fa fa-close" aria-hidden="true"></i></span></a>
                            <span class="badge"><?= $pch['merk']; ?></span>
                            <h6><?= $pch['tipe']; ?></h6>
                            <h6>Jumlah : <?= $jumlah; ?></h6>
                            <p class="price"><?= rupiah($pch['harga']*$jumlah); ?></p>
                        </div>
                    </li>
                </div>
                <?php $totalbelanja +=$pch['harga']*$jumlah; ?>
            <?php endforeach; ?>
        <?php } ?>
            </div>

            <!-- Cart Summary -->
            <div class="cart-amount-summary">
                <?php 
                if (empty($_SESSION['keranjang'])){

                echo " <br><p style='text-align:center;'>anda belum memesan barang</p>";
            } else { ?>
                <h2>Summary</h2>
                <ul class="summary-table">
                    <li><span>Items</span> <span>Subtotal</span></li> <hr>
                <?php foreach ($_SESSION["keranjang"] as $kjg => $jumlah) : ?>
                    <?php $ambil = $conn->query("SELECT * FROM barang WHERE id_barang = '$kjg'");
                    $pch = $ambil->fetch_assoc();
                     ?>
                    <li><span><?= $pch['tipe']; ?></span> <span><?= rupiah($pch['harga']*$jumlah); ?></span></li>
                <?php endforeach; ?>
                    <hr>
                    <li><span>total:</span> <span><?= rupiah($totalbelanja); ?></span></li>
                </ul>
                <div class="checkout-btn mt-100 mb-100">
                    <a href="checkout.php" class="btn essence-btn">check out</a>
                </div>
            <?php } ?>
            </div>
        </div>
    </div>
    <!-- ##### Right Side Cart End ##### -->

    <!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb_area bg-img" style="background-image: url(../img/bg-img/breadcumb.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2>asus</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->

    <!-- ##### Shop Grid Area Start ##### -->
    <section class="shop_grid_area section-padding-80">
        <div class="container">
            <div class="row">

                <div class="col-12 col-md-8 col-lg-12">
                    <div class="shop_grid_product_area">
                        <div class="row">
                            <div class="col-12">
                                <div class="product-topbar d-flex align-items-center justify-content-between">
                                    <!-- Total Products -->
                                    <div class="total-products">
                                        <p><span><?php echo count($barang); ?></span> products found</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <!-- Single Product -->
                            <?php foreach ($barang as $brg) : ?>
                            <div class="col-12 col-sm-6 col-lg-3">
                                <div class="single-product-wrapper">
                                    <!-- Product Image -->
                                    <div class="product-img">
                                        <a href="../product-details.php?id=<?= $brg['id_barang']; ?>">
                                        <img src="../admin-panel/img/<?= $brg['gambar']; ?>" alt=""></a>
                                    </div>

                                    <!-- Product Description -->
                                    <div class="product-description">
                                        <span><?= $brg['merk']; ?></span>
                                        <a href="../product-details.php?id=<?= $brg['id_barang']; ?>">
                                            <h6><?= $brg['tipe']; ?></h6>
                                        </a>
                                        <p class="product-price"><?= rupiah($brg['harga']); ?></p>

                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Shop Grid Area End ##### -->

    <!-- ##### Footer Area Start ##### -->
    <footer class="footer_area clearfix">
        <div class="container">
            <div class="row">
                <!-- Single Widget Area -->
                <div class="col-12 col-md-6">
                    <div class="single_widget_area d-flex mb-30">
                        <!-- Logo -->
                        <div class="footer-logo mr-50">
                            <a href="#"><img src="img/core-img/logo2.png" alt=""></a>
                        </div>
                        <!-- Footer Menu -->
                        <div class="footer_menu">
                            <ul>
                                <li><a href="shop.html">Shop</a></li>
                                <li><a href="blog.html">Blog</a></li>
                                <li><a href="contact.html">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Single Widget Area -->
                <div class="col-12 col-md-6">
                    <div class="single_widget_area mb-30">
                        <ul class="footer_widget_menu">
                            <li><a href="#">Order Status</a></li>
                            <li><a href="#">Payment Options</a></li>
                            <li><a href="#">Shipping and Delivery</a></li>
                            <li><a href="#">Guides</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Terms of Use</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row align-items-end">
                <!-- Single Widget Area -->
                <div class="col-12 col-md-6">
                    <div class="single_widget_area">
                        <div class="footer_heading mb-30">
                            <h6>Subscribe</h6>
                        </div>
                        <div class="subscribtion_form">
                            <form action="#" method="post">
                                <input type="email" name="mail" class="mail" placeholder="Your email here">
                                <button type="submit" class="submit"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Single Widget Area -->
                <div class="col-12 col-md-6">
                    <div class="single_widget_area">
                        <div class="footer_social_area">
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Pinterest"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Youtube"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </div>

<div class="row mt-5">
                <div class="col-md-12 text-center">
                    <p>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
    Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </p>
                </div>
            </div>

        </div>
    </footer>
    <!-- ##### Footer Area End ##### -->

    <!-- jQuery (Necessary for All JavaScript Plugins) -->
    <script src="../js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="../js/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="../js/bootstrap.min.js"></script>
    <!-- Plugins js -->
    <script src="../js/plugins.js"></script>
    <!-- Classy Nav js -->
    <script src="../js/classy-nav.min.js"></script>
    <!-- Active js -->
    <script src="../js/active.js"></script>

</body>

</html>