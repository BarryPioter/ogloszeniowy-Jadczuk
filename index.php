<?php
 ob_start();
 session_start();
 require_once 'dbconnect.php';  
?>
<!DOCTYPE html>
<html lang="pl">
<head>
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Barry's Announcements</title>
</head>
<body>
<nav class="navbar navbar-default navbar-static-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">Barry's Announcements</a>
    </div>
      <form class="navbar-form navbar-left">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Czego poszukujesz?">
        </div>
        <button type="submit" class="btn btn-default">Szukaj</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
		<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Logowanie<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="login.php">Zaloguj</a></li>
            <li><a href="rejestracja.html">Zarejestruj</a></li>
          </ul>
        </li></ul>
    </div>
  </div>
</nav>
<div id="container">
<div class="content-top">
<center>
<h4>Barry's Announcements to darmowe ogłoszenia lokalne w kategoriach: Obuwie, Gry, Odzież, Samochody, Zwierzęta, Komputery. Szybko znajdziesz tu ciekawe ogłoszenia i łatwo skontaktujesz się z ogłoszeniodawcą. Jeśli chcesz coś sprzedać - w prosty sposób dodasz bezpłatne ogłoszenia. Chcesz coś kupić - tutaj znajdziesz ciekawe okazje, taniej niż w sklepie.</h4><br>
		<h1>Popularne kategorie</h1><br>
		
			<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <div class="hovereffect">
        <img class="img-responsive" src="img/kat/1.jpg" alt="">
            <div class="overlay">
				<p> 
					<h2><a href="kategoria.php">OBUWIE</a></h2>
				</p> 
            </div>
    </div>
</div>
			<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <div class="hovereffect">
        <img class="img-responsive" src="img/kat/2.jpg" alt="">
            <div class="overlay">
				<p> 
					<h2><a href="kategoria.php">GRY</a></h2>
				</p> 
            </div>
    </div>
</div>
			<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <div class="hovereffect">
        <img class="img-responsive" src="img/kat/3.jpg" alt="">
            <div class="overlay">
				<p> 
					<h2><a href="kategoria.php">ODZIEŻ</a></h2>
				</p> 
            </div>
    </div>
</div>
					<div class="clearfix"> </div><br><br><br>
			<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <div class="hovereffect">
        <img class="img-responsive" src="img/kat/4.jpg" alt="">
            <div class="overlay">
				<p> 
					<h2><a href="kategoria.php">SAMOCHODY</a></h2>
				</p> 
            </div>
    </div>
</div>
			<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <div class="hovereffect">
        <img class="img-responsive" src="img/kat/5.jpg" alt="">
            <div class="overlay">
				<p> 
					<h2><a href="kategoria.php">KOMPUTERY</a></h2>
				</p> 
            </div>
    </div>
</div>
<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <div class="hovereffect">
        <img class="img-responsive" src="img/kat/6.jpg" alt="">
            <div class="overlay">
				<p> 
					<h2><a href="kategoria.php">ZWIERZETA</a></h2>
				</p> 
            </div>
    </div>
</div>
<div class="clearfix"> </div></div>
<div class="footer">
				<div class="container">
			<center><div class="footer">
<br>
				<div class="col-md-12">
				<h4>Więcej informacji</h4>
				<ul class="list-unstyled">
						<li><a href="help.php">FAQ</a></li>
						<li><a href="lokalizacja.php">Lokalizacja</a></li>
						<li><a href="kontakt.php">Kontakt</a></li>
					</ul>
				</div>
			<div class="clearfix"> </div>
			</div></center>
		</div>
		<div class="footer-class">
		<p >© 2016 Barry All Rights Reserved </p>
		</div></div>
</div>
<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/angular.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html><?php ob_end_flush(); ?>

