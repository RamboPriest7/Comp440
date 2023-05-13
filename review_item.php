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

    $username = $_SESSION['username'];
    
// If the user has submitted the review form, insert the review into the database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $itemId = $_POST["itemId"];
    $rating = $_POST["rating"];
    $description = $_POST["description"];

    // Check if the user has already written a review for this item today
    $sql = "SELECT COUNT(*) FROM review WHERE forItem = $itemId AND writtenBy = '$username' AND DATE(reviewDate) = DATE(NOW())";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_fetch_array($result)[0];
    if ($count >= 3) {
        echo "You have reached your daily limit of 3 reviews for this item. Please try again tomorrow.";
        exit();
    }

    // Check if the item belongs to the user
    $sql = "SELECT COUNT(*) FROM items WHERE itemId = $itemId AND username = '$username'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_fetch_array($result)[0];
    if ($count > 0) {
        echo "You cannot write a review for your own item.";
        exit();
    }

    // Insert the review into the database
    $stmt = $conn->prepare("INSERT INTO review (forItem, writtenBy, score, remark) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $itemId, $username, $rating, $description);

    if ($stmt->execute()) {
        echo "Review submitted successfully.";
    } else {
        echo "Error submitting review.";
    }
}
?>
