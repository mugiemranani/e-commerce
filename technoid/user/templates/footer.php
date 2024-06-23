<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-****" crossorigin="anonymous" />
    <style>
        /* Footer */
        footer {
            background-color: #4682B4;
            color: white;
            padding: 40px 0;
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-links {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .footer-col {
            width: 25%;
            padding: 0 15px;
        }

        .footer-col h3 {
            font-size: 18px;
            color: whitesmoke;
            margin-bottom: 20px;
            font-weight: 500;
            position: relative;
        }

        .footer-col ul li:not(:last-child) {
            margin-bottom: 10px;
        }

        .footer-col ul li a {
            font-size: 16px;
            text-decoration: none;
            font-weight: 300;
            color: whitesmoke;
            display: block;
            transition: all 0.3s ease;
        }

        .footer-col ul li a:hover {
            color: red;
            padding-left: 8px;
        }

        .footer-col .social-links a {
            display: inline-block;
            height: 40px;
            width: 40px;
            background-color: rgba(255, 255, 255, 0.2);
            margin: 0 10px 10px 0;
            text-align: center;
            line-height: 40px;
            border-radius: 50%;
            color: #333;
            transition: all 0.5s ease;
        }

        .footer-col .social-links a:hover {
            color: whitesmoke;
            background-color: #ffffff;
        }

        .footer-bottom {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #ccc;
            color: #333;
        }

        @media(max-width: 767px) {
            .footer-col {
                width: 50%;
                margin-bottom: 30px;
            }
        }

        @media(max-width: 574px) {
            .footer-col {
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <footer>
        <div class="footer-container">
            <div class="footer-links">
                <div class="footer-col">
                    <h3>Kategori</h3>
                    <ul>
                        <li><a href="#">Ponsel</a></li>
                        <li><a href="#">Laptop</a></li>
                        <li><a href="#">Komputer</a></li>
                        
                    </ul>
                </div>
                <div class="footer-col">
                    <h3>Halaman</h3>
                    <ul>
                        <li><a href="#">Beranda</a></li>
                        <li><a href="#">Tentang</a></li>
                        <li><a href="#">Kontak</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h3>Otentikasi</h3>
                    <ul>
                        <li><a href="#">Masuk</a></li>
                        <li><a href="#">Register</a></li>
                        
                    </ul>
                </div>
                <div class="footer-col">
                    <h3>Let's Stay Connected</h3>
                    <p>Enter your email to unlock 10% OFF:</p>
                    <input type="email" placeholder="Your Email">
                    <button type="submit">SUBMIT</button>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2024| TecnhnoSphere|</p>
            </div>
        </div>
    </footer>

    <div class="modal fade" id="masuk" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="float-right mr-2">&times;</span>
                </button>
                <h4 class="modal-title text-center">MASUK</h4>
                <div class="modal-body">
                    <form class="w-75 py-4 m-auto" action="" method="POST">
                        <div class="form-group">
                            <label for="Email">Email</label>
                            <input type="email" class="form-control" id="Email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="password">Kata Sandi</label>
                            <div class="input-group">
                                <input type="password" class="form-control border-right-0" id="password" name="sandi"
                                    autocomplete="off">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-white border-left-0" id="btn-pwd"
                                        style="cursor: pointer"><i id="eye" class="fa fa-eye"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button name="masuk" type="submit" class="btn btn-primary w-100">Masuk</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Pembayaran -->

    <?php if (isset($transaksi) && is_array($transaksi)): ?>
        <?php foreach ($transaksi as $key => $trans): ?>
            <?php if (is_object($trans)): ?>
                <div class="modal fade" id="bayar<?= $trans->id_pesan ?>" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5>ID Pesan : <?= $trans->id_pesan ?> | Penerima : <?= $trans->penerima ?> </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="POST" action="" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <input type="hidden" name="idpesan" value="<?= $trans->id_pesan ?>">
                                    <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <input class="form-control" type="text" name="nama" id="nama">
                                    </div>
                                    <div class="form-group">
                                        <label for="nominal">Nominal</label>
                                        <input class="form-control" type="number" name="nominal" id="nominal">
                                    </div>
                                    <div class="form-group">
                                        <label for="gambar">Unggah bukti pembayaran</label>
                                        <input class="form-control" type="file" name="gambar" id="gambar">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Batal</button>
                                    <button type="submit" name="kirim" class="btn btn-sm btn-primary">Kirim</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal Detail -->
                <div class="modal fade" id="detail<?= $trans->id_pesan ?>" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content ">
                            <div class="modal-header">
                                <h5>ID Pesan : <?= $trans->id_pesan ?> | Penerima : <?= $trans->penerima ?> </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col" style="width: 10%">Gambar</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Kuantiti</th>
                                            <th scope="col">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $id = $trans->id_pesan;
                                        $transaksiDetail = transaksiDetail($id);
                                        if (isset($transaksiDetail['detail']) && is_array($transaksiDetail['detail'])):
                                            $trDetail = $transaksiDetail['detail'];
                                            foreach ($trDetail as $key => $detail): ?>
                                                <tr class="border-bottom">
                                                    <th scope="row"><?= $key + 1 ?></th>
                                                    <td><img src="<?= url ?>assets/images/produk/<?= $detail->gambar ?>" class="w-100"
                                                            alt=""></td>
                                                    <td><?= $detail->nama ?></td>
                                                    <td><?= $detail->kuantiti ?></td>
                                                    <td>Rp<?= number_format($detail->total, 0) ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="5">No details found</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td class="text-uppercase">Status : <?= $trans->keterangan ?></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div>Error: Transaction is not an object.</div>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php else: ?>
        <div></div>
    <?php endif; ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?= url ?>assets/js/jquery-3.5.1.js" crossorigin="anonymous"></script>
    <script src="<?= url ?>assets/js/pooper.js" crossorigin="anonymous"></script>
    <script src="<?= url ?>assets/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script src="<?= url ?>assets/js/sweetalert2.all.js" crossorigin="anonymous"></script>
    <!-- Custom Javascript -->
    <script src="<?= url ?>assets/js/custom.js" crossorigin="anonymous"></script>

</body>

</html>