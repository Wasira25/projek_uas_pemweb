<?php
include 'config.php';
header('Content-Type: application/json');

$result = mysqli_query($conn, "SELECT * FROM outsourcing");
$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

echo json_encode([
    "status" => "success",
    "data" => $data
]);
?>
