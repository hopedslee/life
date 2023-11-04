<?php
header("Content-Type:text/html; charset=utf-8");
include ('db.php');
$keyword = $_POST['keyword'];

//echo "<table border='0'>";
//echo "<tr><td>검색어</td><td>\"" . $keyword . "\"</td></tr>";
//echo "</table>";

$keyword = $_POST['keyword'];

/*
	 if( empty( $keyword ) {
	$query="SELECT * from mlog limit 5 order by edate desc, seqno desc";
	echo $query . '<br>';
} else {
	$query="SELECT * from mlog where contents like '%" . $keyword . "%' order by edate desc, seqno desc";
	echo $query . '<br>';
}
//echo $query . '<br>';
*/
if( $keyword == "" )
	$query="SELECT * from mlog order by RAND() limit 5";
else
	$query="SELECT * from mlog where contents like '%" . $keyword . "%' order by edate desc, seqno desc";

$result=mysqli_query($conn,$query) or die(mysqli_error());

$keywordsearch = 1;
echo "<table border='2'>";
echo "<colgroup>";
echo "<col style='width:1%;'>"; //NO
echo "<col style='width:8%;'>"; //일자
echo "<col style='width:5%;'>"; //경과년
echo "<col style='width:5%;'>"; //경과일
echo "<col style='width:5%;'>"; //SN
echo "<col style='width:70%;'>"; //내용
echo "</colgroup>";

echo "<tr style='color: gray;'>";
echo "<th align='center' strong style='font-size: 15px;'>NO</th>";
echo "<th align='center' strong style='font-size: 15px;'>일자</th>";
echo "<th align='center' strong style='font-size: 15px;'>몇년전</th>";
echo "<th align='center' strong style='font-size: 15px;'>며칠전</th>";
echo "<th align='center' strong style='font-size: 15px;'>고유번호</th>";
echo "<th align='center' strong style='font-size: 15px;'>내용</th>";
echo "</tr>";

$no=0;
$today = new DateTime(date("Y-m-d"));

while( $row = mysqli_fetch_array($result) )
{
    $seqno=$row['seqno'];
		$no++;
    //echo "<tr style='color: gray'><td align='center' style='font-size: 10px;'>".$no."</td>";
    echo "<tr><td align='center' style='font-size: 10px;'>".$no."</td>";
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
		$s = trim(substr($row['edate'],-10,10)).trim($dname);
    if($weekday > 5) echo "<td align='center' style='width:5%; font-size: 15px; color:red;'>".$s."</th>";
    else echo "<td align='center' style='width:5%; font-size:15px;'>".substr($row['edate'],-10,10).$dname."</td>";
    $event = new DateTime($row['edate']);
    $span  = date_diff($event, $today);
		
    if($event > $today) {
        //$diff = (-1) * $span->days;
        echo "<td align='center' strong  style='background-color:yellow; font-size: 10px;'><b>".$span->days*(-1)."</b></td>";
    } else if($event == $today) {
        if($row['etype']=="APPO") echo "<td align='center' strong  style='background-color:red; font-size: 15px;'><b>".$span->days."</b></td>";
        else echo "<td align='center' strong  style='background-color:green; font-size: 15px;'><b>".$span->days."</b></td>";
    } else {
        //$ddd = $span->days;
        echo "<td align='center' style='font-size: 15px;'>+".intval($span->days/365)."</td>";
    }

    echo "<td align='center' style='font-size: 15px;'>+".$span->days."</td>";
    //echo "<td align='center' style='width:0%; font-size: 5px;'>".$row['etype']."</td>";

    echo "<td align='center' style='font-size: 15px;'>".$row['seqno']."</td>";
    //echo "<td align=char style='font-size: 20px;'>".$row['contents']."</td>";
    // contents
		if ($keywordsearch == 1) {
			$clength = "[".mb_strlen($row['contents'])."]";
			$conts =  htmlspecialchars ( $row['contents'] );
			//$conts =  substr($row['contents'],0,300) ;
			$text = highlightWord( $conts, $keyword );
    	//echo "<td align=char>".$text."<br>".$clength."</td>";
    	echo "<td align=char>".$text."</td>";
		}
		else { 
			//$text = htmlspecialchars ( $row['contents'] );
			$clength = "[".mb_strlen($row['contents'])."]";
			$text = $row['contents'];
    	//echo "<td align=char>" . $row['contents'] ."</td>";
    	echo "<td align=char>".$text."<br>".$clength."</td>";
    	//echo "<td align=char>".$text."</td>";
		}

    //echo "<td align=left style='font-size: 10px;'>".$row['remark']."</td>";

    echo "</tr>";
		
}
echo "</table>";

mysqli_close($conn);

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

?>
</p>
</html>
