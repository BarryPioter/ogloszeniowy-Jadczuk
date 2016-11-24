<?php
require 'dbconnect.php';

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
		header('Location: index.php');

        }
    }
}
?>