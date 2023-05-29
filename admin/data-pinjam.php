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

$dataPage = mysqli_query($conn, "SELECT * FROM peminjaman WHERE id_level = 2");
$jumlah_data = mysqli_num_rows($dataPage);
$total_halaman = ceil($jumlah_data / $batas);

//no urut increment pada tampilan data peminjaman
$no = $halaman_awal + 1;

//melakukan query pada database peminjaman untuk menampilkan data
if (isset($_GET['cari'])) {
    $sql = "SELECT id_pinjam, peminjaman.tanggal_pinjam, peminjaman.id_level, buku.id_buku, buku.nama_buku, 
    users.id_user, users.nama, users.username, users.kelas FROM peminjaman 
    LEFT JOIN buku ON buku.id_buku = peminjaman.id_buku
    LEFT JOIN users ON users.id_user = peminjaman.id_user 
    WHERE users.username LIKE '%" . $_GET['cari'] . "%'
    AND peminjaman.id_level = 2
    ORDER BY id_pinjam DESC";
    $query = $conn->query($sql);
} else {
    $sql = "SELECT id_pinjam, peminjaman.tanggal_pinjam, peminjaman.id_level, buku.id_buku, buku.nama_buku, 
    users.id_user, users.nama, users.username, users.kelas FROM peminjaman 
    LEFT JOIN buku ON buku.id_buku = peminjaman.id_buku
    LEFT JOIN users ON users.id_user = peminjaman.id_user
    WHERE peminjaman.id_level = 2
    ORDER BY tanggal_pinjam DESC";
    $query = $conn->query($sql);
}

//membuat view halaman data buku
require_once '../admin/includes/header.php';
require_once '../admin/includes/footer.php';

//membuat kondisi verifikasi peminjaman barang
if (!isset($_GET['p'])) {
    require_once '../admin/includes/pinjam.php';
    //jika p bernilai izin-kembali maka memanggil izin_kembali
} else if ($_GET['p'] == 'izin-kembali') {
    require_once '../admin/includes/kembali.php';
    //jika p bernilai tidak-kembali maka memanggil hilang
} else if ($_GET['p'] == 'tidak-kembali') {
    require_once '../admin/includes/hilang.php';
}
