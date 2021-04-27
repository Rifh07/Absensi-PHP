<?php 
require_once ("konek/header.php");
	if ($level !== "Admin") {
	   echo"<script>alert('Maaf Anda tidak memiliki akses untuk ke halaman ini');</script>";
	   echo"<script>location='../';</script>";
    }
    
    if (isset($_GET['id'])){
        $nip_users = $_GET['id'];

        $cek_nip = $konek->query("SELECT * FROM users WHERE nip = '$nip_users'");
        $row_nip = $cek_nip->num_rows;
        $pecah_users = $cek_nip->fetch_assoc();

        if ($row_nip == 0 ){
            $base = $base."users";
            echo"<script>alert('Gagal membuka form!!');</script>";
            echo"<script>location='$base';</script>";
        }
    } else if (!isset($_GET['id'])){
        $base = $base."users";
        header("location: $base");
    }
?>
        <!-- Begin Page Content -->
        <div class="container-fluid">


          <!-- Content Row -->
          <div class="container-fluid">

            <!-- Earnings (Monthly) Card Example -->
            <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Edit Users</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
              <?php require_once("konek/func.php");?>
                        <form class="user" action="" method="POST">
                            <div class="form-group">
                                <p style="display:inline;"> NIP</p>
                                <input type="number" name="nip" class="form-control" placeholder="Masukan NIP" value="<?=$pecah_users['nip']?>" require>
                            </div>
                            <div class="form-group">
                                <p style="display:inline;"> Nama Lengkap</p>
                                <input type="text" name="nama" class="form-control" placeholder="Masukan Nama Lengkap"  value="<?=$pecah_users['nama']?>" require>
                            </div>
                            <div class="form-group">
                                <p style="display:inline;"> Email</p>
                                <input type="email" name="email" class="form-control" placeholder="Masukan email" value="<?=$pecah_users['email']?>" require>
                            </div>
                            <div class="form-group">
                                <p style="display:inline;"> Angkatan</p>
                                <input type="text" name="angkatan" class="form-control" placeholder="Masukan Angkatan" value="<?=$pecah_users['angkatan']?>" require>
                            </div>
                            <button class="btn btn-primary btn-user btn-block" name="edit_users"><i class="fa fa-save"></i> Simpan</button>
                        </form>
              </div>
            </div>
          </div>

        </div>
    </div>

        
            <!-- Pending Requests Card Example -->
          
      <!-- End of Main Content -->
      <?php require_once ("konek/footer.php");?>