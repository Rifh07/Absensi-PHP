<?php 
require_once ("konek/header.php");
  if ($level !== "Admin") {
    if ($level !== "Pengurus") {
      echo"<script>alert('Maaf Anda tidak memiliki akses untuk ke halaman ini');</script>";
      echo"<script>location='$base1/login';</script>";
    }
  }
    if(isset($_GET['actid'])){
        $kode_matpel = $_GET['actid'];
        $cek_tkpi = $konek->query("SELECT * FROM sesi WHERE kode_pelajaran = '$kode_matpel' AND materi = 'TKPI'");
        $rows_tkpi = $cek_tkpi->num_rows;
        
        if ($rows_tkpi > 0){
            echo"<script>alert('Hanya bisa membuat 1 TKPI');</script>";
            echo"<script>location='$base1/mata-pelajaran/sesi?id=$kode_matpel';</script>";
        } else {
            $cek_sesi = $konek->query("SELECT * FROM sesi WHERE kode_pelajaran = '$kode_matpel'");
            $row = $cek_sesi->num_rows;
            $sesi = $row+1;
        }
    } else { echo"<script>location='$base1/mata-pelajaran';</script>"; } 
?>
        <!-- Begin Page Content -->
        <div class="container-fluid">


          <!-- Content Row -->
          <div class="container-fluid">

            <!-- Earnings (Monthly) Card Example -->
            <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Buat TKPI <?=$kode_matpel?></h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                  <?php require_once("konek/func.php")?>
                        <form class="user" action="" method="POST">
                            <div class="form-group">
                                <p style="display:inline;"> Nama Pengajar</p>
                                <input type="text" name="nama_pengajar" class="form-control" placeholder="Masukan Nama Pengajar" require>
                            </div>
                            <div class="form-group">
                                <p style="display:inline;"> Nama Pengawas</p>
                                <input type="text" name="pengawas" class="form-control" placeholder="Masukan Nama Pengawas" require>
                            </div>
                            <div class="form-group">
                                <p style="display:inline;"> Tanggal</p>
                                <table>
                                  <tr>
                                    <td><input type="date" name="tanggal" class="form-control" placeholder="Masukan Tanggal" require></td>
                                    <td style="text-align: right; width: 20%">Dari Pukul:</td>
                                    <td><input type="time" name="mulai" class="form-control" placeholder="Masukan Jam" require></td>
                                    <td style="text-align: right; width: 20%">Hingga pukul:</td>
                                    <td><input type="time" name="selesai" class="form-control" placeholder="Masukan Jam" require></td>
                                  </tr>
                                </table>
                            </div>
                            <button class="btn btn-primary btn-user btn-block" name="buat_tkpi">Buat TKPI</button>
                        </form>
              </div>
            </div>
          </div>

        </div>
    </div>

        
            <!-- Pending Requests Card Example -->
          
      <!-- End of Main Content -->
      <?php require_once ("konek/footer.php");?>