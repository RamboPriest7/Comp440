<!DOCTYPE html>
<html>
<head>
  <title>Negative Review Zone</title>
  <style>
    body {
      background-color: #f2f2f2; /* Set the background color of the page */
    }
  </style>
    <script>
    function homeClicked()
    {
    window.location.href="phase3_home.php";
    }
    function init() 
    {
      homeButton.addEventListener("click", homeClicked);
    }

      window.addEventListener("DOMContentLoaded", init);
    </script>
</head>
<body>
<?php
// Create a new mysqli connection to your database
$hostname = "localhost:3308";
$username = "root";
$password = "";
$dbname = "comp440";
$conn = mysqli_connect($hostname, $username, $password, $dbname);

// Check if the connection is successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Select all users who have posted reviews where all of their reviews are "poor"
$sql = "SELECT DISTINCT writtenBy FROM review WHERE writtenBy IN (SELECT writtenBy FROM review WHERE score = 'poor') AND writtenBy NOT IN (SELECT writtenBy FROM review WHERE score != 'poor')";
$result = mysqli_query($conn, $sql);

// Display the results in a table
if (mysqli_num_rows($result) > 0) {
    echo "<table>";
    echo "<tr><th>Username</th></tr>";
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>".$row["writtenBy"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "No users found.";
}

// Close the MySQL connection
mysqli_close($conn);
?>

  <input type="button" class="btn" id="homeButton" value="Return to Home">
  
</body>
</html>