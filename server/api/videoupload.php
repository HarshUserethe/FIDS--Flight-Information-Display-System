<?php
// Connect to MySQL database
$host = "localhost";
$username = "root";
$password = "legend123";
$database = "fids_patna";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if file has been uploaded
if ($_FILES['video']['error'] === UPLOAD_ERR_OK) {
    // Get file data
    $video_data = file_get_contents($_FILES['video']['tmp_name']);
    $video_name = $_FILES['video']['name'];
    $video_type = $_FILES['video']['type'];

    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO videos (video_name, video_data, video_type) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $video_name, $video_data, $video_type);

    // Execute SQL statement
    if ($stmt->execute() === TRUE) {
        echo "Video uploaded successfully";
    } else {
        echo "Error uploading video: " . $conn->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Error uploading video";
}
?>
