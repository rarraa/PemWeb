<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pertemuan 10</title>
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
            <div class="row ">
              <div class="col-sm-6">
                <h3 class="mb-0">Pertemuan 10</h3>
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
                    <h3 style="text-align: center;">Ini adalah halaman untuk pertemuan ke 
                    10</h3>
                    <hr>
                    <h3 style="text-align: center;">Array sederhana tentang 
                    Buah</h3>
                    <?php
                    // Array sederhana
                    $buah = array("Apel", "Jeruk", "Mangga");
                    ?>
                    <!-- Loop untuk menampilkan array -->
                    <h3>Daftar Buah:</h3>
                    <ul class='list-utama'>
                    <!-- foreach digunakan untuk pengulangan kumpulan data (array) -->
                    <?php foreach ($buah as $item): ?>
                    <li><?= $item; ?></li>
                    <?php endforeach; ?>
                    </ul>
                    <hr>
                    <?php
                    // Array data mahasiswa
                    $mahasiswa = array(
                    ["Nama" => "Ali", "NIM" => "12345", "Nilai" => 85],
                    ["Nama" => "Budi", "NIM" => "12346", "Nilai" => 90],
                    ["Nama" => "Cici", "NIM" => "12347", "Nilai" => 78]
                    );
                    echo "<h3>Data Mahasiswa</h3>";
                    ?>
                    <div>
                    <table class="table table-striped">
                    <tr>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Nilai</th>
                    <th>Status</th>
                    </tr>
                    <?php
                    foreach ($mahasiswa as $mhs):
                    if ($mhs['Nilai'] >= 80) {
                    $status = "Lulus";
                    } else {
                    $status = "Tidak Lulus";
                    }
                    ?>
                    <tr>
                    <td><?= $mhs['Nama']; ?></td>
                    <td><?= $mhs['NIM']; ?></td>
                    <td><?= $mhs['Nilai']; ?></td>
                    <td><?= $status; ?></td>
                    </tr>
                    <?php endforeach; ?>
                    </table>
                    </div>
                    <hr>
                    <?php
                    $mahasiswa = array(
                    ["Nama" => "Ali", "NIM" => "12345", "Nilai" => [85, 90, 88]],
                    ["Nama" => "Budi", "NIM" => "12346", "Nilai" => [78, 82, 80]],
                    ["Nama" => "Cici", "NIM" => "12347", "Nilai" => [92, 95, 93]]
                    );
                    ?>
                    <div>
                    <table class="table table-striped">
                    <thead>
                    <tr>
                    <th>Nama</th>
                    <th>Nim</th>
                    <th>Nilai-1</th>
                    <th>Nilai-2</th>
                    <th>Nilai-3</th>
                    <th>Rata-rata</th>
                    </tr>
                    </thead>
                    <?php foreach ($mahasiswa as $mhs): ?>
                    <tr>
                    <td><?= $mhs['Nama']; ?></td>
                    <td><?= $mhs['NIM']; ?></td>
                    <?php foreach ($mhs['Nilai'] as $nilai): ?>
                    <td><?= $nilai; ?></td>
                    <?php endforeach; ?>
                    <?php $rata = array_sum($mhs['Nilai']) /
                    count($mhs['Nilai']); ?>
                    <td><?= $rata; ?></td>
                    <?php endforeach; ?>
                    </tr>
                    </table>
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