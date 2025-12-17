<?php
include 'db_connect.php';

$result = $conn->query("SELECT * FROM vehicles");
$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);
?>
