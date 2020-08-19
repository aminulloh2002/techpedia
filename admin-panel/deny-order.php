<?php 
require 'functions.php';

$id = abs($_GET["id"]);

if( denied($id) > 0 ) {
	echo " 
	<script>
	alert('Pemesanan Telah Ditolak');
	document.location.href = 'order-list.php';
	</script>
	";

} else {
	echo " 
	<script>
	alert('Pemesanan Gagal Ditolak');
	document.location.href = 'order-list.php';
	</script>
";
}
 ?>