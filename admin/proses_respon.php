<?php
include '../koneksi.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_kritik = $_POST['id_kritik'];
    $respon = $_POST['respon'];
    $id_admin = $_SESSION['id_admin']; // pastikan session ini aktif
    $tgl_respon = date('Y-m-d');

    $sql = "UPDATE kritik_saran 
            SET respon = ?, id_admin = ?, tgl_respon = ?
            WHERE id_kritik = ?";
    $stmt = $konek->prepare($sql);
    $stmt->bind_param("sisi", $respon, $id_admin, $tgl_respon, $id_kritik);
    $stmt->execute();

    header("Location: index.php?pesan=1");
    exit;
}
?>
