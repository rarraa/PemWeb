<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori Mahasiswa</title>
    <link rel="stylesheet" href="../assets/style9.css">
</head>
<body>
<?php
$kategori = '';
if (isset($_POST['submit'])) {
    $nama = (string) $_POST['nama'];
    $age = (int) $_POST['umur'];
    if ($age < 13) {
        $kategori= "<p>Usia Mahasiswa $nama = $age Tahun. <br> Kategori Mahasiswa Anak-anak</p>";    
    } elseif ($age >= 13 && $age <= 17) {
        $kategori= "<p>Usia Mahasiswa $nama = $age Tahun. Kategori Mahasiswa Remaja</p>";
    } elseif ($age >= 18 && $age <= 59) {
        $kategori= "<p>Usia Mahasiswa $nama = $age Tahun. Kategori Mahasiswa Dewasa</p>";
    } else {
        $kategori= "<p>Usia Mahasiswa $nama = $age Tahun. Kategori Mahasiswa Lansia</p>";
    }
}
?>

    <div class="card">
        <h1> Cek Kategori Usia Mahasiswa </h1>
        <p class="subtitle">
            <?php
            echo "Selamat Datang di Cek Kategori Usia Mahasiswa";
            ?>
        </p>
        <form method="POST" action="">
            <div class="form-group">
                <input type="text" placeholder="Masukan Nama" name="nama"
                required>
            </div>
            <div class="form-group">
                <input type="number" placeholder="Masukan Umur" name="umur"
                required>
            </div>
            <button type="submit" name="submit" class="btn">Cek Kategori</button>
        </form>
        <div class="display">
            <?php echo $kategori ?>
        </div>
        <a href="tgs_prtmuan9.php">
            <button type="button" class="btn btn-reset"> Reset</button>
        </a>
    </div>
</body>
</html>