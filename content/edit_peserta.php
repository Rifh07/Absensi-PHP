<?php 
require_once ("konek/header.php");
  if ($level !== "Admin") {
    if ($level !== "Pengurus") {
      echo"<script>alert('Maaf Anda tidak memiliki akses untuk ke halaman ini');</script>";
      echo"<script>location='$base1/login';</script>";
    }
  }
    if (isset($_GET['id'])){
        $nip_pesertas = $_GET['id'];

        $cek_pesertas = $konek->query("SELECT * FROM peserta WHERE nip = '$nip_pesertas'");
        $num = $cek_pesertas->num_rows;
        $pecah_peserta = $cek_pesertas->fetch_assoc();
    } else {
        $base = $base."peserta";
        header("location: $base");
    }
?>
        <!-- Begin Page Content -->
        <div class="container-fluid">


          <!-- Content Row -->
          <div class="container-fluid">

            <!-- Earnings (Monthly) Card Example -->
            <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Edit Peserta</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                  <?php require_once("konek/func.php");?>
                        <form class="user" action="" method="POST">
                            <div class="form-group">
                                <p style="display:inline;"> NIP</p>
                                <input type="number" name="nip" class="form-control" placeholder="Masukan NIP" value="<?=$pecah_peserta['nip']?>" require>
                            </div>
                            <div class="form-group">
                                <p style="display:inline;"> Nama Peserta</p>
                                <input type="text" name="nama" class="form-control" placeholder="Masukan Nama" value="<?=$pecah_peserta['nama_peserta']?>" require>
                            </div>
                            <div class="form-group">
                                <p style="display:inline;"> Angkatan</p>
                                <input type="text" name="angkatan" class="form-control" placeholder="Masukan Angkatan" value="<?=$pecah_peserta['angkatan']?>" require>
                            </div>
                            <button class="btn btn-primary btn-user btn-block" name="edit_peserta"><i class="fa fa-save"></i> Simpan</button>
                        </form>
              </div>
            </div>
          </div>
        </div>
    </div>

        
            <!-- Pending Requests Card Example -->
          
      <!-- End of Main Content -->
      <?php require_once ("konek/footer.php");?>