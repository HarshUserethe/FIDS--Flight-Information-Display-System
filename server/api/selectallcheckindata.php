<?php

// Allow requests from specific origins (replace '*' with your frontend origin)
header("Access-Control-Allow-Origin: *");
// You might want to consider using the origin of your frontend in place of localhost:4200 in a production environment.

// Allow requests with the following methods
header("Access-Control-Allow-Methods: POST");

// Allow requests with the following headers
header("Access-Control-Allow-Headers: Content-Type");

// Connect to MySQL database
$servername = "localhost";
$username = "root";
$password = "legend123";
$database = "fids_patna";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the database
$sql = "SELECT * FROM checkin_counter";
$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
} else {
    echo "0 results";
}

// Close connection
$conn->close();

// Output JSON
header('Content-Type: application/json');
echo json_encode($data);
?>
