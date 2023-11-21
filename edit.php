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
.event_box { width:450px; height:550px; padding:10px; margin: 0; text-align:left; border:3px solid #4d7087; } /* 테두리 */
.event_box > div { clear:left; }
.event_box div div.label { float:left; width:10%; margin:0 auto; } /* 항목 이름*/
.event_box div div.input { float:both; width:100%; margin:0 auto; } /* 입력 값 */
.event_box div contents { float:left; width:40%; margin:0 auto; } /* contents 입력 값 */
.event_box .btnbox { clear:both; padding:30px; text-align:left; } /* 버튼 */
.event_box div div.img { clear:both; max-width: 100%; display: block; margin: 0px 0px 500px 0px; } 

</style>

<?php
$pageName = basename($_SERVER['PHP_SELF']);
echo "<h1>[".$pageName."1.02]</h1>";
$seqno=$_GET['seqno'];

require ('db.php');

if (!empty($_POST["date"])) $date=$_POST["date"]; else $date=date("Y-m-d");
if (!empty($_POST["type"])) $type=$_POST["type"]; else $type="DIARY";
if (!empty($_POST["contents"])) $contents=$_POST["contents"]; else $contents="";
if (!empty($_POST["paymethod"])) $paymethod=$_POST["paymethod"]; else $paymethod=NULL;
if (!empty($_POST["price"])) $price=$_POST["price"]; else $price=0;
if (!empty($_POST["volume"])) $volume=$_POST["volume"]; else $volume=0;
if (!empty($_POST["remark"])) $remark=$_POST["remark"]; else $remark=NULL;
if (!empty($_POST["market"])) $market=$_POST["market"]; else $market=NULL;
if (!empty($_POST["file"])) $file=$_POST["file"]; else $file=NULL;

$query="SELECT * FROM myevents WHERE seqno=$seqno";
$ret=mysqli_query($conn,$query);
$row=mysqli_fetch_array($ret);
$contents = $row['contents'];
$type=$row['etype'];
$paymethod=$row['paymethod'];
$path = "files/" . $row['filename'];
$ext = pathinfo($path, PATHINFO_EXTENSION);
//echo $path . "</br />";
?>

<img src="<?php echo $path;?>" style="width: 250px; height:auto;" alt="">

<div class="event_box">
	<form name="form_name" action="save.php" method="post">
		<div>
			<div class="label">Seqno</div>
			<div class="input"><input type="text" readonly name="seqno" value="<?php echo $seqno;?>"></div>
		</div>
		
		<div>
			<div class="label">edate</div>
			<div class="input"><input type="date" name="date" value="<?php echo $row['edate'];?>"></div>
		</div>
		
		<div>
			<div class="label">etype</div>
			<div class="input">
			    <select name="type">
					<option value="" disabled selected>Select a type</option>
					<option value="운동" <?php if($type == "운동") echo "selected='selected'"; ?>>운동</option>
					<option value="Defecate" <?php if($type == "Defecate") echo "selected='selected'"; ?>>Defecate</option>
					<option value="산행" <?php if($type == "산행") echo "selected='selected'"; ?>>산행</option>
					<option value="산행" <?php if($type == "진료") echo "selected='selected'"; ?>>산행</option>
					<option value="TODO" <?php if($type == "TODO") echo "selected='selected'"; ?>>TODO</option>
					<option value="DIARY" <?php if($type == "DIARY") echo "selected='selected'"; ?>>DIARY</option>
					<option value="독서" <?php if($type == "독서") echo "selected='selected'"; ?>>독서</option>
					<option value="과음" <?php if($type == "과음") echo "selected='selected'"; ?>>과음</option>
					<option value="가족" <?php if($type == "가족") echo "selected='selected'"; ?>>가족</option>
					<option value="굴다리회" <?php if($type == "굴다리회") echo "selected='selected'"; ?>>굴다리회</option>
					<option value="EXPEND" <?php if($type == "EXPEND") echo "selected='selected'"; ?>>EXPEND</option>
					<option value="GOODS" <?php if($type == "GOODS") echo "selected='selected'"; ?>>GOODS</option>
					<option value="CFD" <?php if($type == "CFD") echo "selected='selected'"; ?>>CFD</option>
					<option value="APPO" <?php if($type == "APPO") echo "selected='selected'"; ?>>APPO</option>
					<option value="IDEA" <?php if($type == "IDEA") echo "selected='selected'"; ?>>IDEA</option>
					<option value="TIP" <?php if($type == "TIP") echo "selected='selected'"; ?>>TIP</option>
					<option value="CLIMATE" <?php if($type == "CLIMATE") echo "selected='selected'"; ?>>CLIMATE</option>
					<option value="DUES" <?php if($type == "DUES") echo "selected='selected'"; ?>>DUES</option>
				</select>		
			</div>
		</div>

		<div>
			<div class="label">contents</div>
			<textarea id="contents" name="contents" rows="15" cols="50"><?php echo $contents; ?></textarea>			
		</div>
		
		<div>
			<div class="label">paymethod</div>
			<div class="input">
				<select name="paymethod">
					<option value="" disabled selected>Select a type</option>
					<option value="현대카드" <?php if($paymethod == "현대카드") echo "selected='selected'" ?>>현대카드</option>
					<option value="카뱅" <?php if($paymethod == "카뱅") echo "selected='selected'" ?>>카뱅</option>
					<option value="삼성카드" <?php if($paymethod == "삼성카드") echo "selected='selected'" ?>>삼성카드</option>
					<option value="카카오페이" <?php if($paymethod == "카카오페이") echo "selected='selected'" ?>>카카오페이</option>
					<option value="농협(법인)" <?php if($paymethod == "농협(법인)") echo "selected='selected'" ?>>농협(법인)</option>
					<option value="우체국" <?php if($paymethod == "우체국") echo "selected='selected'" ?>>우체국</option>
					<option value="현금" <?php if($paymethod == "현금") echo "selected='selected'" ?>>현금</option>
					<option value="지역화폐" <?php if($paymethod == "지역화폐") echo "selected='selected'" ?>>지역화폐</option>
			  </select>		
			</div>
		</div>

		<div>
			<div class="label">price</div>
			<div class="input"><input type="text" name="price" value="<?php echo $row['price'];?>"></div>
		</div>

		<div>
			<div class="label">volume</div>
			<div class="input"><input type="number" name="volume" min="0" max="100" value="<?php echo $row['volume'];?>"></div>
		</div>

		<div>
			<div class="label">remark</div>
			<div class="input"><input type="text" name="remark" value="<?php echo $row['remark'];?>"></div>
		</div>
		
		<div>
			<div class="label">market</div>
			<div class="input"><input type="text" name="market" value="<?php echo $row['market'];?>"></div>
		</div>
		
		<div>
			<div class="label">file</div>
			<div class="input"><input type="text" name="filename" value="<?php echo $row['filename'];?>"></div>
		</div>
	
		<input type="submit" value="save" onclick="closeWindow();">
		<!-- <div class="btnbox"><input type="submit" value="save" onClick="closeWindow();"></div> -->
	 </form>
</div> <!-- endof myevents_box -->

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
<input align="left" type=button onClick="self.close();" value="Close this window">
</html> 
