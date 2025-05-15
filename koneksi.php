<?php

$host = "localhost";
$username = "root";
$password = "";
$dbname = "delisa_db";
    
$konek = new mysqli($host, $username, $password, $dbname);

if ($konek->connect_error) {
    die("Koneksi gagal: " . $konek->connect_error);
} else {
    // echo "Koneksi berhasil";
}