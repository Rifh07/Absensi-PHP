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
                                <input type="number" class="form-control" placeholder="NIP" value="<?=$pecah_peserta['nip']?>" readonly>
                            </div>
                            <div class="form-group">
                                <p style="display:inline;"> Nama Peserta</p>
                                <input type="text" class="form-control" placeholder="Nama" value="<?=$pecah_peserta['nama_peserta']?>" readonly>
                            </div>
                            <div class="form-group">
                                <p style="display:inline;"> Angkatan</p>
                                <input type="text" class="form-control" placeholder="Angkatan" value="<?=$pecah_peserta['angkatan']?>" readonly>
                            </div>
                            <div class="form-group">
                                <p style="display:inline;"> Saldo Peserta</p>
                                <input type="text" class="form-control" placeholder="Saldo" value="Rp.<?= number_format(($pecah_peserta['saldo']), 0, ".", ".");?>,-" readonly>
                            </div>
                            <div class="form-group">
                                <p style="display:inline;"> Tambah Saldo Peserta</p>
                                <input type="number" name="t_saldo" class="form-control" placeholder="Masukan Jumlah Saldo" value="0" require>
                            </div>
                            <button class="btn btn-primary btn-user btn-block" name="tambah_saldo"><i class="fa fa-money-bill-wave"></i> Tambah Saldo</button>
                        </form>
              </div>
            </div>
          </div>
        </div>
    </div>

        
            <!-- Pending Requests Card Example -->
          
      <!-- End of Main Content -->
      <?php require_once ("konek/footer.php");?>