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
    $sql = "SELECT pengembalian.tanggal_pinjam, pengembalian.tanggal_kembali, pengembalian.ketepatan_waktu, pengembalian.keadaan_buku, buku.nama_buku, kategori.kategori, users.id_user FROM pengembalian
    LEFT JOIN buku ON buku.id_buku = pengembalian.id_buku
    LEFT JOIN users ON users.id_user = pengembalian.id_user
    LEFT JOIN kategori ON kategori.id_kategori = buku.id_kategori
    WHERE users.id_user = $id_user
    AND buku.nama_buku LIKE '%" . $_GET['cari'] . "%' 
    OR kategori.kategori LIKE '%" . $_GET['cari'] . "%'
    ORDER BY id_kembali DESC";
    $query = $conn->query($sql);
} else {
    $sql = "SELECT pengembalian.tanggal_pinjam, pengembalian.tanggal_kembali, pengembalian.ketepatan_waktu, pengembalian.keadaan_buku, buku.nama_buku, kategori.kategori, users.id_user FROM pengembalian 
    LEFT JOIN buku ON buku.id_buku = pengembalian.id_buku
    LEFT JOIN users ON users.id_user = pengembalian.id_user
    LEFT JOIN kategori ON kategori.id_kategori = buku.id_kategori
    WHERE users.id_user = $id_user
    ORDER BY id_kembali DESC";
    $query = $conn->query($sql);
}

//no urut increment pada tampilan data buku
$no = 1;

//membuat view halaman data buku
require_once '../siswa/includes/header.php';
require_once '../siswa/includes/riwayat.php';

ob_end_flush();
