<?php

class Model_user
{ 
    private $modelSQLuser;
    private $model;
    
    public function __construct(object $modelSQLuser, object $model)
    {
        $this -> modelSQLuser = $modelSQLuser;//содержит sql запросы 
        $this -> model = $model;//реализует sql запрос
       
    }
    
    public function requestProcessing($request=null)
    {
        if (empty($request))
        {
            $sqlCommand = $this->modelSQLuser->getAllusersNickAndName();
            $result = $this -> selectFromValues($sqlCommand, array('lastid'=>10));
        }
        else
        {
            switch (key($request)) {
                case 'id': 
                $sqlCommand = $this->modelSQLuser->getSelectUser();
                $result = $this -> selectFromValues($sqlCommand, $request);
                break;
                case 'lastid': 
                $sqlCommand = $this->modelSQLuser->getAllusersNickAndName();
                $result = $this -> selectFromValues($sqlCommand, $request);
                break;
            }   
        }
        return $result;
    }
    private function selectFromValues(string $sqlCommand, array $values) {
        return $this -> model -> getResult($sqlCommand, $values);
    }

    /*private function selectGroupUsers()
    { 
        //$sqlCommandAfterProcessing = $this -> dataMapper -> sqlSendTransformationsToPlaceholders();
        return $this -> model -> getResult($sqlCommandAfterProcessing);
    }*/
    
    private static function createPasswordhash($password)
    {
        $hash = password_hash($password, PASSWORD_BCRYPT); 
        return $hash;
    }
                                                    
    
}
