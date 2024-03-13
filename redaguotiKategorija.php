<?php
session_start();
require "dbduomenys.php";


?>
<!DOCTYPE html>
<html>
<head>
<title>Redaguoti kategorija</title>
<meta charset="utf-8">

<style>
body {
  margin:0;
  background: color #f3ede0;
}  

.pagrindinis {
    background-color: #cbd7d0;
    width:100%;
    height:100%;
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

<h1 class="antraste">Kategorijų koregavimas</h1>
<div class="remai">
<div class="lentele">

<h2>Suveskite teisingus duomenis</h2><br>

<form action="<?php echo $_SERVER ['PHP_SELF'];?>" method="post">
<input type="hidden" 
  value="<?php
          if($_SERVER ['REQUEST_METHOD']=="GET"){
            echo $_GET['id'];
          }else{
          echo "-";
          }
  ?>" name="id">
  


   Prekės kategorijos pavadinimas: <input type="text" name="pavadinimas"><br><br>  


<input type="submit" value="Koreguoti"> 
</form>

<?php
// echo "mano redaguojamas ID:" . $_GET['id'];


if($_SERVER ['REQUEST_METHOD']=="POST"){

$pavadinimas=$_POST['pavadinimas'];

$id=$_POST['id'];


    try {
    $db=new PDO("mysql:host=$serveris;dbname=knygos", $vardas, $slaptazodis);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $sql="UPDATE kategorijos SET kategorija='$pavadinimas' WHERE ID='$id';";


    $db->exec($sql);

    echo "<br>duomenys  sėkmingai suvesti";


    echo "<br><br><a href=kategorijos.php>Grįžti į kategorijų psl.</a>";
  }catch (PDOException $e){
    echo "kalida:".$e->getMessage();
  }
}
?>



</div>
</div> 
<!-- <br><a  style="margin-left:20px;" href="./">Atgal</a> <br>   -->
</div>
</body>
</html>