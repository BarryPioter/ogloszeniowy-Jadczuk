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
<div id='menu' class='col-lg-2 col-md-3 col-sm-6 col-xs-12' style="padding-top:70px;">
<ul style="display: block;background-color:#e95420;color:white;border-radius:12px;">
<?php 
$kat = mysqli_query($conn, "SELECT id_kate FROM ogloszenia WHERE id=".$id)
or die('B&#322;&#261;d zapytania 1');
if(mysqli_num_rows($kat) == 0) {
	$k = $kat -> fetch_row();
}
$menu = mysqli_query($conn, "SELECT id_kategorii,kategoria  FROM kategorie") 
or die('B&#322;&#261;d zapytania 2'); 
if(mysqli_num_rows($menu) > 0) {  
    while($d = mysqli_fetch_array($menu)) {
		if ($d[0]==$k[0])
		{
		echo "<li><a href='kategoria.php?id=".$d[0]."' style='color:gray;'>".$d[1]."</a></li>"; 
		}
	else{
		echo "<li><a href='kategoria.php?id=".$d[0]."' style='color:white;'>".$d[1]."</a></li>"; 	
	}

}
} 
?>
</ul>
</div>
<div class='col-lg-10 col-md-9 col-sm-6 col-xs-12'>
<center>
<?php
$id =$_GET['id'];
$przedmiot = mysqli_query($conn, "SELECT id,item,opis,cena,id_user,id_kate FROM ogloszenia WHERE id=".$id)
or die('B&#322;&#261;d zapytania 3');
if(mysqli_num_rows($przedmiot) > 0) {
	$p = $przedmiot -> fetch_row();
}
$sprzedawca = mysqli_query($conn, "SELECT id_user,nazwa,imie,nazwisko,telefon FROM uzytkownicy WHERE id_user=".$p[4])
or die('B&#322;&#261;d zapytania 4');
if(mysqli_num_rows($sprzedawca) > 0) {
	$s = $sprzedawca -> fetch_row();
}
      echo "<h1>".$p[1]."</h1>";
echo "<img class='img-responsive' src='img/oglosz/".$p[0].".jpg' width='350px' height='350px'><br>";
 if (isset($_SESSION['nick'])||isset($_SESSION['id'])) {
echo "<h3><strong>Cena: ".$p[3]." z&#322;</strong></h3>";
echo "<p>".$p[2]."</p>";
echo "<h4><i>Sprzedaj&#261;cy: ".$s[2]." ".$s[3]."</i></h4>";
echo "<h5 class='btn btn-warning'>Telefon: ".$s[4]."</h5><br><br>";
echo"<a href='wiadomosc.php?id=".$s[0]."' class='btn btn-info'>";
echo"<span class='glyphicon glyphicon-envelope'></span>  Napisz do sprzedawcy!</a>";
}
else {
       echo '<h4 class="btn btn-warning">Nie jeste&#347; zalogowany. Nie zobaczysz szczegolow tego ogloszenia.</h4>';
   }


mysqli_close($conn); 
 ?>

</div></div>
<div id="footer">
<center>
<div class="col-md-12">
<h4>Więcej informacji</h4>
<ul class="list-unstyled">
<li><a href="help.php">FAQ</a></li>
<li><a href="kontakt.php">Kontakt</a></li>
</ul>
<p>© 2016 Barry All Rights Reserved </p>
</div>
</div></div>
<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/angular.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html><?php ob_end_flush(); ?>