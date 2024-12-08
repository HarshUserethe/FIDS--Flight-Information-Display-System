<?php

// Allow requests from specific origins (replace '*' with your frontend origin)
header("Access-Control-Allow-Origin: *");
// You might want to consider using the origin of your frontend in place of localhost:4200 in a production environment.

// Allow requests with the following methods
header("Access-Control-Allow-Methods: POST");

// Allow requests with the following headers
header("Access-Control-Allow-Headers: Content-Type");

header('Content-Type: application/json'); // Set the content type to JSON

// Get the client's IP address
$client_ip = $_SERVER['REMOTE_ADDR'];

// Output the IP address as JSON
echo json_encode(['ipAddress' => $client_ip]);
?>
