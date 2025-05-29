<?php
require_once '/home/andrew/PHP_Progects/stihi/model/model.php';

class Model_stihi extends Model{
   

function createNewPoetry($values)
    {
    $sqlCommand = "INSERT INTO poems (id, poem_name, poem_text) VALUES (:id, :poem_name, :poem_text)";
    $dbconn = Model::createOrEditEntry($sqlCommand, $values);
    if($dbconn==true)
    {$return = 'Ваше произведение опубликовано, поздравляем';
    $$return = str_split($return, 82);
    }
    else 
    {$return = 'Сожалеем, но опубликовать произведение не удалось. Попробуйте ещё раз, либо обратитесь в службу поддержки';
    $$return = str_split($return, 194);
    }
    return $$return;
}
function selectPoemForId($poemId)
    {
    $sqlCommand = "SELECT poems.poem_name, poems.poem_text, passwords.name, passwords.surname, passwords.nick FROM poems LEFT OUTER JOIN passwords ON poems.id = passwords.id WHERE poem_id = ?"; 
    $poem = Model::getResult($sqlCommand, $poemId);
    return $poem;
    }

function getAllpoemsId()
    {
    $sqlCommand = "SELECT poem_id FROM poems";
    $poemsId = Model::GetAll($sqlCommand);
    return $poemsId;
    }

function getAllpoemsFromUser($nick)
    {
    $sqlCommand = "SELECT poem_name FROM passwords LEFT OUTER JOIN poems ON passwords.id = poems.id WHERE nick = ?";
    $allpoems = Model::getResult($sqlCommand, $nick);
    return $allpoems;
    }

function getPoemIdFromPoemName($poemName)
    {
    $sqlCommand = "SELECT poem_id FROM poems WHERE poem_name = ?";
    $poemId = Model::getResult($sqlCommand, $poemName);
    return $poemId;
    }

}
