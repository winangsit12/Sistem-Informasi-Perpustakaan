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
    $id_kategori = $_POST['id_kategori'];
    $nama_buku = $_POST['nama_buku'];
    $pengarang_buku = $_POST['pengarang'];
    $penerbit_buku = $_POST['penerbit'];
    $deskripsi_buku = $_POST['deskripsi'];
    $sinopsis_buku = $_POST['sinopsis'];
    $tahun_terbit = $_POST['tahun_terbit'];
    $jumlah_buku = $_POST['jumlah_buku'];
    $sampul_buku = $_FILES['sampul_buku']['name'];

    //mengecek jika merubah sampul maka syntax akan dijalankan
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
            //menjalankan query update berdasarkan id
            $query = "UPDATE buku SET id_kategori='$id_kategori', nama_buku='$nama_buku', pengarang='$pengarang_buku', penerbit='$penerbit_buku', 
            deskripsi='$deskripsi_buku', tahun_terbit='$tahun_terbit', jumlah='$jumlah_buku', sampul_buku='$nama_sampul_baru' WHERE id_buku = '$id'";
            $result = mysqli_query($conn, $query);

            //cek apakah ada yang error
            if (!$result) {
                die("Query gagal dijalankan: " . mysqli_errno($conn) . " - " . mysqli_error($conn));
            } else {
                header('location:../admin/data-buku.php');
                $_SESSION['pesan'] = '<div class="alert alert-success" role="alert">Data buku berhasil diperbarui</div>';
            }
        } else {
            //jika file ekstensi yang diupload tidak sesuai
            header('location:../admin/data-buku.php');
            $_SESSION['pesan'] = '<div class="alert alert-danger" role="alert">Format sampul harus jpg atau png!</div>';
        }
    } else {
        //jika tidak merubah data sampul buku
        $query = "UPDATE buku SET id_kategori='$id_kategori', nama_buku='$nama_buku', pengarang='$pengarang_buku', penerbit='$penerbit_buku', 
        deskripsi='$deskripsi_buku', sinopsis='$sinopsis_buku', tahun_terbit='$tahun_terbit', jumlah='$jumlah_buku' WHERE id_buku = '$id'";
        $result = mysqli_query($conn, $query);

        //cek apakah ada yang error
        if (!$result) {
            die("Query gagal dijalankan: " . mysqli_errno($conn) . " - " . mysqli_error($conn));
        } else {
            header('location:../admin/data-buku.php');
            $_SESSION['pesan'] = '<div class="alert alert-success" role="alert">Data buku berhasil diperbarui</div>';
        }
    }
}

ob_end_flush();
