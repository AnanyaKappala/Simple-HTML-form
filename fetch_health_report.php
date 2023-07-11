<?php
// Database connection parameters
$host = "localhost";
$username = "your_username";
$password = "your_password";
$database = "your_database";

// Establish database connection
$connection = new mysqli($host, $username, $password, $database);
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Fetch email ID from the request
$email = $_GET["email"];

// Fetch the user's health report from the database
$sql = "SELECT file_name FROM health_reports INNER JOIN users ON health_reports.user_id = users.id WHERE users.email = '$email'";
$result = $connection->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $healthReportPath = $row["file_name"];

    // Send the health report file for download
    if (file_exists($healthReportPath)) {
        header("Content-Type: application/pdf");
        header("Content-Disposition: attachment; filename=" . basename($healthReportPath));
        readfile($healthReportPath);
    } else {
        echo "Health report not found.";
    }
} else {
    echo "User not found.";
}

// Close the database connection
$connection->close();
?>
