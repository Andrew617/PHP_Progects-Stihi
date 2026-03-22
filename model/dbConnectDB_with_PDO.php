<?php
require_once '/home/andrew/PHP_Progects/stihi/config.php';
require_once __DIR__.'/dbConnect.php';

class DbConnectWithPDO extends Dbconnect {
    
    private static $host= HOST;
    private static $dbname=DB_NAME; 
    private static $user=USER; 
    private static $password=PASSWORDFORUSER;

    
    final private static function connect()
    { 
        try 
        { 
        $dsn = "pgsql:host"."=".self::$host.";"." "."dbname"."=".self::$dbname;
        $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,];
        $connect = new PDO ($dsn, self::$user, self::$password, $options);
        return $connect;
        }
        catch (PDOException $e)
        {
        throw new Exception('ERROR');
        }
    }
    public function connectWithDB()
    {
        $connect = self::connect();
        return $connect;
    }
}