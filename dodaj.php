<?php
session_start();
include_once 'dbconnect.php';




?>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="styleshee.css"/>
	
	
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
  body {
background-color: #1E88E5;
  }
  #section1 {padding-top:50px;height:500px; width:400px;color: #fff; background-color: #1E88E5;}
  </style>
</head>
<body>

<nav class="navbar navbar-default navbar-static-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">Barry's Announcements</a>
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
            <li><a href="login.php">Zaloguj</a></li>
            <li><a href="rejestracja.html">Zarejestruj</a></li>
          </ul>
        </li></ul>
    </div>
  </div>
</nav>
<div id="section1" class="container-fluid">
  <form role="form" method="post" action="new.php" enctype="multipart/form-data">
  <div class="form-group">
    <label >Nazwa produktu</label>
    <input type="text" class="form-control" id="nazwa" />
  </div>
  <div class="form-group">
    <label>Typ</label>
    <input type="text" class="form-control" id="typ" />
  </div>
    <div class="form-group">
    <label>Producent</label>
    <input type="text" class="form-control" id="producent"/>
  </div>
      <div class="form-group">
    <label >Kolor</label>
    <input type="text" class="form-control" id="kolor" />
  </div>
        <div class="form-group">
    <label >Cena początkowa</label>
    <input type="number" class="form-control" id="cena" />
  </div>
   <div class="form-group">
  <label for="sel1">Czas trwania licytacji:</label>
  <select class="form-control" id="kat">
    <option>Dzień</option>
    <option>Tydzień</option>
    <option>Dwa Tygodznie</option>
    <option>Miesiąc</option>
  </select>

</div>

 <div class="form-group">
  <label for="sel1">Kategoria:</label>
  <select class="form-control" id="kat">
    <option>Motoryzacja</option>
    <option>RTViAGD</option>
    <option>Sport</option>
    <option>Odzież</option>
	<option>Umeblowanie</option>
  </select>

</div>
 <div class="form-group">
  <label for="comment">Opis:</label>
  <textarea class="form-control" rows="10" id="comment" name="comment"></textarea>
</div>
  <div class="form-group">
    <label>Zdjęcie przedmiotu</label>
    <input type="file" id="fileToUpload" name="fileToUpload" />
</div>
  <button type="submit" class="btn btn-default" name="submit">Wyslij</button>
</form>
</div>


</body>
</html>