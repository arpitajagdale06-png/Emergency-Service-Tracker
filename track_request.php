<?php
include 'db_connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Emergency Requests</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f4f6f8;
            display: flex;
        }
        .sidebar {
            width: 220px;
            background-color: #007BFF;
            color: white;
            height: 100vh;
            padding-top: 20px;
            position: fixed;
        }
        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
        }
        .sidebar a {
            display: block;
            padding: 12px 20px;
            color: white;
            text-decoration: none;
            margin: 5px 10px;
            border-radius: 5px;
        }
        .sidebar a:hover {
            background-color: #0056b3;
        }
        .main-content {
            margin-left: 240px;
            padding: 30px;
            flex-grow: 1;
        }
        h1 {
            color: #333;
            text-align: center;
        }
        table {
            border-collapse: collapse;
            width: 90%;
            background: #fff;
            margin: 30px auto;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .status {
            font-weight: bold;
            border-radius: 5px;
            padding: 5px 10px;
            display: inline-block;
        }
        .Pending { background-color: #ffc107; color: white; }
        .OnMission { background-color: #17a2b8; color: white; }
        .Completed { background-color: #28a745; color: white; }
    </style>
</head>
<body>

<div class="sidebar">
    <h2>🚨 User Panel</h2>
    <a href="user_dashboard.php">🏠 Dashboard</a>
    <a href="add_request.php">➕ Add Request</a>
    <a href="track_request.php">📊 Track Request</a>
    <a href="index.php">🚪 Logout</a>
</div>

<div class="main-content">
    <h1>📊 Track Your Requests</h1>

    <?php
    $sql = "SELECT * FROM requests ORDER BY timestamp DESC";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        echo "<table>
                <tr>
                    <th>ID</th>
                    <th>Type</th>
                    <th>Citizen Name</th>
                    <th>Location</th>
                    <th>Status</th>
                    <th>Assigned Vehicle</th>
                    <th>Timestamp</th>
                </tr>";
        while($row = $result->fetch_assoc()) {
            $statusClass = str_replace(' ', '', $row['status']);
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['request_type']}</td>
                    <td>{$row['citizen_name']}</td>
                    <td>{$row['location']}</td>
                    <td><span class='status $statusClass'>{$row['status']}</span></td>
                    <td>" . ($row['assigned_vehicle'] ?? '-') . "</td>
                    <td>{$row['timestamp']}</td>
                </tr>";
        }
        echo "</table>";
    } else {
        echo "<p style='text-align:center; color:gray;'>No requests found yet.</p>";
    }
    ?>
</div>

</body>
</html>
