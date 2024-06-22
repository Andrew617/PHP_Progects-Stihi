<?php
require_once '/home/andrew/PHP_Progects/stihi/model/model_stihi.php';
require_once '/home/andrew/PHP_Progects/stihi/controllers/controller_user.php';

class Controller_stihi extends Model_stihi {

    private function createOneArrayByArrays($arr)
    {
        $oneArray = array();
        foreach ($arr as $a)
        {
            foreach ($a as $column)
            {
                $oneArray[] = $column; 
            }
        }
    return $oneArray;
    }
    
    function getOnePoem($poemId)
    {
    $poemIdA = array($poemId);
    $poem = Model_stihi::selectPoemForId($poemIdA);
    return $poem;
    }

    
    function wrightPoem($id, $poem_name, $poem_text)
    {
    $values = array($id, $poem_name, $poem_text);
    Model_stihi::createNewPoetry($values);
    }

    function getAllpoemsFromUser($nick)
    {
    $nickArr = array($nick);
    $poemsFromUser = Model_stihi::getAllpoemsFromUser($nickArr);
    $AllpoemsFromUser = $this -> createOneArrayByArrays($poemsFromUser);
    preg_replace ('/,|:|;|\.\$/','%$1%', $AllpoemsFromUser[0]);
    return $AllpoemsFromUser;
    }

    function getAllpoemsId()
    {
    $allPoems = Model_stihi::getAllpoemsId();
    return $allPoems;
    }

    function getPoemIdFromPoemName($poemName)
    {
    $array = array();
    $poemNameArr = array($poemName);
    $arrayPoemId = Model_stihi::getPoemIdFromPoemName($poemNameArr);
    $Controller_user = new Controller_user;
    $arrayId = $Controller_user -> createOneArrayByArrays($arrayPoemId);
    return $arrayId;
    }

}
