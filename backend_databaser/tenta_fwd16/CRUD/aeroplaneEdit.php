<?php 
// including the database connection file 
include_once("config.php");
//include_once("config_local.php");

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

/*
 * Vi vill ta emot resultatet från föregående sida och med $_GET ta emot id för
 * den raden vi ska redigera
*/
$aeroplaneID = $_GET['aeroplaneID'];

/*
 * vi använder värdet på id från föregående sida som vi fick från get och 
 * skriver en sql fråga där vi använder :id för vara basis för en where fråga.
 * Vi vill alltså bara presentera ett enskild filmtitlet baserat på den films id vi
 * sprarade från raden från förra sidan.
 */
$sql = "SELECT * FROM aeroplane WHERE aeroplaneID=:aeroplaneID"; 
$query = $pdo->prepare($sql); 
$query->execute(array(':aeroplaneID' => $aeroplaneID)); 
/*
 * Resultatet av nedanstående kod kommer vi fylla ut i en html forumlär längre
 * ner på sidan. 
*/
while($row = $query->fetch()) 
{ 
$aeroplaneName = $row['aeroplaneName']; 
$aeroplaneTopSpeed = $row['aeroplaneTopSpeed']; 
$aeroplaneRange = $row['aeroplaneRange']; 
$planeMakerID = $row['planeMakerID']; 
}

/*
 * På redigerings sidan så kommer vi se en textruta för en enskild filmtitlet.
 * Vi vill däremot inte att användaren ska behöva skriva en fk_categoryId för
 * skämtet. Förutom att möjligheten till misstförstånd blir större att hålla 
 * koll pa en siffra så försämrar det avsevärt användarupplevelsen.
 * Vi skapar en seperat fråga som kommer vara basis för en dropdown senare i 
 * html formuläret
*/
$planeMakerSql = "SELECT * FROM plane_maker"; 
$planeMakerQuery = $pdo->prepare($planeMakerSql); 
$planeMakerQuery->execute(); 


?> 
<?php 

/*
 * vi kontrollerar om vi har tryckt på uppdatera knappen som har namnet update
 * i formuläret, i så fall så lagrar vi id och fälten filmtitle och fk_categoryId i 
 * respektive variabel, som ska finnas i vår db tabell.
*/
if(isset($_POST['update'])) 
{ 
$aeroplaneID = $_POST['aeroplaneID']; 

$aeroplaneName=$_POST['aeroplaneName']; 
$aeroplaneTopSpeed=$_POST['aeroplaneTopSpeed']; 
$aeroplaneRange=$_POST['aeroplaneRange']; 
$planeMakerID=$_POST['planeMakerID']; 


// checking empty fields

if(empty($aeroplaneName) || empty($planeMakerID)) { 

if(empty($aeroplaneName)) { 
echo "<font color='red'>Name field is empty.</font><br/>"; 
} 

if(empty($planeMakerName)) { 
echo "<font color='red'>PlaneMakerName field is empty.</font><br/>"; 
} 


} else { 
/*

*/

$sql = "UPDATE aeroplane SET aeroplaneName=:aeroplaneName, aeroplaneTopSpeed=:aeroplaneTopSpeed, aeroplaneRange=:aeroplaneRange, planeMakerID=:planeMakerID WHERE aeroplaneID=:aeroplaneID";

/*
 * vi använder pdo objektets prepare metod som tar $sql som argument och sparar
 * resultaet i variabeln $query
*/
$query = $pdo->prepare($sql); 
/*Sedan binder vi det som finns i platshållaren till variabeln*/
$query->bindparam(':aeroplaneID', $aeroplaneID); 
$query->bindparam(':aeroplaneName', $aeroplaneName); 
$query->bindparam(':aeroplaneTopSpeed', $aeroplaneTopSpeed); 
$query->bindparam(':aeroplaneRange', $aeroplaneRange); 
$query->bindparam(':planeMakerID', $planeMakerID);
//vi använder det som nu finns i $query för att köra sql frågan 
$query->execute(); 

// Alternative to above bindparam and execute 
// $query->execute(array(':id' => $id, ':movieName' => $movieName)); 

//header används för att skicka tillbaka efter proccesn är klart till en sida
header("Location: aeroplane.php"); 
} 
}  
?> 
<!DOCTYPE html> 
<!-- 
To change this license header, choose License Headers in Project Properties. 
To change this template file, choose Tools | Templates 
and open the template in the editor. 
--> 
<html> 
<head> 
  <title>Edit film</title> 

<meta charset="UTF-8"> 
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
    <a href="aeroplane.php">Home</a>  | <a href="aeroplaneMaker.php">Category</a>
<br/><br/>

<form name="form1" method="post" action="aeroplaneEdit.php"> 
        <table  border="0">
<tr> 
<!-- Resultatet av vår sql fråga från rad34 lägger vi en textarea, man kan alltid
blanda html och php som ni ser, genom att flika in php taggar som start och slut-->
<td> 
PlaneName: <?php echo $aeroplaneName;?> <br><input type='text' name="aeroplaneName" > 
<br><br>
TopSpeed: <?php echo $aeroplaneTopSpeed;?> <br><input type='text' name="aeroplaneTopSpeed" > 
<br><br>
PlaneRange:  <?php echo $aeroplaneRange;?>  <br><input type='number' name="aeroplaneRange" > 
</td>
</tr> 
<tr> 
<td>PlaneMaker</td> 
<td>
<!-- För att användare inte ska behöva stoppa in siffror för en fk_categoryId så skapar
vi en dropdown, där resultatet av sql frågan från rad 47 $directorQuery stoppar in
i $author-->    
<select name="planeMakerID"> 
<?php 
while($planeMaker = $planeMakerQuery->fetch()) { 
if ($planeMaker['planeMakerID'] == $planeMakerID) { 
/*
 * Vi använder id som vi har för att, som defualt visa den category som var
 * kopplat till ett viss skämt vald från föregående sida.
*/ 
echo "<option value=\"{$planeMaker['planeMakerID']}\" selected>{$planeMaker['planeMakerName']}</option>"; 
} else { 
/*
 * Skulle vi däremot vilj ändra category till nåt annat det som vi fick från
 * förra sidan, så väljer vi det nu och också fångar upp id:et för den
 * category
*/ 
echo "<option value=\"{$planeMaker['planeMakerID']}\">{$planeMaker['planeMakerName']}</option>"; 
} 
} 
?> 
</select> 
</td> 
</tr> 

<tr>
<!-- Vi visar inte id för den skämtet vi vill redigera -->    

<td><input type="submit" name="update" value="Update"></td> 

</table> 
</form>
<!--För att logga ut skickar vi användaren till en sida där sessionen avslutas
med session_destroy--> 
<a href="logout.php">Logout</a>
    </body>
</html>
