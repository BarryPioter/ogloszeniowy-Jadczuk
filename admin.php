<?php
 ob_start();
 session_start();
 require_once 'dbconnect.php'; 
 require_once 'check.php';  
 error_reporting(0);
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
 <section id="main">
 <?php
    if (empty($_COOKIE['islogged'])) {
        header('Refresh: 5; url=login.php');
        return '<p>Czas sesji wygas&#322;. Prosz&#281; zalogowa&#263; si&#281; ponownie.</p><p> Za chwil&#281; nast&#261;pi przepierowanie</p>';
   }

   if (isset($_SESSION['nick'])||isset($_SESSION['id'])||isset($_SESSION['admin'])) {
      $wynik = mysqli_query($conn, "SELECT id,item,data,cena FROM `ogloszenia` WHERE `widok` =0")
	  or die('B&#322;&#261;d zapytania'); 
	  if(mysqli_num_rows($wynik) > 0) { 
 echo "<center>";
 echo "Ogloszenia oczekujace:";
 echo "<table border=1><tr>";
 echo "<td><strong>ID</strong></td>";
 echo "<td><strong>Nazwa</strong></td>";
 echo "<td><strong>Data</strong></td>";
 echo "<td><strong>Cena</strong></td>";
echo "<td><strong>Operacje</strong></td>";
 echo "</tr>";
	
    while($r = mysqli_fetch_array($wynik)) { 
		echo "<tr>"; 
		echo "<td><img class='img-responsive' src='img/oglosz/".$r[0].".jpg' width='80px' height='80px'>   </td>"; 
        echo "<td><a href='item.php?id=".$r[0]."'>".$r[1]."</a>   </td>"; 
        echo "<td>".$r[2]."</td>"; 
		echo "<td>".$r[3]." zł</td>";
		echo "<td><a href=\"usun.php?a=del&amp;id={$r[0]}\">Usu&#324;</a>       <a href=\"accept.php?a=del&amp;id={$r[0]}\">Akceptuj</a></td>";
        echo "</tr>"; 
    } 
    echo "</table>"; 
}
$all = mysqli_query($conn, "SELECT id,item,data,cena FROM `ogloszenia`")
	  or die('B&#322;&#261;d zapytania'); 
	  if(mysqli_num_rows($all) > 0) { 
 echo "<center>";
 echo "Wszystkie ogloszenia:";
 echo "<table border=1><tr>";
 echo "<td><strong>ID</strong></td>";
 echo "<td><strong>Nazwa</strong></td>";
 echo "<td><strong>Data</strong></td>";
 echo "<td><strong>Cena</strong></td>";
echo "<td><strong>Operacje</strong></td>";
 echo "</tr>";
	
    while($a = mysqli_fetch_array($all)) { 
		echo "<tr>"; 
		echo "<td><img class='img-responsive' src='img/oglosz/".$a[0].".jpg' width='80px' height='80px'></td>"; 
        echo "<td><a href='item.php?id=".$a[0]."'>".$a[1]."</a></td>"; 
        echo "<td>".$a[2]."</td>"; 
		echo "<td>".$a[3]." zł</td>";
		echo "<td><a href=\"usun.php?a=del&amp;id={$a[0]}\">Usu&#324;</a></td>";
        echo "</tr>"; 
    } 
    echo "</table>"; 
}
   } else {
       echo '<p>Nie jeste&#347; zalogowany. Przejd&#378; do <a href="login.php">Formularza logowania</a>.</p>';
   }
 ?>
 </section>
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