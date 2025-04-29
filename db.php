<?php
// Use a socket path for MAMP's MySQL server on Mac
$host = "localhost";
$user = "root";
$password = "root"; // MAMP default password is **root**
$database = "ictweb514_db";

// Use port and socket explicitly for MAMP
$port = 8889; // MAMP's default MySQL port
$socket = "/Applications/MAMP/tmp/mysql/mysql.sock";

// Create connection
$conn = new mysqli($host, $user, $password, $database, $port, $socket);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8");
?>
