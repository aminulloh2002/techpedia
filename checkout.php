<?php 
require 'admin-panel/functions.php';
session_start();

$id_user = $_SESSION["id"];
$tanggal = date("Y-m-d");

if ( !isset($_SESSION["ulogin"]) ) {
        echo "<script>
                alert('Silahkan login terlebih dahulu');
                document.location.href = 'user/login';
            </script>";    
    exit;
}

if ( !isset($_SESSION["keranjang"]) ) {
            echo "<script>
                document.location.href = 'index.php';
            </script>";    
            exit;
}

$idu = $_SESSION['id'];
$usr = query("SELECT * FROM user WHERE id_user = $idu")[0];


        if (isset($_POST["beli"])) 
        {   
            $provinsi = strtolower($_POST['provinsi']);
            $kota = strtolower($_POST['kota']);
            $kecamatan = strtolower($_POST['kecamatan']);
            $desa = strtolower($_POST['desa']);
            $kpos = $_POST['kodepos'];
            $total = $_POST['total'];
            
            // menyimpan data ke tabel pembelian
            $conn->query("INSERT INTO pemesanan VALUES ('','$id_user','$tanggal','$total','$provinsi','$kota','$kecamatan','$desa','$kpos','0')");
            //mendapatkan id_pembelian yg terakhir
            $id_pembelian_terakhir = $conn->insert_id;
            foreach ($_SESSION["keranjang"] as $id_barang => $jumlah)
            {

                $conn->query("INSERT INTO pemesanan_barang VALUES ('','$id_pembelian_terakhir','$id_barang','$jumlah')");
                $conn->query("UPDATE barang SET stock = stock - $jumlah WHERE id_barang = '$id_barang'");
            }
            unset($_SESSION["keranjang"]);
            echo "<script>alert('Pembelian berhasil!');
                   document.location.href = 'user/dashboard.php';
                  </script>";
}

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
    <title>Checkout</title>

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
                <a class="nav-brand" href="index.php"><p class="nav-brand" style="margin-top: 15px;">Techpedia</p></a>
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
                            <li> <a href="shop.php">Shop</a></li>
                            <li><a href="blog.html">Blog</a></li>
                            <li><a href="contact.html">Contact</a></li>
                        </ul>
                    </div>
                    <!-- Nav End -->
                </div>
            </nav>
    </header>
    <!-- ##### Header Area End ##### -->


    <!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb_area bg-img" style="background-image: url(img/bg-img/breadcumb.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2>Checkout</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->

    <!-- ##### Checkout Area Start ##### -->
    <div class="checkout_area section-padding-80">
        <div class="container">
            <div class="row">

                <div class="col-12 col-md-5">
                    <div class="checkout_details_area mt-50 clearfix">

                        <div class="cart-page-heading mb-30">
                            <h5>Pemesan :</h5>
                        </div>  
                                <div class="row">
                                <div class="col-12 mb-3">
                                    <label for="nama">Nama <span>:</span></label>
                                    <input type="text" class="form-control mb-3" id="nama" value="<?= $usr["fname"] . " " . $usr["lname"]; ?>" readonly>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="email">Email <span>:</span></label>
                                    <input type="text" class="form-control mb-3" id="email" value="<?= $usr["email"]; ?>" readonly>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="telp">No Telp <span>:</span></label>
                                    <input type="text" class="form-control mb-3" id="telp" value="<?= $usr["telp"]; ?>" readonly>
                                </div>
                            </div>
                        <div class="cart-page-heading mb-30">
                            <h5>Alamat pengiriman</h5>
                        </div>
                            <form action="" method="post">
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label for="street_address">Provinsi <span>:</span></label>
                                    <input type="text" class="form-control mb-3" id="street_address" value="" name="provinsi" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="postcode">Kota <span>:</span></label>
                                    <input type="text" class="form-control" id="postcode" value="" name="kota" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="city">Kecamatan <span>:</span></label>
                                    <input type="text" class="form-control" id="city" value="" name="kecamatan" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="state">Desa <span>:</span></label>
                                    <input type="text" class="form-control" id="state" value="" name="desa" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="kodepos">Kode pos <span>:</span></label>
                                    <input type="number" class="form-control" id="kodepos" min="0" value="" name="kodepos" required>
                                </div>
                            </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-6 ml-lg-auto">
                    <div class="order-details-confirmation">

                        <div class="cart-page-heading">
                            <h5>Your Order</h5>
                        </div>

                        <ul class="order-details-form mb-4">
                            <li><span>Product</span> <span>subtotal</span></li><br>
                    <?php $totalbelanja = 0; ?>
                    <?php foreach ($_SESSION["keranjang"] as $kjg => $jumlah) : ?>
                    <?php $ambil = $conn->query("SELECT * FROM barang WHERE id_barang = '$kjg'");
                    $pch = $ambil->fetch_assoc();
                     ?>
                            <li><span><?= $pch['merk']." ".$pch['tipe'] ." &nbsp; &nbsp; &nbsp;x". $jumlah; ?></span> <span><?= rupiah($pch['harga']*$jumlah); ?></span></li>
                    <?php $totalbelanja +=$pch['harga']*$jumlah; ?>
                    <input type="hidden" name="barang" value="<?= $pch['id_barang']; ?>">
                    <input type="hidden" name="jumlah" value="<?= $jumlah; ?>">
                    <input type="hidden" name="id_user" value="<?= $id_user; ?>">
                    <?php endforeach; ?>
                    <br>
                            <li><span>Total</span> <span><?= rupiah($totalbelanja); ?></span></li>
                            <input type="hidden" name="total" value="<?= $totalbelanja; ?>">
                        </ul>

                        <button type="submit" name="beli" class="btn essence-btn">Beli</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- ##### Checkout Area End ##### -->

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