<?php
if($_SESSION['hakakses'] != "admin"){
  echo '<meta http-equiv="refresh" content="0; URL=index.php?hal=home">';
} else {
?>

<?php
error_reporting(E_ERROR | E_PARSE);
if(isset($_GET['del'])){
  $username = $_GET['del'];
  $sqldel = "UPDATE user SET aktif = 'Tidak' WHERE username = '$username'";
  mysqli_query($connection, $sqldel);
}

if(isset($_POST['simpan'])){
  $userName = $_POST['username'];
  $namaLengkap = $_POST['namalengkap'];
  $password = $_POST['password'];
  $passHash = password_hash($password, PASSWORD_DEFAULT);
  $hakAkses = $_POST['hakakses'];

  $sqlInsert = "INSERT INTO user (username, password, namalengkap, hakakses) VALUES ('$userName', '$passHash', '$namaLengkap', '$hakAkses')";
  mysqli_query($connection, $sqlInsert);

}

if(isset($_GET['edit'])){
  $username = $_GET['edit'];

  $sqlShow = "SELECT * FROM user WHERE username = '$username'";
  $resultEdit = mysqli_query($connection, $sqlShow);
  $rowEdit = mysqli_fetch_assoc($resultEdit);

  if(isset($_POST['ubah'])){
    $username = $_POST['username'];
    $namaLengkap = $_POST['namalengkap'];
    $password = $_POST['password'];

    $sqlEdit = "UPDATE user SET username = '$username', namalengkap = '$namaLengkap', password = '$password' WHERE username = '$username'";
    var_dump($sqlEdit);
    mysqli_query($connection, $sqlEdit);
  }
}

  $sql = "SELECT * FROM user WHERE aktif = 'Ya'";
	$tampilan = mysqli_query($connection, $sql);
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pengguna</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                <div class="card">
              <div class="card-header">
                <h3 class="card-title">Daftar Pengguna</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Username</th>
                    <th>Nama Lengkap</th>
                    <th>Hak Akses</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                  <?php while($row = mysqli_fetch_assoc($tampilan)){?>
                    <td><?php echo $row['username']?></td>
                    <td><?php echo $row['namalengkap']?></td>
                    <td><?php echo $row['hakakses']?></td>
                    <td>
                      <a href="?hal=user&del=<?php echo $row['username']?>" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                      <a href="?hal=user&edit=<?php echo $row['username']?>" class="btn btn-danger"><i class="fas fa-edit"></i></a>
                    </td>
                  </tr>
                   <?php } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
                </div>
            </div>
           
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
    <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Inputan</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST">
                <div class="card-body">
                  <div class="form-group">
                    <label>Username</label>
                    <input type="text" value="<?php echo $rowEdit['username']?>" class="form-control" name="username" placeholder="Masukkan Serial Number" required>
                  </div>
                  <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" value="<?php echo $rowEdit['namalengkap']?>" class="form-control" name="namalengkap" placeholder="Masukkan Lokasi Perangkat" required>
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Masukkan Password" required>
                  </div>
                  <div class="form-group">
                    <label>Hak Akses</label>
                    <select class="custom-select" name="hakakses">
                      <option value="admin">Admin Ni Bos</option>
                      <option value="user">User</option>
                  </select>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <?php if(isset($_GET['edit'])){ ?>
                  <Input type="submit" class="btn btn-warning" name="ubah" value="Ubah">                
                  <a href="?hal=user" class="btn btn-primary">Klik untuk Tambah user</a>
                    <?php } else { ?>
                      <Input type="submit" class="btn btn-primary" name="simpan" value="Tambah">                
                    <?php } ?>
                </div>
              </form>
            </div>
          </div>
</div>
<?php } ?>