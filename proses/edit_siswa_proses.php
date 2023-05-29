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
if (isset($_POST['simpan'])) {
    $id = $_POST['id'];
    $foto = $_FILES['foto']['name'];
    $nama_siswa = $_POST['nama_siswa'];
    $username = $_POST['username'];
    $kelas = $_POST['kelas'];
    $jenis_kelamin = $_POST['jenis_kelamin'];

    //mengecek jika merubah foto maka syntax akan dijalankan
    if ($foto != "") {
        //ekstensi file gambar yang diperbolehkan
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
            //menjalankan query update berdasarkan id
            $query = "UPDATE users SET users.nama='$nama_siswa', users.username='$username',
                    users.jenis_kelamin='$jenis_kelamin', users.foto='$nama_foto_baru' WHERE users.id_user = '$id'";
            $result = mysqli_query($conn, $query);

            //cek apakah ada yang error
            if (!$result) {
                die("Query gagal dijalankan: " . mysqli_errno($conn) . " - " . mysqli_error($conn));
            } else {
                header('location:../admin/data-siswa.php');
                $_SESSION['pesan'] = '<div class="alert alert-success" role="alert">Data siswa berhasil diperbarui</div>';
            }
        } else {
            //jika file ekstensi yang diupload tidak sesuai
            header('location:../admin/data-siswa.php.php');
            $_SESSION['pesan'] = '<div class="alert alert-danger" role="alert">Format foto harus jpg atau png!</div>';
        }
    } else {
        //jika tidak merubah data foto admin
        $query = "UPDATE users SET users.nama='$nama_siswa', users.username='$username',
                users.jenis_kelamin='$jenis_kelamin' WHERE users.id_user = '$id'";
        $result = mysqli_query($conn, $query);

        //cek apakah ada yang error
        if (!$result) {
            die("Query gagal dijalankan: " . mysqli_errno($conn) . " - " . mysqli_error($conn));
        } else {
            header('location:../admin/data-siswa.php');
            $_SESSION['pesan'] = '<div class="alert alert-success" role="alert">Data siswa berhasil diperbarui</div>';
        }
    }
}

ob_end_flush();
