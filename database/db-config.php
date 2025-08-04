<?php
// Database configuration
$host = "localhost";           // Your database host (usually localhost)
$username = "root";            // Your MySQL username
$password = "";                // Your MySQL password (default is empty in XAMPP)
$database = "internship_db";   // Your database name

// Create a MySQLi connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
