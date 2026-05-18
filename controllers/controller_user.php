<?php

class ControllerUser 
{
    
    private $modelUser;
    
    public function __construct(object $modelUser)
    {
        $this -> modelUser = $modelUser;
    }
    
    
    
    public function getObjectUsers($request=null)
    {
        $data = $this -> getData($request);
        foreach($data as $dat)
        {
            $dat;  
        }
        yield $dat;
    }

    private function getData($request=null)
    {
    return $this -> modelUser -> requestProcessing($request);
    }

}





