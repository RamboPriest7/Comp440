<!DOCTYPE html>
<html>
<head>
  <title>Review Check</title>
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

// Connect to the database
$hostname = "localhost:3308";
$username = "root";
$password = "";
$dbname = "comp440";
$conn = mysqli_connect($hostname, $username, $password, $dbname);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

//get user input from form
if(isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
 
    //query to select items posted by user with excellent or good comments
    $sql = "SELECT DISTINCT i.title, i.description, i.category, i.price, i.postDate
            FROM item i
            INNER JOIN review r ON i.itemId = r.forItem
            WHERE i.username = '$username'
            AND r.score IN ('Excellent', 'Good')
            AND NOT EXISTS (
                SELECT *
                FROM review r2
                WHERE r2.forItem = r.forItem
                AND r2.score NOT IN ('Excellent', 'Good')
            )";
            
    $result = mysqli_query($conn, $sql);
    
    //check if any rows were returned
    if(mysqli_num_rows($result) > 0) {
      //display items
      echo "<table style='border: 1px solid black'>";
      echo "<tr><th style='border: 1px solid black'>Title</th><th style='border: 1px solid black'>Description</th><th style='border: 1px solid black'>Category</th><th style='border: 1px solid black'>Price</th><th style='border: 1px solid black'>Post Date</th></tr>";
      while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td style='border: 1px solid black'>" . $row['title'] . "</td>";
        echo "<td style='border: 1px solid black'>" . $row['description'] . "</td>";
        echo "<td style='border: 1px solid black'>" . $row['category'] . "</td>";
        echo "<td style='border: 1px solid black'>" . $row['price'] . "</td>";
        echo "<td style='border: 1px solid black'>" . $row['postDate'] . "</td>";
        echo "</tr>";
      }
      echo "</table>";
    } else {
      //no items found
      echo "No items found for user " . $username . " with excellent or good comments.";
    }
    
    //free result set
    mysqli_free_result($result);
  }
  
  //close connection
  mysqli_close($conn);
  ?>


<form method="post">
  <label for="username">Username:</label>
  <input type="text" name="username" id="username">
  <input type="submit" name="submit" value="Submit">
</form>
<input type="button" class="btn" id="homeButton" value="Return to Home">

</body>
</html>