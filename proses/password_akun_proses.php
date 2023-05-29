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

if (isset($_POST['simpan_password'])) {
    //membuat variabel untuk password baru
    $username = $_POST['username'];
    $password_lama = SHA1($_POST['password_lama']);
    $password_baru = SHA1($_POST['password_baru']);
    $konfirm_password = SHA1($_POST['konfirm_password']);

    //melakukan cek password lama
    $query = "SELECT * FROM users WHERE users.username = '$username' AND users.password = '$password_lama'";
    $sql = mysqli_query($conn, $query);
    $hasil = mysqli_num_rows($sql);

    if (!$hasil >= 1) {
        header('location:../siswa/akun.php');
        $_SESSION['pesan'] = '<div class="alert alert-danger" role="alert">Password lama tidak sesuai!</div>';
    }
    //validasi data data kosong
    else if (
        empty($_POST['password_baru']) || empty($_POST['konfirm_password'])
    ) {
        header('location:../siswa/akun.php');
        $_SESSION['pesan'] = '<div class="alert alert-danger" role="alert">Password tidak boleh kosong!</div>';
    }
    //validasi input konfirm password
    else if (($_POST['password_baru']) != ($_POST['konfirm_password'])) {
        header('location:../siswa/akun.php');
        $_SESSION['pesan'] = '<div class="alert alert-danger" role="alert">Password baru harus sama dengan Konfirmasi Password!</div>';
    } else {
        //update data
        $query = "UPDATE users SET users.password='$password_baru' WHERE users.username='$username'";
        $sql = mysqli_query($conn, $query);
        //setelah berhasil update
        if ($sql) {
            header('location:../siswa/akun.php');
            $_SESSION['pesan'] = '<div class="alert alert-success" role="alert">Ganti password berhasil</div>';
        } else {
            header('location:../siswa/akun.php');
            $_SESSION['pesan'] = '<div class="alert alert-danger" role="alert">Ganti password gagal!</div>';
        }
    }
}

ob_end_flush();
