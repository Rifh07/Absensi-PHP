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

          <?php
            if(isset($_GET['actid'])){
                $kode_sesi = $_GET['actid'];
                $cek_sesi = $konek->query("SELECT * FROM sesi WHERE kode_sesi = '$kode_sesi'");
                $arr_sesi = $cek_sesi->fetch_assoc();
                $tanggal = date("Y-m-d", strtotime($arr_sesi['mulai']));
                $mulai = date("H:i", strtotime($arr_sesi['mulai']));
                $selesai = date("H:i", strtotime($arr_sesi['selesai']));
            }
          ?>

            <!-- Earnings (Monthly) Card Example -->
            <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Edit Pertemuan Ke-<?=$arr_sesi['sesi']?></h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                  <?php require_once("konek/func.php") ?>
                        <form class="user" action="" method="POST">
                            <div class="form-group">
                                <p style="display:inline;"> Nama Pengajar</p>
                                <input type="number" name="kode_sesi" value="<?=$kode_sesi?>" hidden>
                                <input type="text" name="kode_matpel" value="<?=$arr_sesi['kode_pelajaran']?>" hidden>
                                <input type="text" name="nama_pengajar" class="form-control" value="<?=$arr_sesi['nama_pengajar']?>" placeholder="Masukan Nama Pengajar" require>
                            </div>
                            <div class="form-group">
                                <p style="display:inline;"> Materi</p>
                                <input type="text" name="materi" class="form-control" value="<?=$arr_sesi['materi']?>" placeholder="Masukan Materi" require>
                            </div>
                            <div class="form-group">
                                <p style="display:inline;"> Tanggal</p>
                                <table>
                                  <tr>
                                    <td><input type="date" name="tanggal" value="<?=$tanggal?>" class="form-control" placeholder="Masukan Tanggal" require></td>
                                    <td style="text-align: right; width: 20%">Dari Pukul:</td>
                                    <td><input type="time" name="mulai" value="<?=$mulai?>" class="form-control" placeholder="Masukan Jam" require></td>
                                    <td style="text-align: right; width: 20%">Hingga pukul:</td>
                                    <td><input type="time" name="selesai" value="<?=$selesai?>" class="form-control" placeholder="Masukan Jam" require></td>
                                  </tr>
                                </table>
                            </div>
                            <button class="btn btn-primary btn-user btn-block" name="edit_sesi"><i class="fa fa-save"></i> Simpan Pertemuan Ke-<?=$arr_sesi['sesi']?></button>
                        </form>
              </div>
            </div>
          </div>

        </div>
    </div>

        
            <!-- Pending Requests Card Example -->
          
      <!-- End of Main Content -->
      <?php require_once ("konek/footer.php");?>