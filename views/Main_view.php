
<!DOCTYPE html>
<body>
<div class = "a"></div>
<h1>Стихи</h1>
</body>
<head>
<body background = 'Снимок экрана в 2024-10-21 15-18-44.png' align='center'>
<background-repeat: no-repeat>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title> СТИХИ </title>
</body>
</head>
<body>
<p> Авторы</p>
<?php require_once '/home/andrew/PHP_Progects/stihi/controllers/controller_user.php';
$users = new Controller_user;
$get_users = $users -> getAllusersNick();
foreach ($get_users as $us) {
    echo '<a href = "http://stihi?controller=user&nick=',urlencode($us),' "> ',$us,'</a>';
}
?><br><br>
<p><a href = "http://stihi?id=new" > зарегистрироваться </a> </p>
<p><a href = "http://stihi/my_form.php" > моя страница</a> </p>