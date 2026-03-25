<?php
include_once __DIR__.'/model.php';
include_once __DIR__.'/modelSQLstihi.php';

class ModelStihi {
   
public function __construct($values=null)
    {
    $this -> sQLPoemObject = new ModelSQLstihi;
    parent:: __construct($values);
    $this -> values = $values;
    }


private function getAllpoemsIdAndPoemsNameByUser()
    {
    $sqlObject = $this -> sQLPoemObject;
    $sqlCommand = $sqlObject -> getAllPoemIdAndPoemNameByUser();
    return parent::getResult($sqlCommand);
    }

private function getPoem()
    {
    $sqlObject = $this -> sQLPoemObject;
    $sqlCommand = $sqlObject -> getPoemNameAndTextfromPoemId();
    return parent::getResult($sqlCommand);
    }
private function getAllPoemNameList($limit)
    {
    $sqlObject = $this -> sQLPoemObject;   
    $sqlCommand = $sqlObject -> getListOfPoems().' '.$limit;
    return parent::getAll($sqlCommand);
    }

public function getViewPoem($limit=null)
    {
    switch (is_null($limit)) 
        {
        case TRUE:
        $request = $this -> values;
        if (!empty($request['poem_id']))
            {
                return $this -> getPoem();
            }
        elseif (!empty($request['id']))
            {
                return $this -> getAllpoemsIdAndPoemsNameByUser();
            }
        break;
        case FALSE:
            return $this -> getAllPoemNameList($limit);
            break;
        }
       
    }
}

/*$testObj = new ModelStihi(array('poem_id'=>21));
var_dump($testObj -> getViewPoem());*/
