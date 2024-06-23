<?php
session_start();
require_once '../config/config.php';
require '../function/koneksi.php';
require '../function/transaksi.php';

$transaksiData = ambilTransaksi();
$transaksi = $transaksiData['trans'];

if (isset($_POST['kirim'])) {
    bayar($_POST);
}

if (isset($_POST['terima'])) {
    terimaTransaksi($_POST);
}
if (isset($_POST['batalkan'])) {
    batalkanTransaksi($_POST);
}

require 'templates/header.php';
?>
<div class="row border mt-5 py-3">
    <div class="col-md-12">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">ID PESAN</th>
                    <th scope="col">PENERIMA</th>
                    <th scope="col">PENGIRIM</th>
                    <th scope="col">JUMLAH</th>
                    <th scope="col">TOTAL HARGA</th>
                    <th scope="col" class="text-center">STATUS</th>
                    <th scope="col"></th>
                    <th scope="col"></th> <!-- Tambahan kolom untuk tombol batalkan pesanan -->
                </tr>
            </thead>
            <tbody>
                <?php foreach ($transaksi as $key => $trans): ?>
                    <tr>
                        <th scope="row"><?= $key + 1 ?></th>
                        <td><?= $trans->id_pesan ?></td>
                        <td><?= $trans->penerima ?></td>
                        <td><?= $trans->pengirim ?></td>
                        <td><?= $trans->kuantiti_total ?></td>
                        <td>Rp<?= number_format($trans->total_akhir, 0) ?></td>
                        <td class="text-center">
                            <?php if ($trans->id_status == 0 && $trans->pembayaran == 0): ?>
                                <span class="badge badge-warning">Anda belum melakukan pembayaran</span>
                                <button type="button" class="btn btn-sm btn-warning" data-toggle="modal"
                                    data-target="#bayar<?= $trans->id_pesan ?>">
                                    Bayar
                                </button>
                            <?php elseif ($trans->id_status == 0 && $trans->pembayaran == 1): ?>
                                <span class="badge badge-warning">Menunggu verifikasi</span>
                            <?php elseif ($trans->id_status == 1): ?>
                                <span class="badge badge-secondary"><?= $trans->keterangan ?></span>
                            <?php elseif ($trans->id_status == 2): ?>
                                <span class="badge badge-primary"><?= $trans->keterangan ?></span>
                                <form action="" method="POST">
                                    <input type="hidden" name="idpesan" value="<?= $trans->id_pesan ?>">
                                    <button name="terima" class="mt-1 btn btn-sm btn-primary">Terima</button>
                                </form>
                            <?php elseif ($trans->id_status == 3): ?>
                                <span class="badge badge-success"><?= $trans->keterangan ?></span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm btn-info" data-toggle="modal"
                                data-target="#detail<?= $trans->id_pesan ?>">Detail</button>
                        </td>
                        <td> <!-- Kolom baru untuk tombol batalkan pesanan -->
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                data-target="#batalkan<?= $trans->id_pesan ?>">Batalkan</button>
                        </td>
                    </tr>

                    <!-- Payment Modal -->
                    <div class="modal fade" id="bayar<?= $trans->id_pesan ?>" tabindex="-1"
                        aria-labelledby="bayarLabel<?= $trans->id_pesan ?>" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="bayarLabel<?= $trans->id_pesan ?>">Pembayaran</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="nama">Nama Pengirim</label>
                                            <input type="text" class="form-control" id="nama" name="nama" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="idpesan">ID Pesan</label>
                                            <input type="text" class="form-control" id="idpesan" name="idpesan"
                                                value="<?= $trans->id_pesan ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="nominal">Nominal</label>
                                            <input type="number" class="form-control" id="nominal" name="nominal"
                                                value="<?= $trans->total_akhir ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="bank">Metode Pembayaran</label>
                                            <select class="form-control" id="bank" name="bank" required>
                                                <option value="">Pilih Bank</option>
                                                <option value="mandiri">Bank Mandiri</option>
                                                <option value="bca">Bank BCA</option>
                                                <option value="bni">Bank BNI</option>
                                                <option value="bri">Bank BRI</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="gambar">Bukti Pembayaran</label>
                                            <input type="file" class="form-control" id="gambar" name="gambar" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" name="kirim" class="btn btn-primary">Bayar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Detail Modal -->
                    <div class="modal fade" id="detail<?= $trans->id_pesan ?>" tabindex="-1"
                        aria-labelledby="detailLabel<?= $trans->id_pesan ?>" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="detailLabel<?= $trans->id_pesan ?>">Detail Transaksi</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <?php
                                    $detailData = transaksiDetail($trans->id_pesan);
                                    $details = $detailData['detail'];
                                    ?>
                                    <ul class="list-group">
                                        <?php foreach ($details as $detail): ?>
                                            <li class="list-group-item">
                                                <strong>Produk:</strong> <?= $detail->nama ?><br>
                                                <strong>Kuantiti:</strong> <?= $detail->kuantiti ?><br>
                                                <strong>Harga Total:</strong> Rp<?= number_format($detail->total, 0) ?>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Batalkan Modal -->
                    <div class="modal fade" id="batalkan<?= $trans->id_pesan ?>" tabindex="-1"
                        aria-labelledby="batalkanLabel<?= $trans->id_pesan ?>" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="batalkanLabel<?= $trans->id_pesan ?>">Batalkan Pesanan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Apakah Anda yakin ingin membatalkan pesanan ini?</p>
                                </div>
                                <div class="modal-footer">
                                    <form action="" method="POST">
                                        <input type="hidden" name="idpesan" value="<?= $trans->id_pesan ?>">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                        <button type="submit" name="batalkan" class="btn btn-danger">Ya, Batalkan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require 'templates/footer.php'; ?>
