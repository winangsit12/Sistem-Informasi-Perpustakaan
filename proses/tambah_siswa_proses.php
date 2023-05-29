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

$foto = $_FILES['foto']['name'];
$nama_siswa = $conn->real_escape_string($_POST['nama_siswa']);
$kelas = $conn->real_escape_string($_POST['kelas']);
$username = $conn->real_escape_string($_POST['username']);
$password = SHA1($conn->real_escape_string($_POST['password']));
$jenis_kelamin = $conn->real_escape_string($_POST['jenis_kelamin']);
$id_level = $conn->real_escape_string($_POST['id_level']);
$level = $conn->real_escape_string($_POST['level']);

//membuat kondisi jika foto sudah terupload maka syntax dijalankan
if ($foto != "") {
    //ekstensi file foto yang diperbolehkan
    $ekstensi_boleh = array('png', 'jpg');
    //memisahkan nama file dengan ekstensi yang diupload
    $x = explode('.', $foto);
    $ekstensi = strtolower(end($x));
    //membuat nama file baru dengan angka acak
    $file_tmp = $_FILES['foto']['tmp_name'];
    $angka_acak = rand(1, 999);
    //menggabungkan nama file sebenarnya dengan angka acak
    $nama_foto_baru = $angka_acak . '-' . $foto;

    if (in_array($ekstensi, $ekstensi_boleh) === true) {
        //memindah file sampul ke folder foto
        move_uploaded_file($file_tmp, '../foto/' . $nama_foto_baru);
        //menjalankan query insert untuk menambahkan data ke database
        $q = "insert into users (nama, kelas, username, password, jenis_kelamin, foto, id_level, level)
              values ('$nama_siswa', '$kelas', '$username', '$password', '$jenis_kelamin', '$nama_foto_baru', '$id_level', '$level')";
        $query = $conn->query($q);

        //cek apakah ada yang error
        if (!$query) {
            die("Query gagal dijalankan: " . mysqli_errno($conn) . " - " . mysqli_error($conn));
        } else {
            header('location:../admin/data-siswa.php');
            $_SESSION['pesan'] = '<div class="alert alert-success" role="alert">Data siswa berhasil ditambahkan</div>';
        }
    } else {
        //jika file ekstensi yang diupload tidak sesuai
        header('location:../admin/data-siswa.php');
        $_SESSION['pesan'] = '<div class="alert alert-danger" role="alert">Format foto harus jpg atau png!</div>';
    }
} else {
    //jika belum melakukan upload foto siswa
    $q = "insert into users (nama, kelas, username, password, jenis_kelamin, foto, id_level, level)
            values ('$nama_siswa', '$kelas', '$username', '$password', '$jenis_kelamin', '', '$id_level', '$level')";
    $query = $conn->query($q);

    //cek apakah ada yang error
    if (!$query) {
        die("Query gagal dijalankan: " . mysqli_errno($conn) . " - " . mysqli_error($conn));
    } else {
        header('location:../admin/data-siswa.php');
        $_SESSION['pesan'] = '<div class="alert alert-success" role="alert">Data siswa berhasil ditambahkan</div>';
    }
}

ob_end_flush();
