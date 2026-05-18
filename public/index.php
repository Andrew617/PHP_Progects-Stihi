<?php
include '/home/andrew/PHP_Progects/stihi/model/modelSQLuser.php';
include '/home/andrew/PHP_Progects/stihi/model/model_user.php';
include '/home/andrew/PHP_Progects/stihi/model/model.php';
include '/home/andrew/PHP_Progects/stihi/controllers/controller_user.php';
$model = new Model;
$modelSQLuser = new ModelSQLuser;
$modelUser = new Model_user($modelSQLuser, $model);
$controllerUser = new ControllerUser($modelUser);
ini_set('display_errors', 1);
error_reporting(E_ALL);
if (empty($_GET))
{
  $getUsers = $controllerUser -> getObjectUsers(); 
  include_once '/home/andrew/PHP_Progects/stihi/views/Main_view.php';  
}
else 
{
    switch (key($_GET))
    {
      case 'id': 
        $getUser = $controllerUser -> getObjectUsers($_GET);
        include_once '/home/andrew/PHP_Progects/stihi/views/user_view.php';
        break;
    }
  }
?> 

