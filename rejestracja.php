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
if ($_POST) {
    // Zabezpiecz dane z formularza przed kodem HTML i ewentualnymi atakami SQL Injection
    // Nie ma konieczności filtrowania haseł, bo one i tak zostaną zahashowane przed wstawieniem
    // do bazy danych
    $login = $conn->real_escape_string(htmlspecialchars(trim($_POST['login'])));
	 $imie = $_POST['imie'];
	  $nazwisko = $_POST['nazwisko'];
    $password = $_POST['password'];
    $passwordVerify = $_POST['password_v'];
    $email = $conn->real_escape_string(htmlspecialchars(trim($_POST['email'])));
    $emailVerify = $conn->real_escape_string(htmlspecialchars(trim($_POST['email_v'])));
	 $telefon = $_POST['telefon'];

    // Sprawdź czy podane przez użytkownika email lub login nie są zajęte
    $checkLogin = $conn->query("SELECT COUNT(*) FROM uzytkownicy WHERE nazwa = '$login'")->fetch_row();
    $checkEmail = $conn->query("SELECT COUNT(*) FROM uzytkownicy WHERE email = '$email'")->fetch_row();

    // Podstawowa walidacja formularza
    $errors = array();

    if (empty($login)|| empty($imie) || empty($nazwisko)  || empty($email) || empty($emailVerify) || empty($password) || empty($passwordVerify)|| empty($telefon)) {
        $errors[] = 'Proszę wypełnić wszystkie pola';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Podany adres e-mail jest niepoprawny';
    }

    if ($checkLogin[0] > 0) {
        $errors[] = 'Ten login jest już zajęty';
    }
    if ($checkEmail[0] > 0) {
        $errors[] = 'Ten e-mail jest już używany';
    }

    if ($password != $passwordVerify) {
        $errors[] = 'Podane hasła się nie zgadzają';
    }
    if ($email != $emailVerify) {
        $errors[] = 'Podane adresy e-mail się nie zgadzają';
    }

    // Jeśli wystąpiły jakieś błędy, to je pokaż
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo '<p class="error">'.$error.'</p>';
        }
    } else {
        // Blędów nie ma, możemy kontynuować rejestrację

        $password = md5($password); // hashowanie hasła
					$hash = md5( rand(0,1000) );

        // Zapisz dane do bazy
        $result = $conn->query("INSERT INTO uzytkownicy (nazwa, imie, nazwisko, haslo, email, telefon,hash) VALUES('$login', '$imie', '$nazwisko','$password', '$email', '$telefon', '$hash')");

        if (!$result) {
            echo '<p class="error">Wystąpił błąd przy rejestrowaniu użytkownika.<br>'.$conn->error.'</p>';
        } else {
            

$do     = $email;
$temat = 'Potwierdzenie rejestracji';
$tresc = '
 
Dziekujemy za rejestracje!
Bedziesz mogl sie zalogowac na swoje konto po aktywacji.
W celu aktywacji konta przepisz ponizszy kod aktywacyjny. 
 
------------------------
Login: '.$login.'
Haslo: '.$password.'
------------------------
 

Kliknij aby aktywowac konto: http://barry-ogloszenia.16mb.com/verify.php?email='.$email.'&hash='.$hash.'
 
';
                     
$nadawca = 'From:admin@barry-ogloszenia.16mb.com' . "\r\n";
mail($do, $temat, $tresc, $nadawca);
echo '<p>Pomyslnie utworzono konto.Nastapi przejscie do strony glownej.</p>'; 
Header("Refresh: 2; URL = index.php");
        }
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