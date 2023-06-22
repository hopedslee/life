<?php
date_default_timezone_set("Asia/Seoul");

require ('dbconn.php');

$contents=$_GET['contents'];

$date=date("Y-m-d");
$type="DIARY";
$currdate = new DateTime("now");
$contents = $currdate->format('Y-m-d|H:i:s') . "|" . $contents;

$query = "INSERT INTO myevents (date,type,contents,paymethod,price,volume,remark,market) 
VALUES ('$date','$type','$contents','',null,null,'','')";
$result = mysqli_query($conn,$query);
echo $query . "<br />";
echo "Return : " . $result ."<br />";

?>
