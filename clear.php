<html>

<?php

require('dbconn.php');
$seqno=$_GET['seqno'];
$query = "SELECT clear FROM todo WHERE seqno='$seqno'";
$result = mysqli_query($conn,$query) or die ( mysqli_error());
$row = mysqli_fetch_array($result);
if($row['clear']==0)
	$query = "UPDATE todo set clear=1 WHERE seqno='$seqno'"; 
else 
	$query = "UPDATE todo set clear=0 WHERE seqno='$seqno'"; 

$result = mysqli_query($conn,$query) or die ( mysqli_error());

if ($result == True) {
	header("Location: 	index.php"); 
	exit;
}
else echo "False";

?>
</html>