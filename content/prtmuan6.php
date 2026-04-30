<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Assets/style.css">
    <style>

    </style>
</head>
<body>
    <?php include '../Assets/header.php'; ?>
    <?php include '../Assets/navbar.php'; ?>
    <div class="container">
        <h1>Data Mahasiswa</h1>
        <p class="deskripsi">Silahkan isi Data pelengkap diri untuk mahasiswa</p>

        <form action="#" method=""post>
            <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                <input type="text" id="nama" placeholder="Masukan Nama Lengkap"> 
            </div>
            <div class="form-group">
                <label for="NIM">NIM</label>
                <input type="text" id="nim" none="nim" placeholder="Masukan NIM">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" none="email" placeholder="Masukan Email">
            </div>
            <div class="form-group">
                <label for="jurusan">Jurusan</label>
                <select id="jurusan" name="jurusan" required>
                    <option value="">Pilih Jurusan</option>
                    <option value="informatika">Teknik Informatika</option>
                    <option value="sistem-nformasi">Sistem Informasi</option>
                    <option value="manajement">Manajemen</option>
                    <option value="Akutansi">Akutansi</option>
                </select>
            </div>
            <div class ="form-group">
                <label>Jenis Kelamin</label>
                <div class="pilihan">
                    <input
                    type="radio"
                    id="laki"
                    name="jenis_kelamin"
                    value="Laki-laki"
                    required>
                    <label for="laki-laki">Laki-laki</label>
                </div>
                <div class="pilihan">
                    <input
                    type="radio"
                    id="perempuan"
                    name="jenis_kelamin"
                    value="Perempuan"
                    required>
                    <label for="laki-laki">Perempua</label>
                </div>
            </div>
            <div class="form-group">
                <label>Minat Belajar</label>

                <div class="pilihan">
                    <input
                        type="checkbox"
                        id="html"
                        name="minat"
                        value="HTML"
                    >
                    <label for="html">HTML</label>
                </div>

                <div class="pilihan">
                    <input
                        type="checkbox"
                        id="css"
                        name="minat"
                        value="CSS"
                    >
                    <label for="css">CSS</label>
                </div>

                <div class="pilihan">
                    <input
                        type="checkbox"
                        id="javascript"
                        name="minat"
                        value="Javascript"
                    >
                    <label for="javascript">Javascript</label>
                </div>
            </div>

            <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea
                    id="alamat"
                    name="alamat"
                    rows="4"
                    placeholder="Masukkan alamat lengkap"
                    required
                ></textarea>
            </div>

            <div class="form-group">
                <button type="submit">Kirim Data</button>
                <button type="reset" class="reset">Reset</button>
            </div>
        </form>
    </div>
    <?php include '../Assets/footer.php'; ?>
</body>
</html>