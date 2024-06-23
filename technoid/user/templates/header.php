<?php
if (isset($_POST['masuk'])) {
    masuk($_POST);
}

// Ambil jumlah item dalam keranjang dari sesi atau database
if (isset($_SESSION['cart'])) {
    $jumlahItem = count($_SESSION['cart']);
} else {
    $jumlahItem = 0;
}
if (isset($_SESSION['cart_count'])) {
    $jumlahItem = $_SESSION['cart_count'];
} else {
    $jumlahItem = 0;
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= url ?>assets/css/bootstrap.min.css" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= url ?>assets/font-awesome/css/font-awesome.min.css" crossorigin="anonymous">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= url ?>assets/css/custom.css" crossorigin="anonymous">

    <title><?= $judul ?></title>

    <style>
        .topbar {
            color: white;
            padding: 10px 0;
        }

        .topbar p {
            margin: 0;
        }

        .navbar {
            background-color: #4682B4;
            /* Steel Blue */
        }

        .navbar-nav .nav-link {
            color: white !important;
        }

        .navbar-nav .nav-link:hover {
            color: #FFD700 !important;
            /* Gold */
        }

        .navbar-toggler {
            border-color: white;
        }

        .navbar-toggler .fa-bars {
            color: white;
        }

        .cari .form-control {
            border-radius: 0;
        }

        .cari .btn {
            border-radius: 0;
        }

        .navbar-nav .nav-item .nav-link {
            font-size: 18px;
        }

        .d-flex.align-items-center {
            display: flex;
            align-items: center;
        }

        .d-flex.align-items-center .nav-link {
            color: white !important;
            margin-right: 10px;
        }

        .d-flex.align-items-center .nav-link:last-child {
            margin-right: 0;
        }

        .cart-count {
            position: absolute;
            top: 10px;
            right: 10px;
            background: red;
            color: white;
            border-radius: 50%;
            padding: 2px 8px;
            font-size: 12px;
        }
    </style>
</head>

<body class="bg-light">

    <div class="modal fade" id="Modal_login" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- Login form content -->
            </div>
        </div>
    </div>

    <div class="modal fade" id="Modal_register" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- Registration form content -->
            </div>
        </div>
    </div>

    <?php if (isset($_SESSION['pesan'])): ?>
        <div id="pesan" data-pesan="<?= $_SESSION['pesan'] ?>"></div>
        <?php unset($_SESSION['pesan']) ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['sukses'])): ?>
        <div id="cart-sukses" data-sukses="<?= $_SESSION['sukses'] ?>"></div>
        <?php unset($_SESSION['sukses']) ?>
    <?php endif; ?>

    <nav class="navbar navbar-expand-lg shadow-sm">
        <a class="navbar-brand" href="<?= url ?>user/index.php"
            style="font-size: 28px; color: #ffffff;">TechnoSphere</a>
        <div id="nav-btn" class="navbar-toggler m-auto" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false">
            <i id="icon" class="fa fa-bars"></i>
        </div>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto" style="font-size: 18px;">
                <li class="nav-item">
                    <a class="nav-link" href="<?= url ?>user/index.php" style="font-size: 18px;"><i
                            class="fa fa-home"></i> Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= url ?>user/produk.php" style="font-size: 18px;"><i
                            class="fa fa-box"></i> Produk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= url ?>user/tentang.php" style="font-size: 18px;"><i
                            class="fa fa-book"></i> Blog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= url ?>user/kontak.php" style="font-size: 18px;"><i
                            class="fa fa-info-circle"></i> Testimoni</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= url ?>" style="font-size: 18px;"><i
                            class="fa fa-credit-card"></i></a>
                </li>
            </ul>
            <div class="d-flex align-items-center">
                <div class="cari mr-3">
                    <form class="form-inline float-right" action="<?= url ?>user/produk.php/?cari=">
                        <input class="form-control mr-sm-2" type="search" placeholder="Cari" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i
                                class="fa fa-search"></i></button>
                    </form>
                </div>
                <a href="<?= url ?>user/keranjang.php" class="nav-link position-relative">
                    <i class="fa fa-shopping-cart"></i>
                    <?php if ($jumlahItem > 0): ?>
                        <span class="cart-count"><?= $jumlahItem ?></span>
                    <?php endif; ?>
                </a>
                <a href="<?= url ?>user/bayar.php" class="nav-link" style="color: white;"><i class="fa fa-credit-card"></i>Transaksi</a>
                <?php if (isset($_SESSION['nama'])): ?>
                    <a href="<?= url ?>user/profil.php" class="nav-link" style="color: white;"><i class="fa fa-user"></i>
                        Profil</a>
                    <a href="<?= url ?>user/keluar.php" class="nav-link" style="color: white;"><i
                            class="fa fa-sign-out-alt"></i> Keluar</a>
                <?php else: ?>
                    <a class="nav-link" style="color: white; cursor: pointer;" data-toggle="modal" data-target="#masuk"><i
                            class="fa fa-sign-in-alt"></i> Masuk</a>
                    <a href="<?= url ?>user/daftar.php" class="nav-link" style="color: white;"><i
                            class="fa fa-user-plus"></i> Daftar</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <div class="container bg-white ">
        <!-- Konten utama di sini -->
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?= url ?>assets/js/jquery-3.5.1.js" crossorigin="anonymous"></script>
    <script src="<?= url ?>assets/js/popper.js" crossorigin="anonymous"></script>
    <script src="<?= url ?>assets/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script src="<?= url ?>assets/js/sweetalert2.all.js" crossorigin="anonymous"></script>
    <!-- Custom Javascript -->
    <script src="<?= url ?>assets/js/custom.js" crossorigin="anonymous"></script>
</body>

</html>