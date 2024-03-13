<?php
session_start();
require "dbduomenys.php";
?>

<!DOCTYPE html>
<html>
<head>
<title>Rezzervuota</title>
<meta charset="utf-8">

<style>
body {
  margin:0;
  background: color #f3ede0;
}  

.pagrindinis {
    background-color: #cbd7d0;
    width:90%;
    height:fit-content;
    margin:auto;
    padding-top:0px;
    padding-bottom: 50px;
}

.mygtukai{


}

.remai {
    border:3px solid lightgray;
    background-color:white;
    padding:40px;
    margin:40px;

}

.antraste {
    text-align: center;
  text-transform: uppercase;
  color: #4f6455;
}

h2 {
    text-align: center;
    color: #b83330;
}


/* navigacija */

ul {
  list-style-type: none;
  margin:0;
  padding-right:3%;
  overflow: hidden;
  background-color: #cbd7d0;

}

li {
  float: right;
  margin:2px;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  background-color: #4f6455;
}

li a:hover {
  background-color: #b83330;
}

a {
    color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  background-color: #4f6455;

}


table, th, td {
    width:fit-content;
    height: 60px;
  border: 1px solid black;
  border-collapse: collapse;
  padding: 5px;
  text-align: center;
}
  </style>

</head>
<body>

<div class="pagrindinis">

<div class="mygtukai">
<ul>
  <li><a  href="pagrindinis.php">Pagrindinis</a></li>
  <li><a href="atsijungti.php">Atsijungti</a></li>
  <!-- <li><a href="#contact">Contact</a></li>
  <li><a href="#about">About</a></li> -->
</ul>
</div>

<h1 class="antraste">Rezervuotų knygų sąrašas</h1>
<div class="remai">
<!-- <h2>Antraštė</h2> -->
<div class="lentele">


<?php


$VartorojoID=$_SESSION['vartotojas'];

try {
    $db=new PDO("mysql:host=$serveris;dbname=knygos", $vardas, $slaptazodis);


$sql="SELECT knygos.ID, pavadinimas, santrauka, ISBN, pslSk FROM knygos
JOIN uzsakymai ON knygos.ID=uzsakymai.knygosID

WHERE uzsakymai.vartotojoID=$VartorojoID;";



    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $rezultatas=$db->query ($sql);
    $objektai=$rezultatas->fetchAll(PDO::FETCH_ASSOC);
    
//query - selectai, kai norime atsakymu visa duomenu bazes lentele
//exec - kai norime tiesiog vykdyti
   echo"<table>";
   echo "<tr>";
   echo "<th> Unikalus Nr. </th>";
   echo "<th> Pavadinimas </th>";
   echo "<th >Santrauka</th>";
   echo "<th >ISBN</th>";
   echo "<th >Psl. Sk.</th>";
   echo "</tr>";

   

  foreach($objektai as  $eilute) {

  echo "<tr>";
 
  echo "<td>".$eilute['ID']." </td>";
 echo "<td>".$eilute['pavadinimas']." </td>";

    echo "<td>".$eilute['santrauka']." </td>";
    echo "<td>".$eilute['ISBN']." </td>";
    echo "<td>".$eilute['pslSk']." </td>";
   
}

echo "</table>";

}catch (PDOException $e){
  echo "kalida!!!" .$e->getMessage();
}
?>

</div>
</div> 
<!-- <br><a  style="margin-left:20px;" href="./">Atgal</a> <br>  
</div> -->
</body>
</html>