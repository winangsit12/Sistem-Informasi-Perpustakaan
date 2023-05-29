<?php
//memulai session
session_start();

//membuat koneksi ke database
require_once '../config/db.php';

//mengecek apakah yang mengakses halaman ini sudah login
if ($_SESSION['id_level'] == "") {
    header("location:index.php?pesan=gagal");
}

//membuat view pada halaman admin/index.php
require_once '../admin/includes/header.php';
require_once '../admin/includes/dashboard.php'; //sebagai content
require_once '../admin/includes/footer.php';
