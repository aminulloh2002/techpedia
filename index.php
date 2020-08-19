<?php
session_start();
require 'admin-panel/functions.php';


// ambil data dari tabel barang
$barang = query("SELECT * FROM barang");

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
    <title>Techpedia</title>

    <!-- Favicon  -->
   

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="css/core-style.css">
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <!-- ##### Header Area Start ##### -->
    <header class="header_area">
        <div class="classy-nav-container breakpoint-off d-flex align-items-center justify-content-between">
            <!-- Classy Menu -->
            <nav class="classy-navbar" id="essenceNav">
                <!-- Logo -->
                <a href="index.php"><p class="nav-brand" style="margin-top: 15px;">Techpedia</p></a>
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
                            <li><a href="shop.php">Shop</a></li>
                            <li><a href="blog.html">Blog</a></li>
                            <li><a href="contact.html">Contact</a></li>
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
                    <a href="#" id="essenceCartBtn"><img src="img/core-img/bag.svg" alt=""> <span><?php
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
            <a href="#" id="rightSideCart"><img src="img/core-img/bag.svg" alt=""> <span>                        <?php
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

                echo "";
            } else { ?>
                <?php $totalbelanja = 0; ?>
                <?php foreach ($_SESSION["keranjang"] as $kjg => $jumlah) : ?>
                    <?php $ambil = $conn->query("SELECT * FROM barang WHERE id_barang = '$kjg'");
                    $pch = $ambil->fetch_assoc();
                     ?>
                <div class="single-cart-item">
                    <li class="product-image">
                        <img src="admin-panel/img/<?= $pch['gambar']; ?>" class="cart-thumb" alt="">
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

    <!-- ##### Welcome Area Start ##### -->
    <section class="welcome_area bg-img background-overlay" style="background-image: url(img/bg-img/newcollection.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="hero-content">
                        <h2>New Product</h2>
                        <h5>acer</h5>
                        <h4>PREDATOR HELIOS 300</h4>
                        <br>
                        <a href="product-details.php?id=25" class="btn essence-btn">view product</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Welcome Area End ##### -->

    <!-- ##### Top Catagory Area Start ##### -->
    <div class="top_catagory_area section-padding-80 clearfix">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading text-center">
                        <h2>Product Categories</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <!-- Single Catagory -->
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="single_catagory_area d-flex align-items-center justify-content-center bg-img" style="background-image: url(img/bg-img/asus_logo.jpg);">
                        <div class="catagory-content">
                            <a href="kategori/asus.php">Asus</a>
                        </div>
                    </div>
                </div>
                <!-- Single Catagory -->
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="single_catagory_area d-flex align-items-center justify-content-center bg-img" style="background-image: url(img/bg-img/bg_apple.jpg);">
                        <div class="catagory-content">
                            <a href="kategori/apple.php">Apple</a>
                        </div>
                    </div>
                </div>
                <!-- Single Catagory -->
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="single_catagory_area d-flex align-items-center justify-content-center bg-img" style="background-image: url(img/bg-img/acer_logo2.jpg);">
                        <div class="catagory-content">
                            <a href="kategori/acer.php">Acer</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Top Catagory Area End ##### -->

    <!-- ##### CTA Area Start ##### -->
    <div class="cta-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="cta-content bg-img background-overlay" style="background-image: url(img/bg-img/globalsale.jpg);">
                        <div class="h-100 d-flex align-items-center justify-content-end">
                            <div class="cta--text">
                                <h2>Global Sale</h2>
                                <a href="product-details.php?id=26" class="btn essence-btn">Buy Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### CTA Area End ##### -->

    <!-- ##### New Arrivals Area Start ##### -->
    <section class="new_arrivals_area section-padding-80 clearfix">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading text-center">
                        <h2>Popular Products</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="popular-products-slides owl-carousel">

                        <!-- Single Product -->
                        <?php foreach( $barang as $brg) : ?>
                        <div class="single-product-wrapper">
                            <!-- Product Image -->
                            <div class="product-img">
                               <a href="product-details.php?id=<?= $brg['id_barang']; ?>">
                                <img src="admin-panel/img/<?= $brg['gambar'];  ?>" alt=""> </a>
                            </div>
                            <!-- Product Description -->
                            <div class="product-description">
                                <span><?= $brg['merk']; ?></span>
                                <a href="product-details.php?id=<?= $brg['id_barang']; ?>">
                                    <h6><?= $brg['tipe']; ?></h6>
                                </a>
                                <p class="product-price"><?= rupiah($brg['harga']); ?></p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### New Arrivals Area End ##### -->


    <!-- ##### Footer Area Start ##### -->
    <footer class="footer_area clearfix">
        <div class="container">
            <div class="row">
                <!-- Single Widget Area -->
                <div class="col-12 col-md-6">
                    <div class="single_widget_area d-flex mb-30">
                        <!-- Logo -->
                        <div class="footer-logo mr-50">
                            <h5 style="color: gray;">Techpedia</h5>
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

                <div class="row mt-5">
                <div class="col-md-12 text-center">
                    <p>

    Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved 

                    </p>
                </div>
            </div>

        </div>
    </footer>
    <!-- ##### Footer Area End ##### -->

    <!-- jQuery (Necessary for All JavaScript Plugins) -->
    <script src="js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="js/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Plugins js -->
    <script src="js/plugins.js"></script>
    <!-- Classy Nav js -->
    <script src="js/classy-nav.min.js"></script>
    <!-- Active js -->
    <script src="js/active.js"></script>

</body>

</html>