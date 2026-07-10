<?php
// Konfigurasi Database
$host     = "localhost";     // Server database (biasanya localhost)
$user     = "root";          // Username database default XAMPP
$password = "";              // Password database default XAMPP (kosong)
$database = "akademik";      // Ganti dengan nama database Anda (misal: akademik atau universitas)

// Membuat koneksi ke database menggunakan MySQLi Prosedural
$conn = mysqli_connect($host, $user, $password, $database);

// Memeriksa apakah koneksi berhasil atau gagal
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>