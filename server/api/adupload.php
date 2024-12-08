<?php

// Allow requests from specific origins (replace '*' with your frontend origin)
header("Access-Control-Allow-Origin: *");
// You might want to consider using the origin of your frontend in place of localhost:4200 in a production environment.

// Allow requests with the following methods
header("Access-Control-Allow-Methods: POST");

// Allow requests with the following headers
header("Access-Control-Allow-Headers: Content-Type");

// Check if file was uploaded without errors
if(isset($_FILES["file"]) && $_FILES["file"]["error"] == 0){
    $targetDir = '../uploads/';
    $targetFile = $targetDir . basename($_FILES["file"]["name"]);

    // Move the uploaded file to the desired directory
    if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)){
        echo "File uploaded successfully.";
    } else {
        echo "Error uploading file.";
    }
} else {
    echo "No file uploaded or an error occurred.";
}
?>
