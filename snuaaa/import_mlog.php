<HTML>
<HEAD>
<title>mhistory</title>
<meta http-equiv=r'Content-Type' content='text/html; charset=utf-8'>";
</HEAD>

<?php
header("Content-Type:text/html;charset=utf-8");

include('../db.php');

$file = fopen("rawdata.txt", "r");
$i=0;
if ($file) {
    while (($line = fgets($file)) !== false) {
				$i++;
        // Split the line into the first word and the remaining words
        $line = trim($line); // Remove leading/trailing spaces
        $words = explode(" ", $line);
        $firstWord = array_shift($words);
        $contents = implode(" ", $words);

        // Prepare and execute an SQL query to insert the data
        $sql = "INSERT INTO mlog (etype, edate, contents) VALUES ('산행',?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $firstWord, $contents);

        if ($stmt->execute()) {
            echo $i . ": Data inserted successfully\r\n";
        } else {
            echo $i . ": Error: " . $stmt->error . $firstWord . "\r\n";
        }

        $stmt->close();
    }

    fclose($file);
} else {
    echo "Failed to open the file.i\r\n";
}

