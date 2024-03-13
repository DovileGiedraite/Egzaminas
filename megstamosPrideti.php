<?php

session_start();
require "dbduomenys.php";


if($_SERVER ['REQUEST_METHOD']=="GET"){
    
    $VartID=$_SESSION['vartotojas'];
    $knygID=$_GET['id'];
    
    try {
        $db=new PDO("mysql:host=$serveris;dbname=knygos", $vardas, $slaptazodis);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

       

        $sql = "SELECT * FROM megstami WHERE megstKnygID= $knygID and  megstVartID=$VartID";



        $rezultatas = $db->query($sql);
        $atsakymas = $rezultatas->fetchAll(PDO::FETCH_ASSOC);
        if (count($atsakymas) == 0) {

          

           $sql="INSERT INTO megstami (megstKnygID, megstVartID) VALUES ('$knygID',' $VartID');";


            //  echo $sql;
            $db->exec($sql);
            header("Location:megstamos.php");

        } else {
            header("Location:pagrindinis.php");

        }
        

        
      }catch (PDOException $e){
        echo "kalida:".$e->getMessage();
        header("Location:pagrindinis.php");

      }
    }
    

?>