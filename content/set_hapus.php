<?php 
require_once ("konek/header.php");
  if ($level !== "Admin") {
      echo"<script>location='$base1/404';</script>";
  }
  
$path1 = explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$menu = $path1['2'];
?>
        <!-- Begin Page Content -->
        <div class="container-fluid">


          <!-- Content Row -->
          <div class="container-fluid">

            <!-- Earnings (Monthly) Card Example -->
            <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-cog"></i> Pengaturan</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <?php require_once("konek/func.php")?>
                <div class="card mb-4 py-3 border-left-danger">
                <div class="card-body">
                  <h4>PERHATIAN!!!!</h4><br>
                  <?php if ($menu == "mata-pelajaran"){
                    echo "Jika semua mata pelajaran di hapus, maka semua pertemuan, absensi dan peserta yang ada didalam semua mata pelajaran akan dihapus juga.
                    Sebelum menghapus semua mata pelajaran alangkah baiknya meng-export absensi setiap pertemuan.";
                  } else if ($menu == "event"){
                    echo "Jika semua event di hapus, maka semua absensi dan peserta yang ada didalam semua event akan dihapus juga.
                    Sebelum menghapus semua event alangkah baiknya meng-export absensi setiap pertemuan.";
                  } else if ($menu == "users"){
                    echo "Penghapusan ini secara permanen. Jika semua user dihapus, maka user tidak dapat dipulihkan kembali.";
                  } else if ($menu == "peserta"){
                    echo "Penghapusan ini secara permanen. Jika semua peserta dihapus, maka peserta tidak dapat dipulihkan kembali.";
                  } else {
                      header('location: $base1/404');
                  }
                  ?>
                </div>
                </div>
              </div>
                <br>
                <form method="POST" action="">
                <center>
                    Apakah Anda yakin menghapus ini? <br><br>
                    <button class="btn btn-danger btn-user btn-inline" name="del-<?=$menu?>">Hapus</button>&nbsp;&nbsp;&nbsp;
                    <a href="<?=$base?>settings" class="btn btn-primary btn-user btn-inline">Batal</a>
                </center>
                </form>
            </div>
          </div>

        </div>
    </div>

        
            <!-- Pending Requests Card Example -->
          
      <!-- End of Main Content -->
      <?php require_once ("konek/footer.php");?>

