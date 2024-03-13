<?php
session_start();
require "dbduomenys.php";


?>

<!DOCTYPE html>
<html>
<head>
<title>Knygos</title>
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
  </style>

</head>
<body>

<div class="pagrindinis">

<div class="mygtukai">
<ul>
  <li><a  href="administracija.php">Aministracijos puslapis</a></li>
  <!-- <li><a href="#news">News</a></li>
  <li><a href="#contact">Contact</a></li>
  <li><a href="#about">About</a></li> -->
</ul>
</div>

<h1 class="antraste">Puslapis skirtas naujų knygų registracijai</h1>
<div class="remai">
<div class="lentele">

<h2>Suveskitę teisingą informaciją</h2>

<form action="<?php echo $_SERVER ['PHP_SELF'];?>" method="post" enctype='multipart/form-data'>

Knygos pavadinimas: <input type="text" name="pavadinimas"><br><br> 
<label for="santrauka">Knygos santrauka:</label><br>
        <textarea id="santrauka" name="santrauka" rows="5" cols="30"></textarea><br><br> 

        Knygos ISBN: <input type="text" name="isbn"><br><br> 

        Knygos nuotrauka: <input type='file' name='failas'><br><br> 
  




        Puslapių skaičius: <input type="text" name="skaicius"><br><br>




<label for="Kategorija"><b>Knygos kategorija:</b></label><br><br>
  <select id="kategorija" name="kategorija">
  <option selected="selected" value="">- - -</option>

<?php



try {
  $db=new PDO("mysql:host=$serveris;dbname=knygos", $vardas, $slaptazodis);
 
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
  $sql="SELECT * FROM kategorijos;";




  // echo $sql;
  
    $rezultatas=$db->query ($sql);
    $objektai=$rezultatas->fetchAll(PDO::FETCH_ASSOC);



    // echo "<pre>";
    // var_dump($objektai);
    // echo "</pre>";

    foreach($objektai as $elementas){
      $kategorija=$elementas['kategorija'];
      $kategorijosID=$elementas['ID'];
      

      echo "<option value='$kategorijosID'>$kategorija</option>";

    }

  
}catch (PDOException $e){
  echo "klaida:".$e->getMessage();
}

?>  
   </select><br><br>
  


<input type="submit" value="Pateikti"> 
</form>

<?php
// echo "mano redaguojamas ID:" . $_GET['id'];


if($_SERVER ['REQUEST_METHOD']=="POST"){


    $pavadinimas=$_POST['pavadinimas'];
    $santrauka=$_POST['santrauka'];
    $ISBN=$_POST['isbn'];
    $skaicius=$_POST['skaicius'];

$KnygKategorija=$_POST['kategorija'];





$failas=$_FILES['failas'];
$failoVieta=$failas['tmp_name'];

$aplankalas="images/";
$failoVieta=$aplankalas .basename($_FILES['failas']['name']);
$pirmineVieta=$_FILES['failas']['tmp_name'];
move_uploaded_file($pirmineVieta, $failoVieta);


try {
    $db=new PDO("mysql:host=$serveris;dbname=knygos", $vardas, $slaptazodis);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

$sql="INSERT INTO knygos ( pavadinimas, santrauka, ISBN, nuotrauka, pslSk, kategorijosID)
VALUES ('$pavadinimas','$santrauka',' $ISBN','$failoVieta','$skaicius','$KnygKategorija');";

    $db->exec($sql);
    // echo "$sql";
    echo "duomenys sėkmingai pateikti";
    echo "<br><br><a href=administracija.php>Administracijos puslapis</a>";
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