<?php

//memulai session
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

$id_pinjam = $_POST['id'];
$id_buku = $_POST['id_buku'];
$id_user = $_POST['id_user'];
$tanggal_pinjam = $_POST['tanggal_pinjam'];
$status_pinjam = $conn->real_escape_string($_POST['status_pinjam']);
$keterangan = $conn->real_escape_string($_POST['keterangan']);
$min = $conn->real_escape_string($_POST['min']);

//melakukan query insert pengembalian
$q = "INSERT INTO hilang (id_pinjam, id_buku, id_user, tanggal_pinjam, status_peminjam, keterangan, min)
          VALUES ('$id_pinjam', '$id_buku', '$id_user', '$tanggal_pinjam', '$status_pinjam', '$keterangan', '$min')";
$query = $conn->query($q);

//cek apakah ada yang error
if (!$query) {
    die("Query gagal dijalankan: " . mysqli_errno($conn) . " - " . mysqli_error($conn));
} else {
    header('location:../admin/data-hilang.php');
    $_SESSION['pesan'] = '<div class="alert alert-success" role="alert">Daftar buku hilang berhasil ditambahkan</div>';
}
