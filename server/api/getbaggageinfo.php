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

if ($method === 'GET') {
    // Handle GET request to retrieve data
    $sql = "SELECT * FROM baggage_table";
    $result = mysqli_query($con, $sql);

    if (!$result) {
        http_response_code(500);
        echo json_encode(array('error' => 'Error retrieving data from database'));
        exit();
    }

    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    echo json_encode($data);
}else {
    // Handle unsupported methods
    http_response_code(405);
    echo json_encode(array('error' => 'Method not allowed'));
}

$con->close();
?>