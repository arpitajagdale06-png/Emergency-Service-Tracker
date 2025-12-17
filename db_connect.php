<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "emergency_db";
$port = 3307; // because you changed MySQL port in XAMPP

// Create connection
$conn = new mysqli($servername, $username, $password, $database, $port);

// Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// } else {
//     echo "Database connected successfully!";
// }
?>
