<?php

require('dbconn.php');
//include("auth.php");
$seqno=$_REQUEST['seqno'];
mysqli_set_charset($con,'utf8');

$query = "SELECT * from todo where seqno='".$seqno."'"; 

$result = mysqli_query($conn, $query) or die ( mysqli_error());
if(!$result) echo $query."<br />";

$row = mysqli_fetch_array($result);

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Edit Record</title>
<!-- <link rel="stylesheet" href="css/style.css" /> -->
</head>
<body>
<style>
body { text-align:left; }
form { margin:0; padding:0; }
</style>

<h1 align="left">Edit ToDo</h1>
<?php
$pageName = basename($_SERVER['PHP_SELF']);
echo "<h1>[".$pageName."]</h1>";
$seqno=$_GET['seqno'];
require ('dbconn.php');
$query="SELECT * FROM todo WHERE seqno=$seqno";
$ret=mysqli_query($conn,$query);
$row=mysqli_fetch_array($ret);
?>

<form name="form_name" action="save.php" method="post">
	번호: <?php echo $seqno;?>
	<!-- <div>
		<div class="label">Type</div>
		<div class="input"><input type="text" name="type" value="<?php echo $row['type'];?>"></div>
	</div>
	-->
	<p>
	제목: <input type="text" name="title" value="<?php echo $row['title'];?>">
	<p>
	시작일: <input type="date" name="start" value="<?php echo $row['start'];?>">
	<p>
	목표일: <input type="date" name="target" value="<?php echo $row['target'];?>">
	<p>
	내용
	<p>
	<textarea name="detail" rows="10" cols="50"><?php echo $row['detail'];?></textarea>
	<p>
	Clear: <input type="text" name="clear" value="<?php echo $row['clear'];?>"></div>
	<p>
	<input type="submit" value="save">
</form>

<script>
function senddata(f){
 if(f.name.value == "") {
  alert("이름을 입력하지 않았습니다.");
  return false;
 }
 if(!f.sex[0].checked && !f.sex[1].checked) {
  alert("성별을 입력하지 않았습니다.");
  return false;
 }
 if(f.birth.value == "") {
  alert("생년월일을 입력하지 않았습니다.");
  return false;
 }
 if(f.intro.value == "") {
  alert("소개를 입력하지 않았습니다.");
  return false;
 }

 f.action = "save.php";
 f.submit();
}
/*
function senddata(f){
	if(f.type.value == "") {
		alert("Type을 입력하지 않았습니다.");
		return false;
	}

	if(f.start.value == "") {
		alert("시작일을 입력하지 않았습니다.");
		return false;
	}
 
	if(f.end.value == "") {
		alert("종료일을 입력하지 않았습니다.");
		return false;
	}
 
	if(f.intro.detail == "") {
		alert("소개를 입력하지 않았습니다.");
		return false;
	}

	f.action = "save.php";
	alert("save 헀습니다.");
	f.submit();
}
*/
</script>

<script>
function myFunction() {
	var copyText = document.getElementById("myInput");
	copyText.select();
	document.execCommand("copy");
	//alert("Copied the text: " + copyText.value);
}
</script>

</body>

<br />
<input align="center" type=button onClick="self.close();" value="Close this window">
</html> 