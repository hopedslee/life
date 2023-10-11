<?php
$servername = "localhost";
$username = "dslee";
$password = "A2lds7707!";
$dbname = "dslee_db";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the date to search for from the form
    $date_to_search = $_POST['search_date'];

    $sql = "SELECT * FROM myevents WHERE date = '$date_to_search'";
    $result = $conn->query($sql);

    echo "<h2>Diary Entries for Date: $date_to_search</h2>";

    if ($result->num_rows > 0) {
        // Display data of each row
        while ($row = $result->fetch_assoc()) {
            echo "Date: " . $row["date"]. ", Entry: " . $row["contents"]. "<br>";
        }
    } else {
        echo "No entries found for the specified date.";
    }
}

$conn->close();
?>

