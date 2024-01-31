<!DOCTYPE html>
<html>
<head>
    <title>Member Table</title>
</head>
<body>

<table border="1">
    <thead>
        <tr>
					<th colspan=3>
					산악회 학번별 명단v.2024-01
					</th>
				<tr>
            <th>학번</th>
            <th>인원</th>
            <th>명단(학과,정회원번호)</th>
        </tr>
    </thead>
    <tbody>

<?php
$servername = "127.0.0.1:3306";
$username = "dslee";
$password = "A2lds7707!";
$dbname = "dslee_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create an array of hakbun values from 1961 to 2023
$hakbun_values = range(1961, 2023);

// Create a temporary table to store hakbun values
$tempTable = "CREATE TEMPORARY TABLE temp_hakbun (hakbun INT)";
$conn->query($tempTable);

// Insert hakbun values into the temporary table
foreach ($hakbun_values as $hakbun) {
    $conn->query("INSERT INTO temp_hakbun (hakbun) VALUES ($hakbun)");
}

$query = 
"SELECT temp.hakbun, COUNT(mem.hakbun) AS count_of_hakbun,
	GROUP_CONCAT(
    CONCAT(
			CASE WHEN mem.live = 0 THEN '<span style=\"color: blue;\">(故)</span>' ELSE '' END, 
			mem.name, 
			'(', IFNULL(mem.hakgwa, '-'), ',', 
			IFNULL(mem.hoebun,'-'),
			')'
			) ORDER BY mem.name SEPARATOR ' '
	) AS member_names
FROM temp_hakbun temp
LEFT JOIN member mem ON temp.hakbun = mem.hakbun
GROUP BY temp.hakbun
ORDER BY temp.hakbun";

$result = $conn->query($query);

while ($row = $result->fetch_assoc()) {
    // Display the data in each row
		if($row['count_of_hakbun'] > 0) 
    	echo "<tr><td>{$row['hakbun']}</td><td align=center>{$row['count_of_hakbun']}</td><td>{$row['member_names']}</td></tr>";
		else
			echo "<tr style='background-color: #88ccff;' ><td>{$row['hakbun']}</td><td align=center>-</td><td>{$row['member_names']}</td></tr>";
}

// Drop the temporary table
$conn->query("DROP TEMPORARY TABLE IF EXISTS temp_hakbun");

$conn->close();
?>

    </tbody>
</table>

</body>
</html>

