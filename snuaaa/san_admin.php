<html>
  <head>
    <title>SanDiary</title>
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

<form action="search_admin.php" target="search_frame" method="post">
    <input type="text" autocomplete="on" id="keyword1" name="keyword1" required placeholder="검색어1"  border="3" style="width:170px;height:40px;font-size:20px; background-color: #88ccff;">
    <input type="text" autocomplete="on" id="keyword2" name="keyword2" placeholder="검색어2"  border="3" style="width:170px;height:40px;font-size:20px; background-color: #90ee90;">
    <input type="submit" border="3" style="width:70px;height:40px;font-size:20px;">
		<!-- <br>
		<input type="date" id="edate" name="edate" value="<?php// echo date('Y-m-d'); ?>">
    2. 일자로 검색 <input type="submit" border="3" style="width:70px;height:40px;font-size:20px;"> -->
</form>
예) 검색어1=이동수 검색어2=설악산 으로 검색하면 이동수의 설악산 산행 모두 검색
<iframe name="search_frame" src="search_admin.php"  width="100%" height="100%" class="search_frame"></iframe>

<script type="text/javascript" language="javascript">
$('.my-iframe').css('height', $(window).height()+'px');
</script>
</html>

