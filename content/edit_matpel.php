<?php 
require_once ("konek/header.php");
  if ($level !== "Admin") {
    if ($level !== "Pengurus") {
      echo"<script>alert('Maaf Anda tidak memiliki akses untuk ke halaman ini');</script>";
      echo"<script>location='$base1/login';</script>";
    }
  }
    if (isset($_GET['id'])){
        $id = $_GET['id'];
        $edit_matpel = $konek->query("SELECT * FROM matpel WHERE kode_pelajaran = '$id'");
        $arr_matpel = $edit_matpel->fetch_assoc();
    }
?>
        <!-- Begin Page Content -->
        <div class="container-fluid">


          <!-- Content Row -->
          <div class="container-fluid">

            <!-- Earnings (Monthly) Card Example -->
            <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Edit Mata Pelajaran</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                    <?php require_once("konek/func.php");?>
                        <form class="user" action="" method="POST">
                            <div class="form-group">
                                <p style="display:inline;"> Kode Pelajaran</p>
                                <input type="text" value="<?=$arr_matpel['kode_pelajaran']?>" name="id" readonly hidden>
                                <input type="text" name="kode_pelajaran" class="form-control" placeholder="Masukan Kode Pelajaran" value="<?=$arr_matpel['kode_pelajaran']?>" require>
                            </div>
                            <div class="form-group">
                                <p style="display:inline;"> Nama Pelajaran</p>
                                <input type="text" name="nama_pelajaran" class="form-control" placeholder="Masukan Nama Pelajaran" value="<?=$arr_matpel['nama_pelajaran']?>" require>
                            </div>
                            <button class="btn btn-primary btn-user btn-block" name="edit_matpel"><i class="fa fa-save"></i> Simpan</button>
                        </form>
              </div>
            </div>
          </div>

        </div>
    </div>

        
            <!-- Pending Requests Card Example -->
          
      <!-- End of Main Content -->
      <?php require_once ("konek/footer.php");?>