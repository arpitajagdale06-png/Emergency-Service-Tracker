<?php
include 'db_connect.php';

$id = $_GET['id'];
$sql = "DELETE FROM vehicles WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Vehicle deleted successfully!'); window.location='view_vehicles.php';</script>";
} else {
    echo "Error deleting record: " . $conn->error;
}
?>
