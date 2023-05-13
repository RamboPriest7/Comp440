<?php

require ("dbconnect.php");

$conn = new mysqli($hostname, $username, $password, $dbname);

$sql = "DROP TABLE IF EXISTS review;";
if ($conn->query($sql) === false) {
    exit("Error dropping review table: " . $conn->error);
}

$sql = "DROP TABLE IF EXISTS favorite;";
if ($conn->query($sql) === false) {
    exit("Error dropping favorite table: " . $conn->error);
}

$sql = "DROP TABLE IF EXISTS item;";
if ($conn->query($sql) === false) {
    exit("Error dropping item table: " . $conn->error);
}

$sql = "DROP TABLE IF EXISTS itemCategory;";
if ($conn->query($sql) === false) {
    exit("Error dropping itemCategory table: " . $conn->error);
}

$sql = "DROP TABLE IF EXISTS users;";
if ($conn->query($sql) === false) {
    exit("Error dropping user table: " . $conn->error);
}


$itemCategoryTable = "CREATE TABLE itemCategory (
    category VARCHAR(64) NOT NULL PRIMARY KEY);";
    

if ($conn->query($itemCategoryTable) === false) {
    exit("Error creating itemCategory table: " . $conn->error);
}

$userTable = "CREATE TABLE IF NOT EXISTS users (
    username VARCHAR(32) NOT NULL PRIMARY KEY,
    password VARCHAR(64) NOT NULL,
    firstName VARCHAR (64) NOT NULL,
    lastName VARCHAR(64) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE);";

if ($conn->query($userTable) === false) {
    exit("Error creating user table: " . $conn->error);
}

$favoriteTable = "CREATE TABLE IF NOT EXISTS favorite (
    theUser VARCHAR(32) NOT NULL,
    followerName VARCHAR(32) NOT NULL ,
    PRIMARY KEY (theUser, followerName),
    KEY (followerName),
    FOREIGN KEY (theUser) REFERENCES users(username),
    FOREIGN KEY (followerName) REFERENCES users(username));";


if ($conn->query($favoriteTable) === false) {
    exit("Error creating favorites table: " . $conn->error);
}

$itemTable = "CREATE TABLE IF NOT EXISTS item (
    itemId INT(10) AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(64) NOT NULL,
    description TEXT(255),
    category VARCHAR(64) NOT NULL,
    price DECIMAL(10,2),
    postDate TIMESTAMP NOT NULL DEFAULT CURRENT_DATE,
    username VARCHAR(32) NOT NULL,
    FOREIGN KEY (username) REFERENCES users(username));";

if ($conn->query($itemTable) === false) {
    exit("Error creating item table: " . $conn->error);
}

$reviewTable = "CREATE TABLE review (
    reviewId INT(10) AUTO_INCREMENT PRIMARY KEY,
    remark TEXT (255),
    score VARCHAR(10),
    reviewDate TIMESTAMP NOT NULL DEFAULT CURRENT_DATE,
    writtenBy VARCHAR(255),
    forItem INT(10) NOT NULL,
    FOREIGN KEY (writtenBy) REFERENCES users(username),
    FOREIGN KEY (forItem) REFERENCES item(itemId));";

if ($conn->query($reviewTable) === false) {
    exit("Error creating review table: " . $conn->error);
}

/*
$sql = "INSERT INTO favorite(theUser, followerName) VALUES 
    ('Bob', 'Brad'), 
    ('Bob', 'Snake'), 
    ('Mateo', 'Bob'), 
    ('Snake', 'Bob'), 
    ('John', 'Snake'), 
    ('John', 'Mateo')";
if ($conn->query($sql) === false) {
    exit("Error inserting data into favorites table: " . $conn->error);
}
*/


