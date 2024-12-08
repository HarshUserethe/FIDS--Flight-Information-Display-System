<?php
// Allow requests from specific origins (replace '*' with your frontend origin)
header("Access-Control-Allow-Origin: *");
// You might want to consider using the origin of your frontend in place of localhost:4200 in a production environment.

// Allow requests with the following methods
header("Access-Control-Allow-Methods: POST");

// Allow requests with the following headers
header("Access-Control-Allow-Headers: Content-Type");

// Retrieve data from POST request
$data = json_decode(file_get_contents('php://input'), true);

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

// Prepare SQL statement
$sql = "INSERT INTO checkin_counter (system_ip, display_ip, flight_number, code_share, vias, airline_logo, estimated_departure_time, class, remark_desc) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

// Build parameter types and values dynamically
$types = '';
$values = array();
$params = array(&$types);
foreach ($data as $key => $value) {
    // Only include non-null values
    if ($value !== null) {
        $types .= 's'; // Assuming all values are strings, adjust if needed
        $values[] = $value;
        $params[] = &$data[$key];
    }
}

// Modify SQL statement if there are non-null values
if (!empty($values)) {
    $sql = "INSERT INTO checkin_counter (" . implode(',', array_keys($data)) . ") VALUES (" . rtrim(str_repeat('?,', count($values)), ',') . ")";
}

// Prepare SQL statement
$stmt = $conn->prepare($sql);

// Bind parameters
call_user_func_array(array($stmt, 'bind_param'), $params);

// Execute SQL statement
if ($stmt->execute() === TRUE) {
    echo "New record inserted successfully";
} else {
    echo "Error: " . $stmt->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
