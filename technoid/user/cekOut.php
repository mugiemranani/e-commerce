<?php
session_start();
require '../function/cart.php';
require '../function/transaksi.php';

$judul = transaksi()['judul'];

$cartData = ambilCart();
$subtotal = $cartData['subtotal']->subtotal;
$kuantiti = $cartData['kuantiti']->kuantiti;
$carts = $cartData['carts'];

if (isset($_POST['submit'])) {
    tambahTransaksi($_POST);
}

require 'templates/header.php';
?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8">
            <h5 class="mb-3">Pembelian</h5>
            <ul class="list-group list-group-flush mb-4">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>Total Kuantiti</span>
                    <span><?= $kuantiti ?></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>Total Harga</span>
                    <span>Rp<?= number_format($subtotal, 0) ?></span>
                </li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <h5 class="mb-3">Form CheckOut</h5>
            <form action="" method="POST">
                <input type="hidden" name="kuantiti_total" value="<?= $kuantiti ?>">
                <input type="hidden" name="subtotal" value="<?= $subtotal ?>">
                <?php
                $i = 1;
                foreach ($carts as $value): ?>
                    <input type="hidden" name="kuantiti<?= $i ?>" value="<?= $value->kuantiti ?>">
                    <input type="hidden" name="id_produk<?= $i ?>" value="<?= $value->id_produk ?>">
                    <?php $i++; ?>
                <?php endforeach; ?>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="pengirim">Pengirim</label>
                        <select class="form-control" id="pengirim" name="pengirim" required>
                            <option value="" disabled selected>Pilih Ekspedisi</option>
                            <option value="JNE">JNE</option>
                            <option value="TIKI">TIKI</option>
                            <option value="J&T Express">J&T Express</option>
                            <option value="POS Indonesia">POS Indonesia</option>
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="penerima">Penerima</label>
                        <input type="text" class="form-control" id="penerima" name="penerima" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="telp">Telepon Penerima</label>
                        <input type="number" class="form-control" id="telp" name="telepon" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="email">Email Penerima</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat Lengkap" required>
                </div>
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label for="provinsi">Provinsi</label>
                        <select class="form-control" id="provinsi" name="provinsi" required>
                            <option value="" disabled selected>Pilih Provinsi</option>
                        </select>
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="kota">Kota</label>
                        <select class="form-control" id="kota" name="kota" required>
                            <option value="" disabled selected>Pilih Kota</option>
                        </select>
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="detail">Detail Rumah</label>
                        <input type="text" class="form-control" id="detail" name="detail"
                            placeholder="Blok, No Rumah, dll." required>
                    </div>
                </div>
                <button type="submit" name="submit" class="btn btn-primary mt-3">Submit</button>
            </form>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const provinsiSelect = document.getElementById("provinsi");
        const kotaSelect = document.getElementById("kota");

        // Contoh data provinsi dan kota. Anda bisa menggunakan data dari API atau file JSON.
        const data = {
            "provinsi": {
                "Aceh": ["Banda Aceh", "Langsa", "Lhokseumawe", "Meulaboh", "Sabang", "Subulussalam"],
                "Bali": ["Denpasar"],
                "Banten": ["Cilegon", "Serang", "Tangerang", "Tangerang Selatan"],
                "Bengkulu": ["Bengkulu"],
                "Bangka Belitung": ["Pangkalpinang"],
                "Yogyakarta": ["Yogyakarta"],
                "Gorontalo": ["Gorontalo"],
                "Jakarta": ["Jakarta Barat", "Jakarta Pusat", "jakarta Timur", "Jakarta Selatan", "Jakarta Selatan", "Jakarta Utara"],
                "Jambi": ["Sungai Penuh", "Jambi"],
                "Jawa Barat": ["Bandung", "Bekasi", "Bogor", "Cimahi","Cirebon", "Depok", "Sukabumi", "Tasikmalaya", "Banjar"],
                "Jawa Tengah": ["Magelang","Pekalongan", "Salatiga", "Semarang", "Surakarta", "Tegal"],
                "Jawa Timur": ["Batu", "Blitar", "Kediri", "Madiun", "Malang", "Mojokerto", "Pasuruan", "Probolinggo", "Surabaya"],
                "Kalimantan Barat": ["Pontianak", "Singkawang"],
                "Kalimantan Selatan": ["Banjarbaru", "Banjarmasin"],
                "Kalimantan Tengah": ["Palangka Raya"],
                "Kalimantan Timur": ["Balikpapan", "Bontang", "Samarinda", "Nusantara"],
                "Kalimantan Utara": ["Tarakan"],
                "Kepulauan Riau": ["Batam", "TanjungPinang"],
                "Lampung": ["Bandar Lampung", "Metro"],
                "Maluku Utara": ["Ternate", "Tidore Kepulauan"],
                "Maluku": ["Ambon", "Tual"],
                "NTB": ["Bima", "Mataram"],
                "NTT": ["Kupang"],
                "Papua Barat Daya": ["Sorong"],
                "Papua": ["Jayapura"],
                "Riau": ["Dumai", "PekanBaru"],
                "Sulawesi Selatan": ["Makassar", "Palopo", "Parepare"],
                "Sulawesi Tengah": ["Palu"],
                "Sulawesi Tenggara": ["Baubau", "Kendari"],
                "Sulawesi Utara": ["Bitung", "Kotamobagu","Manado", "Tomohon"],
                "Sumatera Barat": ["Bukittinggi", "Padang", "Padang Panjang", "Pariaman", "Payakumbuh", "Sawahlunto", "Solok"],
                "Sumatera Selatan": ["Lubuklinggau", "Pagar Alam", "Palembang", "Prabumulih"],
                "Sumatera Utara": ["Binjai", "Gunungsitoli", "Medan", "Padangsidimpuan", "Pematangsiantar", "Sibolga", "Tanjungbalai", "Tebing Tinggi"],
                
                // Tambahkan data provinsi dan kota lainnya
            }
        };

        // Mengisi pilihan provinsi
        for (let provinsi in data.provinsi) {
            let option = document.createElement("option");
            option.value = provinsi;
            option.textContent = provinsi;
            provinsiSelect.appendChild(option);
        }

        // Mengisi pilihan kota berdasarkan provinsi yang dipilih
        provinsiSelect.addEventListener("change", function () {
            kotaSelect.innerHTML = '<option value="" disabled selected>Pilih Kota</option>';
            let selectedProvinsi = this.value;
            let kotaList = data.provinsi[selectedProvinsi];

            for (let kota of kotaList) {
                let option = document.createElement("option");
                option.value = kota;
                option.textContent = kota;
                kotaSelect.appendChild(option);
            }
        });
    });
</script>

<?php
require 'templates/footer.php';
?>