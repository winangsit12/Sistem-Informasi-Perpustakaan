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

$dataPage = mysqli_query($conn, "SELECT * FROM users WHERE id_level = 2");
$jumlah_data = mysqli_num_rows($dataPage);
$total_halaman = ceil($jumlah_data / $batas);

//no urut increment pada tampilan data siswa
$no = $halaman_awal + 1;

//melakukan query pada database users untuk menampilkan users siswa
if (isset($_GET['cari'])) {
    $sql = "SELECT * FROM users WHERE nama LIKE '%$_GET[cari]%' OR username LIKE '%$_GET[cari]%' AND id_level = 2 ORDER BY username DESC";
    $query = $conn->query($sql);
} else {
    $sql = "SELECT * FROM users WHERE id_level = 2 ORDER BY username ASC";
    $query = $conn->query($sql);
}

//membuat view halaman data buku
require_once '../admin/includes/header.php';
require_once '../admin/includes/footer.php';

//membuat kondisi untuk CRUD pada halaman data users sebagai admin
if (!isset($_GET['p'])) {
    require_once '../admin/includes/siswa.php';
    //jika p bernilai edit-buku maka memanggil edit_buku
} else if ($_GET['p'] == 'edit-siswa') {
    require_once '../admin/includes/edit_siswa.php';
    //jika p bernilai detail-buku maka memanggil detail_buku
} else if ($_GET['p'] == 'detail-siswa') {
    require_once '../admin/includes/detail_siswa.php';
    //jika p bernilai hapus-buku maka akan memanggil delete_buku
} else if ($_GET['p'] == 'hapus-siswa') {
    $hapus = $conn->query("DELETE FROM users WHERE id_user = '$_GET[id]'");
    if ($hapus) {
        header('location:../admin/data-siswa.php');
        $_SESSION['pesan'] = '<div class="alert alert-warning" role="alert">Data siswa berhasil dihapus</div>';
    } else {
        header('location:../admin/data-siswaphp');
        $_SESSION['pesan'] = '<div class="alert alert-danger" role="alert">Data siswa gagal dihapus</div>';
    }
} else if ($_GET['p'] == 'delete-siswa') {
    $delete = $conn->query("DELETE FROM users WHERE id_level = '2'");
    if ($delete) {
        header('location:../admin/data-siswa.php');
        $_SESSION['pesan'] = '<div class="alert alert-warning" role="alert">Semua data siswa berhasil dihapus</div>';
    } else {
        header('location:../admin/data-siswaphp');
        $_SESSION['pesan'] = '<div class="alert alert-danger" role="alert">Semua data siswa gagal dihapus</div>';
    }
}

ob_end_flush();
