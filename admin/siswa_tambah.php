<?php
include '../koneksi.php';

$nis = $_POST['nis'];
$nama = $_POST['nama'];
$password = $_POST['password'];

// Enkripsi password menggunakan password_hash()
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

mysqli_query($konek, "INSERT INTO siswa (nis, nama, password) VALUES ('$nis', '$nama', '$hashed_password')");

header("Location: table.php");
?>