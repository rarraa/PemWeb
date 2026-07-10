<?php
session_start(); 
require 'koneksi.php';  
/** @var mysqli $conn */ 
if (isset($_POST['login'])) {     
    $username = mysqli_real_escape_string($conn, $_POST['username']);     
    $password = $_POST['password'];      
    $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");          
    if (mysqli_num_rows($result) === 1) {         
        $row = mysqli_fetch_assoc($result);                  
        // Verifikasi kecocokan password terenkripsi         
        if (password_verify($password, $row['password'])) {                          
            // Membuat Session data pengguna             
            $_SESSION['id_user']  = $row['id'];             
            $_SESSION['username'] = $row['username'];             
            $_SESSION['role']     = $row['role'];             
            // Pemisahan Redirect halaman berdasarkan Role             
            if ($row['role'] == 'admin') {                 
                header("Location: dashboard_admin.php");                 
                exit;             
            } elseif ($row['role'] == 'user') {                 
                header("Location: dashboard_user.php");                 
                exit;             
            }         
        }     
    }     
    $error = true; 
} 
?>  

<!DOCTYPE html> 
<html> 
<head>
    <title>Form Login</title>
    <?php include '../../assets/headerlte.php'; ?>
</head> 
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
      <!--begin::Header-->
      <?php include '../../assets/navbarlte.php'; ?>
      <!--end::Header-->
      <!--begin::Sidebar-->
      <?php include '../../assets/sidebarlte.php'; ?>
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
                <h3 class="mb-0">Pertemuan 14</h3>
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
                    <h2>Halaman Login</h2>     
    <?php if(isset($error)) : ?>         
        <p style="color: red;">Username atau Password salah!</p>     
    <?php endif; ?>      
    <form method="POST" action="">         
        <label>Username:</label><br>         
        <input type="text" name="username" required><br><br>          
        <label>Password:</label><br>         
        <input type="password" name="password" required><br><br>          
        <button type="submit" name="login">Masuk</button>     
    </form>     
    <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p> 
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
    <?php include '../../assets/scriptlte.php'; ?>     
</body> 
</html> 
