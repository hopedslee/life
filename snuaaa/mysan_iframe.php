<html>
<STYLE TYPE="text/css">
table {font-size: 12pt;}
</STYLE>
<STYLE TYPE="text/css">
table {font-size: 375%;}
</STYLE>
<BODY>
<?php

$acno=$_POST["acno"];
$span=$_POST["span"];

switch ($span) {
    case 0:
        $nrows=22;
        break;
    case 1:
        $nrows=62;
        break;
    case 2:
        $nrows=242;
        break;
    case 3:
        $nrows=1202;
        break;
        default:
        $nrows=22;
}

require('db.php');

$up="<b style='color:blue;'>▲</b>";
$dn="<b style='color:red;'>▼</b>";

////API Url
$url = 'https://quotation-api-cdn.dunamu.com/v1/forex/recent?codes=FRX.KRWUSD';
$result = get($url);
$data = json_decode($result,TRUE);
$data = $data[0];

//echo $result;
$_provider = $data['provider'];

$_buying = $data['cashBuyingPrice'];
$_selling = $data['cashSellingPrice'];
$_ttselling = $data['ttSellingPrice'];
$_ttbuyling = $data['ttBuyingPrice'];
$_usd = $data['basePrice'];
$_openusd = $data['openingPrice'];
$_chusd = $data['changePrice'];
$_openusd_o = $_usd - $_openusd;
$_openusd_op = ($_chusd/$_usd)*100;
$_openusd = round($_openusd,2);

if ($_openusd_o > 0) {
    $_openusd_p = '<font color="#ff0000">+'.sprintf('%0.2f',$_usd).' 원 <small>▲ +'
       .sprintf('%0.2f',$_chusd).'원 ('.sprintf('%0.2f',$_openusd_op).'%) </small></font>';
} else if ($_openusd_o < 0) {
    $_openusd_p = '<font color="#0051c7">'.$_usd.' 원 <small>▼ '
       .sprintf('%0.2f',$_chusd).'원 ('.sprintf('%0.2f',$_openusd_op).'%) </small></font>';
} else {
    $_openusd_p = $_usd.' 원 '
        .sprintf('%0.2f',$_chusd).'원 ('.sprintf('%0.2f',$_openusd_op).'%)';
}
$_datenew = $data['date'].' '.$data['time'];

$query="SELECT acno, date FROM acctlog WHERE acno=$acno order by date asc limit 1";
$result=mysqli_query($conn,$query) or die(mysqli_error());
$row = mysqli_fetch_row($result);
$datetime1 = new DateTime($row[1]);
$datetime2 = new DateTime();
$interval = $datetime2->diff($datetime1);
$emons = (($interval->format('%y') * 12) + $interval->format('%m'));

$query="SELECT * FROM ea_heartbeat WHERE acno=$acno";
$result=mysqli_query($conn,$query) or die(mysqli_error());
$row = mysqli_fetch_assoc($result);

$query2="SELECT date, balance, profit, swap FROM acctlog WHERE acno=$acno ORDER BY date DESC LIMIT $nrows";
$result2=mysqli_query($conn,$query2) or die(mysqli_error());

