<HTML>
<HEAD>
<title>MyEvents php7.4</title>
</HEAD>
<?php
require('db.php');

$query1="SELECT * from myevents";
$result1=mysqli_query($con_gabia,$query1) or die(mysqli_error());

while( $row1 = mysqli_fetch_array($result1) )
{
	$query2="SELECT * from myevents where seqno='".$row1['seqno']."'";
	$result2=mysqli_query($con_suwon,$query2) or die(mysqli_error());
	$count = mysqli_num_rows($result2);
	$row2 = mysqli_fetch_array($result2);
	//print_r($row2)."<br />";
	if($count>0) 
	{
		//echo $row1['seqno']."-".$row2['seqno']."<br />";
	}
	else
	{
		//echo $row1['seqno']."-".$row2['seqno']."<br />";
		if($row1['price']=='') $row1['price']=0;
		if($row1['volume']=='') $row1['volume']=0;
		$query3="INSERT INTO myevents(seqno,date,type,contents,paymethod,price,volume,remark,market,filename) VALUES ('".$row1['seqno']."','".$row1['date']."','".$row1['type']."','".$row1['contents']."','".$row1['paymethodd']."','".$row1['price']."','".$row1['volume']."','".$row1['remark']."','".$row1['market']."','".$row1['filename']."')";
		echo $query3."<br />";
		$result3=mysqli_query($con_suwon,$query3) or die(mysqli_error());
		echo $result3."<br />";
	}
}
mysqli_close($con_suwon);
mysqli_close($con_gabia);

?>
<!--    <a href="myevents.php?num=100">Show more</a> -->
</html>
