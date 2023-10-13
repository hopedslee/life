<html>
<?php
require ('db.php');
mysqli_set_charset($conn,'utf8');

$seqno=$_POST['seqno'];

if (!empty($_POST["date"])) $date=$_POST["date"]; else $date=date("Y-m-d");
if (!empty($_POST["type"])) $type=$_POST["type"]; else $type="DIARY";
if (!empty($_POST["contents"])) $contents=$_POST["contents"]; else $contents="";
if (!empty($_POST["paymethod"])) $paymethod=$_POST["paymethod"]; else $paymethod=NULL;
if (!empty($_POST["price"])) $price=$_POST["price"]; else $price=0;
if (!empty($_POST["volume"])) $volume=$_POST["volume"]; else $volume=0;
if (!empty($_POST["remark"])) $remark=$_POST["remark"]; else $remark=NULL;
if (!empty($_POST["market"])) $market=$_POST["market"]; else $market=NULL;
if (!empty($_POST["filename"])) $filename=$_POST["filename"]; else $filename=NULL;

//-- 저장하기
$contents = addslashes($contents);
$query = "UPDATE myevents SET edate='$date', etype='$type', contents='$contents', paymethod='$paymethod', price=$price, volume=$volume, remark='$remark', market='$market', filename='$filename' WHERE seqno='$seqno'";
$result = mysqli_query($conn,$query);
echo $query . "<br />";
echo "Return : " . $result ."<br />";
/*
	 if ($result == True) {
  $from = 0;
  $count = 120;
  $divert="?from=".$from."&count=".$count;
  //echo $divert;
  $head="Location: myevents.php".$divert;
  //echo $head."<br />";
  header("$head");
  //exit;
}
*/

/*
if ($result == True) {
	header("Location: 	myevents.php"); 
	exit;
}
else echo "False";
*/
?>
<input type="button" align=center onClick="closeBtn();" value="Close this window">

<script>
var closeBtn = document.querySelector("#test input");
closeBtn.addEventListener("click", ()=>{
    window.close()
})
</script>
</html> 
