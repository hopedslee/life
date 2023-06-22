<HTML>
<HEAD>
<meta charset="utf-8">
<img src="../fx/images/header-<?php $random = rand(1,32); echo $random; ?>.jpg" />

<?php
include_once('../dbconn.php');
$query="SELECT * from todo";
$result=mysqli_query($conn,$query) or die(mysqli_error());

echo "<table border='2'>";
echo "<tr><th align='center' strong style='font-size: 30px;'>번호</th>";
//echo "<tr><th align='center' strong style='font-size: 40px;'>구분</th>";
//echo "<th align='center' strong style='font-size: 40px;'>시작일</th>";
//echo "<th align='center' strong style='font-size: 40px;'>종료일</th>";
echo "<th align='left' strong style='font-size: 30px;'>제목</th></tr>";
while( $row = mysqli_fetch_array($result) )
{
	echo "<tr><td align='center' strong style='font-size: 40px;'>".$row['seqno']."</td>";
	//echo "<td align='center' strong style='font-size: 40px;'>".$row['start']."</td>";
	//echo "<td align='center' strong style='font-size: 40px;'>".$row['end']."</td>";
	echo "<td align=left strong style='font-size: 40px;'>".$row['title']."</td>";
	$seqno=$row['seqno'];
	echo "<td><input type=button onClick=window.open('edit.php?seqno=".$seqno."','aaa','width=1500,height=1000,left=150,top=200,toolbar=0,status=0,'); value='Edit'></td>";
	echo "<td><input type=button onClick=window.open('clear.php?seqno=".$seqno."','aaa','width=1500,height=1000,left=150,top=200,toolbar=0,status=0,'); value='Clear'></td>";
	echo "<td><input type=button onClick=window.open('delete.php?seqno=".$seqno."','aaa','width=1500,height=1000,left=150,top=200,toolbar=0,status=0,'); value='DEL'></td>";
	echo "</tr>";
}
echo "<tr><td><input type=button onClick=window.open('new.php','aaa','width=1500,height=1000,left=150,top=200,toolbar=0,status=0,'); value='NEW'></td></tr>";

mysqli_close($conn);

?>
</html>

