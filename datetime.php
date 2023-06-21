<!DOCTYPE html>
<html>
<body>

<?php
$dt = new DateTime("now", new DateTimeZone('America/New York'));
echo $dt->format('m/d/Y, H:i:s');

?>

</body>
</html>
