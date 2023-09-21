
<HTML>
<HEAD>
<title>MyEvents Gabia 2023-09-04</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<!-- 
<iframe width="280" height="157" src="https://www.youtube.com/embed/YCEPIJJoo9s" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
-->
<img width="450" height="157" src="../fx/images/header-<?php $random = rand(1,89); echo $random; ?>.jpg">

</HEAD>
<body bgcolor='black'> </body>
<SCRIPT>

</SCRIPT>
<?php
header("Content-Type:text/html;charset=utf-8");
require('db.php');

date_default_timezone_set('Asia/Seoul');
//$iot= file_get_contents('http://192.168.0.91:8081');
echo "<table border='1'>";
echo "<tr style='color:gray;'><th>" . date('Y-m-d H:i:s') ."&nbsp&nbsp(" . gethostname() . ")</th></tr>";

$mentFile = "wisesaying.txt";
$fp = fopen($mentFile, "r");
while(!feof($fp)) $ment[] = fgets($fp, 1024);
$key = array_rand($ment);
echo "<tr style='color:gray;'><th>" . $text_this=$ment[$key] . "</th></tr>";

$query="SELECT * from issues";
$result=mysqli_query($conn,$query) or die(mysqli_error());

$dom=date('j');
while( $row = mysqli_fetch_array($result) )
{
    $left = $row[2] - $dom;
    if($left>-3 and $left<10) {
        if($left>0) echo "<tr style='color:gray'><td>" . $row[1] . ", " . $row[2] . " / ". $left . " days left</td></tr>";
        else echo "<tr style='color:red'><td>" . $row[1] . ", " . $row[2] . " / ". $left . " days passed </td></tr>";
    }

}
echo "</table>";

if (!empty($_GET['from'])) {
    $from=$_GET['from'];
}
else $from=0;

if (!empty($_GET['count'])) {
    $count=$_GET['count'];
}
else $count=120;

if (!empty($_GET["keyword"])) {
    $keyword=$_GET["keyword"];
    $query="SELECT * from myevents where contents like '%".$keyword."%' order by date desc, seqno desc";
    echo $query;
}
else {
    $query="SELECT * from myevents order by date desc, seqno desc limit ".$from.", ".$count;
}

$result=mysqli_query($conn,$query) or die(mysqli_error());

//$from = $from + $count;
$prev_from = $from - ($count*2);

echo "<table border='2'>";
echo "<td align=right style='font-size: 10px;'>";
echo "<form action='myevents.php?from=".$from."&count=".$count."&keyword='><input type='text' name='keyword' value='검색어'/><input type='submit'/></form></td>";
echo "</table>";

echo "<table border='2'>";
echo "<tr><td align=right style='font-size: 10px;'><a href='myevents.php?from=0&count=120'>Top Page</a></td>";
echo "<td align=right style='font-size: 10px;'><a href='myevents.php?from=".$prev_from."&count=".$count."'>Prev Page</a></td>";
echo "<td align=right style='font-size: 10px;'><a href='myevents.php?from=".$from."&count=".$count."'>Next Page</a></td>";
//echo "<td align=right style='font-size: 10px;'>";
//echo "<form action='myevents.php?from=".$from."&count=".$count."&keyword='><input type='text' name='keyword' value='검색어'/><input type='submit'/></form></td>";
echo "<td align=center colspan=6><input type=button style='width: 50px' onClick=window.open('new.php','_self','width=500,height=700,toolbar=1,status=1,'); value='追加'></td></tr>";
echo "<colgroup>";
echo "<col style='width:1%;'>";
echo "<col style='width:1%;'>";
echo "<col style='width:2%;'>";
echo "<col style='width:5%;'>";
echo "<col style='width:1%;'>";
echo "<col style='width:2%;'>";
echo "<col style='width:40%;'>";
echo "<col style='width:5%;'>";
echo "<col style='width:2%;'>";
echo "<col style='width:2%;'>";
echo "<col style='width:2%;'>";
echo "<col style='width:2%;'>";
echo "<col style='width:2%;'>";
echo "<col style='width:2%;'>";
echo "<col style='width:2%;'>";
echo "<col style='width:2%;'>";
echo "<col style='width:2%;'>";
echo "</colgroup>";

echo "<tr style='color: gray;'>";
echo "<th align='center' strong style='font-size: 10px;'>NO</th>";
echo "<th align='center' strong style='font-size: 10px;'>del</th>";
echo "<th align='center' strong style='font-size: 10px;'>SN</th>";
echo "<th align='center' strong style='font-size: 10px;'>일자</th>";
echo "<th align='center' strong style='font-size: 1px;'>경과일</th>";
echo "<th align='center' strong style='font-size: 10px;'>구분</th>";
echo "<th align='center' strong style='font-size: 10px;'>내용</th>";
echo "<th align='center' strong style='font-size: 10px;'>결제</th>";
echo "<th align='center' strong style='font-size: 10px;'>가격</th>";
echo "<th align='center' strong style='font-size: 10px;'>수량</th>";
echo "<th align='center' strong style='font-size: 10px;'>단가</th>";
echo "<th align='center' strong style='font-size: 10px;'>비고</th>";
echo "<th align='center' strong style='font-size: 10px;'>시장</th>";
echo "<th align='center' strong style='font-size: 10px;'>파일</th>";
echo "<th align='center' strong style='font-size: 10px;'>EDIT</th>";
echo "<th align='center' strong style='font-size: 10px;'>END</th>";
echo "</tr>";
$no=$from;
$today = new DateTime(date("Y-m-d"));

