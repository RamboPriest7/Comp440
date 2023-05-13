<html>
<head>    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
</head>
<body>

            <form action="search.php" method="post">
                <button type="submit" class="button-3">Return to Search Page</button>                
            </form>

</body>
</html>
 <?php
 $hostname = "localhost:3308";
 $username = "root";
 $password = "";
 $dbname = "comp440";
 
 $conn = mysqli_connect($hostname, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get search query
$category = $_GET['category'];

// Search items by category
$sql = "SELECT * FROM item WHERE category LIKE '%" . $category . "%'";
$result = $conn->query($sql);

// Display search results in a table
if ($result->num_rows > 0) {
    echo "<table><tr><th>ID</th><th>Title</th><th>Description</th><th>Category</th><th>Price</th><th>Created At</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row['itemId'] . "</td><td>" . $row['title'] . "</td><td>" . $row['description'] . "</td><td>" . $row['category'] . "</td><td>" . $row['price'] . "</td><td>" . $row['postDate'] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "No items found.";
}

$conn->close();
?>