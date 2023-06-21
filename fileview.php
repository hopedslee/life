<?php
$filename=$_POST['filename'];

$path = "D:/DATA/mysql/files/";
copy($path.$filename,$filename);

$ext = explode(".", strtolower($filename));
echo $ext->type;

$type = 'image/jpeg';
//header('Content-Type:'.$type);
//header('Content-Length: ' . filesize($filename));
//readfile($filename);
//seep(10);
//unlink($filename);

/*
function testimage($path)
{
   if(!preg_match("/\.(png|jpg|gif)$/",$path,$ext)) return 0;
   $ret = null;
   switch($ext)
   {
       case 'png': $ret = @imagecreatefrompng($path); break;
       case 'jpeg': $ret = @imagecreatefromjpeg($path); break;
       // ...
       default: $ret = 0;
   }

   return $ret;
}
*/
?>