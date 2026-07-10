<?php 
require 'koneksi.php'; 
/** @var mysqli $conn */ 
if (isset($_POST['register'])) {     
    $username = mysqli_real_escape_string($conn, $_POST['username']);     
    $password = $_POST['password'];     
    $role     = $_POST['role'];      
    // Enkripsi password demi keamanan     
    $password_encrypted = password_hash($password, PASSWORD_DEFAULT);      
    // Cek apakah username sudah terdaftar      
    $cek_user  =  mysqli_query($conn,  "SELECT  *  FROM  users  WHERE 
                                username = '$username'");     
    if (mysqli_num_rows($cek_user) > 0) {            
        echo  "<script>alert('Username  sudah  digunakan!'); 
                window.location='register.php';</script>";     
    } else {         
        // Simpan data user baru         
        $query = "INSERT INTO users (username, password, role) VALUES 
                ('$username', '$password_encrypted', '$role')";         
        if (mysqli_query($conn, $query)) {                  
            echo  "<script>alert('Registrasi  Berhasil!  Silakan 
                    Login.'); window.location='login.php';</script>";         
        } else {             
            echo "Error: " . mysqli_error($conn);         
        }     
    } 
}
?>  

<!DOCTYPE html> 
<html> 
<head>
    <title>Form Registrasi</title>
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
                    <h2>Registrasi Akun Baru</h2>     
    <form method="POST" action="">         
        <label>Username:</label><br>         
        <input type="text" name="username" required><br><br>          
        <label>Password:</label><br>         
        <input type="password" name="password" required><br><br>          
        <label>Daftar Sebagai:</label><br>         
        <select name="role">             
            <option value="user">User Biasa</option>             
            <option value="admin">Admin</option>         
        </select><br><br>          
        <button type="submit" name="register">Daftar</button>     
    </form>     
    <p>Sudah punya akun? <a href="login.php">Login di sini</a></p> 
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
