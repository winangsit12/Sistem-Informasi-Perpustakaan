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

$dataPage = mysqli_query($conn, "SELECT * FROM pengembalian");
$jumlah_data = mysqli_num_rows($dataPage);
$total_halaman = ceil($jumlah_data / $batas);

//no urut increment pada tampilan data pengembalian
$no = $halaman_awal + 1;

//melakukan query pada database pengembalian
if (isset($_GET['cari'])) {
    $sql = "SELECT tanggal_pinjam, tanggal_kembali, ketepatan_waktu, keadaan_buku, buku.nama_buku, users.nama, users.username FROM pengembalian
    LEFT JOIN buku ON buku.id_buku = pengembalian.id_buku
    LEFT JOIN users ON users.id_user = pengembalian.id_user 
    WHERE buku.nama_buku LIKE '%" . $_GET['cari'] . "%' 
    OR users.nama LIKE '%" . $_GET['cari'] . "%'
    ORDER BY pengembalian.id_kembali DESC";
    $query = $conn->query($sql);
} else {
    $sql = "SELECT tanggal_pinjam, tanggal_kembali, ketepatan_waktu, keadaan_buku, buku.nama_buku, users.nama, users.username FROM pengembalian
    LEFT JOIN buku ON buku.id_buku = pengembalian.id_buku
    LEFT JOIN users ON users.id_user = pengembalian.id_user
    ORDER BY pengembalian.id_kembali DESC";
    $query = $conn->query($sql);
}

//membuat view halaman data buku
require_once '../admin/includes/header.php';
require_once '../admin/includes/pengembalian.php';
require_once '../admin/includes/footer.php';

ob_end_flush();
