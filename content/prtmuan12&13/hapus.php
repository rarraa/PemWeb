<?php  
include "koneksi.php"; 
/** @var mysqli $conn */ 
$id = $_GET['id'];  
$query = mysqli_query( 
$conn, 
"DELETE FROM mahasiswa 
WHERE id='$id'" 
);  
if($query){     
    header("Location:index.php"); 
}  
?> 