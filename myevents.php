
<?php

function highlightWord( $content, $word ) {
    $replace = "<span style='background-color: #88ccff;'>" . $word . "</span>"; // create replacement
    $content = str_replace( $word, $replace, $content ); // replace content

    return $content; // return highlighted data
}

function highlightWord_2($text, $word) {
    // Use regular expression to ignore case and match the word
    $pattern = "/\b(" . preg_quote($word) . ")\b/i";

    // Replace the matched word with HTML for highlighting
    $highlightedText = preg_replace($pattern, '<span style="background-color: ' . '#88ccff' .  ';">$1</span>', $text);

    return $highlightedText;
}

include ('header.php');

if (!empty($_GET['from'])) {
    $from=$_GET['from'];
}
else $from=0;

if (!empty($_GET['count'])) {
    $count=$_GET['count'];
}
else $count=500;

$keywordsearch = 0;
if (!empty($_GET["keyword"])) {
		$keywordsearch = 1;
    $keyword=$_GET["keyword"];
    $query="SELECT * from myevents where contents like '%".$keyword."%' order by edate desc, seqno desc";
    echo "<tr><td>".$query."</td></tr>";
}
else {
    $query="SELECT * from myevents order by edate desc, seqno desc limit ".$from.", ".$count;
}

/*
if (!empty($_GET["edate"])) {
		echo "AAAAAAAAAAAAAAAAAAAAAAAAAAAAA";
    $edate=$_GET["edate"];
		$timeBefore = strtotime($edate) - (3 * 24 * 60 * 60);
		$dateBefore = date('Y-m-d',$timeBefore);
		$timeAfter = strtotime($edate) + (3 * 24 * 60 * 60);
		$dateAfter = date('Y-m-d',$timeAfter);

    //$query="SELECT * from myevents WHERE edate <= '".$dateBefore."' AND edate >= '".$dateAfter."' order by edate desc, seqno desc";
    $query="SELECT * from myevents WHERE edate >= '".$dateBefore."' AND edate <= '".$dateAfter."' order by edate asc, seqno asc";
    echo $query;
}
else {
    $query="SELECT * from myevents order by edate desc, seqno desc limit ".$from.", ".$count;
}
*/

$result=mysqli_query($conn,$query) or die(mysqli_error());

//$from = $from + $count;
$prev_from = $from - ($count*2);

//echo "<form action='myevents.php?from=".$from."&count=".$count."&keyword='><input type='text' name='keyword' value='검색어'/><input type='submit'/></form></td>";

echo "<table border='2'>";
echo "<td align=right style='font-size: 10px;'>";
echo "<form method='get' action='myevents.php?from=".$from."&count=".$count."&keyword='><input type='text' name='keyword' value='검색어'/><input type='submit'/></form></td>";
echo "<td>".$keyword."</td>";

echo "<td align=right style='font-size: 10px;'>";
echo "<form method='get' action='myevents.php?edate='><input type='date' name='date' value='edate'/><input type='submit'/></form></td>";

