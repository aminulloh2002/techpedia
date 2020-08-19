//ambil elemen2 yang dibutuhkan menggunakan id
var keyword = document.getElementById('keyword');
var tombolCari = document.getElementById('tombol-cari');
var container = document.getElementById('container');

//tambahkan event ketika keyword ditulis
keyword.addEventListener('keyup', function(){

	// buat objek ajax
	var ajax = new XMLHttpRequest();

	//cek kesiapan ajaxnya
	ajax.onreadystatechange = function() {
		if( ajax.readyState == 4 && ajax.status == 200 ){
			container.innerHTML = ajax.responseText;
		}
	}


	ajax.open('GET', 'js/ajax/barang.php?keyword=' + keyword.value, true);
	ajax.send();

});