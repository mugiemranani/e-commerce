<?php
require '../function/admin.php';

if (cekLoginAdmin() != true) {
    $_SESSION['pesan'] = "Anda belum masuk!! Silahkan masuk terlebih dahulu!";
    header('location:' . url . 'user/masuk.php');
}

$judul = home()['judul'];
$jmlPd = home()['jmlPd'];

$transaksi = home()['trans'];

require 'template_admin/header.php';
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <div class="card-title">
                        <h5>PRODUK</h5>
                    </div>
                    <p class="card-text"><?= $jmlPd ?> Produk</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <div class="card-title">
                        <h5>TERJUAL</h5>
                    </div>
                    <p class="card-text"><?= home()['jual']->jual ?> Produk</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <div class="card-title">
                        <h5>PENGGUNA</h5>
                    </div>
                    <p class="card-text"><?= home()['akun'] ?> Akun</p>
                </div>
            </div>
        </div>
    </div>

    <table class="table table-hover mt-3">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">ID PESAN</th>
                <th scope="col">JUMLAH</th>
                <th scope="col">TOTAL HARGA</th>
                <th scope="col" class="text-center">STATUS</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($transaksi as $key => $value) : ?>
                <tr>
                    <th scope="row"><?= $key + 1 ?></th>
                    <td><?= $value->id_pesan ?></td>
                    <td><?= $value->kuantiti_total ?></td>
                    <td>Rp<?= number_format($value->total_akhir, 0) ?></td>
                    <td class="text-center">
                        <?php if ($value->id_status == 0 && $value->pembayaran == 0) : ?>
                            <span class="badge badge-warning">Menunggu pembayaran</span>
                        <?php elseif ($value->id_status == 0 && $value->pembayaran == 1) : ?>
                            <span class="badge badge-warning">Verifikasi pembayaran</span>
                        <?php elseif ($value->id_status == 2) : ?>
                            <span class="badge badge-primary"><?= $value->keterangan ?></span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="6" class="text-right">
                    <a class="btn btn-link" href="<?= url ?>admin/transaksi.php">Lihat lainnya &raquo;</a>
                </td>
            </tr>
        </tfoot>
    </table>
</div>

<?php require 'template_admin/footer.php'; ?>
