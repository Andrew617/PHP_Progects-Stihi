<?php
require_once '/home/andrew/PHP_Progects/stihi/config.php';
class Model {
    
    private $host= HOST; 
    private $dbname=DB_NAME; 
    private $user=USER; 
    private $password=PASSWORD;
    
    
    
    private function create_new_connect() 
    { 
    try { $dsn = "pgsql:host = {$this -> host}; dbname = {$this -> dbname}";
    $options = [PDO::ATTR_ERRMODE    => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,];
    $dbconn = new PDO ($dsn, $this -> user, $this -> password, $options);
    return $dbconn;
    }
    catch (PDOException $e){
        throw new Exception('ERROR');
        echo $e -> getMessage();
    }
    }
   
    
    function getResult($sqlCommand, $values)#возвращает результат параметризованного запроса
    { 
    $connect = $this -> create_new_connect();
    $result = $connect -> prepare($sqlCommand);
    $result -> execute($values);
    $myData = $result -> fetchAll();
    return $myData;
    $connect = null;   
    $result = null;
    exit;
    }

   
    function GetAll($sqlCommand) #получить все записи из БД
   {
    $connect = $this -> create_new_connect();
    $result = $connect -> prepare($sqlCommand);
    $result -> execute();
    $usersNick = $result -> fetchAll(PDO::FETCH_COLUMN);
    return $usersNick;
    $connect = null;
    $result = null;
    exit;
    }
    
    function createOrEditEntry($sqlCommand, $id, $iv)#Создаёт или редактирует записи в БД
    {
        $connect = $this -> create_new_connect();
        $newScript = $connect -> prepare($sqlCommand);
        $newScript -> bindValue(':id', $id);
        $newScript -> bindValue(':iv', $iv);
        $result = $newScript -> execute();
        $connect = null;
        $newScript = null;
    }

}



