<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

// Load Excel
$spreadsheet = IOFactory::load('siswa_xi_f1.xlsx');
$worksheet = $spreadsheet->getActiveSheet();

// Koneksi ke database
$mysqli = new mysqli("localhost", "root", "", "delisa_db");
if ($mysqli->connect_error) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}

$defaultPassword = '12345';

foreach ($worksheet->getRowIterator(2) as $row) {
    $cellIterator = $row->getCellIterator();
    $cellIterator->setIterateOnlyExistingCells(false);

    $data = [];
    foreach ($cellIterator as $cell) {
        $data[] = $cell->getValue();
    }

    // Pastikan hanya data valid yang dimasukkan
    $nis = trim($data[0]);
    $nama = trim($data[1]);

    if (!empty($nis) && !empty($nama)) {
        $passwordHashed = password_hash($defaultPassword, PASSWORD_DEFAULT);

        $stmt = $mysqli->prepare("INSERT INTO siswa (nis, password, nama) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nis, $passwordHashed, $nama);
        $stmt->execute();
    }
}

echo "Import data siswa selesai!";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Load Data Siswa</title>
</head>
<body>
    <a href="../index.php">Kembali Ke Halaman Web Delisa</a>
</body>
</html>