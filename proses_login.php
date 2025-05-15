<?php
session_start();
include 'koneksi.php';

// Tangkap data dari form
$role     = $_POST['role'];
$username = $_POST['username'];
$password = $_POST['password'];

if ($role === 'admin') {
    $query = $konek->prepare("SELECT * FROM admin WHERE username = ? AND password = ?");
    $query->bind_param("ss", $username, $password);
} else {
    $query = $konek->prepare("SELECT * FROM siswa WHERE nis = ?");
    $query->bind_param("s", $username);
    
}

$query->execute();
$result = $query->get_result();

if ($result->num_rows === 1) {
    $data = $result->fetch_assoc();

    if($role != 'admin') {
        // Verifikasi password untuk siswa
        if (!password_verify($password, $data['password'])) {
            // Password tidak cocok
            header("Location: index.php?error=1");
            exit;
        }
    }

    // Simpan session
    $_SESSION['login'] = true;
    $_SESSION['role'] = $role;
    $_SESSION['nis'] = $username;

    if ($role === 'admin') {
        $_SESSION['id_admin'] = $data['id_admin'];
        $_SESSION['username'] = $data['username'];
        header("Location: admin");
    } else {
        $_SESSION['id_siswa'] = $data['id_siswa'];
        // $_SESSION['nis'] = $data['nis'];
        $_SESSION['nama'] = $data['nama'];
        header("Location: siswa");
    }
    exit;
} else {
    // Login gagal
    // echo "<script>alert('Login gagal! Periksa kembali username/NIS dan password.'); window.location='login.php';</script>";
    header("Location: index.php?error=1");
}
?>
