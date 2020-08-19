<?php 
// koneksi ke database
$conn = mysqli_connect("127.0.0.1","root","","db_techpedia");

function query($query){
  global $conn;
  $result = mysqli_query($conn, $query);
  $rows = [];
  while( $row = mysqli_fetch_assoc($result)){
    $rows[] = $row;
  }
  return $rows;
 }


function tambah($data){
	global $conn;

//ambil data dari tiap elemen dari dalam form

	  $mrk = htmlspecialchars($data["merk"]);
    $tp = htmlspecialchars($data["tipe"]);
    $hrg = htmlspecialchars($data["harga"]);
    $psr = htmlspecialchars($data["prosesor"]);
    $rm = htmlspecialchars($data["ram"]);
    $grf = htmlspecialchars($data["grafis"]);
    $pny = htmlspecialchars($data["penyimpanan"]);
    $st = htmlspecialchars($data["stock"]);

    // upload gambar

    $gb = upload();
    if(!$gb ) {
      return false;

    }


    // query insert data
    $query = "INSERT INTO barang VALUES ('','$mrk','$tp','$hrg','$psr','$rm','$grf','$pny','$st','$gb')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);

}




  function rupiah($rp){
  $hasil_rupiah = "Rp ". number_format($rp,2,',','.');
  return $hasil_rupiah;
  } 

  function upload(){

    $namafile = $_FILES['gambar']['name'];
    $ukuranfile = $_FILES ['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpnama = $_FILES ['gambar']['tmp_name'];

    // cek apakah tidak ada gambar yang di apload
    if ( $error === 4) {
      echo "<script>
      alert('pilih gambar terlebih dahulu!');
      </script>";
      return false;
    }

    // cek apakah yang diupload adalah gambar (cek ekstensi gambar)
    $ekstensigambarvalid = ['jpg','jpeg','png'];
    $ekstensigambar = explode(".", $namafile);
    $ekstensigambar = strtolower(end($ekstensigambar) );
    if ( !in_array($ekstensigambar, $ekstensigambarvalid) ){
      echo "<script>
            alert('yang anda upload bukanlah gambar!');
      </script>";
      return false;
    }

    // cek jika ukurannya terlalu besar
    if ( $ukuranfile > 1000000){
      echo "<script>
      alert('ukuran gambar terlalu besar!');
      </script>";
      return false;
    }

    // lolos pengecekan, gambar siap di upload
    // generate nama baru (agar nama tidak tabrakan)
    $namafilebaru = uniqid();
    $namafilebaru .= '.';
    $namafilebaru .= $ekstensigambar;

    move_uploaded_file($tmpnama, 'img/' . $namafilebaru);

    return $namafilebaru;

  }


function edit($data){

	global $conn;

//ambil data dari tiap elemen dari dalam form

	  $id = $data["id"];
	  $mrk = htmlspecialchars($data["merk"]);
    $tp = htmlspecialchars($data["tipe"]);
    $hrg = htmlspecialchars($data["harga"]);
    $psr = htmlspecialchars($data["prosesor"]);
    $rm = htmlspecialchars($data["ram"]);
    $grf = htmlspecialchars($data["grafis"]);
    $pny = htmlspecialchars($data["penyimpanan"]);
    $st = htmlspecialchars($data["stock"]);
    $gblama =htmlspecialchars($data["gambarlama"]);

    // cek apakah user pilih gamabr baru atau tidak
    if($_FILES['gambar']['error'] === 4 ){
      $gb = $gblama;
    }else {
        $gb = upload();
    }



    // query insert data
    $query = "UPDATE barang SET 
    merk = '$mrk',
    tipe = '$tp',
    harga = '$hrg', 
    prosesor = '$psr',
    ram = '$rm',
    grafis = '$grf',
    penyimpanan = '$pny',
    stock = '$st',
    gambar = '$gb'

    WHERE id_barang = $id
    ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

//delete
function hapus($id) {
  global $conn;
  mysqli_query($conn, "DELETE FROM barang 
    WHERE id_barang = $id");

  return mysqli_affected_rows($conn);

}

function accept($id) {
  global $conn;
  mysqli_query($conn, "UPDATE pemesanan SET status = 1 WHERE id_pemesanan = $id");

  return mysqli_affected_rows($conn);

}

function denied($id) {
  global $conn;
  mysqli_query($conn, "UPDATE pemesanan SET status = 2 WHERE id_pemesanan = $id");

  return mysqli_affected_rows($conn);

}

// searching
function cari ($keyword) {

	$query = "SELECT * FROM barang WHERE
	merk LIKE '%$keyword%' OR
	tipe LIKE '%$keyword%' OR
	harga LIKE '%$keyword%' OR
	prosesor LIKE '%$keyword%' OR
  ram LIKE '%$keyword%' OR
  grafis LIKE '%$keyword%' OR
  penyimpanan LIKE '%$keyword%'

	";

	return query($query);
}



function registrasi($data){
  global $conn;

  $username = strtolower(stripslashes($data["username"]));
  $email = strtolower(stripslashes($data["email"]));
  $password = mysqli_real_escape_string($conn,$data["password"]);
  $password2 = mysqli_real_escape_string($conn,$data["password2"]);

  // cek username sudah ada atau belum
  $result = mysqli_query($conn, "SELECT username FROM admin 
            WHERE username = '$username'");
  if( mysqli_fetch_assoc($result) ){
    echo "<script>
          alert('username sudah terdaftar!');
          </script>";
          return false;
  }

  // cek konfirmasi password
    if ( $password !== $password2 ) {
    echo "<script> 
            alert ('konfirmasi password tidak sama!');
            </script>";

      return false;
  }


  // enkripsi password
   $password = password_hash($password, PASSWORD_DEFAULT);

  // tambahkan userbaru ke database
   mysqli_query($conn, "INSERT INTO admin VALUES('', '$username','$email','$password')");

   return mysqli_affected_rows ($conn);
}


function admubahpass($data){
  global $conn;
  $id = $_SESSION["id"];
  $pass = $_SESSION["password"];

  $passwordlama = mysqli_real_escape_string($conn,$data["passwordlama"]);
  $passwordbaru = mysqli_real_escape_string($conn,$data["passwordbaru"]);
  $passwordbaru2 = mysqli_real_escape_string($conn,$data["passwordbaru2"]);

    // cek konfirmasi password
    if ( $passwordbaru !== $passwordbaru2 ) {
    echo "<script> 
            alert ('konfirmasi password tidak sesuai!');
          </script>";

      return false;
    } 


  if($passwordlama != $pass){

       echo "<script>
          alert('Password lama tidak sesuai');
          </script>";
          return false;
  }
   if( $passwordlama = $pass ){
      // enkripsi password
    $_SESSION["password"] = $passwordbaru;

   $passwordbaru = password_hash($passwordbaru, PASSWORD_DEFAULT);

    // tambahkan userbaru ke database
   mysqli_query($conn,"UPDATE admin SET password = '$passwordbaru' WHERE id='$id'");

   return mysqli_affected_rows ($conn);
  }

   
}


 ?>
