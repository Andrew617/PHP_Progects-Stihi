<!DOCTYPE html>
<head>
<h3>Пользователь</h3>
<meta charset="utf-8">

<img src= "/home/andrew/PHP_Progects/stihi/public/images/30/zBscTxM0gPk.jpg"  align="right">  
<p>
<?php include_once '/home/andrew/PHP_Progects/stihi/controllers/controller_user.php';
include_once '/home/andrew/PHP_Progects/stihi/controllers/controller_stihi.php';
$a = new Controller_user;
$b = new Controller_stihi;
$dir = $id."/".$files['0'].PHP_EOL;
$user = $a -> getUserFromId($get['id']);
$poems = $b -> getAllpoemsFromUser($user['nick']);
$id = $_GET['id'];
$files = scandir("/home/andrew/PHP_Progects/stihi/public/images"."/".$id,  SCANDIR_SORT_DESCENDING);?>
<p> Имя: <?php echo $user['name'];?><br><br>
Фамилия: <?php echo $user['surname'];?><br><br>
Биография:<br> <?php echo $user['biography'];?><br><br>
Профессия: <br><?php echo $user['profession'];?><br><br>
Произведения: <br><?php $poemIds = [];
foreach ($poems as &$poemName) {
$poemId= $b -> getPoemIdFromPoemName($poemName);
echo '<a href = "http://stihi?controller=poem&poem_text=',urlencode($poemName),' "> ',$poemName,'</a>';
array_push($poemIds, $poemId['0']);
}?><br><br>
 <head>
<FORM>
<autocomplete="off">
<script src = 'stihi.js'>
</script>
<input type = "hidden" id = 'p1' name = 'param1' value = 'poem_id'>
<lebel for = "selectPoem">Все произведения автора- <?php echo $user['nick'];?></lebel>
<select id = 'p2' name = 'param2'> 
<?php foreach ($poems as &$poemName)
{
$poemId= $b -> getPoemIdFromPoemName($poemName); 
echo '<option value=' ,urlencode($poemId['0']),'>', $poemName.' '.$poemId['0']; '</option>';
}?>
</select>
<input type= "button" value="загрузить" onclick = "sendRequestWithParam()"></button>
</FORM>
<script>
let param1 = document.getElementById('p1').value;
let param2 = document.getElementById('p2').value;
</script>
<head>
 <title><?php if ($user['name'] == 'пользователь предпочёл не указывать своё имя'|| $user['name'] == Null) {echo 'autor id'.' '.$get['id'];}
 else {echo $user['name'];}?></title>
<?php $poemId['0'];?>
