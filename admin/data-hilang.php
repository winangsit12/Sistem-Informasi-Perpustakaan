<?php

//memulai session php
session_start();
ob_start();

//koneksi ke database
require_once '../config/db.php';

//mengecek apakah yang mengakses halaman ini sudah login
if (!isset($_SESSION["username"])) {
    echo "Anda harus login dulu! <br><a href='../index.php'>Klik disini</a>";
    exit;
}

$id_level = $_SESSION["id_level"];

if ($id_level != 1) {
    echo "Anda tidak punya akses pada halaman admin";
    exit;
}

//membuat pagination
$batas = 8;
$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

$previous = $halaman - 1;
$next = $halaman + 1;

$dataPage = mysqli_query($conn, "SELECT * FROM hilang");
$jumlah_data = mysqli_num_rows($dataPage);
$total_halaman = ceil($jumlah_data / $batas);

//no urut increment pada tampilan data hilang
$no = $halaman_awal + 1;

//melakukan query pada database hilang
if (isset($_GET['cari'])) {
    $sql = "SELECT tanggal_pinjam, status_peminjam, keterangan, buku.nama_buku, users.nama, users.username, users.kelas FROM hilang
    LEFT JOIN buku ON buku.id_buku = hilang.id_buku
    LEFT JOIN users ON users.id_user = hilang.id_user 
    WHERE buku.nama_buku LIKE '%" . $_GET['cari'] . "%' 
    OR users.nama LIKE '%" . $_GET['cari'] . "%'
    ORDER BY id_hilang DESC";
    $query = $conn->query($sql);
} else {
    $sql = "SELECT tanggal_pinjam, status_peminjam, keterangan, buku.nama_buku, users.nama, users.username, users.kelas FROM hilang
    LEFT JOIN buku ON buku.id_buku = hilang.id_buku
    LEFT JOIN users ON users.id_user = hilang.id_user
    ORDER BY id_hilang DESC";
    $query = $conn->query($sql);
}

//membuat view halaman data buku
require_once '../admin/includes/header.php';
require_once '../admin/includes/kehilangan.php';
require_once '../admin/includes/footer.php';

ob_end_flush();
