<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3">
                    <div class="small-box bg-orange">
                        <div class="inner">
                            <h3><span id="suhu">?</span> °C</h3>

                            <p>Suhu</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-thermometer"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3><span id="kelembaban">?</span> %</h3>

                            <p>Kelembaban</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-tint"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="small-box bg-light">
                    <div class="custom-control custom-switch">
                      <input type="checkbox" class="custom-control-input" onclick="publish()" id="lampu">
                      <label class="custom-control-label" for="lampu">Lampu</label>
                    </div>
                    </div>
                </div>
            </div>
           
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
