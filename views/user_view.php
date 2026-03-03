<!DOCTIPE html>
<head>
<h3>Пользователь</h3>
<meta charset="utf-8">
<img src="2311_mainfoto_03.jpg" align="right">  
<p>
<?php include_once '/home/andrew/PHP_Progects/stihi/controllers/controller_user.php';
include_once '/home/andrew/PHP_Progects/stihi/controllers/controller_stihi.php';
$userObject = new ControllerUser($_GET);
$user = $userObject -> getView();?> 
<?php echo $user -> {0}['nick'];?><br>
<?php echo $user -> {0}['name'];?><br>
<?php echo $user -> {0}['surname'];?><br>
<?php echo $user -> {0}['biography'];?><br>
<a href = 'http://stihi'><h4>Домой</h4></a>
<div id = "id" data-id = "<?PHP echo htmlspecialchars($_GET['id'] ?? ' ',ENT_QUOTES) ?>">
<script src = 'stihi.js'></script>
<script>
let param1;
let param2;
document.addEventListener('DOMContentLoaded', function()
{   
    param1 = 'id';
    param2 = document.getElementById("id").dataset.id;    
    if(param2){
        vewThatReturnSend(param1, param2);
    
    }
    else
    {
        alert('Нет данных');
    }   
});
</script>
