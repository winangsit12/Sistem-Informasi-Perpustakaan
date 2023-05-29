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

$id_buku = $_POST['id_buku'];
$id_user = $_SESSION['id_user'];
$tanggal_pinjam = date('Y-m-d');
$estimasi = strtotime("+1 day", strtotime($tanggal_pinjam));
$estimasi = date('Y-m-d', $estimasi);
$minus = $conn->real_escape_string($_POST['minus']);

//melakukan query insert permintaan
$q = "INSERT INTO peminjaman (id_buku, id_user, tanggal_pinjam, estimasi, minus)
          VALUES ('$id_buku', '$id_user', '$tanggal_pinjam', '$estimasi', '$minus')";
$query = $conn->query($q);

//cek apakah ada yang error
if (!$query) {
    die("Query gagal dijalankan: " . mysqli_errno($conn) . " - " . mysqli_error($conn));
} else {
    header('location:../siswa/daftar-pinjam.php');
    $_SESSION['pesan'] = '<div class="alert alert-success" role="alert">Berhasil menambahkan daftar permintaan pinjam </br> Silahkan datang ke perpustakaan dengan membawa kartu identitas siswa untuk pengambilan buku!</div>';
}
