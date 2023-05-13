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

// Create a new PDO connection to your database
$hostname = "localhost:3308";
$username = "root";
$password = "";
$dbname = "comp440";
$conn = mysqli_connect($hostname, $username, $password, $dbname);

// Query the most expensive item in each category
$sql = "SELECT p1.category, p1.title, p1.price
        FROM item p1
        JOIN (
          SELECT category, MAX(price) AS max_price
          FROM item
          GROUP BY category
        ) p2 ON p1.category = p2.category AND p1.price = p2.max_price";
$result = mysqli_query($conn, $sql);

// Display the results
echo "<h2>Most Expensive Item in Each Category:</h2>";
echo "<table>";
echo "<tr><th>Category</th><th>Title</th><th>Price</th></tr>";
while ($row = mysqli_fetch_assoc($result)) {
  echo "<tr><td>{$row['category']}</td><td>{$row['title']}</td><td>{$row['price']}</td></tr>";
}
echo "</table>";

// Close the database connection
mysqli_close($conn);

?>

  <input type="button" class="btn" id="homeButton" value="Return to Home">
  
</body>
</html>
