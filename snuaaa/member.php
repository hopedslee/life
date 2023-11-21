<?php
require ("db.php");

$query = "SELECT hakbun, COUNT(*) AS count_of_hakbun, GROUP_CONCAT(name order by name separator ' ') AS member_names
FROM member
GROUP BY hakbun
ORDER BY hakbun 
";
// ORDER BY hakbun
// ORDER BY count_of_hakbun DESC
echo "<table border='1'>";
echo "<tr style='font-size: 10px;'><td colspan=3 align=center>산악회 학번별 명단</td></tr>";
echo "<tr style='font-size: 10px;'><td>학번</td><td>인원수</td><td>명단</td></td></tr>";

$result=mysqli_query($conn,$query) or die(mysqli_error());
while( $row = mysqli_fetch_array($result) )
{
	echo "<tr style='font-size: 10px;'><td align=right>";
	echo $row[0]."</td><td align=center>".$row[1]."</td><td align=left>".$row[2]."</td></tr>"; 
}
echo "<tr>";
echo "</table>";

mysqli_close($conn);

?>
