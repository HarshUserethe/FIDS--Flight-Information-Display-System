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
    $sql = "SELECT * FROM actual_flight_table ORDER BY estimated_departure_time ASC";
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
} elseif ($method === 'POST') {
    // Handle POST request to update data
    $data = json_decode(file_get_contents('php://input'), true);

    // Log received data
    error_log("Received data from React application: " . json_encode($data));

    // Validate and sanitize input data
    $flight_id = mysqli_real_escape_string($con, $data['flight_id']);
    $delay = mysqli_real_escape_string($con, $data['delay']);
    $status = mysqli_real_escape_string($con, $data['status']);
    $delayedtime = mysqli_real_escape_string($con, $data['delayedtime']);
    $checkin = mysqli_real_escape_string($con, $data['checkin']);
    $gatenum = mysqli_real_escape_string($con, $data['gatenum']);
    // Perform the database update for actual_flight_table
    $sql = "UPDATE actual_flight_table SET estimated_departure_time = '$delay', remark = '$status', delaytime = '$delayedtime', check_in = '$checkin', gate = '$gatenum' WHERE flight_id = '$flight_id'";
    $result = mysqli_query($con, $sql);

    if (!$result) {
        http_response_code(500);
        echo json_encode(array('error' => 'Error updating flight in database'));
        exit();
    }

    // $flight_id = mysqli_real_escape_string($con, $data['flight_id']);
    // $arr_delay = mysqli_real_escape_string($con, $data['arr_delay']);
    // $status = mysqli_real_escape_string($con, $data['status']);
    // $delayedtime = mysqli_real_escape_string($con, $data['delayedtime']);
    // // Perform the database update for fids table
    // // Assuming the structure of fids table and the update operation
    // $fids_update_sql = "UPDATE actual_flight_table SET estimated_arrival_time = '$arr_delay', remark='$status' delaytime = '$delayedtime' WHERE flight_id = '$flight_id'";
    // $fids_result = mysqli_query($con, $fids_update_sql);

    // if (!$fids_result) {
    //     http_response_code(500);
    //     echo json_encode(array('error' => 'Error updating fids table'));
    //     exit();
    // }

    echo json_encode(array('message' => 'Flight updated successfully'));
} else {
    // Handle unsupported methods
    http_response_code(405);
    echo json_encode(array('error' => 'Method not allowed'));
}

$con->close();
?>
