<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>New Record</title>
<link rel="stylesheet" href="css/style.css" />
</head>

<style>
body { text-align:left; }
form { margin:0; padding:0; }
.event_box { width:450px; height:550px; padding:10px; margin: 0; text-align:left; border:3px solid #4d7087; 
.event_box > div { clear:left; }
.event_box div div.label { float:left; width:10%; margin:0 auto; } /* 항목 이름*/
.event_box div div.input { float:both; width:100%; margin:0 auto; } /* 입력 값 */
.event_box div contents { float:left; width:50%; height:80% margin:0 auto; } /* contents 입력 값 */
.event_box .btnbox { clear:both; padding:30px; text-align:left; } /* 버튼 */
</style>

<!--
h1 {
	color: red;
	font-size: 5em;
}
-->
</style>

<body>
<?php
require('db.php');
mysqli_set_charset($conn,'utf8');

$query = "SELECT * from myevents where seqno='".$seqno."'"; 

$result = mysqli_query($conn, $query) or die ( mysqli_error());
if(!$result) echo $query."<br />";

$row = mysqli_fetch_array($result);
$pageName = basename($_SERVER['PHP_SELF']);
echo "<h1>".$pageName."</h1>";
?>

<div class="event_box">
	<form target="_blank" name="insert" action="insert.php" method="post" enctype='multipart/form-data' accept-charset='UTF-8'>
		<div>
			<div class="label">edate</div>
			<div class="input"><input type="date" name="date" value="<?php echo date('Y-m-d'); ?>"</div>
		</div>

		<div>
			<div class="label">etype</div>
			<div class="input">
				<select name="type">
					<option value="운동">산행</option>
					<option value="DIARY">DIARY</option>
					<option value="TODO">TODO</option>
					<option value="독서">독서</option>
					<option value="가족">가족</option>
					<option value="운동">운동</option>
					<option value="CFD">CFD</option>
					<option value="굴대리회">굴다리회</option>
					<option value="GOODS">GOODS</option>
					<option value="APPO">APPO</option>
					<option value="IDEA">IDEA</option>
					<option value="TIP">TIP</option>
					<option value="CLIMATE">기상</option>
					<option value="DUES">DUES</option>
				</select>		
			</div>
		</div>

		<div>
			<div class="label">contents (max 8192)</div>
			<textarea id="contents" name="contents" rows="15" cols="50" class="input" WRAP></textarea>			
		</div>
		
		<div>
			<div class="label">paymethod</div>
			<div class="input">
				<select name="paymethod">
					<option selected value="">-</option>
					<option value="현대카드">현대카드</option>
					<option value="카뱅">카뱅</option>
					<option value="현대카드">삼성카드</option>
					<option value="카카오페이">카카오페이</option>
					<option value="농협(법인)">농협(법인)</option>
					<option value="농협체크(법인)">농협체크(법인)</option>
					<option value="우체국체크(개인)">우체국체크(개인)</option>
					<option value="현금">현금</option>
					<option value="국민법인">국민법인</option>
			  </select>		
			</div>
		</div>

		<div>
			<div class="label">price</div>
			<div class="input"><input type="number" name="price" value=""></div>
		</div>
		
		<div>
			<div class="label">volume</div>
			<div class="input"><input type="number" name="volume" min="0" max="100" value=""></div>
		</div>

		<div>
			<div class="label">remark</div>	
			<div class="input"><input type="text" name="remark" value=""></div>
		</div>

		<div>
			<div class="label">market</div>
			<div class="input"><input type="text" name="market" value=""></div>
		</div>
<!--
		<form action='upload_file.php' method='post' enctype='multipart/form-data' accept-charset='UTF-8'>
			<div class="label">file</div>
			<input type='file' name='file' id='file'><br>
		</form>
-->
		<div class="btnbox"><input type="submit" value="submit" onclick="self.close(); return insert();"></div> 
		<!-- <div class="btnbox"><input type="submit" value="submit" onclick="self.close();"></div> -->
	 </form>
</div>


<script>
function close_window(){
    close();
}

function insert()
{
	if(document.getElementById("contents").value==null || document.getElementById("contents").value=="") {
		alert("blank text area")
		return false;
	}
	else {
		close();
		return true;
	}
	close();
} 
</script>
</body>

<br />

<br /><center><input type="button" align=center onClick="self.close();" value="Close this window"></center>
</html> 
<!--
<input type="submit" value="submit">
-->
