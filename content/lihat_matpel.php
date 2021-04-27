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
              <h6 class="m-0 font-weight-bold text-primary">Lihat Mata Pelajaran</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Kode Pelajaran</th>
                      <th>Nama Mata Pelajaran</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
                  $cek_matpel = $konek->query("SELECT * FROM matpel ORDER BY kode_pelajaran ASC");
                  $no = 1;
                  while($matpel = $cek_matpel->fetch_assoc()){
                  ?>
                    <tr>
                       <td><?=$no;?></td>
                       <td><?=$matpel['kode_pelajaran']?></td>
                       <td><?=$matpel['nama_pelajaran']?></td>
                       <td style="text-align: center">
                          <a href="<?=$base?>mata-pelajaran/edit?id=<?=$matpel['kode_pelajaran']?>" class="collapse-item" title="Edit Mata Pelajaran"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                          <a href="<?=$base?>mata-pelajaran/tambah-peserta?actid=<?=$matpel['kode_pelajaran']?>" class="collapse-item" title="Tambah Peserta Dalam Pembelajaran"><i class="fa fa-user-plus"></i></a> &nbsp;&nbsp;
                          <a href="<?=$base?>mata-pelajaran/sesi?id=<?=$matpel['kode_pelajaran']?>" class="collapse-item" title="Lihat Pertemuan"><i class="fa fa-clipboard-list"></i></a>
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