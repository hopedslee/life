<html>
  <head>
    <title>산행일지</title>
  </head>

  <body bgcolor=white>
  <table border="0" cellpadding="10">
    <tr>
      <td align=center>
        <a href="http://139.150.64.222/life/snuaaa/mysan.php"><img src="images/fx_logo2.jpg"></a>
      </td>
    </tr>
  </table>
  </body>

<head><meta charset="utf-8"></head>

<style>
label { display: block; width: 100px; }

.center-block {
  display: block;
  margin-right: auto;
  margin-left: auto;
}
</style>

<script>
var userAgent = navigator.userAgent.toLowerCase(); // 접속 핸드폰 정보
// 모바일 홈페이지 바로가기 링크 생성
if(userAgent.match('iphone')) {
    document.write('<link rel="apple-touch-icon" href="/images/dsrlogo72x72.png" />')
} else if(userAgent.match('ipad')) {
    document.write('<link rel="apple-touch-icon" sizes="72*72" href="/images/dsrlogo72x72.png" />')
} else if(userAgent.match('ipod')) {
    document.write('<link rel="apple-touch-icon" href="/images/dsrlogo72x72.png" />')
} else if(userAgent.match('android')) {
    document.write('<link rel="shortcut icon" href="/images/dsrlogo72x72.png" />')
}
</script>

<img src="images/header-<?php $random = rand(1,89); echo $random; ?>.jpg" />

<!-- <h1>출금시 평가받는 수고를 덜어드리고, 거래 위험성을 줄이기 위해 하단에 '출금가능액'란을 추가했습니다. 특히 평가금의 80%~전액을 출금하실 경우, 사전에 반드시 통보해 주셔야 합니다.</h1> -->
<!-- <h1>하단에 '출금가능액'란을 추가했습니다. 특히 평가금의 80%~전액을 출금하실 경우, 사전에 반드시 통보해 주셔야 합니다.</h1> -->
<!-- <h1>길을 아는 것과 그 길을 걷는 것은 분명히 다르다 - 모피어스 <영화 매트릭스></h1> -->
<?php

$mentFile = "wisesaying.txt";
$fp = fopen($mentFile, "r");
while(!feof($fp)) $ment[] = fgets($fp, 1024);
$key = array_rand($ment);
echo "<br />";
echo "<b>". $text_this=$ment[$key] . "</b>";
echo "<br />";;

echo "<br />";;


date_default_timezone_set('Asia/Seoul');
$thistime=date("Y-m-d H:i:s");
$systemtime=strtotime("-7 hours");
$londontime=strtotime("-9 hours");
$newyorktime=strtotime("-13 hours");
echo "<br /><style>font-size:100px; (SYS): ".date("Y-m-d H:i:s",$systemtime)."</style><br />";
//echo "(KOR): ".$thistime."<br />";
//echo "(LON): ".date("Y-m-d H:i:s",$londontime)." / ";
//echo "(N Y): ".date("Y-m-d H:i:s",$newyorktime)."<br /><br />";
function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
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

<form action="mysan_iframe.php" target="my-iframe" method="post">
    <input type="number" autocomplete="on" id="acno" name="acno" required  placeholder="계좌번호.."  border="3" style="width:370px;height:80px;font-size:50px;">
        &nbsp;&nbsp;
        <!-- <label for="span"  border="3" style="width:370px;height:80px;font-size:50px;">조회:</label> -->
        <select name="span" id="span" align="center" style="width:225px;height:80px;font-size:45px;">
                <option align="center" value="0" selected="selected" style="text-align: center;">조회기간</option>
                <option align="center" value="0" style="text-align: center;">최근1개월</option>
                <option align="center" value="1">최근3개월</option>
                <option align="center" value="2">최근1년</option>
                <option align="center" value="3">전체</option>
        </select>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="submit" value="&nbsp;OK&nbsp;&nbsp;&nbsp;&nbsp;" align="center" style="width:90px;height:80px;font-size:45px;">
</form>

<iframe name="my-iframe" src="account_iframe.php"  width="100%" height="100%" class="my-iframe"></iframe>

<script type="text/javascript" language="javascript">
$('.my-iframe').css('height', $(window).height()+'px');
</script>
</html>

