<?php
// Database connection
$host = "localhost";
$username = "root";
$password = "legend123";
$database = "fids_patna";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
