<!DOCTYPE html>
<html>
<head>
  <title>Excellent Items</title>
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

  // Define the SQL query to display all the users who never posted any "excellent" items
  $sql = "SELECT DISTINCT u.username, u.firstName, u.lastName, u.email
          FROM users u
          LEFT JOIN item i ON u.username = i.username
          LEFT JOIN (
            SELECT forItem, COUNT(*) AS excellent_reviews
            FROM review
            WHERE score = 'excellent'
            GROUP BY forItem
            HAVING COUNT(*) >= 3
          ) er ON i.itemId = er.forItem
          LEFT JOIN review r ON i.itemId = r.forItem AND u.username = r.writtenBy
          WHERE er.excellent_reviews IS NULL";

  // Execute the query and store the result in a variable
  $result = mysqli_query($conn, $sql);

  // Check if there are any rows returned by the query
  if (mysqli_num_rows($result) > 0) {
      // Display the table header
      echo "<table>";
      echo "<tr><th>Username</th><th>First Name</th><th>Last Name</th><th>Email</th></tr>";
      // Loop through the rows and display the data
      while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr>";
          echo "<td>" . $row["username"] . "</td>";
          echo "<td>" . $row["firstName"] . "</td>";
          echo "<td>" . $row["lastName"] . "</td>";
          echo "<td>" . $row["email"] . "</td>";
          echo "</tr>";
      }
      // Display the table footer
      echo "</table>";
  } else {
      // Display a message if there are no rows returned by the query
      echo "No users found.";
  }

  // Close the database connection
  mysqli_close($conn);
  ?>

  <input type="button" class="btn" id="homeButton" value="Return to Home">
  
</body>
</html>