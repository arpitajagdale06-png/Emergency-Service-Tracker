<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $type = $_POST['request_type'];
    $name = $_POST['citizen_name'];
    $location = $_POST['location'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    $sql = "INSERT INTO requests (request_type, citizen_name, location, latitude, longitude, status) 
            VALUES ('$type', '$name', '$location', '$latitude', '$longitude', 'Pending')";

    if ($conn->query($sql)) {
        echo "<script>alert('✅ Request added successfully!');</script>";
    } else {
        echo "<script>alert('❌ Error adding request!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Emergency Request</title>
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
        form {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 400px;
            margin: auto;
        }
        h1 {
            color: #333;
            text-align: center;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px;
            width: 100%;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
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
    <h1>Add Emergency Request</h1>
    <form method="POST" action="">

        <label>Request Type:</label>
        <select name="request_type" required>
            <option value="Ambulance">Ambulance</option>
            <option value="Fire">Fire</option>
            <option value="Police">Police</option>
        </select>

        <label>Citizen Name:</label>
        <input type="text" name="citizen_name" placeholder="Enter name" required>

        <label>Location (Address):</label>
        <input type="text" name="location" placeholder="Enter location" required>

        <label>Latitude:</label>
        <input type="text" name="latitude" placeholder="Enter latitude" required>

        <label>Longitude:</label>
        <input type="text" name="longitude" placeholder="Enter longitude" required>

        <button type="submit">Submit Request</button>
    </form>
</div>

</body>
</html>
