<!DOCTYPE html>
<html>
<head>
    <title>Live Vehicle Map Tracker</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f7fa;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        h2 {
            color: #333;
            margin-top: 20px;
        }
        #map {
            height: 550px;
            width: 90%;
            margin: 20px auto;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
        }
    </style>
</head>
<body>

<h2>🗺️ Live Emergency Vehicle Tracking Map</h2>
<p>Simulated vehicle movement every 5 seconds ⏱️</p>

<div id="map"></div>

<script>
// Set dummy locations for simulation (e.g., Pune city)
const locations = [
    {lat: 18.5204, lng: 73.8567}, // Pune
    {lat: 18.5295, lng: 73.8446},
    {lat: 18.5105, lng: 73.8450},
    {lat: 18.5250, lng: 73.8700},
    {lat: 18.5400, lng: 73.8500},
    {lat: 18.5000, lng: 73.8700}
];

// Dummy vehicles
let vehicles = [
    {id: 1, type: 'Ambulance 🚑', lat: 18.5204, lng: 73.8567},
    {id: 2, type: 'Fire Truck 🔥', lat: 18.5105, lng: 73.8450},
    {id: 3, type: 'Police Van 🚓', lat: 18.5295, lng: 73.8446}
];

let map;
let markers = [];

// Initialize map
function initMap() {
    map = new google.maps.Map(document.getElementById("map"), {
        center: {lat: 18.5204, lng: 73.8567},
        zoom: 13
    });

    vehicles.forEach((v, i) => {
        let marker = new google.maps.Marker({
            position: {lat: v.lat, lng: v.lng},
            map: map,
            title: v.type
        });
        markers.push(marker);
    });

    // Move vehicles every 5 seconds
    setInterval(updateVehicleLocations, 5000);
}

// Simulate random movement
function updateVehicleLocations() {
    vehicles.forEach((v, i) => {
        const random = locations[Math.floor(Math.random() * locations.length)];
        v.lat = random.lat + (Math.random() - 0.5) * 0.01;
        v.lng = random.lng + (Math.random() - 0.5) * 0.01;
        markers[i].setPosition({lat: v.lat, lng: v.lng});
    });
}

</script>

<!-- Google Maps API (no API key needed for local test) -->
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDqtWmDvO61nHrXo9OlOt0roytxPGZA4TE&callback=initMap">
</script>

</body>
</html>
