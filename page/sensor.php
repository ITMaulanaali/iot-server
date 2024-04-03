<?php
  $sql = "select * from sensors";
	$tampilan = mysqli_query($connection, $sql);
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Sensor</h1>
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
                <h3 class="card-title">Seluruh Data Sensor</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Jenis Sensor</th>
                    <th>Data Sensor</th>
                    <th>Serial Number</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <?php while($row = mysqli_fetch_assoc($tampilan)){?>
                    <td><?php echo $row['id']?></td>
                    <td><?php echo $row['jenissensor']?></td>
                    <td><?php echo $row['datasensor']?></td>
                    <td><?php echo $row['serialnumber']?></td>
                    <td></td>
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
</div>
