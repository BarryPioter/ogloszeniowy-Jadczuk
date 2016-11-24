<?php
ob_start();
session_start();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Barry's Announcements</title>
</head>
<body>
 <nav class="navbar navbar-default navbar-static-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Barry's Announcements</a>
    </div>
      <form class="navbar-form navbar-left">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Czego poszukujesz?">
        </div>
        <button type="submit" class="btn btn-default">Szukaj</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
		<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Logowanie<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Zaloguj</a></li>
            <li><a href="rejestracja.php">Zarejestruj</a></li>
          </ul>
        </li></ul>
    </div>
  </div>
</nav>

 <section id="main">
  <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST)) {
        $login    = $_POST['login'];
	    $password = $_POST['password'];
		 
	    if (empty($login) || empty($password)) {
		  return '<p>Wypełnij wszystkie dane.</p>';
		} else {
		    if (file_exists('dbconnect.php')) {
                include_once('dbconnect.php');
		    } else {
		        return 'Brak pliku laczacego.';
		    }
		    if ($conn -> connect_error) {
                return '<p>Problem z połączeniem się z bazą danych:' . $conn->connect_error . '[' . $conn->connect_errno . ']</p>';
            } else {
                $login     = trim(strip_tags($conn -> real_escape_string($login)));
				$password = trim(strip_tags($conn -> real_escape_string($password)));
				$password = md5($password);

                $result = $conn -> query("SELECT login, aktywny FROM `uzytkownicy` WHERE nazwa = '$login' and haslo = '$password'");
                if ($result -> num_rows == 1) {
                    $row = $result -> fetch_row();
                    $_SESSION['aktywny']   = $row[1];
                    $_SESSION['nick'] = $row[0];
                    setcookie('islogged', 'islogged', time() + 600);
                    header('Location: userpanel.php');
                } else {
                    echo '<p>Brak podanego użytkownika w bazie.</p>';
                }
            }
		}
    }
  ?>
 </section>
</body>
</html>
<?php
ob_end_flush();
?>
