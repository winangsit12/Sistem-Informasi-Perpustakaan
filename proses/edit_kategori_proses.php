<?php

//memulai session
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

//membuat variabel untuk setiap data yang dikirimkan
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $kategori = $_POST['kategori'];

    //membuat query untuk mengupdate data kategori
    $query = "UPDATE kategori SET kategori='$kategori' WHERE id_kategori = '$id'";
    $result = mysqli_query($conn, $query);

    //cek apakah ada yang error
    if (!$result) {
        die("Query gagal dijalankan: " . mysqli_errno($conn) . " - " . mysqli_error($conn));
    } else {
        header('location:../admin/data-kategori.php');
        $_SESSION['pesan'] = '<div class="alert alert-success" role="alert">Data kategori buku berhasil diperbarui</div>';
    }
}

ob_end_flush();
