<?php
session_start();
if(!isset($_SESSION['namalengkap'])){
  echo '<meta http-equiv="refresh" content="0; URL=login.php">';
}

include "conf/database.php";
include "inc/header.php";
?>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <?php
    include "inc/navbar.php";
    include "inc/sidebar.php";

    if (isset($_GET['hal'])) { // cek apakah ada parameter GET nya
      $hal = $_GET['hal'];
      include "page/" . $hal . ".php";
    } else {
      include "page/home.php";
    }

    include "inc/footer.php";
    ?>

  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- DataTables  & Plugins -->
  <script src="plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="plugins/jszip/jszip.min.js"></script>
  <script src="plugins/pdfmake/pdfmake.min.js"></script>
  <script src="plugins/pdfmake/vfs_fonts.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
  <!-- menambah MQTT.JS package link -->
  <?php if($_GET['hal'] == "home"){ ?>
  <script src="https://unpkg.com/mqtt/dist/mqtt.min.js"></script>
  <?php } ?>
  <!-- Page specific script -->
  <script>
    $(function() {
      $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>
  
  <script>
    $(function(){
      bsCustomFileInput.init();
    });
  </script>

  <!--MQTT Config-->
  <?php if($_GET['hal'] == "home") { ?>
   <script>
    const clientId = "fromwebiot";
    const host = "wss://hidroponikan.cloud.shiftr.io:443/";
    const options = {
      keepalive: 60,
      clientId: clientId,
      username: "hidroponikan",
      password: "XU3QHexrKaVsrfLd",
      protocolId: "MQTT",
      protocolVersion: 4,
      clean: false,
      reconnectPeriod: 1000,
      connectTimeout: 30000,
    };

    console.log("Menghubungkan ke broker");
    const client = mqtt.connect(host, options);

    client.subscribe("mqttx/#", {qos: 0});
    client.on("message", function(topic, payload){
      console.log(topic);
      console.log(payload.toString());

      if(topic == "mqttx/suhu"){
        document.getElementById("suhu").innerHTML = payload;
      }
      
      if(topic == "mqttx/kelembaban"){
        document.getElementById("kelembaban").innerHTML = payload;
      }
    });

    client.on("connect", () => {
      console.log("Berhasil terhubung ke broker");
      document.getElementById("status").innerHTML = "Terhubung";
      document.getElementById("status").style.color = "green";
    });

    function publish(){
      let check = document.getElementById("ikan").checked;
      client.publish("mqttx/rumah/esp32/lampu", check.toString(), {qos: 1, retain: true});
    }
   </script>
  <?php } ?>
</body>

</html>
