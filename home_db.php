<?php
// Define connection to the cloned database
$host = "127.0.0.1";
$user = "root";
$password = "";
$database = "home_ictweb514"; // New duplicated DB name

$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optional: UTF-8 support
$conn->set_charset("utf8");
?>
