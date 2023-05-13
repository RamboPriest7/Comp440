<!DOCTYPE html>
<html>
<head>
  <title>Favorites</title>
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

if(isset($_POST['submit'])) {

  // Connect to the database
  $hostname = "localhost:3308";
  $username = "root";
  $password = "";
  $dbname = "comp440";
  $conn = mysqli_connect($hostname, $username, $password, $dbname);

  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }

  // Get selected users from dropdowns
  $userX = $_POST['dropdownX'];
  $userY = $_POST['dropdownY'];

  // Retrieve users that are favorited by both users
  $sql = "SELECT DISTINCT f1.theUser FROM favorite f1, favorite f2 WHERE f1.followerName = '$userX' AND f2.followerName = '$userY' AND f1.theUser = f2.theUser";
  // SELECT DISTINCT f1.followerName FROM favorite f1, favorite f2 WHERE f1.followerName = '$userX' AND f2.followerName = '$userY' AND f1.theUser = f2.theUser";
  // "SELECT DISTINCT f1.followerName FROM favorite f1, favorite f2 WHERE f1.theUser = '$userX' AND f2.theUser = '$userY' AND f1.followerName = f2.followerName";
  $result = mysqli_query($conn, $sql);

  // Generate list of usernames that are favorited by both users
  echo "<h2>Users Favorited by $userX and $userY:</h2>";
  if (mysqli_num_rows($result) > 0) {
    echo "<ul>";
    while ($row = mysqli_fetch_assoc($result)) {
      $username = $row['theUser'];
      echo "<li>$username</li>";
    }
    echo "</ul>";
  } else {
    echo "No users are favorited by both $userX and $userY.";
  }

  // Close database connection
  mysqli_close($conn);
}

?>




<form method="post">
  User X:
  <select name="dropdownX">
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

    // Retrieve usernames from users table
    $sql = "SELECT username FROM users";
    $result = mysqli_query($conn, $sql);

    // Generate dropdown options from usernames
    while ($row = mysqli_fetch_assoc($result)) {
        $username = $row['username'];
        echo "<option value='$username'>$username</option>";
    }

    // Close database connection
    mysqli_close($conn);
    ?>
  </select>
  <br>
  <br>
  User Y:
  <select name="dropdownY">
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

    // Retrieve usernames from users table
    $sql = "SELECT username FROM users";
    $result = mysqli_query($conn, $sql);

    // Generate dropdown options from usernames
    while ($row = mysqli_fetch_assoc($result)) {
        $username = $row['username'];
        echo "<option value='$username'>$username</option>";
    }

    // Close database connection
    mysqli_close($conn);
    ?>
  </select>
  <br>
  <input type="submit" name="submit" value="Search">
</form>

<input type="button" class="btn" id="homeButton" value="Return to Home">

</body>
</html>
