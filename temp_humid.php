<?php
date_default_timezone_set('Asia/Seoul');
require('D:\DATA\htdocs\dbconn.php');
//$today = new DateTime(date("Y-m-d"));
$today = date("Y-m-d");
//echo $today . "\r\n";
$datetime = date("Y-m-d G:i:s");
$contents= file_get_contents('http://dsrobotec.iptime.org:8080');
$contents = $datetime . ", " . $contents;
$query = "INSERT INTO myevents (date,type,contents,paymethod,price,volume,remark,market) VALUES ('$today','CLIMATE','$contents','','0','0','','')";
$result = mysqli_query($conn,$query);
echo $query . "\r\n";
echo "result = " . $result;
?>