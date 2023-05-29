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

//membuat pagination\
$batas = 8;
$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

$previous = $halaman - 1;
$next = $halaman + 1;

$dataPage = mysqli_query($conn, "SELECT * FROM buku");
$jumlah_data = mysqli_num_rows($dataPage);
$total_halaman = ceil($jumlah_data / $batas);

//no urut increment pada tampilan data buku
$no = $halaman_awal + 1;

//melakukan query pada database buku
if (isset($_GET['cari'])) {
    $sql = "SELECT * FROM buku LEFT JOIN kategori ON buku.id_kategori = kategori.id_kategori WHERE nama_buku LIKE '%" . $_GET['cari'] . "%' OR kategori LIKE '%" . $_GET['cari'] . "%' ORDER BY buku.id_kategori ASC LIMIT $halaman_awal, $batas";
    $query = $conn->query($sql);
} else {
    $sql = "SELECT * FROM buku LEFT JOIN kategori ON buku.id_kategori = kategori.id_kategori ORDER BY buku.id_kategori ASC LIMIT $halaman_awal, $batas";
    $query = $conn->query($sql);
}

//melakukan query pada database kategori untuk menampilkan semua data
$sqlKategori = "SELECT * FROM kategori";
$queryKategori = mysqli_query($conn, $sqlKategori);

//membuat view halaman data buku
require_once '../admin/includes/header.php';
require_once '../admin/includes/footer.php';

//membuat kondisi untuk CRUD pada halaman data buku
if (!isset($_GET['p'])) {
    require_once '../admin/includes/buku.php';
    //jika p bernilai edit-buku maka memanggil edit_buku
} else if ($_GET['p'] == 'edit-buku') {
    require_once '../admin/includes/edit_buku.php';
    //jika p bernilai detail-buku maka memanggil detail_buku
} else if ($_GET['p'] == 'detail-buku') {
    require_once '../admin/includes/detail_buku.php';
    //jika p bernilai hapus-buku maka akan memanggil delete_buku
} else if ($_GET['p'] == 'hapus-buku') {
    $hapus = $conn->query("DELETE FROM buku WHERE id_buku = '$_GET[id]'");
    if ($hapus) {
        header('location:../admin/data-buku.php');
        $_SESSION['pesan'] = '<div class="alert alert-warning" role="alert">Data buku berhasil dihapus</div>';
    } else {
        header('location:../admin/data-buku.php');
        $_SESSION['pesan'] = '<div class="alert alert-danger" role="alert">Data buku gagal dihapus</div>';
    }
}

ob_end_flush();
