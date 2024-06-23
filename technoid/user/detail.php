<?php
session_start();
require '../function/detail.php';

if (isset($_GET['id'])) {
    $produk = detail($_GET['id'])['produk'];
    $judul = detail($_GET['id'])['judul'];
}

if (isset($_POST['cart'])) {
    if (cekLogin() === true) {
        tambahCart($_POST);
    } else {
        $_SESSION['pesan'] = "Anda belum masuk!! Silahkan masuk terlebih dahulu!";
    }
}

require 'templates/header.php'; ?>

<style>
    .product-image-wrapper {
        overflow: hidden;
        position: relative;
        width: 100%;
        padding-top: 100%;
    }
    .product-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        transition: transform 0.5s ease;
    }
    .product-image-wrapper:hover .product-image {
        transform: scale(1.1);
    }
    .product-details h6 {
        font-weight: bold;
    }
    .product-card {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease-in-out;
    }
    .product-card:hover {
        transform: translateY(-10px);
    }
    .btn-buy {
        background-color: #28a745;
        border-color: #28a745;
    }
    .btn-buy:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }
</style>

<div class="container mt-5 pt-5">
    <div class="row">
        <div class="col-md-5">
            <div class="card product-card">
                <div class="card-header text-center bg-white">
                    <div class="product-image-wrapper">
                        <img src="<?= url ?>assets/images/produk/<?= $produk->gambar ?>" alt="Product Image" class="product-image">
                    </div>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item product-details">
                        <div class="row">
                            <div class="col-sm-4">
                                <h6>Nama</h6>
                            </div>
                            <div class="col-sm">: <?= $produk->nama ?></div>
                        </div>
                    </li>
                    <li class="list-group-item product-details">
                        <div class="row">
                            <div class="col-sm-4">
                                <h6>Harga</h6>
                            </div>
                            <div class="col-sm">: Rp<?= number_format($produk->harga) ?></div>
                        </div>
                    </li>
                    <li class="list-group-item product-details">
                        <div class="row">
                            <div class="col-sm-4">
                                <h6>Stok</h6>
                            </div>
                            <div class="col-sm">: <?= $produk->stok ?></div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card product-card">
                <div class="card-header bg-white">
                    <div class="row">
                        <div class="col-2">
                            <h6>Kategori</h6>
                        </div>
                        <div class="col-10">
                            : <?= $produk->kategori ?>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <h6 class="card-title">Deskripsi produk :</h6>
                    <p class="card-text"><?= $produk->deskripsi ?></p>
                    <form method="POST" action="">
                        <input type="hidden" name="id_produk" value="<?= $produk->id_produk ?>">
                        <input type="hidden" name="nama" value="<?= $produk->nama ?>">
                        <input type="hidden" name="harga" value="<?= $produk->harga ?>">
                        <input type="hidden" name="kuantiti" value="1">
                        <input type="hidden" name="gambar" value="<?= $produk->gambar ?>">
                        <input type="hidden" name="kategori" value="<?= $produk->kategori ?>">
                        <button name="cart" class="btn btn-sm btn-success btn-buy">Tambah Keranjang</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require 'templates/footer.php' ?>