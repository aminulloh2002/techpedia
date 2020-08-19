<?php 
session_start();
require 'functions.php';
if ( !isset($_SESSION["ulogin"]) ) {
    header("Location: login");
    exit;
}

if (isset($_POST ["daftar"])) {
    if( admubahpass($_POST) > 0 ){
        echo "<script>
                alert('Password telah diubah!');
                document.location.href = 'dashboard.php';
                </script>";
        exit;
    } else {
        echo mysqli_error($conn);
    } 

}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>Change Password</title>

    <!-- Icons font CSS-->
    <link href="../admin-panel/admin/add/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="../admin-panel/admin/add/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="../admin-panel/admin/add/https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="../admin-panel/admin/add/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="../admin-panel/admin/add/vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="../admin-panel/admin/add/css/main.css" rel="stylesheet" media="all">
</head>

<body>
    <div class="page-wrapper bg-gra-03 p-t-45 p-b-50">
        <div class="wrapper wrapper--w790">
            <div class="card card-5">
                <div class="card-heading">
                    <h2 class="title">Change Password</h2>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="form-row">
                        <div class="name">Password lama</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="password" name="passwordlama" placeholder="Password lama" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Password baru</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="Password" name="passwordbaru" placeholder="Password baru" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Confirm Password</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="Password" name="passwordbaru2" placeholder="Confirm Password">
                                </div>
                            </div>
                        </div>
                        <div>
                            <button class="btn btn--radius-2 btn--blue" type="submit" name="daftar">Change Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Jquery JS-->
    <script src="../admin-panel/admin/add/vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="../admin-panel/admin/add/vendor/select2/select2.min.js"></script>
    <script src="../admin-panel/admin/add/vendor/datepicker/moment.min.js"></script>
    <script src="../admin-panel/admin/add/vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="../admin-panel/admin/add/js/global.js"></script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->