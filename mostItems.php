<!DOCTYPE html>
<html>
<head>
  <title>Item Check</title>
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
  

// Query the database to get the users who posted the most number of items since 5/1/2020 (inclusive)
$query = "SELECT username, COUNT(*) AS num_items FROM item WHERE postDate >= '2020-05-01' GROUP BY username ORDER BY num_items DESC";
$result = mysqli_query($conn, $query);

// Check if the query is successful
if (!$result) {
  die("Query failed: " . mysqli_error($conn));
}

// Print the list of users who posted the most number of items since 5/1/2020 (inclusive)
$max_num_items = 0;
while ($row = mysqli_fetch_assoc($result)) {
  if ($row['num_items'] >= $max_num_items) {
    $max_num_items = $row['num_items'];
    echo "<span style='color: red;'>Most items listed since 2020-05-01 is by:</span><br>";
    echo "<br><br>";
    echo "<div><span style='border: 1px solid black; padding: 5px;'>User: <span style='color: blue;'>" . $row['username'] . "</span>, Total items: <span style='color: blue;'>" . $row['num_items'] . "</span></span><br><br>";

    // Query the database to get all the items posted by this user
    $item_query = "SELECT * FROM item WHERE username = '".$row['username']."'";
    $item_result = mysqli_query($conn, $item_query);

    // Check if the query is successful
    if (!$item_result) {
      die("Query failed: " . mysqli_error($conn));
    }

    // Print the list of items posted by this user
    while ($item_row = mysqli_fetch_assoc($item_result)) {
      echo "Title: " . $item_row['title'] . "<br>";
      echo "Description: " . $item_row['description'] . "<br>";
      echo "Category: " . $item_row['category'] . "<br>";
      echo "Price: $" . $item_row['price'] . "<br>";
      echo "Post date: " . $item_row['postDate'] . "<br><br>";
    }
    echo "</div>";
  } else {
    break;
  }
}

// Close the database connection
mysqli_close($conn);
?>

  <input type="button" class="btn" id="homeButton" value="Return to Home">
  
</body>
</html>