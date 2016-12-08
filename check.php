<?php
 ob_start();
 session_start();
 require_once 'dbconnect.php';
   $qry = "INSERT INTO archiwum select * from ogloszenia where data < NOW() - interval 30 day;";
   $qry_res = mysqli_query($conn, $qry);
   $qry = "DELETE FROM ogloszenia where data < NOW() - interval 30 day;";
   $qry_res = mysqli_query($conn, $qry);
    if (empty($_COOKIE['islogged'])) {
		if (isset($_SESSION['nick'])) {
   	session_unset();
	Header("Refresh: 3; URL = login.php");
	}}
?>