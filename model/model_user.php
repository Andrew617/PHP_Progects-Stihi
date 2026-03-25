<?php
require_once __DIR__.'/model.php';
require_once __DIR__.'/modelSQLuser.php';

class Model_user extends Model

{ 
    private $sqlObject;
    private $values = NULL;
    
    public function __construct($values = NULL)
    {
    $this -> sqlObject = new ModelSQLuser;
    parent:: __construct($values);
    $this -> values = $values;
    }
    
    private function selectFromValues($sqlCommand) {
        return parent::getResult($sqlCommand);
    }

    private function selectGroupUsers($sqlCommand)
    {
        return parent::getAll($sqlCommand);
    }
    
    private static function createPasswordhash($password)
    {
        $hash = password_hash($password, PASSWORD_BCRYPT); 
        return $hash;
    }
    
    /*function updateUser($pdoSet, $id)
        {   
            $sqlCommand = "UPDATE passwords SET"." ".$pdoSet." "."WHERE id = :id";
            Model::createOrEditEntry($sqlCommand, $id);
        }*/                                                        

    public function requestProcessing()
    {
        $request = $this -> values;
        $sqlObject = $this -> sqlObject;
        if (is_null($request))
        {
            $sqlCommand = $sqlObject -> gelAllusersNickAndName();
            $result = $this -> selectGroupUsers($sqlCommand);
        }
        else if(is_array($request))
        {
        $keys = array_keys($request);
            if ($keys['0'] == 'id' && count($request) == 1)
                {
                $sqlCommand = $sqlObject -> getSelectUser();
                $result = $this -> selectFromValues($sqlCommand);
                }
            else if ($keys['0'] == 'nick')
            {
            $sqlCommand = $sqlObject -> getSelectPassword();
            $result = $this -> selectFromValues($sqlCommand);
            } 
        }
    return $result;
    }
}

/*$values = array("id" => 25);
$testA = new Model_user($values);
var_dump($testA -> requestProcessing());*/
