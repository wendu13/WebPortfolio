<?php
// Database credentials
$host = 'localhost';       // Usually 'localhost'
$user = 'root';    // Replace with your DB username
$pass = '';    // Replace with your DB password
$dbname = 'triovista';   // Your database name

// Create connection
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set charset to utf8mb4 for proper encoding
$conn->set_charset("utf8mb4");
