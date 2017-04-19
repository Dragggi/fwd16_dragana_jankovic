<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
   <head>
       <meta charset=“UTF-8”>
       <title></title>
   </head>
   <body>
       <?php
       include_once('databaseC.php');
       
       
       
   class Bank{
       public $accountName, $accountFname, $accountLname, $accountBalance, $entry;

       public function __construct() {
           $this->entry = "{$this->accountFname}. {$this->accountLname} has: {$this->accountName} account with {$this->accountBalance} balance";
       }
       
   }

   $sql="CALL Account('Sohail')";

   $result = $conn->query($sql);
   if ($result->rowCount()) {
      $result->setFetchMode(PDO::FETCH_CLASS, 'Bank');
      while($row = $result->fetch()) {
          echo $row->entry, '<br>';
      }

   } else {
      echo "0 results";
   }


       
       ?>
   </body>
</html>