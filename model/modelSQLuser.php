<?php
class ModelSQLuser {
    private static $selectUser = 'SELECT name, surname, biography, nick, password FROM passwords WHERE id = :id';
    private static $selectPassword = 'SELECT password FROM passwords WHERE nick = :nick';
    private static $selectIdFromNick = 'SELECT id from passwords where nick = :nick';   
    private static $selectAllusersNickAndName = 'SELECT nick, name, id FROM passwords WHERE id>:id ORDER BY id LIMIT 10';
    private static $forCreateNewUser = 'INSERT INTO passwords (nick, name, surname, profession, biography, password, email) VALUES (:nick, :name, :surname, :profession, :biography, :password, :email)';



public static function getSelectUser(){
    $sqlCommand = self::$selectUser;
    return $sqlCommand;
}

    public static function getSelectPassword(){
    $sqlCommand = self::$selectPassword;
    return $sqlCommand;
}

public static function getAllusersNickAndName(){
    return self::$selectAllusersNickAndName;
}
   
public static function createNewUser()
{
    return self::$forCreateNewUser;   
}
}
