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
              <h6 class="m-0 font-weight-bold text-primary">Tambah Users</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
              <?php require_once("konek/func.php");?>
                        <form class="user" action="" method="POST">
                            <div class="form-group">
                                <p style="display:inline;"> NIP</p>
                                <input type="number" name="nip" class="form-control" placeholder="Masukan NIP" require>
                            </div>
                            <div class="form-group">
                                <p style="display:inline;"> Nama Lengkap</p>
                                <input type="text" name="nama" class="form-control" placeholder="Masukan Nama Lengkap" require>
                            </div>
                            <div class="form-group">
                                <p style="display:inline;"> Email</p>
                                <input type="email" name="email" class="form-control" placeholder="Masukan Email" require>
                            </div>
                            <div class="form-group">
                                <p style="display:inline;"> Angkatan</p>
                                <input type="text" name="angkatan" class="form-control" placeholder="Masukan Angkatan" require>
                            </div>
                            <div class="form-group">
                                <p style="display:inline;"> Level</p>
                                <select class="form-control" require>
								                	<option>Pengurus</option>
								                </select>
                            </div>
                            <button class="btn btn-primary btn-user btn-block" name="tambah_user"><i class="fa fa-user-plus"></i> Tambah Users</button>
                        </form>
              </div>
            </div>
          </div>

        </div>
    </div>

        
            <!-- Pending Requests Card Example -->
          
      <!-- End of Main Content -->
      <?php require_once ("konek/footer.php");?>