<?php
//memulai session
session_start();

//membuat koneksi ke database
require_once '../config/db.php';

//melakukan sql untuk menampilkan data buku
$query = mysqli_query($conn, "SELECT id_buku, nama_buku, sampul_buku, pengarang FROM buku LIMIT 6");

//mengecek apakah yang mengakses halaman ini sudah login
if ($_SESSION['id_level'] == "") {
    header("location:index.php?pesan=gagal");
}

//membuat view pada halaman admin/index.php
require_once '../siswa/includes/header.php';
require_once '../siswa/includes/dashboard.php'; //sebagai content
require_once '../siswa/includes/footer.php';
