<?php require_once '/home/andrew/PHP_Progects/stihi/config.php';
include_once __DIR__.'/absractConnectDB.php';

class DbConnectPG extends Dbconnect
{
    private static $host = HOST; 
    private static $dbname=DB_NAME; 
    private static $user=USERADMIN; 
    private static $password=PASSWORD;
   

    private static function connect(){ 
        $connect = pg_connect(
            "host=" .self::$host.' '.
            "dbname=" .self::$dbname.' '.
            "user=" .self::$user.' '.
            "password=" .self::$password, PGSQL_CONNECT_ASYNC);
        while (true){
        if (pg_connect_poll($connect)===  PGSQL_POLLING_OK){
            return $connect;
            break;
            }
        else if(pg_connect_poll($connect)=== PGSQL_POLLING_FAILED){
            error_log('неизвестная ошибка подключения к БД');
            return false;
            break;
            }
        else if($connect === false)
            {
            error_log('ошибка соединения с БД, возврат false вместо resource');
            break;
            }
        }
    
    }

    private static function disConnect($connect){
        pg_close($connect);
    }

    public static function connectWait(){
        $resultConnect = self::connect();
        return $resultConnect;
    }

    public static function connectClose($connect, $result=null){
        self::disConnect($connect, $result);
    }

    public function __destruct()
    {
        pg_close(self::connect());
    }
}
 

