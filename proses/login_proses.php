<?php

//membuat fungsi untuk mencegah input karakter tidak sesuai
function input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    return $data;
}

//mengaktifkan session pada php
session_start();

//menghubungkan PHP dengan koneksi database
include '../config/db.php';

//menangkap data dari form login
$username = input(($_POST['username']));
$password = input(SHA1($_POST['password']));
$id_level = input($_POST['id_level']);
//$id_level = input($_POST['id_level']);

$sql = "SELECT * FROM users WHERE users.username = '$username' AND users.password = '$password' AND users.id_level = '$id_level'";
$hasil = mysqli_query($conn, $sql);
$jumlah = mysqli_num_rows($hasil);

if ($jumlah > 0) {
    $row = mysqli_fetch_assoc($hasil);
    $_SESSION["id_user"] = $row["id_user"];
    $_SESSION["nama"] = $row["nama"];
    $_SESSION["kelas"] = $row["kelas"];
    $_SESSION["username"] = $row["username"];
    $_SESSION["password"] = $row["password"];
    $_SESSION["jenis_kelamin"] = $row["jenis_kelamin"];
    $_SESSION["foto"] = $row["foto"];
    $_SESSION["id_level"] = $row["id_level"];
    $_SESSION["level"] = $row["level"];

    if ($_SESSION["id_level"] = $row["id_level"] == 1) {
        header("Location:../admin/index.php");
    } else if ($_SESSION["id_level"] = $row["id_level"] == 2) {
        header("Location:../siswa/index.php");
    }
} else {
    header('location:../index.php?error=gagal');
}
