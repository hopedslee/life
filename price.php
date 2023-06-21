<HTML>
<HEAD>
<meta charset="utf-8">
<img src="../fx/images/header-<?php $random = rand(1,32); echo $random; ?>.jpg" />
<style>
table {
    border-collapse: collapse;
}

td {
    position: relative;
    padding: 5px 10px;
}

tr.strikeout td:before {
    content: " ";
    position: absolute;
    top: 50%;
    left: 0;
    border-bottom: 1px solid #111;
    width: 100%;
}

.block {
  display: block;
  width: 100%;
  border: none;
  background-color: #4CAF50;
  color: white;
  padding: 14px 28px;
  font-size: 56px;
  cursor: pointer;
  text-align: center;
}

.block:hover {
  background-color: #ddd;
  color: black;
}
</style>

<?php
include_once('../dbconn.php');
$query="SELECT * from myevents ORDER BY date DESC LIMIT 10";
$result=mysqli_query($conn,$query) or die(mysqli_error());

echo "<table border='2'>";
echo "<tr><th align='center' strong style='font-size: 20px;'>일자</th>";
echo "<th align='center' strong style='font-size: 20px;'>구분</th>";
echo "<th align='center' strong style='font-size: 20px;'>내역</th>";
echo "<th align='center' strong style='font-size: 20px;'>금액</th>";
echo "<th align='center' strong style='font-size: 20px;'>수량</th>";
echo "<th align='center' strong style='font-size: 20px;'>단가</th>";
echo "<th align='center' strong style='font-size: 20px;'>비고</th>";
echo "<th align='center' strong style='font-size: 20px;'>구입처</th></tr>";
while( $row = mysqli_fetch_array($result) )
{
	echo "<tr><td align='center' strong style='font-size: 20px;'>".date('Y-m-d',strtotime($row['date']))."</td>";
	echo "<td align='center' strong style='font-size: 20px;'>".$row['type']."</td>";
	echo "<td align='center' strong style='font-size: 20px;'>".$row['contents']."</td>";
	echo "<td align=right strong style='font-size: 20px;'>".number_format($row['price'],0)."</td>";
	if($row['volume']>0)
	{
		echo "<td align=right strong style='font-size: 20px;'>".number_format($row['volume'],0)."</td>";
		echo "<td align=right strong style='font-size: 20px;'>".number_format($row['price']/$row['volume'],0)."</td>";
	}
	else 
	{	
		echo "<td align=right strong style='font-size: 20px;'></td>";
		echo "<td align=right strong style='font-size: 20px;'></td>";
	}
	
	echo "<td align='left' strong style='font-size: 20px;'>".$row['remark']."</td>";
	echo "<td align='left' strong style='font-size: 20px;'>".$row['market']."</td></tr>";
}
echo "<tr><td colspan=6 align=center><input type=button class=\"block\" onClick=window.open('prices/new.php','aaa','width=1500,height=1000,left=150,top=200,toolbar=0,status=0,'); value='new'></td></tr>";
echo "</table>";
mysqli_close($conn);

?>
</html>

