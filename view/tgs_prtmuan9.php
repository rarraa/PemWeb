<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tugas Pertemua 9</title>
</head>
<body>
    <h2>Cek Kategori Usia Mahasiswa</h2>
    <?php
    echo "<p>Selamat Datang di Cek Kategori Usia Mahasiswa</p>";
    ?>
    <hr>
    <form method="POST">
        <input type="text" placeholder="Masukan Nama" name="nama"
        required>
        <input type="number" placeholder="Masukan Umur" name="umur"
        required>
        <button type="submit" name="submit">Cek Kategori</button>
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $age = (int) $_POST['umur'];

        if ($age < 13) {
            echo "<p>Umur Mahasiswa = $age Tahun. Kategori Mahasiswa Anak-anak</p>";
        } elseif ($age >= 13 && $age <= 17) {
            echo "<p>>Umur Mahasiswa = $age Tahun. Kategori Mahasiswa Remaja</p>";
        } elseif ($age >= 18 && $age <= 59) {
            echo "<p>>Umur Mahasiswa = $age Tahun. Kategori Mahasiswa Dewasa</p>";
        } else {
            echo "<p>>Umur Mahasiswa = $age Tahun. Kategori Mahasiswa Lansia</p>";
        }
    }
    ?>
</body>
</html>