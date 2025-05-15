<?php
include '../koneksi.php';

$id = $_POST['id_siswa'];
$nis = $_POST['nis'];
$nama = $_POST['nama'];
$password = $_POST['password'];

if (!empty($password)) {
    // Jika password diisi, hash dan update semua field
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $query = "UPDATE siswa SET nis='$nis', nama='$nama', password='$hashed_password' WHERE id_siswa='$id'";
} else {
    // Jika password kosong, update tanpa ubah password
    $query = "UPDATE siswa SET nis='$nis', nama='$nama' WHERE id_siswa='$id'";
}

mysqli_query($konek, $query);

header("Location: table.php");
?>