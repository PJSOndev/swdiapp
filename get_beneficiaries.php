<?php
header('Content-Type: application/json');

$host = "localhost";
$db = "swdiapps_db";
$user = "root"; // replace if needed
$pass = "Dswd12345!!**";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["error" => "Connection failed"]);
    exit;
}

$sql = "SELECT * FROM beneficiaries limit 10";
$result = $conn->query($sql);

if (!$result) {
    http_response_code(500);
    echo json_encode(["error" => "Query failed"]);
    exit;
}

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);
$conn->close();
?>
