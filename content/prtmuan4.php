<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
    <?php include '../assets/headerlte.php'; ?>
</head>
<body <body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
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
                <h3 class="mb-0">Pertemuan 4</h3>
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
                    <table border="1">
    <tr>
        <th colspan="4">Data Mahasiswa</th>
    </tr>
    <tr>
        <th>Nama</th>
        <th>Alamat</th>
        <th>Umur</th>
        <th>Foto</th>
    </tr>
    <tr>
        <td>Apriii</td>
        <td>Jl. Merdeka No. 123</td>
        <td>25</td>
        <td><img src="foto_apri.jpg" alt="foto_apri" width="100"></td>
    </tr>
    <tr>
        <td>dodo</td>
        <td>Jl. Sudirman No. 45</td>
        <td>23</td>
        <td><img src="foto_dodo.jpg" alt="foto_dodo"></td>
    </tr>
</table>
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