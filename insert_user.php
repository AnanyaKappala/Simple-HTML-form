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

// Fetch form data
$name = $_POST["name"];
$age = $_POST["age"];
$weight = $_POST["weight"];
$email = $_POST["email"];
$healthReport = $_FILES["healthReport"];

// Insert user details into the database
$sql = "INSERT INTO users (name, age, weight, email) VALUES ('$name', '$age', '$weight', '$email')";
if ($connection->query($sql) === true) {
    $userId = $connection->insert_id;

    // Save health report file to a directory
    $healthReportDir = "health_reports/";
    $healthReportPath = $healthReportDir . $healthReport["name"];
    move_uploaded_file($healthReport["tmp_name"], $healthReportPath);

    // Insert health report details into the database
    $sql = "INSERT INTO health_reports (user_id, file_name) VALUES ('$userId', '$healthReportPath')";
    if ($connection->query($sql) === true) {
        echo "User details and health report inserted successfully.";
    } else {
        echo "Error inserting health report: " . $connection->error;
    }
} else {
    echo "Error inserting user details: " . $connection->error;
}

// Close the database connection
$connection->close();
?>
