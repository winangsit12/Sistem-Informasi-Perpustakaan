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

//memanggil session id_user
$id_user = $_SESSION["id_user"];

//melakukan query pada database peminjaman untuk menampilkan data
if (isset($_GET['cari'])) {
    $sql = "SELECT id_pinjam, peminjaman.tanggal_pinjam, peminjaman.id_level, buku.id_buku, buku.nama_buku, kategori.kategori, users.id_user, peminjaman.estimasi FROM peminjaman 
    LEFT JOIN buku ON buku.id_buku = peminjaman.id_buku
    LEFT JOIN users ON users.id_user = peminjaman.id_user
    LEFT JOIN kategori ON kategori.id_kategori = buku.id_kategori
    WHERE users.id_user = $id_user
    AND buku.nama_buku LIKE '%" . $_GET['cari'] . "%' 
    OR kategori.kategori LIKE '%" . $_GET['cari'] . "%'
    ORDER BY id_pinjam DESC";
    $query = $conn->query($sql);
} else {
    $sql = "SELECT id_pinjam, peminjaman.tanggal_pinjam, peminjaman.id_level, buku.id_buku, buku.nama_buku, kategori.kategori, users.id_user, peminjaman.estimasi FROM peminjaman 
    LEFT JOIN buku ON buku.id_buku = peminjaman.id_buku
    LEFT JOIN users ON users.id_user = peminjaman.id_user
    LEFT JOIN kategori ON kategori.id_kategori = buku.id_kategori
    WHERE users.id_user = $id_user
    ORDER BY id_pinjam DESC";
    $query = $conn->query($sql);
}

//no urut increment pada tampilan data buku
$no = 1;

//membuat view halaman data buku
require_once '../siswa/includes/header.php';

if (!isset($_GET['p'])) {
    require_once '../siswa/includes/daftar.php';
} else if ($_GET['p'] == 'batal-pinjam') {
    $hapus = $conn->query("DELETE FROM peminjaman WHERE id_pinjam = '$_GET[id]'");
    if ($hapus) {
        header('location:../siswa/daftar-pinjam.php');
        $_SESSION['pesan'] = '<div class="alert alert-warning" role="alert">Batal melakukan peminjaman buku berhasil</div>';
    } else {
        header('location:../siswa/daftar-pinjam.php');
        $_SESSION['pesan'] = '<div class="alert alert-danger" role="alert">Batal pinjam gagal</div>';
    }
}

ob_end_flush();
