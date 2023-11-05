<?php
header("Content-Type:text/html; charset=utf-8");
include ('db.php');
$keyword1 = $_POST['keyword1'];
$keyword2 = $_POST['keyword2'];


$mAgent = array("Android","iPhone","iPad","Blackberry","Opera Mini","Windows ce","SonyEricsson","webOS","PalmOS","Nokia","Sony","Windows");
$agent = $_SERVER['HTTP_USER_AGENT'];
//echo $agent . "<br>";
$terminal = "";
for($i=0; $i<sizeof($mAgent); $i++){
	if(stripos($_SERVER['HTTP_USER_AGENT'],$mAgent[$i])){
		$terminal = $mAgent[$i];
		break;
	}
}

$table = "client_log";
$ip = get_client_ip();

if( $keyword1 == "" )
{
	//$query="SELECT * from mlog order by RAND() limit 5";
	$query1="SELECT * FROM mlog ORDER BY RAND() LIMIT 1";
  $query2 = "INSERT INTO $table (ipaddress, keyword1, keyword2, terminal, agent, connect_time) VALUES ('$ip', '$keyword1', '$keyword2', '$terminal', '$agent', CURRENT_TIMESTAMP)";
}
else if ($keyword2 == "")
{
	$query1 = "SELECT * FROM mlog WHERE contents LIKE '%" . $keyword1 . "%'  ORDER BY edate DESC, seqno DESC";
	$query2="INSERT INTO $table (ipaddress,keyword1,keyword2,terminal,agent,connect_time) VALUES ('$ip', '$keyword1', '$keyword2', '$terminal', '$agent', CURRENT_TIMESTAMP)";
}
else if ($keyword2 != "")
{
	$query1 = "SELECT * FROM mlog WHERE (contents LIKE '%" . $keyword1 . "%' ) AND (contents LIKE '%" . $keyword2 . "%' ) ORDER BY edate DESC, seqno DESC";
  $query2 = "INSERT INTO $table (ipaddress,keyword1,keyword2,terminal,agent,connect_time) VALUES ('$ip', '$keyword1', '$keyword2', '$terminal', '$agent', CURRENT_TIMESTAMP)";
}
//echo $query1 . "<br>";
//echo $query2 . "<br>";

$result1=mysqli_query($conn,$query1) or die(mysqli_error());
$result2=mysqli_query($conn,$query2) or die(mysqli_error());

$row_cnt = mysqli_num_rows($result1);

$keywordsearch = 1;
echo "<table border='2'>";
echo "<colgroup>";
echo "<col style='width:1%;'>"; //NO
echo "<col style='width:10%;'>"; //일자
echo "<col style='width:5%;'>"; //경과년
echo "<col style='width:5%;'>"; //경과일
echo "<col style='width:5%;'>"; //SN
echo "<col style='width:70%;'>"; //내용
echo "</colgroup>";

echo "<tr style='color: gray;'>";
echo "<tr><td></td><td>검색결과</td><td>".$row_cnt."건</td></tr>";
echo "<th align='center' strong style='font-size: 15px;'>NO</th>";
echo "<th align='center' strong style='font-size: 15px;'>일자</th>";
echo "<th align='center' strong style='font-size: 15px;'>경과년</th>";
echo "<th align='center' strong style='font-size: 15px;'>경과일</th>";
echo "<th align='center' strong style='font-size: 15px;'>고유번호</th>";
echo "<th align='center' strong style='font-size: 15px;'>내용</th>";
echo "</tr>";

$no=0;
$today = new DateTime(date("Y-m-d"));

while( $row = mysqli_fetch_array($result1) )
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
			$wordsToHighlight = array($keyword1, $keyword2);
			$text = highlightWords($conts, $wordsToHighlight);
			//$text = highlightWords( $conts, $keyword1 );
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

function highlightWords($content, $words) {
		$i = 0;
    foreach ($words as $word) {
				if($i == 0) 
        	$replace = "<span style='background-color: #88ccff;'>" . $word . "</span>"; // create replacement
				else if($i == 1) 
        	$replace = "<span style='background-color: #90EE90;'>" . $word . "</span>"; // create replacement
        $content = str_replace($word, $replace, $content); // replace content
				$i++;
    }
    return $content;
}

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

function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

?>
</p>
</html>
