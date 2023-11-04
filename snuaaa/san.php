<html>
  <head>
    <title>Search 60 diary</title>
  </head>

  <body bgcolor=white>
	<a href="#"><img src="images/logo2.jpg" style="margin-left: left; margin-right: auto; display: block;"/></a>
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
<!-- <img src="images/header-<?php $random = rand(1,89); echo $random; ?>.jpg" style="height: 20%"/> -->

<?php
//date_default_timezone_set('Asia/Seoul');
//$thistime=date("Y-m-d H:i:s");
//$systemtime=strtotime("-7 hours");
//$londontime=strtotime("-9 hours");
//$newyorktime=strtotime("-13 hours");
//echo "<br /><style>font-size:100px; (SYS): ".date("Y-m-d H:i:s",$systemtime)."</style><br />";
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

<form action="search.php" target="search_frame" method="post">
    <input type="text" autocomplete="on" id="keyword" name="keyword" required  placeholder="검색어"  border="3" style="width:270px;height:40px;font-size:20px;">
    <input type="submit" border="3" style="width:270px;height:40px;font-size:20px;">
</form>

<iframe name="search_frame" src="search.php"  width="100%" height="100%" class="search_frame"></iframe>

<script type="text/javascript" language="javascript">
$('.my-iframe').css('height', $(window).height()+'px');
</script>
</html>

