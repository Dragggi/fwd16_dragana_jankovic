<!DOCTYPE html>


<html>
    <head>
        <meta charset="UTF-8">
        <title>Aircraft</title>
    </head>
    <body>
        <?php 
        
            require_once ("subClasses.php");
            
            //anropa statiska metoden som är i abstrakta klassen (innan vi använder konstruktorn)
            /*För att komma åt konstanter, statiska egenskaper och metoder i en instans
             * så använder man sig av instansnamnet:: efter följd av konstanten eller den statiska egenskapen eller metoden
            */
            
            //Anropar den statiska metoden i den abstrakta klassen
            Aircraft::stat();
            
            
            
            //Nytt objekt av klassen Bomber
        
            $BomberA1 = new Bomber(6, 1200, 200, 500, "A53");
            
            //Meddelande som uppkommer vid anvädning av interface, trait
           
            print_r($BomberA1->Texaco()."<br>");
            echo "<pre>".print_r($BomberA1, TRUE)."</pre>";
           
            //Nytt objekt av klassen Interceptor
            
            $InterceptorD3 = new Interceptor(200, 1700, 500, 900, "Viggen");
            
            
            print_r($InterceptorD3->Texaco()."<br>");
            echo "<pre>".print_r($InterceptorD3, TRUE)."</pre>";
            
            
            
         ?>
    </body>
</html>