<html>

<?php

require('db.php');
$seqno=$_GET['seqno'];
$from=$_GET['from'];
$count=$_GET['count'];

echo $seqno."<br />";
$path = "D:/DATA/htdocs/life/files/";

$query = "SELECT contents, filename FROM myevents WHERE seqno='$seqno'"; 
$result = mysqli_query($con_suwon,$query) or die ( mysqli_error());

if($result == True) {
	$row = mysqli_fetch_array($result);
	$contents = $row['contents'];
	$fname = $row['filename'];
	
	if( $fname != NULL && file_exists($path.$fname) ) {
		unlink($path.$fname);
		echo $seqno . ", '" . $fname . "' is deleted from directory.<br />";
	}

	$query = "DELETE FROM myevents WHERE seqno='$seqno'"; 
	$result = mysqli_query($con_suwon,$query) or die ( mysqli_error());
	if($result) {
		echo $seqno . ", '" . substr($contents, 0, 20) . " ...' is deleted from table.<br />";
	}
	
	$divert="?from=".$from."&count=".$count;
	echo $divert;
	$head="Location: myevents.php".$divert;
	echo $head."<br />";
	header("$head");
}

//header("Location: myevents.php"); 

?>
</html>
