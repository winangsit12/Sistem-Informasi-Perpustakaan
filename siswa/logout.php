<?php
session_start();

$_SESSION["id_user"] = "";
$_SESSION["nama"] = "";
$_SESSION["kelas"] = "";
$_SESSION["username"] = "";
$_SESSION["password"] = "";
$_SESSION["jenis_kelamin"] = "";
$_SESSION["foto"] = "";
$_SESSION["id_level"] = "";
$_SESSION["level"] = "";

unset($_SESSION["id_user"]);
unset($_SESSION["nama"]);
unset($_SESSION["kelas"]);
unset($_SESSION["username"]);
unset($_SESSION["password"]);
unset($_SESSION["jenis_kelamin"]);
unset($_SESSION["foto"]);
unset($_SESSION["id_level"]);
unset($_SESSION["level"]);

session_unset();
session_destroy();
header('Location:../index.php');
