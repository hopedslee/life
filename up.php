<?php
if (isset($_FILES)) {
    $file = $_FILES["file"];
    // print_r($file);
    $error = $file["error"];
    $name = $file["name"];
    $type = $file["type"];
    $size = $file["size"];
    $tmp_name = $file["tmp_name"];
    if ( $error > 0 ) {
        echo "Error: " . $error . "<br>";
    }
    else {
      echo "Upload: " . $name . "<br>";
      echo "Type: " . $type . "<br>";
      echo "Size: " . ($size/1024/1024) . " Mb<br>";
      echo "Stored in: " . $tmp_name;
    }
}
else {
    echo "File is not selected";
}
?>
