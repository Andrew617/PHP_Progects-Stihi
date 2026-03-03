<?php 
include_once __DIR__.'/dbConnect.php';
include_once '/home/andrew/PHP_Progects/stihi/public/securrity.php';
include_once __DIR__.'/modelSQLstihi.php';
include_once __DIR__.'/modelSQLuser.php';
include_once __DIR__.'/dataMapper.php';

class ModelAdmin {

public $values;
public $role; 
public $typ;
public $userId;
public $nick;

function __construct($values=null, $role = null, $typ = null, $userId = null, $nick = null, $sqlCommand = null){
    $this -> values = $values;
    $this -> role = $role;
    $this -> typ = $typ;
    $this -> userId = $userId;
    $this -> nick = $nick;
    $this -> sqlModelUserObject = new ModelSQLuser;
    $this -> modelSQLstihiObject =  new ModelSQLstihi;
    $this -> connectObj = new DbConnect;
    //DbConnect::connectWait();
    }

private function sendParamRequest($sqlCommand){
    $values = $this -> values;
    $dataMapperObj = new DataMapper($sqlCommand);
    $sqlSendTransform = $dataMapperObj -> sqlSendTransformationsToPlaceholders();
    $connect = DbConnect::connectWait();
    $sendName = "prep_" .md5($sqlSendTransform);
    $pgPrepare = pg_send_prepare($connect, $sendName, $sqlSendTransform);
    if ($pgPrepare === false)
    {
    error_log("Ошибка $pgPrepare: " .pg_last_error($connect));
    return false;
    }
    while(pg_connection_busy($connect))
    {
        usleep(50);    
    }        
    $resultPrepare = pg_get_result($connect);
    error_log("Подготовка: " . ($resultPrepare ? "OK" : "FAIL"));
    var_dump($resultPrepare);
    if($resultPrepare === false)
    {
        error_log("Ошибка $resultPrepare: " .pg_last_error($connect));
        return false;   
    }
    while(pg_connection_busy($connect))
    {
        usleep(50);
    }
    error_log("Connection status: " . (pg_connection_status($connect) === PGSQL_CONNECTION_OK ? "OK" : "FAILED"));
    $sendExecute = pg_send_execute($connect, $sendName, $values);
    if($sendExecute === false)
    {
        error_log("Ошибка  $sendExecute: " .pg_last_error($connect));
        return false; 
    } 
    while(pg_connection_busy($connect))
    {
        usleep(50);
    }
    $resultExecute = pg_get_result($connect);
    error_log("Выполнение: " . ($resultExecute ? "OK" : "FAIL"));
    if($resultExecute === false)
    {
        error_log("Ошибка $resultExecute: " .pg_last_error($connect));
        return false;   
    }
    error_log("Результат (ресурс): " . (is_resource($resultExecute) ? "OK" : "FAIL"));
    if (!is_resource($resultExecute)) {
    error_log("pg_get_result вернул не ресурс!");
    return false;
    }
    while(pg_connection_busy($connect))
    {
        usleep(50);
    }
    $assoc = pg_fetch_assoc($resultExecute);
    return $assoc; 
}

public function test(){
    $sqlCommand = $this -> sqlModelUserObject -> getSelectUser();
    return $this -> sendParamRequest($sqlCommand);
}
}

/*public function entryNewUser()
    {
        $userValues = $this -> values;
        $sqlObject = $this -> sqlObject;
        $passwordHash = self::createPasswordhash($userValues['password']); 
        $userValues['password'] = $passwordHash;
        $sqlCommand = $sqlObject -> createNewUser();
        parent::createOrEditEntry($sqlCommand, $userValues);
    }*/
    
    $values = array("id" => 1);
    $a = new ModelAdmin($values);
    $b = $a->test();
    var_dump($b);