<?php
include_once '/home/andrew/PHP_Progects/stihi/model/model_user.php';

class ControllerUser 
{

    public function __construct($userValues = NULL)
    {
            $this -> modelUser = new Model_user($userValues);
            $this -> values = $userValues;   
    }
    
    public function createNewUser()
    {  
        $modelUser = $this -> modelUser;
        $newUser = $modelUser -> entryNewUser();
        return $newUser;
    }
    
    public function getView()
    {
        $modelUser = $this -> modelUser;
        $userResult = $modelUser -> requestProcessing();    
        return new ArrayObject($userResult, ArrayObject::ARRAY_AS_PROPS);      
    }       
    
    }

