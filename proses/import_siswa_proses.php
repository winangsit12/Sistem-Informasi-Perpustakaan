<?php

//memulai session
session_start();
ob_start();

//koneksi ke database
require_once '../config/db.php';
require_once '../library/excel/excel_reader2.php';

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

if ($_POST['upload'] == "upload") {
    $type = explode(".", $_FILES['namafile']['name']);

    if (empty($_FILES['namafile']['name'])) {
        $_SESSION['pesan'] = '<div class="alert alert-danger" role="alert">Masukan file terlebih dahulu</div>';
    } else if (strtolower(end($type)) != 'xls') {
        header('location:../admin/data-buku.php');
        $_SESSION['pesan'] = '<div class="alert alert-danger" role="alert">File harus excel</div>';
    } else {
        $target = basename($_FILES['namafile']['name']);
        move_uploaded_file($_FILES['namafile']['tmp_name'], $target);

        $data = new Spreadsheet_Excel_Reader($_FILES['namafile']['name'], false);

        $baris = $data->rowcount($sheet_index = 0);

        $berhasil = 0;
        for ($i = 2; $i <= $baris; $i++) {
            $nama = $data->val($i, 2);
            $username = $data->val($i, 3);
            $password = SHA1($data->val($i, 4));
            $kelas = $data->val($i, 5);
            $jenis_kelamin = $data->val($i, 6);

            $queryImport = mysqli_query($conn, "INSERT INTO users (nama, username, users.password, kelas, jenis_kelamin, id_level, users.level) 
            VALUES ('$nama', '$username', '$password', '$kelas', '$jenis_kelamin', '2', 'Anggota')");
            $berhasil++;
        }

        if (!$queryImport) {
            header('location:../admin/data-siswa.php');
            $_SESSION['pesan'] = '<div class="alert alert-danger" role="alert">Gagal melakukan import data</div>';
        } else {
            header('location:../admin/data-siswa.php');
            $_SESSION['pesan'] = '<div class="alert alert-success" role="alert">Berhasil melakukan import data</div>';
        }

        unlink($_FILES['namafile']['name']);
    }
}
