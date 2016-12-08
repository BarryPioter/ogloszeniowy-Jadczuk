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
<div id="content" class="container-fluid">
<p><span style="color: rgb(127, 127, 127);"><strong><span style="color: rgb(165, 165, 165);"><u>REJESTRACJA I LOGOWANIE</u></span></strong></span></p>
<p><strong></strong></p><p><strong></strong></p><p><strong>Czy muszę się rejestrować, aby utworzyć ogłoszenie?</strong></p><p>Tak, tylko jako zalogowany użytkownik możesz tworzyć, przeglądać ogłoszenia oraz koresponodować z innymi użytkownikami.</p>
<p><strong>Czy mogę zmienić lub uzupełnić dane adresowe podane w trakcie rejestracji? </strong></p><p>Nie, ta opcja nie jest jescze dostepna. Jeszcze.</p>
<p><strong>Mam już konto w serwisie, ale nie mogę się zalogować. Co robić?</strong></p><strong></strong><p>W  przypadku problemów z logowaniem należy ponownie wpisać poprawny login i hasło do konta. Jeśli kolejne próby logowania  okażą się nieskuteczne skontaktuj się z nami: <a href="mailto:kozak.prozak@gmail.com">kozak.prozak@gmail.com</a>.</p>
<p><span style="color: rgb(127, 127, 127);"><br><strong></strong></span></p><p><span style="color: rgb(127, 127, 127);"><strong><span style="color: rgb(165, 165, 165);"><span style="color: rgb(165, 165, 165);"><u>WYSYŁKA I DOSTAWA</u></span></span></strong></span><br><strong></strong></p>
<p><strong>Jakie są koszty dostawy w Polsce?</strong></p><p>Wszystkie ceny zależne są od sposobu wysyłki jaki wybrał ogłoszeniodawca.</p>
<p><strong>Czy istnieje możliwość wysyłki towaru za granicę?</strong></p><p>Możliwośc jest zależna od ogłoszeniodawcy</p><p><br><strong></strong></p>
<p><span style="color: rgb(127, 127, 127);"><strong><span style="color: rgb(165, 165, 165);"><u>WYMIANA, ZWROT, REKLAMACJA</u></span></strong></span></p><p><strong></strong></p>
<p><strong>Co jeśli przesyłka zostanie uszkodzona podczas transportu?</strong></p><p>A ja wiem. Już nie chce mi się tego pisać. Radź sobie sam</a>.</p>
<p><strong>Jak mogę dokonać zwrotu bądź reklamacji zakupionego towaru?</strong></p><p>Nie możesz. My za to nie odpowiadamy.</a>.</p>
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