<!DOCTYPE html>
<html>
<head>
  <title>Query 9</title>
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

// Query the database to retrieve user pairs who always gave each other "excellent" reviews
$sql = "SELECT a.username AS user1, b.username AS user2
FROM users a
JOIN users b ON a.username < b.username
WHERE NOT EXISTS (
    SELECT *
    FROM item x
    WHERE x.username = a.username
      AND NOT EXISTS (
          SELECT *
          FROM review y
          WHERE y.forItem = x.itemId
            AND y.writtenBy = b.username
            AND y.score = 'excellent'
      )
    UNION
    SELECT *
    FROM item x
    WHERE x.username = b.username
      AND NOT EXISTS (
          SELECT *
          FROM review y
          WHERE y.forItem = x.itemId
            AND y.writtenBy = a.username
            AND y.score = 'excellent'
      )
)";
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if ($result) {
    // Display the list of user pairs
    echo "<h1>User pairs who always gave each other excellent reviews:</h1>";
    echo "<ul>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<li>" . $row["user1"] . " and " . $row["user2"] . "</li>";
    }
    echo "</ul>";
} else {
    echo "Error: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>


  <input type="button" class="btn" id="homeButton" value="Return to Home">
  
</body>
</html>