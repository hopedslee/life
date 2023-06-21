<?php
require ('../../dbconn.php');
mysqli_set_charset($conn,'utf8');

if (!empty($_POST["date"])) $date=$_POST["date"];
else $date=date("Y-m-d");
echo $date.'<br />';

if (!empty($_POST["type"])) $type=$_POST["type"];
else $type="DIARY";
echo $type.'<br />';

if (!empty($_POST["contents"])) $contents=$_POST["contents"];
else $contents="contents";
echo $contents.'<br />';

if (!empty($_POST["price"])) $price=$_POST["price"];
else $price=0;
echo $price.'<br />';

if (!empty($_POST["volume"])) $volume=$_POST["volume"];
else $volume=1;
echo $volume.'<br />';

if (!empty($_POST["remark"])) $remark=$_POST["remark"];
else $remark="X";
echo $remark.'<br />';

if (!empty($_POST["market"])) $market=$_POST["market"];
else $market="market";
echo $market.'<br />';

//-- 추가하기
$query = "INSERT INTO myevents (date,type,contents,price,volume,remark,market) VALUES ('$date','$type','$contents','$price','$volume','$remark','$market')";
$ret = mysqli_query($conn,$query);
echo $query;
echo '<br />';
echo $ret;
//header("Location: ../price.php");
?>
<br />
<input align="center" type=button onClick="self.close();" value="Close this window">
</html> 