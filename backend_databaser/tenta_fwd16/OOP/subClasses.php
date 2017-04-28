<?php
require_once ("aircraft.php");
require_once ("interface.php");
error_reporting(-1);

//skapa klass som implementerar interface                
class Bomber extends Aircraft implements i_Texaco{
    //Via Trait
    use tr_Texaco;
    
    public $bombs;
    
    public function __construct($bombs, $speed, $range, $payload, $aircraftDesignation) {
        $this->bombs = $bombs;
        parent::__construct($speed, $range, $payload, $aircraftDesignation);
    }
}
                                 
class Interceptor extends Aircraft implements i_Texaco {
    
    use tr_Texaco;
    
    public $missiles;
    
    public function __construct($missiles, $speed, $range, $payload, $aircraftDesignation) {
        
        $this->missiles = $missiles;
        // :: = klasser kommunicerar med varandra
        parent::__construct($speed, $range, $payload, $aircraftDesignation);  
} 
}