$queries = array(
    "INSERT INTO users(username, password, firstName, lastName, email) VALUES
    ('John', 'abc123', 'John', 'Smith', 'john.smith@example.com'),
    ('Bob', '12345', 'Bob', 'Stone', 'Bob.Stone@example.com'),
    ('Mateo', 'mat23', 'Mateo', 'Garcia', 'mateo.garcia@example.com'),
    ('Snake', '360', 'Snake', 'Eyes', 'snake.eyes@example.com'),
    ('johndoe', 'doe99', 'John', 'Doe', 'john.doe@example.com'),
    ('janedoe', 'doe47', 'Jane', 'Doe', 'jane.doe@example.com'),
    ('Grinch', 'no543', 'The', 'Grinch', 'grinchstolechristmas@example.com'),
    ('Brad', 'Pitt97', 'Brad', 'Williams', 'Brad.williams@example.com')",


    "INSERT INTO itemCategory(category) VALUES
    ('Art & Collectibles'),
    ('Baby & Kids'),
    ('Clothing & Accessories'),
    ('Electronics'),
    ('Furniture'),
    ('Home & Garden'),
    ('Pet Supplies'),
    ('Sporting Goods'),
    ('Toys'),
    ('Other')",

    "INSERT INTO item(title, description, category, price, postDate, username) VALUES
    ('Smartphone 14 Pro', 'The newest edition to the iphone family', 'Electronics', '850.00', '2023-03-03 00:00:00', 'John'),
    ('Wireless headphones', 'Noise cancelling performance and premium comfort', 'Electronics', '225.00', '2023-04-02 00:00:00', 'Bob'),
    ('Mountain Bike', 'Full suspension mountain bike with 26-inch wheels', 'Sporting Goods', '975.00', '2023-03-28 00:00:00', 'Mateo'),
    ('Vintage Watch', 'Mechanical wristwatch from the 1950s', 'Clothing & Accessories', '308.00', '2023-03-28 00:00:00', 'Mateo'),
    ('Soccer Ball', 'A size 5 soccer ball for recreational play', 'Sporting Goods', '15.00', '2023-03-28 00:00:00', 'Snake'),
    ('Levis Jeans', 'A pair of jeans made from Levis', 'Clothing & Accessories', '35.00', '2023-03-28 00:00:00', 'Snake'),
    ('Leather Shoulder Bag', 'Womens crossbody bag with adjustable strap', 'Clothing & Accessories', '400.00', '2023-03-13 00:00:00', 'Brad'),
    ('Leather Jacket', 'Black leather jacket in excellent condition', 'Clothing & Accessories', '149.99', '2023-05-23 00:00:00', 'johndoe'),
    ('Smart Watch', 'Brand new smart watch with fitness tracking features', 'Electronics', '199.99', '2023-04-22 00:00:00', 'johndoe'),
    ('iPhone 12 Pro', 'Almost new iPhone 12 Pro in gold color', 'Electronics', '999.99', '2023-02-23 00:00:00', 'janedoe'),
    ('Designer Handbag', 'Genuine leather designer handbag in excellent condition', 'Clothing & Accessories', '399.99', '2023-01-23 00:00:00', 'janedoe'),
    ('Sunglasses', 'Designer sunglasses with polarized lenses', 'Clothing & Accessories', '149.99', '2023-04-24 00:00:00', 'johndoe'),
    ('Necklace', 'Gold necklace', 'Clothing & Accessories', '179.99', '2023-04-24 00:00:00', 'janedoe'),
    ('Coffee Maker', 'Programmable coffee machine with thermal carafe', 'Home & Garden', '50.00', '2023-03-07 00:00:00', 'Snake'),
    ('Coal', 'Coal for christmas', 'Toys', '1.00', '2022-12-24 00:00:00', 'Grinch')",

    "INSERT INTO review(remark, score, reviewDate, writtenBy, forItem) VALUES
    ('Great phone. The battery lasts all day!', 'excellent', '2023-04-03', 'Mateo', '1'),
    ('These headphones are fantastic! The noise cancelling is top notch!', 'excellent', '2023-04-02 ', 'Snake', '2'),
    ('Amazing sound, however, not comfortable to wear for long periods of time.', 'good', '2023-04-04 ', 'John', '2'),
    ('The suspension is terrible! Would not recommend it.', 'poor', '2023-04-02 ', 'John', '3'),
    ('Very nice, I got so many compliments.', 'excellent', '2022-11-22 ', 'Snake', '4'),
    ('Can tell the time and more.', 'excellent', '2022-09-18 ', 'Bob', '4'),
    ('Very good, 0 complaints of it.', 'excellent', '2023-02-03 ', 'janedoe', '4'),
    ('Paid to give excellent review.', 'excellent', '2023-01-13 ', 'John', '4'),
    ('Horrible sound and comfortable to wear for long periods of time.', 'poor', '2023-04-14 ', 'Grinch', '2'),
    ('Hate coffee.', 'poor', '2023-04-13 ', 'Grinch', '14'),
    ('Excellent review for test!', 'excellent', '2022-02-26 ', 'johndoe', '1'),
    ('Excellent review for test!', 'excellent', '2022-01-13 ', 'Brad', '1'),
    ('Excellent review for test!', 'excellent', '2023-01-04 ', 'johndoe', '7'),
    ('Excellent review for test!', 'excellent', '2023-03-08 ', 'Snake', '7'),
    ('Excellent review for test!', 'excellent', '2023-03-27 ', 'Snake', '3'),
    ('Excellent review for test!', 'excellent', '2023-05-28 ', 'janedoe', '3'),
    ('Excellent review for test!', 'excellent', '2022-05-26 ', 'Snake', '9'),
    ('Excellent review for test!', 'excellent', '2022-07-25 ', 'John', '9'),
    ('Excellent review for test!', 'excellent', '2022-08-24 ', 'Bob', '9'),
    ('Poor review for test!', 'poor', '2022-02-23 ', 'Brad', '11'),
    ('Poor review for test!', 'poor', '2022-08-22 ', 'Mateo', '11'),
    ('Fair review for test!', 'fair', '2022-04-21 ', 'Bob', '11'),
    ('Excellent review for test!', 'excellent', '2022-09-20 ', 'Mateo', '7'),
    ('Excellent review for test!', 'excellent', '2022-06-18 ', 'janedoe', '7'),
    ('Excellent review for test!', 'excellent', '2022-01-26 ', 'Bob', '3'),
    ('Excellent review for test!', 'excellent', '2023-03-16 ', 'Mateo', '2'),
    ('Hate coffee.', 'poor', '2023-01-02 ', 'Mateo', '14'),
    ('Hate coffee.', 'poor', '2023-02-03 ', 'johndoe', '14'),
    ('Good ball for the park.', 'excellent', '2022-01-12 ', 'Mateo', '5'),
    ('Perfect pair of jeans.', 'excellent', '2022-12-23 ', 'Mateo', '6'),
    ('Broke after 2 months and difficult to clean. Avoid!', 'poor', '2023-04-04 ', 'Brad', '9')",

    "INSERT INTO favorite(theUser, followerName) VALUES 
    ('Bob', 'Brad'), 
    ('Bob', 'Snake'), 
    ('Mateo', 'Bob'), 
    ('Snake', 'Bob'), 
    ('John', 'Snake'), 
    ('John', 'Mateo')"

);

foreach ($queries as $query) {
    if ($conn->query($query) === TRUE) {
        header("Location: home.php");
    } else {
        echo "Error inserting into database: " . $conn->error;
    }
}

$conn->close();
?>