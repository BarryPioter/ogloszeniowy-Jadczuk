<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "serwis";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Błąd polączenia");
} 
?>