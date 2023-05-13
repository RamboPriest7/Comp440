<?php
session_start();

$hostname = "localhost:3308";
$username = "root";
$password = "";
$dbname = "comp440";

$conn = mysqli_connect($hostname, $username, $password, $dbname);
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}
if (isset($_POST['category'])) {
	$category = mysqli_real_escape_string($conn, $_POST['category']);
	$query = "SELECT * FROM item WHERE category = '$category'";
	$result = mysqli_query($conn, $query);
	if (!$result) {
		die("Query failed: " . mysqli_error($conn));
	}
}

?>


<!DOCTYPE html>
<html>
<head>    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
</head>
<body>
    <div class="container-main">
        <div class="navbar">
            <form action="home.php" method="post">
                <button type="submit" class="button-3">Return to Home Page</button>                
            </form>
        </div>

        <h1>Search Items</h1>
        </form>
        <form method="GET" action="search_items.php">
            <label for="category">Search by category:</label>
            <input type="text" id="category" name="category">
            <input type="submit" value="Search">
        </form>


        <div class="content">
            <h2>Search for an item</h2>
            
            <div class="search-form">
                <form action="search.php" method="post">
                    <select id="category" name="category" required>
                        <option value="" disabled selected>Select a category</option>
                        <option value="Art & Collectibles">Art & Collectibles</option>
                        <option value="Baby & Kids">Baby & Kids</option>
                        <option value="Clothing & Accessories">Clothing & Accessories</option>
                        <option value="Electronics">Electronics</option>
                        <option value="Furniture">Furniture</option>
                        <option value="Home & Garden">Home & Garden</option>
                        <option value="Pet Supplies">Pet Supplies</option>
                        <option value="Sporting Goods">Sporting Goods</option>
                        <option value="Toys">Toys</option>
                        <option value="Other">Other</option>
                    </select>
                    <button type="submit" name="submit" class="button" style="width:50px; font-size: 14px; ">🔎</button>
                </form>
            </div>

            <?php
            if (isset($result) && mysqli_num_rows($result) == 0) {
                echo "<p>No items found.</p>";
            } elseif (isset($result)) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<h3>" . $row['title'] . "</h3>";
                    echo "<p>" . $row['description'] . "</p>";
                    echo "<p>Price: $" . $row['price'] . "</p>";
                    echo "<hr>";
                }
            }
            ?>

    </div>
</body>
</html>