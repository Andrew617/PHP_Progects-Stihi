<?php
require_once '/home/andrew/PHP_Progects/stihi/model/model_stihi.php';

class ControllerStihi {

   
     public function __construct($values = null)
     {
        $this -> modelStihi = new ModelStihi($values);
        $this -> values = $values;
     }
    
    
    public function getViwPoem($limit=null)
     {
          $modelStihi = $this -> modelStihi;
          return $modelStihi -> getViewPoem($limit);
      }
    }
    
   
