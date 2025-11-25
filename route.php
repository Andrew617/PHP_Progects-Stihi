<?php
    class Rout {

        public $requestMetod;
        
        
        public function __construct($requestMetod)
        {
            $this -> requestMetod = $requestMetod;
        }
    
        public function rout($get)
        {
        $requestMetod = $this -> requestMetod;
        switch($requestMetod)
        { case 'GET':
        if (array_key_exists('id', $get))
        {
        require_once '/home/andrew/PHP_Progects/stihi/views/user_view.php';  
        }
        else if(empty($get)){
        require_once '/home/andrew/PHP_Progects/stihi/views/Main_view.php';
       }
       case 'POST':
        require_once '/home/andrew/PHP_Progects/stihi/public/securrity.php'; 
    } 
    }
        }
