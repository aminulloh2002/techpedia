<?php 
require 'functions.php';


$id = abs($_GET["id_barang"]);

if( hapus($id) > 0 ) {
	echo " 
	<script>
	alert('data berhasil dihapus!');
	document.location.href = 'table.php';
	</script>
	";

} else {
	echo " 
	<script>
	alert('data gagal dihapus!');
	document.location.href = 'table.php';
	</script>
";
}

 ?>