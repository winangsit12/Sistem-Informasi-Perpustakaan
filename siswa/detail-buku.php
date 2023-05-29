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

//melakukan query untuk menampilkan detail buku
$nama = $_GET['nama'];
$queryBuku = mysqli_query($conn, "SELECT * FROM buku LEFT JOIN kategori ON buku.id_kategori = kategori.id_kategori WHERE nama_buku='$nama'");
$buku = mysqli_fetch_array($queryBuku);

//melakukan query untuk menampilkan buku terkait
$queryBukuTerkait = mysqli_query($conn, "SELECT * FROM buku WHERE id_kategori='$buku[id_kategori]'
AND id_buku!='$buku[id_buku]' LIMIT 4");

//melakukan query untuk limit peminjaman
$id_user = $_SESSION['id_user'];
$queryLimitPinjam = mysqli_query($conn, "SELECT COUNT(id_pinjam) FROM peminjaman
LEFT JOIN buku ON peminjaman.id_buku = buku.id_buku
LEFT JOIN kategori ON buku.id_kategori = kategori.id_kategori
WHERE kategori != 'Mata Pelajaran'
AND id_user = $id_user
AND id_level = 2");
$limit = mysqli_fetch_array($queryLimitPinjam);

//melakuakn query tidak bisa meminjam buku yang sama dalam 1 masa peminjaman
$queryLimitSama = mysqli_query($conn, "SELECT id_buku FROM peminjaman WHERE id_user = $id_user");
$limitSama = mysqli_fetch_array($queryLimitSama);

//memanggil navbar untuk halaman data buku
require_once '../siswa/includes/header.php';
?>

<!-- detail buku -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-5 mb-5">
                <img src="../sampul/<?= $buku['sampul_buku']; ?>" class="w-100">
            </div>
            <div class="col-lg-6 offset-lg-1">
                <?php if ($buku['kategori'] == "Mata Pelajaran") { ?>
                    <h1><?= $buku['nama_buku']; ?></h1>
                    <p class="fs-5">Pengarang: <?= $buku['pengarang']; ?></p>
                    <p class="fs-5">Penerbit: <?= $buku['penerbit']; ?></p>
                    <p class="fs-5">Tahun Terbit: <?= $buku['tahun_terbit']; ?></p>
                    <p class="fs-5">Deskripsi <br><?= $buku['deskripsi']; ?></p>
                    <p class="fs-5">Sinopsis <br><?= $buku['sinopsis']; ?></p>
                    <?php if ($limitSama['id_buku'] == $buku['id_buku']) { ?>
                        <br class="fs-5">Anda sudah dalam masa peminjaman buku ini</p>
                    <?php } else if ($buku['jumlah'] < 1) { ?>
                        <br class="fs-5">Stok habis </br> Buku sedang dalam masa peminjaman siswa lain</p>
                    <?php } else { ?>
                        <form action="../proses/pinjam_buku_proses.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id_buku" value="<?= $buku['id_buku']; ?>">
                            <input type="hidden" name="id_user">
                            <input type="hidden" name="tanggal_pinjam">
                            <input type="hidden" name="id_level" value="1">
                            <input type="hidden" name="minus" value="1">
                            <button class="btn btn-outline-secondary" type="submit">Pinjam</button>
                        </form>
                    <?php } ?>
                <?php } else { ?>
                    <h1><?= $buku['nama_buku']; ?></h1>
                    <p class="fs-5">Pengarang: <?= $buku['pengarang']; ?></p>
                    <p class="fs-5">Penerbit: <?= $buku['penerbit']; ?></p>
                    <p class="fs-5">Tahun Terbit: <?= $buku['tahun_terbit']; ?></p>
                    <p class="fs-5">Deskripsi <br><?= $buku['deskripsi']; ?></p>
                    <p class="fs-5">Sinopsis <br><?= $buku['sinopsis']; ?></p>
                    <?php if ($limitSama['id_buku'] == $buku['id_buku']) { ?>
                        <br class="fs-5">Anda sudah dalam masa peminjaman buku ini</p>
                    <?php } else if ($limit['COUNT(id_pinjam)'] > 1) { ?>
                        <br class="fs-5">Anda sudah mencapai limit peminjaman buku selain kategori mata pelajaran </br> Silahkan selesaikan masa peminjaman untuk meminjam buku baru</p>
                    <?php } else if ($buku['jumlah'] < 1) { ?>
                        <br class="fs-5">Stok habis </br> Buku sedang dalam masa peminjaman siswa lain</p>
                    <?php } else { ?>
                        <form action="../proses/pinjam_buku_proses.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id_buku" value="<?= $buku['id_buku']; ?>">
                            <input type="hidden" name="id_user">
                            <input type="hidden" name="tanggal_pinjam">
                            <input type="hidden" name="id_level" value="1">
                            <input type="hidden" name="minus" value="1">
                            <button class="btn btn-outline-secondary" type="submit">Pinjam</button>
                        </form>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<!-- buku terkait -->
<div class="container-fluid py-5 bg-secondary">
    <div class="container">
        <h2 class="text-center text-white mb-5">Buku Terkait</h2>
        <div class="row">
            <?php while ($data = mysqli_fetch_array($queryBukuTerkait)) { ?>
                <div class="col-md-6 col-lg-3 mb-3">
                    <a href="detail-buku.php?nama=<?= $data['nama_buku']; ?>">
                        <img src="../sampul/<?= $data['sampul_buku']; ?>" class="img-fluid img-thumbnail" style="height: 100%; width: 100%; object-fit: cover; object-position: center;">
                    </a>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<?php
//memanggil footer
require_once '../siswa/includes/footer.php';
?>