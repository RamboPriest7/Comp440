<?php
session_start();

$dbhost = "localhost:3308";
$username = "root";
$dbpass = "";
$dbname = "comp440";

$conn = mysqli_connect($dbhost, $username, $dbpass, $dbname);
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

$username = $_SESSION['username'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "SELECT COUNT(*) FROM review WHERE writtenBy = '$username' AND DATE(reviewDate) = DATE(NOW());";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_fetch_array($result)[0];

    if ($count >= 3) {
        echo "You have reached your daily limit of 3 reviews for this item. Please try again tomorrow.";
        echo "<br><a href='review.php'>Return to Review</a>";
        exit();
    }

    else {
    $itemId = $_POST["itemId"];
    $rating = $_POST["rating"];
    $description = $_POST["description"];

    $sql = "SELECT COUNT(*) FROM item WHERE itemId = $itemId AND username = '$username'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_fetch_array($result)[0];
    if ($count > 0) {
        echo "You cannot write a review for your own item.";
        echo "<br><a href='review.php'>Return to Review</a>";
        exit();
    }
    
        $stmt = $conn->prepare("INSERT INTO review (forItem, writtenBy, score, remark, reviewDate) VALUES (?, ?, ?, ?, NOW())");
        $stmt->bind_param("isss", $itemId, $username, $rating, $description);

        if ($stmt->execute()) {
        echo "Review submitted successfully. "; 
        } else {
            echo "Error inserting data: " ;
        }
    }
}
?>
            <form action="home.php" method="post">
                <button type="submit" class="button-3">Return to Home Page</button>                
            </form>
        </div>

<!-- HTML code for the item selection form -->
<form method="post">
    <label for="item">Select item:</label>
    <select id="item" name="itemId">
        <?php
        // Get a list of items that the user hasn't reviewed today
        $sql = "SELECT * FROM item WHERE itemId NOT IN (SELECT forItem FROM review WHERE username = '$username' AND DATE(reviewDate) = DATE(NOW()))";
        $result = mysqli_query($conn, $sql);

        // Output an option for each item
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<option value='" . $row["itemId"] . "'>" . $row["title"] . "</option>";
        }
        ?>
    </select>
    <br>
    <label for="rating">Rating:</label>
    <select id="rating" name="rating">
        <option value="excellent">Excellent</option>
        <option value="good">Good</option>
        <option value="fair">Fair</option>
        <option value="poor">Poor</option>
    </select>
    <br>
    <label for="description">Description:</label>
    <input type="text" id="description" name="description">
    <br>
    <input type="submit" value="Submit Review">
</form>