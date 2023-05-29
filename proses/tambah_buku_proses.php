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

$sampul_buku = $_FILES['sampul_buku']['name'];
$nama_buku = $conn->real_escape_string($_POST['nama_buku']);
$pengarang_buku = $conn->real_escape_string($_POST['pengarang_buku']);
$penerbit_buku = $conn->real_escape_string($_POST['penerbit_buku']);
$deskripsi_buku = $conn->real_escape_string($_POST['deskripsi_buku']);
$sinopsis_buku = $conn->real_escape_string($_POST['sinopsis_buku']);
$id_kategori = $conn->real_escape_string($_POST['id_kategori']);
$tahun_terbit = $conn->real_escape_string($_POST['tahun_terbit']);
$jumlah_buku = $conn->real_escape_string($_POST['jumlah_buku']);

//membuat kondisi jika sampul sudah terupload maka syntax dijalankan
if ($sampul_buku != "") {
    //ekstensi file gambar yang diperbolehkan
    $ekstensi_boleh = array('png', 'jpg');
    //memisahkan nama file dengan ekstensi yang diupload
    $x = explode('.', $sampul_buku);
    $ekstensi = strtolower(end($x));
    //membuat nama file baru dengan angka acak
    $file_tmp = $_FILES['sampul_buku']['tmp_name'];
    $angka_acak = rand(1, 999);
    //menggabungkan nama file sebenarnya dengan angka acak
    $nama_sampul_baru = $angka_acak . '-' . $sampul_buku;

    if (in_array($ekstensi, $ekstensi_boleh) === true) {
        //memindah file sampul ke folder sampul
        move_uploaded_file($file_tmp, '../sampul/' . $nama_sampul_baru);
        //menjalankan query insert untuk menambahkan data ke database
        $q = "INSERT INTO buku (id_kategori, sampul_buku, nama_buku, pengarang, penerbit, deskripsi, sinopsis, tahun_terbit, jumlah)
              VALUES ('$id_kategori', '$nama_sampul_baru', '$nama_buku', '$pengarang_buku', '$penerbit_buku', '$deskripsi_buku', '$sinopsis_buku', '$tahun_terbit', '$jumlah_buku')";
        $query = $conn->query($q);

        //cek apakah ada yang error
        if (!$query) {
            die("Query gagal dijalankan: " . mysqli_errno($conn) . " - " . mysqli_error($conn));
        } else {
            header('location:../admin/data-buku.php');
            $_SESSION['pesan'] = '<div class="alert alert-success" role="alert">Data buku berhasil ditambahkan</div>';
        }
    } else {
        //jika file ekstensi yang diupload tidak sesuai
        header('location:../admin/data-buku.php');
        $_SESSION['pesan'] = '<div class="alert alert-danger" role="alert">Format sampul harus jpg atau png!</div>';
    }
} else {
    //jika belum melakukan upload sampul buku
    $q = "INSERT INTO buku (id_kategori, sampul_buku, nama_buku, pengarang, penerbit, deskripsi, sinopsis, tahun_terbit, jumlah)
          VALUES ('$id_kategori', null, '$nama_buku', '$pengarang_buku', '$penerbit_buku', '$deskripsi_buku', '$sinopsis_buku', '$tahun_terbit', '$jumlah_buku')";
    $query = $conn->query($q);

    //cek apakah ada yang error
    if (!$query) {
        die("Query gagal dijalankan: " . mysqli_errno($conn) . " - " . mysqli_error($conn));
    } else {
        header('location:../admin/data-buku.php');
        $_SESSION['pesan'] = '<div class="alert alert-success" role="alert">Data buku berhasil ditambahkan</div>';
    }
}

ob_end_flush();
