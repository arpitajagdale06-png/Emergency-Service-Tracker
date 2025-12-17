<?php
session_start();
include 'db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Emergency Service Tracker</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #eef2f5;
            display: flex;
        }

        /* SIDEBAR */
        .sidebar {
            width: 240px;
            background-color: #007BFF;
            height: 100vh;
            position: fixed;
            color: white;
            box-shadow: 2px 0px 10px rgba(0,0,0,0.2);
            padding-top: 20px;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 25px;
            font-size: 22px;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: white;
            text-decoration: none;
            margin: 8px 12px;
            border-radius: 6px;
            transition: 0.2s;
        }

        .sidebar a:hover {
            background-color: #0056b3;
        }

        .sidebar a span {
            margin-left: 10px;
        }

        /* MAIN CONTENT */
        .main-content {
            margin-left: 260px;
            width: calc(100% - 260px);
            height: 100vh;
        }

        .topbar {
            background: #fff;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        iframe {
            width: 100%;
            height: calc(100vh - 70px);
            border: none;
        }

        .logout-btn {
            background: #dc3545;
            padding: 8px 14px;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }

        .logout-btn:hover {
            background: #b02a37;
        }
    </style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h2>🚨 Admin Panel</h2>

    <a href="live_tracking.php" target="content">🛰️ <span>Live Tracking</span></a>
    <a href="manage_vehicles.php" target="content">🚗 <span>Manage Vehicles</span></a>
    <a href="assign_vehicle.php" target="content">🚓 <span>Assign Vehicle</span></a>
    <a href="complete_mission.php" target="content">✅ <span>Complete Mission</span></a>
    <a href="view_reports.php" target="content">📊 <span>View Reports</span></a>

    <a href="logout.php" class="logout-btn" style="margin:20px;">Logout</a>
</div>

<!-- MAIN CONTENT -->
<div class="main-content">
    <div class="topbar">
        <h3>Emergency Service Tracker - Admin Dashboard</h3>
    </div>

    <iframe name="content" src="assign_vehicle.php"></iframe>
</div>

</body>
</html>
