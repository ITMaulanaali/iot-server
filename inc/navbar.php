<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="?hal=home" class="nav-link">Dashboard</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="https://wa.me/6281333553358" class="nav-link">Kontak</a>
        </li>
        <?php if($_GET['hal'] == "home"){ ?>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link" id="status" style="color: red">Terputus</a>
        </li>
        <?php } ?>
    </ul>
</nav>
<!-- /.navbar -->