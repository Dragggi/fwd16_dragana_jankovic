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
 * Vi vill ta emot resultatet från föregående sida och med $_GET ta emot id för
 * den raden vi ska redigera
*/
$idsong = $_GET['idsong'];

/*
 * vi använder värdet på id från föregående sida som vi fick från get och 
 * skriver en sql fråga där vi använder :id för vara basis för en where fråga.
 * Vi vill alltså bara presentera ett enskild filmtitlet baserat på den film id vi
 * sprarade från raden från förra sidan.
 */
$sql = "SELECT * FROM song WHERE idsong=:idsong"; 
$query = $pdo->prepare($sql); 
$query->execute(array(':idsong' => $idsong)); 
/*
 * Resultatet av nedanstående kod kommer vi fylla ut i en html forumlär längre
 * ner på sidan. 
*/
while($row = $query->fetch()) 
{ 
$title = $row['title']; 
$fl_idartist = $row['fl_idartist']; 
}

/*
 * På redigerings sidan så kommer vi se en textruta för en enskild filmtitlet.
 * Vi vill däremot inte att användaren ska behöva skriva en fl_iddirector för
 * skämtet. Förutom att möjligheten till misstförstånd blir större att hålla 
 * koll pa en siffra så försämrar det avsevärt användarupplevelsen.
 * Vi skapar en seperat fråga som kommer vara basis för en dropdown senare i 
 * html formuläret
*/
$artistSql = "SELECT * FROM artist"; 
$artistQuery = $pdo->prepare($artistSql); 
$artistQuery->execute();


?> 
<?php 

/*
 * vi kontrollerar om vi har tryckt på uppdatera knappen som har namnet update
 * i formuläret, i så fall så lagrar vi id och fälten filmtitle och fl_iddirector i 
 * respektive variabel, som ska finnas i vår db tabell.
*/
if(isset($_POST['update'])) 
{ 
$idsong = $_POST['idsong']; 

$title=$_POST['title']; 
$fl_idartist=$_POST['fl_idartist']; 


// checking empty fields

if(empty($title) || empty($fl_idartist)) { 

if(empty($title)) { 
echo "<font color='red'>Name field is empty.</font><br/>"; 
} 

if(empty($fl_idartist)) { 
echo "<font color='red'>Artist field is empty.</font><br/>"; 
} 


} else { 
/*
 * vi använder sql syntaxen för uppdateringar och skickar med id för raden.
 * OBS att man i PDO använder platshållare (title=:title) där :title är
 * namnet på platshållaren för att para ihop det som finns i  formuläret till
 *  databasen. Detta läggs till i variablen $sql
*/

$sql = "UPDATE song SET title=:title, fl_idartist=:fl_idartist WHERE idsong=:idsong";

/*
 * vi använder pdo objektets prepare metod som tar $sql som argument och sparar
 * resultaet i variabeln $query
*/
$query = $pdo->prepare($sql); 
/*Sedan binder vi det som finns i platshållaren till variabeln*/
$query->bindparam(':idsong', $idsong); 
$query->bindparam(':title', $title); 
$query->bindparam(':fl_idartist', $fl_idartist);
//vi använder det som nu finns i $query för att köra sql frågan 
$query->execute(); 

// Alternative to above bindparam and execute 
// $query->execute(array(':id' => $id, ':title' => $title)); 

//header används för att skicka tillbaka efter proccesn är klart till en sida
header("Location: index.php"); 
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
<meta charset="UTF-8"> 
<title></title> 
</head> 
<body> 
<a href="index.php">Home</a> 
<br/><br/> 

<form name="form1" method="post" action="edit.php"> 
<table border="0"> 
<tr> 
<td>Song</td> 
<!-- Resultatet av vår sql fråga från rad34 lägger vi en textarea, man kan alltid
blanda html och php som ni ser, genom att flika in php taggar som start och slut-->
<td><textarea name="title" rows="6" cols="40" ><?php echo $title;?></textarea></td>
</tr> 
<tr> 
<td>Artist</td> 
<td>
<!-- För att användare inte ska behöva stoppa in siffror för en fl_iddirector så skapar
vi en dropdown, där resultatet av sql frågan från rad 47 $directorQuery stoppar in
i $author-->    
<select name="fl_idartist"> 
<?php 
while($artist = $artistQuery->fetch()) { 
if ($artist['idartist'] == $fl_idartist) { 
/*
 * Vi använder id som vi har för att, som defualt visa den director som var
 * kopplat till ett viss skämt vald från föregående sida.
*/ 
echo "<option value=\"{$artist['idartist']}\" selected>{$artist['name']}</option>"; 
} else { 
/*
 * Skulle vi däremot vilj ändra director till nåt annat det som vi fick från
 * förra sidan, så väljer vi det nu och också fångar upp id:et för den
 * director
*/ 
echo "<option value=\"{$artist['idartist']}\">{$artist['name']}</option>"; 
} 
} 
?> 
</select> 
</td> 
</tr> 

<tr>
<!-- Vi visar inte id för den skämtet vi vill redigera -->    
<td><input type="hidden" name="idsong" value=<?php echo $_GET['idsong'];?></td> 
<td><input type="submit" name="update" value="Update"></td> 
</tr> 
</table> 
</form>
    </body>
</html>
