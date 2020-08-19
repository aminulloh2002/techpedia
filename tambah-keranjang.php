<?php 
session_start();


if(isset($_POST['tambah'])){
$id = $_POST['id'];
$jumlah = $_POST['jumlah'];


if(isset($_SESSION['keranjang'][$id])){
$_SESSION['keranjang'][$id] += $jumlah;
}else {
$_SESSION['keranjang'][$id] = $jumlah;

}
echo"<script>alert('barang sudah berhasil ditambahkan!')</script>";
echo "<script>location='javascript:history.go(-1)';</script>";
}

 ?>