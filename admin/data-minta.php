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

$id_level = $_SESSION["id_level"];

if ($id_level != 1) {
    echo "Anda tidak punya akses pada halaman admin";
    exit;
}

//membuat pagination
$batas = 8;
$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

$previous = $halaman - 1;
$next = $halaman + 1;

$dataPage = mysqli_query($conn, "SELECT * FROM peminjaman WHERE id_level = 1");
$jumlah_data = mysqli_num_rows($dataPage);
$total_halaman = ceil($jumlah_data / $batas);

//no urut increment pada tampilan data permintaan
$no = $halaman_awal + 1;

//melakukan query pada database peminjaman untuk menampilkan data
if (isset($_GET['cari'])) {
    $sql = "SELECT id_pinjam, peminjaman.tanggal_pinjam, peminjaman.id_level, buku.id_buku, buku.nama_buku, 
    users.id_user, users.nama, users.username, users.kelas FROM peminjaman 
    LEFT JOIN buku ON buku.id_buku = peminjaman.id_buku
    LEFT JOIN users ON users.id_user = peminjaman.id_user 
    WHERE users.username LIKE '%" . $_GET['cari'] . "%'
    AND peminjaman.id_level = 1
    ORDER BY id_pinjam DESC";
    $query = $conn->query($sql);
} else {
    $sql = "SELECT id_pinjam, peminjaman.tanggal_pinjam, peminjaman.id_level, buku.id_buku, buku.nama_buku, 
    users.id_user, users.nama, users.username, users.kelas FROM peminjaman 
    LEFT JOIN buku ON buku.id_buku = peminjaman.id_buku
    LEFT JOIN users ON users.id_user = peminjaman.id_user 
    WHERE peminjaman.id_level = 1
    ORDER BY id_pinjam DESC";
    $query = $conn->query($sql);
}

//membuat view halaman data buku
require_once '../admin/includes/header.php';
require_once '../admin/includes/footer.php';

//batas tanggal pinjam
$qq = $conn->query("SELECT peminjaman.id_pinjam, kategori FROM peminjaman 
LEFT JOIN buku ON buku.id_buku = peminjaman.id_buku
LEFT JOIN kategori ON kategori.id_kategori = buku.id_kategori");
$kat = $qq->fetch_array();

$tglPinjam = date('Y-m-d');
$estimasi = strtotime("+7 day", strtotime($tglPinjam));
$estimasi = date('Y-m-d', $estimasi);

$estimasiMapel = strtotime("+6 month", strtotime($tglPinjam));
$estimasiMapel = date('Y-m-d', $estimasiMapel);

//membuat kondisi verifikasi peminjaman barang
if (!isset($_GET['p'])) {
    require_once '../admin/includes/permintaan.php';
} else if ($_GET['p'] == 'izin-pinjam') {
    if ($kat['kategori'] == "Mata Pelajaran") {
        $ubah = $conn->query("UPDATE peminjaman SET tanggal_pinjam = '$tglPinjam', estimasi = '$estimasiMapel', id_level = 2 WHERE id_pinjam = '$_GET[id]'");
        if ($ubah) {
            header('location:../admin/data-pinjam.php');
            $_SESSION['pesan'] = '<div class="alert alert-success" role="alert">Izin pinjam berhasil diberikan</div>';
        } else {
            header('location:../admin/data-pinjam.php');
            $_SESSION['pesan'] = '<div class="alert alert-danger" role="alert">Izin pinjam gagal diberikan </div>';
        }
    } else {
        $ubah = $conn->query("UPDATE peminjaman SET tanggal_pinjam = '$tglPinjam', estimasi = '$estimasi', id_level = 2 WHERE id_pinjam = '$_GET[id]'");
        if ($ubah) {
            header('location:../admin/data-pinjam.php');
            $_SESSION['pesan'] = '<div class="alert alert-success" role="alert">Izin pinjam berhasil diberikan</div>';
        } else {
            header('location:../admin/data-pinjam.php');
            $_SESSION['pesan'] = '<div class="alert alert-danger" role="alert">Izin pinjam gagal diberikan </div>';
        }
    }
    //jika p bernilai batal_pinjam maka menghapus daftar permintaan
} else if ($_GET['p'] == 'batal-pinjam') {
    $hapus = $conn->query("DELETE FROM peminjaman WHERE id_pinjam = '$_GET[id]'");
    if ($hapus) {
        header('location:../admin/data-minta.php');
        $_SESSION['pesan'] = '<div class="alert alert-danger" role="alert">Izin pinjam tidak diberikan</div>';
    } else {
        header('location:../admin/data-minta.php');
        $_SESSION['pesan'] = '<div class="alert alert-danger" role="alert">Izin pinjam gagal tidak diberikan </div>';
    }
}

//melakukan query auto hapus permintaan
$lama = '1';
$qq = "DELETE FROM peminjaman WHERE DATEDIFF(estimasi, tanggal_pinjam) > $lama AND id_level = '1'";
$queryHapus = $conn->query($qq);
