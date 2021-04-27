<?php
session_start();
ob_start();

if (!isset($_SESSION['nip'])){
   header('location: ./login');
} 

require_once("konek/koneksi.php");

$nip = $_SESSION['nip'];
$level = $_SESSION['level'];

$cek = $konek->query("SELECT * FROM users WHERE nip='$nip'");
$pecah = $cek->fetch_assoc();

$cek_trans = $konek->query("SELECT sum(bayar) FROM transaksi");
$pecah_trans = $cek_trans->fetch_assoc();

$cek_event = $konek->query("SELECT * FROM events");
$rows_event = $cek_event->num_rows;
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Website ini adalah website absensi resmi Getsmart">
  <meta name="author" content="Syarif Hidayat">
  <title>Dashboard - Getsmart Indonesia</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="./">
        <div class="sidebar-brand-icon">
          <img src="img/gs1.png" width="100%">
        </div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="./">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Admin
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#mata_pelajaran" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-clipboard-list"></i>
          <span>Pembelajaran</span>
        </a>
        <div id="mata_pelajaran" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="?p=buat_mata_pelajaran">Buat Mata Pelajaran</a>
            <a class="collapse-item" href="?p=lihat_mata_pelajaran">Lihat Mata Pelajaran</a>
          </div>
        </div>
      </li>


      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#event" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-calendar-alt"></i>
          <span>Event</span>
        </a>
        <div id="event" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="?p=buat_event">Buat Event</a>
            <a class="collapse-item" href="?p=lihat_event">Lihat Event</a>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#users" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-user"></i>
          <span>Users</span>
        </a>
        <div id="users" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="?p=tambah_users">Tambah Users</a>
            <a class="collapse-item" href="?p=lihat_users">Lihat Users</a>
          </div>
        </div>
      </li>

      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Peserta
      </div>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#peserta" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-users"></i>
          <span>Peserta</span>
        </a>
        <div id="peserta" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="?p=tambah_peserta">Tambah Peserta</a>
            <a class="collapse-item" href="?p=lihat_peserta">Lihat Peserta</a>
          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?=$pecah['nama'];?></span>
                <img class="img-profile rounded-circle" src="img/gs2.png">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="?p=profil">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profil
                </a>
                <a class="dropdown-item" href="?p=riwayat_transaksi">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Riwayat Transaksi
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Keluar
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
          </div> -->

          <!-- Content Row -->
          <div class="row">
          <!-- Content Row -->
      <!-- End of Main Content -->
      <?php
if(isset($_GET['p'])){
  $p =$_GET['p'];

  if($p == "profil"){
    include_once("content/profil.php");
  } else if ($p == "buat_event"){
    include_once("content/buat_event.php");
  } else if ($p == "lihat_event"){
    include_once("content/lihat_event.php");
  } else if ($p == "edit_event"){
    include_once("content/edit_event.php");
  } else if ($p == "tambah_users"){
    include_once("content/tambah_users.php");
  } else if ($p == "lihat_users"){
    include_once("content/lihat_users.php");
  } else if ($p == "tambah_peserta"){
    include_once("content/tambah_peserta.php");
  } else if ($p == "tambah_peserta_event"){
    include_once("content/tambah_peserta_event.php");
  } else if ($p == "lihat_peserta"){
    include_once("content/lihat_peserta.php");
  } else if ($p == "absensi"){
    include_once("content/absen.php");
  } else if ($p == "export"){
    include_once("content/export.php");
  } else if ($p == "riwayat_transaksi"){
    include_once("content/histori_transaksi.php");
  } else if ($p == "buat_mata_pelajaran"){
    include_once("content/buat_matpel.php");
  } else if ($p == "lihat_mata_pelajaran"){
    include_once("content/lihat_matpel.php");
  } else if ($p == "edit_mata_pelajaran"){
    include_once("content/edit_matpel.php");
  } else if ($p == "tambah_peserta_pelajaran"){
    include_once("content/tambah_peserta_pelajaran.php");
  } else if ($p == "lihat_sesi"){
    include_once("content/lihat_sesi.php");
  } else if ($p == "buat_sesi"){
    include_once("content/buat_sesi.php");
  } else if ($p == "edit_sesi"){
    include_once("content/edit_sesi.php");
  } else if ($p == "absen_sesi"){
    include_once("content/absen_pelajaran.php");
  }
} else {?>
  <!-- Pemasukan Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pemasukan</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= number_format(($pecah_trans['sum(bayar)']), 0, ".", ".");?>,-</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Event Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Event</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?=$rows_event?></div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
<?php
}
?>
          </div>
    </div>
    <!-- End of Content Wrapper -->

  </div>
<br><br><br>
  <!-- End of Page Wrapper -->
        <!-- Footer -->
        <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-left my-auto">
            <span>Copyright &copy; Getsmart Indonesia <?=$thn?></span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->


  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Apakah Anda yakin ingin keluar?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Pilih "Keluar" di bawah ini jika Anda siap untuk mengakhiri sesi Anda saat ini.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
          <a class="btn btn-primary" href="./logout">Keluar</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>
</body>

</html>
