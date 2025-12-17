<?php
include 'db_connect.php';
session_start();

// Handle delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM vehicles WHERE id=$id");
    header("Location: manage_vehicles.php");
    exit();
}

// Handle add vehicle
if (isset($_POST['add_vehicle'])) {
    $type = $_POST['vehicle_type'];
    $number = $_POST['vehicle_no'];
    $driver = $_POST['driver_name'];
    $status = $_POST['status'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    $sql = "INSERT INTO vehicles (vehicle_type, vehicle_no, driver_name, status, latitude, longitude)
            VALUES ('$type', '$number', '$driver', '$status', '$latitude', '$longitude')";
    $conn->query($sql);
    header("Location: manage_vehicles.php");
    exit();
}

// Handle update vehicle
if (isset($_POST['update_vehicle'])) {
    $id = $_POST['vehicle_id'];
    $type = $_POST['vehicle_type'];
    $number = $_POST['vehicle_no'];
    $driver = $_POST['driver_name'];
    $status = $_POST['status'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    $sql = "UPDATE vehicles SET 
            vehicle_type='$type',
            vehicle_no='$number',
            driver_name='$driver',
            status='$status',
            latitude='$latitude',
            longitude='$longitude'
            WHERE id=$id";
    $conn->query($sql);
    header("Location: manage_vehicles.php");
    exit();
}

// Fetch vehicles
$result = $conn->query("SELECT * FROM vehicles");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Vehicles</title>
    <style>
        body { font-family: Arial; background: #f4f6f9; margin: 0; padding: 0; }
        h2 { text-align: center; margin-top: 20px; color: #333; }
        .container {
            width: 90%; margin: 20px auto; background: #fff; padding: 20px;
            border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        table { width: 100%; border-collapse: collapse; }
        th, td {
            border: 1px solid #ddd; padding: 10px; text-align: center;
        }
        th { background: #007BFF; color: #fff; }
        .btn { padding: 5px 10px; border-radius: 5px; cursor: pointer; border: none; }
        .btn-edit { background: #ffc107; color: white; }
        .btn-delete { background: #dc3545; color: white; }
        .btn-add { background: #28a745; color: white; padding: 8px 15px; }
        form {
            display: flex; flex-wrap: wrap; gap: 10px; justify-content: center;
            margin-bottom: 20px;
        }
        input, select {
            padding: 8px; border-radius: 5px; border: 1px solid #ccc;
        }
    </style>
</head>
<body>

<h2>🚓 Manage Vehicles</h2>

<div class="container">

    <!-- ADD/EDIT FORM -->
    <form method="POST">
        <input type="hidden" name="vehicle_id" id="vehicle_id">

        <input type="text" name="vehicle_type" id="vehicle_type" placeholder="Vehicle Type" required>
        <input type="text" name="vehicle_no" id="vehicle_no" placeholder="Vehicle Number" required>
        <input type="text" name="driver_name" id="driver_name" placeholder="Driver Name" required>

        <select name="status" id="status" required>
            <option value="Available">Available</option>
            <option value="Busy">Busy</option>
            <option value="On Mission">On Mission</option>
        </select>

        <input type="text" name="latitude" id="latitude" placeholder="Latitude" required>
        <input type="text" name="longitude" id="longitude" placeholder="Longitude" required>

        <button type="submit" name="add_vehicle" class="btn btn-add">Add Vehicle</button>
        <button type="submit" name="update_vehicle" class="btn btn-edit" style="display:none;">Update Vehicle</button>
    </form>

    <!-- VEHICLE TABLE -->
    <table>
        <tr>
            <th>ID</th>
            <th>Type</th>
            <th>Number</th>
            <th>Driver</th>
            <th>Status</th>
            <th>Latitude</th>
            <th>Longitude</th>
            <th>Actions</th>
        </tr>

        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['vehicle_type'] ?></td>
                <td><?= $row['vehicle_no'] ?></td>
                <td><?= $row['driver_name'] ?></td>
                <td><?= $row['status'] ?></td>
                <td><?= $row['latitude'] ?></td>
                <td><?= $row['longitude'] ?></td>

                <td>
                    <button class="btn btn-edit" onclick='editVehicle(<?= json_encode($row) ?>)'>Edit</button>
                    <a href="?delete=<?= $row['id'] ?>" class="btn btn-delete"
                       onclick="return confirm('Delete this vehicle?');">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </table>

</div>

<script>
function editVehicle(v) {
    document.getElementById('vehicle_id').value = v.id;
    document.getElementById('vehicle_type').value = v.vehicle_type;
    document.getElementById('vehicle_no').value = v.vehicle_no;
    document.getElementById('driver_name').value = v.driver_name;
    document.getElementById('status').value = v.status;
    document.getElementById('latitude').value = v.latitude;
    document.getElementById('longitude').value = v.longitude;

    document.querySelector('button[name="add_vehicle"]').style.display = 'none';
    document.querySelector('button[name="update_vehicle"]').style.display = 'inline-block';
}
</script>

</body>
</html>
