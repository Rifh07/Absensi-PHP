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
              <h6 class="m-0 font-weight-bold text-primary">Buat Event</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                  <?php require_once("konek/func.php")?>
                        <form class="user" action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <p style="display:inline;"> Nama Event</p>
                                <input type="text" name="nama" class="form-control" placeholder="Masukan Nama Event" require>
                            </div>
                            <div class="form-group">
                                <p style="display:inline;"> Deskripsi</p>
                                <textarea name="deskripsi" class="form-control" placeholder="Masukan Deskripsi Event" require></textarea>
                            </div>
                            <div class="form-group">
                                <p style="display:inline;"> Ketua Acara</p>
                                <input type="text" name="ketua" class="form-control" placeholder="Ketua Acara" require>
                            </div>
                            <div class="form-group">
                                <p style="display:inline;"> Gambar</p>
                                <input type="file" name="gambar" class="form-control" placeholder="Gambar" accept="image/jpeg">
                            </div>
                            <div class="form-group">
                                <p style="display:inline;"> Biaya Daftar</p>
                                <input type="number" name="biaya" class="form-control" placeholder="Biaya Daftar" require>
                            </div>
                            <div class="form-group">
                                <p style="display:inline;"> Start Event</p>
                                <input type="date" name="tm" class="form-control" require>
                                <input type="time" name="jm" class="form-control" require>
                            </div>
                            <div class="form-group">
                                <p style="display:inline;"> End Event</p>
                                <input type="date" name="ts" class="form-control" require>
                                <input type="time" name="js" class="form-control" require>
                            </div>
                            <button class="btn btn-primary btn-user btn-block" name="buat_event">Buat Event</button>
                        </form>
              </div>
            </div>
          </div>

        </div>
    </div>

        
            <!-- Pending Requests Card Example -->
          
      <!-- End of Main Content -->
      <?php require_once ("konek/footer.php");?>