<?php
function tambahCart($post)
{
    global $konek;

    $id_user = $_SESSION['iduser'];
    $id_produk = $post['id_produk'];
    $nama = $post['nama'];
    $harga = $post['harga'];
    $kuantiti = $post['kuantiti'];
    $gambar = $post['gambar'];
    $kategori = $post['kategori'];
    $total = $harga * $kuantiti;

    $cek = mysqli_query($konek, "SELECT * FROM cart WHERE id_produk='$id_produk' AND id_user='$id_user'");
    if (!$cek) {
        die("Query Error: " . mysqli_error($konek));
    }

    $cekKuantiti = mysqli_fetch_assoc($cek);
    $kuantitiBaru = ($cekKuantiti['kuantiti'] + $kuantiti);
    if (mysqli_num_rows($cek) === 0) {
        $result = mysqli_query($konek, "INSERT INTO cart (id_user, id_produk, nama, harga, kuantiti, gambar, kategori, total) VALUES('$id_user', '$id_produk', '$nama', '$harga', '$kuantiti', '$gambar', '$kategori', '$total')");
        if (!$result) {
            die("Insert Query Error: " . mysqli_error($konek));
        }
    } else {
        $result = mysqli_query($konek, "UPDATE cart SET kuantiti='$kuantitiBaru', total='$harga * $kuantitiBaru' WHERE id_produk='$id_produk' AND id_user='$id_user'");
        if (!$result) {
            die("Update Query Error: " . mysqli_error($konek));
        }
    }

    // Update the session cart count
    $cart_count_result = mysqli_query($konek, "SELECT SUM(kuantiti) as cart_count FROM cart WHERE id_user='$id_user'");
    if ($cart_count_result) {
        $cart_count = mysqli_fetch_assoc($cart_count_result)['cart_count'];
        $_SESSION['cart_count'] = $cart_count;
    } else {
        $_SESSION['cart_count'] = 0;
    }

    $_SESSION['sukses'] = "Barang berhasil ditambahkan ke keranjang";
    return header('location:' . url . 'user/keranjang.php');
}


function ambilCart()
{
    global $konek;

    $id = $_SESSION['iduser'];
    $carts = [];
    $produk = mysqli_query($konek, "
        SELECT c.*, p.stok, p.nama, p.harga, p.gambar, (c.kuantiti * p.harga) as total 
        FROM cart c 
        JOIN produk p ON c.id_produk = p.id_produk 
        WHERE c.id_user='$id'
    ");
    if (!$produk) {
        die("Query Error: " . mysqli_error($konek));
    }

    $subtotal = mysqli_query($konek, "SELECT SUM(c.kuantiti * p.harga) as subtotal 
                                       FROM cart c 
                                       JOIN produk p ON c.id_produk = p.id_produk 
                                       WHERE c.id_user='$id'");
    if (!$subtotal) {
        die("Query Error: " . mysqli_error($konek));
    }

    $kuantiti = mysqli_query($konek, "SELECT SUM(kuantiti) as kuantiti FROM cart WHERE id_user='$id'");
    if (!$kuantiti) {
        die("Query Error: " . mysqli_error($konek));
    }

    while ($hasil = mysqli_fetch_object($produk)) {
        $carts[] = $hasil;
    }
    $data = [
        'carts' => $carts,
        'subtotal' => mysqli_fetch_object($subtotal),
        'kuantiti' => mysqli_fetch_object($kuantiti),
    ];
    return $data;
}

// Kode lainnya...
function ubahCart($post) {
    global $konek;

    $id_cart = $post['idCart'];
    $kuantiti = $post['kuantiti'];
    $total = $post['harga'] * $kuantiti;

    mysqli_query($konek, "UPDATE cart SET kuantiti='$kuantiti', total='$total' WHERE id_cart='$id_cart'");
    $_SESSION['sukses'] = "Barang berhasil diubah";
    return header('location:' . url . 'user/keranjang.php');
}

function hapusCart($post) {
    global $konek;

    $id_cart = $post['idCart'];

    mysqli_query($konek, "DELETE FROM cart WHERE id_cart='$id_cart'");

    $_SESSION['sukses'] = "Barang berhasil dihapus dari keranjang";
    return header('location:' . url . 'user/keranjang.php');
}

function bersihkanCart() {
    global $konek;

    $id_user = $_SESSION['iduser'];

    mysqli_query($konek, "DELETE FROM cart WHERE id_user='$id_user'");

    $_SESSION['sukses'] = "Keranjang berhasil dibersihkan";
    return header('location:' . url . 'user/keranjang.php');
}

