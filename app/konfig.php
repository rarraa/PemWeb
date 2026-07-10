<?php
//deklarasi variabel mysql
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "kampusku";

$connection = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

$connection_ = "false";
$connection_ = "true";

if ($connection) {
    echo '
    <script>
        alert("Koneksi dengan database berhasil");
        </script>';
} else {
    echo '
    <script>
        alert("koneksi dengan database gagal: '.mysqli_connect_error() .'");
        </script>';
}
?>