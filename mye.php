<?php

function highlightWord( $content, $word ) {
    $replace = "<span style='background-color: #88ccff;'>" . $word . "</span>"; // create replacement
    $content = str_replace( $word, $replace, $content ); // replace content

    return $content; // return highlighted data
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

//$result=mysqli_query($conn,$query) or die(mysqli_error());

$prev_from = $from - ($count*2);

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
echo "<col style='width:1%;'>"; // NO
echo "<col style='width:10%;'>"; // date
echo "<col style='width:10%;'>"; //경과일월년
echo "<col style='width:5%;'>"; // type
echo "<col style='width:5%;'>"; // del
echo "<col style='width:5%;'>"; // SN 
echo "<col style='width:40%;'>"; // contents
echo "<col style='width:2%;'>"; // paymethod
echo "<col style='width:2%;'>"; // price
echo "<col style='width:2%;'>"; // vol
echo "<col style='width:2%;'>"; // unit price
echo "<col style='width:2%;'>"; // remark
echo "<col style='width:2%;'>"; // market
echo "<col style='width:2%;'>"; // file
echo "<col style='width:2%;'>"; // edit
echo "<col style='width:2%;'>"; // end
echo "</colgroup>";

echo "<tr style='color: gray;'>";
echo "<th align='center' strong style='font-size: 10px;'>NO</th>";
echo "<th align='center' strong style='font-size: 10px;'>일자</th>";
echo "<th align='center' strong style='font-size: 10px;'>경과일</th>";
echo "<th align='center' strong style='font-size: 10px;'>구분</th>";
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

$no = 0;
$today = date('Y-m-d');
$targetDate = date('Y-m-d',strtotime('-560 month', strtotime($today)));
$currentDate = $today;

while ($currentDate >= $targetDate) 
{
		$query="SELECT * FROM myevents WHERE edate='" . $currentDate . "'";
		$result=mysqli_query($conn,$query) or die(mysqli_error());
		$rowCount = mysqli_num_rows($result); 
    
		$weekday = date("N", strtotime($currentDate));
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

		$date1 = date_create($currentDate);
		$date2 = date_create($today);
		$diff = date_diff($date1, $date2);
		$years = $diff->format("%y");
		$months = $diff->format("%m");
		$days = $diff->format("%d");

		if ($years > 0 || $months > 0) {
    		$span = ($years > 0 ? $years . " year" . ($years > 1 ? "s" : "") : "") . " " .
              ($months > 0 ? $months . " month" . ($months > 1 ? "s" : "") : "") . " " .
              ($days > 0 ? $days . " day" . ($days > 1 ? "s" : "") : "");
		} else {
    		$span = $days . " day" . ($days > 1 ? "s" : "");
		}

		if($rowCount < 1)
		{
    	echo "<tr style='color: gray'><td align='center' style='font-size: 9px;'>-</td>";
			$s = trim(substr($currentDate,-10,10)).trim($dname);
    	if($weekday > 5) echo "<td align='center' style='width:5%; font-size: 10px; color:red;'>".$s."</th>";
    	else echo "<td align='center' style='width:5%; font-size:10px;'>".substr($currentDate,-10,10).$dname."</td>";
    	if($currentDate > $today) {
        echo "<td align='center' strong  style='background-color:yellow; font-size: 10px;'>".$span."</td>";
    	} else if($currentDate == $today) {
        echo "<td align='center' strong  style='background-color:green; font-size: 10px;'>".$span."</td>";
    	} else {
        echo "<td align='center' style='font-size: 10px;'>".$span."</td>";
    	}
			echo "<td></td><td></td><td></td><td></td><td></td></td>";
			echo "<td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
		}
		else // $rowCount>0
		{
		while( $row = mysqli_fetch_array($result) )
		{		
    $seqno=$row['seqno'];
    $contents=$row['contents'];
		$no++;
    echo "<tr style='color: gray'><td align='center' style='font-size: 9px;'>".$no."</td>";
		$s = trim(substr($currentDate,-10,10)).trim($dname);
    if($weekday > 5) echo "<td align='center' style='width:5%; font-size: 10px; color:red;'>".$s."</th>";
    else echo "<td align='center' style='width:5%; font-size:10px;'>".substr($currentDate,-10,10).$dname."</td>";
   
    if($currentDate > $today) {
        echo "<td align='center' strong  style='background-color:yellow; font-size: 10px;'>".$span."</td>";
    } else if($currentDate == $today) {
        echo "<td align='center' strong  style='background-color:green; font-size: 10px;'>".$span."</td>";
    } else {
        echo "<td align='center' style='font-size: 10px;'>".$span."</td>";
    }

    echo "<td align='center' style='width:0%; font-size: 10px;'>".$row['etype']."</td>";

    echo "<td align='center'><a onClick=\"javascript: return confirm('Delete [".$seqno."] ".iconv_substr($contents,0,10,"utf-8")." ?');\" href='delete.php?seqno=".$seqno."&from=".$from."&count=".$count."'>x</a></td>"; //use double quotes for js inside php!
    echo "<td align='center' style='font-size: 10px;'>".$row['seqno']."</td>";
    //echo "<td align=char style='font-size: 20px;'>".$row['contents']."</td>";
    // contents
		if ($keywordsearch == 1) {
			$clength = "[".mb_strlen($row['contents'])."]";
			$conts =  htmlspecialchars ( $row['contents'] );
			$text = highlightWord( $conts, $keyword );
    	//echo "<td align=char>".$text."<br>".$clength."</td>";
    	echo "<td align=char>".$text."</td>";
		}
		else { 
			//$text = htmlspecialchars ( $row['contents'] );
			$clength = "[".mb_strlen($row['contents'])."]";
			$text = $row['contents'];
    	//echo "<td align=char>" . $row['contents'] ."</td>";
    	//echo "<td align=char>".$text."<br>".$clength."</td>";
			if($row['etype'] == '과음')
				$text = "<span style='background-color: #FFCCCB;'>" . $text . "</span>"; // create replacement
    	echo "<td align=char>".$text."</td>";
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
		} // while	
		} // if else
		$currentDate = date('Y-m-d', strtotime('-1 day', strtotime($currentDate)));

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
