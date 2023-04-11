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

$username = $_SESSION["username"];


// Count number of items posted by user today
$sql = "SELECT COUNT(*) FROM items WHERE username = '$username' AND DATE(postDate) = DATE(NOW());";
$result = mysqli_query($conn, $sql);
$count = mysqli_fetch_array($result)[0];

if ($count >= 3) {
	echo "You have reached your daily limit of 3 posts. Please try again tomorrow.";
    echo "<br><br>";
    echo "<button style='background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;' onclick=\"location.href='home.php'\">Return to Homepage</button>";
	exit();
}

// If user has not posted 3 items today and user accessed using post method, insert item
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $description = $_POST["description"];
    $category = $_POST["category"];
    $price = $_POST["price"];

    $stmt = $conn->prepare("INSERT INTO items (title, description, category, price, username) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $title, $description, $category, $price, $username);

    if ($stmt->execute()) {
        header("Location: insert_item_form.php");
            exit();   
    } else {
        echo "You have reached your daily limit of 3 posts. Please try again tomorrow.";
        exit();
    }
}

?>