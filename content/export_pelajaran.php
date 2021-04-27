<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
ob_start();


$level = $_SESSION['level'];
require_once("konek/koneksi.php");


  if ($level !== "Admin") {
    if ($level !== "Pengurus") {
      echo"<script>alert('Maaf Anda tidak memiliki akses untuk ke halaman ini');</script>";
      echo"<script>location='$base1/login';</script>";
    }
  }
 
 if (isset($_GET['actid'])){
     $sesi = $_GET['actid'];

     $base = $base."mata-pelajaran";

     $cek_sesi = $konek->query("SELECT A.nama_pengajar, A.pengawas, A.sesi, A.mulai, B.kode_pelajaran, B.nama_pelajaran, A.materi FROM sesi A INNER JOIN matpel B ON A.kode_pelajaran = B.kode_pelajaran WHERE A.kode_sesi = '$sesi'");
     $row_sesi = $cek_sesi->num_rows;
     $pecah_sesi = $cek_sesi->fetch_assoc();
     $kode_matpel = $pecah_sesi['kode_pelajaran'];
     $nama_matpel = $pecah_sesi['nama_pelajaran'];
     $sesi = $pecah_sesi['sesi'];
     $arr = explode(' ', $nama_matpel);
     $nama_matpels = '';
     foreach($arr as $kata) {
         $nama_matpels .= substr($kata, 0, 1);
     }
     $tanggal = tgl_indo(date("Y-m-d", strtotime($pecah_sesi['mulai'])));
     $tanggall = tanggal_indo(date("Y-m-d", strtotime($pecah_sesi['mulai'])));
     $nama_pengajar = $pecah_sesi['nama_pengajar'];

     if ($row_sesi == 0 ){
         echo"<script>alert('Gagal membuka form!!');</script>";
         echo"<script>location='$base';</script>";
     }
 } else if (!isset($_GET['actid'])){
     header("location: $base");
 }


// $result = array ['No.', 'Nama Lengkap' ];
// $header = $db_handle->runQuery("SELECT `COLUMN_NAME` 
// FROM `INFORMATION_SCHEMA`.`COLUMNS` 
// WHERE `TABLE_SCHEMA`='blog_samples' 
//     AND `TABLE_NAME`='toy'");

require('fpdf/fpdf.php');
class PDF extends FPDF{

    function pdfCell($w, $h, $x, $t){
        $height = $h/3;
        $first = $height+2;
        $second = $height+$height+$height+3;
        $len = str_word_count($t);
        $len2 = strlen($t);

        if ($len>2){
            if ($len2>15){
                $txt = explode(" ",$t);
                $this->SetX($x);
                $this->Cell($w,$first,$txt[0]." ".$txt[1],'','','');
                $this->SetX($x);
                $this->Cell($w,$second,$txt[2]." ".$txt[3],'','','');
                $this->SetX($x);
                $this->Cell($w,$h,"",'LTRB',0,'L',0);
            } else {
                $txt = explode(" ",$t);
                $this->SetX($x);
                $this->Cell($w,$first,$txt[0]." ".$txt[1]." ".$txt[2],'','','');
                $this->SetX($x);
                $this->Cell($w,$second,$txt[3],'','','');
                $this->SetX($x);
                $this->Cell($w,$h,"",'LTRB',0,'L',0);
            }
        } else {
            $this->SetX($x);
            $this->Cell($w,$h,$t,'LTRB',0,'L',0);
        }
    }
    function headerCell($w, $h, $x, $t){
        $height = $h/3;
        $first = $height+2;

        $this->SetX($x);
        $this->Cell($w,$h,$t,'LTRB',0,'C',0);
    }

    function Footer() {
        // mengatur posisi 1,5 cm ke bawah
        $this->SetY(-15);
        // arial italic 8
        $this->SetFont('Arial','I',8);
        // penomoran halaman
        $this->Cell(0,1,'Halaman '.$this->PageNo().'/{nb}',0,0,'R');
    }
}


