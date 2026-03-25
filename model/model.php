<?php
require_once __DIR__.'/dbConnectDB_with_PDO.php';
class Model {
    
    private $values = null;
    
    public function __construct($values=null){
        $this -> values = $values;
    }
    
    function getResult($sqlCommand)#возвращает результат параметризованного запроса
    { 
        $values = $this -> values;
        $connectObj = new DbConnectWithPDO;
        $connect = $connectObj -> connectWithDB();
        $result = $connect -> prepare($sqlCommand);
        $result -> execute($values);
        return $myData = $result -> fetchAll();
    }

   function getAll($sqlCommand) #получить все записи из БД
   {
        $connectObj = new DbConnectWithPDO;
        $connect = $connectObj -> connectWithDB();
        $result = $connect -> prepare($sqlCommand);
        $result -> execute();
        $allData = $result -> fetchAll(PDO::FETCH_CLASS);
        return $allData;
        exit;
    }
    
    function createOrEditEntry($sqlCommand, $userValues)#Создаёт или редактирует записи в БД
    {
        $connectObj = new DbConnectWithPDO;
        $connect = $connectObj -> connectWithDB();
        $result = $connect -> prepare($sqlCommand);
        $result -> execute($userValues);
        $newUser = $result -> fetchAll();
        return $newUser;
    }

}



