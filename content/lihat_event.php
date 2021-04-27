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
              <h6 class="m-0 font-weight-bold text-primary">Lihat Event</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Event</th>
                      <th>Deskripsi</th>
                      <th>Start</th>
                      <th>End</th>
                      <th>Act</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
                  $cek_event = $konek->query("SELECT * FROM events ORDER BY id_event DESC");
                  $no = 1;
                  while($event = $cek_event->fetch_assoc()){
                      $m = $event['tanggal_m_event'];
                      $s = $event['tanggal_s_event'];
                  ?>
                    <tr>
                       <td><?=$no;?></td>
                       <td><?=$event['nama_event']?></td>
                       <td  width="30%"><?=$event['deskripsi_event']?></td>
                       <td><?=date("d/m/Y H:i", strtotime($m))?></td>
                       <td><?=date("d/m/Y H:i", strtotime($s))?></td>
                       <td>
                          <a href="<?=$base?>event/edit?actid=<?=$event['id_event']?>" class="collapse-item" title="Edit Event"><i class="fa fa-edit"></i></a> &nbsp;&nbsp;
                          <a href="<?=$base?>event/tambah-peserta?actid=<?=$event['id_event']?>" class="collapse-item" title="Tambah Peserta Dalam Event"><i class="fa fa-user-plus"></i></a> &nbsp;&nbsp;
                          <a href="<?=$base?>event/absen?actid=<?=$event['id_event']?>" class="collapse-item" title="Absen"><i class="fa fa-clipboard"></i></a> &nbsp;&nbsp;
                          <a href="<?=$base?>event/export?actid=<?=$event['id_event']?>" class="collapse-item" title="Export & Download"><i class="fa fa-file-export"></i></a>
                          
                        </td>
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