<html>
<?php
// modifed 2024-02-05
require('dbconn.php');
$seqno=$_GET['seqno'];

$path = "D:/DATA/htdocs/life/files/";

$query = "SELECT contents, filename FROM myevents WHERE seqno='$seqno'"; 
$result = mysqli_query($conn,$query) or die ( mysqli_error());

if($result == True) {
	$row = mysqli_fetch_array($result);
	$contents = $row['contents'];
	$fname = $row['filename'];
	
	if( $fname != NULL && file_exists($path.$fname) ) {
		unlink($path.$fname);
		echo $seqno . ", '" . $fname . "' is deleted from directory.<br />";
	}

	$query = "DELETE FROM myevents WHERE seqno='$seqno'"; 
	$result = mysqli_query($conn,$query) or die ( mysqli_error());
	if($result) {
		echo $seqno . ", '" . substr($contents, 0, 20) . " ...' is deleted from table.<br />";
	}
}

?>
</html>
