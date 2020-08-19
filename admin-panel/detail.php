<?php 
session_start();
require 'functions.php';

if ( !isset($_SESSION["login"]) ) {
    header("Location: admin");
    exit;
}

$id = abs($_GET["id"]);

$pemesanan = query("SELECT * FROM pemesanan_barang WHERE id_pembelian = $id");
$alamat = query("SELECT * FROM pemesanan WHERE id_pemesanan = $id")[0];



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
    <title>detail order</title>

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
<body style="background-color: #ededed;">
    <div class="container ml-4 mt-4">

                                <h2 class="title-5 m-b-20">Detail Pemesanan</h2>
                                <div class="table-responsive table--no-card m-b-50">
                                    <table class="table table-borderless table-striped table-earning">
                                        <thead>
                                            <tr>
                                                <th class="text-center">merk</th>
                                                <th class="text-center">tipe</th>
                                                <th class="text-center">harga</th>
                                                <th class="text-center">jumlah</th>
                                                <th class="text-center">subharga</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $total = 0; ?>
                                        <?php foreach ($pemesanan as $pms) :  ?>
                                        <?php 
                                        $idb = $pms['id_barang'];
                                        $barang = query("SELECT * FROM barang WHERE id_barang = $idb");
                                        ?>
                                        <?php foreach ($barang as $brg) : ?>
                                            <tr>
                                                <td class="text-center"><?= $brg['merk']; ?></td>
                                                <td class="text-center"><?= $brg['tipe']; ?></td>
                                                <td class="text-center"><?= rupiah($brg['harga']); ?></td>
                                                <td class="text-center"><?= $pms['jumlah']; ?></td>
                                                <td class="text-center"><?= rupiah($brg['harga']*$pms['jumlah']); ?></td>
                                            </tr>
                                            <?php $total += $brg['harga']*$pms['jumlah']; ?>
                                        <?php endforeach; ?>
                                        <?php endforeach; ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td class="text-center">Total :</td>
                                                <td class="text-center"></td>
                                                <td class="text-center"></td>
                                                <td class="text-center"></td>
                                                <td class="text-center"><?= rupiah($total); ?></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                                <h4 class="title-5 m-b-10">Alamat pengiriman</h4>
                                <div class="table--no-card m-b-40">
                                    <table class="table table-borderless table-striped ">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Provinsi</th>
                                                <th class="text-center">Kota</th>
                                                <th class="text-center">Kecamatan</th>
                                                <th class="text-center">Desa</th>
                                                <th class="text-center">Kodepos</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                            <tr>
                                                <td class="text-center"><?= $alamat['provinsi']; ?></td>
                                                <td class="text-center"><?= $alamat['kota']; ?></td>
                                                <td class="text-center"><?= $alamat['kecamatan']; ?></td>
                                                <td class="text-center"><?= $alamat['desa']; ?></td>
                                                <td class="text-center"><?= $alamat['kpos']; ?></td>
                                                
                                            </tr>

                                        </tbody>
                                    </table>

            </div>
            <a href="order-list.php"><span>kembali</span></a>
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
