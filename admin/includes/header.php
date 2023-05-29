<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Admin | Perpustakaan SMA 4 Purwokerto</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
        <div class="container">
            <a class="navbar-brand" href="../admin/index.php">
                <img src="../logo/logo.png" alt="Logo" width="" height="40" class="d-inline-block align-text-top">
            </a>
            <div class="" id="navbarNav">
                <ul class="nav navbar-nav justify-content-end">
                    <li class="nav-item">
                        <a class="nav-link" href="../admin/index.php">Dashboard</span></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Data Buku
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="../admin/data-buku.php">Daftar Buku</a>
                            <a class="dropdown-item" href="../admin/data-kategori.php">Daftar Kategori</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Data User
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="../admin/data-admin.php">Daftar Admin</a>
                            <a class="dropdown-item" href="../admin/data-siswa.php">Daftar Siswa</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Pinjam
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="../admin/data-minta.php">Permintaan</a>
                            <a class="dropdown-item" href="../admin/data-pinjam.php">Peminjaman</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Kembali
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="../admin/data-kembali.php">Pengembalian</a>
                            <a class="dropdown-item" href="../admin/data-hilang.php">Buku Tidak Kembali</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-danger btn-sm text-white" href=" ../admin/logout.php">Keluar</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>