while( $row = mysqli_fetch_array($result) )
{
    $seqno=$row['seqno'];
    $contents=$row['contents'];
    echo "<tr style='color: gray'><td align='center' style='font-size: 9px;'>".$no."</td>";
    $no += 1;
    echo "<td align='center'><a onClick=\"javascript: return confirm('Delete [".$seqno."] ".iconv_substr($contents,0,10,"utf-8")." ?');\" href='delete.php?seqno=".$seqno."&from=".$from."&count=".$count."'>x</a></td>"; //use double quotes for js inside php!
    echo "<td align='center' style='font-size: 10px;'>".$row['seqno']."</td>";
    $date = $row['date'];
    $weekday = date("N", strtotime($date));
    switch($weekday)
    {
        case 1: $dname=" (Mon)"; break;
        case 2: $dname=" (Tue)"; break;
        case 3: $dname=" (Wed)"; break;
        case 4: $dname=" (Thu)"; break;
        case 5: $dname=" (Fri)"; break;
        case 6: $dname=" (Sat)"; break;
        case 7: $dname=" (Sun)"; break;
        default: break;
    }
    //if($weekday > 5) echo "<th align='center' style='width: 5%; font-size: 10px; color: red'>".substr($row['date'],-10,10).$dname."</th>";
	$s = trim(substr($row['date'],-10,10)).trim($dname);
    if($weekday > 5) echo "<td align='center' style='width: 10%; font-size: 10px; color:red;'>".$s."</th>";
    else echo "<td align='center' style='font-size: 10px;'>".substr($row['date'],-10,10).$dname."</td>";
    $event = new DateTime($row['date']);
    $span  = date_diff($event, $today);
    if($event > $today) {
        //$diff = (-1) * $span->days;
        echo "<td align='center' strong  style='background-color:yellow; font-size: 10px;'><b>".$span->days*(-1)."</b></td>";
    } else if($event == $today) {
        if($row['type']=="APPO") echo "<td align='center' strong  style='background-color:red; font-size: 10px;'><b>".$span->days."</b></td>";
        else echo "<td align='center' strong  style='background-color:green; font-size: 10px;'><b>".$span->days."</b></td>";
    } else {
        //$ddd = $span->days;
        echo "<td align='center' style='font-size: 10px;'>+".$span->days."</td>";
    }
    echo "<td align='center' style='font-size: 10px;'>".$row['type']."</td>";

    //echo "<td align=char style='font-size: 20px;'>".$row['contents']."</td>";
    // contents
    echo "<td align=char>".$row['contents']."</td>";

    echo "<td align=left style='font-size: 10px;'>".$row['paymethod']."</td>";

    if($row['price']==0) echo "<td align=right style='font-size: 10px;'></td>";
    else echo "<td align=right style='font-size: 10px;'>".number_format($row['price'])."</td>";

    if($row['volume']==0) echo "<td align=right style='font-size: 10px;'></td>";
    else echo "<td align=right style='font-size: 10px;'>".number_format($row['volume'])."</td>";

    if($row['volume']>0) echo "<td align=right style='font-size: 10px;'>".number_format( $row['price'] / $row['volume'] )."</td>";
    else echo "<td align=right style='font-size: 10px;'></td>";
    echo "<td align=left style='font-size: 10px;'>".$row['remark']."</td>";
    echo "<td align=left style='font-size: 10px;'>".$row['market']."</td>";
    //echo "<td align=right style='font-size: 10px;'><a href='fileview.php?filename='>".$row['filename']."</a></td>";
    $filepath="files/";
    if($row['filename'] != null) {
        echo "<td align=left style='font-size: 10px;'><a href='".$filepath.$row['filename']."'>".$row['filename']."</a></td>";
    } else {
        echo "<td><input type=button onClick=window.open('file_upload.php?seqno=".$seqno."','aaa','width=500,height=200,left=150,top=200,toolbar=0,status=0,'); value='F'></td>";
        //echo "<td><input type=button onClick=window.open('file_upload.php?seqno=".$seqno."&contents=".$row['contents']."','aaa','width=1500,height=1000,left=150,top=200,toolbar=0,status=0,'); value='F'></td>";
    }
    echo "<td><input type=button onClick=window.open('edit.php?seqno=".$seqno."','aaa','width=500,height=1200,left=150,top=200,toolbar=0,status=0,'); value='Edit'></td>";

    echo "<td align=left style='font-size: 10px;'>-</td>";

    echo "</tr>";
}
$from = $from + $count;
$prev_from = $from - ($count*2);
//echo "<tr><td align=right style='font-size: 10px;'><a href='myevents.php?from=".$from."&count=".$count."'>next page</a></td>";
echo "<tr><td align=right style='font-size: 10px;'><a href='myevents.php?from=0&count=120'>Top Page</a></td>";
echo "<td align=right style='font-size: 10px;'><a href='myevents.php?from=".$prev_from."&count=".$count."'>Prev Page</a></td>";
echo "<td align=right style='font-size: 10px;'><a href='myevents.php?from=".$from."&count=".$count."'>Next Page</a></td>";
//echo "<input type='submit' style='position: absolute; left: -9999px'/></td>";
echo "<td align=center colspan=12><input type=button style='width: 150px' onClick=window.open('new.php','_self','width=500,height=700,toolbar=1,status=1,'); value='追加'></td></tr>";
echo "</table>";
echo "<table>";
echo "<td align=right style='font-size: 10px;'>";
echo "<form action='myevents.php?from=".$from."&count=".$count."&keyword='><input type='text' name='keyword' value='검색어'/><input type='submit'/></form></td>";
echo "</table>";

mysqli_close($conn);

?>
</p>
</html>
