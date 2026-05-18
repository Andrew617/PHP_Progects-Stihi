<!DOCTIPE html>
<head>
<h3>Пользователь</h3>
<meta charset="utf-8">
<img src="2311_mainfoto_03.jpg" align="right">  
<p>
<?php foreach($getUser as $test)
{
echo $test -> nick.' ';
echo $test -> surname.' ';
echo $test -> biography.' ';
};?> 
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
