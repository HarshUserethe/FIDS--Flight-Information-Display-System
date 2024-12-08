<?php
// Allow requests from any origin
header("Access-Control-Allow-Origin: *");

// Allow requests with methods GET, POST, and OPTIONS
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

// Allow requests with the Content-Type header
header("Access-Control-Allow-Headers: Content-Type");

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Handle deletion of rows from baggage_table after 20 minutes
require_once 'database.php'; // Include file for database connection

$sql = "DELETE FROM baggage_table WHERE status = 'ENDED' AND TIMESTAMPDIFF(MINUTE, updated_at, NOW()) >= 20";
$result = mysqli_query($conn, $sql);
if (!$result) {
    echo "Error deleting rows: " . mysqli_error($conn);
    exit();
}

?>
