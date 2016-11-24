<!DOCTYPE html>
<html lang="pl">
<head>
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Barry's Announcements</title>
</head>
<body>
    <div id="header">
        <h3>Potwierdzenie rejestracji</h3>
    </div>

    <div id="wrap">
        <?php
            require 'dbconnect.php';
        ?>
    </div>
<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/angular.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
<?php
require 'dbconnect.php';
if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
    // Verify data
    $email =$_GET['email'];
	$email = mysqli_real_escape_string($conn, $email);// Set email variable
    $hash = $_GET['hash']; 
	$hash = mysqli_real_escape_string($conn, $hash);// Set hash variable
                 
    $search = $conn->query("SELECT email, hash, aktywny FROM uzytkownicy WHERE email='".$email."' AND hash='".$hash."' AND aktywny='0'") or die(mysql_error()); 
    $match  = mysqli_num_rows($search);
                 
    if($match > 0){
        // We have a match, activate the account
        $conn->query("UPDATE uzytkownicy SET aktywny='1' WHERE email='".$email."' AND hash='".$hash."' AND aktywny='0'") or die(mysql_error());
        echo '<div class="statusmsg">Twoje konto zostało aktywowane, możesz się zalogować</div>';
    }else{
        // No match -> invalid url or account has already been activated.
        echo '<div class="statusmsg">Niewłaściwy link potwierdzający lub twoje konto jest już aktywne.</div>';
    }
                 
}else{
    // Invalid approach
    echo '<div class="statusmsg">Niewłaściwa próba, proszę użyć linku wysłanego emailem.</div>';
}
?>