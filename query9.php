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

// Query the database to retrieve users who have not received any poor reviews
$sql = "SELECT DISTINCT i.username
FROM item i
LEFT JOIN (
	SELECT forItem, COUNT(*) as num_poor_reviews
    FROM review
    WHERE score = 'poor'
    GROUP BY forItem
    ) r ON i.itemId = r.forItem
    WHERE i.username NOT IN ( 
		SELECT i.username
        FROM item i
        JOIN review r ON i.itemId = r.forItem
        WHERE r.score = 'poor'
        )";
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if ($result) {
    // Display the list of users
    echo "<h1>Users with no poor reviews:</h1>";
    echo "<ul>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<li>" . $row["username"] . "</li>";
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