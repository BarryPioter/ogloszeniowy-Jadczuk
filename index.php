<?php
 ob_start();
 session_start();
 require_once 'dbconnect.php';  
$sql = "SELECT * FROM ogloszenia";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo $row["id"]. "        User_ID:" . $row["id_user"]. "       KAT_ID:" . $row["id_kate"]. "         NAZWA:" . $row["item"]. "           CENA:" . $row["cena"]. "z&#322; OPIS:" . $row["opis"]. "            DATA:" . $row["data"]. "<br>";
    }
} else {
    echo "0 results";
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Serwis og&#322;osze&#324;</title>
</head>
<body>
<div>

</div>
</body>
</html>
<?php ob_end_flush(); ?>