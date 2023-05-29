<?php

$host       = "localhost";
$user       = "root";
$password   = "";
$database   = "perpussmapa";
//membuat koneksi ke data base
$conn    = new mysqli($host, $user, $password, $database);

//cek koneksi
//if ($conn->connect_error) {
//    die("Connection failed: " . $conn->connect_error);
//  }
//  echo "Connected successfully";
