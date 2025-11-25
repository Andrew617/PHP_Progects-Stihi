<?php
require_once '/home/andrew/PHP_Progects/stihi/config.php';
class Model {
    
    private $host= HOST; 
    private $dbname=DB_NAME; 
    private $user=USER; 
    private $password=PASSWORD;
    public $values = NULL;
    
    function __construct($values = NULL)
    {
        $this -> values = $values; 
        try 
        { 
        $dsn = "pgsql:host = {$this -> host}; dbname = {$this -> dbname}";
        $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,];
        $this -> dbconn = new PDO ($dsn, $this -> user, $this -> password, $options);
        }
        catch (PDOException $e)
        {
        throw new Exception('ERROR');
       
        }
    }
    
    
    function getResult($sqlCommand)#возвращает результат параметризованного запроса
    { 
        $values = $this -> values;
        $connect = $this -> dbconn;
        $result = $connect -> prepare($sqlCommand);
        $result -> execute($values);
        return $myData = $result -> fetchAll();
    }

   function getAll($sqlCommand) #получить все записи из БД
   {
        $connect = $this -> dbconn;
        $result = $connect -> prepare($sqlCommand);
        $result -> execute();
        $allData = $result -> fetchAll(PDO::FETCH_CLASS);
        return $allData;
        exit;
    }
    
    function createOrEditEntry($sqlCommand, $userValues)#Создаёт или редактирует записи в БД
    {
        $connect = $this -> dbconn;
        $result = $connect -> prepare($sqlCommand);
        $result -> execute($userValues);
        $newUser = $result -> fetchAll();
        return $newUser;
    }

}



