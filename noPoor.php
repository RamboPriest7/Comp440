<!DOCTYPE html>
<html>
<head>
  <title>No Poor Review</title>
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

// Select all users who never posted a "poor" review
$sql = "SELECT * FROM users WHERE username NOT IN (SELECT writtenBy FROM review WHERE score = 'poor')";
$result = mysqli_query($conn, $sql);

// Display the results in a table
if (mysqli_num_rows($result) > 0) {
    echo "<table>";
    echo "<tr><th>Username</th><th>First Name</th><th>Last Name</th><th>Email</th></tr>";
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>".$row["username"]."</td><td>".$row["firstName"]."</td><td>".$row["lastName"]."</td><td>".$row["email"]."</td></tr>";
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