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
 
if(isset($_POST['email'])) {
$id =$_GET['id'];

$sc = mysqli_query($conn, "SELECT email FROM uzytkownicy WHERE id_user=".$id)
or die('B&#322;&#261;d zapytaniad');
if(mysqli_num_rows($sc) == 1) {
	$s = $sc -> fetch_row();
	$email_to = $s[0];
}
    else{
		    $email_to = "kozak.prozak@gmail.com";
	} 
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
 

 
    $email_subject = "[Kontakt]Wiadomosc z serwisu ogloszeniowego!";
 
     
 
     
 
    function died($error) {
 
        // your error code can go here
 
        echo "Chyba masz jakis blad/bledy. ";
 
        echo "Pokazemy ci je ponizej.<br /><br />";
 
        echo $error."<br /><br />";
 
        echo "Prosze wroc i napraw to.<br /><br />";
 
        die();
 
    }
 
     
 
    // validation expected data exists
 
    if(!isset($_POST['imie']) ||
 
        !isset($_POST['nazwisko']) ||
 
        !isset($_POST['email']) ||
 
        !isset($_POST['telefon']) ||
 
        !isset($_POST['tresc'])) {
 
        died('Ktores z pol jest zle wypelnione.');       
 
    }
 
     
 
    $first_name = $_POST['imie']; // required
 
    $last_name = $_POST['nazwisko']; // required
 
    $email_from = $_POST['email']; // required
 
    $telephone = $_POST['telefon']; // not required
 
    $comments = $_POST['tresc']; // required
 
     
 
    $error_message = "";
 
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
 
    $error_message .= 'Twoj email nie jest prawidlowy.<br />';
 
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$first_name)) {
 
    $error_message .= 'Twoje imie nie jest prawidlowe.<br />';
 
  }
  
      $phone_exp = "/^[0-9]{9}$/";
 
  if(!preg_match($phone_exp,$telephone)) {
 
    $error_message .= 'Twoj numer telefonu nie jest prawidlowy.<br />';
 
  }
 
  if(!preg_match($string_exp,$last_name)) {
 
    $error_message .= 'Twoje nazwisko nie jest prawidlowe.<br />';
 
  }
 
  if(strlen($comments) < 2) {
 
    $error_message .= 'Tresc twojej wiadomosci jest za krotka.<br />';
 
  }
 
  if(strlen($error_message) > 0) {
 
    died($error_message);
 
  }
 
 
     
 
    function clean_string($string) {
 
      $bad = array("content-type","bcc:","to:","cc:","href");
 
      return str_replace($bad,"",$string);
 
    }
 
     
 
    $email_message .= "Imie: ".clean_string($first_name)."\n";
 
    $email_message .= "Nazwisko: ".clean_string($last_name)."\n";
 
    $email_message .= "Email: ".clean_string($email_from)."\n";
 
    $email_message .= "Telefon: ".clean_string($telephone)."\n";
 
    $email_message .= "Tresc: ".clean_string($comments)."\n";
 
     
 
     
 
// create email headers
 
$headers = 'From:kontakt@barry-ogloszenia.16mb.com' . "\r\n";
 
@mail($email_to, $email_subject, $email_message, $headers);  

Header("Refresh: 2; URL = index.php");
 
 
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
</html>
<?php 
ob_end_flush(); 
?>