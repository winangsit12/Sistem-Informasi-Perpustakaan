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

$id_user = $_SESSION['id_user'];

//melakukan query pada database users untuk menampilkan users siswa
$siswa = $conn->query("SELECT * FROM users WHERE id_user = $id_user");
$data = $siswa->fetch_assoc();


//no urut increment pada tampilan data buku
$no = 1;

//membuat view halaman data buku
require_once '../siswa/includes/header.php';
require_once '../siswa/includes/akunku.php';
require_once '../siswa/includes/footer.php';

ob_end_flush();
