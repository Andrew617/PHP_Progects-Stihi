<?php
include_once __DIR__.'/dbConnect.php';
//include_once __DIR__.'/user.php';

class Model {
    
    private $connect;

    public function getResult(string $sqlCommand, $values)
    {
        if (is_array($values)==true)
        {
            $result = $this -> getResultForValues($sqlCommand, $values);
            while($data = pg_fetch_object($result))
        {
            yield $data;
        }
        pg_free_result($result);
        }
        else 
        {
            error_log("ERROR не верный формат данных");
        } 
    }
    
    private function createConnectPGObj()
    {
        return new DbConnectPG;
    }
    
    private function sqlSendTransformationsToPlaceholders($sqlCommand){
        $pattern = '/:(\w+)/';
        $counter = 0;
        $sqlSendTransform = preg_replace_callback($pattern, function($matches) use (&$counter){
            $counter++;
            return '$'.$counter;
        }, $sqlCommand);
        return $sqlSendTransform;
    }
    
    private function getResultForValues($sqlCommand, $values)
    {
    $this -> connect = $this -> createConnectPGObj()::connectWait();   
    $sqlSendTransform = $this -> sqlSendTransformationsToPlaceholders($sqlCommand);
    $sendName = "prep_" .md5($sqlSendTransform);
    $prepare = pg_prepare($this -> connect, $sendName, $sqlSendTransform);
    $resultExecute = pg_execute($this -> connect, $sendName, $values);
    $this->connect = null;
    return $resultExecute; 
    } 
    
    private function getAll(string $sqlCommand) #получить все записи из БД
    {
    $this -> connect = $this -> createConnectPGObj()::connectWait();  
    return pg_query($this -> connect, $sqlCommand);
    }
    
    function createOrEditEntry($sqlCommand, $userValues)#Создаёт или редактирует записи в БД
    {
       
        return $newUser;
    }


}



