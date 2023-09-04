<?php
$host="127.0.0.1:3306";
$user="dslee";
$passwd="A2lds7707!";
$dbname="dslee_db";
$conn=mysqli_connect($host,$user,$passwd,$dbname);
if (mysqli_connect_errno($conn)) exit ("DB connect fail : ".(mysqli_connect_error())); 		
?>
