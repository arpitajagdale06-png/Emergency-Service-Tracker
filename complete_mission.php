<?php
include 'db_connect.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Complete Mission</title>
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
            background-color: #28a745;
            color: white;
        }
        button {
            padding: 6px 12px;
            border-radius: 5px;
            border: none;
            background-color: #28a745;
            color: white;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<h2>✅ Complete Ongoing Missions</h2>

<?php
// Handle mission completion
if (isset($_POST['complete'])) {
    $request_id = $_POST['request_id'];
    $vehicle_id = $_POST['vehicle_id'];

    // Update request and vehicle status
    $conn->query("UPDATE requests SET status='Completed' WHERE id=$request_id");
    $conn->query("UPDATE vehicles SET status='Available' WHERE id=$vehicle_id");

    echo "<p style='color:green;'>🎯 Mission Completed Successfully!</p>";
}

// Fetch all requests currently 'On Mission'
$missions = $conn->query("SELECT r.id, r.request_type, r.citizen_name, r.location, r.assigned_vehicle, v.vehicle_no, v.driver_name 
FROM requests r
JOIN vehicles v ON r.assigned_vehicle = v.id
WHERE r.status='On Mission'");
?>

<table>
    <tr>
        <th>Request ID</th>
        <th>Type</th>
        <th>Citizen</th>
        <th>Location</th>
        <th>Vehicle No</th>
        <th>Driver</th>
        <th>Action</th>
    </tr>

<?php
if ($missions->num_rows > 0) {
    while ($m = $missions->fetch_assoc()) {
        echo "<tr>
            <td>{$m['id']}</td>
            <td>{$m['request_type']}</td>
            <td>{$m['citizen_name']}</td>
            <td>{$m['location']}</td>
            <td>{$m['vehicle_no']}</td>
            <td>{$m['driver_name']}</td>
            <td>
                <form method='POST'>
                    <input type='hidden' name='request_id' value='{$m['id']}'>
                    <input type='hidden' name='vehicle_id' value='{$m['assigned_vehicle']}'>
                    <button type='submit' name='complete'>Mark Completed</button>
                </form>
            </td>
        </tr>";
    }
} else {
    echo "<tr><td colspan='7'>No ongoing missions 🚨</td></tr>";
}
?>
</table>

</body>
</html>
