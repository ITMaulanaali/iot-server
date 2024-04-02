<?php 
session_start();
include "conf/database.php";
$pesan = "Masukan password dan username";

if(isset($_SESSION['username'])){
  echo '<meta http-equiv="refresh" content="0; URL=index.php?hal=home">';
}

if(isset($_POST['username'])){
  $username = $_POST['username'];
  $password = $_POST['password'];

  $sql_username_check = "SELECT * FROM user WHERE username = '$username'";
  $result = mysqli_query($connection, $sql_username_check);
  $rowData = mysqli_fetch_assoc($result);

  if($rowData){
    $passworDatabase = $rowData['password'];
     if(password_verify($password, $passworDatabase)){
      $_SESSION['namalengkap'] = $rowData['namalengkap'];
      $_SESSION['hakakses'] = $rowData['hakakses'];
       echo '<meta http-equiv="refresh" content="0; URL=index.php?hal=home">';
      } else{
        $pesan = "Periksa kembali password anda";
      }
  }else {
    $pesan = "periksa kembali username anda";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistem IOT</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Sistem</b>IoT</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg"><?php echo $pesan ?></p>

      <form method="POST">
        <div class="input-group mb-3">
          <input type="text" name="username" class="form-control" placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Masuk</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
