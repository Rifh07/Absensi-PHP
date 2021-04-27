<?php 
require_once ("konek/header.php");
	if ($level !== "Admin") {
	   echo"<script>alert('Maaf Anda tidak memiliki akses untuk ke halaman ini');</script>";
	   echo"<script>location='../';</script>";
	}
?>
        <!-- Begin Page Content -->
        <div class="container-fluid">


          <!-- Content Row -->
          <div class="container-fluid">

            <!-- Earnings (Monthly) Card Example -->
            <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Lihat Users</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
              <?php require_once("konek/func.php") ?>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>NIP</th>
                      <th>Nama Lengkap</th>
                      <th>Angkatan</th>
                      <th>Level</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
                  $cek_peserta = $konek->query("SELECT * FROM users WHERE level = 'Pengurus' ORDER BY nip ASC");
                  $no = 1;
                  while($peserta = $cek_peserta->fetch_assoc()){
                  ?>
                    <tr>
                       <td><?=$no;?></td>
                       <td><?=$peserta['nip']?></td>
                       <td  width="30%"><?=$peserta['nama']?></td>
                       <td><?=$peserta['angkatan']?></td>
                       <td><?=$peserta['level']?></td>
                       <td style="text-align: center">
                          <a href="<?=$base?>users/edit?id=<?=$peserta['nip']?>" class="collapse-item" title="Edit Users"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                          <!-- <a class="collapse-item" href="<?=$base?>users/hapus?id=<?=$peserta['nip']?>"  title="Hapus Users" onclick="javascript: return confirm('Yakin Hapus?')"><i class="fa fa-times" style="color: red"></i></a> -->
                          <a href="#" class="collapse-item hapusbtn" title="Hapus Users" > <i class="fa fa-times" style="color: red"></i></a>
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

<!-- hapus Modal-->
<div class="modal fade" id="hapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Apakah Anda yakin ingin menghapus user tersebut?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
         <div class="modal-body">Pilih "Hapus" di bawah ini jika Anda ingin menghapus.</div>
         <form action="" method="POST">
            <div class="modal-footer">
              <input type="hidden" name="nip_users" id="nip_users">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
              <button class="btn btn-danger" type="submit" name="hapus_user">Hapus</button>
            </div>
         </form>

      </div>
    </div>
  </div>

        
            <!-- Pending Requests Card Example -->
          
      <!-- End of Main Content -->
      <?php require_once ("konek/footer.php");?>