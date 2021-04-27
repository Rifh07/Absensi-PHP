<?php 
require_once ("konek/header.php");
  if ($level !== "Admin") {
    if ($level !== "Pengurus") {
      echo"<script>alert('Maaf Anda tidak memiliki akses untuk ke halaman ini');</script>";
      echo"<script>location='$base1/login';</script>";
    }
  }
?>
        <!-- Begin Page Content -->
        <div class="container-fluid">


          <!-- Content Row -->
          <div class="container-fluid">

            <!-- Earnings (Monthly) Card Example -->
            <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Buat Mata Pelajaran</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                    <?php require_once("konek/func.php");?>
                        <form class="user" action="" method="POST">
                            <div class="form-group">
                                <p style="display:inline;"> Kode Pelajaran</p>
                                <input type="text" name="kode_pelajaran" class="form-control" placeholder="Masukan Kode Pelajaran" require>
                            </div>
                            <div class="form-group">
                                <p style="display:inline;"> Nama Pelajaran</p>
                                <input type="text" name="nama_pelajaran" class="form-control" placeholder="Masukan Nama Pelajaran" require>
                            </div>
                            <button class="btn btn-primary btn-user btn-block" name="buat_matpel">Buat Mata Pelajaran</button>
                        </form>
              </div>
            </div>
          </div>

        </div>
    </div>

        
            <!-- Pending Requests Card Example -->
          
      <!-- End of Main Content -->
      <?php require_once ("konek/footer.php");?>