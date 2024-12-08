<?php
// Allow requests from specific origins (replace '*' with your frontend origin)
header("Access-Control-Allow-Origin: *");
// You might want to consider using the origin of your frontend in place of localhost:4200 in a production environment.

// Allow requests with the following methods
header("Access-Control-Allow-Methods: POST");

// Allow requests with the following headers
header("Access-Control-Allow-Headers: Content-Type");

// Establish a connection to the MySQL database
$servername = "localhost";
$username = "root";
$password = "legend123";
$dbname = "fids_patna";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the data sent from the React frontend
$data = json_decode(file_get_contents("php://input"), true);

// Prepare and bind the SQL statement to insert data into the baggage table
$stmt = $conn->prepare("INSERT INTO baggage_table (flight_number, airline_logo, origin, belt) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $data['flight_number'], $data['airline_logo'], $data['origin'], $data['belt']);

// Execute the SQL statement
if ($stmt->execute()) {
    // Output JSON response
    echo json_encode(array("message" => "New record inserted successfully"));
} else {
    // Output JSON response
    echo json_encode(array("error" => "Error: " . $stmt->error));
}

// Close the statement and the database connection
$stmt->close();
$conn->close();
?>
