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
     

     $id = $_GET['actid'];
     $cek_event_id = $konek->query("SELECT * FROM events WHERE id_event = '$id'");
     $arr_event = $cek_event_id->fetch_assoc();
     $mulai = date("Y-m-d", strtotime($arr_event['tanggal_m_event']));
     $pukul = date("H:i", strtotime($arr_event['tanggal_m_event']));
     $selesai = date("Y-m-d", strtotime($arr_event['tanggal_s_event']));
     $row_event = $cek_event_id->num_rows;

     $tanggal = tgl_indo(date("Y-m-d", strtotime($mulai)));

     if ($row_event == 0 ){
         echo"<script>alert('Gagal membuka form!!');</script>";
         echo"<script>location='$base1/event';</script>";
     }
 } else if (!isset($_GET['actid'])){
     header("location: $base1/event");
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

    $pdf->Cell(43,5,'Nama Kegiatan',0,0,'L');
    $pdf->Cell(80,5,": ".$arr_event['nama_event'],0,0,'L');
    $pdf->Ln();
    $pdf->Cell(43,5,'Ketua Pelaksana',0,0,'L');
    $pdf->Cell(0,5,": ".$arr_event['ketua'],0,0,'L');
    $pdf->Ln();
    
    if ($mulai == $selesai){
        $pdf->Cell(43,5,'Hari/Tgl',0,0,'L');
        $pdf->Cell(0,5,": $tanggal",0,0,'L');
        $pdf->Ln();
        $pdf->Cell(43,5,'Pukul',0,0,'L');
        $pdf->Cell(0,5,": $pukul - Selesai",0,0,'L');
        $pdf->Ln(14);
    } else {
        if (date("m", strtotime($mulai)) == date("m", strtotime($selesai))){

            $pdf->Cell(43,5,'Hari/Tgl',0,0,'L');
            $pdf->Cell(0,5,": ".date("d", strtotime($mulai))." - ".tanggal_indo($selesai),0,0,'L');
            $pdf->Ln();
            $pdf->Cell(43,5,'Pukul',0,0,'L');
            $pdf->Cell(0,5,": $pukul - Selesai",0,0,'L');
            $pdf->Ln(14);
        } else {
            // $moon = tanggal_indo(date("m", strtotime($mulai)));
            $tglm = tanggal_indo($mulai);
            $tglm = explode(" ",$tglm);
            $tglm = substr($tglm[1], 0,3);
            $tgls = tanggal_indo($selesai);
            $tgls = explode(" ",$tgls);
            $tgls = substr($tgls[1], 0,3);
            $tgls = date('d', strtotime($selesai))." $tgls ".date('Y', strtotime($selesai));

            $pdf->Cell(43,5,'Hari/Tgl',0,0,'L');
            $pdf->Cell(0,5,": ".date('d', strtotime($mulai))."$tglm - $tgls" ,0,0,'L');
            $pdf->Ln();
            $pdf->Cell(43,5,'Pukul',0,0,'L');
            $pdf->Cell(0,5,": $pukul - Selesai",0,0,'L');
            $pdf->Ln(14);
        }

    }
    
    $pdf->SetLineWidth(0);
    $pdf->Line(33,98,180,98);
    $pdf->SetLineWidth(0);
    $pdf->Line(33,98.5,180,98.5);

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

        // $no = 1;
        // $cek_keterangan1 = $konek->query("SELECT * FROM absen WHERE kode_pelajaran = '$kode_matpel' AND sesi = '$sesi' AND keterangan = 'Hadir' ");
        // $ket_h = $cek_keterangan1->num_rows;
        // $cek_peserta1 = $konek->query("SELECT A.nip_peserta, B.nama_peserta, B.angkatan  FROM matpel_peserta A INNER JOIN peserta B ON A.nip_peserta = B.nip WHERE A.kode_pelajaran = '$kode_matpel' ORDER BY A.nip_peserta ASC");
        // $count = $cek_peserta1->num_rows;
        // while ($rows = $cek_peserta1->fetch_assoc()){
        //     $ambil_nip = $rows['nip_peserta'];
        //     $cek_keterangan = $konek->query("SELECT * FROM absen WHERE kode_pelajaran = '$kode_matpel' AND sesi = '$sesi' AND nip = '$ambil_nip' ");
        //     $ambil_ket = $cek_keterangan->fetch_assoc();
        //     $sub[$a] = $total;
        //     if (!$ambil_ket['keterangan']){ 
        //         $ket = "Tidak Hadir";
        //     } else {  
        //         $ket = $ambil_ket['keterangan'];
        //     }
            $no = 1;
            $cek_ikut_event = $konek->query("SELECT C.nip, C.nama_peserta, C.angkatan, B.keterangan FROM events A INNER JOIN events_peserta B INNER JOIN peserta C ON A.id_event = B.id_event AND B.nip_peserta = C.nip WHERE A.id_event = '$id'");
            $cek_ikut_event2 = $konek->query("SELECT C.nip, C.nama_peserta, C.angkatan, B.keterangan FROM events A INNER JOIN events_peserta B INNER JOIN peserta C ON A.id_event = B.id_event AND B.nip_peserta = C.nip WHERE A.id_event = '$id' AND B.keterangan = 'Hadir'");
            $count_a = $cek_ikut_event->num_rows;
            $count_h = $cek_ikut_event2->num_rows;
            while ($rows = $cek_ikut_event->fetch_assoc()){
                if ($rows['keterangan']){
                    $ket = $rows['keterangan'];
                } else {
                    $ket = "Tidak Hadir";
                }
                
            
        
        $x = $pdf->GetX();
        $pdf->headerCell($w, $h, $x, $no);
        $x = $pdf->GetX();
        $pdf->pdfCell($w+13, $h, $x, $rows['nip']);
        $x = $pdf->GetX();
        $pdf->pdfCell($w+45, $h, $x, strtoupper($rows['nama_peserta']));
        $x = $pdf->GetX();
        $pdf->pdfCell($w+22, $h, $x, $rows['angkatan']);
        $x = $pdf->GetX();
        $pdf->pdfCell($w+20, $h, $x, $ket);
        $pdf->ln();

        $no++;

        }
        $ketth = $count_a-$count_h;
        $pdf->SetFont('Arial','',10);
        $pdf->ln(20);
        $pdf->Cell(50,4,'Peserta yang hadir',0,0,'L');
        $pdf->Cell(58,4,": $count_h",0,0,'L');
        $pdf->Cell(0,4,"Jakarta, ".tanggal_indo($mulai),0,0,'L');
        $pdf->ln();
        $pdf->Cell(50,4,'Peserta yang tidak hadir',0,0,'L');
        $pdf->Cell(58,4,": $ketth",0,0,'L');
        $pdf->Cell(0,4,"Ketua Pelaksana",0,0,'L');
        $pdf->ln();
        $pdf->Cell(50,4,'Peserta yang seharusnya hadir',0,0,'L');
        $pdf->Cell(0,4,": $count_a",0,0,'L');
        $pdf->ln(30);
        // $pdf->SetX(135);
        $pdf->Cell(120,4,"",0,0,'L');
        $pdf->Cell(0,4,"(".$arr_event['ketua'].")",0,0,'C');
    

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