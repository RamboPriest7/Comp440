INSERT INTO `comp440`.`users` (`username`, `password`, `firstname`, `lastname`, `email`) VALUES ('Batman','1234','bat','bat','nananana@batman.com'),('Bob','12345','bob','lee','bobthatsme@yahoo.com'),('John', 'abc123', 'John', 'Stone', 'johnstone3737@aol.com');

DROP TABLE IF EXISTS `comp440`.`items`;

CREATE TABLE items (
  itemId INT(11) NOT NULL AUTO_INCREMENT,
  title VARCHAR(255) NOT NULL,
  description TEXT,
  category VARCHAR(255),
  price DECIMAL(10,2),
  postDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  postedBy INT(11) NOT NULL,
  PRIMARY KEY (itemId),
  FOREIGN KEY (postedBy) REFERENCES users(username)
);


INSERT INTO 'comp440'.'items'(title, description, category, price, postDate, postedBy) VALUES
        ('Smartphone 14 Pro', 'Newest phone with improved camera and battery life', 'Electronics', '800.00', '2023-03-03 10:00:00', 'Batman'),
        ('Wireless headphones', 'World-class combination of noise cancelling performance and premium comfort', 'Electronics', '275.00', '2023-04-10 12:00:00', 'John'),


DROP TABLE IF EXISTS `comp440`.`review`;

CREATE TABLE review (
  reviewId INT(10) AUTO_INCREMENT PRIMARY KEY,
  remark TEXT (255),
  score VARCHAR(10),
  reviewDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  writtenBy VARCHAR(255) NOT NULL,
  forItem INT(10) NOT NULL,
  FOREIGN KEY (writtenBy) REFERENCES users(username),
  FOREIGN KEY (forItem) REFERENCES items(itemId)
);

/* not part of initialize db button */