<?php
ob_start();
session_start();
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
<center>
 <section id="main">
  <form action="checkuser.php" method="POST" id="login-form">
   <fieldset>
    <dl>
     <dt><label for="nick">Login:</label></dt>
      <dd><input type="text" name="login" id="nick" placeholder="Login"></dd>
     <dt><label for="password">Hasło:</label></dt>
      <dd><input type="password" name="password" id="password" placeholder="Hasło"></dd>
     <dt><input type="submit" name="check" value="Zaloguj"></dt>
	</dl>
   </fieldset>
  </form>
 </section>
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