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