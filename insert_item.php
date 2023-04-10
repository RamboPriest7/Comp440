<?php

$dbhost = "localhost:3308";
$dbuser = "root";
$dbpass = "";
$dbname = "comp440";

// Establish a connection to the MySQL database
$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if ($mysqli->connect_errno) {
  echo 'Failed to connect to MySQL: ' . $mysqli->connect_error;
  exit;
}

$dbuser = $_SESSION["username"];

  // Check if the user has already posted 3 items today
$date = date('Y-m-d');

$result = $mysqli->query("SELECT COUNT(*) FROM items WHERE username = '$dbname' AND DATE(created_at) = '$date'");
$count = $result->fetch_row()[0];

if ($count >= 3) {
  echo 'limit_exceeded';
  exit;
}

  // Insert the new item into the database
  $title = mysqli_real_escape_string($mysqli, $_POST['title']);
  $description = mysqli_real_escape_string($mysqli, $_POST['description']);
  $category = mysqli_real_escape_string($mysqli, $_POST['category']);
  $price = $_POST['price'];
  
  $result = $mysqli->query("INSERT INTO items (title, description, category, price) VALUES ('$title', '$description', '$category', $price)");
  
  if ($result) {
    echo 'success';
  } else {
    echo 'error';
  }
  
  $mysqli->close();
  ?>