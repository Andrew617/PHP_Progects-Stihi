<?php
$get = $_GET;
$post = $_POST;
$_SERVER ?? 0;
$url = $_SERVER['REQUEST_URI' ?? 0];
$method = ($_SERVER['REQUEST_METHOD' ?? 0]);
switch ($method){
    case 'GET':
    if (empty($get['controller']) && !empty($get['poem_id']))
    {
    require_once '/home/andrew/PHP_Progects/stihi/model/model_stihi.php';
    $a = new Model_stihi;
    $b = $a -> selectPoemForId($get['poem_id']);
    }
    else 
    {
    require_once '/home/andrew/PHP_Progects/stihi/route.php';
    $rout = new Rout;
    $rout -> rout($get);    
    } 
    break;
    case 'POST':
        if($_POST["exit"]="leave_page" && !empty($_SESSION['name']))
        {
        session_unset();
        if (session_unset() == TRUE){
        header('location: http//stihi');}
        else{
            echo "session is not clean";
        }
         
        }
        break;
    }
        /*if (arrey_key_exist('nick', $post) || arrey_key_exist('password', $post))
        {include_once '/home/andrew/PHP_Progects/stihi/controllers/controller_user.php';
            $a = new Controller_user;
            $b = $a -> entry ($post['nick'], $post['password']); 
            if ($b == true){
                $id = $a -> getUserIdFromNick($nick);
                print_r($id);
                $$id = strval($id['id']);
                session_id($$id);
                session_start();
                session_name($$id); 
                header("location:my_form.php");
            }
            else if ($b == false)
            {
            exit("<script>alert('вы ввели не верный логин или пароль')</script>");    
        }
    break;    
        }}*/