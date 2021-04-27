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
            if (isset($_GET['id'])){
              $id = $_GET['id'];
              $no = 1;
              $cek_sesi = $konek->query("SELECT * FROM sesi WHERE kode_pelajaran = '$id' AND materi != 'TKPI'");
              $row = $cek_sesi->num_rows;
              $cek_tkpi = $konek->query("SELECT * FROM sesi WHERE kode_pelajaran = '$id' AND materi = 'TKPI'");
              $row_tkpi = $cek_tkpi->num_rows;
          ?>

            <!-- Earnings (Monthly) Card Example -->
            <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Lihat Pertemuan <?=$id?></h6>
            </div>
            <div class="card-body">
            <?php if ($row < 5) { 
              echo "<a href='$base1/mata-pelajaran/sesi/buat?actid=$id' class='btn btn-success' title='Tambah Pertemuan'><i class='fa fa-plus'> Tambah Pertemuan</i></a><br><br>";
             } else if ($row == 5 AND $row_tkpi == 0){
              echo "<a href='$base1/mata-pelajaran/tkpi/buat?actid=$id' class='btn btn-success' title='Tambah Pertemuan'><i class='fa fa-plus'> Buat TKPI</i></a><br><br>";
            } else {

            } ?>

              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Pengajar</th>
                      <th>Materi</th>
                      <th>Pertemuan</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
                    while($sesi = $cek_sesi->fetch_assoc()){ 
                  ?>
                    <tr>
                       <td><?=$no;?></td>
                       <td><?=$sesi['nama_pengajar']?></td>
                       <td><?=$sesi['materi']?></td>
                       <td><?=$sesi['sesi']?></td>
                       <td style="text-align: center;">
                          <a href="<?=$base?>mata-pelajaran/sesi/edit?actid=<?=$sesi['kode_sesi']?>" class="collapse-item" title="Edit Pertemuan"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                          <a href="<?=$base?>mata-pelajaran/sesi/absen?actid=<?=$sesi['kode_sesi']?>" class="collapse-item" title="Absen Pertemuan"><i class="fa fa-clipboard"></i></a>&nbsp;&nbsp;
                          <a href="<?=$base?>mata-pelajaran/sesi/export?actid=<?=$sesi['kode_sesi']?>" class="collapse-item" title="Export & Download"><i class="fa fa-file-export"></i></a>
                       </td>
                    </tr>
                  <?php
                  $no++;
                    }
                  }
                  ?>
                  </tbody>
                </table>
                <?php
                    if ($row_tkpi > 0){
                      while ($arr_tkpi = $cek_tkpi->fetch_assoc()) {
                ?>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th style="text-align: center; width: 85%"><?=$arr_tkpi['materi']?></th>
                      <th style="text-align: center;">
                          <a href="<?=$base?>mata-pelajaran/tkpi/edit?actid=<?=$arr_tkpi['kode_sesi']?>" class="collapse-item" title="Edit TKPI"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                          <a href="<?=$base?>mata-pelajaran/tkpi/absen?actid=<?=$arr_tkpi['kode_sesi']?>" class="collapse-item" title="Absen TKPI"><i class="fa fa-clipboard"></i></a>&nbsp;&nbsp;
                          <a href="<?=$base?>mata-pelajaran/tkpi/export?actid=<?=$arr_tkpi['kode_sesi']?>" class="collapse-item" title="Export & Download"><i class="fa fa-file-export"></i></a>
                      </th>
                    </tr>
                  </thead>
                </table>
                      <?php } } ?>
              </div>
            </div>
          </div>

        </div>
    </div>

        
            <!-- Pending Requests Card Example -->
          
      <!-- End of Main Content -->
      <?php require_once ("konek/footer.php");?>