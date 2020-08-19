<?php 

session_start();

if ( !isset($_SESSION["login"]) ) {
    header("Location: admin");
    exit;
}

require 'functions.php';


$id = abs($_GET["id"]);

//query data barang berdasarkan id
$brg = query("SELECT * FROM barang WHERE id_barang = $id")[0];

// cek apakah tombol submit sudah ditekan atau balum
if ( isset($_POST["submit"]) ){


//cek apakah data berhasil diubah atau tidak
if( edit ($_POST) > 0 ){
    echo "<script>
    alert('data berhasil diubah!');
    document.location.href = 'table.php';
    </script>";
}else {
    echo "<script>
            alert('data gagal diubah!');
            document.location.href = 'table.php';
         </script>";
}

}
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
    <title>ubah data</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

</head>
<body>
    <div class="container ml-4 mt-4">
        <div class="col-lg-11 ml-4">
            <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $brg["id_barang"]; ?>">
            <input type="hidden" name="gambarlama" value="<?= $brg["gambar"]; ?>">
            <div class="card">
                <div class="card-header">
                    <strong>ubah data</strong>
                </div>
                <div class="card-body card-block">
                    <div class="form-group">
                        <label for="merk" class=" form-control-label">merk</label>
                        <input name="merk" type="text" id="merk" class="form-control" required value="<?= $brg["merk"]; ?>">
                    </div>
                    <div class="form-group">
                        <label for="model" class=" form-control-label">tipe</label>
                        <input name="tipe" type="text" id="model"  class="form-control" required
                        value="<?= $brg["tipe"]; ?>">
                    </div>
                    <div class="form-group">
                        <label for="harga" class=" form-control-label">harga</label>
                        <input name="harga" type="text" id="harga"  class="form-control" required value="<?= $brg["harga"]; ?>">
                    </div>
                    <div class="form-group">
                        <label for="prosesor" class=" form-control-label">prosesor</label>
                        <input name="prosesor" type="text" id="prosesor"  class="form-control" required value="<?= $brg["prosesor"]; ?>">
                    </div>
                    <div class="form-group">
                        <label for="ram" class=" form-control-label">ram</label>
                        <input name="ram" type="text" id="ram"  class="form-control" required value="<?= $brg["ram"]; ?>">
                    </div>
                    <div class="form-group">
                        <label for="grafis" class=" form-control-label">grafis</label>
                        <input name="grafis" type="text" id="grafis" class="form-control" required
                        value="<?= $brg["grafis"]; ?>">
                    </div>
                    <div class="form-group">
                        <label for="penyimpanan" class=" form-control-label">penyimpanan</label>
                        <input name="penyimpanan" type="text" id="penyimpanan"  class="form-control" required value="<?= $brg["penyimpanan"]; ?>">
                    </div>
                    <div class="form-group">
                        <label for="stock" class=" form-control-label">stock</label>
                        <input name="stock" type="text" id="stock"  class="form-control" required value="<?= $brg["stock"]; ?>">
                    </div>
                    <div class="form-group">
                    <label for="file-input" class=" form-control-label">gambar</label>
                    <img src="img/<?= $brg['gambar']; ?>" width="40">
                    <input type="file" id="file-input" name="gambar" class="form-control-file">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" name="submit" class="btn btn-primary btn-sm">
                        <i class="fa fa-dot-circle-o"></i> ubah data
                    </button>
                    <a class="btn btn-primary btn-sm" href="table.php">batal</a>
                </div>
            </div>
        </form>
        </div>
    </div>



    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

</body>

</html>
<!-- end document-->
