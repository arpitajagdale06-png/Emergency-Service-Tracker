<?php
include 'db_connect.php';

$id = $_GET['id'];
$sql = "SELECT * FROM vehicles WHERE id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $vehicle_type = $_POST['vehicle_type'];
    $vehicle_no = $_POST['vehicle_no'];
    $driver_name = $_POST['driver_name'];
    $status = $_POST['status'];
    $location = $_POST['location'];

    $update = "UPDATE vehicles 
               SET vehicle_type='$vehicle_type', vehicle_no='$vehicle_no', driver_name='$driver_name', 
                   status='$status', location='$location' 
               WHERE id=$id";

    if ($conn->query($update) === TRUE) {
        echo "<script>alert('Vehicle updated successfully!'); window.location='view_vehicles.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Vehicle</title>
</head>
<body>
    <h2>Edit Vehicle</h2>
    <form method="POST" action="">
        <label>Vehicle Type:</label><br>
        <input type="text" name="vehicle_type" value="<?php echo $row['vehicle_type']; ?>" required><br><br>

        <label>Vehicle Number:</label><br>
        <input type="text" name="vehicle_no" value="<?php echo $row['vehicle_no']; ?>" required><br><br>

        <label>Driver Name:</label><br>
        <input type="text" name="driver_name" value="<?php echo $row['driver_name']; ?>" required><br><br>

        <label>Status:</label><br>
        <select name="status">
            <option value="Available" <?php if($row['status']=='Available') echo 'selected'; ?>>Available</option>
            <option value="Busy" <?php if($row['status']=='Busy') echo 'selected'; ?>>Busy</option>
        </select><br><br>

        <label>Location:</label><br>
        <input type="text" name="location" value="<?php echo $row['location']; ?>" required><br><br>

        <button type="submit">Update Vehicle</button>
    </form>
</body>
</html>
