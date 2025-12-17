<?php
include 'db_connect.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>📊 Completed Missions Report</title>
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
        .no-data {
            color: #777;
            font-style: italic;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<h2>📊 Completed Missions Report</h2>

<?php
// ✅ Correct SQL query
$query = "SELECT id, request_type, citizen_name, location, assigned_vehicle, timestamp 
          FROM requests 
          WHERE status='Completed'";

$result = $conn->query($query);

// Check if query ran successfully
if (!$result) {
    die("<p style='color:red;'>❌ SQL Error: " . $conn->error . "</p>");
}

if ($result->num_rows > 0) {
    echo "<table>
            <tr>
                <th>ID</th>
                <th>Request Type</th>
                <th>Citizen Name</th>
                <th>Location</th>
                <th>Assigned Vehicle</th>
                <th>Completed Time</th>
            </tr>";
    
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['request_type']}</td>
                <td>{$row['citizen_name']}</td>
                <td>{$row['location']}</td>
                <td>{$row['assigned_vehicle']}</td>
                <td>{$row['timestamp']}</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "<p class='no-data'>No completed missions yet.</p>";
}
?>

</body>
</html>
