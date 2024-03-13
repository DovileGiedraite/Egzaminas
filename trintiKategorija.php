<?php

require "dbduomenys.php";

if($_SERVER ['REQUEST_METHOD']=="GET"){
$id=$_GET['id'];

  try {
    $db=new PDO("mysql:host=$serveris;dbname=knygos", $vardas, $slaptazodis); 
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql="DELETE FROM kategorijos WHERE ID=$id";
    $db->exec($sql);
    
  header("Location:kategorijos.php");
  }catch (PDOException $e){
    echo "kalida:".$e->getMessage();
  }
}
?>
</body>
</html>