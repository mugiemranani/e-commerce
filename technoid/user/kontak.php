<?php
require '../function/kontak.php';

if (isset($_POST['kontak'])) {
    tambahKontak($_POST);
    die;
}
$judul = ambilKontak()['judul'];
$kontak = ambilKontak()['kontak'];

require 'templates/header.php';
?>
<div class="row mt-5">
    <div class="col-md-8 mx-auto">
        <div class="card p-4">
            <h2 class="text-center mb-4">Contact Form</h2>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="firstname">Nama</label>
                    <input id="firstname" type="text" class="form-control" required name="nama">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="text" class="form-control" required name="email">
                </div>
                <div class="form-group">
                    <label for="tentang">Tentang</label>
                    <input id="tentang" type="text" class="form-control" required name="tentang">
                </div>
                <div class="form-group">
                    <label for="pesan">Deskripsi</label>
                    <textarea id="pesan" class="form-control" required name="pesan"></textarea>
                </div>
                <div class="text-center">
                    <button type="submit" name="kontak" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Kirim </button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="row mt-5">
    <?php foreach ($kontak as $value) : ?>
        <div class="col-md-8 mx-auto">
            <div class="card p-3 mb-3">
                <div class="card-header d-flex align-items-center border-bottom">
                    <h4 class="mb-0"><strong><?= $value['nama'] ?></strong></h4>
                    <p class="mb-0 ml-auto" style="font-size: 12px"><?= $value['tgl'] . " " . $value['email'] ?></p>
                </div>
                <div class="card-body">
                    <p class="mb-0"><?= $value['pesan'] ?></p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php require 'templates/footer.php'; ?>
