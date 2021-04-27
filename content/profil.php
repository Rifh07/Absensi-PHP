<?php 
require_once ("konek/header.php");
  if ($level !== "Admin") {
    if ($level !== "Pengurus") {
      echo"<script>alert('Maaf Anda tidak memiliki akses untuk ke halaman ini');</script>";
      echo"<script>location='$base1/login';</script>";
    }
  }
?>
<div class="container-fluid">
  <div class="row justify-content-center">
  
      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <!-- <div class="col-lg-6 d-none d-lg-block bg-login-image"></div> -->
              <div class="col-lg-6 d-lg-inline-block">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Profil</h1>
                  </div>
                  <?php
                    if(isset($_GET['msg'])){
                        $edit = $_GET['msg'];
                        if ($edit == "t"){
                            echo'<div class="card mb-4 py-3 border-bottom-success">
                                <div class="card-body">
                                    <i class="btn btn-success btn-circle btn-sm">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-check"></i>
                                        </span>
                                    </i> Email Berhasil Diubah
                                </div>
                            </div>';
                        } else if ($edit == "f") {
                            echo'<div class="card mb-4 py-3 border-bottom-danger">
                                <div class="card-body">
                                        <i class="btn btn-danger btn-circle btn-sm">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-times"></i>
                                            </span>
                                        </i> Email Gagal Diubah
                                    </div>
                                </div>';
                        }
                    }
                ?>
                  <form class="user" action="" method="POST">
                     <div class="form-group">
                      <input type="number" class="form-control form-control-user" placeholder="NIP" value="<?=$nip?>" readonly>
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" placeholder="Nama" value="<?=$pecah['nama']?>" readonly>
                    </div>
                    <div class="form-group">
                      <input type="email" name="email" class="form-control form-control-user" placeholder="Email" value="<?=$pecah['email']?>">
                    </div>
                    <input class="btn btn-primary btn-user btn-block" name="ubah_profile_admin" type="submit" value="Ubah Profil">
                  </form>
                </div>
              </div>


              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Password</h1>
                  </div>
                  <?php
                    require_once ("konek/func.php");
                    if(isset($_GET['msg'])){
                        $edit = $_GET['msg'];
                        if ($edit == "tr"){
                            echo'<div class="card mb-4 py-3 border-bottom-success">
                                <div class="card-body">
                                    <i class="btn btn-success btn-circle btn-sm">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-check"></i>
                                        </span>
                                    </i> Password Berhasil Diubah
                                </div>
                            </div>';
                        } else if ($edit == "fa") {
                            echo'<div class="card mb-4 py-3 border-bottom-danger">
                                <div class="card-body">
                                    <i class="btn btn-danger btn-circle btn-sm">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-times"></i>
                                        </span>
                                    </i> Password Gagal Diubah
                                </div>
                            </div>';
                        }
                    }
                  ?>
                  <form class="user" action="" method="POST">
                    <div class="form-group">
                        <input type="password" name="password" class="form-control form-control-user" placeholder="Masukan password saat ini" required>
                    </div>
                    <div class="form-group">
                      <input type="password" name="pass1" class="form-control form-control-user" placeholder="Masukan password yang akan diubah" required>
                    </div>
                    <div class="form-group">
                      <input type="password" name="pass2" class="form-control form-control-user" placeholder="Masukan kembali password yang akan diubah" required>
                    </div>
                    <input class="btn btn-primary btn-user btn-block" name="ubah_password_admin" type="submit" value="Ubah Password">
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
   </div>
   </div>
   <?php require_once ("konek/footer.php");?>