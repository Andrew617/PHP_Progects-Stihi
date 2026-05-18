<?php
$_SERVER ?? 0;
$_SERVER['REQUEST_METHOD'] ?? 0;
$method = $_SERVER['REQUEST_METHOD'];
switch ($method){
case 'GET':
if (!empty($_GET['id'])){
include_once '/home/andrew/PHP_Progects/stihi/controllers/controller_stihi.php';
include_once '/home/andrew/PHP_Progects/stihi/model/model.php';
include_once '/home/andrew/PHP_Progects/stihi/model/modelSQLuser.php';
include_once '/home/andrew/PHP_Progects/stihi/model/model_stihi.php';
$model = new Model;
$modelSQL = new ModelSQLstihi;
$modelStihiObj = new ModelStihi($modelSQL, $model);
$stihiObj = new ControllerStihi();
$poemsByUser = $stihiObj-> getViwPoem();
header('Content-Type: application/json');
            echo json_encode($poemsByUser, JSON_UNESCAPED_UNICODE);
            exit;
        } else {
            header('Content-Type: application/json');
            json_encode(["error" => "Произведения не найдены"]);
            exit;
        }
break;
case 'POST':
    header("Content-Type: application/json");
    $sendData = json_decode(file_get_contents('php://input'), true);
    if(!empty($post) && array_key_exists("poem_text", $sendData)){
        require_once '/home/andrew/PHP_Progects/stihi/model/model_stihi.php';
        $modelStihiObj = new modelStihi;
        $modelStihiObj -> createNewPoetry($sendData);
    }
    else if (array_key_exists("nick", $sendData) && array_key_exists("password", $sendData) && !empty($sendData["nick"])){
        require_once '/home/andrew/PHP_Progects/stihi/controllers/controller_user.php';
        $controllerUserObj = new Controller_user;
        $open = $controllerUserObj -> entry($sendData["nick"], $sendData["password"]);
        if ($open == true)
        {
        $userId = $controllerUserObj -> getUserIdFromNick($sendData["nick"]);
        $role = 'user';
        $openToken = $controllerUserObj -> createOpenToken($role, $userId);
        $token = $controllerUserObj -> sendToken($openToken, $userId);
        $type = 'securityToken';
        setcookie($type.$userId, $token, time()+600, "/", "stihi", false, true);
        echo json_encode(
            ["message" => "Добро пожаловать, "." ".$sendData["nick"]]);
        }
        else 
        {
        echo json_encode("Не верный логин и/или пароль");
        }
    break;
    }
    
} 

