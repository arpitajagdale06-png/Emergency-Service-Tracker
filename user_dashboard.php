<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - Emergency Service Tracker</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #eef2f5;
            display: flex;
        }

        /* SIDEBAR */
        .sidebar {
            width: 240px;
            background-color: #007BFF;
            color: #fff;
            height: 100vh;
            position: fixed;
            padding-top: 20px;
            box-shadow: 2px 0 8px rgba(0,0,0,0.2);
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 22px;
            letter-spacing: 1px;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            padding: 12px 22px;
            margin: 8px 14px;
            border-radius: 6px;
            color: white;
            font-size: 16px;
            text-decoration: none;
            transition: background 0.2s ease-in-out;
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
            padding: 30px;
            width: 100%;
        }

        h1 {
            color: #333;
            font-size: 26px;
        }

        /* CARDS */
        .card {
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            width: 80%;
            margin: 30px auto;
            text-align: center;
            box-shadow: 0 3px 12px rgba(0,0,0,0.1);
        }

        .card h2 {
            margin-bottom: 10px;
            color: #222;
        }

        .card button {
            background-color: #007BFF;
            color: #fff;
            border: none;
            padding: 12px 20px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            transition: 0.2s;
        }

        .card button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h2>🚨 User Panel</h2>

    <a href="user_dashboard.php">🏠 <span>Dashboard</span></a>
    <a href="add_request.php">➕ <span>Add Request</span></a>
    <a href="track_request.php">📊 <span>Track Request</span></a>
    <a href="index.php">🚪 <span>Logout</span></a>
</div>

<!-- MAIN CONTENT -->
<div class="main-content">
    <h1>Welcome to Emergency Service Tracker</h1>

    <div class="card">
        <h2>Need Help?</h2>
        <p>Quickly request emergency services like Ambulance, Fire, or Police.</p>
        <a href="add_request.php">
            <button>Submit New Request</button>
        </a>
    </div>

    <div class="card">
        <h2>Track Your Request</h2>
        <p>Check the current status of your emergency requests in real-time.</p>
        <a href="track_request.php">
            <button>Track Request</button>
        </a>
    </div>
</div>

</body>
</html>
