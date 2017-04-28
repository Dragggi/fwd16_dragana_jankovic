<?php
//include_once("config_local.php");
include_once("config.php");

/*
 * Vi organiserar sidan på sån sätt att vi har all processkod här i toppen av
 * sidan. All information som vi behöver processa hämtas från den nedre delen
 * av sidan där html formuläret finns.
 * Där finns namnen på formulärfälten som vi använder i php koden här upp för 
 * att processas.
*/

/*
 * Session start koden lägger vi till på samtliga sidor som ska vara skyddade
*/
session_start();
if(empty($_SESSION['email']))
{
 header("location:index.php");
}

echo "Welcome ".$_SESSION['name']."<br>";

if(isset($_POST['Submit'])) {    
$aeroplaneName = $_POST['aeroplaneName'];
$aeroplaneTopSpeed=$_POST['aeroplaneTopSpeed']; 
$aeroplaneRange=$_POST['aeroplaneRange']; 
$planeMakerID = $_POST['planeMakerID'];
        
    // checking empty fields
    if(empty($aeroplaneName) || empty($planeMakerID)) {
                
        if(empty($aeroplaneName)) {
            echo "<font color='red'>Name field is empty.</font><br/>";
        }
        
        if(empty($planeMakerID)) {
            echo "<font color='red'>Email field is empty.</font><br/>";
        }
        
        //link to the previous page
        
    } else { 
        // if all the fields are filled (not empty) 
            
        //insert data to database        
        $sql = "INSERT INTO aeroplane(aeroplaneName, aeroplaneTopSpeed, aeroplaneRange, planeMakerID) VALUES(:aeroplaneName, :aeroplaneTopSpeed, :aeroplaneRange, :planeMakerID)";
        $query = $pdo->prepare($sql);
                
        $query->bindparam(':aeroplaneName', $aeroplaneName); 
		$query->bindparam(':aeroplaneTopSpeed', $aeroplaneTopSpeed); 
		$query->bindparam(':aeroplaneRange', $aeroplaneRange); 
        $query->bindparam(':planeMakerID', $planeMakerID);
        $query->execute();
        
        // Alternative to above bindparam and execute
        
        //display success message
        echo "<font color='green'>Data added successfully.";
        echo "<br/><a href='aeroplane.php'>View Result</a>";
    }
}

/*
 * För att inte användaren ska behöva skriva siffror för en fk_categoryId, så vill vi
 * skapa en dropdown så att användare kan välja från namnlista från databasen
 * som ladda i en dropdown.
 * Nedanståend sql fråga är basen för den dropdown
*/
$planeMakerSql = "SELECT * FROM plane_maker"; 
$planeMakerQuery = $pdo->prepare($planeMakerSql); 
$planeMakerQuery->execute(); 
        
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Add New Plane</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
		body {
    background-color: lightblue;
}

td {
    border-bottom: 6px solid red;
    background-color: lightgrey;
    border: 2px solid red;
    border-radius: 5px;
}
        </style>
    </head>
    <body>
        <a href="aeroplane.php"> Home</a>  | <a href="aeroplaneMaker.php">PlaneMaker</a><br/><br/>

    <form action="aeroplaneAdd.php" method="post" name="form1">
        <table width="25%" border="0">
            <tr> 
<!-- Här lägger vi till det nya input -->                
<td>
PlaneName<br><input type='text' name="aeroplaneName" >
<br><br>
TopSpeed: <br><input type='text' name="aeroplaneTopSpeed" > 
<br><br>
Range: <br><input type='number' name="aeroplaneRange" > 
<br><br>
</td>
            </tr>
            
            <tr> 
<td>PlaneMaker</td> 
<td>

<!-- Vi skapar en dropdown som laddas med författare från databasen, så att inte
användare inte lägger till författare som inte existerar-->    
<select name="planeMakerID"> 
<?php

$planeMakerID="";
while($planeMaker = $planeMakerQuery->fetch()) { 
if ($planeMaker['planeMakerID'] == $planeMakerID) { 
//The category is currently associated to the plane, select it by default 
echo "<option value=\"{$planeMaker['planeMakerID']}\" selected>{$planeMaker['planeMakerName']}</option>"; 
} else { 
//The planeMaker is not currently associated to the plane 
echo "<option value=\"{$planeMaker['planeMakerID']}\">{$planeMaker['planeMakerName']}</option>"; 
} 
} 
?> 
</select> 
</td> 
</tr> 
    <tr> 
        <td></td>
            <td><input type="submit" name="Submit" value="Add"></td>
            </tr>
        </table>
    </form>
<!--För att logga ut skickar vi användaren till en sida där sessionen avslutas
med session_destroy-->    
    <a href="logout.php">Logout</a>
    </body>
</html>


