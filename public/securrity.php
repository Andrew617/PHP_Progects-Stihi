
<?php include_once '/home/andrew/PHP_Progects/stihi/controllers/controller_user.php';
function securrity($post){
        $a = new Controller_user;
        $b = $a -> entry ($post['nick'], $post['password']); 
        if ($b == true){
            $id = $a -> getUserIdFromNick($nick);
            session_start();
            $_SESSION['id']=$id;
            return $_SESSION;
        }
        else if ($b == false && !empty($_POST))
        {
        exit("<script>alert('вы ввели не верный логин или пароль')</script>");    
        }
    }

function entrance($post) { if($post["exit"]="leave_page" && !empty($_SESSION['id']))
    {
    session_unset();
    $post == null;
    header("Location: http://index.php");
    } 
}

