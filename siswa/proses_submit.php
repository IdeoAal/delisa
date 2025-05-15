<?php
session_start(); // Jangan lupa mulai session

// Cek apakah siswa sudah login
if (!isset($_SESSION['id_siswa'])) {
    // die("Akses ditolak. Anda belum login.");
    header("Location: index.php?error=3");
}

// Ambil ID siswa dari session
$id_siswa = $_SESSION['id_siswa'];

// Koneksi ke database
include '../koneksi.php';

// Tangkap data dari form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $isi = trim($_POST['isi']);

    if (!empty($isi)) {
        // Simpan ke database
        $stmt = $konek->prepare("INSERT INTO kritik_saran (isi, id_siswa) VALUES (?, ?)");
        $stmt->bind_param("si", $isi, $id_siswa);

        if ($stmt->execute()) {
            header("Location: index.php?pesan=1");
            exit();
        } else {
            echo "Gagal menyimpan data: " . $konek->error;
        }

        $stmt->close();
    } else {
        echo "Form aspirasi tidak boleh kosong.";
    }
}

$konek->close();
?>
