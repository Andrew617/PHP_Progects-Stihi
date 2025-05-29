
<?php 
if (empty($_COOKIE)){
        require_once '/home/andrew/PHP_Progects/stihi/public/entry_form.html';
}
else {
        require_once '/home/andrew/PHP_Progects/stihi/views/exit_form.html';
        require_once '/home/andrew/PHP_Progects/stihi/public/template_view.html';
        require_once '/home/andrew/PHP_Progects/stihi/controllers/controller_user.php';
        require_once '/home/andrew/PHP_Progects/stihi/controllers/controller_stihi.php';
        $controllerUserObj = new Controller_user;
        $cookieToken = array_keys($_COOKIE);
        $tokenName = $cookieToken[0];
        $secretToken = $_COOKIE[$tokenName];
        $token = $controllerUserObj -> getToken($secretToken);
        echo $token; 
}