<html>
<body>
<?php
$seqno=$_GET['seqno'];
//$contents=$_GET['contents'];

echo "<form action='upload_file.php' method='post' enctype='multipart/form-data' accept-charset='UTF-8'>";
echo "<label for='text'>Seqno : &nbsp</label>";
echo "<input type='text' name='seqno' id='seqno' value=".$seqno." readonly> <br /><br />";
echo "<input type='file' name='file' id='file'><br />";
echo "<input type='submit' name='submit' value='Submit'>";
echo "</form>";
?>
<br />
<input align="center" type=button onClick="self.close();" value="Close this window">
</body>
</html>
