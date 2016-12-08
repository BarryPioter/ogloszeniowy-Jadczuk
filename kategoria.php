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
$menu = mysqli_query($conn, "SELECT id_kategorii,kategoria  FROM kategorie") 
or die('B&#322;&#261;d zapytania 1'); 
if(mysqli_num_rows($menu) > 0) {  
    while($d = mysqli_fetch_array($menu)) {
	echo "<li><a href='kategoria.php?id=".$d[0]."' style='color:white;'>".$d[1]."</a></li>"; 
}
} 
?>
</ul>
</div>
<div class='col-lg-10 col-md-9 col-sm-6 col-xs-12'>
<center>
<?php
$id =$_GET['id'];
$vipy = mysqli_query($conn, "SELECT id,item,cena FROM ogloszenia WHERE id_kate=".$id." and `widok` =1 and `vip` =1") 
or die('B&#322;&#261;d zapytania 2');
if(mysqli_num_rows($vipy) > 0) {	
 echo "<table id='kat' border=1><tr>";
 echo "<td><center><strong>Foto</strong></td>";
 echo "<td><center><strong>Nazwa</strong></td>";
 echo "<td><center><strong>Cena</strong></td>";
 echo "</tr>";
    while($r = mysqli_fetch_array($vipy)) { 
	echo "<tr>";
        echo "<td bgcolor='#6d4d47' style='max-width:100px'><center><a href='item.php?id=".$r[0]."'><img class='img-responsive' src='img/oglosz/".$r[0].".jpg' width='100px' height='100px'></a></td>";
        echo "<td bgcolor='#6d4d47' style='min-width:250px'><center><a href='item.php?id=".$r[0]."'>".$r[1]."</a></td>"; 
		echo "<td bgcolor='#6d4d47' style='min-width:100px'><center>".$r[2]." z&#322;</td>";
        echo "</tr>"; 
    }
}
$wynik = mysqli_query($conn, "SELECT id,item,cena FROM ogloszenia WHERE id_kate=".$id." and `widok` =1 and `vip` =0") 
or die('B&#322;&#261;d zapytania 3');
if(mysqli_num_rows($wynik) > 0) {
if(mysqli_num_rows($vipy) > 0) { 
while($s = mysqli_fetch_array($wynik)) { 
	echo "<tr>";
        echo "<td style='max-width:100px'><center><a href='item.php?id=".$s[0]."'><img class='img-responsive' src='img/oglosz/".$s[0].".jpg' width='100px' height='100px'></a></td>";
        echo "<td style='min-width:250px'><center><a href='item.php?id=".$s[0]."'>".$s[1]."</a></td>"; 
		echo "<td style='min-width:100px'><center>".$s[2]." z&#322;</td>";
        echo "</tr>"; 
}}
else {
echo "<table id='kat' border=1><tr>";
 echo "<td><center><strong>Foto</strong></td>";
 echo "<td><center><strong>Nazwa</strong></td>";
 echo "<td><center><strong>Cena</strong></td>";
 echo "</tr>";
    while($s = mysqli_fetch_array($wynik)) { 
	echo "<tr>";
        echo "<td style='max-width:100px'><center><a href='item.php?id=".$s[0]."'><img class='img-responsive' src='img/oglosz/".$s[0].".jpg' width='100px' height='100px'></a></td>";
        echo "<td style='min-width:250px'><center><a href='item.php?id=".$s[0]."'>".$s[1]."</a></td>"; 
		echo "<td style='min-width:100px'><center>".$s[2]." z&#322;</td>";
        echo "</tr>"; 
    }
    
} }
if((mysqli_num_rows($wynik) > 0)or (mysqli_num_rows($vipy) > 0))
{
echo "</table>"; 
}
if((mysqli_num_rows($wynik) == 0)and (mysqli_num_rows($vipy) == 0))
{
echo "<h2>W wybranej kategorii nie ma &#380;adnych aktywnych og&#322;osze&#324;.</h2>";
}
echo"<?div>";
mysqli_close($conn); 
 ?>
</div>
<div id="footer">
<center>
<div class="col-md-12">
<h4>Więcej informacji</h4>
<ul class="list-unstyled">
<li><a href="help.php">FAQ</a></li>
<li><a href="kontakt.php">Kontakt</a></li>
</ul>
<p >© 2016 Barry All Rights Reserved </p>
</div>
</div></div>
<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/angular.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html><?php ob_end_flush(); ?>