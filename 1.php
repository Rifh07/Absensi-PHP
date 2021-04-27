<?php
session_start();

if (!isset($_SESSION['nip'])){
   header('location: ./login');
} 

require_once("konek/koneksi.php");
?>
<!DOCTYPE html>
	<html lang="zxx" class="no-js">
	<head>
		<!-- Mobile Specific Meta -->
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Favicon-->
		<link rel="shortcut icon" href="img/fav.png">
		<!-- Author Meta -->
		<meta name="author" content="codepixer">
		<!-- Meta Description -->
		<meta name="description" content="">
		<!-- Meta Keyword -->
		<meta name="keywords" content="">
		<!-- meta character set -->
		<meta charset="UTF-8">
		<!-- Site Title -->
		<title>Getsmart Indonesia</title>

		<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet"> 
			<!--
			CSS
			============================================= -->
			<link rel="stylesheet" href="css/linearicons.css">
			<link rel="stylesheet" href="css/font-awesome.min.css">
			<link rel="stylesheet" href="css/bootstrap.css">
			<link rel="stylesheet" href="css/magnific-popup.css">
			<link rel="stylesheet" href="css/nice-select.css">					
			<link rel="stylesheet" href="css/animate.min.css">
			<link rel="stylesheet" href="css/owl.carousel.css">
			<link rel="stylesheet" href="css/main.css">
		</head>
		<body>

			  <header id="header" id="home">			  	
			    <div class="container">
			    	<div class="row align-items-center justify-content-between d-flex">
				      <div id="logo">
				        <a href="index.html"><img src="img/gs1.png" width="200px" alt="" title="" /></a>
				      </div>
				      <nav id="nav-menu-container">
				        <ul class="nav-menu">
				          <li class="menu-active"><a href="#home">Home</a></li>
				          <li><a href="#Jadwal">Jadwal</a></li>
				          <li><a href="./Transaksi">Transaksi</a></li>
				          <li></li>
				          <li><p style="color: white;">Saldo : Rp.20000</p></li>
				        </ul>
				      </nav><!-- #nav-menu-container -->		    		
			    	</div>
			    </div>
			  </header><!-- #header -->


			<!-- start banner Area -->
			<section class="banner-area" id="home">	
				<div class="container">
					<div class="row fullscreen d-flex align-items-center justify-content-start">
																
					</div>
				</div>
			</section>
			
			<!-- Start menu Area -->
			<section class="menu-area section-gap" id="Jadwal">
				<div class="container">
					<div class="row d-flex justify-content-center">
						<div class="menu-content pb-60 col-lg-10">
							<div class="title text-center">
								<h1 class="mb-10">Jadwal Event</h1>
								<p>Jangan sampai terlewatkan, daftarkan dirimu segera!</p>
							</div>
						</div>
					</div>						
					<div class="row">
						<div class="col-lg-4">
							<div class="single-menu">
							<a href="img/acara/IMG_8103.jpg">
										<img class="img-fluid" src="img/acara/IMG_8103.jpg" alt="">
									</a>
									<br><br>
								<div class="title-div justify-content-between d-flex">
									<h4>Nama Event</h4>
									<p class="price float-right">
										20.000
									</p>
								</div>
								<table>
									<tr>
										<td><h6>Tanggal</h6></td>
										<td><h6>: Senin, 28 oktober 1945</h6></td>
									</tr>
									<tr>
										<td><h6>Jam</h6></td>
										<td><h6>: 14:00</h6></td>
									</tr>
								</table>
								<br>
								<p>
									Deskripsi event Deskripsi event Deskripsi event Deskripsi event Deskripsi event 
								</p>
								<a href="#" class="primary-btn2 text-uppercase">Join Now</a>								
							</div>
						</div>	
						
						<div class="col-lg-4">
							<div class="single-menu">
							<a href="img/acara/IMG_8103.jpg">
										<img class="img-fluid" src="img/acara/IMG_8103.jpg" alt="">
									</a>
									<br><br>
								<div class="title-div justify-content-between d-flex">
									<h4>Nama Event</h4>
									<p class="price float-right">
										20.000
									</p>
								</div>
								<table>
									<tr>
										<td><h6>Tanggal</h6></td>
										<td><h6>: Senin, 28 oktober 1945</h6></td>
									</tr>
									<tr>
										<td><h6>Jam</h6></td>
										<td><h6>: 14:00</h6></td>
									</tr>
								</table>
								<br>
								<p>
									Deskripsi event Deskripsi event Deskripsi event Deskripsi event Deskripsi event 
								</p>
								<a href="#" class="primary-btn2 text-uppercase">Join Now</a>								
							</div>
						</div>

						<div class="col-lg-4">
							<div class="single-menu">
							<a href="img/acara/IMG_8103.jpg">
										<img class="img-fluid" src="img/acara/IMG_8103.jpg" alt="">
									</a>
									<br><br>
								<div class="title-div justify-content-between d-flex">
									<h4>Nama Event</h4>
									<p class="price float-right">
										20.000
									</p>
								</div>
								<table>
									<tr>
										<td><h6>Tanggal</h6></td>
										<td><h6>: Senin, 28 oktober 1945</h6></td>
									</tr>
									<tr>
										<td><h6>Jam</h6></td>
										<td><h6>: 14:00</h6></td>
									</tr>
								</table>
								<br>
								<p>
									Deskripsi event Deskripsi event Deskripsi event Deskripsi event Deskripsi event 
								</p>
								<a href="#" class="primary-btn2 text-uppercase">Join Now</a>								
							</div>
						</div>
					</div>
				</div>	
			</section>
			<!-- End menu Area -->
			
			

			<!-- start footer Area -->		
			<footer class="sticky-footer bg-orange">
        		<div class="container my-auto">
          			<div class="copyright text-center my-auto">
            			<span>Copyright &copy; Getsmart Indonesia <?=$thn?></span>
          			</div>
        		</div>
      		</footer>
			<!-- End footer Area -->	

			<script src="js/vendor/jquery-2.2.4.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
			<script src="js/vendor/bootstrap.min.js"></script>			
			<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
  			<script src="js/easing.min.js"></script>			
			<script src="js/hoverIntent.js"></script>
			<script src="js/superfish.min.js"></script>	
			<script src="js/jquery.ajaxchimp.min.js"></script>
			<script src="js/jquery.magnific-popup.min.js"></script>	
			<script src="js/owl.carousel.min.js"></script>			
			<script src="js/jquery.sticky.js"></script>
			<script src="js/jquery.nice-select.min.js"></script>			
			<script src="js/parallax.min.js"></script>	
			<script src="js/waypoints.min.js"></script>
			<script src="js/jquery.counterup.min.js"></script>					
			<script src="js/mail-script.js"></script>	
			<script src="js/main.js"></script>	
		</body>
	</html>



