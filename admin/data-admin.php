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

$dataPage = mysqli_query($conn, "SELECT * FROM users WHERE id_level = 1");
$jumlah_data = mysqli_num_rows($dataPage);
$total_halaman = ceil($jumlah_data / $batas);

//no urut increment pada tampilan data admin
$no = $halaman_awal + 1;

//melakukan query pada database users untuk menampilkan users admin
if (isset($_GET['cari'])) {
    $sql = "SELECT * FROM users WHERE nama LIKE '%$_GET[cari]%' AND id_level = 1 ORDER BY id_user DESC LIMIT $halaman_awal, $batas";
    $query = $conn->query($sql);
} else {
    $sql = "SELECT * FROM users WHERE id_level = 1 ORDER BY id_user DESC LIMIT $halaman_awal, $batas";
    $query = $conn->query($sql);
}

//membuat view halaman data buku
require_once '../admin/includes/header.php';
require_once '../admin/includes/footer.php';

//membuat kondisi untuk CRUD pada halaman data users sebagai admin
if (!isset($_GET['p'])) {
    require_once '../admin/includes/admin.php';
    //jika p bernilai edit-buku maka memanggil edit_buku
} else if ($_GET['p'] == 'edit-admin') {
    require_once '../admin/includes/edit_admin.php';
    //jika p bernilai detail-buku maka memanggil detail_buku
} else if ($_GET['p'] == 'detail-admin') {
    require_once '../admin/includes/detail_admin.php';
    //jika p bernilai hapus-buku maka akan memanggil delete_buku
} else if ($_GET['p'] == 'hapus-admin') {
    $hapus = $conn->query("DELETE FROM users WHERE id_user = '$_GET[id]'");
    if ($hapus) {
        header('location:../admin/data-admin.php');
        $_SESSION['pesan'] = '<div class="alert alert-warning" role="alert">Data admin berhasil dihapus</div>';
    } else {
        header('location:../admin/data-admin.php');
        $_SESSION['pesan'] = '<div class="alert alert-danger" role="alert">Data admin gagal dihapus</div>';
    }
}

ob_end_flush();
