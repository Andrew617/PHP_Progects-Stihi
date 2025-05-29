<?php
require_once '/home/andrew/PHP_Progects/stihi/controllers/controller_user.php';
require_once '/home/andrew/PHP_Progects/stihi/controllers/controller_stihi.php';

    class Rout {

        public $users;
        public $poems;
        
        public function __construct()
        {
            $this -> users = new Controller_user;
            $this -> poems = new Controller_stihi;
        }
    
        public function rout($get)
        {
            if (empty($get)){
                include_once '/home/andrew/PHP_Progects/stihi/views/Main_view.php';
        }
            else if ($get['controller']=='user' && !empty($get['id'])){
            include_once '/home/andrew/PHP_Progects/stihi/views/user_view.php';  
            }   
            else if (isset($get['nick'])){
                    $id = $this -> users -> getUserIdFromNick($get['nick']);
                    header ("Location: http://stihi?controller=user&id=".$id);
            }
            else if($get['id']=='new'){
                include_once '/home/andrew/PHP_Progects/stihi/views/registration_view.php';
                }    
            else if ($get['controller']=='poem') 
            {
            $allPoemsId = $this -> poems -> getAllpoemsId();
            if (in_array($get['poem_id'], $allPoemsId))
            {
            include_once '/home/andrew/PHP_Progects/stihi/views/poem_view.php';   
            }
            else if(isset($get['poem_text']))
            {
            $id = $this -> poems -> getPoemIdFromPoemName($get['poem_text']);
            header ("Location: http://stihi?controller=poem&poem_id=".$id['0']);
            } 
            else {
                header("Location: HTTP/1.1 404 Not Found");
            }
            }
            else {header("Location: HTTP/1.1 404 Not Found");}
        }
            /*else if (array_key_exists('poem_name', $post) || array_key_exists('poem_text', $post)){
public function routForPost($post){
        if (array_key_exists('nick', $post) || array_key_exists('password', $post) || array_key_exists('exit', $post)){
            include_once '/home/andrew/PHP_Progects/stihi/views/enterfa/securrity.php';
            sucurrity($post);
        }
        include_once '/home/andrew/PHP_Progects/stihi/controllers/controller_stihi.php';
        $newControllerStihi = new Controller_stihi;
        $newPoem = $newControllerStihi -> wrightPoem($id, $post['poem_name'], $post['poem_text']);
    }   
    else {
        include_once '/home/andrew/PHP_Progects/stihi/views/Main_view.php';
    }
}*/
    }