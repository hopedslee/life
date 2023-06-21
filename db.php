<?php
$host="127.0.0.1:3306";
$user="dslee";
$passwd="A2lds7707!";
$dbname="dslee_db";
$con_suwon=mysqli_connect($host,$user,$passwd,$dbname);
if (mysqli_connect_errno($conn)) exit ("DB connect fail : ".(mysqli_connect_error())); 		

$host="139.150.64.222:3306";
$user="dslee";
$passwd="A2lds7707!";
$dbname="dslee_db";
$con_gabia=mysqli_connect($host,$user,$passwd,$dbname);
if (mysqli_connect_errno($conn)) exit ("DB connect fail : ".(mysqli_connect_error())); 		
?>
