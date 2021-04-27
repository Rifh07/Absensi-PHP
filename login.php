<?php
session_start();
require_once("konek/koneksi.php");

if (isset($_SESSION['nip'])){
   header('location: ./');
} 


$page = $konek->query("SELECT * FROM page WHERE page = 'maintenance'");
$pecah_main = $page->fetch_assoc();

if ($pecah_main['act'] == 'y'){
    header("location: $base1/maintenance");
}


?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Website ini adalah website absensi resmi Getsmart">
  <meta name="author" content="Syarif Hidayat">
  <link href="<?=$base?>img/gs2.png" rel="shortcut icon">

  <title>Login - <?=$gsi?></title>

  <!-- Custom fonts for this template-->
  <link href="<?=$link?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?=$link?>css/sb-admin-2.min.css" rel="stylesheet">


</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-4 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-12">
                <div class="p-3">
                    <div class="p-3">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Selamat Datang!</h1>
                  </div>

                  <?php require_once("konek/func.php")?>
                  <!-- PHP Login Selesai -->
                  <form class="user" action="" method="POST">
                    <div class="form-group">
                      <input type="text" name="nip" class="form-control form-control-user" placeholder="Masukan NIP" require>
                    </div>
                    <div class="form-group">
                      <input type="password" name="password" class="form-control form-control-user" placeholder="Masukan Password">
                    </div>
                    <input class="btn btn-primary btn-user btn-block" name="login" type="submit" value="Masuk">
                  </form>
                  <br>
                  <hr>
                    <center>
                        <a href="<?=$base?>forgot">Lupa Password?</a>
                    </center>
                </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?=$link?>vendor/jquery/jquery.min.js"></script>
  <script src="<?=$link?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?=$link?>vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?=$link?>js/sb-admin-2.min.js"></script>

</body>

</html>
