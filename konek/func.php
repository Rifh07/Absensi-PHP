<?php

        //LOGIN


if (isset($_POST['login'])){
    $nip = $konek->escape_string($_POST['nip']);
    $password = md5($_POST['password']);

    //cek db user
    $cek = $konek->query("SELECT * FROM users WHERE nip='$nip' AND password='$password'");
    // cek row user
    $cekrow = $cek->num_rows;
    //akun yang cocok
    if($cekrow > 0){
        $pecah = $cek->fetch_assoc();
        $_SESSION['level'] = $pecah['level'];
        $_SESSION['nip'] = $nip;
        echo "<script>window.location.href='$base';</script>";
    } else if ($cekrow ==0) {
        echo"<div class='card mb-5 py-0 border-bottom-danger'>
                <center>
                    <div class='card-body'>
                        <i class='btn btn-danger btn-circle btn-sm'>
                            <span class='icon text-white-50'>
                                <i class='fas fa-exclamation'></i>
                            </span>
                        </i> Gagal login!!
                    </div>
                </center>
            </div>";
    }
}

    // BUAT EVENT


if (isset($_POST['buat_event'])){
    $nip = $_SESSION['nip'];
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $ketua = $_POST['ketua'];
    $biaya = $_POST['biaya'];
    $tm = $_POST['tm'];
    $jm = date("H:i:s", strtotime($_POST['jm']));
    $ts = $_POST['ts'];
    $js = date("H:i:s", strtotime($_POST['js']));
    $mulai = $tm." ".$jm;
    $selesai = $ts." ".$js;

    $nama_file = $_FILES['gambar']['name'];
    $tipe_file = $_FILES['gambar']['type'];
    $tmp_file = $_FILES['gambar']['tmp_name'];
    $path = "img/acara/".$nama_file;

    if ($nama_file){
        if ($tipe_file == "image/jpeg" OR "image/jpg" OR "image/png"){
            if (move_uploaded_file($tmp_file, $path)){
                $insrt = $konek->query("INSERT INTO events (nama_event, deskripsi_event, ketua, gambar, harga, tanggal_m_event, tanggal_s_event, created)
                        VALUES ('$nama', '$deskripsi', '$ketua', '$nama_file', '$biaya', '$mulai', '$selesai', '$nip')");
                if ($insrt){
                    echo"<div class='card mb-5 py-0 border-bottom-success'>
                            <center>
                                <div class='card-body'>
                                    <i class='btn btn-success btn-circle btn-sm'>
                                        <span class='icon text-white-50'>
                                            <i class='fas fa-check'></i>
                                        </span>
                                    </i> Event Berhasil Dibuat
                                </div>
                            </center>
                            </div>";
                } else {
                    echo"<div class='card mb-5 py-0 border-bottom-danger'>
                    <center>
                        <div class='card-body'>
                            <i class='btn btn-danger btn-circle btn-sm'>
                                <span class='icon text-white-50'>
                                    <i class='fas fa-exclamation'></i>
                                </span>
                            </i> Event Gagal Dibuat!!! 1
                        </div>
                    </center>
                </div>";
                }
            } else {
                echo"<div class='card mb-5 py-0 border-bottom-danger'>
                    <center>
                        <div class='card-body'>
                            <i class='btn btn-danger btn-circle btn-sm'>
                                <span class='icon text-white-50'>
                                    <i class='fas fa-exclamation'></i>
                                </span>
                            </i> Gambar Gagal Diupload!!!
                        </div>
                    </center>
                </div>";
            }
        } else {
            echo"<div class='card mb-5 py-0 border-bottom-danger'>
                    <center>
                        <div class='card-body'>
                            <i class='btn btn-danger btn-circle btn-sm'>
                                <span class='icon text-white-50'>
                                    <i class='fas fa-exclamation'></i>
                                </span>
                            </i> Tipe Gambar Harus JPEG/JPG/PNG!!!
                        </div>
                    </center>
                </div>";
        }
    } else if (!$nama_file){
        $insrt = $konek->query("INSERT INTO events (nama_event, deskripsi_event, ketua, harga, tanggal_m_event, tanggal_s_event, created)
                VALUES ('$nama', '$deskripsi', '$ketua', '$biaya', '$mulai', '$selesai', '$nip')");
        if ($insrt){
            echo"<div class='card mb-5 py-0 border-bottom-success'>
                            <center>
                                <div class='card-body'>
                                    <i class='btn btn-success btn-circle btn-sm'>
                                        <span class='icon text-white-50'>
                                            <i class='fas fa-check'></i>
                                        </span>
                                    </i> Event Berhasil Dibuat
                                </div>
                            </center>
                            </div>";
        } else {
            echo"<div class='card mb-5 py-0 border-bottom-danger'>
            <center>
                <div class='card-body'>
                    <i class='btn btn-danger btn-circle btn-sm'>
                        <span class='icon text-white-50'>
                            <i class='fas fa-exclamation'></i>
                        </span>
                    </i> Event Gagal Dibuat!!! 2
                </div>
            </center>
        </div>";
        }
    } else {
        echo"<div class='card mb-5 py-0 border-bottom-danger'>
                    <center>
                        <div class='card-body'>
                            <i class='btn btn-danger btn-circle btn-sm'>
                                <span class='icon text-white-50'>
                                    <i class='fas fa-exclamation'></i>
                                </span>
                            </i> Event Gagal Dibuat!!! 3
                        </div>
                    </center>
                </div>";
    }
}


        // EDIT EVENT


if (isset($_POST['edit_event'])){
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $ketua = $_POST['ketua'];
    $biaya = $_POST['biaya'];
    $tm = $_POST['tm'];
    $jm = $_POST['jm'];
    $ts = $_POST['ts'];
    $js = $_POST['js'];
    $mulai = $tm." ".$jm;
    $selesai = $ts." ".$js;

    $nama_file = $_FILES['gambar']['name'];
    $tipe_file = $_FILES['gambar']['type'];
    $tmp_file = $_FILES['gambar']['tmp_name'];
    $path = "img/acara/".$nama_file;

    if ($nama_file){
        if ($tipe_file == "image/jpeg" OR "image/jpg" OR "image/png"){
            if (move_uploaded_file($tmp_file, $path)){
                $insrt = $konek->query("UPDATE events SET nama_event = '$nama', deskripsi_event = '$deskripsi', ketua = '$ketua', gambar = '$nama_file', harga = '$biaya', tanggal_m_event = '$mulai', tanggal_s_event = '$selesai' WHERE id_event = '$id' ");
                if ($insrt){
                    echo"<div class='card mb-5 py-0 border-bottom-success'>
                            <center>
                                <div class='card-body'>
                                    <i class='btn btn-success btn-circle btn-sm'>
                                        <span class='icon text-white-50'>
                                            <i class='fas fa-check'></i>
                                        </span>
                                    </i> Event Berhasil Dibuat
                                </div>
                            </center>
                            </div>";
                } else {
                    echo"<div class='card mb-5 py-0 border-bottom-danger'>
                    <center>
                        <div class='card-body'>
                            <i class='btn btn-danger btn-circle btn-sm'>
                                <span class='icon text-white-50'>
                                    <i class='fas fa-exclamation'></i>
                                </span>
                            </i> Event gagal diubah!!!
                        </div>
                    </center>
                </div>";
                }
            } else {
                echo"<div class='card mb-5 py-0 border-bottom-danger'>
                    <center>
                        <div class='card-body'>
                            <i class='btn btn-danger btn-circle btn-sm'>
                                <span class='icon text-white-50'>
                                    <i class='fas fa-exclamation'></i>
                                </span>
                            </i> Gambar Gagal Diupload!!!
                        </div>
                    </center>
                </div>";
            }
        } else {
            echo"<div class='card mb-5 py-0 border-bottom-danger'>
                    <center>
                        <div class='card-body'>
                            <i class='btn btn-danger btn-circle btn-sm'>
                                <span class='icon text-white-50'>
                                    <i class='fas fa-exclamation'></i>
                                </span>
                            </i> Tipe Gambar Harus JPEG/JPG/PNG!!!
                        </div>
                    </center>
                </div>";
        }
    } else if (!$nama_file){
        $insrt = $konek->query("UPDATE events SET nama_event = '$nama', deskripsi_event = '$deskripsi', ketua = '$ketua', harga = '$biaya', tanggal_m_event = '$mulai', tanggal_s_event = '$selesai' WHERE id_event = '$id' ");
        if ($insrt){
            echo"<div class='card mb-5 py-0 border-bottom-success'>
                            <center>
                                <div class='card-body'>
                                    <i class='btn btn-success btn-circle btn-sm'>
                                        <span class='icon text-white-50'>
                                            <i class='fas fa-check'></i>
                                        </span>
                                    </i> Event Berhasil Dibuat
                                </div>
                            </center>
                            </div>";
        } else {
            echo"<div class='card mb-5 py-0 border-bottom-danger'>
                    <center>
                        <div class='card-body'>
                            <i class='btn btn-danger btn-circle btn-sm'>
                                <span class='icon text-white-50'>
                                    <i class='fas fa-exclamation'></i>
                                </span>
                            </i> Event gagal diubah!!!
                        </div>
                    </center>
                </div>";
        }
    } else {
        echo"<div class='card mb-5 py-0 border-bottom-danger'>
                    <center>
                        <div class='card-body'>
                            <i class='btn btn-danger btn-circle btn-sm'>
                                <span class='icon text-white-50'>
                                    <i class='fas fa-exclamation'></i>
                                </span>
                            </i> Event gagal diubah!!!
                        </div>
                    </center>
                </div>";
    }
}



    // TAMBAH PESERTA


if (isset($_POST['tambah_peserta'])){
    $nip_peserta = $_POST['nip'];
    $nama = $_POST['nama'];
    $angkatan = $_POST['angkatan'];
    
    $cek_peserta = $konek->query("SELECT * FROM peserta WHERE nip = '$nip_peserta'");
    $num = $cek_peserta->num_rows;

    if ($num == 0){
        $insrt = $konek->query("INSERT INTO peserta VALUES ('$nip_peserta', '$nama', '$angkatan', 0, 'Aktif') ");
        if ($insrt){
            echo"<div class='card mb-5 py-0 border-bottom-success'>
                            <center>
                                <div class='card-body'>
                                    <i class='btn btn-success btn-circle btn-sm'>
                                        <span class='icon text-white-50'>
                                            <i class='fas fa-check'></i>
                                        </span>
                                    </i> $nip_peserta Berhasil ditambahkan
                                </div>
                            </center>
                            </div>";
        } else {
            echo"<div class='card mb-5 py-0 border-bottom-danger'>
                    <center>
                        <div class='card-body'>
                            <i class='btn btn-danger btn-circle btn-sm'>
                                <span class='icon text-white-50'>
                                    <i class='fas fa-exclamation'></i>
                                </span>
                            </i> $nip_peserta Gagal ditambahkan!!!
                        </div>
                    </center>
                </div>";
        }
    } else if ($num > 0){
        echo"<div class='card mb-5 py-0 border-bottom-danger'>
                    <center>
                        <div class='card-body'>
                            <i class='btn btn-danger btn-circle btn-sm'>
                                <span class='icon text-white-50'>
                                    <i class='fas fa-exclamation'></i>
                                </span>
                            </i> $nip_peserta Sudah terdaftar!!!
                        </div>
                    </center>
                </div>";
    } else {
        echo"<div class='card mb-5 py-0 border-bottom-danger'>
                    <center>
                        <div class='card-body'>
                            <i class='btn btn-danger btn-circle btn-sm'>
                                <span class='icon text-white-50'>
                                    <i class='fas fa-exclamation'></i>
                                </span>
                            </i> $nip_peserta Gagal ditambahkan!!!
                        </div>
                    </center>
                </div>";
    }
}


        // TAMBAH USER


if (isset($_POST['tambah_user'])){
    $nip_user = $_POST['nip'];
    $email = $_POST['email'];
    $nama = $_POST['nama'];
    $angkatan = $_POST['angkatan'];
    
    $cek_users = $konek->query("SELECT * FROM users WHERE nip = '$nip_user'");
    $num = $cek_users->num_rows;

    if ($num == 0){
        $insrt = $konek->query("INSERT INTO users (nip, email, nama, angkatan, level, created) VALUES ('$nip_user', '$email', '$nama', '$angkatan', 'Pengurus', '$nip')");
        if ($insrt){
            echo"<div class='card mb-5 py-0 border-bottom-success'>
                <center>
                    <div class='card-body'>
                        <i class='btn btn-success btn-circle btn-sm'>
                            <span class='icon text-white-50'>
                                <i class='fas fa-check'></i>
                            </span>
                        </i> User berhasil ditambahkan!!
                    </div>
                </center>
            </div>";
        } else {
            echo"<div class='card mb-5 py-0 border-bottom-danger'>
                <center>
                    <div class='card-body'>
                        <i class='btn btn-danger btn-circle btn-sm'>
                            <span class='icon text-white-50'>
                                <i class='fas fa-exclamation'></i>
                            </span>
                        </i> Gagal menambahkan user 1!!!
                    </div>
                </center>
            </div>";
        }
    } else if ($num > 0){
        echo"<div class='card mb-5 py-0 border-bottom-danger'>
                    <center>
                        <div class='card-body'>
                            <i class='btn btn-danger btn-circle btn-sm'>
                                <span class='icon text-white-50'>
                                    <i class='fas fa-exclamation'></i>
                                </span>
                            </i> $nip_user sudah terdaftar!!!
                        </div>
                    </center>
                </div>";
    } else {
        echo"<div class='card mb-5 py-0 border-bottom-danger'>
                    <center>
                        <div class='card-body'>
                            <i class='btn btn-danger btn-circle btn-sm'>
                                <span class='icon text-white-50'>
                                    <i class='fas fa-exclamation'></i>
                                </span>
                            </i> Gagal menambahkan user 2!!!
                        </div>
                    </center>
                </div>";
    }
}


        // BUAT MATA PELAJARAN


if (isset($_POST['buat_matpel'])){
    $kode_pelajaran = $_POST['kode_pelajaran'];
    $nama_pelajaran = $_POST['nama_pelajaran'];

    $cek_matpel = $konek->query("SELECT * FROM matpel WHERE kode_pelajaran = '$kode_pelajaran'");
    $num_row_matpel = $cek_matpel->num_rows;
    
    if ($num_row_matpel == 0){
        $insrt = $konek->query("INSERT INTO matpel VALUES ('$kode_pelajaran', '$nama_pelajaran') ");
        if ($insrt){
            echo"<div class='card mb-5 py-0 border-bottom-success'>
                    <center>
                        <div class='card-body'>
                            <i class='btn btn-success btn-circle btn-sm'>
                                <span class='icon text-white-50'>
                                    <i class='fas fa-check'></i>
                                </span>
                            </i> Berhasil membuat mata pelajaran
                        </div>
                    </center>
                </div>";
        } else {
            echo"<div class='card mb-5 py-0 border-bottom-danger'>
                    <center>
                        <div class='card-body'>
                            <i class='btn btn-danger btn-circle btn-sm'>
                                <span class='icon text-white-50'>
                                    <i class='fas fa-exclamation'></i>
                                </span>
                            </i> Gagal membuat mata pelajaran!!!
                        </div>
                    </center>
                </div>";
        }
    } else if ($num_row_matpel > 0){
        echo"<div class='card mb-5 py-0 border-bottom-danger'>
                <center>
                    <div class='card-body'>
                        <i class='btn btn-danger btn-circle btn-sm'>
                            <span class='icon text-white-50'>
                                <i class='fas fa-exclamation'></i>
                            </span>
                        </i> Kode mata pelajaran telah digunakan!!!
                    </div>
                </center>
            </div>";
    } else {
        echo"<div class='card mb-5 py-0 border-bottom-danger'>
                <center>
                    <div class='card-body'>
                        <i class='btn btn-danger btn-circle btn-sm'>
                            <span class='icon text-white-50'>
                                <i class='fas fa-exclamation'></i>
                            </span>
                        </i> Gagal membuat mata pelajaran!!!
                    </div>
                </center>
            </div>";
    }
}


        // EDIT MATA PELAJARAN


if (isset($_POST['edit_matpel'])){
    $id = $_POST['id'];
    $kode_pelajaran = $_POST['kode_pelajaran'];
    $nama_pelajaran = $_POST['nama_pelajaran'];

    $cek_matpel = $konek->query("SELECT * FROM matpel WHERE kode_pelajaran = '$kode_pelajaran'");
    $num_row_matpel = $cek_matpel->num_rows;
    
    if ($num_row_matpel == 0){
        $update = $konek->query("UPDATE matpel SET kode_pelajaran = '$kode_pelajaran', nama_pelajaran = '$nama_pelajaran' WHERE kode_pelajaran = '$id'");
        if ($update){
            echo"<div class='card mb-5 py-0 border-bottom-success'>
                            <center>
                                <div class='card-body'>
                                    <i class='btn btn-success btn-circle btn-sm'>
                                        <span class='icon text-white-50'>
                                            <i class='fas fa-check'></i>
                                        </span>
                                    </i> Mata pelajaran berhasil di ubah
                                </div>
                            </center>
                            </div>";
        } else {
            echo"<div class='card mb-5 py-0 border-bottom-danger'>
                            <center>
                                <div class='card-body'>
                                    <i class='btn btn-danger btn-circle btn-sm'>
                                        <span class='icon text-white-50'>
                                            <i class='fas fa-exclamation'></i>
                                        </span>
                                    </i> Mata pelajaran gagal diubah!!
                                </div>
                            </center>
                            </div>";
        }
    } else if ($num_row_matpel >0){
        if ($id == $kode_pelajaran){
                $update = $konek->query("UPDATE matpel SET kode_pelajaran = '$kode_pelajaran', nama_pelajaran = '$nama_pelajaran' WHERE kode_pelajaran = '$id'");
            if ($update){
                echo"<div class='card mb-5 py-0 border-bottom-success'>
                            <center>
                                <div class='card-body'>
                                    <i class='btn btn-success btn-circle btn-sm'>
                                        <span class='icon text-white-50'>
                                            <i class='fas fa-check'></i>
                                        </span>
                                    </i> Mata pelajaran berhasil di ubah
                                </div>
                            </center>
                            </div>";
                
            } else {
                echo"<div class='card mb-5 py-0 border-bottom-danger'>
                            <center>
                                <div class='card-body'>
                                    <i class='btn btn-danger btn-circle btn-sm'>
                                        <span class='icon text-white-50'>
                                            <i class='fas fa-exclamation'></i>
                                        </span>
                                    </i> Mata pelajaran gagal diubah!!
                                </div>
                            </center>
                            </div>";
            }
        } else if ($id !== $kode_pelajaran){
            echo"<div class='card mb-5 py-0 border-bottom-danger'>
                            <center>
                                <div class='card-body'>
                                    <i class='btn btn-danger btn-circle btn-sm'>
                                        <span class='icon text-white-50'>
                                            <i class='fas fa-exclamation'></i>
                                        </span>
                                    </i> Kode mata pelajaran telah digunakan!!!
                                </div>
                            </center>
                            </div>";
        } else {
            echo"<div class='card mb-5 py-0 border-bottom-danger'>
                            <center>
                                <div class='card-body'>
                                    <i class='btn btn-danger btn-circle btn-sm'>
                                        <span class='icon text-white-50'>
                                            <i class='fas fa-exclamation'></i>
                                        </span>
                                    </i> Mata pelajaran gagal diubah!!
                                </div>
                            </center>
                            </div>";
        }
    } else {
        echo"<div class='card mb-5 py-0 border-bottom-danger'>
                            <center>
                                <div class='card-body'>
                                    <i class='btn btn-danger btn-circle btn-sm'>
                                        <span class='icon text-white-50'>
                                            <i class='fas fa-exclamation'></i>
                                        </span>
                                    </i> Mata pelajaran gagal diubah!!
                                </div>
                            </center>
                            </div>";
    }
}


        // BUAT SESI


if (isset($_POST['buat_sesi'])){
    $kode_matpel = $_POST['kode_matpel'];
    $sesi = $_POST['sesi'];
    $nama_pengajar = $_POST['nama_pengajar'];
    $materi = $_POST['materi'];
    $tanggal =  $_POST['tanggal'];
    $dari = $_POST['mulai'];
    $hingga = $_POST['selesai'];
    $mulai = $tanggal." ".$dari;
    $selesai = $tanggal." ".$hingga;

    $insrt = $konek->query("INSERT INTO sesi (kode_pelajaran, sesi, nama_pengajar, materi, mulai, selesai) VALUES ('$kode_matpel', '$sesi', '$nama_pengajar', '$materi', '$mulai', '$selesai')");
    if ($insrt){
        echo"<div class='card mb-5 py-0 border-bottom-success'>
                    <center>
                        <div class='card-body'>
                            <i class='btn btn-success btn-circle btn-sm'>
                                <span class='icon text-white-50'>
                                    <i class='fas fa-check'></i>
                                </span>
                            </i> Pertemuan Ke-$sesi berhasil dibuat
                        </div>
                    </center>
                    </div>";
    } else {
        echo"<div class='card mb-5 py-0 border-bottom-danger'>
                    <center>
                        <div class='card-body'>
                            <i class='btn btn-danger btn-circle btn-sm'>
                                <span class='icon text-white-50'>
                                    <i class='fas fa-exclamation'></i>
                                </span>
                            </i> Pertemuan Ke-$kode_sesi gagal dibuat
                        </div>
                    </center>
                    </div>";
    }
}


        // EDIT SESI


if (isset($_POST['edit_sesi'])){
    $kode_sesi = $_POST['kode_sesi'];
    $kode_matpel = $_POST['kode_matpel'];
    $nama_pengajar = $_POST['nama_pengajar'];
    $materi = $_POST['materi'];
    $tanggal =  $_POST['tanggal'];
    $dari = $_POST['mulai'];
    $hingga = $_POST['selesai'];
    $mulai = $tanggal." ".$dari;
    $selesai = $tanggal." ".$hingga;

    $update = $konek->query("UPDATE sesi SET nama_pengajar = '$nama_pengajar', materi = '$materi', mulai = '$mulai', selesai = '$selesai' WHERE kode_sesi = '$kode_sesi'");
    if ($update){
        echo"<div class='card mb-5 py-0 border-bottom-success'>
                    <center>
                        <div class='card-body'>
                            <i class='btn btn-success btn-circle btn-sm'>
                                <span class='icon text-white-50'>
                                    <i class='fas fa-check'></i>
                                </span>
                            </i> Pertemuan Ke-$kode_sesi berhasil diubah
                        </div>
                    </center>
                    </div>";
    } else {
        echo"<div class='card mb-5 py-0 border-bottom-danger'>
                    <center>
                        <div class='card-body'>
                            <i class='btn btn-danger btn-circle btn-sm'>
                                <span class='icon text-white-50'>
                                    <i class='fas fa-exclamation'></i>
                                </span>
                            </i> Pertemuan Ke-$kode_sesi gagal diubah
                        </div>
                    </center>
                    </div>";
    }
}


        // TAMBAH PESERTA PELAJARAN


        if(isset($_POST['nip_peserta_pelajaran'])){
            $nip_peserta = $_POST['nip_peserta_pelajaran'];

            $cek_kepesertaan = $konek->query("SELECT * FROM peserta WHERE nip = '$nip_peserta'");
            $cek_kepesertaan2 = $konek->query("SELECT * FROM matpel_peserta WHERE nip_peserta = '$nip_peserta' AND kode_pelajaran ='$id'");
            $numrow = $cek_kepesertaan->num_rows;
            $numrow2 = $cek_kepesertaan2->num_rows;
            $arr_kepesertaan = $cek_kepesertaan->fetch_assoc();

            if ($numrow2 > 0){
                echo"<div class='card mb-5 py-0 border-bottom-danger'>
                    <center>
                        <div class='card-body'>
                            <i class='btn btn-danger btn-circle btn-sm'>
                                <span class='icon text-white-50'>
                                    <i class='fas fa-exclamation'></i>
                                </span>
                            </i> Peserta sudah terdaftar didalam pelajaran!!!
                        </div>
                    </center>
                    </div>";
            } else if ($numrow > 0){
                $insrt = $konek->query("INSERT INTO matpel_peserta (kode_pelajaran, nip_peserta) VALUES ('$id', '$nip_peserta')");
                if ($insrt){
                    echo"<div class='card mb-5 py-0 border-bottom-success'>
                    <center>
                        <div class='card-body'>
                            <i class='btn btn-success btn-circle btn-sm'>
                                <span class='icon text-white-50'>
                                    <i class='fas fa-check'></i>
                                </span>
                            </i> Peserta berhasil ditambahkan kedalam pelajaran
                        </div>
                    </center>
                    </div>";
                } else {
                    echo"<div class='card mb-5 py-0 border-bottom-danger'>
                    <center>
                        <div class='card-body'>
                            <i class='btn btn-danger btn-circle btn-sm'>
                                <span class='icon text-white-50'>
                                    <i class='fas fa-exclamation'></i>
                                </span>
                            </i> Peserta gagal ditambahkan kedalam pelajaran!!
                        </div>
                    </center>
                    </div>";
                }
            } else if ($numrow == 0){
                echo"<div class='card mb-5 py-0 border-bottom-danger'>
                    <center>
                        <div class='card-body'>
                            <i class='btn btn-danger btn-circle btn-sm'>
                                <span class='icon text-white-50'>
                                    <i class='fas fa-exclamation'></i>
                                </span>
                            </i> Peserta tidak terdaftar dalam sistem!!
                        </div>
                    </center>
                    </div>";
            } else {
                echo"<div class='card mb-5 py-0 border-bottom-danger'>
                    <center>
                        <div class='card-body'>
                            <i class='btn btn-danger btn-circle btn-sm'>
                                <span class='icon text-white-50'>
                                    <i class='fas fa-exclamation'></i>
                                </span>
                            </i> Peserta gagal ditambahkan kedalam pelajaran!!
                        </div>
                    </center>
                    </div>";
            }
        }


        // ABSENSI PELAJARAN


        if (isset($_POST['nip_absen_pelajaran'])){
            $nip_peserta = $_POST['nip_absen_pelajaran'];
            $id = $_GET['actid'];
        
            $cek_kepesertaan = $konek->query("SELECT * FROM matpel_peserta WHERE nip_peserta = '$nip_peserta' AND kode_pelajaran = '$kode_pelajaran'");
            $cek_absen = $konek->query("SELECT * FROM absen WHERE nip = '$nip_peserta' AND kode_pelajaran = '$kode_pelajaran' AND sesi = '$sesi'");
            $numrow = $cek_kepesertaan->num_rows;
            $row_absen = $cek_absen->num_rows;
            $arr = $cek_kepesertaan->fetch_assoc();
            
            if ($numrow > 0){
                if ($row_absen == 0){
                    $insrt = $konek->query("INSERT INTO absen (kode_pelajaran, sesi, nip, keterangan) VALUES ('$kode_pelajaran', '$sesi', '$nip_peserta', 'Hadir')");
                    if ($insrt) {
                        echo"<div class='card mb-0 py-0 border-bottom-success'>
                            <center>
                                <div class='card-body'>
                                    <i class='btn btn-success btn-circle btn-sm'>
                                        <span class='icon text-white-50'>
                                            <i class='fas fa-check'></i>
                                        </span>
                                    </i> $nip_peserta Berhasil melakukan absensi
                                </div>
                            </center>
                            </div><br><br>";

                    } else {
                        echo"<div class='card mb-0 py-0 border-bottom-danger'>
                         <center>
                             <div class='card-body'>
                                 <i class='btn btn-danger btn-circle btn-sm'>
                                     <span class='icon text-white-50'>
                                         <i class='fas fa-exclamation'></i>
                                     </span>
                                 </i> $nip_peserta Gagal melakukan absensi karena kesalahan QUERY 1
                             </div>
                         </center>
                         </div><br><br>"; 

                    }
                } else if ($row_absen > 0){
                    echo"<div class='card mb-0 py-0 border-bottom-danger'>
                     <center>
                         <div class='card-body'>
                             <i class='btn btn-danger btn-circle btn-sm'>
                                 <span class='icon text-white-50'>
                                     <i class='fas fa-exclamation'></i>
                                 </span>
                             </i> $nip_peserta Telah hadir
                         </div>
                     </center>
                     </div><br><br>";
                } else {
                    echo"<div class='card mb-0 py-0 border-bottom-danger'>
                     <center>
                         <div class='card-body'>
                             <i class='btn btn-danger btn-circle btn-sm'>
                                 <span class='icon text-white-50'>
                                     <i class='fas fa-exclamation'></i>
                                 </span>
                             </i> $nip_peserta Gagal melakukan absensi karena kesalahan QUERY 2
                         </div>
                     </center>
                     </div><br><br>";
                }
            } else if ($numrow == 0){
                echo"<div class='card mb-0 py-0 border-bottom-danger'>
                 <center>
                     <div class='card-body'>
                         <i class='btn btn-danger btn-circle btn-sm'>
                             <span class='icon text-white-50'>
                                 <i class='fas fa-exclamation'></i>
                             </span>
                         </i> $nip_peserta Tidak terdaftar
                     </div>
                 </center>
                 </div><br><br>";
            }
        }


        // TAMBAH PESERTA EVENT

        
if(isset($_POST['nip_peserta_event'])){
    $nip_peserta = $_POST['nip_peserta_event'];
    $id = $_GET['actid'];

    $cek_kepesertaan = $konek->query("SELECT * FROM peserta WHERE nip = '$nip_peserta'");
    $cek_kepesertaan2 = $konek->query("SELECT * FROM events_peserta WHERE nip_peserta = '$nip_peserta' AND id_event ='$id'");
    $cek_event_id = $konek->query("SELECT * FROM events WHERE id_event = '$id'");
    $numrow = $cek_kepesertaan->num_rows;
    $numrow2 = $cek_kepesertaan2->num_rows;
    $arr_event_id = $cek_event_id->fetch_assoc();
    $arr_kepesertaan = $cek_kepesertaan->fetch_assoc();
    $biaya = $arr_event_id['harga'];
    $saldo = $arr_kepesertaan['saldo'];
    $biaya_ =  number_format(($biaya), 0, ".", ".");

    if ($numrow2 > 0){
        echo"<div class='card mb-0 py-0 border-bottom-danger'>
                             <center>
                                 <div class='card-body'>
                                     <i class='btn btn-danger btn-circle btn-sm'>
                                         <span class='icon text-white-50'>
                                             <i class='fas fa-exclamation'></i>
                                         </span>
                                     </i> $nip_peserta sudah terdaftar!!!
                                 </div>
                             </center>
                             </div><br><br>";
    } else if ($numrow > 0){
        if ($saldo >= $biaya){
            $insrt = $konek->query("INSERT INTO events_peserta (id_event, nip_peserta) VALUES ('$id', '$nip_peserta')");
            if ($insrt){
                $update = $konek->query("UPDATE peserta SET saldo = saldo-'$biaya' WHERE nip = '$nip_peserta'");
                if ($update){
                    $update2 = $konek->query("INSERT INTO transaksi (id_event, nip, tanggal, bayar) VALUES ('$id', '$nip_peserta', '$tgl', '$biaya')");
                    if ($update2) {
                        echo"<div class='card mb-5 py-0 border-bottom-success'>
                        <center>
                            <div class='card-body'>
                                <i class='btn btn-success btn-circle btn-sm'>
                                    <span class='icon text-white-50'>
                                        <i class='fas fa-check'></i>
                                    </span>
                                </i> $nip_peserta Berhasil ditambahkan kedalam event
                            </div>
                        </center>
                    </div>";
                    } else {
                        echo"<div class='card mb-0 py-0 border-bottom-danger'>
                                 <center>
                                     <div class='card-body'>
                                         <i class='btn btn-danger btn-circle btn-sm'>
                                             <span class='icon text-white-50'>
                                                 <i class='fas fa-exclamation'></i>
                                             </span>
                                         </i> Gagal mendaftarkan $nip_peserta!!!
                                     </div>
                                 </center>
                                 </div><br><br>";
                    }
                } else {
                    echo"<div class='card mb-0 py-0 border-bottom-danger'>
                             <center>
                                 <div class='card-body'>
                                     <i class='btn btn-danger btn-circle btn-sm'>
                                         <span class='icon text-white-50'>
                                             <i class='fas fa-exclamation'></i>
                                         </span>
                                     </i> Gagal mendaftarkan $nip_peserta!!!
                                 </div>
                             </center>
                             </div><br><br>";
                }
            } else {
                echo"<div class='card mb-0 py-0 border-bottom-danger'>
                 <center>
                     <div class='card-body'>
                         <i class='btn btn-danger btn-circle btn-sm'>
                             <span class='icon text-white-50'>
                                 <i class='fas fa-exclamation'></i>
                             </span>
                         </i> Gagal mendaftarkan $nip_peserta!!!
                     </div>
                 </center>
                 </div><br><br>";
            }
        } else {
            echo"<div class='card mb-0 py-0 border-bottom-danger'>
                 <center>
                     <div class='card-body'>
                         <i class='btn btn-danger btn-circle btn-sm'>
                             <span class='icon text-white-50'>
                                 <i class='fas fa-exclamation'></i>
                             </span>
                         </i> Saldo $nip_peserta kurang dari $biaya_!!!
                     </div>
                 </center>
                 </div><br><br>";
        }
    } else if ($numrow == 0){
        echo"<div class='card mb-0 py-0 border-bottom-danger'>
                 <center>
                     <div class='card-body'>
                         <i class='btn btn-danger btn-circle btn-sm'>
                             <span class='icon text-white-50'>
                                 <i class='fas fa-exclamation'></i>
                             </span>
                         </i> $nip_$nip_peserta Tidak terdaftar!!!
                     </div>
                 </center>
                 </div><br><br>";
    } else {
        echo"<div class='card mb-0 py-0 border-bottom-danger'>
                 <center>
                     <div class='card-body'>
                         <i class='btn btn-danger btn-circle btn-sm'>
                             <span class='icon text-white-50'>
                                 <i class='fas fa-exclamation'></i>
                             </span>
                         </i> Gagal mendaftarkan $nip_peserta!!!
                     </div>
                 </center>
                 </div><br><br>";
    }
}


        // ABSENSI EVENT


if (isset($_POST['nip_absensi_event'])){
    $nip_peserta = $_POST['nip_absensi_event'];
    $id = $_GET['actid'];

    $cek_kepesertaan = $konek->query("SELECT * FROM events_peserta WHERE nip_peserta = '$nip_peserta' AND id_event = '$id'");
    $numrow = $cek_kepesertaan->num_rows;
    $arr = $cek_kepesertaan->fetch_assoc();

    if ($numrow > 0){
        if (!$arr['keterangan']){
            $update = $konek->query("UPDATE events_peserta SET keterangan = 'Hadir' WHERE nip_peserta = '$nip_peserta' AND id_event = '$id'");
            if($update){
                echo"<div class='card mb-0 py-0 border-bottom-success'>
                    <center>
                        <div class='card-body'>
                            <i class='btn btn-success btn-circle btn-sm'>
                                <span class='icon text-white-50'>
                                    <i class='fas fa-check'></i>
                                </span>
                            </i> $nip_peserta Berhasil melakukan absensi
                        </div>
                    </center>
                    </div><br><br>";
            } else {
                echo"<div class='card mb-0 py-0 border-bottom-danger'>
                    <center>
                        <div class='card-body'>
                            <i class='btn btn-danger btn-circle btn-sm'>
                                <span class='icon text-white-50'>
                                    <i class='fas fa-exclamation'></i>
                                </span>
                            </i> $nip_peserta Gagal melakukan absensi !!!
                        </div>
                    </center>
                    </div><br><br>";
            }
        } else {
            echo"<div class='card mb-0 py-0 border-bottom-danger'>
                    <center>
                        <div class='card-body'>
                            <i class='btn btn-danger btn-circle btn-sm'>
                                <span class='icon text-white-50'>
                                    <i class='fas fa-exclamation'></i>
                                </span>
                            </i> $nip_peserta Telah hadir!!!
                        </div>
                    </center>
                    </div><br><br>";
        }
    } else {
        echo"<div class='card mb-0 py-0 border-bottom-danger'>
                    <center>
                        <div class='card-body'>
                            <i class='btn btn-danger btn-circle btn-sm'>
                                <span class='icon text-white-50'>
                                    <i class='fas fa-exclamation'></i>
                                </span>
                            </i> $nip_peserta Tidak terdaftar!!!
                        </div>
                    </center>
                    </div><br><br>";
    }
}


        // EDIT USERS


if (isset($_POST['edit_users'])){
    $nip_user = $_POST['nip'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $angkatan = $_POST['angkatan'];

    $cek_users = $konek->query("SELECT * FROM users WHERE nip = '$nip_user'");
    $num = $cek_users->num_rows;
    
    if ($nip_user == $nip_users){
        $update = $konek->query("UPDATE users SET nama = '$nama', email = '$email', angkatan = '$angkatan' WHERE nip = '$nip_user'");
        if ($update){
            echo"<div class='card mb-5 py-0 border-bottom-success'>
                            <center>
                                <div class='card-body'>
                                    <i class='btn btn-success btn-circle btn-sm'>
                                        <span class='icon text-white-50'>
                                            <i class='fas fa-check'></i>
                                        </span>
                                    </i> $nip_users Berhasil diubah
                                </div>
                            </center>
                            </div>";
        } else {
            echo"<div class='card mb-5 py-0 border-bottom-danger'>
                            <center>
                                <div class='card-body'>
                                    <i class='btn btn-danger btn-circle btn-sm'>
                                        <span class='icon text-white-50'>
                                            <i class='fas fa-exclamation'></i>
                                        </span>
                                    </i> $nip_users gagal diubah!!
                                </div>
                            </center>
                            </div>";
        }
    } else if ($nip_user !== $nip_users){
        if ($num == 0){
            $update = $konek->query("UPDATE users SET nip = '$nip_user', nama = '$nama', email = '$email', angkatan = '$angkatan', level = '$level' WHERE nip = '$nip_users'");
            if ($update){
                echo"<div class='card mb-5 py-0 border-bottom-success'>
                            <center>
                                <div class='card-body'>
                                    <i class='btn btn-success btn-circle btn-sm'>
                                        <span class='icon text-white-50'>
                                            <i class='fas fa-check'></i>
                                        </span>
                                    </i> $nip_users Berhasil diubah
                                </div>
                            </center>
                            </div>";
            } else {
                echo"<div class='card mb-5 py-0 border-bottom-danger'>
                            <center>
                                <div class='card-body'>
                                    <i class='btn btn-danger btn-circle btn-sm'>
                                        <span class='icon text-white-50'>
                                            <i class='fas fa-exclamation'></i>
                                        </span>
                                    </i> $nip_users gagal diubah!!
                                </div>
                            </center>
                            </div>";
            }
        } else {
            echo"<div class='card mb-5 py-0 border-bottom-danger'>
                            <center>
                                <div class='card-body'>
                                    <i class='btn btn-danger btn-circle btn-sm'>
                                        <span class='icon text-white-50'>
                                            <i class='fas fa-exclamation'></i>
                                        </span>
                                    </i> Tidak boleh sama dengan user lain!!
                                </div>
                            </center>
                            </div>";
        }
        
    } else {
        echo"<div class='card mb-5 py-0 border-bottom-danger'>
                            <center>
                                <div class='card-body'>
                                    <i class='btn btn-danger btn-circle btn-sm'>
                                        <span class='icon text-white-50'>
                                            <i class='fas fa-exclamation'></i>
                                        </span>
                                    </i> $nip_users gagal diubah!!
                                </div>
                            </center>
                            </div>";
    } 
}


        // EDIT PESERTA


if (isset($_POST['edit_peserta'])){
    $nip_peserta = $_POST['nip'];
    $nama = $_POST['nama'];
    $angkatan = $_POST['angkatan'];

    $cek_peserta = $konek->query("SELECT *  FROM peserta WHERE nip = '$nip_peserta'");
    $num = $cek_peserta->num_rows;
    $pecah_peserta = $cek_peserta->fetch_assoc();

    if ($nip_peserta == $nip_pesertas){
        $update = $konek->query("UPDATE peserta SET nama_peserta = '$nama', angkatan = '$angkatan' WHERE nip = '$nip_pesertas'");
        if ($update){
            echo"<div class='card mb-5 py-0 border-bottom-success'>
                            <center>
                                <div class='card-body'>
                                    <i class='btn btn-success btn-circle btn-sm'>
                                        <span class='icon text-white-50'>
                                            <i class='fas fa-check'></i>
                                        </span>
                                    </i> $nip_pesertas Berhasil diubah
                                </div>
                            </center>
                            </div>";
        } else {
            echo"<div class='card mb-5 py-0 border-bottom-danger'>
                            <center>
                                <div class='card-body'>
                                    <i class='btn btn-danger btn-circle btn-sm'>
                                        <span class='icon text-white-50'>
                                            <i class='fas fa-exclamation'></i>
                                        </span>
                                    </i> $nip_pesertas gagal diubah 1!!
                                </div>
                            </center>
                            </div>";
        }
    } else if ($nip_peserta !== $nip_pesertas){
        if ($num == 0){
            $update = $konek->query("UPDATE peserta SET nip = '$nip_peserta', nama_peserta = '$nama', angkatan = '$angkatan' WHERE nip = '$nip_pesertas'");
            if ($update){
                echo"<div class='card mb-5 py-0 border-bottom-success'>
                                <center>
                                    <div class='card-body'>
                                        <i class='btn btn-success btn-circle btn-sm'>
                                            <span class='icon text-white-50'>
                                                <i class='fas fa-check'></i>
                                            </span>
                                        </i> $nip_pesertas Berhasil diubah
                                    </div>
                                </center>
                                </div>";
            } else {
                echo"<div class='card mb-5 py-0 border-bottom-danger'>
                                <center>
                                    <div class='card-body'>
                                        <i class='btn btn-danger btn-circle btn-sm'>
                                            <span class='icon text-white-50'>
                                                <i class='fas fa-exclamation'></i>
                                            </span>
                                        </i> $nip_pesertas gagal diubah 2!!
                                    </div>
                                </center>
                                </div>";
            }
        } else {
            echo"<div class='card mb-5 py-0 border-bottom-danger'>
                                <center>
                                    <div class='card-body'>
                                        <i class='btn btn-danger btn-circle btn-sm'>
                                            <span class='icon text-white-50'>
                                                <i class='fas fa-exclamation'></i>
                                            </span>
                                        </i> $nip_pesertas gagal diubah 3!!
                                    </div>
                                </center>
                                </div>";
        }
    } else {
        echo"<div class='card mb-5 py-0 border-bottom-danger'>
                            <center>
                                <div class='card-body'>
                                    <i class='btn btn-danger btn-circle btn-sm'>
                                        <span class='icon text-white-50'>
                                            <i class='fas fa-exclamation'></i>
                                        </span>
                                    </i> $nip_pesertas gagal diubah 4!!
                                </div>
                            </center>
                            </div>";
    }
}


        // UBAH PROFILE ADMIN
        


if(isset($_POST['ubah_profile_admin'])) {
    $email = $_POST['email'];
    $base = $base."profile";

    $update = $konek->query("UPDATE users SET email = '$email' WHERE nip = '$nip'");
    if ($update){
        header("location: $base?msg=t");
    } else {
        header("location: $base?msg=f");
    }
}


        // UBAH PASSWORD ADMIN


if (isset($_POST['ubah_password_admin'])){
    $password = md5($_POST['password']);
    $pass1 = md5($_POST['pass1']);
    $pass2 = md5($_POST['pass2']);
    $passl = $pecah['password'];
    $base = $base."profile";

    if ($password == $passl){
        if ($pass1 == $pass2){
            $update = $konek->query("UPDATE users SET `password` = '$pass1' WHERE nip = '$nip'");
            if ($update){
                header("location: $base?msg=tr");
            } else {
                header("location: $base?msg=fa");
            }
        } else {
            header("location: $base?msg=fa");
        }
    } else {
        header("location: $base?msg=fa");
    }
}


        // BUAT TKPI
        

if (isset($_POST['buat_tkpi'])){
    $nama_pengajar = $_POST['nama_pengajar'];
    $pengawas = $_POST['pengawas'];
    $tanggal =  $_POST['tanggal'];
    $dari = $_POST['mulai'];
    $hingga = $_POST['selesai'];
    $mulai = $tanggal." ".$dari;
    $selesai = $tanggal." ".$hingga;

    $insrt = $konek->query("INSERT INTO sesi (kode_pelajaran, sesi, nama_pengajar, pengawas, materi, mulai, selesai) VALUES ('$kode_matpel', '$sesi', '$nama_pengajar', '$pengawas', 'TKPI', '$mulai', '$selesai')");
    if ($insrt){
        echo"<script>alert('TKPI berhasil dibuat');</script>";
	    echo"<script>location='$base1/mata-pelajaran/sesi?id=$kode_matpel';</script>";
    } else {
        echo"<div class='card mb-5 py-0 border-bottom-danger'>
                    <center>
                        <div class='card-body'>
                            <i class='btn btn-danger btn-circle btn-sm'>
                                <span class='icon text-white-50'>
                                    <i class='fas fa-exclamation'></i>
                                </span>
                            </i> TKPI gagal dibuat!!!
                        </div>
                    </center>
                    </div>";
    }
}


        // HAPUS USERS


if (isset($_POST['hapus_user'])){
    $nip = $_POST['nip_users'];

    $cek = $konek->query("SELECT * FROM users WHERE nip = '$nip'");
    $cek_row = $cek->num_rows;

    if($cek_row > 0){
        $hapus = $konek->query("DELETE FROM users WHERE nip = '$nip'");
        if ($hapus){
            echo"<div class='card mb-5 py-0 border-bottom-success'>
                                    <center>
                                        <div class='card-body'>
                                            <i class='btn btn-success btn-circle btn-sm'>
                                                <span class='icon text-white-50'>
                                                    <i class='fas fa-check'></i>
                                                </span>
                                            </i> $nip Berhasil di hapus
                                        </div>
                                    </center>
                                </div>";
        } else {
            echo"<div class='card mb-5 py-0 border-bottom-danger'>
                        <center>
                            <div class='card-body'>
                                <i class='btn btn-danger btn-circle btn-sm'>
                                    <span class='icon text-white-50'>
                                        <i class='fas fa-exclamation'></i>
                                    </span>
                                </i> $nip Gagal di hapus!!
                            </div>
                        </center>
                    </div>";
        }
    } else {
        echo"<div class='card mb-5 py-0 border-bottom-danger'>
                        <center>
                            <div class='card-body'>
                                <i class='btn btn-danger btn-circle btn-sm'>
                                    <span class='icon text-white-50'>
                                        <i class='fas fa-exclamation'></i>
                                    </span>
                                </i> $nip Gagal di hapus !!
                            </div>
                        </center>
                    </div>";
    }
}


        // UPDATE ABSEN


if (isset($_POST['update_absen_pelajaran'])) {
    $b = count($_POST['nip_peserta']);
    $i = 0;

    while ($i <= $b) {
        $nip_peserta = $_POST['nip_peserta'][$i];
        $ket = $_POST['keterangan'][$i];

        $cek_absen = $konek->query("SELECT * FROM absen WHERE kode_pelajaran = '$kode_pelajaran' AND sesi = '$sesi' AND nip = '$nip_peserta' ");
        $numrow = $cek_absen->num_rows;

        if ($numrow == 0){
            if ($ket == 'Hadir'){
                $qry = $konek->query("INSERT INTO absen (kode_pelajaran, sesi, nip, keterangan) VALUES ('$kode_pelajaran', '$sesi', '$nip_peserta', '$ket')");
                if ($qry){
                    $qry;
                } else {
                    $qry;
                }
            } else if ($ket == 'Tidak Hadir'){
                $qry;
            }
        } else if ($numrow > 0){
            if ($ket == "Hadir"){
                $qry;
            } else if ($ket == "Tidak Hadir"){
                $qry = $konek->query("DELETE FROM absen WHERE nip = '$nip_peserta' AND sesi = '$sesi' AND kode_pelajaran = '$kode_pelajaran'");  
                if ($qry){
                    $qry;
                } else {
                    $qry;
                }
            } else {
                $qry;
            }
        } else {
            $qry;
        }
        $i++;
    }

    if ($qry){
        echo"<div class='card mb-5 py-0 border-bottom-success'>
                            <center>
                                <div class='card-body'>
                                    <i class='btn btn-success btn-circle btn-sm'>
                                        <span class='icon text-white-50'>
                                        <i class='fas fa-check'></i>
                                        </span>
                                    </i> Absensi peserta berhasil diupdate
                                </div>
                            </center>
                        </div>";
    } else {
        echo"<div class='card mb-5 py-0 border-bottom-danger'>
        <center>
            <div class='card-body'>
                <i class='btn btn-danger btn-circle btn-sm'>
                    <span class='icon text-white-50'>
                        <i class='fas fa-exclamation'></i>
                    </span>
                </i> Absensi peserta gagal diupdate 4!!
            </div>
        </center>
    </div>";
    }

}



        //FORGOT


if (isset($_POST['forgot'])){
    $nip_user = $konek->escape_string($_POST['nip']);
    $email = $konek->escape_string($_POST['email']);
    
    $cek_users = $konek->query("SELECT * FROM users WHERE nip = '$nip_user' AND email = '$email'");
    $row = $cek_users->num_rows;
    $arr = $cek_users->fetch_assoc();
    $nama = $arr['nama'];
    
    
    if ($row > 0){
        function create_random($length) {
            $data = 'ABCDEFGHIJKLMNOPQRSTU1234567890';
            $string = '';
            for($i = 0; $i < $length; $i++) {
                $pos = rand(0, strlen($data)-1);
                $string .= $data{$pos};
            }
            return $string;
        }
        $b = create_random(4);
        $c = "GSI-".$b;
        
        $to = $email;
        $from = "Absensi Get Smart Indonesia <admin@getsmartindonesia.com>";
        $subject = "Ganti Password";
        $message = " 
        <img src='https://absensi.getsmartindonesia.com/img/gs1.png' width='50%'>
        <table>
            <tr>
                <td colspan='2'>Jl. MM No. 11J, Rt.004/09, Jakarta Barat (Sekretariat)</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>: getsmartindonesia@gmail.com</td>
            </tr>
            <tr>
                <td>Website</td>
                <td>: www.getsmartindonesia.com</td>
            </tr>
        </table>
        <hr>
        <h2 style='text-align: center'>Lupa Password</h2>
        <center>
        <table>
            <tr>
                <td>NIP</td>
                <td>: $nip_user</td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>: $nama</td>
            </tr>
            <tr>
                <td>Password</td>
                <td>: $c</td>
            </tr>
        </table>
        </center>
        <br>
        <hr>
        Best Regards,<br>
        Pengembang Absensi<br>
        Get Smart Indonesia
        
        ";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
        $headers .= "From:" . $from;    
        $send = mail($to,$subject,$message, $headers); 
        
        if ($send){
            $pass = md5($c);
            $update = $konek->query("UPDATE users SET password = '$pass' WHERE nip = '$nip_user'");
            if ($update){
                echo"<div class='card mb-5 py-0 border-bottom-success'>
                            <center>
                                <div class='card-body'>
                                    <i class='btn btn-success btn-circle btn-sm'>
                                        <span class='icon text-white-50'>
                                        <i class='fas fa-check'></i>
                                        </span>
                                    </i> Email Terkirim!!
                                </div>
                            </center>
                        </div>";
            } else {
                echo"<div class='card mb-5 py-0 border-bottom-danger'>
                    <center>
                        <div class='card-body'>
                            <i class='btn btn-danger btn-circle btn-sm'>
                                <span class='icon text-white-50'>
                                    <i class='fas fa-exclamation'></i>
                                  </span>
                            </i> Email gagal terkirim!!
                        </div>
                     </center>
                 </div>";
            }
        } else {
            echo"<div class='card mb-5 py-0 border-bottom-danger'>
                    <center>
                        <div class='card-body'>
                            <i class='btn btn-danger btn-circle btn-sm'>
                                <span class='icon text-white-50'>
                                    <i class='fas fa-exclamation'></i>
                                  </span>
                            </i> Email gagal terkirim!!
                        </div>
                     </center>
                 </div>";
        }
        
    } else if ($row == 0){
        echo"<div class='card mb-5 py-0 border-bottom-danger'>
                    <center>
                        <div class='card-body'>
                            <i class='btn btn-danger btn-circle btn-sm'>
                                <span class='icon text-white-50'>
                                    <i class='fas fa-exclamation'></i>
                                  </span>
                            </i> NIP/Email tidak terdaftar!!
                        </div>
                     </center>
                 </div>";
    } else {
        echo"<div class='card mb-5 py-0 border-bottom-danger'>
                    <center>
                        <div class='card-body'>
                            <i class='btn btn-danger btn-circle btn-sm'>
                                <span class='icon text-white-50'>
                                    <i class='fas fa-exclamation'></i>
                                  </span>
                            </i> Email gagal terkirim!!
                        </div>
                     </center>
                 </div>";
    }
}


        //HAPUS SEMUA MATA PELAJARAN
        

if (isset($_POST['del-mata-pelajaran'])){
    $cek_del = $konek->query("SELECT * FROM matpel");
    $num_del = $cek_del->num_rows;
    
    if($num_del > 0){
        $del_abs = $konek->query("DELETE FROM absen");
        if ($del_abs) {
        $del_ses = $konek->query("DELETE FROM sesi");
            if($del_ses){
                $del_pes = $konek->query("DELETE FROM matpel_peserta");
                if ($del_pes){
                    $del_matpel =  $konek->query("DELETE FROM matpel");
                    if ($del_matpel){
                        echo"<div class='card mb-5 py-0 border-bottom-success'>
                                <center>
                                    <div class='card-body'>
                                        <i class='btn btn-success btn-circle btn-sm'>
                                            <span class='icon text-white-50'>
                                                <i class='fas fa-check'></i>
                                            </span>
                                        </i> Berhasil menghapus semua mata pelajaran
                                    </div>
                                </center>
                            </div>";
                    } else {
                        echo"<div class='card mb-5 py-0 border-bottom-danger'>
                                <center>
                                    <div class='card-body'>
                                        <i class='btn btn-danger btn-circle btn-sm'>
                                            <span class='icon text-white-50'>
                                                <i class='fas fa-exclamation'></i>
                                          </span>
                                        </i> Gagal menghapus semua mata pelajaran!!
                                    </div>
                                </center>
                            </div>";
                    }
                } else {
                    echo"<div class='card mb-5 py-0 border-bottom-danger'>
                        <center>
                            <div class='card-body'>
                                <i class='btn btn-danger btn-circle btn-sm'>
                                    <span class='icon text-white-50'>
                                        <i class='fas fa-exclamation'></i>
                                      </span>
                                </i> Gagal menghapus semua mata pelajaran!!
                            </div>
                         </center>
                     </div>";
                }
            } else {
                   echo"<div class='card mb-5 py-0 border-bottom-danger'>
                        <center>
                            <div class='card-body'>
                                <i class='btn btn-danger btn-circle btn-sm'>
                                    <span class='icon text-white-50'>
                                        <i class='fas fa-exclamation'></i>
                                    </span>
                                </i> Gagal menghapus semua mata pelajaran!!
                            </div>
                         </center>
                     </div>";
            }
        } else {
           echo"<div class='card mb-5 py-0 border-bottom-danger'>
                <center>
                    <div class='card-body'>
                        <i class='btn btn-danger btn-circle btn-sm'>
                            <span class='icon text-white-50'>
                                <i class='fas fa-exclamation'></i>
                            </span>
                        </i> Gagal menghapus semua mata pelajaran!!
                    </div>
                </center>
            </div>";
        } 
    } else if ($num_del == 0){
        echo"<div class='card mb-5 py-0 border-bottom-danger'>
            <center>
                <div class='card-body'>
                    <i class='btn btn-danger btn-circle btn-sm'>
                        <span class='icon text-white-50'>
                            <i class='fas fa-exclamation'></i>
                        </span>
                    </i> Mata Pelajaran Masih Kosong!!
                </div>
            </center>
        </div>";
    } else {
        echo"<div class='card mb-5 py-0 border-bottom-danger'>
            <center>
                <div class='card-body'>
                    <i class='btn btn-danger btn-circle btn-sm'>
                        <span class='icon text-white-50'>
                            <i class='fas fa-exclamation'></i>
                        </span>
                    </i> Gagal menghapus semua mata pelajaran!!
                </div>
            </center>
        </div>";
    }
}



        //HAPUS SEMUA EVENT

        
        
if (isset($_POST['del-event'])){
    $cek_evnt = $konek->query("SELECT * FROM events");
    $rows_evnt = $cek_evnt->num_rows;
    
    if ($rows_evnt > 0){
        $del_pes = $konek->query("DELETE FROM events_peserta");
        if ($del_pes){
            $del_evnt = $konek->query("DELETE FROM events");
            if ($del_evnt){
                echo"<div class='card mb-5 py-0 border-bottom-success'>
                        <center>
                            <div class='card-body'>
                                <i class='btn btn-success btn-circle btn-sm'>
                                    <span class='icon text-white-50'>
                                        <i class='fas fa-check'></i>
                                    </span>
                                </i> Berhasil menghapus semua event
                            </div>
                        </center>
                    </div>";
            } else {
                echo"<div class='card mb-5 py-0 border-bottom-danger'>
                        <center>
                            <div class='card-body'>
                                <i class='btn btn-danger btn-circle btn-sm'>
                                    <span class='icon text-white-50'>
                                        <i class='fas fa-exclamation'></i>
                                    </span>
                                </i> Gagal menghapus semua event!!
                            </div>
                        </center>
                    </div>";
            }
        } else {
            echo"<div class='card mb-5 py-0 border-bottom-danger'>
                    <center>
                        <div class='card-body'>
                            <i class='btn btn-danger btn-circle btn-sm'>
                                <span class='icon text-white-50'>
                                    <i class='fas fa-exclamation'></i>
                                </span>
                            </i> Gagal menghapus semua event!!
                        </div>
                    </center>
                </div>";
        }
    } else if ($rows_evnt == 0){
        echo"<div class='card mb-5 py-0 border-bottom-danger'>
                <center>
                    <div class='card-body'>
                        <i class='btn btn-danger btn-circle btn-sm'>
                            <span class='icon text-white-50'>
                                <i class='fas fa-exclamation'></i>
                            </span>
                        </i> Event masih kosong!!
                    </div>
                </center>
            </div>";
    } else {
        echo"<div class='card mb-5 py-0 border-bottom-danger'>
                <center>
                    <div class='card-body'>
                        <i class='btn btn-danger btn-circle btn-sm'>
                            <span class='icon text-white-50'>
                                <i class='fas fa-exclamation'></i>
                            </span>
                        </i> Gagal menghapus semua event!!
                    </div>
                </center>
            </div>";
    }
}



        //HAPUS SEMUA USER
        


if (isset($_POST['del-users'])){
    $cek_user =  $konek->query("SELECT * FROM users WHERE level = 'Pengurus'");
    $rows_user = $cek_user->num_rows;
    
    if ($rows_user > 0){
        $del_user =  $konek->query("DELETE FROM users WHERE level = 'Pengurus'");
        if ($del_user){
            echo"<div class='card mb-5 py-0 border-bottom-success'>
                    <center>
                        <div class='card-body'>
                            <i class='btn btn-success btn-circle btn-sm'>
                                <span class='icon text-white-50'>
                                    <i class='fas fa-check'></i>
                                </span>
                            </i> Berhasil menghapus semua pengurus
                        </div>
                    </center>
                </div>";
        } else {
            echo"<div class='card mb-5 py-0 border-bottom-danger'>
                    <center>
                        <div class='card-body'>
                            <i class='btn btn-danger btn-circle btn-sm'>
                                <span class='icon text-white-50'>
                                    <i class='fas fa-exclamation'></i>
                                </span>
                            </i> Gagal menghapus semua pengurus!!
                        </div>
                    </center>
                </div>";
        }
    } else if ($rows_user == 0){
        echo"<div class='card mb-5 py-0 border-bottom-danger'>
                <center>
                    <div class='card-body'>
                        <i class='btn btn-danger btn-circle btn-sm'>
                            <span class='icon text-white-50'>
                                <i class='fas fa-exclamation'></i>
                            </span>
                        </i> Pengurus tidak ada!!
                    </div>
                </center>
            </div>";
    } else {
        echo"<div class='card mb-5 py-0 border-bottom-danger'>
                <center>
                    <div class='card-body'>
                        <i class='btn btn-danger btn-circle btn-sm'>
                            <span class='icon text-white-50'>
                                <i class='fas fa-exclamation'></i>
                            </span>
                        </i> Gagal menghapus semua pengurus!!
                    </div>
                </center>
            </div>";
    }
    
}



        //HAPUS SEMUA PESERTA
        


if (isset($_POST['del-peserta'])){
    $hapus = $konek->query("DELETE FROM peserta");
    if ($hapus){
        echo"<div class='card mb-5 py-0 border-bottom-success'>
                    <center>
                        <div class='card-body'>
                            <i class='btn btn-success btn-circle btn-sm'>
                                <span class='icon text-white-50'>
                                    <i class='fas fa-check'></i>
                                </span>
                            </i> Semua Peserta Berhasil Di Hapus
                        </div>
                    </center>
                </div>";
    } else {
        echo"<div class='card mb-5 py-0 border-bottom-danger'>
                <center>
                    <div class='card-body'>
                        <i class='btn btn-danger btn-circle btn-sm'>
                            <span class='icon text-white-50'>
                                <i class='fas fa-exclamation'></i>
                            </span>
                        </i> Peserta tidak ada!!
                    </div>
                </center>
            </div>";
    }
}



        //TAMBAH SALDO PESERTA
        
        

if (isset($_POST['tambah_saldo'])){
    $saldo = $_POST['t_saldo'];
    
    $cek_peserta = $konek->query("SELECT * FROM peserta WHERE nip = '$nip_pesertas'");
    $rows_peserta = $cek_peserta->num_rows;
    
    if ($rows_peserta == 0){
        echo"<div class='card mb-5 py-0 border-bottom-danger'>
                <center>
                    <div class='card-body'>
                        <i class='btn btn-danger btn-circle btn-sm'>
                            <span class='icon text-white-50'>
                                <i class='fas fa-exclamation'></i>
                            </span>
                        </i> $nip_pesertas Tidak terdaftar!!
                    </div>
                </center>
            </div>";
    } else if ($rows_peserta > 0){
        $update = $konek->query("UPDATE peserta SET saldo = saldo+'$saldo' WHERE nip = '$nip_pesertas'");
        if ($update) {
            $pecah_peserta = $cek_peserta->fetch_assoc();
            $saldot = $pecah_peserta['saldo'] + $saldo;
            echo"<div class='card mb-5 py-0 border-bottom-success'>
                    <center>
                        <div class='card-body'>
                            <i class='btn btn-success btn-circle btn-sm'>
                                <span class='icon text-white-50'>
                                    <i class='fas fa-check'></i>
                                </span>
                            </i> Saldo $nip_pesertas bertambah menjadi $saldot
                        </div>
                    </center>
                </div>";
        } else {
            echo"<div class='card mb-5 py-0 border-bottom-danger'>
                <center>
                    <div class='card-body'>
                        <i class='btn btn-danger btn-circle btn-sm'>
                            <span class='icon text-white-50'>
                                <i class='fas fa-exclamation'></i>
                            </span>
                        </i> Saldo $nip_pesertas gagal ditambahkan!!
                    </div>
                </center>
            </div>";
        }
    } else {
        echo"<div class='card mb-5 py-0 border-bottom-danger'>
                <center>
                    <div class='card-body'>
                        <i class='btn btn-danger btn-circle btn-sm'>
                            <span class='icon text-white-50'>
                                <i class='fas fa-exclamation'></i>
                            </span>
                        </i> Saldo $nip_pesertas gagal ditambahkan!!
                    </div>
                </center>
            </div>";
    }
}


if (isset($_POST['update_absen_pelajaran2'])) {
    $b = count($_POST['nip_peserta']);
    $i = 0;
    $s = 0;

    while ($i <= $b) {
        $nip_peserta = $_POST['nip_peserta'][$i];
        $ket = $_POST['keterangan'][$i];

        $cek_absen = $konek->query("SELECT * FROM absen WHERE kode_pelajaran = '$kode_pelajaran' AND sesi = '$sesi' AND nip = '$nip_peserta' ");
        $numrow = $cek_absen->num_rows;

        if ($numrow == 0){
            if ($ket == 'Hadir'){
                $qry = $konek->query("INSERT INTO absen (kode_pelajaran, sesi, nip, keterangan) VALUES ('$kode_pelajaran', '$sesi', '$nip_peserta', '$ket')");
                if ($qry){
                    $qry;
                } else {
                    $qry;
                }
            } else if ($ket == 'Tidak Hadir'){
                $qry;
            }
        } else if ($numrow > 0){
            if ($ket == "Hadir"){
                $qry;
            } else if ($ket == "Tidak Hadir"){
                $qry = $konek->query("DELETE FROM absen WHERE nip = '$nip_peserta' AND sesi = '$sesi' AND kode_pelajaran = '$kode_pelajaran'");  
                if ($qry){
                    $qry;
                } else {
                    $qry;
                }
            } else {
                $qry;
            }
        } else {
            $qry;
        }
        $i++;
    }

    if ($qry){
        echo"<div class='card mb-5 py-0 border-bottom-success'>
                            <center>
                                <div class='card-body'>
                                    <i class='btn btn-success btn-circle btn-sm'>
                                        <span class='icon text-white-50'>
                                        <i class='fas fa-check'></i>
                                        </span>
                                    </i> Absensi peserta berhasil diupdate
                                </div>
                            </center>
                        </div>";
    } else {
        echo"<div class='card mb-5 py-0 border-bottom-danger'>
        <center>
            <div class='card-body'>
                <i class='btn btn-danger btn-circle btn-sm'>
                    <span class='icon text-white-50'>
                        <i class='fas fa-exclamation'></i>
                    </span>
                </i> Absensi peserta gagal diupdate 4!!
            </div>
        </center>
    </div>";
    }

}


