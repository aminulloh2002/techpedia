<?php
session_start();
$id = $_GET['id'];
unset($_SESSION['keranjang'][$id]);

echo "<script>alert('Item Telah Dihapus');</script>";
echo "<script>location='javascript:history.go(-1)';</script>";
?>