<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            background: #457585;
            /* Solid black background */
            color: #fff;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            padding-top: 20px;
        }

        #side-btn {
            text-align: center;
            padding: 10px;
            cursor: pointer;
        }

        #icon {
            font-size: 24px;
            color: #fff;
        }

        .wrap-content {
            padding: 20px;
        }

        .head {
            color: #fff;
            margin-bottom: 20px;
            text-align: center;
        }

        .head img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        .list {
            list-style: none;
            padding: 0;
        }

        .list h5 {
            color: #ccc;
            margin-bottom: 15px;
        }

        .list-item {
            margin-bottom: 10px;
        }

        .list-item a {
            color: #fff;
            /* White color for text */
            text-decoration: none;
            font-size: 16px;
            display: block;
            padding: 10px;
            border-radius: 5px;
            transition: background 0.3s, color 0.3s;
        }

        .list-item a:hover {
            background: #007bff;
            color: #fff;
        }

        .list-item a i {
            margin-right: 10px;
            color: #fff;
            /* White color for icons */
        }

        hr {
            border-top: 1px solid #444;
            margin: 20px 0;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            #side-btn {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="sidebar border-right fixed-left">
        <div id="side-btn">
            <i id="icon" class="fa fa-bars"></i>
        </div>
        <div class="wrap-content">
            <div class="head my-5 text-center">
                <img src="<?= url ?>assets/images/admin.png" alt="Admin Icon">
                <h4>Admin Page</h4>
            </div>
            <ul class="list text-left">
                <h5 class="ml-3 mb-4">Halaman</h5>
                <li class="list-item"><a href="<?= url ?>admin/index.php"><i class="fa fa-dashboard "></i>Dashboard</a>
                </li>
                <li class="list-item"><a href="<?= url ?>admin/produk.php"><i class="fa fa-archive "></i>Produk</a></li>
                <li class="list-item"><a href="<?= url ?>admin/transaksi.php"><i class="fa fa-money "></i>Transaksi</a>
                </li>
                <li class="list-item"><a href="<?= url ?>admin/pengguna.php"><i class="fa fa-user "></i>Pengguna</a>
                </li>
            </ul>
            <hr>
            <ul class="list text-left">
                <h5 class="ml-3 mb-4">Lainnya</h5>
                <li class="list-item"><a href="<?= url ?>admin/profil.php/?id= <?= $_SESSION['iduser'] ?>"><i
                            class="fa fa-user "></i>Profil</a></li>
                <li class="list-item"><a href="<?= url ?>user/keluar.php"><i class="fa fa-sign-out "></i>Keluar</a></li>
            </ul>
        </div>
    </div>
</body>

</html>