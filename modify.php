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
<title>Modify Record</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>

<style>
body { text-align:left; }
form { margin:0; padding:0; }

.todo_box { width:500px; padding:10px; margin:auto; text-align:left; border:5px solid #4d7087; } /* 테두리 */
.todo_box > div { clear:both; }
.todo_box div div.label { float:left; width:10%; margin:0 auto; } /* 항목 이름*/
.todo_box div div.input { float:left; width:90%; margin:0 auto; } /* 입력 값 */
.todo_box .btnbox { clear:both; padding:30px; text-align:center; } /* 버튼 */
</style>
<!--
<div class="form">
<p><a href="dashboard.php">Dashboard</a> | <a href="view.php">View Records</a> | 
<a href="insert.php">Insert New Record</a> | <a href="logout.php">Logout</a></p>
-->
<h1>Modify Record</h1>
<?php
$seqno=$_GET['seqno'];
require ('dbconn.php');
$query="SELECT * FROM todo WHERE seqno=$seqno";
$ret=mysqli_query($conn,$query);
$row=mysqli_fetch_array($ret);
?>

<div class="todo_box">
	<form name="form_name" action="save.php" method="post">
		<div>
			<div class="label">번호</div>
			<div class="input"><input type="text" readonly name="seqno" value="<?php echo $seqno;?>"></div>
		</div>
		<div>
			<div class="label">Type</div>
			<div class="input"><input type="text" name="type" value="<?php echo $row['type'];?>"></div>
		</div>
		<div>
			<div class="label">Title</div>
			<div class="input"><input type="text" name="title" value="<?php echo $row['title'];?>"></div>
		</div>
		<div>
			<div class="label">시작일</div>
			<div class="input"><input type="date" name="start" value="<?php echo $row['start'];?>"></div>
		</div>

		<div>
			<div class="label">목표일</div>
			<div class="input"><input type="date" name="target" value="<?php echo $row['target'];?>"></div>
		</div>

		<label for="intro">Detail</label>
		<textarea id="detail" name="detail" rows="10" cols="50"><?php echo $row['detail'];?></textarea>

		<div>
			<div class="label">Clear</div>
			<div class="input"><input type="text" name="clear" value="<?php echo $row['clear'];?>"></div>
		</div>

		<div class="btnbox"><input type="submit" value="save"></div>
	 </form>
</div> <!-- endof todo_box -->

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
<left><input type=button onClick="self.close();" value="Close this window"></center>
</html> 