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
                $kode_pelajaran = $_GET['actid'];
                $cek_matpel = $konek->query("SELECT * FROM sesi WHERE kode_pelajaran = '$kode_pelajaran'");
            ?>

            <!-- Earnings (Monthly) Card Example -->
            <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Edit Absensi <?php if ($sesi == 6){ echo"TKPI ";} else { echo "Pelajaran ";} echo $kode_pelajaran;?></h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                    <?php  require_once("konek/func.php")?>
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIP</th>
                                <th>Nama Peserta</th>
                                <th>Angkatan</th>
                                <?php while($rows = $cek_matpel->fetch_assoc()){?>
                                  <th>Sesi <?=$rows['sesi']?></th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                                $no = 1;
                                $cek_peserta1 = $konek->query("SELECT A.nip_peserta, B.nama_peserta, B.angkatan  FROM matpel_peserta A INNER JOIN peserta B ON A.nip_peserta = B.nip WHERE A.kode_pelajaran = '$kode_pelajaran' ORDER BY A.nip_peserta ASC");
                                while ($rows = $cek_peserta1->fetch_assoc()){
                                    $ambil_nip = $rows['nip_peserta'];
                        ?>
                        <form action="" method="POST">
                            <tr>
                                <td><?=$no?></td>
                                <td><?=$ambil_nip?><input type="hidden" name="nip_peserta[<?=$no?>]" value="<?=$ambil_nip?>"></td>
                                <td><?=$rows['nama_peserta']?></td>
                                <td><?=$rows['angkatan']?></td>
                                <?php 
                                      $i = 1;
                                      $kode_pelajaran = $_GET['actid'];
                                      $cek_matpel = $konek->query("SELECT * FROM sesi WHERE kode_pelajaran = '$kode_pelajaran'");
                                      while ($rows2 = $cek_matpel->fetch_assoc()){
                                        $sesi = $rows2['sesi'];
                                        $cek_keterangan = $konek->query("SELECT * FROM absen WHERE kode_pelajaran = '$kode_pelajaran' AND sesi = '$sesi' AND nip = '$ambil_nip' ");
                                        $ambil_ket = $cek_keterangan->fetch_assoc();
                                        $ket = $ambil_ket['keterangan'];
                                    ?>
                                <td>
                                  <select class="form-control" selected="<?php echo $ket;?>" name="keterangan[<?=$no?>-<?=$i?>]">
                                    <option <?php if ($ket==NULL) echo "selected";?>  value="Tidak Hadir">A</option>
									                  <option <?php if ($ket=="Hadir") echo "selected";?> value="Hadir">H</option>
                                  </select> 
                                </td>
                                <?php $i++; } ?>
                            </tr>
                        <?php
                        $no++;
                          }
                        ?>
                        </tbody>
                    </table>
                    <center>
                      <button type="submit" name="update_absen_pelajaran2" class="btn btn-success">Simpan</button>
                    </center>
                    </form>
              </div>
            </div>
          </div>

        </div>
    </div>

        
            <!-- Pending Requests Card Example -->
          
      <!-- End of Main Content -->
<?php require_once ("konek/footer.php");?>