<?php
// Database connection
$host = "localhost";
$username = "dhruvil";
$password = ""; // No password
$database = "virtual garden";

// Connect to the database
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if 'name' is provided via AJAX request
if (isset($_GET['name'])) {
    $plant_name = $conn->real_escape_string($_GET['name']);

    // Fetch plant details from the database
    $sql = "SELECT * FROM plants WHERE name = '$plant_name'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $plant = $result->fetch_assoc();
        echo json_encode($plant); // Return JSON data
    } else {
        echo json_encode(["error" => "No plant found"]);
    }
} else {
    echo json_encode(["error" => "Invalid request"]);
}

$conn->close();
?>
