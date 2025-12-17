<?php
include 'db_connect.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Emergency Requests</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f7fa;
            margin: 30px;
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
            padding: 5px;
            border-radius: 4px;
        }
        button {
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<h2>📝 Manage Emergency Requests</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Request Type</th>
        <th>Citizen Name</th>
        <th>Location</th>
        <th>Status</th>
        <th>Assigned Vehicle</th>
        <th>Action</th>
    </tr>

<?php
$result = $conn->query("SELECT * FROM requests");

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['request_type']}</td>
                <td>{$row['citizen_name']}</td>
                <td>{$row['location']}</td>
                <td>{$row['status']}</td>
                <td>{$row['assigned_vehicle']}</td>
                <td>
                    <a href='assign_vehicle.php?id={$row['id']}'>Assign Vehicle</a> |
                    <a href='complete_mission.php?id={$row['id']}'>Mark Completed</a>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='7'>No requests found.</td></tr>";
}
?>
</table>

</body>
</html>
