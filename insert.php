<?php

require ('db.php');

mysqli_set_charset($con_suwon,'utf8');

if (!empty($_POST["date"])) $date=$_POST["date"];
else $date=date("Y-m-d");

if (!empty($_POST["type"])) $type=$_POST["type"];
else $type="DIARY";

if (!empty($_POST["contents"])) $contents=$_POST["contents"];
else $contents="";
	
if (!empty($_POST["paymethod"])) $paymethod=$_POST["paymethod"];
else $paymethod=NULL;

if (!empty($_POST["price"])) $price=$_POST["price"];
else $price=0;

if (!empty($_POST["volume"])) $volume=$_POST["volume"];
else $volume=0;

if (!empty($_POST["remark"])) $remark=$_POST["remark"];
else $remark=NULL;

if (!empty($_POST["market"])) $market=$_POST["market"];
else $market=NULL;

if (!empty($_POST["file"])) $file=$_POST["file"];
else $file=NULL;

//-- 추가하기
$contents = addslashes($contents);
$query = "INSERT INTO myevents (date,type,contents,paymethod,price,volume,remark,market) 
VALUES ('$date','$type','$contents','$paymethod','$price','$volume','$remark','$market')";
$result = mysqli_query($con_suwon,$query);
echo $query . "<br />";
echo "Return : " . $result ."<br />";
/*
if ($result == True) {
	header("Location: 	myevents.php"); 
	exit;
}
else echo "False";
*/

?>
<br />
<input align="center" type=button onClick="self.close();" value="Close this window">
</html> 
