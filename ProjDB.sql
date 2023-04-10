/* how to insert into a database
INSERT INTO `comp440`.`users` (`username`, `password`, `firstname`, `lastname`, `email`) VALUES ('JohnS', '123', 'John', 'Smith', 'johnsmith47@gmail.com');
*/

DROP TABLE IF EXISTS `comp440`.`users`;

CREATE TABLE users (
  username VARCHAR(50) PRIMARY KEY,
  password VARCHAR(255),
  firstName VARCHAR(50),
  lastName VARCHAR(50),
  email VARCHAR(50) UNIQUE
);


INSERT INTO `comp440`.`users` (`username`, `password`, `firstname`, `lastname`, `email`) VALUES ('Batman','1234','bat','bat','nananana@batman.com'),('Bob','12345','bob','lee','bobthatsme@yahoo.com'),('John', 'abc123', 'John', 'Stone', 'johnstone3737@aol.com');

DROP TABLE IF EXISTS `comp440`.`items`;

CREATE TABLE items (
  id INT(11) NOT NULL AUTO_INCREMENT,
  title VARCHAR(255) NOT NULL,
  description TEXT,
  category VARCHAR(255),
  price DECIMAL(10,2),
  user_id INT(11) NOT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
);