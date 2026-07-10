<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pertemuan 9</title>
    <?php include '../assets/headerlte.php'; ?>
</head>
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
            <div class="row">
              <div class="col-sm-6">
                <h3 class="mb-0">Pertemuan 9</h3>
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
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <!--begin::Col-->
              <div> class="col-lg-3 col-6"> <!-- akhir -->
                  <div class="inner">
                    <h2>PHP Hello World</h2>
                    <?php
                    // Sintaks dasar: output sederhana
                    echo "<p>Hello World! Selamat datang di dunia PHP.</p>";
                    ?>
                    <hr>
                    <?php
                    // Variabel dan kondisi
                    date_default_timezone_set('Asia/Jakarta');
                    $time = date('H:i');
                    $jam = date('H');
                    $nama = "Mahasiswa";
                    if ($jam < 12) {
                        $salam = "Selamat pagi";
                    } elseif ($jam < 15) {
                        $salam = "Selamat siang";
                    } elseif ($jam < 18) {
                        $salam = "Selamat sore";
                    } else {
                        $salam = "Selamat malam";
                    }
                    echo "<p>$salam, $nama! Sekarang jam $time.</p>";
                    ?>
                    <p>Kode ini menunjukkan bagaimana PHP membuat web dinamis berdasarkan 
                    waktu dan logika.</p>
                    <hr>
                    <h3>Contoh Operator</h3>
                    <?php
                    $a = 10;
                    $b = 5;
                    $hasil1 = $a + $b;
                    $hasil2 = $a - $b;
                    $hasil3 = $a * $b;
                    $hasil4 = $a / $b;
                    echo "<p>Hasil $a + $b = $hasil1</p>";
                    echo "<p>Hasil $a - $b = $hasil2</p>";
                    echo "<p>Hasil $a * $b = $hasil3</p>";
                    echo "<p>Hasil $a / $b = $hasil4</p>";
                    if ($hasil1 > 10) {
                        echo "<p>Hasil penjumlahan lebih besar dari 10.</p>";
                    } else {
                        echo "<p>Hasil penjumlahan tidak lebih besar dari 10.</p>";
                    }
                    if ($hasil2 > 10) {
                        echo "<p>Hasil pengurangan lebih besar dari 10.</p>";
                    } else {
                        echo "<p>Hasil pengurangan tidak lebih besar dari 10.</p>";
                    }
                    ?>

                    <hr>
                    <h1>Hitung Mundur</h1>
                    <?php
                    for ($i = 10; $i > 0; $i--){
                        echo $i . ",";
                    }
                    ?>

                    <hr>
                    <form method="POST">
                        <input type="number" placeholder="Masukkan umur Anda" name="umur"
                    required>
                        <button type="submit" name="submit">Cek Status</button>
                    </form>

                    <?php
                    if (isset($_POST['submit'])) {
                        $age = (int) $_POST['umur'];

                        if ($age >= 18) {
                            echo "<p>Umur Anda $age tahun. Anda sudah cukup umur!</p>";
                        } else {
                            echo "<p>Umur Anda $age tahun. Anda belum cukup umur.</p>";
                        }
                    }
                    ?>
                  </div>
              </div>
            </div>
          </div>
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