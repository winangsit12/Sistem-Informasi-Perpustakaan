<?php

//memulai session php
session_start();

//koneksi ke database
require_once '../config/db.php';

//mengecek apakah yang mengakses halaman ini sudah login
if (!isset($_SESSION["username"])) {
    echo "Anda harus login dulu! <br><a href='../index.php'>Klik disini</a>";
    exit;
}

//melakukan query pada database kategori untuk menampilkan semua data
$queryKategori = mysqli_query($conn, "SELECT * FROM kategori");

//melakukan get query berdasarkan keyword
if (isset($_GET['keyword'])) {
    $queryBuku = mysqli_query($conn, "SELECT * FROM buku WHERE nama_buku LIKE '%$_GET[keyword]%'");
}
//melakukan get query berdasarkan kategori
else if (isset($_GET['kategori'])) {
    $queryGetId = mysqli_query($conn, "SELECT id_kategori FROM kategori WHERE kategori='$_GET[kategori]'");
    $kategoriId = mysqli_fetch_array($queryGetId);
    $queryBuku = mysqli_query($conn, "SELECT * FROM buku WHERE id_kategori = '$kategoriId[id_kategori]'");
}
//melakukan get query default
else {
    $queryBuku = mysqli_query($conn, "SELECT * FROM buku");
}

//memanggil navbar untuk halaman data buku
require_once '../siswa/includes/header.php';

?>

<!-- Banner -->
<div class="container-fluid d-flex align-items-center" style="height: 45vh; 
    background-image: url(../logo/interface_sm.png);
    background-position: 50%, 35%;">
    <div class="container text-center text-white">
        <h1>Daftar Buku</h1>
    </div>
</div>

<!-- body -->
<div class="container py-5">
    <div class="row">
        <div class="col-lg-3 mb-5">
            <h3>Kategori</h3>
            <ul class="list-group">
                <?php while ($kategori = mysqli_fetch_array($queryKategori)) { ?>
                    <a style="text-decoration: none;" href="buku.php?kategori=<?= $kategori['kategori']; ?>">
                        <li class="list-group-item text-dark"><?= $kategori['kategori']; ?></li>
                    </a>
                <?php } ?>
            </ul>
        </div>
        <div class="col-lg-9">
            <h3 class="text-center mb-3">Buku</h3>
            <div class="row">
                <?php while ($buku = mysqli_fetch_array($queryBuku)) { ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <div style="height: 400px;">
                                <img src="../sampul/<?= $buku['sampul_buku']; ?>" class="card-img-top" style="height: 100%; width: 100%; object-fit: cover; object-position: center;">
                            </div>
                            <div class="card-body">
                                <h4 class="card-title"><?= $buku['nama_buku']; ?></h4>
                                <p class="card-text"><?= $buku['pengarang']; ?></p>
                                <a class="btn btn-secondary" href="detail-buku.php?nama=<?= $buku['nama_buku']; ?>">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<?php
//memanggil footer
require_once '../siswa/includes/footer.php';
?>