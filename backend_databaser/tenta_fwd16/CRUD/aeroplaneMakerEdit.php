<?php 
// including the database connection file 
include_once("config.php");
// Create protection by confirming a logged in user is in, if not send user to index page
session_start();
            if(empty($_SESSION['email']))
            {
             header("location:index.php");
            }
            echo "Welcome ".$_SESSION['name'];
// retrieve the correct id from planemaker and select the correct planemaker info based on ID
            
$planeMakerID = $_GET['planeMakerID'];


$sql = "SELECT * FROM plane_maker WHERE planeMakerID=:planeMakerID"; 
$query = $pdo->prepare($sql); 
$query->execute(array(':planeMakerID' => $planeMakerID)); 
// loop trough DB info and put each row in to a variable
while($row = $query->fetch()) 
{ 
$planemakerName = $row['planeMakerName'];
$planeMakerID = $row['planeMakerID'];
}
// prepares info retrieval from plane_maker
$planeMakerSql = "SELECT * FROM plane_maker"; 
$planeMakerQuery = $pdo->prepare($planeMakerSql); 
$planeMakerQuery->execute();
?> 
<?php 
// checks for empty fields and sends back error message if one is empty, else use info to edit db-info
// if successful update info in DB
if(isset($_POST['update'])) 
{ 
$planeMakerID = $_POST['planeMakerID']; 
$planeMakerName = $_POST['planeMakerName'];
if(empty($planeMakerName)) { 
echo "<font color='red'>Name field is empty.</font><br/>"; 

} else { 
$sql = "UPDATE plane_maker SET planeMakerName =:planeMakerName WHERE planeMakerID=:planeMakerID";
$query = $pdo->prepare($sql); 
$query->bindparam(':planeMakerID', $planeMakerID);
$query->bindparam(':planeMakerName', $planeMakerName);
$query->execute(); 
header("Location: aeroplaneMaker.php"); 
} 
}  
?> 
<!DOCTYPE html> 

<html> 
<head> 
<meta charset="UTF-8"> 
<title></title> 
</head> 
<body> 
<a href="aeroplaneMaker.php">Home</a> 
<br/><br/> 
//
<form name="form1" method="post" action="aeroplaneMakerEdit.php"> 
        <table  border="0">
<tr> 
<!-- Resultatet av vår sql fråga från rad34 lägger vi en textarea, man kan alltid
blanda html och php som ni ser, genom att flika in php taggar som start och slut-->
<td> 
<br>

<?php echo $planeMakerName;?> <br><input type='text' name="planeMakerName" > 
<br><br>
<input type="submit" name="update" value="update">
<br><br>
</td>
</tr> 
<tr>
<!-- Vi visar inte id för den skämtet vi vill redigera -->    
<input type="hidden" name="planeMakerID" value=<?php echo $_GET['planeMakerID'];?>
</tr> 
</table> 
</form>
<!--För att logga ut skickar vi användaren till en sida där sessionen avslutas
med session_destroy--> 

//

<a href="logout.php">Logout</a>
    </body>
</html>