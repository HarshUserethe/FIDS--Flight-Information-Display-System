<?php
// login.php

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

// Establish database connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get username and password from POST request
$data = json_decode(file_get_contents('php://input'), true); // Get JSON data from request
$username = $data['username'];
$password = $data['password'];

// Sanitize input to prevent SQL injection (optional but recommended)
$username = mysqli_real_escape_string($conn, $username);
$password = mysqli_real_escape_string($conn, $password);

// Hash the password (for better security, you should use bcrypt or a similar strong hashing algorithm)
$hashedPassword = md5($password);

// Query the database to check if the provided credentials are valid and get the user's role and firstname
$sql = "SELECT email, role, firstname, lastname, id FROM user WHERE email='$username' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // If the query returns a row, the credentials are valid
    $row = $result->fetch_assoc();
    $response = array(
        'success' => true,
        'message' => 'Login successful',
        'role' => $row['role'],
        'firstname' => $row['firstname'], // Include firstname in the response
        'lastname' => $row['lastname'], // Include firstname in the response
        'id' => $row['id'] // Include firstname in the response
    );
} else {
    // If no row is returned, the credentials are invalid
    $response = array(
        'success' => false,
        'message' => 'Invalid username or password'
    );
}

// Return the response as JSON
header('Content-Type: application/json');
echo json_encode($response);

// Close database connection
$conn->close();
?>
