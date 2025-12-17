<?php
include 'db_connect.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>🚨 Live Vehicle Tracking</title>

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f7fa;
            margin: 0;
        }
        header {
            background-color: #007BFF;
            color: white;
            padding: 15px;
            text-align: center;
        }
        #map {
            width: 100%;
            height: 90vh;
        }
    </style>
</head>
<body>

<header>
    <h2>📍 Live Tracking of Emergency Vehicles</h2>
</header>

<div id="map"></div>

<script>
    // Initialize map
    var map = L.map('map').setView([19.7515, 75.7139], 6);

    // Load OpenStreetMap Tiles
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
    }).addTo(map);

    // Request markers (users)
    var requestMarkers = [
        <?php
        $req = $conn->query("SELECT * FROM requests WHERE latitude IS NOT NULL AND longitude IS NOT NULL");
        while ($row = $req->fetch_assoc()) {
            echo "{lat: {$row['latitude']}, lng: {$row['longitude']}, title: 'Request #{$row['id']} - {$row['request_type']} ({$row['citizen_name']})'},";
        }
        ?>
    ];

    // Vehicle markers
    var vehicleMarkers = [
        <?php
        $veh = $conn->query("SELECT * FROM vehicles WHERE latitude IS NOT NULL AND longitude IS NOT NULL");
        while ($v = $veh->fetch_assoc()) {
            echo "{lat: {$v['latitude']}, lng: {$v['longitude']}, title: 'Vehicle #{$v['id']} - {$v['vehicle_type']} ({$v['driver_name']})'},";
        }
        ?>
    ];

    // Add request markers (red)
    requestMarkers.forEach(function(r) {
        L.marker([r.lat, r.lng], {icon: L.icon({
            iconUrl: 'https://maps.gstatic.com/mapfiles/ms2/micons/red-dot.png',
            iconSize: [30, 30]
        })})
        .addTo(map)
        .bindPopup(r.title);
    });

    // Add vehicle markers (blue)
    vehicleMarkers.forEach(function(v) {
        L.marker([v.lat, v.lng], {icon: L.icon({
            iconUrl: 'https://maps.gstatic.com/mapfiles/ms2/micons/blue-dot.png',
            iconSize: [30, 30]
        })})
        .addTo(map)
        .bindPopup(v.title);
    });
</script>

</body>
</html>
