<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
ob_start();

if (!isset($_SESSION['nip'])){
   header("location: $base1/login");
} 

$page = $konek->query("SELECT * FROM page WHERE page = 'maintenance'");
$pecah_main = $page->fetch_assoc();

if ($pecah_main['act'] == 'y'){
    header("location: $base1/maintenance");
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

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Website ini adalah website absensi resmi Getsmart">
  <meta name="author" content="Syarif Hidayat">
  <title>Dashboard - <?=$gsi?></title>
  <link href="<?=$base?>img/gs2.png" rel="shortcut icon">

  <!-- Custom fonts for this template-->
  <link href="<?=$base?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?=$base?>css/sb-admin-2.min.css" rel="stylesheet">
  <link href="<?=$base?>vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="./">
        <div class="sidebar-brand-icon">
          <img src="<?=$base?>img/gs1.png" width="100%">
        </div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="<?=$base?>">
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
            <a class="collapse-item" href="<?=$base?>mata-pelajaran/buat">Buat Mata Pelajaran</a>
            <a class="collapse-item" href="<?=$base?>mata-pelajaran">Lihat Mata Pelajaran</a>
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
            <a class="collapse-item" href="<?=$base?>event/buat">Buat Event</a>
            <a class="collapse-item" href="<?=$base?>event">Lihat Event</a>
          </div>
        </div>
      </li>
    <?php if ($level == "Admin"){?>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#users" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-user"></i>
          <span>Users</span>
        </a>
        <div id="users" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?=$base?>users/tambah">Tambah Users</a>
            <a class="collapse-item" href="<?=$base?>users">Lihat Users</a>
          </div>
        </div>
      </li>
    <?php } ?>
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
            <a class="collapse-item" href="<?=$base?>peserta/tambah">Tambah Peserta</a>
            <a class="collapse-item" href="<?=$base?>peserta">Lihat Peserta</a>
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


            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?=$pecah['nama'];?></span>
                <img class="img-profile rounded-circle" src="<?=$base?>img/gs2.png">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="<?=$base?>profile">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profil
                </a>
                <a class="dropdown-item" href="<?=$base?>riwayat-transaksi">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Riwayat Transaksi
                </a>
                <a class="dropdown-item" href="<?=$base?>settings">
                  <i class="fas fa-cog fa-sm fa-fw mr-2 text-gray-400"></i>
                  Pengaturan
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