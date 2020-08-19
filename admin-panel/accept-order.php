<?php 
require 'functions.php';

$id = abs($_GET["id"]);

if( accept($id) > 0 ) {
	echo " 
	<script>
	alert('Pemesanan Telah Diterima');
	document.location.href = 'order-list.php';
	</script>
	";

} else {
	echo " 
	<script>
	alert('Pemesanan Gagal Diterima');
	document.location.href = 'order-list.php';
	</script>
";
}
 ?>