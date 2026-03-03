<?php 
include_once __DIR__.'/modelSQLuser.php';
include_once __DIR__.'/modelSQLstihi.php';

class DataMapper { 
    
    private $sqlSend;

    function __construct($sqlSend){
        $this -> sqlSend = $sqlSend;
    } 
    
    function sqlSendTransformationsToPlaceholders(){
        $sqlSend = $this -> sqlSend;
        $pattern = '/:(\w+)/';
        $counter = 0;
        $sqlSendTransform = preg_replace_callback($pattern, function($matches) use (&$counter){
            $counter++;
            return '$'.$counter;
        }, $sqlSend);
        return $sqlSendTransform;
    }
}

//$a = new DataMapper('INSERT INTO passwords (nick, name, surname, profession, biography, password, email) VALUES (:nick, :name, :surname, :profession, :biography, :password, :email)');
//$b = $a -> sqlSendTransformationsToPlaceholders();