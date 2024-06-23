<?php
session_start();
require '../function/koneksi.php';
require '../function/pengguna.php';

$profil = profil();
if (!$profil) {
    die("Error fetching profile data");
}

$judul = htmlspecialchars($profil['judul'], ENT_QUOTES, 'UTF-8');
$user = $profil['pengguna'];

require 'templates/header.php';
?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h2 class="font-weight-bold"><?= $judul ?></h2>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item text-center">
                            <img src="<?= htmlspecialchars(url . 'assets/images/user/' . $user->image, ENT_QUOTES, 'UTF-8') ?>" alt="User Image" class="img-fluid rounded-circle" style="width: 150px; height: 150px;">
                        </li>
                        <li class="list-group-item">
                            <h6 class="font-weight-bold">Nama</h6>
                            <p><?= htmlspecialchars($user->nama, ENT_QUOTES, 'UTF-8') ?></p>
                        </li>
                        <li class="list-group-item">
                            <h6 class="font-weight-bold">Email</h6>
                            <p><?= htmlspecialchars($user->email, ENT_QUOTES, 'UTF-8') ?></p>
                        </li>
                        <li class="list-group-item">
                            <h6 class="font-weight-bold">Terakhir masuk</h6>
                            <p><?= htmlspecialchars($_SESSION['tglMasuk'], ENT_QUOTES, 'UTF-8') ?></p>
                        </li>
                        <li class="list-group-item">
                            <h6 class="font-weight-bold">Daftar pada</h6>
                            <p><?= htmlspecialchars($user->createat, ENT_QUOTES, 'UTF-8') ?></p>
                        </li>
                        <li class="list-group-item">
                            <h6 class="font-weight-bold">Di perbarui pada</h6>
                            <p><?= htmlspecialchars($user->updateat, ENT_QUOTES, 'UTF-8') ?></p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require 'templates/footer.php'; ?>