$pdf = new PDF('P','mm',array(210,330));
$pdf->AliasNbPages(); // fungsi untuk mengitung jumlah total halaman
$pdf->AddPage(); // membuat halaman
$pdf->SetFont('Times','',12); // Times 12
    
    $pdf->Image("img/gs1.png",33,30,70);
    $pdf->SetFont('Arial','B',12);
    $pdf->Ln(18);
    $pdf->Cell(0,0,'GET SMART INDONESIA',0,0,'L');
    $pdf->Ln(4);
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(0,1,'Jl. MM No. 11J, Rt.004/09, Jakarta Barat (Sekretariat)',0,0,'L');
    $pdf->Ln(4);
    $pdf->Cell(20,1,'Email',0,0,'L');
    $pdf->Cell(0,1,': getsmartindonesia@gmail.com',0,0,'L');
    $pdf->Ln(4);
    $pdf->Cell(20,1,'Website',0,0,'L');
    $pdf->Cell(0,1,': www.getsmartindonesia.com',0,0,'L');
    $pdf->Ln(14);

        $pdf->SetLineWidth(0);
        $pdf->Line(33,68,180,68);
        $pdf->SetLineWidth(0);
        $pdf->Line(33,68.5,180,68.5);

    $pdf->Cell(43,5,'Kode & Mata Pelajaran',0,0,'L');
    $pdf->Cell(70,5,": $kode_matpel $nama_matpels",0,0,'L');
    $pdf->Ln();
    $pdf->Cell(43,5,'Pengajar',0,0,'L');
    $pdf->Cell(70,5,": $nama_pengajar",0,0,'L');
    $pdf->Ln();
    $pdf->Cell(43,5,'Hari/Tgl',0,0,'L');
    $pdf->Cell(0,5,": $tanggal",0,0,'L');

    $pdf->SetXY(145,73);
    $pdf->SetFont('Times','B',12); // Times 12
    if ($pecah_sesi['materi'] == "TKPI"){
        $pdf->Cell(35,15,"Absensi TKPI",1,1,'C');
    } else {
        $pdf->Cell(35,15,"Pertemuan Ke-".$pecah_sesi['sesi'],1,1,'C');
    }
    $pdf->SetFont('Times','',11); // Times 12
    $pdf->Ln(13);

    

        $pdf->SetLineWidth(0);
        $pdf->Line(33,93,180,93);
        $pdf->SetLineWidth(0);
        $pdf->Line(33,93.5,180,93.5);


        $w = 11;
        $h = 13;

        $x = $pdf->GetX();
        $pdf->headerCell($w, $h, $x, 'NO');
        $x = $pdf->GetX();
        $pdf->headerCell($w+13, $h, $x, 'NIP');
        $x = $pdf->GetX();
        $pdf->headerCell($w+45, $h, $x, 'NAMA PESERTA');
        $x = $pdf->GetX();
        $pdf->headerCell($w+22, $h, $x, 'ANGKATAN');
        $x = $pdf->GetX();
        $pdf->headerCell($w+20, $h, $x, 'KETERANGAN');
        $pdf->ln();

        $no = 1;
        $cek_keterangan1 = $konek->query("SELECT * FROM absen WHERE kode_pelajaran = '$kode_matpel' AND sesi = '$sesi' AND keterangan = 'Hadir' ");
        $ket_h = $cek_keterangan1->num_rows;
        $cek_peserta1 = $konek->query("SELECT A.nip_peserta, B.nama_peserta, B.angkatan  FROM matpel_peserta A INNER JOIN peserta B ON A.nip_peserta = B.nip WHERE A.kode_pelajaran = '$kode_matpel' ORDER BY A.nip_peserta ASC");
        $count = $cek_peserta1->num_rows;
        while ($rows = $cek_peserta1->fetch_assoc()){
            $ambil_nip = $rows['nip_peserta'];
            $cek_keterangan = $konek->query("SELECT * FROM absen WHERE kode_pelajaran = '$kode_matpel' AND sesi = '$sesi' AND nip = '$ambil_nip' ");
            $ambil_ket = $cek_keterangan->fetch_assoc();
            $sub[$a] = $total;
            if ($ambil_ket['keterangan'] == NULL){ 
                $ket = "Tidak Hadir";
            } else {  
                $ket = $ambil_ket['keterangan'];
            }

        
        $x = $pdf->GetX();
        $pdf->headerCell($w, $h, $x, $no);
        $x = $pdf->GetX();
        $pdf->pdfCell($w+13, $h, $x, $ambil_nip);
        $x = $pdf->GetX();
        $pdf->pdfCell($w+45, $h, $x, strtoupper($rows['nama_peserta']));
        $x = $pdf->GetX();
        $pdf->pdfCell($w+22, $h, $x, $rows['angkatan']);
        $x = $pdf->GetX();
        $pdf->pdfCell($w+20, $h, $x, $ket);
        $pdf->ln();

        $no++;

        }
        $ketth = $count-$ket_h;
        $pdf->SetFont('Arial','',10);
        $pdf->ln(20);
        $pdf->Cell(50,4,'Peserta yang hadir',0,0,'L');
        $pdf->Cell(58,4,": $ket_h",0,0,'L');
        $pdf->Cell(0,4,"Jakarta, $tanggall",0,0,'L');
        $pdf->ln();
        $pdf->Cell(50,4,'Peserta yang tidak hadir',0,0,'L');
        $pdf->Cell(58,4,": $ketth",0,0,'L');
        if ($pecah_sesi['materi'] == "TKPI"){
            $pdf->Cell(0,4,"Pengawas",0,0,'L');
        } else {
            $pdf->Cell(0,4,"Pengajar",0,0,'L');
        }
        $pdf->ln();
        $pdf->Cell(50,4,'Peserta yang seharusnya hadir',0,0,'L');
        $pdf->Cell(0,4,": $count",0,0,'L');
        $pdf->ln(30);
        // $pdf->SetX(30);
        $pdf->Cell(110,4,"",0,0,'L');
        if ($pecah_sesi['materi'] == "TKPI"){
            $pdf->Cell(44,4,"(".$pecah_sesi['pengawas'].")",0,0,'C');
        } else {
            $pdf->Cell(44,4,"($nama_pengajar)",0,0,'C');
        }
    

// pengulangan agar dokumen ada isinya dan kelihatan penomorannya
// for($i=1;$i<=100;$i++){
// $pdf->Cell(0,10,'Baris dalam dokumen yang ke '.$i,0,1);
// }

$pdf->Output(); // menampilkan hasil...
// $pdf = new FPDF();
// $pdf->AddPage();
// $pdf->SetFont('Arial','B',12);		
// foreach($header as $heading) {
// 	foreach($heading as $column_heading)
// 		$pdf->Cell(90,12,$column_heading,1);
// }
// foreach($result as $row) {
// 	$pdf->SetFont('Arial','',12);	
// 	$pdf->Ln();
// 	foreach($row as $column)
// 		$pdf->Cell(90,12,$column,1);
// }
// $pdf->Output();

?>