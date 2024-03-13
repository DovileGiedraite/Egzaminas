<!DOCTYPE html>
<html>
<head>
<title>Knygų rezervacija</title>
<meta charset="utf-8">

<style>
body {
  margin:0;
  background: color #f3ede0;
}  

.pagrindinis {
    background-color: #cbd7d0;
    width:100%;
    height:fit-content;
    margin:auto;
    padding-top:0px;
    padding-bottom: 50px;
}

.mygtukai{
padding-top:20px;

}

.remai {
    border:3px solid lightgray;
    background-color:white;
    padding:40px;
    margin:40px;
    margin-left:10%;
    margin-right:10%;
    border-radius:25px;

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

.lentele {
  width:700px;
  margin:auto;


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



* {
  box-sizing: border-box;
}

/* Style the search field */
form.example input[type=text] {
  padding: 10px;
  font-size: 17px;
  border: 1px solid grey;
  float: left;
  max-width: 600px;
  background: #f1f1f1;
}

/* Style the submit button */
form.example button {
  float: left;
  width: 200px;
  padding: 10px;
  background: #4f6455;
  color: white;
  font-size: 17px;
  border: 1px solid grey;
  border-left: none; /* Prevent double borders */
  cursor: pointer;
}

form.example button:hover {
  background: #b83330;
}

/* Clear floats */
form.example::after {
  content: "";
  clear: both;
  display: table;
}


.pasieska{
padding-left:100px;


}

  </style>

</head>
<body>

<div class="pagrindinis">

<div class="mygtukai">
<ul>
  <li><a href="atsijungti.php">Atsijungti</a></li>
  <!-- <li><a  href="pagrindinis.php">Vartotojų puslapis</a></li> -->
  <li><a href="rezervuota.php">Rezervuotos knygos</a></li>
  <li><a href="megstamos.php">Mėgstamos knygos</a></li>
</ul>
</div>


<div class="pasieska">


        <form class="example" action="paieska.php" method="get">
  <input type="text" placeholder="Search.." name="search">
  <button type="submit">Ieškoti</button>
</form>

</div>  

<h1 class="antraste">KNYGŲ REZERVACIJOS PUSLAPIS</h1>
<div class="remai">
<h2>Knygų sąrašas</h2>
<div class="lentele">



<?php
require "dbduomenys.php";

try {
    $db=new PDO("mysql:host=$serveris;dbname=knygos", $vardas, $slaptazodis);

 $sql="SELECT knygos.ID, pavadinimas, santrauka, ISBN, nuotrauka, pslSk, kategorijos.kategorija 
  FROM knygos JOIN kategorijos ON kategorijos.ID=knygos.kategorijosID;";


    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $rezultatas=$db->query ($sql);
    $objektai=$rezultatas->fetchAll(PDO::FETCH_ASSOC);
    

   echo"<table>";
   echo "<tr>";
   echo "<th> Unikalus Nr. </th>";
   echo "<th> Pavadinimas </th>";
   echo "<th> Santrauka </th>";
   echo "<th> ISBN </th>";
   echo "<th > Nuotraukos</th>";
   echo "<th > Psl. Sk.</th>";
   echo "<th> Kategorija </th>";
   echo "<th> Mėgstamos </th>";
   echo "<th> Rezervuoti</th>";
   echo "</tr>";
foreach($objektai as $eilute) {
    echo "<tr>";
    echo "<td>".$eilute['ID']." </td>";
    echo "<td>".$eilute['pavadinimas']." </td>";
    echo "<td>".$eilute['santrauka']." </td>";
    echo "<td>".$eilute['ISBN']." </td>";
    echo "<td><img src='".$eilute['nuotrauka']."'style='width:50px;'> </td>";
    echo "<td>".$eilute['pslSk']." </td>";


    echo "<td>".$eilute['kategorija']." </td>";

    $megstamaNuoroda="megstamosPrideti.php?id=".$eilute['ID'];
    echo "<td><a href='$megstamaNuoroda'>Mėgstama</a></td>";
    $rezervuotoNuoroda="rezervuotiPrideti.php?id=".$eilute['ID'];
    echo "<td><a href='$rezervuotoNuoroda'>Rezervuoti</a></td>";

    
    echo "</tr>";
}

echo "</table>";

}catch (PDOException $e){
  echo "kalida!!!" .$e->getMessage();
}
?>



</div>
</div> 
<!-- <br><br><a  style="margin-left:20px;" href="./">Atgal</a> <br>  
</div> -->
</body>
</html>