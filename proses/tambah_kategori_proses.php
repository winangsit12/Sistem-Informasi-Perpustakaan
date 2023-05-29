<?php

//memulai session
session_start();
ob_start();

//koneksi ke database
require_once '../config/db.php';

//mengecek apakah yang mengakses halaman ini sudah login
if ($_SESSION['id_level'] == "") {
    header("location:index.php?pesan=gagal");
}

$kategori = $conn->real_escape_string($_POST['kategori']);

//membuat query untuk menambahkan data kategori
$q = "INSERT INTO kategori (kategori)
        VALUES ('$kategori')";
$query = $conn->query($q);

//cek apakah ada yang error
if (!$query) {
    die("Query gagal dijalankan: " . mysqli_errno($conn) . " - " . mysqli_error($conn));
} else {
    header('location:../admin/data-kategori.php');
    $_SESSION['pesan'] = '<div class="alert alert-success" role="alert">Data kategori buku berhasil ditambahkan</div>';
}

ob_end_flush();