if($result->num_rows > 0)
{
        echo "<table border='1'>";
        $acname=$row['acname'];
        echo "<tr><th colspan=3>".$acname."</th></tr>";
        echo "<tr><td colspan=3 align='center' strong style='font-size: 45px;'>".$row['server']."</td></tr>";
        echo "<tr><th>거래시각</th><td colspan=2 align='center'>".$row['touch_time']."</td></tr>";
				$systemtime=strtotime("-7 hours");
				echo "<tr>><th>시스템</th><td colspan=2 aligh='center'>".date("Y-m-d H:i:s",$systemtime)."</td></tr>";
        echo "<tr><td colspan=3 height='30%'></td></tr>";
        echo "<tr><th>&nbsp;(B)잔고</th><td align='right'>$".number_format($row['balance'],1)."<td align='center' strong style='font-size: 45px;'>(balance)</td></td></tr>";
        echo "<tr><td colspan=3><div style='height: 15px;'></div></td></tr>";

        $profit=$row['equity']-$row['balance']+$row['swap'];
        echo "<tr><th>(P)유동손익</th><td align='right'> $".number_format($profit,1)."</td><td align='right'>".number_format($profit/$row['balance']*100,2)."%</td></tr>";

        echo "<tr><td colspan=3><div style='height: 15px;'></div></td></tr>";

        echo "<tr><th>(E)평가금</th><th align='right' style='color: blue;'>$";
        echo number_format($row['equity'],1)."</th><td align='center' strong style='font-size: 45px;'>equity<br />=(B)+(P)</td></tr>";

        $cequity=$row['equity'];

        $eq = array();
        $i = 0;

        while( $eq_array = mysqli_fetch_array($result2) )
        {
                $eq[$i]['date']=$eq_array['date'];
                $eq[$i]['equity']=$eq_array['balance']+$eq_array['profit']+$eq_array['swap'];
                $i++;
        }

        $diff=0;

        for($c=0; $c<$i; $c++)
        {
					if($c<($nrows-1) )
        	{

         		$hist_query="SELECT sum(deposit), sum(withdrawal) FROM ordershistory WHERE account=$acno and date_format(opentime,'%Y-%m-%d')='".$eq[$c]['date']."' and (deposit>0 or withdrawal>0)";
           $hist_result=mysqli_query($conn,$hist_query) or die(mysqli_error());
           $hist_row = mysqli_fetch_array($hist_result);

           $diff = $eq[$c]['equity'] - $eq[$c+1]['equity'] - $hist_row[0] + $hist_row[1];
           if( $diff > 0 ) $sym = $up;
           else if($diff < 0) $sym = $dn;
           else $sym="";

           $weekday=date_name($eq[$c]['date']);
           echo "<tr><td align='left' strong style='font-size: 45px;'>".$eq[$c]['date']."(".$weekday.")</td>";
           echo "<td align='right'>$".number_format($eq[$c]['equity'],1)."&nbsp;</td>";
           //if($hist_result->num_rows > 0)
           if($hist_row[0]>0 or $hist_row[1]>0)
           {
           if($hist_row[0]>0)
           echo "<td align='right' strong style='font-size: 40px;'>".$sym.number_format($diff, 1).'<br />입금 $'.number_format($hist_row[0],1).'&nbsp;</td>';
           if($hist_row[1]>0)
           echo "<td align='right' strong style='font-size: 40px;'>".$sym.number_format($diff, 1).'<br />출금 $'.number_format($hist_row[1],1).'&nbsp;</td>';
           }
           else
           {
           echo "<td align='right'>".$sym.number_format($diff, 1).'</td>';
           }
           echo "</tr>";

     		}
			}
        //echo "<tr><td align='right'>".number_format(($row['equity']-$bequity)/$bequity*100,2)."%</td></tr>";
      echo "<tr><td colspan=3><div style='height: 15px;'></div></td></tr>";

      echo "<tr><th>&nbsp;&nbsp;&nbsp;마진레벨&nbsp;&nbsp;&nbsp;</th><td align='right'>".number_format($row['ml'],0)."% </td><td></td></tr>";
      $ml=$row['ml'];
      if($row['orders']==0) $wable=$row['equity'];
      else $wable=$row['equity'] * ((100 - (1000 / ($ml/100))) / 100 ) * 0.6;
      echo "<tr><th style='color: red;'>&nbsp;&nbsp;출금가능액&nbsp;&nbsp;</th><td align='right'>$".number_format($wable,0)."</td><td></td></tr>";
      echo "<tr><th>통화쌍</th><td align='right'>".number_format($row['CPs'],0)."개 </td><td></td></tr>";
      echo "<tr><th>주문수</th><td align='right'>".number_format($row['orders'],0)."개 </td><td></td></tr>";
      echo "<tr><th>입금</th><td align='right'>$".number_format($row['deposit'],0)."</td><td></td></tr>";
      echo "<tr><th>출금</th><td align='right'>$".number_format($row['withdrawal'],0)."</td><td></td></tr>";
        $gain = $row['equity']-$row['deposit']+$row['withdrawal'];
        $gain_krw = $gain * $_selling;

        $prate=$gain/$row['deposit'] * 100;
        echo "<tr><th>수익</th><td align='right'>$".number_format($gain,0). "</td><td align='left' strong style='font-size: 30px;'>수익율: "
         . number_format($prate,2) . "%<br>" . $emons . "개월, " . number_format($prate/$emons,2) . "%/월</td></tr>";

        echo "</table>";

        $mAgent = array("Android","iPhone","iPad","Blackberry","Opera Mini","Windows ce","SonyEricsson",
                                        "webOS","PalmOS","Nokia","Sony","Windows");
        $agent = $_SERVER['HTTP_USER_AGENT'];
        $terminal = "";
        for($i=0; $i<sizeof($mAgent); $i++){
                if(stripos($_SERVER['HTTP_USER_AGENT'],$mAgent[$i])){
                        $terminal = $mAgent[$i];
                        break;
                }
        }

        $table="client_log";
        $ip=get_client_ip();
        $query="INSERT INTO $table (ipaddress, account, acname, terminal, agent, connect_time) VALUES ('$ip', $acno, '$acname', '$terminal', '$agent', CURRENT_TIMESTAMP)";
        $result=mysqli_query($conn,$query) or die(mysqli_error($conn));

} // if
else
{
        echo "<table border='1'>";
        echo "<tr width='50px;'><th colspan=3 align='center'>Not Found</th></tr>";
}

echo "<h2>";
echo "수익: " . number_format($gain_krw,0) . "원 ($" . number_format($gain,0) . " x " . $_selling . "원/$)";
echo "<br>기준환율(USD $1) : " . $_openusd_p . "<br>살때 : " . sprintf('%0.2f',$_buying);
echo "원/$, 팔때 : " . sprintf('%0.2f',$_selling) . "원/$<br>Date: " . $_datenew . "(". $_provider . ")</font>";
echo "</h2>";

$encoded_acno = urlencode($acno);
echo "acno : " . $acno . " , encoded_acno : " . $encoded_acno . "<br>"; 
//$link = "dailyprofit.php?acno=$encoded_acno";
$link = "dailyprofit.php?acno=$acno";
echo "link=" . $link . "<br>";
echo "<a href=$link target='_blank'>Daily_Profit</a>";


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

function date_name($datestring)
{
        $dow=date("w", strtotime($datestring));
        //$days = array('Sun', 'Mon', 'Tue', 'Wed','Thu','Fri', 'Sat');
        $days = array('일', '월', '화', '수','목','금', '토');
        return $days[$dow];
}

function get($url){
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    if(curl_errno($ch)){
        throw new Exception(curl_error($ch));
    }
    curl_close($ch);
    return $result;
}
mysql_free_result($result2);
?>

</BODY>
</HTML>
