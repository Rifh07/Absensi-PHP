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
                $id = $_GET['actid'];
                $cek_sesi = $konek->query("SELECT * FROM sesi WHERE kode_sesi = '$id'");
                $arr_sesi = $cek_sesi->fetch_assoc();
                $mulai = $arr_sesi['mulai'];
                $m = date("d/m/Y", strtotime($mulai));
                $m_p = date("H:i", strtotime($mulai));
                $selesai = $arr_sesi['selesai'];
                $s = date("d/m/Y", strtotime($selesai));
                $s_p = date("H:i", strtotime($selesai));
                $kode_pelajaran = $arr_sesi['kode_pelajaran'];
                $sesi = $arr_sesi['sesi'];
            ?>

            <!-- Earnings (Monthly) Card Example -->
            <div class="card shadow mb-4">
            <div class="card-header py-3">
                <table>
                    <td style="width: 100%"><h6 class="m-0 font-weight-bold text-primary">Absensi <?php if ($sesi == 6){ echo"TKPI ";} else { echo "Pelajaran ";} echo $kode_pelajaran;?></h6></td>
                    <td><a href="<?=$base?>mata-pelajaran/absen/edit?actid=<?=$id?>" style="text-align: center" class="collapse-item" title="Edit Pertemuan"><i class="fa fa-edit"></i></a></td>
                </table>
              
        
            </div>
            <div class="card-body">
              <div class="table-responsive">
                    <?php
                        if($tgl < $mulai OR $tgl > $selesai){
                            echo"<form class='user' action='' method='POST'>
                            <div class='form-group'>
                                <center>
                                    <input type='number' style='text-align:center; width: 60%;' class='form-control' placeholder='Masukan NIP' readonly>
                                </center>
                            </div>

                        </form>
                        <div class='card mb-0 py-0 border-bottom-danger'>
                            <center>
                                <div class='card-body'>
                                    <i class='btn btn-danger btn-circle btn-sm'>
                                        <span class='icon text-white-50'>
                                            <i class='fas fa-exclamation'></i>
                                        </span>
                                    </i> Absensi dimulai pada tanggal $m dari pukul $m_p hingga pukul $s_p
                                </div>
                            </center>
                        </div><br><br>";

                        } else {
                    ?>
                    <form class="user" action="" method="POST">
                        <div class="form-group">
                            <center>
                                <input type="number" style="text-align:center; width: 60%;" name="nip_absen_pelajaran" class="form-control" placeholder="Masukan NIP" require autofocus>
                            </center>
                        </div>
                    </form>
                        <?php } require_once("konek/func.php")?>
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIP</th>
                                <th>Nama Peserta</th>
                                <th>Angkatan</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                                $no = 1;
                                $cek_peserta1 = $konek->query("SELECT A.nip_peserta, B.nama_peserta, B.angkatan  FROM matpel_peserta A INNER JOIN peserta B ON A.nip_peserta = B.nip WHERE A.kode_pelajaran = '$kode_pelajaran' ORDER BY A.nip_peserta ASC");
                                while ($rows = $cek_peserta1->fetch_assoc()){
                                    $ambil_nip = $rows['nip_peserta'];
                                    $cek_keterangan = $konek->query("SELECT * FROM absen WHERE kode_pelajaran = '$kode_pelajaran' AND sesi = '$sesi' AND nip = '$ambil_nip' ");
                                    $ambil_ket = $cek_keterangan->fetch_assoc();
                        ?>
                            <tr>
                                <td><?=$no?></td>
                                <td><?=$ambil_nip?></td>
                                <td><?=$rows['nama_peserta']?></td>
                                <td><?=$rows['angkatan']?></td>
                                <td><?php if (!$ambil_ket['keterangan']){ echo"Tidak Ada Keterangan";} else { echo $ambil_ket['keterangan'];}?></td>
                            </tr>
                        <?php
                        $no++;
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