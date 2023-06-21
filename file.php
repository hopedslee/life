<!DOCTYPE html>
<html>
<body>
<?php
echo "<form action='upload.php' method='post' enctype='multipart/form-data' accept-charset='UTF-8'>";
  echo "Select image to upload:";
  echo "<input type='file' name='fileToUpload' id='fileToUpload'>";
  echo "<input type='submit' value='Upload Image' name='submit'>";
echo "</form>";
?>
</body>
</html>
