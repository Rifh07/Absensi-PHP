<?php
require_once("konek/koneksi.php");
$path = trim($_SERVER['REQUEST_URI'], '/');
// $path = $_SERVER['REQUEST_URI'];
$path = parse_url($path, PHP_URL_PATH);

$routes =[
    '' => 'content/dashboard.php',
    'maintenance' => 'content/maintenance.php',
    'login' => 'login.php',
    'forgot' => 'forgot.php',
    'log' => 'log.php',
    'logout' => 'logout.php',
    'profile' => 'content/profil.php',
    'mata-pelajaran' => "./content/lihat_matpel.php",
    'mata-pelajaran/buat' => 'content/buat_matpel.php',
    'mata-pelajaran/edit' => 'content/edit_matpel.php',
    'mata-pelajaran/absen/edit' => 'content/edit_absen_pelajaran.php',
    'mata-pelajaran/absen/edit2' => 'content/edit_absen_pelajaran2.php',
    'mata-pelajaran/sesi' => 'content/lihat_sesi.php',
    'mata-pelajaran/sesi/buat' => 'content/buat_sesi.php',
    'mata-pelajaran/sesi/edit' => 'content/edit_sesi.php',
    'mata-pelajaran/sesi/absen' => 'content/absen_pelajaran.php',
    'mata-pelajaran/sesi/export' => 'content/export_pelajaran.php',
    'mata-pelajaran/tkpi/buat' => 'content/buat_tkpi.php',
    'mata-pelajaran/tkpi/edit' => 'content/edit_sesi.php',
    'mata-pelajaran/tkpi/absen' => 'content/absen_pelajaran.php',
    'mata-pelajaran/tkpi/export' => 'content/export_pelajaran.php',
    'mata-pelajaran/tambah-peserta' => 'content/tambah_peserta_pelajaran.php',
    'event' => 'content/lihat_event.php',
    'event/buat' => 'content/buat_event.php',
    'event/edit' => 'content/edit_event.php',
    'event/absen' => 'content/absen.php',
    'event/export' => 'content/export_event.php',
    'event/tambah-peserta' => 'content/tambah_peserta_event.php',
    'users' => 'content/lihat_users.php',
    'users/tambah' => 'content/tambah_users.php',
    'users/hapus' => 'content/hapus_users.php',
    'users/edit' => 'content/edit_users.php',
    'peserta' => 'content/lihat_peserta.php',
    'peserta/tambah' => 'content/tambah_peserta.php',
    'peserta/edit' => 'content/edit_peserta.php',
    'peserta/saldo' => 'content/tambah_saldo.php',
    'riwayat-transaksi' => 'content/histori_transaksi.php',
    'settings' => 'content/pengaturan.php',
    'settings/mata-pelajaran/hapus' => 'content/set_hapus.php',
    'settings/event/hapus' => 'content/set_hapus.php',
    'settings/users/hapus' => 'content/set_hapus.php',
    'settings/peserta/hapus' => 'content/set_hapus.php',
];

if (array_key_exists($path, $routes)){
    require $routes[$path];
} else {
    require "404.php";
}
