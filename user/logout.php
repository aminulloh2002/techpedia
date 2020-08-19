<?php 
session_start();
$_SESSION = [];
session_unset();
session_destroy();

setcookie('id', '',time() - 3600);

echo"<script>alert('Anda telah berhasil logout');
document.location.href = '../index.php';
</script>";

exit;
?>