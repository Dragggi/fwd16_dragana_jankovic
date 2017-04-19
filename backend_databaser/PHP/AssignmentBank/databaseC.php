<?php
try {
   
   $conn = new PDO('mysql:host=83.168.227.23; dbname=db1164707_DragJ', 'u1164707_DragJ', 'lo0f)Jm2Id');
   $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
   
   echo $e->getMessage();
   
   die();
   
}
