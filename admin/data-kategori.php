<?php

//memulai session php
session_start();
ob_start();

//koneksi ke database
require_once '../config/db.php';

//mengecek apakah yang mengakses halaman ini sudah login
if ($_SESSION['id_level'] == "") {
    header("location:index.php?pesan=gagal");
}

//membuat pagination\
$batas = 8;
$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

$previous = $halaman - 1;
$next = $halaman + 1;

$dataPage = mysqli_query($conn, "SELECT * FROM kategori");
$jumlah_data = mysqli_num_rows($dataPage);
$total_halaman = ceil($jumlah_data / $batas);

//no urut increment pada tampilan data kategori
$no = $halaman_awal + 1;

//melakukan query pada database kategori untuk menampilkan semua data
if (isset($_GET['cari'])) {
    $sql = "SELECT * FROM kategori WHERE kategori LIKE '%" . $_GET['cari'] . "%'";
    $query = $conn->query($sql);
} else {
    $sql = "SELECT * FROM kategori";
    $query = $conn->query($sql);
}

//membuat view halaman data kategori
require_once '../admin/includes/header.php';
require_once '../admin/includes/footer.php';

//membuat kondisi untuk CRUD pada halaman data kategori
if (!isset($_GET['p'])) {
    require_once '../admin/includes/kategori.php';
    //jika p bernilai edit-kategori maka memanggil edit_kategori
} else if ($_GET['p'] == 'edit-kategori') {
    require_once '../admin/includes/edit_kategori.php';
    //jika p bernilai hapus-kategori maka akan memanggil delete_kategori
} else if ($_GET['p'] == 'hapus-kategori') {
    $hapus = $conn->query("DELETE FROM kategori WHERE id_kategori = '$_GET[id]'");
    if ($hapus) {
        header('location:../admin/data-kategori.php');
        $_SESSION['pesan'] = '<div class="alert alert-warning" role="alert">Data kategori berhasil dihapus</div>';
    } else {
        header('location:../admin/data-kategori.php');
        $_SESSION['pesan'] = '<div class="alert alert-danger" role="alert">Data kategori gagal dihapus karena sudah digunakan di data buku</div>';
    }
}

ob_end_flush();
