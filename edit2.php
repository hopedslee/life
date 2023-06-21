<html>

<?php
$seqno=$_GET['seqno'];

//$agent=$_SERVER["HTTP_USER_AGENT"];
//echo $agent.'<br />';
//foreach($_SERVER as $key => $value){
//echo '$_SERVER["'.$key.'"] = '.$value."<br />";
//}

include_once('../dbconn.php');

/*
$day='2020-11-16';

		$dow=date("w", strtotime($day));
		echo $dow.'<br />';
		if($dow == 6) $bizdate = date("Y-m-d", strtotime($day." -1 day"));
		else if($dow == 0) $bizdate = date("Y-m-d", strtotime($day." -2 day"));
		else $bizdate = $day;
		
echo $bizdate;
*/

/*
	$query2="SELECT sum(deposit), sum(withdrawal) FROM ordershistory WHERE  date_format(OpenTime,'%Y-%m-%d')='2019-11-08' AND account='".$acno."' AND (deposit>0 OR withdrawal>0)";
	$result2=mysqli_query($conn,$query2) or die(mysqli_error());
	$row2_cnt = mysqli_num_rows($result2);
	$row2 = mysqli_fetch_array($result2);	
	if($row2[0]>0 or $row2[1]>0) 
	{
		echo $query2.'<br />';
		echo $row2_cnt.'<br />';
		echo $row2[0].'<br />';
		echo $row2[1].'<br />';
	}
*/

$query="SELECT * FROM todo WHERE seqno='$seqno'";
$result=mysqli_query($conn,$query) or die(mysqli_error());
$row = mysqli_fetch_array($result);	

$pageName = basename($_SERVER['PHP_SELF']);
$today = date('Y-m-d');

echo "<table border='1'>";
echo "<tr><th colspan=4>".$pageName."</th></tr>";
echo "<tr><th>번호</th><td>".$seqno."</td></tr>";
echo "<tr><th>할일</th><td>".$row['title']."</td><td></td></tr>";
echo "</table>";

?>
<br />
<left><input type=button onClick="self.close();" value="Close this window"></center>
</html>