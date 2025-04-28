<?php
// Define database connection parameters
$host = "127.0.0.1";        // Host name (usually localhost)
$user = "root";             // Database username (default for XAMPP)
$password = "";             // Password (leave empty if using XAMPP default)
$database = "ictweb514_db"; // Name of the database you created in phpMyAdmin

// Create a new MySQLi connection
$conn = new mysqli($host, $user, $password, $database);

// Check if the connection was successful
if ($conn->connect_error) {
    // If not, stop execution and display error message
    die("Connection failed: " . $conn->connect_error);
}

// Optional: set character set to UTF-8 for proper encoding
$conn->set_charset("utf8");

// The $conn variable will be used in other PHP scripts
?>
