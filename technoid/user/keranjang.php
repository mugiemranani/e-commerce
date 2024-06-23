<?php
session_start();
require '../function/koneksi.php';
require '../function/cart.php';

$cartData = ambilCart();
$cart = $cartData['carts'];
$subtotal = $cartData['subtotal']->subtotal;
$cart_count = $cartData['kuantiti']->kuantiti;

$_SESSION['cart_count'] = $cart_count;

if (isset($_POST['ubahCart'])) {
    ubahCart($_POST);
} else if (isset($_POST['hapusCart'])) {
    hapusCart($_POST);
} else if (isset($_POST['bersihkanCart'])) {
    bersihkanCart($_POST);
}

require 'templates/header.php';
?>

<head>
    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>

<body>
    <!-- SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
</body>

<div class="row border mt-5 py-3">
    <div class="col-md-12">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col" style="width: 10%">Gambar</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Harga</th>
                    <th scope="col" style="width: 10%">Kuantiti</th>
                    <th scope="col">Stok</th>
                    <th scope="col">Total Harga</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cart as $key => $value): ?>
                    <tr>
                        <th scope="row"><?= $key + 1 ?></th>
                        <td><img style="width: 100%" src="<?= url ?>assets/images/produk/<?= $value->gambar ?>" alt=""></td>
                        <td><a href="<?= url ?>user/produk.php/?id=<?= $value->id_produk ?>"><?= $value->nama ?></a></td>
                        <td>Rp<?= number_format($value->harga, 0) ?></td>
                        <form action="" method="POST">
                            <td>
                                <input class="form-control w-100 quantity-input" min="1" max="<?= $value->stok ?>"
                                    type="number" name="kuantiti" value="<?= $value->kuantiti ?>"
                                    data-price="<?= $value->harga ?>" data-stok="<?= $value->stok ?>"
                                    data-total-id="total-<?= $key ?>">
                            </td>
                            <td><?= $value->stok ?></td>
                            <td id="total-<?= $key ?>">Rp<?= number_format($value->total, 0) ?></td>
                            <td>
                                <input type="hidden" name="idCart" value="<?= $value->id_cart ?>">
                                <input type="hidden" name="harga" value="<?= $value->harga ?>">
                                <button name="hapusCart" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                <button name="ubahCart" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>
                            </td>
                        </form>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td>Total :</td>
                    <td id="subtotal">Rp<?= number_format($subtotal, 0) ?></td>
                </tr>
                <tr>
                    <form action="keranjang.php" method="POST">
                        <td><button type="submit" name="bersihkanCart" class="btn btn-sm btn-success">Bersihkan isi
                                keranjang</button></td>
                    </form>

                    <td><button class="btn btn-sm btn-success" id="checkout-btn">Checkout</button></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const quantityInputs = document.querySelectorAll('.quantity-input');
        quantityInputs.forEach(function (input) {
            input.addEventListener('input', function () {
                const price = parseFloat(this.dataset.price);
                const quantity = parseInt(this.value);
                const totalElement = document.getElementById(this.dataset.totalId);
                const newTotal = price * quantity;

                totalElement.textContent = 'Rp' + newTotal.toLocaleString('id-ID');

                updateSubtotal();
            });
        });

        function updateSubtotal() {
            let subtotal = 0;
            quantityInputs.forEach(function (input) {
                const price = parseFloat(input.dataset.price);
                const quantity = parseInt(input.value);
                subtotal += price * quantity;
            });
            document.getElementById('subtotal').textContent = 'Rp' + subtotal.toLocaleString('id-ID');
        }

        document.getElementById('checkout-btn').addEventListener('click', function (event) {
            let valid = true;
            quantityInputs.forEach(function (input) {
                const stok = parseInt(input.dataset.stok);
                const kuantiti = parseInt(input.value);
                if (kuantiti > stok) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Stok Tidak Cukup',
                        text: `Maaf, stok yang tersedia untuk produk ini sisa ${stok}.`
                    });
                    valid = false;
                }
            });
            if (valid) {
                window.location.href = "<?= url ?>user/cekOut.php";
            }
        });
    });
</script>

<?php require 'templates/footer.php'; ?>
