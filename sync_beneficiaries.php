<?php
header("Content-Type: application/json");

// Database credentials
$dbHost = "localhost";
$dbUser = "root";
$dbPass = "Dswd12345!!**";
$dbName = "swdiapps_db";

// Connect to database
$mysqli = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

// Check DB connection
if ($mysqli->connect_error) {
    http_response_code(500);
    echo json_encode([
        "status" => "error",
        "message" => "Database connection failed: " . $mysqli->connect_error
    ]);
    exit;
}

// Fetch all beneficiaries
$result = $mysqli->query("SELECT hhid AS id, firstName AS name, age FROM beneficiaries");

if (!$result) {
    echo json_encode([
        "status" => "error",
        "message" => "Query failed: " . $mysqli->error
    ]);
    exit;
}

// Collect all data
$beneficiaries = [];
while ($row = $result->fetch_assoc()) {
    $beneficiaries[] = $row;
}

// Save to JSON file
$jsonData = json_encode($beneficiaries, JSON_PRETTY_PRINT);
file_put_contents("beneficiaries.json", $jsonData);

// Close connection
$mysqli->close();

// Respond
echo json_encode([
    "status" => "success",
    "message" => "Beneficiaries exported successfully.",
    "file" => "beneficiaries.json",
    "count" => count($beneficiaries)
]);
?>
