<?php
// *** Change this to your server info***
$hostname = "localhost:3308";
$username = "root";
$password = "";
$dbname = "comp440";

// Create connection and display error if connection fails
$conn = new mysqli($hostname, $username, $password, $dbname);
if ($conn->connect_error) {
  exit("Database connection failed: " . $conn->connect_error);
}
?>