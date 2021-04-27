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
            <div class='card mb-5 py-0 border-bottom-danger'>
                    <center>
                        <div class='card-body'>
                            <i class='btn btn-danger btn-circle btn-sm'>
                                <span class='icon text-white-50'>
                                    <i class='fas fa-exclamation'></i>
                                </span>
                            </i> Maaf, Sistem sedang diperbaiki!!
                        </div>
                    </center>
                </div>


          <!-- Content Row -->
          <div class="container-fluid">

            <!-- Earnings (Monthly) Card Example -->
            <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Lihat Peserta</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>NIP</th>
                      <th>Nama Lengkap</th>
                      <th>Angkatan</th>
                      <th>Saldo</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
                  $cek_peserta = $konek2->query("SELECT * FROM users ORDER BY login ASC");
                  $no = 1;
                  while($peserta = $cek_peserta->fetch_assoc()){
                  ?>
                    <tr>
                       <td><?=$no;?></td>
                       <td><?=$peserta['login']?></td>
                       <td  width="30%"><?=$peserta['surname']?></td>
                       <td><?="2016"?></td>
                       <td>Rp.<?= number_format(("30000"), 0, ".", ".");?>,-</td>
                       <td style="text-align: center">
                          <a href="<?=$base?>peserta/edit?id=<?=$peserta['login']?>" class="collapse-item" title="Edit Peserta"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;&nbsp;
                          <a href="<?=$base?>peserta/saldo?id=<?=$peserta['login']?>" class="collapse-item" title="Tambah Saldo Peserta"><i class="fa fa-money-bill-wave"></i></a>
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