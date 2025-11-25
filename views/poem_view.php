
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<body background = '/home/andrew/PHP_Progects/stihi/public/images/2311_mainfoto_03.jpg'></body>
<?php include_once '/home/andrew/PHP_Progects/stihi/controllers/controller_stihi.php';
$a = new Controller_stihi;
$poemId = $get['poem_id'];
$poem = $a -> getOnePoem($poemId);
print "<h4>$poem[2]</h4>";?> <br><br>
<?php print "<h4>$poem[0]</h4>";?> <br><br>
<?php echo "<pre>$poem[1]</pre>";?></head>

