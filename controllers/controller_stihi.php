<?php
class ControllerStihi {

     public function __construct($values = null)
     {
        $this -> modelStihi = $ModelStihi;
        $this -> values = $values;
     }
    
    
    public function getViwPoem($values, $limit=null)
     {
          $modelStihi = $this -> modelStihi;
          return $modelStihi -> getViewPoem($limit);
      }
    
   
   }
    
   
