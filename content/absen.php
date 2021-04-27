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
              <h6 class="m-0 font-weight-bold text-primary">Absensi Event</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                    <?php
                        $id = $_GET['actid'];
                        $cek_event_id = $konek->query("SELECT * FROM events WHERE id_event = '$id'");
                        $arr_event_id = $cek_event_id->fetch_assoc();
                        $mulai = $arr_event_id['tanggal_m_event'];
                        $m = date("d/m/Y", strtotime($mulai));
                        $m_p = date("H:i", strtotime($mulai));
                        $selesai = $arr_event_id['tanggal_s_event'];
                        $s = date("d/m/Y", strtotime($selesai));
                        $s_p = date("H:i", strtotime($selesai));
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
                                    </i> Absensi dimulai pada tanggal $m pukul $m_p <br>
                                    dan berakhir pada tanggal $s pukul $s_p
                                </div>
                            </center>
                        </div><br><br>";

                        } else {
                    ?>
                    <form class="user" action="" method="POST">
                        <div class="form-group">
                            <center>
                                <input type="number" style="text-align:center; width: 60%;" name="nip_absensi_event" class="form-control" placeholder="Masukan NIP" require autofocus>
                            </center>
                        </div>
                    </form>
                    <?php } require_once ("konek/func.php");?>
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
                            if(isset($_GET['actid'])){
                                $id = $_GET['actid'];
                                $no = 1;
                                $cek_ikut_event = $konek->query("SELECT C.nip, C.nama_peserta, C.angkatan, B.keterangan FROM events A INNER JOIN events_peserta B INNER JOIN peserta C ON A.id_event = B.id_event AND B.nip_peserta = C.nip WHERE A.id_event = '$id'");
                                while ($rows = $cek_ikut_event->fetch_assoc()){
                                    $ket = $rows['keterangan'];
                        ?>
                            <tr>
                                <td><?=$no?></td>
                                <td><?=$rows['nip']?></td>
                                <td><?=$rows['nama_peserta']?></td>
                                <td><?=$rows['angkatan']?></td>
                                <td><?php if (!$ket){ echo"Tidak Ada Keterangan";} else { echo "$ket";}?></td>
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