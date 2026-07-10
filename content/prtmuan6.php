<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/style.css">
    <?php include '../assets/headerlte.php'; ?>
</head>
<body>
    <body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
      <!--begin::Header-->
      <?php include '../assets/navbarlte.php'; ?>
      <!--end::Header-->
      <!--begin::Sidebar-->
      <?php include '../assets/sidebarlte.php'; ?>
      <!--end::Sidebar-->
      <!--begin::App Main-->
      <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row ">
              <div class="col-sm-6">
                <h3 class="mb-0">Pertemuan 6</h3>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
              </div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content Header-->
        <!--begin::App Content-->
        <div class="app-content">
          <!--begin::Container-->
          <!--<div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <!--begin::Col-->
              <div class="col-lg-3 col-6">
                  <div class="inner">
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
                  </div>
              </div>
            </div>
          <!--</div>-->
        </div>
      </main>
      <footer class="app-footer">
        <!--begin::To the end-->
        <div class="float-end d-none d-sm-inline">Anything you want</div>
        <!--end::To the end-->
        <!--begin::Copyright-->
        <strong>
          Copyright &copy; 2014-2026&nbsp;
          <a href="https://adminlte.io" class="text-decoration-none">AdminLTE.io</a>.
        </strong>
        All rights reserved.
        <!--end::Copyright-->
      </footer>
      <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->
    <!--begin::Script-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <?php include '../assets/scriptlte.php'; ?>
</body>
</html>