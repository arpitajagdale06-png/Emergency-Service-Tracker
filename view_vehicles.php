<?php
include 'db_connect.php';

// Handle search and filter inputs
$search = isset($_GET['search']) ? $_GET['search'] : '';
$status = isset($_GET['status']) ? $_GET['status'] : '';

// Build query dynamically
$sql = "SELECT * FROM vehicles WHERE 1=1";

if (!empty($search)) {
    $sql .= " AND (vehicle_type LIKE '%$search%' OR vehicle_no LIKE '%$search%' OR driver_name LIKE '%$search%')";
}

if (!empty($status)) {
    $sql .= " AND status='$status'";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Vehicles</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f6f8;
        }
        h2 {
            color: #333;
        }
        form {
            margin-bottom: 20px;
            background: #fff;
            padding: 10px 20px;
            border-radius: 10px;
            display: inline-block;
        }
        input[type="text"], select {
            padding: 6px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-right: 10px;
        }
        button {
            padding: 6px 12px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
        }
        button:hover {
            background-color: #0056b3;
        }
        table {
            border-collapse: collapse;
            width: 90%;
            background-color: #fff;
        }
        th, td {
            border: 1px solid #999;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        a {
            text-decoration: none;
            color: #007BFF;
        }
        a:hover {
            text-decoration: underline;
        }
        .btn {
            padding: 5px 10px;
            border-radius: 5px;
        }
        .edit {
            background-color: #ffc107;
            color: #000;
        }
        .delete {
            background-color: #dc3545;
            color: white;
        }
    </style>
</head>
<body>

<h2>All Emergency Vehicles</h2>
<a href="add_vehicle.php">+ Add New Vehicle</a>
<br><br>

<!-- 🔍 Search and Filter Form -->
<form method="GET" action="">
    <input type="text" name="search" placeholder="Search by type, number or driver" value="<?php echo $search; ?>">
    <select name="status">
        <option value="">-- Filter by Status --</option>
        <option value="Available" <?php if($status=='Available') echo 'selected'; ?>>Available</option>
        <option value="Busy" <?php if($status=='Busy') echo 'selected'; ?>>Busy</option>
    </select>
    <button type="submit">Search</button>
    <a href="view_vehicles.php"><button type="button">Reset</button></a>
</form>

<table>
    <tr>
        <th>ID</th>
        <th>Type</th>
        <th>Number</th>
        <th>Driver</th>
        <th>Status</th>
        <th>Location</th>
        <th>Actions</th>
    </tr>

    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['vehicle_type']}</td>
                    <td>{$row['vehicle_no']}</td>
                    <td>{$row['driver_name']}</td>
                    <td>{$row['status']}</td>
                    <td>{$row['location']}</td>
                    <td>
                        <a class='btn edit' href='edit_vehicle.php?id={$row['id']}'>Edit</a> |
                        <a class='btn delete' href='delete_vehicle.php?id={$row['id']}' onclick='return confirm(\"Are you sure?\");'>Delete</a>
                    </td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='7'>No vehicles found.</td></tr>";
    }
    ?>
</table>

</body>
</html>
