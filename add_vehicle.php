<?php
include 'db_connect.php';

// Insert data when form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $vehicle_type = $_POST['vehicle_type'];
    $vehicle_no = $_POST['vehicle_no'];
    $driver_name = $_POST['driver_name'];
    $status = $_POST['status'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    // Prepare insert query (safe)
    $stmt = $conn->prepare("INSERT INTO vehicles (vehicle_type, vehicle_no, driver_name, status, latitude, longitude) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssdd", $vehicle_type, $vehicle_no, $driver_name, $status, $latitude, $longitude);

    if ($stmt->execute()) {
        echo "<p style='color:green;'>Vehicle added successfully!</p>";
    } else {
        echo "<p style='color:red;'>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Vehicle</title>
</head>
<body>
    <h2>Add Emergency Vehicle</h2>

    <form method="POST" action="">
        
        <label>Vehicle Type:</label><br>
        <input type="text" name="vehicle_type" required><br><br>

        <label>Vehicle Number:</label><br>
        <input type="text" name="vehicle_no" required><br><br>

        <label>Driver Name:</label><br>
        <input type="text" name="driver_name" required><br><br>

        <label>Status:</label><br>
        <select name="status">
            <option value="Available">Available</option>
            <option value="Busy">Busy</option>
        </select><br><br>

        <label>Latitude:</label><br>
        <input type="text" name="latitude" required><br><br>

        <label>Longitude:</label><br>
        <input type="text" name="longitude" required><br><br>

        <button type="submit">Add Vehicle</button>
    </form>

</body>
</html>
