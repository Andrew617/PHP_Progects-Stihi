<?php
class ModelStihi {
   
private $modelSqlstihi;
private $model;

public function __construct(object $modelSqlstihi, object $model)
    {
    $this -> modelSqlstihi = $modelSqlstihi;
    $this ->model = $model;
    }

    public function getViewPoem($values, $limit=null)
    {
    switch (is_null($limit)) 
        {
        case TRUE:
        if (!empty($values['poem_id']))
            {
                return $this -> getPoem($values);
            }
        elseif (!empty($values['id']))
            {
                return $this -> getAllpoemsIdAndPoemsNameByUser($values);
            }
        break;
        case FALSE:
            return $this -> getAllPoemNameList($limit);
            break;
        }
       
    }

private function getAllpoemsIdAndPoemsNameByUser(array $values)
    {
    $sqlCommand = $this -> modelSqlstihi -> getAllPoemIdAndPoemNameByUser();
    return $this-> model -> getResult($sqlCommand, $values);
    }

private function getPoem(array $values)
    {
    $sqlCommand = $this -> modelSqlstihi -> getPoemNameAndTextfromPoemId();
    return $this-> model -> getResult($sqlCommand, $values);
    }

private function getAllPoemNameList($limit)
    {
    $sqlObject = $this -> sQLPoemObject;   
    $sqlCommand = $sqlObject -> getListOfPoems().' '.$limit;
    return parent::getAll($sqlCommand);
    }
}


/*$model = new Model;
$modelSqlstihi = new ModelSQLstihi;
$testObj = new ModelStihi($modelSqlstihi, $model);
$id = array('id'=>'25');
$test = $testObj -> getViewPoem($id);
foreach($test as $oneString)
{
    echo $oneString -> poem_name;
    echo $oneString -> poem_id;
}*/
