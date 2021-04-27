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

          <?php if(isset($_GET['actid'])){
              $id = $_GET['actid'];
          }
          ?>

            <!-- Earnings (Monthly) Card Example -->
            <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Tambah Peserta Di <?=$id?> </h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                    <form class="user" action="" method="POST">
                        <div class="form-group">
                            <center>
                                <input type="number" style="text-align:center; width: 60%;" name="nip_peserta_pelajaran" class="form-control" placeholder="Masukan NIP" require autofocus>
                            </center>
                        </div>
                    </form>
                    <?php require_once("konek/func.php") ?>
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIP</th>
                                <th>Nama Peserta</th>
                                <th>Angkatan</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            if(isset($_GET['actid'])){
                                $id = $_GET['actid'];
                                $no = 1;
                                $cek_ikut_pelajaran = $konek->query("SELECT C.nip, C.nama_peserta, C.angkatan FROM matpel A INNER JOIN matpel_peserta B INNER JOIN peserta C ON A.kode_pelajaran = B.kode_pelajaran AND B.nip_peserta = C.nip WHERE A.kode_pelajaran = '$id' ORDER BY B.nip_peserta ASC");
                                while ($rows = $cek_ikut_pelajaran->fetch_assoc()){
                        ?>
                            <tr>
                                <td><?=$no?></td>
                                <td><?=$rows['nip']?></td>
                                <td><?=$rows['nama_peserta']?></td>
                                <td><?=$rows['angkatan']?></td>
                            </tr>
                        <?php
                        $no++;
                                }
                            }
                        ?>
                        </tbody>
                    </table>
              </div>
            </div>
          </div>

        </div>
    </div>

        
            <!-- Pending Requests Card Example -->
          
      <!-- End of Main Content -->
      <?php require_once ("konek/footer.php");?>