<?php class ModelSQLstihi {

private static $selectPoemNameAndTextfromPoemId = 'SELECT poem_name, poem_text FROM poems WHERE poem_id = :poem_id';
private static $selectAllPoemIdAndPoemNameByUser = 'SELECT poem_name, poem_id FROM passwords LEFT JOIN poems ON passwords.id = poems.id WHERE passwords.id = :id';
private static $createNewPoem = 'INSERT INTO poems (poem_name, poem_text, id) VALUES (:poem_name, :poem_text, :id)';
private static $selectAllPoem = 'SELECT poem_name, poem_id FROM poems LIMIT'; 

public function getPoemNameAndTextfromPoemId()
{
    return self::$selectPoemNameAndTextfromPoemId;
}

public function getAllPoemIdAndPoemNameByUser()
{
    return self::$selectAllPoemIdAndPoemNameByUser;
}

public function getListOfPoems()
{
    return self::$selectAllPoem;
}
}