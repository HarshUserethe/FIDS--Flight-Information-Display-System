<?php
// Set headers to allow CORS

// Allow requests from specific origins (replace '*' with your frontend origin)
header("Access-Control-Allow-Origin: *");
// You might want to consider using the origin of your frontend in place of localhost:4200 in a production environment.

// Allow requests with the following methods
header("Access-Control-Allow-Methods: POST");

// Allow requests with the following headers
header("Access-Control-Allow-Headers: Content-Type");

// Database configuration
$host = 'localhost';
$username = 'root';
$password = 'legend123';
$database = 'fids_patna';

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch data
$sql = "SELECT * FROM checkin_display_info";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $data = array();
    // Fetch data from each row
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    // Output data as JSON
    echo json_encode($data);
} else {
    echo "0 results";
}

// Close connection
$conn->close();
?>
