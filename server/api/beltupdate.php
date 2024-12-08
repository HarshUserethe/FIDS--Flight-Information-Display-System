<?php
// Allow from any origin
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// If it's an OPTIONS request, return a 200 OK status
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

$host = "localhost";
$user = "root";
$password = "legend123";
$dbname = "fids_patna";

$con = mysqli_connect($host, $user, $password, $dbname);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $flight_id = mysqli_real_escape_string($con, $data['flight_id']);
    $belt = mysqli_real_escape_string($con, $data['belt']);

    // Perform the database update for fids table
    // Assuming the structure of fids table and the update operation
    $fids_update_sql = "UPDATE actual_flight_table SET belt = '$belt' WHERE flight_id = '$flight_id'";
    $fids_result = mysqli_query($con, $fids_update_sql);

    if (!$fids_result) {
        http_response_code(500);
        echo json_encode(array('error' => 'Error updating fids table'));
        exit();
    }

   echo json_encode(array('message' => 'Flight updated successfully'));
} else {
   // Handle unsupported methods
   http_response_code(405);
   echo json_encode(array('error' => 'Method not allowed'));
}

$con->close();
?>
