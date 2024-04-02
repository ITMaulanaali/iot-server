<?php
error_reporting(E_ERROR | E_PARSE);
if(isset($_GET['del'])){
  $serialnumber = $_GET['del'];
  $sqldel = "UPDATE devices SET aktif = 'Tidak' WHERE serialnumber = '$serialnumber'";
  mysqli_query($connection, $sqldel);
}

if(isset($_POST['simpan'])){
  $serialNumber = $_POST['serialnumber'];
  $lokasiPerangkat = $_POST['lokasiperangkat'];
  $tipeController = $_POST['tipecontroller'];

  $sqlInsert = "INSERT INTO devices (serialnumber, lokasiperangkat, tipecontroller) VALUES ('$serialNumber', '$lokasiPerangkat', '$tipeController')";
  mysqli_query($connection, $sqlInsert);

}

if(isset($_GET['edit'])){
  $serialNumber = $_GET['edit'];

  $sqlShow = "SELECT * FROM devices WHERE serialnumber = '$serialNumber'";
  $resultEdit = mysqli_query($connection, $sqlShow);
  $rowEdit = mysqli_fetch_assoc($resultEdit);

  if(isset($_POST['ubah'])){
    $serialNumber = $_POST['serialnumber'];
    $lokasiPerangkat = $_POST['lokasiperangkat'];
    $tipeController = $_POST['tipecontroller'];

    $sqlEdit = "UPDATE devices SET serialnumber = '$serialNumber', lokasiperangkat = '$lokasiPerangkat', tipecontroller = '$tipeController' WHERE serialnumber = '$serialNumber'";
    mysqli_query($connection, $sqlEdit);
  }
}

  $sql = "SELECT * FROM devices WHERE aktif = 'Ya'";
	$tampilan = mysqli_query($connection, $sql);
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Perangkat IoT</h1>
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
                <h3 class="card-title">Daftar Perangkat</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Serial Number</th>
                    <th>Lokasi</th>
                    <th>Tipe Kontroller</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                  <?php while($row = mysqli_fetch_assoc($tampilan)){?>
                    <td><?php echo $row['serialnumber']?></td>
                    <td><?php echo $row['lokasiperangkat']?></td>
                    <td><?php echo $row['tipecontroller']?></td>
                    <td>
                      <a href="?hal=device&del=<?php echo $row['serialnumber']?>" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                      <a href="?hal=device&edit=<?php echo $row['serialnumber']?>" class="btn btn-danger"><i class="fas fa-edit"></i></a>
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
                    <label>Serial Number</label>
                    <input type="text" value="<?php echo $rowEdit['serialnumber']?>" class="form-control" name="serialnumber" placeholder="Masukkan Serial Number">
                  </div>
                  <div class="form-group">
                    <label>Lokasi</label>
                    <input type="text" value="<?php echo $rowEdit['lokasiperangkat']?>" class="form-control" name="lokasiperangkat" placeholder="Masukkan Lokasi Perangkat">
                  </div>
                  <div class="form-group">
                    <label>Tipe Controller</label>
                    <input type="text" value="<?php echo $rowEdit['tipecontroller']?>" class="form-control" name="tipecontroller" placeholder="Contoh: ESP32">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <?php if(isset($_GET['edit'])){ ?>
                  <Input type="submit" class="btn btn-warning" name="ubah" value="Ubah">                
                  <a href="?hal=device" class="btn btn-primary">Klik untuk tambah data</a>
                    <?php } else { ?>
                      <Input type="submit" class="btn btn-primary" name="simpan" value="Tambah">                
                    <?php } ?>
                </div>
              </form>
            </div>
          </div>
</div>