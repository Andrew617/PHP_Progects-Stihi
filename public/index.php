<?php
require_once '/home/andrew/PHP_Progects/stihi/route.php';
$rout = new Rout($_SERVER['REQUEST_METHOD']);   
$rout -> rout($_GET);
?> 

