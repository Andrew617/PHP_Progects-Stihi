
<!DOCTYPE html>
<body>
<div class = "a"></div>
<h1>Стихи</h1>
</body>
<head>
<body>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title> СТИХИ </title>
</body>
<style>
 .a {
    background-image: url('2311_mainfoto_03.jpg');
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center center;
}
</style>
</head>
<body>
<p> Авторы</p>
<?php
foreach ($getUsers as $user) {
    $id = $user -> id;
    $nick = $user -> nick;
    $name = $user -> name;
    echo $name.'-'.' '.'<a href = "http://stihi?id='.urlencode($id).'"'.'>'.urldecode($nick).'</a>'.'<br>';
}
?><br><br>
<p><a href = "http://stihi/registration.php" > зарегистрироваться </a> </p>
<p><a href = "http://stihi?controller=entry&id=key" > войти</a></p>
</body>
</html>
