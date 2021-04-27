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
              <h6 class="m-0 font-weight-bold text-primary">Riwayat Transaksi</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>NIP</th>
                      <th>Nama Lengkap</th>
                      <th>Mendaftar</th>
                      <th>Biaya</th>
                      <th>Tanggal</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
                  $cek_histori = $konek->query("SELECT A.nip, B.nama_peserta, C.nama_event, A.bayar, A.tanggal FROM transaksi A INNER JOIN peserta B INNER JOIN events C ON A.id_event = C.id_event AND A.nip = B.nip ORDER BY A.tanggal DESC");
                  $no = 1;
                  while($histori = $cek_histori->fetch_assoc()){
                  ?>
                    <tr>
                       <td><?=$no;?></td>
                       <td><?=$histori['nip']?></td>
                       <td  width="30%"><?=$histori['nama_peserta']?></td>
                       <td><?=$histori['nama_event']?></td>
                       <td><?=$histori['bayar']?></td>
                       <td><?=date("d/m/Y H:i", strtotime($histori['tanggal']))?></td>
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