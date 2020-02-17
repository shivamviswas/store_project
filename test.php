<?php
$servername = "localhost:3308";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password,'store');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
