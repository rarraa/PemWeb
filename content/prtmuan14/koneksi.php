<?php 
$host = "localhost"; 
$user = "root"; 
$pass = ""; 
$db   = "db_praktikum";  
$conn = mysqli_connect($host, $user, $pass, $db);  
$koneksi = mysqli_connect("localhost", "root", "", "db_praktikum");
if (!$conn) {     
    die("Koneksi ke database gagal: " . mysqli_connect_error()); 
} 
?> 