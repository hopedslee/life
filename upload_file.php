<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
<body>
<?php
require ('db.php');
mysqli_set_charset($conn,'utf8');

$allowedExts = array("gif", "jpeg", "jpg", "png", "txt", );

$path = "files/";
$tmppath = "tmp/";

$seqno=$_POST['seqno'];
echo "seqno=".$seqno."<br />";

if (isset($_FILES)) {
    $file=$_FILES['file']; // file attributes are transferred by form name 'file'
	echo "filename=".$file['name']."<br />";
    $fname = $file["name"];
    $error = $file["error"];
    $type = $file["type"];
    $size = $file["size"];
    $tmp_name = $file["tmp_name"];

    if ( $error > 0 ) {
        echo "error: " . $error . "<br />";
    }
    else {
        $temp = explode(".", $fname);
        $extension = end($temp);
		$size = $size/1024/1024;
		//if ( ($fsize < 10.0) and in_array($extension, $allowedExts) ) {		
		if ( $size < 1000.0 ) {
			echo "Filename : " . $fname . "<br>";
			echo "Type : " . $type . "<br>";
			echo "Size : " . number_format($size,2) . " Mb<br>";
			echo "Stored temporarly in : " . $tmp_name;
			if (file_exists($path.$fname)) {
                	echo "<br />" . $fname . " already exists. ";
           	}
           	else {
				echo "<br />"."converted filename : ".$fname."<br />";
				$ret = move_uploaded_file($tmp_name, $path.$fname);
				echo "move_uploaded_file:<br />";
				echo "from : " . $tmp_name . "<br />";
				echo "  to : " . $path.$fname . "<br />";
				echo " ret : " . $ret . "<br />";
				//copy($path.$filename, $tmppath.$fname);
				$filelocation = $path.$fname;
				echo "Stored permanently in : " . $filelocation;
			}	
        }
        else {
            echo number_format($fsize,2) . " Mbyte is bigger than " . $size . "Mb or ";
            echo $extension . "format file is not allowed to upload ! ";
        }
    }

    $query = "UPDATE myevents SET filename='$fname' WHERE seqno='$seqno'";
    $result = mysqli_query($conn,$query);
    echo "<br />".$query . "<br />";
    echo "Return : " . $result ."<br />";
}
else {
    echo "File is not selected";
}

?>
</body>
<br />
<input align="center" type=button onClick="self.close();" value="Close this window">
</html> 
