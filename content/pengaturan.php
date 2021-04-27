<?php 
require_once ("konek/header.php");
  if ($level !== "Admin") {
      echo"<script>location='$base1/404';</script>";
  }
?>
        <!-- Begin Page Content -->
        <div class="container-fluid">


          <!-- Content Row -->
          <div class="container-fluid">

            <!-- Earnings (Monthly) Card Example -->
            <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-cog"></i> Pengaturan</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th style="text-align: center; width: 5%">#</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                       <td style="text-align: center">1</td>
                       <td><a href="<?=$base?>settings/mata-pelajaran/hapus">Hapus Semua Mata Pelajaran</a></td>
                    </tr>
                    <tr>
                       <td style="text-align: center">2</td>
                       <td><a href="<?=$base?>settings/event/hapus">Hapus Semua Event</a></td>
                    </tr>
                    <tr>
                       <td style="text-align: center">3</td>
                       <td><a href="<?=$base?>settings/users/hapus">Hapus Semua Users</a></td>
                    </tr>
                    <tr>
                       <td style="text-align: center">4</td>
                       <td><a href="<?=$base?>settings/peserta/hapus">Hapus Semua Peserta</a></td>
                    </tr>
                    <!--<tr>-->
                    <!--   <td style="text-align: center">5</td>-->
                    <!--   <td><a href="<?=$base?>settings/pemilihan">Hapus Semua Pemilihan</a></td>-->
                    <!--</tr>-->
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