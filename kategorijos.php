<?php
session_start();
require "dbduomenys.php";


?>

<!DOCTYPE html>
<html>
<head>
<title>Knygų kategorijos</title>
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
    padding: 20px;

}

.remai {
    border:3px solid lightgray;
    background-color:white;
    padding:40px;
    margin:40px;
    margin-left:30%;
    margin-right:30%;
    border-radius: 25px;

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

.lentele {
Width: 600px;
margin:auto;

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
  <li><a  href="administracija.php">Administracijos puslapis</a></li>
  <!-- <li><a href="#news">News</a></li>
  <li><a href="#contact">Contact</a></li>
  <li><a href="#about">About</a></li> -->
</ul>
</div>

<h1 class="antraste">Įkelti kategorijas</h1>
<div class="remai">
<div class="lentele">

<h2>Suveskitę teisingą informaciją</h2>

<form action="<?php echo $_SERVER ['PHP_SELF'];?>" method="post">

Knygų kategorijos: <input type="text" name="kategorija"><br><br> 


  
   
<input type="submit" value="Įvesti"> 
</form>

<?php
// echo "mano redaguojamas ID:" . $_GET['id'];


if($_SERVER ['REQUEST_METHOD']=="POST"){
$kategorija=$_POST['kategorija'];


try {
    $db=new PDO("mysql:host=$serveris;dbname=knygos", $vardas, $slaptazodis);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    

    $sql="INSERT INTO kategorijos( kategorija) VALUES ('$kategorija');";



    $db->exec($sql);
    echo "<br>duomenys  sėkmingai suvesti";
    // echo "<br><br><a href=administracija.php>Administracijos puslapis</a>";
  }catch (PDOException $e){
    echo "kalida:".$e->getMessage();
  }
}

?>
<br><br>  <br>
<div class="lentele">
<?php
require "dbduomenys.php";

try {
    $db=new PDO("mysql:host=$serveris;dbname=knygos", $vardas, $slaptazodis);
    
    $sql="SELECT ID, kategorija FROM kategorijos;";




    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $rezultatas=$db->query ($sql);
    $objektai=$rezultatas->fetchAll(PDO::FETCH_ASSOC);
    
//query - selectai, kai norime atsakymu visa duomenu bazes lentele
//exec - kai norime tiesiog vykdyti
   echo"<table>";
   echo "<tr>";
   echo "<th> Unikalus Nr. </th>";
   echo "<th> Kategorija </th>";
   echo "<th> Trinti </th>";
   echo "<th> Redaguoti</th>";
   echo "</tr>";
foreach($objektai as $eilute) {
    echo "<tr>";
    echo "<td>".$eilute['ID']." </td>";
    echo "<td>".$eilute['kategorija']." </td>";
    
   
    

    $trinimoNuoroda="trintiKategorija.php?id=".$eilute['ID'];
    echo "<td><a href='$trinimoNuoroda'>Trinti</a></td>";
    $redagavimoNuoroda="redaguotiKategorija.php?id=".$eilute['ID'];
    echo "<td><a href='$redagavimoNuoroda'>Redaguoti</a></td>";
    echo "</tr>";
}

echo "</table>";

}catch (PDOException $e){
  echo "kalida!!!" .$e->getMessage();
}
?>
</div>

</div>
</div> 
<!-- <br><a  style="margin-left:20px;" href="./">Atgal</a> <br>   -->
</div>
</body>
</html>