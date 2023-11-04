<HTML>
<HEAD>
<title>Mlog 2023-11-01</title>
<meta http-equiv=r'Content-Type' content='text/html; charset=utf-8'>";
<img width='450' height='157' src='../../fx/images/header-<?php $random = rand(1,89); echo $random; ?>.jpg'>
<body bgcolor='black'> </body>";
</HEAD>

<?php
header("Content-Type:text/html;charset=utf-8");

include('db.php');

date_default_timezone_set('Asia/Seoul');
//$iot= file_get_contents('http://192.168.0.91:8081');
echo "<table border='1'>";
echo "<tr style='color:gray;'><th>" . date('Y-m-d H:i:s') ."&nbsp&nbsp(" . gethostname() . ")</th></tr>";

$mentFile = "../wisesaying.txt";
$fp = fopen($mentFile, "r");
while(!feof($fp)) $ment[] = fgets($fp, 1024);
$key = array_rand($ment);
echo "<tr style='color:gray;'><th>" . $text_this=$ment[$key] . "</th></tr>";

echo "</table>";
?>
