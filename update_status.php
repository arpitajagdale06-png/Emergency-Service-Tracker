<?php
include 'db_connect.php';

if (isset($_POST['id']) && isset($_POST['status'])) {
    $id = intval($_POST['id']);
    $status = $_POST['status'];

    // Prepare and update query
    $stmt = $conn->prepare("UPDATE vehicles SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $id);

    if ($stmt->execute()) {
        echo "Status updated successfully ✅";
    } else {
        echo "Error updating status ❌";
    }

    $stmt->close();
} else {
    echo "Invalid request 🚫";
}

$conn->close();
?>
