<?php 
require_once ("konek/header.php");
  if ($level !== "Admin") {
    if ($level !== "Pengurus") {
      echo"<script>alert('Maaf Anda tidak memiliki akses untuk ke halaman ini');</script>";
      echo"<script>location='$base1/login';</script>";
    }
  }
  
$actid = $_GET['actid'];
$cek_event = $konek->query("SELECT * FROM events WHERE id_event = '$actid'");
$pecah_event = $cek_event->fetch_assoc();
?>
        <!-- Begin Page Content -->
        <div class="container-fluid">


          <!-- Content Row -->
          <div class="container-fluid">

            <!-- Earnings (Monthly) Card Example -->
            <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Edit Event</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                  <?php require_once("konek/func.php")?>
                        <form class="user" action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <p style="display:inline;"> Nama Event</p>
                                <input value="<?=$pecah_event['id_event']?>" name="id" hidden>
                                <input type="text" name="nama" class="form-control" placeholder="Masukan Nama Event" value="<?=$pecah_event['nama_event']?>" require>
                            </div>
                            <div class="form-group">
                                <p style="display:inline;"> Deskripsi</p>
                                <textarea name="deskripsi" class="form-control" placeholder="Masukan Deskripsi Event" require><?=$pecah_event['deskripsi_event']?></textarea>
                            </div>
                            <div class="form-group">
                                <p style="display:inline;"> Ketua Acara</p>
                                <input type="text" name="ketua" class="form-control" placeholder="Ketua Acara" value="<?=$pecah_event['ketua']?>" require>
                            </div>
                            <div class="form-group">
                                <p style="display:inline;"> Gambar</p>
                                <img src="<?=$base?>img/acara/<?=$pecah_event['gambar']?>" class="form-control" style="align: center; height: 100%;">
                                <input type="file" name="gambar" class="form-control" placeholder="Gambar" accept="image/jpeg">
                            </div>
                            <div class="form-group">
                                <p style="display:inline;"> Biaya Daftar</p>
                                <input type="number" name="biaya" class="form-control" placeholder="Biaya Daftar" value="<?=$pecah_event['harga']?>" require>
                            </div>
                            <div class="form-group">
                                <p style="display:inline;"> Start Event</p>
                                <input type="date" name="tm" class="form-control" value="<?=date("Y-m-d", strtotime($pecah_event['tanggal_m_event']))?>" require>
                                <input type="time" name="jm" class="form-control" value="<?=date("H:i", strtotime($pecah_event['tanggal_m_event']))?>" require>
                            </div>
                            <div class="form-group">
                                <p style="display:inline;"> End Event</p>
                                <input type="date" name="ts" class="form-control" value="<?=date("Y-m-d", strtotime($pecah_event['tanggal_s_event']))?>" require>
                                <input type="time" name="js" class="form-control" value="<?=date("H:i", strtotime($pecah_event['tanggal_s_event']))?>" require>
                            </div>
                            <button class="btn btn-primary btn-user btn-block" name="edit_event"><i class="fa fa-save"></i> Simpan</button>
                        </form>
              </div>
            </div>
          </div>

        </div>
    </div>

        
            <!-- Pending Requests Card Example -->
          
      <!-- End of Main Content -->
      <?php require_once ("konek/footer.php");?>