<?php 
error_reporting(-1);

                //Abstrakt klass av Aircraft
	abstract class Aircraft {
		
    
                //Konstant som ej går att ändra på och delas av alla instanser   
                //Vid användning av interface: Texaco
                const INFO = "Refueling charter<br><br>";
                static public $stat = "WARNING!!! Boogie 9 oclock, Angels 5<br><br>";
               
                
            
                //protected: enbart dem ärvda klasserna kan ärva den variabel och komma åt den 
                //attribut som tillhör den abstrakta klassen, som ärvs av barnklasserna 
		protected $speed;
                protected $range;
                protected $payload;
                protected $aircraftDesignation;
                
                    
                //Konstruktor för objekten, endast barnklassen som kan instanseras
        public function __construct($speed, $range, $payload, $aircraftDesignation) {
                $this->speed = $speed;
                $this->range = $range;
                $this->payload = $payload;
                $this->aircraftDesignation = $aircraftDesignation;
        
            }
                
    static public function stat() {

        echo self::INFO;
        echo self::$stat;
                    
                }
	}