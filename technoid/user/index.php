<?php
require '../function/home.php';
$judul = home()['judul'];
$produk = home()['produk'];

//keranjang
if (isset($_POST['cart'])) {
    if (cekLogin() === true) {
        tambahCart($_POST);
    } else {
        $_SESSION['pesan'] = "Anda belum masuk!! Silahkan masuk terlebih dahulu!";
    }
}



require 'templates/header.php';
?>

<div id="carouselExampleIndicators" class="carousel slide mt-0" data-ride="carousel">
    <!-- Mengubah nilai margin top menjadi 0 -->
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="<?= url ?>assets/images/pages/car-1.jpg" class="d-block w-100 img-fluid custom-carousel-image"
                alt="...">
        </div>
        <div class="carousel-item">
            <img src="<?= url ?>assets/images/pages/car-2.jpg" class="d-block w-100 img-fluid custom-carousel-image"
                alt="...">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>




<!-- Produk Baru -->
<div class="mt-3">
    <h5 class="text-uppercase">Produk Baru</h5>
    <div class="produk-front border-top bg-light">
        <?php foreach ($produk as $value): ?>
            <div class="col-md-2 card-produk shadow-sm m-1 bg-white hover-effect">
                <div class="card-img" style="height: 50%;">
                    <!-- Atur lebar maksimal gambar -->
                    <img src="<?= url ?>assets/images/produk/<?= $value->gambar ?>" class="img-fluid"
                        style="max-width: 100%;" alt="...">
                </div>
                <div class="card-body" style="height: 25%;">
                    <h6 class=""><?= $value->nama ?></h6>
                    <p>Rp<?= number_format($value->harga, 0) ?></p>
                </div>
                <div class="d-flex justify-content-around p-2 w-75 border-top m-auto">
                    <a href="<?= url ?>user/detail.php/?id=<?= $value->id_produk ?>"
                        class="btn btn-sm btn-info mr-1 btn-detail">Detail</a>
                    <form method="POST" action="">
                        <input type="hidden" name="id_produk" value="<?= $value->id_produk ?>">
                        <input type="hidden" name="nama" value="<?= $value->nama ?>">
                        <input type="hidden" name="harga" value="<?= $value->harga ?>">
                        <input type="hidden" name="kuantiti" value="1">
                        <input type="hidden" name="gambar" value="<?= $value->gambar ?>">
                        <input type="hidden" name="kategori" value="<?= $value->kategori ?>">
                        <button name="cart" class="btn btn-sm btn-success btn-beli">Beli</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- CSS -->
<style>
    .hover-effect .card-img {
        transition: transform 0.3s ease;
        /* Efek transisi untuk gerakan saat disentuh */
    }

    .hover-effect:hover .card-img {
        transform: translateY(-5px);
        /* Menggeser gambar ke atas saat disentuh */
    }

    .hover-effect a,
    .hover-effect button {
        transition: transform 0.3s ease;
        /* Efek transisi untuk gerakan saat disentuh */
    }

    .hover-effect:hover a,
    .hover-effect:hover button {
        transform: translateY(-3px);
        /* Menggeser tombol ke atas saat disentuh */
    }

    .carousel-item {
        display: flex;
        justify-content: center;
    }


    .img-small {
        max-width: 500px;
        /* Sesuaikan dengan lebar maksimum yang diinginkan */
        max-height: 350px;
        /* Sesuaikan dengan tinggi maksimum yang diinginkan */
        width: auto;
        height: auto;
    }

    .custom-carousel-image {
        height: 500px;
        /* Set the desired height */
        object-fit: cover;
        /* Ensures the image covers the entire element without distortion */
    }
</style>

<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">


        <div class="carousel-item active">
            <img class="d-block img-fluid img-small" src="<?= url ?>assets/images/pages/ban1.jpg" alt="First slide">
        </div>
        <div class="carousel-item">
            <img class="d-block img-fluid img-small" src="<?= url ?>assets/images/pages/ban3.png" alt="Second slide">

        </div>
        <div class="carousel-item">
            <img class="d-block img-fluid img-small" src="<?= url ?>assets/images/pages/ban2.jpg" alt="Third slide">
        </div>
        <div class="carousel-item">
            <img class="d-block img-fluid img-small" src="<?= url ?>assets/images/pages/ban4.png" alt="Fourth slide">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>


<!-- Produk Baru -->
<div class="mt-3">
    <h5 class="text-uppercase">Produk Baru</h5>
    <div class="produk-front border-top bg-light">
        <?php foreach ($produk as $value): ?>
            <div class="col-md-2 card-produk shadow-sm m-1  bg-white">
                <div class="card-img" style=" height:50%;">
                    <img src="<?= url ?>assets/images/produk/<?= $value->gambar ?>" class="img-fluid " style="width: 100%;"
                        transition: transform 0.5s; alt="..." onmouseover="this.style.transform='scale(1.1)'"
                        onmouseout="this.style.transform='scale(1)'">
                </div>
                <div class="card-body" style="height: 25%;">
                    <h6 class=""><?= $value->nama ?></h6>
                    <p>Rp<?= number_format($value->harga, 0) ?></p>
                </div>
                <div class="d-flex justify-content-around p-2 w-75 border-top m-auto">
                    <a href="<?= url ?>user/detail.php/?id=<?= $value->id_produk ?>"
                        class="btn btn-sm btn-info mr-1 ">Detail</a>
                    <form method="POST" action="">
                        <input type="hidden" name="id_produk" value="<?= $value->id_produk ?>">
                        <input type="hidden" name="nama" value="<?= $value->nama ?>">
                        <input type="hidden" name="harga" value="<?= $value->harga ?>">
                        <input type="hidden" name="kuantiti" value="1">
                        <input type="hidden" name="gambar" value="<?= $value->gambar ?>">
                        <input type="hidden" name="kategori" value="<?= $value->kategori ?>">
                        <button name="cart" class="btn btn-sm btn-success">Beli</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?= require 'templates/footer.php'; ?>