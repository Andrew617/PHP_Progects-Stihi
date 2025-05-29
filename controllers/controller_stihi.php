<?php
require_once '/home/andrew/PHP_Progects/stihi/model/model_stihi.php';

class Controller_stihi {

    public $modelStihi;
    
   public function __construct()
    {
    $this -> modelStihi = new Model_stihi;
    }
    
    private static function createOneArrayByArrays($arr)
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
    $po = $this -> modelStihi -> selectPoemForId($poemIdA);
    $poem = self::createOneArrayByArrays($po);
    return $poem;
    }

    
    function wrightPoem($id, $poem_name, $poem_text)
    {
    $values = array("id" => $id, "poem_name" => $poem_name, "poem_text" => $poem_text);
    $this -> modelStihi -> createNewPoetry($values);
    }

    function getAllpoemsFromUser($nick)
    {
    $nickArr = array($nick);
    $poemsFromUser = $this -> modelStihi -> getAllpoemsFromUser($nickArr);
    $AllpoemsFromUser = self::createOneArrayByArrays($poemsFromUser);
    return $AllpoemsFromUser;
    }

    function getAllpoemsId()
    {
    $poemsId = $this -> modelStihi -> getAllpoemsId();
    return $poemsId;
    }

    function getPoemIdFromPoemName($poemName)
    {
    $array = array();
    $poemNameArr = array($poemName);
    $arrayPoemId = $this -> modelStihi -> getPoemIdFromPoemName($poemNameArr);
    $arrayId = self::createOneArrayByArrays($arrayPoemId);
    return $arrayId;
    }

}
