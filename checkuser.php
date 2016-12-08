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
  <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST)) {
        $login    = $_POST['login'];
	    $password = $_POST['password'];
		 
	    if (empty($login) || empty($password)) {
		  return '<p>Wype&#322;nij wszystkie dane.</p>';
		} else {
		    if (file_exists('dbconnect.php')) {
                include_once('dbconnect.php');
		    } else {
		        return 'Brak pliku laczacego.';
		    }
		    if ($conn -> connect_error) {
                return '<p>Problem z po&#322;&#261;czeniem si&#281; z baz&#261; danych:' . $conn->connect_error . '[' . $conn->connect_errno . ']</p>';
            } else {
                               $login     = trim(strip_tags($conn -> real_escape_string($login)));
				$password = trim(strip_tags($conn -> real_escape_string($password)));
				$password = md5($password);
                $result = $conn -> query("SELECT nazwa, aktywny, id_user,admin FROM `uzytkownicy` WHERE nazwa = '$login' and haslo = '$password'");
                if ($result -> num_rows == 1) {
					$row = $result -> fetch_row();
					if ($row[1]==1) {
                    $_SESSION['id']   = $row[2];
                    $_SESSION['nick'] = $row[0];
                    setcookie('islogged', 'islogged', time() + 600);
					if ($row[3]==1)
					{
						$_SESSION['admin'] = $row[3];
						header('Location: admin.php');	
					}
					else{
		                    header('Location: userpanel.php');				
					}
				}} else {
                    echo '<p>Brak podanego u&#380;ytkownika w bazie lub nie jest on aktywowany.</p>';
                }
            }
		}
    }
  ?>
 </section>
<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/angular.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html><?php ob_end_flush(); ?>
