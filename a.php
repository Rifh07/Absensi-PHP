<html>

<body>

<div id="menu">

<a href="http://localhost/latihan/home">Home</a>

<a href="http://localhost/latihan/about">About</a>

<a href="http://localhost/latihan/contact">Contact</a>

<a href="http://localhost/latihan/testimonial">Testimonial</a>

</div>

<div id="isi">

<p>

<?php

if($_GET['q'] == "home"){

echo "Ini adalah halaman home";

}

if($_GET['q'] == "about"){

echo "Ini adalah halaman about us";

}

if($_GET['q'] == "contact"){

echo "Ini adalah halaman contact us";

}

if($_GET['q'] == "testimonial"){

echo "Ini adalah halaman testimonial";

}

?>

</p>

</div>

</body>

</html>



