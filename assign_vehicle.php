<?php
include 'db_connect.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Assign Vehicle to Requests</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f7fa;
            margin: 20px;
        }
        h2 {
            color: #333;
        }
        table {
            border-collapse: collapse;
            width: 95%;
            background: #fff;
            margin-top: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
        select, button {
            padding: 6px 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button {
            background-color: #007bff;
            color: white;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<h2>🚨 Assign Vehicles to Pending Requests</h2>

<?php
// Handle Assignment
if (isset($_POST['assign'])) {
    $request_id = $_POST['request_id'];
    $vehicle_id = $_POST['vehicle_id'];

    // Update vehicle and request status
    $conn->query("UPDATE requests SET status='On Mission', assigned_vehicle=$vehicle_id WHERE id=$request_id");
    $conn->query("UPDATE vehicles SET status='On Mission' WHERE id=$vehicle_id");

    echo "<p style='color:green;'>✅ Vehicle Assigned Successfully!</p>";
}

// Fetch pending requests
$requests = $conn->query("SELECT * FROM requests WHERE status='Pending'");

// Fetch available vehicles
$vehicles = $conn->query("SELECT * FROM vehicles WHERE status='Available'");
?>

<table>
    <tr>
        <th>Request ID</th>
        <th>Type</th>
        <th>Citizen Name</th>
        <th>Location</th>
        <th>Status</th>
        <th>Assign Vehicle</th>
    </tr>

<?php
if ($requests->num_rows > 0) {
    while ($req = $requests->fetch_assoc()) {
        echo "<tr>
            <td>{$req['id']}</td>
            <td>{$req['request_type']}</td>
            <td>{$req['citizen_name']}</td>
            <td>{$req['location']}</td>
            <td>{$req['status']}</td>
            <td>
                <form method='POST' action=''>
                    <input type='hidden' name='request_id' value='{$req['id']}'>
                    <select name='vehicle_id' required>";

                    // Reset pointer to loop through vehicles again
                    $veh_res = $conn->query("SELECT * FROM vehicles WHERE status='Available'");
                    if ($veh_res->num_rows > 0) {
                        while ($v = $veh_res->fetch_assoc()) {
                            echo "<option value='{$v['id']}'>{$v['vehicle_type']} - {$v['vehicle_no']} ({$v['driver_name']})</option>";
                        }
                    } else {
                        echo "<option disabled>No Available Vehicles</option>";
                    }

                    echo "</select>
                    <button type='submit' name='assign'>Assign</button>
                </form>
            </td>
        </tr>";
    }
} else {
    echo "<tr><td colspan='6'>No pending requests found ✅</td></tr>";
}
?>
</table>

</body>
</html>
