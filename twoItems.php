<!DOCTYPE html>
<html>
<head>
  <title>Item Check</title>
  <style>
    body {
      background-color: #f2f2f2; /* Set the background color of the page */
    }
    
    input[type="submit"] {
      background-color: #4CAF50; /* Set the background color of the search button */
      color: white; /* Set the text color of the search button */
      border: none; /* Remove the border around the search button */
      padding: 10px 20px; /* Add some padding to the search button */
      cursor: pointer; /* Change the cursor to a pointer when hovering over the search button */
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

  // Get the categories X and Y from the user
  $categoryX = isset($_POST['categoryX']) ? mysqli_real_escape_string($conn, $_POST['categoryX']) : '';
  $categoryY = isset($_POST['categoryY']) ? mysqli_real_escape_string($conn, $_POST['categoryY']) : '';

  // Query the users who posted items in categories X and Y on the same day
  if (!empty($categoryX) && !empty($categoryY)) {
    $sql = "SELECT username
    FROM item
    WHERE category = '$categoryX' AND postDate IN (
        SELECT postDate
        FROM item
        WHERE category = '$categoryY'
        GROUP BY postDate
        HAVING COUNT(*) >= 2
    )
    UNION
    SELECT username
    FROM item
    WHERE category = '$categoryY' AND postDate IN (
        SELECT postDate
        FROM item
        WHERE category = '$categoryX'
        GROUP BY postDate
        HAVING COUNT(*) >= 2
    )
    GROUP BY username
    HAVING COUNT(*) >= 2";

    $result = mysqli_query($conn, $sql);

    // Display the results
     if (mysqli_num_rows($result) > 0) {
      echo "<h2>Users Who Posted Items in Categories {$categoryX} and {$categoryY} on the Same Day:</h2>";
      while ($row = mysqli_fetch_assoc($result)) {
          echo "Username: " . $row["username"] . "<br>";
      }
   } else {
      echo "No users found.";
   }
  }

  // Close the database connection
  mysqli_close($conn);
  ?>

  <br>
  <!-- HTML form to input categories X and Y -->
  <form method="post">
    <label for="categoryX">Category X:</label>
    <input type="text" name="categoryX" id="categoryX">
    <label for="categoryY">Category Y:</label>
    <input type="text" name="categoryY" id="categoryY">
    <input type="submit" value="Search">
  </form>

  <input type="button" class="btn" id="homeButton" value="Return to Home">
  
</body>
</html>