echo "<table border='2'>";
echo "<tr><td align=right style='font-size: 10px;'><a href='myevents.php?from=0&count=500'>Top Page</a></td>";
echo "<td align=right style='font-size: 10px;'><a href='myevents.php?from=".$prev_from."&count=".$count."'>Prev Page</a></td>";
echo "<td align=right style='font-size: 10px;'><a href='myevents.php?from=".$from."&count=".$count."'>Next Page</a></td>";
echo "<td align=right style='font-size: 10px;'><a href='myevents.php?from=0&count=5000'>Last Page</a></td>";
echo "<td align=center colspan=6><input type=button style='width: 50px' onClick=window.open('new.php','_blank','width=500,height=900,toolbar=1,status=1,'); value='Add'></td></tr>";
echo "<colgroup>";
echo "<col style='width:1%;'>";
echo "<col style='width:1%;'>";
echo "<col style='width:1%;'>";
echo "<col style='width:1%;'>";
echo "<col style='width:1%;'>"; //경과년
echo "<col style='width:1%;'>";
echo "<col style='width:2%;'>";
echo "<col style='width:40%;'>";
echo "<col style='width:1%;'>";
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
echo "<th align='center' strong style='font-size: 5px;'>NO</th>";
echo "<th align='center' strong style='font-size: 5px;'>일자</th>";
echo "<th align='center' strong style='font-size: 5px;'>경과년</th>";
echo "<th align='center' strong style='font-size: 5px;'>경과일</th>";
echo "<th align='center' strong style='font-size: 5px;'>구분</th>";
echo "<th align='center' strong style='font-size: 10px;'>del</th>";
echo "<th align='center' strong style='font-size: 10px;'>SN</th>";
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
		$no = $no + 1;
    echo "<tr style='color: gray'><td align='center' style='font-size: 9px;'>".$no."</td>";
    $edate = $row['edate'];
    $weekday = date("N", strtotime($edate));
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
    //if($weekday > 5) echo "<th align='center' style='width: 5%; font-size: 10px; color: red'>".substr($row['edate'],-10,10).$dname."</th>";
		$s = trim(substr($row['edate'],-10,10)).trim($dname);
    if($weekday > 5) echo "<td align='center' style='width:5%; font-size: 10px; color:red;'>".$s."</th>";
    else echo "<td align='center' style='width:5%; font-size:10px;'>".substr($row['edate'],-10,10).$dname."</td>";
    $event = new DateTime($row['edate']);
    $span  = date_diff($event, $today);
    if($event > $today) {
        //$diff = (-1) * $span->days;
        echo "<td align='center' strong  style='background-color:yellow; font-size: 10px;'><b>".$span->days*(-1)."</b></td>";
    } else if($event == $today) {
        if($row['etype']=="APPO") echo "<td align='center' strong  style='background-color:red; font-size: 10px;'><b>".$span->days."</b></td>";
        else echo "<td align='center' strong  style='background-color:green; font-size: 10px;'><b>".$span->days."</b></td>";
    } else {
        //$ddd = $span->days;
        echo "<td align='center' style='font-size: 10px;'>+".intval($span->days/365)."</td>";
    }

    echo "<td align='center' style='font-size: 10px;'>+".$span->days."</td>";
    echo "<td align='center' style='width:0%; font-size: 5px;'>".$row['etype']."</td>";

    $no += 1;
    echo "<td align='center'><a onClick=\"javascript: return confirm('Delete [".$seqno."] ".iconv_substr($contents,0,10,"utf-8")." ?');\" href='delete.php?seqno=".$seqno."&from=".$from."&count=".$count."'>x</a></td>"; //use double quotes for js inside php!
    echo "<td align='center' style='font-size: 10px;'>".$row['seqno']."</td>";
    //echo "<td align=char style='font-size: 20px;'>".$row['contents']."</td>";
    // contents
		if ($keywordsearch == 1) {
			$clength = "[".mb_strlen($row['contents'])."]";
			$conts =  htmlspecialchars ( $row['contents'] );
			$text = highlightWord( $conts, $keyword );
    	echo "<td align=char>".$text."<br>".$clength."</td>";
		}
		else { 
			//$text = htmlspecialchars ( $row['contents'] );
			$clength = "[".mb_strlen($row['contents'])."]";
			$text = $row['contents'];
    	//echo "<td align=char>" . $row['contents'] ."</td>";
    	echo "<td align=char>".$text."<br>".$clength."</td>";
		}

    echo "<td align=left style='width:2%; font-size: 10px;'>".$row['paymethod']."</td>";

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
    echo "<td><input type=button onClick=window.open('edit.php?seqno=".$seqno."','_blank','width=500,height=1200,left=150,top=200,toolbar=1,status=1,'); value='Edit'></td>";

    echo "<td align=left style='font-size: 10px;'>-</td>";

    echo "</tr>";
}
$from = $from + $count;
$prev_from = $from - ($count*2);
echo "<tr><td align=right style='font-size: 10px;'><a href='myevents.php?from=0&count=120'>Top Page</a></td>";
echo "<td align=right style='font-size: 10px;'><a href='myevents.php?from=".$prev_from."&count=".$count."'>Prev Page</a></td>";
echo "<td></td>";
echo "<td align=right style='font-size: 10px;'><a href='myevents.php?from=".$from."&count=".$count."'>Next Page</a></td>";
echo "<td align=right style='font-size: 10px;'><a href='myevents.php?from=0&count=5000'>Last Page</a></td>";
echo "<td></td>"; //echo "<input type='submit' style='position: absolute; left: -9999px'/></td>";
echo "<td align=center colspan=12><input type=button style='width: 150px' onClick=window.open('new.php','_blank','width=500,height=900,toolbar=1,status=1,'); value='Add'></td></tr>";
echo "</table>";
echo "<table>";
echo "<td align=right style='font-size: 10px;'>";
//echo "<form action='myevents.php?from=".$from."&count=".$count."&keyword='><input type='text' name='keyword' value='검색어'/><input type='submit'/></form></td>";
echo "<form action='myevents.php?&keyword='><input type='text' name='keyword' value='keyword'/><input type='submit'/></form></td>";
echo "</table>";

mysqli_close($conn);


?>
</p>
</html>
