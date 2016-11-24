<?php
 ob_start();
 session_start();
 require_once 'dbconnect.php';  
?>
<!DOCTYPE html>
<html>
<head>
<script src="jquery-3.1.1.min.js"></script>
<script src="angular.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<link href="css/bootstrap.min.css" rel="stylesheet">
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
<form action="upload.php" enctype="multipart/form-data" method="post">
<input id="file" name="file" type="file" />
<input id="Submit" name="submit" type="submit" value="Submit" />
</form>
<?phpinclude 'cos.php'; ?>
</div>
<div class="footer">
				<div class="container">
			<center><div class="footer-top-at">

				<div class="col-md-44 amet-sed">
				<h4>Więcej informacji</h4>
				<ul class="nav-bottom">
						<li><a href="1.php">FAQ</a></li>
						<li><a href="contact.html">Lokalizacja</a></li>
						<li><a href="#">Kontakt</a></li>
					</ul>
				</div>
			<div class="clearfix"> </div>
			</div></center>
		</div>
		<div class="footer-class">
		<p >© 2016 Barry All Rights Reserved </p>
		</div></div>
</div>
</body>
</html>
<?php ob_end_flush(); ?>