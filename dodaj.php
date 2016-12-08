<?php
 ob_start();
 session_start();
 require_once 'dbconnect.php'; 
 require_once 'check.php';  
?>
<!DOCTYPE html>
<html lang="pl">
<head>
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<meta http-equiv="Content-Type" content="text/html"/>
<meta charset="UTF-8">
<title>Barry's Announcements</title>
<style>
#section1 {padding-top:10px; width:400px;
</style>
</head>
<body>
<div id="wrapper">
<nav class="navbar navbar-default navbar-static-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a href="index.php"><img src="img/logo.png" height="42" width="42"></a>
    </div>
      <form action="szukaj.php" method="GET" class="navbar-form navbar-left">
        <div class="form-group">
          <input type="text" name="szukaj" class="form-control" placeholder="Czego poszukujesz?">
        </div>
        <button type="submit" class="btn btn-default">Szukaj</button>
      </form>
	   <?php 
	  if ($_SESSION['nick']){
	echo'<form action="dodaj.php" class="navbar-form navbar-left">';
    echo'<button type="submit" class="btn btn-success">Dodaj</button>';
      echo'</form>';
		   }
 ?>
      <ul class="nav navbar-nav navbar-right">
		<?php 
 if ($_SESSION['nick']){
		 echo'<li><a href="#">Witaj, '.$_SESSION['nick'].'</a></li>';
echo'<li class="dropdown">';
          echo'<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Konto<span class="caret"></span></a>';
           echo'<ul class="dropdown-menu">';
            echo'<li><a href="userpanel.php">Profil</a></li>';
 if ($_SESSION['admin']){
            echo'<li><a href="admin.php">Panel administratora</a></li>';
 }
 echo'<li><a href="logout.php">Wyloguj</a></li>';
           echo'</ul>';
         echo'</li>';

}else{
 echo'<li class="dropdown">';
          echo'<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Logowanie<span class="caret"></span></a>';
           echo'<ul class="dropdown-menu">';
            echo'<li><a href="login.php">Zaloguj</a></li>';
            echo'<li><a href="register.php">Zarejestruj</a></li>';
           echo'</ul>';
         echo'</li>';

 }
 ?></ul>
    </div>
   </nav>
<div id="section1" class="container-fluid">

<form action="upload.php" enctype="multipart/form-data" method="post">
  <div class="form-group">
    <label >Nazwa produktu</label>
    <input type="text" class="form-control" name="nazwa" />
  </div>
  <label for="kat">Kategoria</label>
  <select class="form-control" name="kat">
  <?php  
$wynik = mysqli_query($conn, "SELECT id_kategorii,kategoria  FROM kategorie") 
or die('B&#322;&#261;d zapytania');
while($r = mysqli_fetch_array($wynik)) {
echo "<option value='".$r[0]."'>".$r[1]."</option>";
}
?> 
	
  </select>
  <div class="form-group">
    <label >Cena w z&#322;</label>
    <input type="number" class="form-control" name="cena" />
  </div>
 <div class="form-group">
  <label for="opis">Opis:</label>
  <textarea class="form-control" rows="10" id="opis" name="opis"></textarea>
</div>
  <div class="form-group">
    <label>Zdj&#281;cie przedmiotu</label>
<input id="file" name="file" type="file" />
</div>
<center>
  <button type="submit" class="btn btn-default" name="submit">Wyslij</button>
</form>
</div>
</div>
<div id="footer">
<center>
<div class="col-md-12">
<h4>WiÄ™cej informacji</h4>
<ul class="list-unstyled">
<li><a href="help.php">FAQ</a></li>
<li><a href="kontakt.php">Kontakt</a></li>
</ul>
<p >Â© 2016 Barry All Rights Reserved </p>
</div>
</div></div>
<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/angular.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html><?php ob_end_flush(); ?>