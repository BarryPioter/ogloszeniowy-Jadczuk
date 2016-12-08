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
if (isset($_POST['submit']))
{
	$nazwa = $_POST['nazwa'];
	$opis = $_POST['opis'];
	$kat = $_POST['kat'];
	$cena = $_POST['cena'];
	$filename = $_FILES["file"]["name"];
	$file_basename = substr($filename, 0, strripos($filename, '.')); // get file extention
	$file_ext = substr($filename, strripos($filename, '.')); // get file name
	$filesize = $_FILES["file"]["size"];
	$allowed_file_types = array('.jpg');
    if (empty($nazwa)|| empty($opis) || empty($kat) || empty($filename)|| empty($cena))
		{
        $errors[] = 'Prosz&#281; wype&#322;ni&#263; wszystkie pola';
    }
	if (in_array($file_ext,$allowed_file_types) && ($filesize < 2000000))
	{	
		if (!empty($errors)) {
        foreach ($errors as $error) {
            echo '<p class="error">'.$error.'</p>';
        }
    } else {
		$result = mysqli_query($conn, "INSERT INTO ogloszenia (id_user, id_kate, item, opis, cena, data) VALUES(".$_SESSION['id'].", ".$kat.", '".$nazwa."', '".$opis."', ".$cena.", now());");
		$id=mysqli_insert_id($conn);
		if (!$result) {
            echo '<p class="error">Wyst&#261;pi&#322; b&#322;&#261;d przy tworzeniu ogloszenia.<br>'.$conn->error.'</p>';
        } else {
		$newfilename = ($id) . $file_ext;		
		move_uploaded_file($_FILES["file"]["tmp_name"], "img/oglosz/" . $newfilename);
		echo 'Pomyslnie utworzono ogloszenie. Zostaniesz przeniesiony do swojego profilu';
		Header("Refresh: 5; URL = userpanel.php");
			   }
			}
	}
	else 
	{
		echo 'Problem z pikiem';
	}
}
?>
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