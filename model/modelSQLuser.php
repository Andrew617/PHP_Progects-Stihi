<?php
class ModelSQLuser {
    private static $selectUser = 'SELECT name, surname, biography, nick FROM passwords WHERE id = :id';
    private static $selectPassword = 'SELECT password FROM passwords WHERE nick = :nick';
    private static $selectIdFromNick = 'SELECT id from passwords where nick = :nick';   
    private static $selectAllusersNickAndName = 'SELECT nick, name, id FROM passwords';
    private static $forCreateNewUser = 'INSERT INTO passwords (nick, name, surname, profession, biography, password, email) VALUES (:nick, :name, :surname, :profession, :biography, :password, :email)';

public function getSelectUser(){
    return self::$selectUser;
}

public function getSelectPassword(){
    return self::$selectPassword;
}

public function gelAllusersNickAndName(){
    return self::$selectAllusersNickAndName;
}
   
public function createNewUser()
{
    return self::$forCreateNewUser;   
}
}
//'nick, name, surname, profession, biography'