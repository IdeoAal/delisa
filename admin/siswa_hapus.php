<?php
include '../koneksi.php'; // atau path ke file koneksi

if (isset($_POST['id_siswa'])) {
    $id = $_POST['id_siswa'];
    $query = "DELETE FROM siswa WHERE id_siswa = ?";
    $stmt = $konek->prepare($query);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        header("Location: table.php?status=berhasil");
    } else {
        header("Location: table.php?status=gagal");
    }
} else {
    header("Location: table.php");
}
?>