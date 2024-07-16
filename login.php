<?php 
if(isset($_GET['pesan'])){
    if($_GET['pesan'] == "gagal"){
        echo '<div style="background-color: #ff9999; padding: 15px; border-radius: 8px; margin-bottom: 15px;">Login gagal! username dan password salah!</div>';
    }else if($_GET['pesan'] == "logout"){
        echo '<div style="background-color: #99ff99; padding: 15px; border-radius: 8px; margin-bottom: 15px;">Anda telah berhasil logout</div>';
    }else if($_GET['pesan'] == "belum_login"){
        echo '<div style="background-color: #ffcc66; padding: 15px; border-radius: 8px; margin-bottom: 15px;">Anda harus login untuk mengakses halaman admin</div>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Rekapan</title>

  <link rel="icon" type="image/png" href="assets/images/logos/logo_stmik.png">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<style>
  body.login-page {
    background-image: url('assets//dist/img/login_background.jpg'); 
    background-size: cover;
    background-position: center;
  }
</style>

<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <p class="h1"><b>ADMIN</b></p>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Silahkan Masuk</p>

      <form action="login_proses.php" method="post">
        <div class="input-group mb-3">
          <input type="username" class="form-control" name ="username" placeholder="Username" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name ="password" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember" required>
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button name ="login" type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.min.js"></script>
</body>
</html>
