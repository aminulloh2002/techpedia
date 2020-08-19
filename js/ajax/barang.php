<?php 
require '../../admin-panel/functions.php';
$keyword = $_GET['keyword'];

$barang = query("SELECT * FROM barang WHERE
	merk LIKE '%$keyword%' OR
	tipe LIKE '%$keyword%' OR
	harga LIKE '%$keyword%' OR
	prosesor LIKE '%$keyword%' OR
  	ram LIKE '%$keyword%' OR
  	grafis LIKE '%$keyword%' OR
  	penyimpanan LIKE '%$keyword%'

	");

?>

<div class="row">
    <div class="col-12">
        <div class="product-topbar d-flex align-items-center justify-content-between">
            <!-- Total Products -->
            <div class="total-products">
                <?php if(empty($keyword)) { 
                 echo "";
             }else { ?>
                	<p>Hasil Pencarian : <?= $_GET["keyword"]; ?></p>
                <?php } ?>
                <p><span><?php echo count($barang); ?></span> products found</p>
            </div>
        </div>
    </div>
</div>

<div class="row" >

    <!-- Single Product -->
    <?php foreach ($barang as $brg) : ?>
    <div class="col-12 col-sm-6 col-lg-3">
        <div class="single-product-wrapper">
            <!-- Product Image -->
            <div class="product-img">
               <a href="product-details.php?id=<?= $brg['id_barang']; ?>">
                <img src="admin-panel/img/<?= $brg['gambar']; ?>" alt=""></a>
                

            </div>

            <!-- Product Description -->
            <div class="product-description" >
                <span><?= $brg['merk']; ?></span>
                <a href="product-details.php?id=<?= $brg['id_barang']; ?>">
                    <h6><?= $brg['tipe']; ?></h6>
                </a>
                <p class="product-price"><?= rupiah($brg['harga']); ?></p>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>